<?php //include 'dbcon.php'?>
<?php
 $con= new mysqli('localhost','root','','banklogin');
if(isset($_POST['transfer']))
{
		
	function function_alert($errors) { 
    // Display the alert box  
    echo "<script>alert('$errors');"; 
	echo "window.location.href = 'users.php'";
	echo "</script>";
	}
	  
	session_start();
    $from_id = trim($_POST['fromtc']);
    $to_id = trim($_POST['touser']);
    $credits = trim($_POST['credits']);  
    $error = false;
	
	$from_query = "SELECT * FROM userdetails WHERE id='$from_id'";
	$from_result = mysqli_query($con,$from_query);
	$row_from = mysqli_fetch_assoc($from_result);
	$from_name = $row_from['username'];
	
	$from_creditdb = $row_from['balance'];
	

	//Query for user to which credit is transfered
	$to_query = "SELECT * FROM userdetails WHERE id='$to_id'";
	$to_result = mysqli_query($con,$to_query);
    $row_to = mysqli_fetch_assoc($to_result);
    $to_name = $row_to['username'];
	
	//to user credits
    $to_creditdb = $row_to['balance'];
	
	 if((int)$credits>(int)$from_creditdb)
    {
        $errors = "Insufficient Credits";
        $error = true; 
    }
	
	if(!$error)
    {
        $current_date = date("Y-m-d H:i:s");
		//from user credits update
        $userf_finalcredit = "UPDATE userdetails SET ";
        $userf_finalcredit .= "balance = balance - $credits WHERE id=$from_id";
        $query = mysqli_query($con,$userf_finalcredit);
        
		if(!$query)
        {
            die("QUERY FAILED".mysqli_error($con));
			echo("Error description: " . $mysqli -> error);
        }
		
		//to user credit update
        $userto_finalcredit = "UPDATE userdetails SET ";
        $userto_finalcredit .= "balance = balance + $credits WHERE id=$to_id";
        $query = mysqli_query($con,$userto_finalcredit);
	
		//insert into transcations table
        $query1 = "INSERT INTO transferrecord(from_user,to_user,credit_transfered,DateTime) VALUES('$from_name','$to_name','$credits','$current_date')";
        $res2 = mysqli_query($con,$query1);
		
		
		if($res2){
			
			$user1 = "SELECT * FROM userdetails WHERE id='$from_id' OR id='$to_id'";
			$res=mysqli_query($con,$user1);
			$row_count=mysqli_num_rows($res);
			
		}
		else{
				die("QUERY FAILED".mysqli_error($con));
				echo("Error description: " . $mysqli -> error);
		}
    }
	else{
		function_alert("Insufficient Credit Balance!!Please Try Again");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
   <title>
		Final User Result
    </title>
	<link type="text/css" rel="stylesheet" href="css/users1.css" >
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
    *{
        margin:0px;
        padding:0px;
        box-sizing:border-box;
        font-family: Montserrat, sans-serif;
   
    }
    .content-table {
  border-collapse: collapse;
  margin: 25px 0;
  font-size: 0.9em;
  min-width: 400px;
  border-radius: 5px 5px 0 0;
  overflow: hidden;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
  margin-left:34%;
}

.content-table thead tr {
  background-color: #009879;
  color: #ffffff;
  text-align: center;
  font-weight: bold;
}

.content-table th,
.content-table td {
  padding: 12px 15px;
}

.content-table tbody tr {
  border-bottom: 1px solid #dddddd;
}

.content-table tbody tr:nth-of-type(even) {
  background-color: #f3f3f3;
}

.content-table tbody tr:last-of-type {
  border-bottom: 2px solid #009879;
}

.content-table tbody tr.active-row {
  font-weight: bold;
  color: #009879;
}
.btn{
  width:150px;
    padding: 12px 15px;
    background:#009879;
    color:#fff;
    border:none;
    outline:none;
    border-radius:05px;
    font-weight:bold;
    cursor:pointer;
}
.form-control, .num{
    border:none;
    outline:none;
    background:none;
    min-width:460px;
    padding: 8px 0px;
    border:2px solid #009879;
    font-size:17px;
    border-radius:05px;
    padding-left:4px;
}
	h1{
		font-size: 42px;
		margin-left: 290px;
		margin-top: 40px;
	}
	#my_table{
		margin-left: 400px;
		font-size: 20px;
		border-style: groove;
		border-collapse: collapse;
		background-color: #effbf7;
	}
	th{
		background-color:#00FF99;
	
	}
	th,td{
		padding: 15px;
	}
	.success-msg {
		margin: 10px 10px 10px 10px;
		padding: 10px;
		border-radius: 3px 3px 3px 3px;
		color: #270;
		background-color: #DFF2BF;
        width:450px;
        margin-left:34%;
	}
li {
  float:right;
}
ul {
	list-style-type: none;
	margin: -9px;
	padding: 5px 5px;
	overflow: hidden;
	margin-top:13px;
	height: 50px;
margin-right: 400px;
}
	
li a {

  padding: 10px 10px;
color:#ffffff ;
  text-decoration: none;
  font-size:23px;
  letter-spacing: 1px;
}
p{
	font-size: 26px;
	font-family: serif;
	font-style: oblique;
	letter-spacing: 2px;
	word-spacing: 2px;
	float: left;
	margin-top: -70px;
	margin-left: 62px;
	color: #00FFCC;
	 text-shadow: 1px 0px;
}
li a:hover {
   color: #ff99cc;
}
	</style>
    </head>
	
	<body>

		<ul>

	

	<li><a class="active" href="transferhistory.php"><b>Transfer History</b></a></li>
	<li><a href="Homepage.php"><b>Home</b></a></li>
	</ul>
<hr>
	
	<br>
		<div class="success-msg">
				<i class="fa fa-check"></i>
					Credit is Successfully Transfered. Check the details Below!!
		</div><br><br>
        <h2 style="text-align:center;">User Details After Credit Transfer</h2><br>
        <table class="content-table">
                <thead>
				<tr>
				<th>ID</th>
				<th>UserName</th>
				<th>Email</th>
				<th>Current Credits</th>
				</tr>
                </thead>
	<?php
		
		while($row = mysqli_fetch_assoc($res))
		{
		echo "<tr>";
		echo "<td>" . $row['id'] . "</td>";
		echo "<td>" . $row['username'] . "</td>";
		echo "<td>" . $row['email'] . "</td>";
		echo "<td>" . $row['balance'] . "</td>";
		echo "</tr>";
		}
		echo "</table>";
	?>
		<br><br>
		
	</div>
	</div>
	</body>
</html>
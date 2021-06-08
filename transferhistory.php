<?php
$con= new mysqli('localhost','root','','banklogin');
$query = "SELECT * FROM transferrecord";
$result = mysqli_query($con,$query);
?>

<html>
<head>
<title>
Transfer History
</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link type="text/css" rel="stylesheet" href="css/viewuser1.css" >
<style>
html { 
  background: url(../images/try4.gif) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
	#my_table3{
		margin-left: 290px;
		font-size: 20px;
		width: 700px;
color:black;
		border-style: groove;
		border-collapse: collapse;
		background-color: #effbf7;

	}
	#my_table3 tr:hover {background-color: #e7e7e7;}
	th{
		background-color:#00FF99;
	
	}
	th,td{
		padding: 11px;
		text-align: center;
	}



.fixed-footer{
        width: 100%;
        position: fixed;        
        background: #333;
        padding: 10px 0;
        color: #fff;
		margin-left: -8px;
		height: 20px;
    }
.fixed-footer{
        bottom: 0;
    }
    .container{
        width: 80%;
        margin: 0 auto; /* Center the DIV horizontally */
		text-align: center;
    }
h1{
margin-top: 80px;
margin-left: 600px;
color:black;
align:center;
}


.login-form img{
	width: 545px;
	height:300px;
	position:relative;
	margin-top:0px;
	margin-left: 35px;
}
.container1 .btn1 {
  position: absolute;
  margin-left: -90px;
  margin-top: 40px;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  background-color:  #4CAF50;
  color:white;
  font-size: 20px;
  padding: 12px 24px;
  border: none;
  cursor: pointer;
  border-radius: 10px;
  text-align: center;
}

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
</style>
</head>
<body>
	
	 
	
	<div class="container1">
		
	<script>
	function redirect() {
		window.location.href = "users.php";
	}
	</script>
	<br>
<br>
	    <form method="GET">
		

		
		<div class="head">
			<h1>Transfer History</h1>
            <table class="content-table">
                <thead>
				<tr>
				<th>From_User</th>
				<th>TO_User</th>
				<th>Credit_Amount</th>
                <th>Date-Time</th>
				</tr>
                </thead>
			<?php
				while($row = mysqli_fetch_array($result)) 
				{
				echo "<tbody>";
				echo "<tr>";
				//echo "<td>" . $row['id'] . "</td>";
				echo "<td>" . $row['from_user'] . "</td>";
				echo "<td>" . $row['to_user'] . "</td>";
				echo "<td>" . $row['credit_transfered'] . "</td>";
				echo "<td>" . $row['DateTime'] . "</td>";
				echo "</tr>";
				echo "</tbody>";
				}
				echo "</table>";
			?>
		</div>
		<br><br><br>
	</div>
	</div>
	<br><br>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPLE FORM</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="css/all.min.css">-->
</head>
<style>
    *{
        margin:0px;
        padding:0px;
        box-sizing:border-box;
        font-family: Montserrat, sans-serif;
    }
    body{
        display:flex;
        justify-content:center;
        align-items:center;
        min-height:90vh;
    }
    .content-table {
  border-collapse: collapse;
  margin: 25px 0;
  font-size: 0.9em;
  min-width: 400px;
  border-radius: 5px 5px 0 0;
  overflow: hidden;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
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
</style>
<body>
<?php 

if(isset($_GET['id'])) 
{   
//Session Start
session_start();	
$_SESSION['id'] = $_GET['id'];
}
?>
    <div class="containner">
    <?php
	if(isset($_GET['errors'])){
		$error=$_GET['errors'];
		echo "<div class='alert alert-danger'>
            $error</div>";
			
	}
	if(isset($_GET['success'])){
		$success= $_GET['success'];
		echo "<div class='alert alert-success'>
           $success</div>";
	}?>
        
        <form method="post" action="transfercredit.php">
        <h2 style="color:#009879;text-align:center;">TRANSACTION</h2><br/>
        <h2 style="color:#009879;font-size:1.2rem;">Transfer From</h2>
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
                $con= new mysqli('localhost','root','','banklogin');
               // $txt = $_GET['username'];
               //$user='select * from userdetails where username=".$txt."';
               //$result = mysqli_query($con,$user);
               $txt = $_GET['id'];
				$result = mysqli_query($con,"SELECT * FROM userdetails where id=" . $txt);
			  
                while($row = mysqli_fetch_array($result))
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
            <h2 style="color:#009879;font-size:1.2rem;">Transfer To</h2><br/>
         <select class="form-control" required name="touser" id="listu1">
			<option value="">Select User</option>
                <?php
				   // var $space = " ";
					$txt = $_GET['id'];
                    $query = "SELECT * FROM userdetails where id!='".$txt."'";
                    $result = mysqli_query($con,$query);

                    while($row = mysqli_fetch_array($result))
                    {?>
                    <option value="<?php echo $row['id'];?>"><?php echo $row['username']; echo " "; echo " - "; echo $row['balance'];?></option>
					<?php
                    }
				?>
            </select><br><br>
            <h2 style="color:#009879;font-size:1.2rem;">Enter Amount</h2><br/>
            <input type="number" required class="num" name="credits" id="balance" onclick="myFunction()" min="1" >
            <input name="fromtc" type="hidden" value="<?php echo $txt;?>">

            <br>
            
            <button class="btn" type="submit" name="transfer" style="margin-top:40px;float:right;">Transfer</button>
                </form>
            <button class="btn" onclick="redirect()" style="margin-top:40px;float:left;">Back</button>
    </div>
    <script type="text/javascript">
        function myFunction() {
            $a = document.getElementById("balance");
            if ($a == 0 || $a < 0) {
                window.alert("Balance Must Be greater than Zero.");
            }
           
        }

        function redirect() {
		window.location.href = "users.php";
	}

    </script>
</body>

</html>
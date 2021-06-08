<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Responsive Login Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
</head>
<style>
     * {
     font-family: Montserrat, sans-serif; /* Change your font family */
}
body{
    align-items:center;
    display:flex;
    justify-content:center;
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

</style>
<body>
<table class="content-table">
    <thead>
    <tr>
      <th>ID</th>
      <th>Username</th>
      <th>E-mail</th>
      <th>Balance</th>
      <th>Operation</th>
    </tr>
</thead>
<tbody>
    <tr>
        <?php
        $con= new mysqli('localhost','root','','banklogin');
        
       $user = "select * from userdetails ";
       $result=mysqli_query($con,$user);
       $row_count=mysqli_num_rows($result);
     $i=1;
    while($row = mysqli_fetch_assoc($result))
    {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['username'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . $row['balance'] . "</td>";
    //echo "<td><input class='button1' type='submit' value='View'/></td>";
    echo "<td><a class='text-white' href='viewuserdata.php?id=".$row['id']."'><button  class='btn'>Transfer Credit</button></a></td>";
    echo "</tr>";
    
    }
   ?>
   
      
    </tr>
</tbody>
</table>
</body>
</html>
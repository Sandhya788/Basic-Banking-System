<?php

    $conn= new mysqli('localhost','root','','banklogin');
    
  
    if(!empty($_POST['username'])&&!empty($_POST['email'])&&!empty($_POST['bal']))
    { 
            $dup=mysqli_query($conn,"SELECT username FROM userdetails where username='".$_POST['username']."'");
            if(mysqli_num_rows($dup)>0){
                echo '<b style="color:red;margin-top:-210px;">Username Aready Taken!</b>';
            }
           // $dup=mysqli_query($conn,"SELECT email FROM userdetails where email='".$_POST['email']."'");
           // if(mysqli_num_rows($dup)>0){
            //    echo '<b style="color:red;text-align:center;margin-top:-48px;">Email Aready Exits!</b>';
           // }
            $dup=mysqli_query($conn,"SELECT * FROM userdetails where username='".$_POST['username']."' AND email='".$_POST['email']."'") ;
            if(mysqli_num_rows($dup)==0){
                $stmt=$conn->prepare("insert into userdetails(username,email,balance) values(?,?,?)");
                $stmt->bind_param("sss",$_POST['username'],$_POST['email'],$_POST['bal']);
                $stmt->execute();
                
                if($stmt->affected_rows>0)
                {
                echo "<script>";
                echo "alert('Successfully Registered')";
                echo "</script>";
                header("Location: users.php");
                // echo "window.location.href = 'userdata.php'";
                }
                else
                {
                echo "<script>";
                echo "alert('Please Try Again')";
                echo "</script>";
                }
          }    
        }    

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Responsive Login Page</title>
    <link rel="stylesheet" href="styless.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
</head>

<body>

    <!--form area start-->
    <div class="form">
        <!--login form start-->
        <form class="login-form" method="POST">
            <i class="fas fa-user-circle"></i>
            <input class="user-input" type="text" name="username" placeholder="Username" required>
            <input class="user-input" type="email" name="email" placeholder="abc@gmail.com" required>
            <input class="user-input" type="number" name="bal" id="bal" min="1" placeholder="Balance" onclick="myFunction()" required>
            <div class="options-01">
                <!-- <label class="remember-me"><input type="checkbox" name="">Remember me</label>
               <a href="#">Forgot your password?</a>-->
            </div>
            <input class="btn" type="submit" name="login" value="CREATE ACCOUNT">

            <div class="options-02">
                <a href="login.html"> <input class="btn" type="submit" name="reset" value="RESET"></a>
            </div>
        </form>


        <script type="text/javascript">
            function myFunction() {
                $a = document.getElementById("bal");
                if ($a == 0 || $a < 0) {
                    window.alert("Balance Must Be greater than Zero.");
                }
            }
        </script>

</body>

</html>
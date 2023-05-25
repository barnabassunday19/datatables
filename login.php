

<?php 
session_start();
include 'db_conn.php';
$msg = '';
$msgClass = '';
if (isset($_POST['username']) && isset($_POST['d_password'])) {
   $username = $_POST['username'];
   $d_password = $_POST['d_password'];
   $sql=mysqli_query($conn,"SELECT * FROM user where username='$username' and d_password='$d_password'");
   $row  = mysqli_fetch_assoc($sql);
   echo  $row;
   if(mysqli_num_rows($sql) === 1 )
   {
     
       $_SESSION["userId"] = $row['id'];
       $_SESSION["userrole"]=$row['role'];
       $_SESSION["username"]=$row['username'];
       //popup for user logged in//
       header("Location:logs.php?msg=welcome $username"); 
   }
   else
   {
       $msg = "Invalid role /Password";
       $msgClass = 'error';
     
   }
}




?>



<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title>LogIn and SignUp Page</title>
    <link rel="stylesheet" type="text/css" href="front.css">
</head>

<body>
<div class="bg-img">
         <div class="content">
            <header>Login Form</header>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
               <div class="field">
                  <span class="fa fa-user"></span>
                  <input type="text" name="username" id="logName" placeholder="username" required>
               </div>
               <div class="field space">
                  <span class="fa fa-lock"></span>
                  <input type="password" name="d_password" id="logPassword" placeholder="Password" required>
                  <span class="show">SHOW</span>
               </div>
               <div class="pass">
                  <a href="#">Forgot Password?</a>
               </div>
               <div class="field">
                  <input type="submit" name="submit" value="Login">
               </div>
            </form>
            <div class="login">
              
            </div>
            <div class="links">
               <div class="facebook">
               <img src="facebook.png">
               </div>
               <div class="instagram">
               <img src="instagram.png">
               </div>
            </div>
            <div class="signup">
               Let's go Home!!!
               <a href="index.php">Home</a>
            </div>
         </div>
      </div>
      <script>
         const pass_field = document.querySelector('.pass-key');
         const showBtn = document.querySelector('.show');
         showBtn.addEventListener('click', function(){
          if(pass_field.type === "password"){
            pass_field.type = "text";
            showBtn.textContent = "HIDE";
            showBtn.style.color = "#98f758";
          }else{
            pass_field.type = "password";
            showBtn.textContent = "SHOW";
            showBtn.style.color = "#222";
          }
         });
      </script>
  

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="js.js"></script>
</body>

<?php
session_start();
$title = "Login";
//linke the file for header file
include 'Header.php';
//linke the file for the file connected to database
include 'connect-db.php';
$title='Login page';
if(isset($_POST['username'],$_POST['password']))
{
    //create variables
    $uname = $_POST['username'];
    $pwd = md5($_POST['password']);
    //create query
    $query = "SELECT * FROM user WHERE Username='$uname' AND Password='$pwd'";
    $result = mysqli_query($con, $query);
   
    if($result)
    {
        if((mysqli_num_rows($result) == 1))
        {
            //After checking if the username/password is correct, set the session
            $_SESSION[Username] = $uname;
            echo 'Log in';
            header('Location: admin.php?status=valid');
             exit();
        }
        else
        {
            header('Location: adminlogin.php?status=invalid');
             exit();
        }
    }
        
 }
?>
<html lang="ar" dir="rtl">
<head>
     <title><?php echo $title; ?></title>
       <!-- Connecting to CSS file for styling  -->
        <link  href="style.css" rel="stylesheet" type="text/css"/>
</head>
 <!-- create html form for adminlogin page  -->
<form name="lo" id="lo" action="adminlogin.php" method="POST" enctype="multipart/form-data" onsubmit="return validate1()">
    
    <h4 id="wellll"><center> Welcome </center></h4>
    
            <fieldset id="loginfield">
  <?php if(isset($_GET['status']) && $_GET['status']==="invalid") { ?>          
          <p>Wrong username/password combination. Please Try Again Later</p>
      <?php } ?> 
            
                <legend>Login</legend>
                <img src="Images/login.png"  alt="icon" width="100" height="100"><br><br>
                <img src="Images/username.png"  alt="icon" width="30" height="30">
                <label><strong>Username</strong><input type="text" name="username" maxlength="13" required placeholder="Username"/></label> 
                 <span class="error" id="na">Required</span>
                <br><br>
                <img src="Images/password.png"  alt="icon" width="30" height="30">
                <label><strong>Password</strong> <input type="password" name="password" maxlength="13"  required placeholder="Password"/></label> 
                <span class="error" id="pass">Required</span>
                <br><br><input type="submit" value="submit" name='login'style="height:30px; width:170px" onclick="validatel()" />

                
           
               
            </fieldset><br><br><br>


        </form>
<script>
            function validatel()
            {
                    var i = document.lo.username.value;
                   var x = document.lo.password.value;

                    var splo = document.getElementsByTagName("span");
                     //cheacking if all the fileds are empty then show span 
                    if(i==="")
                    {
                        splo[0].style.visibility="visible"; 
                       
                    }
                    
                    if(x==="")
                    {
                        splo[1].style.visibility="visible";  
                        
                    }

            }




        </script>
        </html>
        <?php


include 'Footer.php';

?>     
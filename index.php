<?php
error_reporting(0);
if(isset($_POST['login']))
{
    $email=input_field($_POST['email']);
    $pass=input_field($_POST['password']);
    $pass1=$pass;
    $dest="upload/";
    if(!empty($email) && !empty($pass))
    {
        if($email==is_dir($dest.$email))
        {
            $fo=fopen($dest.$email."/details.txt","r");
            $pass2=trim(fgets($fo));
            $password=substr(sha1($pass1),0,10);
            if($pass2==$password)
            {
                session_start();
                $_SESSION['sid']=$email;
                if(!empty($_POST["cbox"]))
                {
                    setcookie("ecook",$email,time()+3600*24);
                    setcookie("pcook",$pass1,time()+3600*24);
                }
                header("location:dashboard.php");
            }
            else{
                $err="Invalid Password";
            }
        }
        else{
            $err="Invalid Email Id";
        }
    }
    else
    {
        $err="Please enter the email or password!!";
    }
}
function input_field($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<?php
include("head.php");
?>
<title>Index Page</title>
<script>
        function remember()
        {
            if("<?php echo $_COOKIE['ecook']; ?>"!= undefined)
            {
                if("<?php echo $_COOKIE['ecook']; ?>" == document.getElementById("email")
                .value)
                {
                document.getElementById("password").value = "<?php echo $_COOKIE['pcook']
                ;?>";
                }
            }
            else{
                document.getElementById("password").value="";
            }
        }
</script>
</head>
<body>
    <div class="jumbotron">
        <h1 class="display-4">Login Panel</h1>
    </div>
    <div class="container">
        <form method="post">
            <div class="form-group has-error text-danger">
                <span class="help-block"><?php echo "$err"; ?></span>
            </div>
            <div class="form-group row m-2">
                <label for="email" class="col-sm-2 col-form-label-lg">Email</label>
                <div class="col-sm-10 col-md-10">
                    <input type="text" class="form-control form-control-lg" id="email" name="email" placeholder="Email ID" onchange="remember()">
                </div>
            </div>

            <div class="form-group row m-2">
                <label for="password" class="col-sm-2 col-form-label-lg">Password</label>
                <div class="col-sm-10 col-md-10">
                    <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Password">
                </div>
            </div>

            <div class="form-group row m-2">
                <div class="col-sm-2"></div>
                <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck1" name="cbox">
                    <label class="form-check-label" for="gridCheck1">Remember me</label>
                </div>
                </div>
            </div>

            <div class="form-group row m-2">
                <div class="col-sm-10 col-lg-10">
                    <button type="submit" class="btn btn-primary" name="login">Login</button>
                    <a href="register.php" class="btn btn-success">New User</a>
                </div>
            </div>
        </form>
    </div>
<?php
include("script.php");
?>
</body>
</html>
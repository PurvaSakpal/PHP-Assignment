<?php
error_reporting(0);
include("captcha.php");
$emailE=$nameE=$passE=$cpassE=$capE=$emailS=$fileE=$fileS=$top="";
if(isset($_POST['reg']))
{
    $email=$_POST['email'];
    $pass=$_POST['pass'];
    $cpass=$_POST['cpass'];
    $name=$_POST['name'];
    $age=$_POST['age'];
    $gender=@$_POST['gender'];
    $tmp=$_FILES['att']['tmp_name'];//temp name
    $fn=$_FILES['att']['name'];//original name

    if(!empty($email) && !empty($pass) && !empty($cpass) && !empty($name) && !empty($age) && !empty($gender) && !empty($tmp))
    {
        if(preg_match ("/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i",$email))
        {
            if(preg_match("/^[a-zA-Z ]+$/",$name))
            {
                if(preg_match("/^[a-zA-Z0-9 ]{8,24}$/",$pass))
                {
                    if($pass==$cpass)
                    {
                        if($_POST['cap']==$_POST['capsum'])
                        {
                            $ext=pathinfo($fn,PATHINFO_EXTENSION);
                            $fname="profile.$ext";
                            if($ext="jpg" || $ext="jpeg" || $ext="png"){     
                                if(is_dir("upload/".$email)){
                                  $emailS= "Email Id Already exist";
                                }
                                else{
                                    mkdir("upload/$email");
                                    if(move_uploaded_file($tmp,"upload/$email/$fname"))
                                        {
                                        $password=substr(sha1($pass),0,10);
                                        file_put_contents("upload/$email/details.txt","$password \n $name \n $gender\n $age \n $fname");
                                        header("location:welcome.php?uid=$email");
                                        }
                                        else {
                                        rmdir("upload/$email");
                                        $fileS="Uploading Error";
                                        }
                                }
                        }
                        else{
                            $fileE="Only jpg, jpeg and png allowed";
                        }
                        
                    }
                    else{
                        $capE="Invalid captcha";
                    }
                }
                else{
                    $cpassE="Password and Confirm pass does not match";
                }
                
            }
            else{
                $passE="Range between 8-24";
            }
        }
        else{
            $nameE="Invalid name";
        }
    }
    else{
        $emailE="Invalid Email";
    }
}
else{
    $top="Enter all the fields";
}
}
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include("head.php"); ?>
        <title>Register Panel</title>
    </head>
    <body>
        <div class="jumbotron">
            <h1 class="display-4 lead">Register Panel</h1>
        </div>
        <section class="container">
        <form method="post" enctype="multipart/form-data">
            <div class="form-group has-error text-danger">
                <span class="help-block"><?php echo "$top"; ?></span>
            </div>
            <div class="form-group row">
                <label for="foremail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                <input type="email" class="form-control" id="foremail" name="email" placeholder="Email">
                </div>
            </div>
            <div class="form-group has-error text-danger">
                <span class="help-block"><?php echo "$emailE"; ?></span>
                <span class="help-block"><?php echo "$emailS"; ?></span>
            </div>
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword" name="pass" placeholder="Password">
                </div>
            </div>
            <div class="form-group has-error text-danger">
                <span class="help-block"><?php echo "$passE"; ?></span>
            </div>
            <div class="form-group row">
                <label for="inputcPassword" class="col-sm-2 col-form-label">Confirm Password</label>
                <div class="col-sm-10">
                <input type="password" class="form-control" id="inputcPassword" name="cpass" placeholder="Confirm Password">
                </div>
            </div>
            <div class="form-group has-error text-danger">
                <span class="help-block"><?php echo "$cpassE"; ?></span>
            </div>
            <div class="form-group row">
                <label for="forname" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="forname" name="name" placeholder="Full Name">
                </div>
            </div>
            <div class="form-group has-error text-danger">
                <span class="help-block"><?php echo "$nameE"; ?></span>
            </div>
            <div class="form-group row">
                <label for="forage" class="col-sm-2 col-form-label">Age</label>
                <div class="col-sm-10">
                <input type="number" class="form-control" id="forage" name="age" placeholder="Age">
                </div>
            </div>

            <div class="form-group row">
                <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                <div class="col-sm-10">
                <div class="form-check">
                    <label class="form-check-label" for="gridRadios1">Female</label>
                    <input class="form-check-control" type="radio" name="gender" id="gridRadios1" value="female">
                </div>
                <div class="form-check">
                    <label class="form-check-label" for="gridRadios2">Male</label>
                    <input class="form-check-control" type="radio" name="gender" id="gridRadios2" value="male">
                </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputImage3" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control-file" id="inputImage3" name="att">
                </div>
            </div>
            <div class="form-group has-error text-danger">
                <span class="help-block"><?php echo "$fileE"; ?></span>
                <span class="help-block"><?php echo "$fileS"; ?></span>

            </div>
            <div class="form-group row">
                <label for="captcha" class="col-sm-2 col-form-label">Captcha : <?php echo "$show"; ?></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="captcha" name="cap">
                    <input type="hidden" class="form-control" id="hcaptcha" name="capsum" value="<?php echo "$capsum"; ?>">
                </div>
            </div>
            <div class="form-group has-error text-danger">
                <span class="help-block"><?php echo "$capE"; ?></span>
            </div>
            <div class="form-group row m-2">
                <div class="col-sm-10 col-lg-10">
                    <button type="submit" class="btn btn-success" name="reg">Register</button>
                </div>
            </div>
        </form>
        </section>
        <?php include("script.php"); ?>
    </body>
</html>
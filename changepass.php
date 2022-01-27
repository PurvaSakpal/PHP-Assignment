<?php
error_reporting(0);
$fo=fopen("upload/$email/details.txt","r");
$password=trim(fgets($fo)); //password
$name=trim(fgets($fo)); // Name
$gender=trim(fgets($fo)); // gender
$age=trim(fgets($fo)); //age
$image=trim(fgets($fo)); // ProfileName
$opass=$_POST['opass'];
$opass1=substr(sha1($opass),0,10);
$npass=$_POST['npass'];
$cpass=$_POST['cpass'];
   if(isset($_POST['sub'])) 
   {

       if(!empty($opass) && !empty($npass) && !empty($cpass))
       {
           echo "$opass1";
           if($opass1==$password)
           {
            if($npass==$cpass)
               {
                file_put_contents("upload/$email/details.txt","$npass \n $name \n $gender \n $age \n $image");
                $top="Changed password Successfully";
                setcookie("ecook","");
                setcookie("pcook","");
            }
            else{
                $cpassE="New password and Confirm Password do not match";
            }
        }
        else{
            $opassE="Old password does not match";
        }
       }
       else{
           $err="Please fill the fields";
       }
   }
?>

<body>
    <form method="post">
       <section class="container">
            <div class="form-group has-error text-danger">
                <span class="help-block"><?php echo "$err"; ?></span>
                <span class="help-block"><?php echo "$top"; ?></span>

            </div>
            <div class="form-group row m-2">
                <label for="opass" class="col-sm-2 col-form-label">Old Password</label>
                <div class="col-sm-10 col-md-10">
                    <input type="password" class="form-control" id="opass" placeholder="Old Password" name="opass">
                </div>
            </div>
            <div class="form-group has-error text-danger">
                <span class="help-block"><?php echo "$opassE"; ?></span>
            </div>
            <div class="form-group row m-2">
                <label for="npass" class="col-sm-2 col-form-label">New Password</label>
                <div class="col-sm-10 col-md-10">
                    <input type="password" class="form-control" id="npass" placeholder="New Password" name="npass">
                </div>
            </div>
            
            <div class="form-group row m-2">
                <label for="cpass" class="col-sm-2 col-form-label">Confirm Password</label>
                <div class="col-sm-10 col-md-10">
                    <input type="password" class="form-control" id="cpass" placeholder="Confirm Password" name="cpass">
                </div>
            </div>
            <div class="form-group has-error text-danger">
                <span class="help-block"><?php echo "$cpassE"; ?></span>
            </div>
            <div class="form-group row m-2">
                <div class="col-sm-10 col-lg-10">
                <button type="submit" class="btn btn-success" name="sub">Submit</button>
                </div>
            </div>      
       </section> 
    </form>
</body>
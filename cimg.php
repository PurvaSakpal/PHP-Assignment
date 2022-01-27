<?php
$email=$_SESSION['sid'];
$errimage=$status=$status1="";
$fo=fopen("upload/$email/details.txt","r");
$password=fgets($fo); //password
$name=trim(fgets($fo)); // Name
$gender=fgets($fo); // gender
$age=fgets($fo); //age
$image=trim(fgets($fo)); // ProfileName
$imgpath="upload/$email/$image";

if(isset($_POST['sub'])){
    
    // get image file
    $temp=$_FILES['att']['tmp_name'];
     $fname=$_FILES['att']['name'];
     $des ="upload/$email/";
     
     if(!empty($temp)){
        unlink($imgpath);
            $ext = pathinfo($fname,PATHINFO_EXTENSION);
            $fn = "attachment.$ext";
            $pathname="profile.$ext";   // rename image file
            // allow only if image with jpg/jpeg/pdf
         if($ext == "jpg" || $ext == "jpeg" || $ext == "png"){
            
            if(move_uploaded_file($temp,$des.$fn)){
                // image is added
                file_put_contents("upload/$email/details.txt","$pass \n $name \n $gender \n $age \n $pathname");

                $errimage="is-valid";
                $status1="Profile Updated !";
                rename("upload/$email/$fn","upload/$email/$pathname");
                header("location:dashboard.php?con=changeimage");
            }
            else{
                $errimage="is-invalid";
                $status="Uploading Error !";
            }
         }
         else{
            $errimage="is-invalid";
            $status="only jpg/jpeg/png allowed.";
         }
     }
     else{
        $errimage="is-invalid";
        $status= "plz selecy any file";
     }
}
?>

<div class="row">
    <section class="col-md-5 mt-5">
    <img src="<?php echo $imgpath;?>" height="250px" width="100%" alt="Profile Photo">
    </section>
    <section class="col-md-5 mt-5">
        <form  method="post" enctype="multipart/form-data">
            <section class="mt-4"></section>
            <!-- file image  -->
            <label for="validationServer01" class="form-label">Update Image</label>
            <input type="file"  name="att"  class="form-control" id="validationServer01" class="form-control <?php echo $errimage; ?>" id="validationServer01">
            
            <!-- Print error msges -->
            <section class="text-danger"><?php echo $status?></section>
            <section class="text-success"><?php echo $status1?></section>
            <br>
            <button class="btn btn-success p-2" type="submit" name="sub">Change</button>
            <button class="btn btn-danger p-2" type="reset"> Clear </button>
        </form>
    </section>
</div>
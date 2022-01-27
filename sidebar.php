<?php 
// session values to get email and user name
$email=$_SESSION['sid'];
// $user=$_SESSION['sid'];
$fo=fopen("upload/$email/details.txt","r");
fgets($fo); //password
$name=trim(fgets($fo)); // name
$age=trim(fgets($fo)); //age
$gender=trim(fgets($fo)); // gender
$image=trim(fgets($fo)); // Image
$imgpath="upload/$email/$image";
?>

<div class="card" style="width: 18rem;">
  <img src="<?php echo "$imgpath";?>" height="250px" width="100%" class="card-img-top" alt="Profile Photo">
<div class="list-group">
  <a href="?con=cimg" class="list-group-item list-group-item-action">Change Image</a>
  <a href="?con=name" class="list-group-item list-group-item-action">Name : <?php echo $name;?></a>
  <a href="?con=age" class="list-group-item list-group-item-action">Age : <?php echo $age;?></a>
  <a href="?con=gen" class="list-group-item list-group-item-action">Gender : <?php echo $gender;?></a>
</div>
<?php
session_start();
$sid=$_SESSION['sid'];
if(empty($sid))
{
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
    include("head.php");
    ?>
    <title>Dashboard</title>
  </head>
  <body>
    <div class="jumbotron m-0">
        <h1 class="display-4">Dashboard</h1>    
    </div>
    <section class="nav-bar">
    <?php
    include("nav.php");
    ?>
    </section>
    <div>
      <section class="container-fluid row">
        <aside class="col-md-3">
          <?php include("sidebar.php") ?>
        </aside>
      <section class="col-md-9">
      <?php
        switch(@$_GET['con']){
            case 'img': include("img.php");
            break;
            case 'cimg':include("cimg.php");
            break;
            case 'name': echo "<h1>Name</h1>";
            break;
            case 'age': echo "<h1>Age</h1>";
            break;
            case 'gen': echo "<h1>Gender</h1>";
            break;
            case 'changepass': include("changepass.php");
            break;
            case 'home': echo "<h1>Home Page</h1>";
            break;
            default : echo "<h1> Home Page</h1>";
            break;
          }
      ?>
      </section>
       </section>

    </div>
    <?php
    include("script.php");
    ?>
  </body>
</html>
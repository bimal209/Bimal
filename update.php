<?php

    $update=false;

    $server="localhost";
    $user="root";
    $password="";
    $database="crud";

    $con=mysqli_connect($server,$user,$password,$database);

    $nid=$_GET['nid'];
    $nfname=$_GET['nfname'];
    $nlname=$_GET['nlname'];
    $nemail=$_GET['nemail'];

    
 if(isset($_POST['update'])){
  $n1=$_POST['n1'];
  $n2=$_POST['n2'];
  $n3=$_POST['n3'];
  $n4=$_POST['n4'];

  $sql="UPDATE `user2` SET fname='$n2',lname='$n3',email='$n4' WHERE id='$n1'";
  $result=mysqli_query($con,$sql);
  if($result){
    //echo "record updated";
   $update=true;
  }
  else{
    //echo "record not updated";
    $update=false;
  }
 }

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
  <?php

if(isset($_POST['update'])){
    if($update==true){
      echo "<div class='alert alert-primary' role='alert'>
              Record Updated Successfully!
            </div>";
      }
    else{
      echo "<div class='alert alert-warning' role='alert'>
              Record Not Updated!
          </div>";
      }
   }

   ?>

    <form method="post" >
    <div class="row g-3 my-5">
  <div class="col">
    <input type="number" class="form-control" placeholder="Id" aria-label="Id" value="<?php echo $nid; ?>" name="n1">
  </div>
  <div class="col">
    <input type="text" class="form-control" placeholder="First name" aria-label="First name"  value="<?php echo $nfname; ?>" name="n2">
  </div>
  <div class="col">
    <input type="text" class="form-control" placeholder="Last name" aria-label="Last name" value="<?php echo $nlname; ?>"  name="n3">
  </div>
  <div class="col">
    <input type="varchar" class="form-control" placeholder="Email" aria-label="Email" value="<?php echo $nemail; ?>"  name="n4">
  </div>
  <div class="col-12">
    <input type="submit" class="btn btn-primary" name="update" value="Update details" />
  </div>
</div>
    </form>
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  </body>
</html>

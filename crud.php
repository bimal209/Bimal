<?php
    
    $insert=false;
    $delete=false;
    $exist=false;
    $found=false;
    $null_data=false;

    $server="localhost";
    $user="root";
    $password="";
    $database="crud";

    $con=mysqli_connect($server,$user,$password,$database);

    if(!$con){
      die("Connection failed: ".mysqli_connect_error());
    }
   /* else{
      //echo "Success";
    }*/

    //insert code//
    if(isset($_POST['submit']))  //or $_SERVER['REQUEST_METHOD']=="POST"   or   isset($_POST['submit'])
    {
      
      $fname=$_POST['fname'];
      $lname=$_POST['lname'];
      $email=$_POST['email'];
      
      $q="SELECT * FROM `user2` WHERE email='$email'";
      $r=mysqli_query($con,$q);

      if(mysqli_num_rows($r) >=1){
        //echo "record already exist";
         $exist=true;
      }
      else{
        $sql="INSERT INTO `user2` (`id`, `fname`, `lname`, `email`) VALUES (NULL, '$fname', '$lname', '$email')";
        $result=mysqli_query($con,$sql);
        
        if($result){
          //echo "record inserted";
            $insert=true;
        }
        else{
          echo "<div class='alert alert-warning' role='alert'>
          Sorry , something went wrong!
          </div>";
        }
      }
      
    }

  // Delete code //
   if(isset($_GET['nid'])){
    $nid=$_GET['nid'];
    $sql="DELETE FROM `user2` WHERE id='$nid'";
    $result=mysqli_query($con,$sql);
    if($result){
      //echo "record deleted";
      $delete=true;
    }
    else{
      //echo "record not deleted";
      $delete=false;
    }
  }
  
  //search code//
  if(isset($_POST['search'])){
      $data=$_POST['search_data'];
      
      if($data==NULL ){
           $null_data=true;
           $found=true;
      }
      else{
        $s="SELECT * FROM `user2` WHERE fname='$data' or lname='$data' or email='$data'";
        $res=mysqli_query($con,$s);
  
        if($row=mysqli_fetch_assoc($res)){
          $found=true;
          $s1data=$row['fname'];
          $s2data=$row['lname'];
          $s3data=$row['email'];
        }
        else{
          $found=false;
        }
      }
  }

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD+</title>
    <link rel="stylesheet" href="crud.css" /> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">CRUD+</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Contact Us</a>
              </li>
             <!-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Dropdown
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li>-->
              <li class="nav-item">
                <a class="nav-link" href="#">About Us</a>
              </li>
            </ul>
            <form class="d-flex" role="search" method="post">
              <input class="form-control me-2" type="search" placeholder="Search" name="search_data" aria-label="Search">
              <button class="btn btn-outline-success" type="submit" name="search">Search</button>
            </form>
          </div>
        </div>
      </nav>


      <div class="message-display">
         <?php
            if(isset($_POST['search'])){
                 if($null_data==true){
                  echo "<div class='alert alert-warning' role='alert'>
                  Please Enter Details to Search!
                  </div>";
                 }
                 if($found==false){
                  echo "<div class='alert alert-warning' role='alert'>
                  No Match Found!
                  </div>";
                 }
            }
          if($exist==true){
            echo "<div class='alert alert-warning' role='alert'>
            Sorry , Email already exist!
            </div>";
          }
          if(isset($_POST['submit'])){
            if($insert==true){
              echo "<div class='alert alert-primary' role='alert'>
                      Record Inserted Successfully!
                    </div>";
              }
           }
           if(isset($_GET['nid'])){
            if($delete==true){
              echo "<div class='alert alert-warning' role='alert'>
                      Record has been deleted!
                    </div>";
              }
            else{
              echo "<div class='alert alert-warning' role='alert'>
                      Record Not deleted!
                  </div>";
              }
           }
           
         ?>
      </div>

      <!--Form Template-->
      <div class="container">
        <form class="row g-3 needs-validation my-5" method="post" >
            <div class="col-md-4">
              <label for="validationCustom01" class="form-label">First name</label>
              <input type="text" class="form-control" id="validationCustom01"  name="fname" value="<?php
                      if(isset($_POST['search']) & $null_data==false & $found==true){
                        echo $s1data;
                      }
              ?>" required />
              <div class="valid-feedback">
                Looks good!
              </div>
            </div>
            <div class="col-md-4">
              <label for="validationCustom02" class="form-label">Last name</label>
              <input type="text" class="form-control" id="validationCustom02" name="lname" value="<?php
                      if(isset($_POST['search']) & $found==true & $null_data==false){
                        echo $s2data;
                      }
              ?>" required />
              <div class="valid-feedback">
                Looks good!
              </div>
            </div>
            <div class="col-md-4">
              <label for="validationCustomUsername" class="form-label">Email</label>
              <div class="input-group has-validation">
                <input type="email" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="email" value="<?php
                      if(isset($_POST['search']) & $found==true & $null_data==false){
                        echo $s3data;
                      }
              ?>" required />
                <div class="invalid-feedback">
                  Please choose a username.
                </div>
              </div>
            </div>
            <div class="col-12">
              <input type="submit" class="btn btn-primary" name="submit" />
             
            </div>
          </form>
      </div>

      <!--Display records-->
      <div class="container">

<table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">Sno</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Email</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
            $sql="SELECT * FROM `user2`";
            $result=mysqli_query($con,$sql);
            $count=mysqli_num_rows($result);
            //$sno=0;
            echo "<h5 class='count'>"."Total Entries : ".$count."</h5>";

            while($row=mysqli_fetch_assoc($result)){
                // $sno=$sno+1;
              echo "<tr>
                    <th scope='row'>".$row['id']."</th>
                    <td>".$row['fname']."</td>
                    <td>".$row['lname']."</td>
                    <td>".$row['email']."</td>
                    <td>
                     <a  class='btn btn-primary' name='delete'  href='crud.php?nid=".$row['id']."' >delete</a>
                     <a  class='btn btn-primary' name='update'   href='update.php?nid=".$row['id']."&nfname=".$row['fname']."&nlname=".$row['lname']."&nemail=".$row['email']."'>update</a>
                    </td>
                    </tr>";
              
            }
        ?>
        
  </tbody>
</table>
      </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  </body>
</html>
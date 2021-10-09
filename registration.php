<?php
   include('connection.php'); 
   $conn=DB_connect();

   if (isset($_POST['userRegistration'])) {
      $user    = $_POST['user'];
      $email   = $_POST['email'];
      $password   = $_POST['password'];
      
      $sql="insert into user values (null, '$user', '$email', '$password')"; 
      $result=mysqli_query($conn,$sql);

      if($result){
         header("Location: index.php");
      }else{
         $_SESSION['registrationFail']='Registration fail, Try again.';
      }
   }
   
   include('include/header.php');
?>
   <div class="wrapper">
      <div class="container-fluid">
         <div class="row justify-content-center mt-4">
            <div class="col-4 col-sm-4 col-md-4">
               <div class="card">               
                  <div class="card-header bg-info">User registration</div>
                  <?php if(isset($_SESSION['registrationFail'])) { ?>
                     <div class="alert alert-danger text-center">
                        <strong><?php echo $_SESSION['registrationFail']?></strong>
                     </div>
                  <?php } ?>
                  
                  <div class="card-body">
                     <form action="" method="post">
                        <div class="form-group">
                           <label>User Name</label>
                           <input type="text" class="form-control" name="user" placeholder="User Name" required>
                        </div>
                        <div class="form-group">
                           <label>User Email</label>
                           <input type="email" class="form-control" name="email" placeholder="User email" required>
                        </div>
                        <div class="form-group">
                           <label>New Password</label>
                           <input type="password" class="form-control" name="password" placeholder="password" required>
                        </div>                               
                        <button type="submit" name="userRegistration" class="btn btn-success float-right">Create Account</button>
                     </form>       
                   </div>
               </div>
            </div>
         </div>
      </div>         
   </div>
<?php include('include/footer.php'); ?>

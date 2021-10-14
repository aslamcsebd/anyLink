<?php
   include('connection.php'); 
   $conn=DB_connect();

   $sql = "select * from items where status='1'";
   $result = mysqli_query($conn,$sql);
   $rowCount = mysqli_num_rows($result);
   
   if (isset($_SESSION['userId'])==true) {
      $userId = $_SESSION['userId'];
      $sql2 = "select * from items where userId = '$userId' and status='1' order by id desc limit 10";
   }else{
      $sql2 = "select * from items where status='1' order by id desc limit 10";
   }
   $topTen = mysqli_query($conn,$sql2); 

   if (isset($_POST['userLogin'])) {
      
      $email      = $_POST['email'];
      $password   = $_POST['password'];
   
      $sql="select * from user where email='$email' AND password='$password'"; 

      $result=mysqli_query($conn,$sql);
      $rowCount = mysqli_num_rows($result);
      $row = mysqli_fetch_assoc($result);

      if ($rowCount == 1) {     
         $_SESSION['userLogin']=true;
         $_SESSION['userId']=$row['id'];
      }else{ 
         $_SESSION['userLoginFail']='User\'s email/password is wrong. Try again.';
      }
   }
   
   if (isset($_POST['changePasswordNow'])) {
      $userId        = $_SESSION['userId'];
      $oldPass       = $_POST['oldPass'];
      $newPass       = $_POST['newPass'];
      $confirmPass   = $_POST['confirmPass'];

      if ($newPass == $confirmPass) {
         $sql = "select * from user where id='$userId' and password='$oldPass'";
         $result = mysqli_query($conn,$sql);
         $rowCount = mysqli_num_rows($result);

         if ($rowCount == 1){
            $sql="update user set password='$newPass' where password='$oldPass'";
            $result = mysqli_query($conn,$sql);
            $_SESSION['changePasswordSuccess'] = 'Your old password change successfully';
         }else{
            $_SESSION['oldPassWrong'] = 'Sorry! Your old password ('. $oldPass . ') incorrect';
         }
      }else{
         $_SESSION['changePasswordFail'] = 'Your confirm password ('. $newPass . ') don\'t match';
      }
   }

   if (isset($_POST['addItemNow'])) {
      $userId        = $_SESSION['userId'];
      $status        = $_POST['status'];
      $name          = $_POST['name'];
      $description   = $_POST['description'];
      $url           = $_POST['url'];
   
      $sql2="insert into items values (null, ' $userId', '$status', '$name', '$description','$url')";
      $result2=mysqli_query($conn,$sql2);

      $sql3="select * from items where name='$name' and description='$description' and url='$url'"; 
      $result3=mysqli_query($conn,$sql3);

      $rowCount2 = mysqli_num_rows($result3);

      if ($rowCount2 == 1) {     
         $_SESSION['InsertSuccessfully'] = $name . ' Insert successfully';  
      }else{ 
         $_SESSION['InsertFail'] = $name . ' insert fail';
      }
      // header("Location: admin.php");      
   }

   include('include/header.php');
?> 
   <div class="wrapper">
      <div class="container-fluid">
         <div class="row mt-4">       
            <div class="col-12 col-sm-6 col-md-3">
               <div class="card animated zoomIn wow">
                  <div class="card-header bg-info"> All option </div>
                  <div class="card-body bg-light">
                     <form action="" method="post">
                        <ul>
                        <?php if (!isset($_SESSION['userLogin'])) { ?>
                           <li>
                              <h4>
                                 <button type="submit" class="btn btn-success" name="login">Login
                                 </button>
                              </h4>
                           </li>
                        <?php } ?>
                        <?php if (isset($_SESSION['userLogin'])) { ?>
                           <li>
                              <h4>
                                 <button type="submit" class="btn btn-primary" name="addItem">Add Item
                                 </button>
                              </h4>
                           </li>
                           <li>
                              <h4>
                                 <button type="submit" class="btn btn-info" name="seeAllItem">See All Item
                              </h4> 
                           </li>
                           <li>
                              <h4>
                                 <button type="submit" class="btn btn-warning" name="changePassword">Change Password
                                 </button>
                              </h4>
                           </li>
                           <li>
                              <h4>
                                 <a href="logout.php" class="btn btn-danger">Logout</a>
                              </h4>
                           </li>
                        <?php } ?>
                        </ul>
                     </form>
                  </div>               
               </div>            
            </div>

            <!-- user login -->
            <?php if (!isset($_SESSION['userLogin']) && (isset($_POST['login']) || isset($_POST['userLogin']))) { ?>
               <div class="col-12 col-sm-6 col-md-4">
                  <?php if (isset($_SESSION['userLoginFail'])) { ?>
                     <div class="alert alert-danger">                           
                        <?php echo $_SESSION['userLoginFail']?>
                     </div>
                  <?php } ?>
                  <div class="card">
                     <div class="card-header bg-info">
                        User Login
                     </div>
                     <div class="card-body">
                        <form action="" method="post">
                           <div class="form-group">
                              <label>User Email</label>
                              <input type="text" class="form-control" name="email" required>
                           </div>
                           <div class="form-group">
                              <label>User Password</label>
                              <input type="password" class="form-control" name="password" required>
                           </div>                               
                           <button type="submit" name="userLogin" class="btn btn-info">Login</button>
                        </form>                 
                     </div>               
                  </div>            
               </div>                  
            <?php } ?>

            <!-- Login insure -->
            <?php if (isset($_SESSION['userLogin']) && isset($_POST['login'])) { ?>
               <div class="col-12 col-sm-6 col-md-3">
                     <div class="alert alert-danger">                           
                        <p>You are already login.</p>
                     </div>
               </div>                  
            <?php } ?>

            <!-- Change password -->
            <?php if ((isset($_SESSION['userLogin']) && isset($_POST['changePassword'])) || isset($_POST['changePasswordNow'])) { ?>
               <div class="col-12 col-sm-6 col-md-3">
                  <?php if (isset($_SESSION['changePasswordSuccess'])) { ?>
                     <div class="alert alert-success">                           
                        <?php echo $_SESSION['changePasswordSuccess']?>
                     </div>
                  <?php } ?>

                  <?php if (isset($_SESSION['oldPassWrong'])) { ?>
                     <div class="alert alert-danger">                           
                        <?php echo $_SESSION['oldPassWrong']?>
                     </div>
                  <?php } ?>

                  <?php if (isset($_SESSION['changePasswordFail'])) { ?>
                     <div class="alert alert-danger">                           
                        <?php echo $_SESSION['changePasswordFail']?>
                     </div>
                  <?php } ?>                  
                  
                  <div class="card">
                     <div class="card-header bg-info">
                        User's change password
                     </div>
                     <div class="card-body">
                        <form action="" method="post">
                           <div class="form-group">
                              <label>Old Password</label>
                              <input type="password" class="form-control" name="oldPass" placeholder="Old password" required>
                           </div>
                           
                           <div class="form-group">
                              <label>New Password</label>
                              <input type="password" class="form-control" name="newPass" placeholder="New password" required>
                           </div>
                           <div class="form-group">
                              <label>Confirm Password</label>
                              <input type="password" class="form-control" name="confirmPass" placeholder="Confirm password" required>
                           </div>                                                             
                           <button type="submit" name="changePasswordNow" class="btn btn-info">Change now</button>
                        </form>                 
                     </div>               
                  </div>            
               </div>                  
            <?php } ?>

            <!-- Insert data -->
            <?php if ((isset($_SESSION['userLogin']) && isset($_POST['addItem'])) || isset($_POST['addItemNow'])) { ?>
               <div class="col-12 col-sm-6 ol-md-5 col-lg-4">
                  <?php if(isset($_SESSION['InsertSuccessfully'])) { ?>
                     <div class="alert alert-success">
                        <?php echo $_SESSION['InsertSuccessfully']?>
                     </div>
                  <?php } ?> 
                  <?php if(isset($_SESSION['InsertFail'])) { ?>
                     <div class="alert alert-danger">
                        <?php echo $_SESSION['InsertFail']?>
                     </div>
                  <?php } ?>

                  <div class="card">
                     <div class="card-header bg-info">
                        Add Link
                     </div>

                     <div class="card-body">
                        <form action="" method="post">
                           <div class="form-group">
                              <label>Link name</label>
                              <input type="text" class="form-control" name="name" placeholder="Ex: Facebook, Instagram etc..." required>
                           </div>                              
                           <div class="form-group">
                              <label>Description</label>
                              <textarea type="text" class="form-control" name="description" placeholder="Ex: This is a full description etc..."></textarea>                                 
                           </div>
                           <div class="form-group">
                              <label>Url [Visite link]</label>
                              <input type="text" class="form-control" name="url" placeholder="Ex: www.youtube.com" required>
                           </div>

                           <div class="form-group">
                           <label>Publish status</label> <br>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1" checked="">
                                <label class="form-check-label" for="inlineRadio1">Publish</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="0">
                                <label class="form-check-label" for="inlineRadio2">Unpublish</label>
                              </div>
                           </div>
                           <button type="submit" name="addItemNow" class="btn btn-info">Add Link Now</button>
                        </form>                 
                     </div>               
                  </div>            
               </div>
            <?php } ?>

            <!-- View table -->
            <?php if ((isset($_POST['seeAllItem']) || (!isset($_POST['userLogin']) && !isset($_POST['login']))) || ((isset($_POST['userLogin']) && !isset($_POST['login'])) && (isset($_SESSION['userLogin'])))) { ?>

               <?php if((!isset($_POST['addItem']) && !isset($_POST['changePassword'])) && (!isset($_POST['changePasswordNow']) && !isset($_POST['addItemNow']))){ ?>
                  <div class="col-12 col-sm-12 col-md-9 mb-4 mb-4">
                     <div class="row ustify-content-center">
                        <div class="col-12 col-sm-12 col-md-8">
                           <div class="card">
                              <?php if(isset($_SESSION['itemDelete'])) { ?>
                                 <div class="alert alert-danger">
                                    <?php echo $_SESSION['itemDelete']?>
                                 </div>
                              <?php } ?>                     
                               <div class="card-header bg-info"> <?php echo (isset($_SESSION['userId']) ==true) ? 'Your all link' : 'All user publication list' ?></div>
                               <div class="card-body">
                                 <table id="search" class="table table-bordered text-center">
                                    <thead class="thead-dark">
                                       <tr>                              
                                          <th>Name</th>
                                          <th>Description</th>
                                          <th>Action</th>
                                          <?php if (isset($_SESSION['userLogin'])) { ?>
                                             <th>Decision</th>
                                          <?php } ?>                  
                                       </tr>
                                    </thead>  
                                    <tbody>
                                       <?php
                                          if (isset($_SESSION['userId'])) {
                                             $userId = $_SESSION['userId'];
                                             $sql="select * from items where userId = '$userId'";
                                             $result=mysqli_query($conn,$sql); 
                                             $rowCount = mysqli_num_rows($result);
                                          }
                                       ?>
                                       <?php while($row = mysqli_fetch_assoc($result)) { ?>
                                          <tr>                                 
                                             <td><?= $row['name']; ?></td>
                                             <td>
                                                <a href="view.php?id=<?php echo $row['id']; ?>&from=<?= $_SERVER['PHP_SELF']; ?>" class="description btn btn-default" title="Click and see full details"><?= substr($row['description'], 0, 80) . '...' ?>
                                                </a>
                                             </td>
                                             <td>
                                                <a class="btn btn-sm btn-success btn-block" href="<?= $row['url']; ?>" target="_blank" title="Click and visite this link">Go->Visite</a>
                                             </td>
                                          
                                             <?php if (isset($_SESSION['userLogin'])) { ?>
                                                <td>
                                                   <div class="btn-group">
                                                      <?php if($row['status'] == '1') { ?> 
                                                            <a class="btn btn-sm btn-success" href="action.php?status=<?= $row['status']; ?>&id=<?php echo $row['id']; ?>" title="Publish means other user can see your link">Publish</a>
                                                         <?php }else{ ?>
                                                            <a class="btn btn-sm btn-info" href="action.php?status=<?= $row['status']; ?>&id=<?php echo $row['id']; ?>" title="Unpublish means other user can't see your link">Unpublish</a>
                                                         <?php } ?>
                                                      <a class="btn btn-sm btn-danger" href="action.php?itemIdFromAdmin=<?php echo $row['id']; ?>">Delete</a>
                                                   </div>
                                                </td>
                                             <?php } ?>
                                          </tr>
                                       <?php } ?>
                                    </tbody>
                                 </table>
                               </div>
                           </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-4">
                           <div class="card">                    
                              <div class="card-header bg-info">
                                 <span>Total Items : <?php echo $rowCount; ?></span>    
                              </div>
                              <div class="card-body">
                                 <table class="table table-bordered table-striped text-center">
                                    <thead class="thead-dark">
                                       <tr>
                                          <th><span>Latest ten(10) items</span></th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php while($row = mysqli_fetch_assoc($topTen)){ ?>
                                          <tr>
                                             <td>
                                                <span>
                                                   <a href="<?php echo $row['url']; ?>" target="_blank">
                                                      <?= $row['name']; ?>
                                                   </a>
                                                </span>                                       
                                             </td>
                                          </tr>
                                       <?php } ?>
                                    </tbody>
                                 </table>                             
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>         
               <?php } ?>
            <?php } ?>

         </div>
      </div>         
   </div>
<?php include('include/footer.php'); ?>

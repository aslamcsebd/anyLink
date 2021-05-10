<?php
   include('connection.php'); 
   $conn=DB_connect();
  
   $sql = "select * from item_url";
   $result = mysqli_query($conn,$sql); 
   $rowCount = mysqli_num_rows($result);
   
   $sql2 = "select * from item_url order by id desc limit 10";
   $topTen=mysqli_query($conn,$sql2); 

   if (isset($_POST['adminLogin'])) {
      
      $adminId    = $_POST['adminId'];
      $password   = $_POST['password'];
   
      $sql="select * from admin where adminId='$adminId' AND password='$password' "; 

      $result=mysqli_query($conn,$sql);
      $rowCount = mysqli_num_rows($result);

      if ($rowCount == 1) {     
         $_SESSION['adminLogin']=true;  
      }else{ 
         $_SESSION['adminLoginFail']='Admin\'s ID Or Password is wrong. Try again.';
      }
   }
   
   if (isset($_POST['changePasswordNow'])) {

      $oldPass       = $_POST['oldPass'];
      $newPass       = $_POST['newPass'];
      $confirmPass   = $_POST['confirmPass'];

         if ($newPass == $confirmPass) {
            $sql = "select * from admin where password='$oldPass' ";
            $result = mysqli_query($conn,$sql);
            $rowCount = mysqli_num_rows($result);

            if ($rowCount == 1) {
               
               $sql="update admin set password='$newPass' where password='$oldPass'";
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
      
      $itemName   = $_POST['itemName'];
      $description   = $_POST['description'];
      $visiteLink   = $_POST['visiteLink'];
   
      $sql2="insert into item_url (id,itemName,description,visiteLink) values (null, '$itemName', '$description','$visiteLink')";
      $result2=mysqli_query($conn,$sql2);

      $sql3="select * from item_url where itemName='$itemName' and description='$description' and visiteLink='$visiteLink' "; 
      $result3=mysqli_query($conn,$sql3);

      $rowCount2 = mysqli_num_rows($result3);

      if ($rowCount2 == 1) {     
         $_SESSION['InsertSuccessfully'] = $itemName . ' Insert successfully';  
      }else{ 
         $_SESSION['InsertFail'] = $itemName . ' insert fail';
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
                  <div class="card-header bg-info"> All Item </div>
                  <div class="card-body bg-light">
                     <form action="" method="post">
                        <ul>
                        <?php if (!isset($_SESSION['adminLogin'])) { ?>                              
                           <li>
                              <h4>
                                 <button type="submit" class="btn btn-success" name="login">Login
                                 </button>
                              </h4>
                           </li>
                        <?php } ?>
                        <?php if (isset($_SESSION['adminLogin'])) { ?>

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

            <!-- admin login -->
            <?php if (!isset($_SESSION['adminLogin']) && (isset($_POST['login']) || isset($_POST['adminLogin']))) { ?>
               <div class="col-12 col-sm-6 col-md-3">
                  <?php if (isset($_SESSION['adminLoginFail'])) { ?>
                     <div class="alert alert-danger">                           
                        <?php echo $_SESSION['adminLoginFail']?>
                     </div>
                  <?php } ?>
                  <div class="card">
                     <div class="card-header bg-info">
                        Admin Login
                     </div>
                     <div class="card-body">
                        <form action="" method="post">
                           <div class="form-group">
                              <label>Admin ID</label>
                              <input type="text" class="form-control" name="adminId" value="admin" placeholder="admin ID" required>
                           </div>
                           <div class="form-group">
                              <label>admin Password</label>
                              <input type="password" class="form-control" name="password" value="admin" placeholder="password" required>
                           </div>                               
                           <button type="submit" name="adminLogin" class="btn btn-info">Login</button>
                        </form>                 
                     </div>               
                  </div>            
               </div>                  
            <?php } ?>

            <!-- Login insure -->
            <?php if (isset($_SESSION['adminLogin']) && isset($_POST['login'])) { ?>
               <div class="col-12 col-sm-6 col-md-3">
                     <div class="alert alert-danger">                           
                        <p>You are already login.</p>
                     </div>
               </div>                  
            <?php } ?>

            <!-- Change password -->
            <?php if ((isset($_SESSION['adminLogin']) && isset($_POST['changePassword'])) || isset($_POST['changePasswordNow'])) { ?>
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
                        Admin's Change Password
                     </div>
                     <div class="card-body">
                        <form action="" method="post">
                           <div class="form-group">
                              <label>Old Password</label>
                              <input type="password" class="form-control" name="oldPass" placeholder="Old password" required>
                           </div>
                           
                           <div class="form-group">
                              <label>New Password</label>
                              <input type="password" class="form-control" name="newPass" placeholder="admin ID" required>
                           </div>
                           <div class="form-group">
                              <label>Confirm Password</label>
                              <input type="password" class="form-control" name="confirmPass" placeholder="password" required>
                           </div>                                                             
                           <button type="submit" name="changePasswordNow" class="btn btn-info">Login</button>
                        </form>                 
                     </div>               
                  </div>            
               </div>                  
            <?php } ?>

            <!-- Insert data -->
            <?php if ((isset($_SESSION['adminLogin']) && isset($_POST['addItem'])) || isset($_POST['addItemNow'])) { ?>
               <div class="col-12 col-sm-6 col-md-3">
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
                        Add Product
                     </div>

                     <div class="card-body">
                        <form action="" method="post">
                           <div class="form-group">
                              <label>Item Name</label>
                              <input type="text" class="form-control" name="itemName" placeholder="Item Name" required>
                           </div>                              
                           <div class="form-group">
                              <label>Description</label>
                              <textarea type="text" class="form-control" name="description" placeholder="Full information"></textarea>                                 
                           </div>

                           <div class="form-group">
                              <label>Download link</label>
                              <input type="text" class="form-control" name="visiteLink" placeholder="Link" required>
                           </div>                               
                           <button type="submit" name="addItemNow" class="btn btn-info">Add Item</button>
                        </form>                 
                     </div>               
                  </div>            
               </div>
            <?php } ?>

            <!-- View table -->
            <?php if ((isset($_POST['seeAllItem']) || (!isset($_POST['adminLogin']) && !isset($_POST['login']))) || ((isset($_POST['adminLogin']) && !isset($_POST['login'])) && (isset($_SESSION['adminLogin'])))) { ?>

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
                               <div class="card-header bg-info">Item List</div>
                               <div class="card-body">
                                 <table id="search" class="table table-bordered text-center">
                                    <thead class="thead-dark">
                                       <tr>                              
                                          <th>Name</th>
                                          <th>Description</th>
                                          <th>Action</th>
                                          <?php if (isset($_SESSION['adminLogin'])) { ?>
                                             <th>Decision</th>
                                          <?php } ?>                  
                                       </tr>
                                    </thead>  
                                    <tbody>
                                       <?php 
                                          $sql="select * from item_url";
                                          $result=mysqli_query($conn,$sql); 
                                          $rowCount = mysqli_num_rows($result);
                                          
                                          $sql2 = "select * from item_url";
                                          $result2=mysqli_query($conn,$sql2); 
                                       ?>

                                       <?php while($row = mysqli_fetch_assoc($result)) { ?>
                                          <tr>                                 
                                             <td><?= $row['itemName']; ?></td>
                                             <td>
                                                <a href="view.php?id=<?php echo $row['id']; ?>&from=<?= $_SERVER['PHP_SELF']; ?>" class="description btn btn-default"><?= substr($row['description'], 0, 80) . '...' ?>
                                                </a>
                                             </td>

                                             <td><a class="btn btn-sm btn-success btn-block" href="<?= $row['visiteLink']; ?>" target="_blank">Go->Visite</a></td>
                                          
                                             <?php if (isset($_SESSION['adminLogin'])) { ?>
                                                <td>
                                                   <a class="btn btn-sm btn-danger" href="action.php?itemIdFromAdmin=<?php echo $row['id']; ?>">Delete</a>
                                                   <!-- onclick="return confirm('Are you sure?')" -->
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
                                       <?php while($row = mysqli_fetch_assoc($topTen)) { ?>
                                          <tr>
                                             <td>
                                                <span>
                                                   <a href="<?php echo $row['visiteLink']; ?>" target="_blank">
                                                      <?= $row['itemName']; ?>
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


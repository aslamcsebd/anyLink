<?php 
   include('connection.php');
   $conn=DB_connect();
   $sql="select * from item_url";
   $result=mysqli_query($conn,$sql); 
   $rowCount = mysqli_num_rows($result);
   
   $sql2 = "select * from item_url order by id desc limit 10";
   $topTen=mysqli_query($conn,$sql2); 
   include('include/header.php'); 
?>

      <div class="wrapper">
         <div class="container-fluid">
            <div class="row justify-content-center mt-4">
               <div class="col-12 col-sm-6 col-md-6">
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
                              <?php while($row = mysqli_fetch_assoc($result)) { ?>
                                 <tr>                                 
                                    <td><?= $row['itemName']; ?></td>
                                    <td>
                                       <a href="view.php?id=<?php echo $row['id']; ?>&from=<?= $_SERVER['PHP_SELF']; ?>" class="description btn btn-default"><?= substr($row['description'], 0, 80) . '...' ?>
                                       </a>
                                    </td>
                                    <td>
                                       <a class="btn btn-sm btn-success tn-block" href="<?= $row['visiteLink']; ?>" target="_blank">Go->Visite</a>
                                    </td>
                                 
                                    <?php if (isset($_SESSION['adminLogin'])) { ?>
                                       <td>
                                          <a class="btn btn-sm btn-danger"  href="action.php?itemIdFromIndex=<?php echo $row['id']; ?>">Delete</a>
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
               <div class="col-12 col-sm-6 col-md-3">
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
      </div>


<?php include('include/footer.php'); ?>

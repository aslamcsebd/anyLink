<?php 
   include('connection.php');
   $conn=DB_connect();
   $sql="select * from items where status='1'";
   $result=mysqli_query($conn,$sql); 
   $rowCount = mysqli_num_rows($result);
   
   $sql2 = "select * from items where status='1' order by id desc limit 10";
   $topTen=mysqli_query($conn,$sql2); 
   include('include/header.php'); 
?>

   <div class="wrapper">
      <div class="container-fluid">
         <div class="row justify-content-center mt-4">
            <div class="col-12 col-sm-8 col-md-8">
               <div class="card">
                  <?php if(isset($_SESSION['itemDelete'])) { ?>
                     <div class="alert alert-danger">
                        <?php echo $_SESSION['itemDelete']?>
                     </div>
                  <?php } ?> 
                  <div class="card-header bg-info">All user publication list</div>
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
                           <?php while($row = mysqli_fetch_assoc($result)) { ?>
                              <tr>                                 
                                 <td><?= $row['name']; ?></td>
                                 <td>
                                    <a href="view.php?id=<?php echo $row['id']; ?>&from=<?= $_SERVER['PHP_SELF']; ?>" class="description btn btn-default" title="Click and see full details"><?= substr($row['description'], 0, 80) . '...' ?>
                                    </a>
                                 </td>
                                 <td>
                                    <a class="btn btn-sm btn-success tn-block" href="<?= $row['url']; ?>" target="_blank" title="Click and visite this link">Go->Visite</a>
                                 </td>
                              
                                 <?php if (isset($_SESSION['userLogin'])) { ?>
                                    <td width="20%">
                                       <?php if ($_SESSION['userId']==$row['userId']) { ?>
                                          <div class="btn-group">
                                             <?php if($row['status'] == '1') { ?> 
                                                   <a class="btn btn-sm btn-success" href="action.php?status=<?= $row['status']; ?>&id=<?php echo $row['id']; ?>" title="Publish means other user can see your link">Publish</a>
                                                <?php }else{ ?>
                                                   <a class="btn btn-sm btn-info" href="action.php?status=<?= $row['status']; ?>&id=<?php echo $row['id']; ?>" title="Unpublish means other user can't see your link">Unpublish</a>
                                                <?php } ?>
                                             <a class="btn btn-sm btn-danger" href="action.php?itemIdFromAdmin=<?php echo $row['id']; ?>">Delete</a>
                                          </div>
                                       <?php }else{ ?>
                                          <span class="bg-info p-1 text-light">It is another user's assets </span>
                                       <?php } ?>
                                    </td>
                                 <?php } ?>
                              </tr>
                           <?php } ?>
                        </tbody>
                     </table>
                   </div>
               </div>
            </div>
            <div class="col-12 col-sm-4 col-md-4">
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
                                       <a href="<?php echo $row['url']; ?>" target="_blank" 
                                          <?= (isset($_SESSION['userId'])==true) ?   
                                                (($_SESSION['userId']==$row['userId']) ? 
                                                   'title="It is your assets"' : '') :
                                                ''; ?>>
                                          
                                          <?= (isset($_SESSION['userId'])==true) ?
                                                (($_SESSION['userId']==$row['userId']) ?
                                                   '<i class="far fa-check-circle"></i>' : '') : 
                                                '' ?> 
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
   </div>


<?php include('include/footer.php'); ?>

<?php include('connection.php'); 

   $conn=DB_connect();

   if (isset($_GET['id'])) {
      
      $itemId = $_GET['id']; 
      $from = $_GET['from']; 
      $sql = "select * from items where id='$itemId'";
      $result=mysqli_query($conn,$sql);
      $row = mysqli_fetch_assoc($result);
   }
   include('include/header.php'); 
?>

      <div class="wrapper">
         <div class="container-fluid">
            <div class="row justify-content-center mt-4">
               <div class="col-12 col-sm-6 col-md-6">
                  <div class="card">     
                     <div class="card-header bg-info text-center">Full Information</div>
                        <div class="card-body">
                           <table class="table table-bordered">
                              <tbody>
                                 <tr>
                                    <th width="180" class="text-right">Name : </th>     
                                    <td class="text-left"> <?= $row['name']; ?></td>     
                                 </tr>
                                 <tr>
                                    <th width="180" class="text-right">Description : </th>    
                                    <td class="text-left description"> <?= $row['description'];?> </td>     
                                 </tr>             
                                 <tr>
                                    <th width="180" class="text-right">Website link : </th> 
                                    <td class="text-left">
                                       <a href="<?= $row['url']; ?>" target="_blank"><?= $row['url']; ?></a>
                                    </td>
                                 </tr>
                                 <tr>
                                    <th width="180" class="text-right">Publication status : </th> 
                                    <td class="text-left">
                                       <?php if($row['status'] == '1') { ?> 
                                          <span class="bg-success text-light p-2" title="Publish means other user can see your link">Publish</span>
                                       <?php }else{ ?>
                                          <span class="bg-danger text-light p-2" title="Unpublish means other user can't see your link">Unpublish</span>
                                       <?php } ?>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>                        
                  </div>
                  <br>
                  <a class="btn btn-success px-4" href="<?= $from; ?>">Back</a>
               </div>
            </div>
         </div>
      </div>
<?php include('include/footer.php'); ?>

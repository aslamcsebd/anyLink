<?php include('connection.php'); 

   $conn=DB_connect();

   if (isset($_GET['id'])) {
      
      $itemId = $_GET['id']; 
      $from = $_GET['from']; 
      $sql = "select * from item_url where id='$itemId'";
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
                     <div class="card-header bg-light text-center">Full Information</div>
                        <div class="card-body">
                           <table class="table table-bordered">
                              <tbody>
                                 <tr>
                                    <th width="130" class="text-right">Name : </th>     
                                    <td class="text-left"> <?= $row['itemName']; ?></td>     
                                 </tr>
                                 <tr>
                                    <th width="130" class="text-right">Size : </th> 
                                    <td class="text-left"> <?= $row['fileSize']; ?> </td>     
                                 </tr>
                                 <tr>
                                    <th width="130" class="text-right">Description : </th>    
                                    <td class="text-left description"> <?= $row['description']; ?> </td>     
                                 </tr>             
                              </tbody>
                           </table>
                        </div>                        
                  </div>
                  <br>
                  <a class="btn btn-success" href="<?= $from; ?>">Back</a>
               </div>
            </div>
         </div>
      </div>
<?php include('include/footer.php'); ?>

<?php include('connection.php'); 

   $conn=DB_connect();   

   if (isset($_GET['itemIdFromIndex'])) {
      
      $itemId = $_GET['itemIdFromIndex'];     
      $sql="delete from item_url where id=$itemId";
      $result=mysqli_query($conn,$sql);

      if ($result) {
         $_SESSION['itemDelete']='Item deleted successfully';
      }
      header("Location: index.php");
   }

   if (isset($_GET['itemIdFromAdmin'])) {
      
      $itemId = $_GET['itemIdFromAdmin'];     
      $sql="delete from item_url where id=$itemId";
      $result=mysqli_query($conn,$sql);

      if ($result) {
         $_SESSION['itemDelete']='Item deleted successfully';
      }
      
      header("Location: admin.php");
   }
?>












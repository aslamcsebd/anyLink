<?php include('connection.php'); 

   $conn=DB_connect();   

   if (isset($_GET['itemIdFromIndex'])) {
      
      $itemId = $_GET['itemIdFromIndex'];     
      $sql="delete from items where id=$itemId";
      $result=mysqli_query($conn,$sql);

      if ($result) {
         $_SESSION['itemDelete']='Item deleted successfully';
      }
      header('Location: ' . $_SERVER['HTTP_REFERER']);      
   }

   if (isset($_GET['itemIdFromAdmin'])) {
      
      $itemId = $_GET['itemIdFromAdmin'];     
      $sql="delete from items where id=$itemId";
      $result=mysqli_query($conn,$sql);

      if ($result) {
         $_SESSION['itemDelete']='Item deleted successfully';
      }
      header('Location: ' . $_SERVER['HTTP_REFERER']);
   }

   if (isset($_GET['status'])) {

      $id = $_GET['id'];
      if ($_GET['status']=='1') {
         $status = '0';   
      }else{
         $status = '1';
      }
      $sql = "update items set status='$status' where id='$id'";
      $result=mysqli_query($conn,$sql);
      header('Location: ' . $_SERVER['HTTP_REFERER']);
   }
?>

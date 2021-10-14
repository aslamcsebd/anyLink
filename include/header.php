<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="ISO-8859-1">
      <title>Any Link</title>
      
      <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
   </head>
   <body>
      <!-------------- navbar  -------------->
      <nav class="navbar navbar-expand-md navbar-light shadow-sm">
         <div class="container">
            <a class="navbar-brand" href="index.php">
               Any Link
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <div class="btn-group ml-auto">
                  <a class="btn btn-warning" href="index.php">Home</a>
                  <?php if (!isset($_SESSION['userLogin'])) { ?>   
                     <a class="btn btn-light" href="user.php">Add Item</a>
                     <a class="btn btn-danger" href="user.php">Login</a>
                     <a class="btn btn-primary" href="registration.php">Registration</a>
                  <?php } ?>

                  <?php if (isset($_SESSION['userLogin'])) { ?>
                     <a class="btn btn-light" href="user.php">User</a>
                     <a class="btn btn-danger" href="logout.php">Logout</a>
                  <?php } ?>
               </div>
            </div>
         </div>
      </nav>

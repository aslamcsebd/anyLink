<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="ISO-8859-1">
      <title>Any Link</title>
      
      <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/style.css">
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
               <!-- Left Side Of Navbar -->
               <ul class="navbar-nav navbar-light ml-auto">
                  <li class="nav-item active">
                     <a class="btn btn-light" href="index.php">Home</a>
                  </li>
                  <?php if (!isset($_SESSION['adminLogin'])) { ?>
                  <li class="nav-item active">
                     <a class="btn btn-light" href="admin.php">Add Item</a>
                  </li>
                  <li class="nav-item active">
                     <a class="btn btn-light" href="admin.php">Login</a>
                  </li>
                  <?php } ?>
                  <?php if (isset($_SESSION['adminLogin'])) { ?>
                  <li class="nav-item active">
                     <a class="btn btn-light" href="admin.php">Admin</a>
                  </li>
                  <li class="nav-item active">
                     <a class="btn btn-danger" href="logout.php">Logout</a>
                  </li>
                  <?php } ?>
               </ul>
            </div>
         </div>
      </nav>
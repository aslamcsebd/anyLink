
      <footer class="footer">
         <div class="text-center">
            <!-- © <?= date('Y'); ?> Copyright -->
            <ul>
               <li>
                  <a href="https://www.facebook.com/aslamcsebd" target="_blank">
                     <img src="include/admin.jpg" alt="No Image Found" width="50">
                  </a>
               </li>
               <li>
                  <a href="https://www.aslambd.com/" target="_blank">Developer & Designer's All concept By </a><br>
                  <a href="https://www.facebook.com/aslamcsebd" target="_blank">Md Aslam Hossain</a>
               </li>
            </ul>
         </div>
      </footer>

      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
      <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

      <script type="text/javascript">         

         $(document).ready( function () {
            $('#search').DataTable();
         } );

         // $('#search').DataTable({
         //    "lengthMenu": [ [5, 6, 10, 25, 50, -1], [5, 6, 10, 25, 50, "All"] ]
         // });  

         var table = $('#search').DataTable();
         table
             .order( [ 0, 'desc' ] ) 
             .draw();       
      </script>
   </body>
</html>

<?php    
   unset($_SESSION['itemDelete']);
   unset($_SESSION['adminLoginFail']);
   unset($_SESSION['InsertSuccessfully']);
   unset($_SESSION['InsertFail']);
   unset($_SESSION['changePasswordSuccess']);
   unset($_SESSION['oldPassWrong']);
   unset($_SESSION['changePasswordFail']);
   unset($_SESSION['registrationFail']);   
?>

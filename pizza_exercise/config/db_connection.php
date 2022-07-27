<?php
     //connect to database
     $conn = mysqli_connect('localhost','user','root','pizza');

     if(!$conn){
         echo 'Connection Error:'. mysqli_connect_error();
     }
?>
<?php 
$id= $_GET['id'];
$conn= mysqli_connect("localhost","root","","News") or die("Connection Failed");
 $sql= "DELETE FROM user WHERE user_id= {$id};";
 $sql .= "DELETE FROM post WHERE author={$id}";
 
$result= mysqli_multi_query($conn,$sql);
 header("location: http://localhost:8000/news-template%20html/news-template/admin/users.php");





?>
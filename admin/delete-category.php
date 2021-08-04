<?php 
$id= $_GET['id'];
$conn= mysqli_connect("localhost","root","","News") or die("Connection Failed");
 $sql= "DELETE FROM category WHERE category_id= {$id}" or die("Query Failed");
$result= mysqli_query($conn,$sql);
 header("location: http://localhost:8000/news-template%20html/news-template/admin/category.php");





?>
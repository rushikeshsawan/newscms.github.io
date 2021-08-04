<?php 
$id=$_GET['id'];
$cat=$_GET['cat'];
$conn=mysqli_connect("localhost","root", "", "News") or die("connection failed");
$sql= "DELETE FROM post WHERE post_id={$id};";
$sql .="UPDATE category SET post= post-1 WHERE category_name='{$cat}'";
$result= mysqli_multi_query($conn,$sql);
mysqli_error($conn);
$sql1= "SELECT post_img FROM post WHERE post_id={$id}";
$result1=mysqli_query($conn,$sql1);
$row= mysqli_fetch_assoc($result1);
unlink("upload/".$row['post_img']);
header("location: http://localhost:8000/news-template%20html/news-template/admin/post.php");
?>
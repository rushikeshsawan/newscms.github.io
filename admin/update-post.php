<?php include "header.php";
$conn= mysqli_connect("localhost","root","","News");
$cat_name= $_GET['cat'];
$id= $_POST['post_id'];
if(isset($_POST['submit'])){
  $title= $_POST['post_title'];
  $description= $_POST['postdesc'];
 $category= $_POST['category'];
 
  $image= $_FILES['new-image']['name'];
 $sql1="UPDATE post SET title = '{$title}', description = '{$description}',post_img = '{$image}',category='{$category}' WHERE post_id= '{$id}'; ";
 $sql1.="UPDATE category SET post=post+1 WHERE category_id=$category;";
 $sql1.="UPDATE category SET post=post-1 WHERE category_id= '{$id}'";
$result= mysqli_multi_query($conn,$sql1);

header("location: http://localhost:8000/news-template%20html/news-template/admin/post.php");

}


?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
        <!-- Form for show edit-->
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
         
                <?php
                $id1=$_GET['id'];
                
                $sql= "SELECT * FROM post WHERE post_id= {$id1}";
                $result1= mysqli_query($conn,$sql);
                while($row=mysqli_fetch_assoc($result1)){
                
                ?> 
                <div class="form-group">
                <input type="hidden" name="post_id"  class="form-control" value="<?php echo $row['post_id']; ?>" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputTile">Title</label>
                <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="<?php echo $row['title']; ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="postdesc" class="form-control"  required rows="5">
           <?php echo $row['description'];  ?>
                </textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputCategory">Category</label>
                <select class="form-control" name="category">
                     <?php 
                              $sql2= "SELECT * FROM category";
                              $result2=mysqli_query($conn,$sql2);
                              while($row2=mysqli_fetch_assoc($result2)){
                            echo  "<option     value='{$row2['category_id']}'>  {$row2['category_name']} </option>";
                               
                              } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Post image</label>
                <input type="file" name="new-image">
                <img  src="upload/<?php echo $row['post_img']; } ?>" height="150px">
                <input type="hidden" name="old-image" value="">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
        </form>
        <!-- Form End -->
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>

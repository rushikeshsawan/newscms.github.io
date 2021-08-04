<?php include "header.php"; 
$conn=mysqli_connect("localhost","root","","News");
$date=date("d F Y");
if(isset($_POST['submit'])){
  $title= $_POST['post_title'];
  $description= $_POST['postdesc'];
  $category= $_POST['category'];
  $img_name= ($_FILES['fileToUpload']['name']);
  $img= $_FILES['fileToUpload']['tmp_name'];
  $dir="upload/";
  $author= $_SESSION['user_id'];
  
   $sql1 = "INSERT INTO post (title, description, category,post_date,author, post_img) VALUES ('{$title}','{$description}','{$category}','{$date}','{$author}', '{$img_name}');"; $sql1 .= "UPDATE category SET post= post + 1 WHERE category_id={$category}";
  
  $result= mysqli_multi_query($conn,$sql1);
  echo mysqli_error($conn);
  move_uploaded_file($img,$dir.$img_name);
header("location: http://localhost:8000/news-template%20html/news-template/admin/post.php");
}


?>
  <div id="admin-content">
      <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <h1 class="admin-heading">Add New Post</h1>
             </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form -->
                  <form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="post_title">Title</label>
                          <input type="text" name="post_title" class="form-control" autocomplete="off" required>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1"> Description</label>
                          <textarea name="postdesc" class="form-control" rows="5"  required></textarea>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Category</label>
                          <select name="category" class="form-control">
                              <option value="" disabled=""> Select Category</option>
                              <?php 
                              $sql= "SELECT * FROM category";
                              $result=mysqli_query($conn,$sql);
                              while($row=mysqli_fetch_assoc($result)){
                            echo  "<option value='{$row['category_id']}'>  {$row['category_name']} </option>";
                               
                              } ?>
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Post image</label>
                          <input type="file" name="fileToUpload" required>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                  </form>
                  <!--/Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>

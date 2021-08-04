<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <?php 
                          if(isset($_POST['save'])){
                            $name=$_POST['cat'];
$conn= mysqli_connect("localhost","root","","News") or die("Connection Failed");
$sql= "INSERT INTO category (category_name) VALUES('{$name}')" or die("Query Failed");
$result= mysqli_query($conn,$sql);
 header("location: http://localhost:8000/news-template%20html/news-template/admin/category.php");}





?>
                          <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>

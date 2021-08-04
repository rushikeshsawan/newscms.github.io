<?php include "header.php";
     $conn=mysqli_connect("localhost","root","","News");
                     
                      

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method ="POST">
                   
                      <div class="form-group">
                       <?php 
                        $id=$_GET['id'];
                   
                       $sql = "SELECT * FROM category WHERE category_id ='{$id}'";
                      
                        $result=mysqli_query($conn,$sql) or die("query failed");
                       
                       
                       
                       while($row=mysqli_fetch_assoc($result)){
                       echo mysqli_error($conn);
                        ?>
                          <input type="hidden" name="cat_id"  class="form-control" value="<?php echo $row['category_id'];  ?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                        
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $row['category_name']; ?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                      
                      
                  </form>
                  <?php } 
               $category_name=$_POST['cat_name'];
                      $id1=$_POST['cat_id'];
                     if (isset($_POST['submit'])) {
                     $sql1= "UPDATE category SET category_name='{$category_name}' WHERE category_id='{$id1}'";
                     $result1= mysqli_query($conn,$sql1) or die("query2 failed");
                        header("location: http://localhost:8000/news-template%20html/news-template/admin/category.php");
                      }
                  
                  
                  ?>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>

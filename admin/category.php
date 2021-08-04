<?php include "header.php";

if($_SESSION['role']== 0){
header("location: http://localhost:8000/news-template%20html/news-template/admin/post.php");
}



?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                      <?php 
                      $conn= mysqli_connect("localhost","root","","News");
                      $pages=$_GET['page'];
                      $limit=3;
                      
                      if($_GET['page']<=0){
                        $pages=1;
                      }else{
                        $pages=$_GET['page'];
                      }
                      $offset=($pages-1)*3;
                      $sql= "SELECT * FROM category ORDER BY category_id DESC LIMIT {$offset} ,{$limit} ";
                    
                      $result= mysqli_query($conn,$sql);
                       while($row=mysqli_fetch_assoc($result)){
                      ?>
                        <tr>
                            <td class='id'><?php echo $row['category_id']; ?></td>
                            <td><?php echo $row['category_name']; ?></td>
                            <td>
                         <?php echo $row['post']; ?>
                            </td>
                            <td class='edit'><a href='update-category.php?id=<?php echo $row['category_id']; ?>'><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='delete-category.php?id=<?php echo $row['category_id']; ?>'><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                        <tr>
                          <?php } ?>
                           
                    </tbody>
                </table>
                <ul class='pagination admin-pagination'>
                  <?php
                  $sql1= "SELECT * FROM category";
                  $result1=mysqli_query($conn,$sql1);
                  $limit= 3;
                  $page= ceil(mysqli_num_rows($result1)/3) ;
                  if($pages>1){
                    echo "<li><a href='category.php?page=($pages-1)'>Prev</a></li>";
                  }
                  for($i=1;$i<=$page;$i++){
                   //  <li class="active"><a>1</a></li>
                    echo "<li><a href='category.php?page=$i'>$i</a></li>";
                 
                  }
                 
                  if ($page > $pages) {
                   echo '<li><a href="category.php?page='.($pages +1).'">Next</a></li>';
                  }
                   ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>

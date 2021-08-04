<?php include "header.php";
if($_SESSION['role']== 0){
header("location: http://localhost:8000/news-template%20html/news-template/admin/post.php");
}

$limit=3;

if (isset($_GET['page'])) {
$page= $_GET['page'];
}else{
  $page=1;
  
}


$offset= ($page - 1) * $limit;


?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>
              <div class="col-md-12">
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                       <?php
                       $conn= mysqli_connect("localhost","root","","News") or die("connection failed");
                       $sql="SELECT * FROM user ORDER BY user_id DESC LIMIT {$offset}, {$limit} ";
                       $result=mysqli_query($conn,$sql) or die("query failed");
                       
                       while($row=mysqli_fetch_assoc($result)){
                         ?>
                        <tr>
                              <td class='user_id'><?php echo $row['user_id'] ; ?></td>
                              <td><?php echo $row['first_name'] . "".$row['last_name']; ?></td>
                              <td><?php echo $row['username'];?></td>
                              <td><?php if ($row['role'] == '0') {
                                $role='Normal';
                              }else{
                                $role='Admin';
                              }
                                echo $role;
                                ?></td>
                              <td class='edit'><a href='update-user.php?id=<?php echo $row['user_id'];?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-users.php?id=<?php echo $row['user_id'];?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                          <?php
                       }
                       $sql1= "SELECT * FROM user ";
                       $result1= mysqli_query($conn,$sql1);
                       $pages= ceil(mysqli_num_rows($result1)/$limit);
                       
                       
                       
                       ?>
                       
                 
                      </tbody>
                  </table>
                  
                  <?php
                   echo "<ul class='pagination admin-pagination'>";
                   if ($page > 1) {
                   echo '<li><a href="users.php?page='.($page -1).'">prev</a></li>';
                   }
                  
                  for ($i = 1; $i <= $pages; $i++) {
                        echo "<li><a href='users.php?page=$i'>$i</a></li>";
                  }
                  if ($pages > $page) {
                   echo '<li><a href="users.php?page='.($page +1).'">Next</a></li>';
                  }
                  
 //  <li class="active"><a>1</a></li>
                  ?>
                 
                   
                      
                      
                  </ul>
              </div>
          </div>
      </div>
  </div>


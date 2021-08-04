<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-post.php">add post</a>
              </div>
              <div class="col-md-12">
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                        <?php 
                        $conn= mysqli_connect("localhost","root","","News") or die("Connection Failed");
                       
                        $limit=3;

                     if (isset($_GET['page'])) {
                      $page= $_GET['page'];
                      }else{
                          $page=1;
  
                        }


                        $offset= ($page -1)*$limit;
                        session_start();
                        $userid=$_SESSION['user_id'];
                        $offset= ($page - 1)*3;
                       
                       if($_SESSION['role']==1)
                       { $sql= "SELECT * FROM post 
                       LEFT JOIN category ON post.category=category.category_id
                       LEFT JOIN user ON post. author=user.user_id
                       ORDER BY post_id DESC LIMIT {$offset}, {$limit} ";
                       }else {
                   $sql= "SELECT * FROM post
                       LEFT JOIN category ON post.category=category.category_id
                       LEFT JOIN user ON post. author=user.user_id
                   WHERE author='{$userid}' ORDER BY post_id DESC LIMIT {$offset}, {$limit} ";
                         
                       }
                        $result=mysqli_query($conn,$sql) or die("query failed");
                        mysqli_error($conn);
                        while($row=mysqli_fetch_assoc($result)){
                        
                        ?>
                          <tr>
                              <td class='id'><?php echo $row['post_id']; ?></td>
                              <td>
                        <?php echo $row['title']; ?>
                              </td>
                              <td>
                    <?php echo $row['category_name']; ?>
                              
                              </td>
                              <td>
                    <?php echo $row['post_date']; ?>
                              </td>
                              <td>
                     <?php echo $row['username']; ?>
                              </td>
                              <td class='edit'><a href='update-post.php?id=<?php echo $row['post_id']; 
                              ?>&cat= <?php echo $row['category_name']; ?>
                              '><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-post.php?id=<?php echo $row['post_id']; 
                              ?>&cat=<?php echo $row['category_name']; ?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                        <?php } 
                        
                        ?>
                      </tbody>
                  </table>
      <ul class='pagination admin-pagination'>
                  <?php 
                  if($_SESSION['role']==1){
                    $sql2="SELECT * FROM post";
                  }else{
                     $sql2="SELECT * FROM post WHERE author='{$userid}'";
                  }
                  
                  $result1= mysqli_query($conn,$sql2);
                  $pages=ceil(mysqli_num_rows($result1)/3);
                
                   if($page>1){
                   echo '<li><a href="post.php?page='.($page-1).'">Prev</a></li>';
    
                     }
                  
                  for ($i = 1; $i <= $pages; $i++) {
                  
                    
                        echo "<li><a href='post.php?page=$i'>$i</a></li>";
                  }
                 
                   if($pages>$page){
                   echo '<li><a href="post.php?page='.($page+1).'">Next</a></li>';
    
                     }
                      /*<li class="active"><a>1</a></li>
                      
                      <li><a>3</a></li>*/
                     
                      ?>
                  </ul>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>

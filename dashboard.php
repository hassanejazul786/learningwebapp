<?php
  session_start();
  include('db.php');
?>

<?php
function Add_notice(){
$msg=$err="";
global $conn;
 if($_SERVER["REQUEST_METHOD"] == "POST") {
  $subject=$_POST['subject'];
  $notice=mysqli_real_escape_string($conn, $_POST['notice']);
  $date=$_POST['date'];

  
  $sql="INSERT INTO notice(subject, notice, notice_date) VALUES('$subject', '$notice', '$date')";
  $res=mysqli_query($conn, $sql);
  if($res === True){
    $msg="Added Successfully";
    echo '<script type="text/javascript">noticetable();</script>';
  }else {
    echo "Error:".$sql."<br>". $conn->error;
  }
  $conn->close();
  }
?>
  <div class="container-fluid bg py-5">
    <div class="container">
      <div class="d-flex justify-content-center">
        <div class="card card2">
          <div class="card-header">
            <div class="card-header">
              <h3>Add Notice</h3>
            </div>
            <div class="card-body">
              <form name="notice" action="" method="post">
                <div class="input-group form-group">
                  <div class="input-group-prepend w-100">
                    <span class="input-group-text input-text2 rounded">Subject<span class="text-danger">*</span></span>
                  </div>
                  <input type="text" class="form-control" name="subject" placeholder="Enter subject of notice" required>
                </div>
                <div class="nicEdit-panelContain bg-white text-editor" unselectable="on">
                <div class="input-group form-group">
                  <div class="input-group-prepend w-100">
                    <span class="input-group-text input-text2 rounded">Notice<span class="text-danger">*</span></span>
                  </div>
                  
                    <textarea class="form-control" name="notice" rows="8" cols="80" placeholder="Enter Notice..."></textarea>
                  </div>    
                </div>
                <div class="input-group form-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text input-text">Date<span class="text-danger">*</span></span>
                  </div>
                  <input type="text" class="form-control" name="date" value="<?php echo date('Y-m-d'); ?>" readonly>
                </div>
                
                <div class="form-group text-center">
                  <input type="submit" name="submit" value="Add" class="btn login_btn">
                  <p class="h5 text-success my-2"><?php echo $msg;?></p>
                  <p class="h5 text-danger my-2"><?php echo $err;?></p>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php
}

function update_notice(){ ?>

  <div class="container-fluid py-2 px-3 bg-light">
    <h4>Update Notice</h4>
  </div>

  <div class="container-fluid table-responsive bg-white py-3">
    <table class="table table-striped table-hover table-light" id="summary">
      <thead class="thead-dark">
        <tr>
         <th scope="col">Sr.No.</th>
         <th scope="col">Notice_ID</th>
         <th scope="col">Subject</th>
         <th scope="col">Notice</th>
         <th scope="col">Date</th>
         <th scope="col">Edit</th>
         <th scope="col">Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $i=1;
        global $conn;
        $sql="SELECT * FROM notice ORDER BY ID DESC";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)>0){
          while($row=mysqli_fetch_assoc($result)){
            $id=$row['ID'];
            $subject=$row['subject'];
            $notice=$row['notice'];
            $date=$row['notice_date'];?>
            <tr>
              <th scope="row"><?php echo $i;?></th>
              <td><?php echo $id;?></td>
              <td><?php echo $subject;?></td>
              <td><?php
                 $string = $notice;
                 if (strlen($string) > 200) {
                  $trimstring = substr($string, 0, 200). ".......";
                  } else {
                  $trimstring = $string;
                  }
                   echo $trimstring;
                  ?>  
              </td>
              <td><?php echo $date;?></td>
              <td class="align-center">
                <a href="?edit&$id=<?php echo $id;?>" class="btn btn-success">Edit</a>
              </td>
             <td class="align-center">
                <a type="button" href="#" class="btn btn-danger deletebtn" >Delete</a>
              </td>
            </tr>
           <?php $i++;
          }
        }else{?>
          <tr><td colspan="12">No Notice(s) Found.....</td></tr>
          <?php
        }?>
      </tbody>
    </table>
  </div> 


  <div class="modal fade" id="delete1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="" method="POST">
          <div class="modal-body">
           <input type="hidden" name="del1" id="del1">
           </h5>Select "Delete" below if you want to delete this blog<h5>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" type="submit" name="delnotice">Delete</a>
          </div>
        </form>
      </div>
    </div>
  </div> 

  <?php
}


function edit_notice($id){
 global $conn;
 $query="SELECT * FROM notice WHERE ID='$id'";
 $result=mysqli_query($conn, $query);
 $row=mysqli_fetch_assoc($result);
 ?>
 <?php
 $title=$desc=$author=$date=$msg=$msg2="";
 if($_SERVER["REQUEST_METHOD"] == "POST") { 
    $subject=$_POST['subject']; 
    $notice=mysqli_real_escape_string($conn, $_POST['notice']);
    $date=$_POST['date'];
   
      
  $sql="UPDATE notice SET subject='$subject', notice='$notice', notice_date='$date' WHERE ID='$id'";
  if($conn->query($sql) === True) {
   $msg2="Successfully Updated Notice";
   echo '<script type="text/javascript">noticetable();</script>';
  }
  else
  {
    echo "Error:".$sql."<br>". $conn->error;
  }     
    
  }   
?>

   
  <div class="container-fluid bg py-5">
    <!--<div class="container py-5">-->
      <div class="d-flex justify-content-center">
        <div class="card card2">
          <div class="card-header">
            <div class="card-header">
              <h3>Edit Notice</h3>
            </div>
            <div class="card-body">

             <form name="notice" action="" method="POST">
                <div class="input-group form-group">
                    <div class="input-group-prepend w-100">
                      <span class="input-group-text input-text2 rounded">Subject<span class="text-danger">*</span></span>
                    </div>
                    <input type="text" class="form-control" name="subject" placeholder="Enter subject" value="<?php echo $row['subject']; ?>" required>
                    <span class="h5 text-danger my-1"><?php echo $msg;?></span>
                </div>
                
                <div class="nicEdit-panelContain bg-white text-editor" unselectable="on">
                <div class="input-group form-group">
                    <div class="input-group-prepend w-100">
                      <span class="input-group-text input-text2 rounded">Notice<span class="text-danger">*</span></span>
                    </div>
                    
                    <textarea class="form-control" name="notice" rows="8" cols="80" ><?php echo $row['notice']; ?></textarea></div>
                </div>

                <div class="input-group form-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text input-text">Date<span class="text-danger">*</span></span>
                  </div>
                  <input type="text" class="form-control" name="date" value="<?php echo $row['notice_date']; ?>" readonly required>
                </div>
                <div class="form-group text-center">
                  <input type="submit" name="submit" value="Update" class="btn login_btn">
                  <p class="h5 text-success my-2"><?php echo $msg2;?></p>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    <!--</div>-->
  </div>
<?php 
}

function delete_notice($id){         
  global $conn;
  $sql="DELETE FROM notice WHERE ID='$id'";
  if($conn->query($sql) === True) {
    echo '<script type="text/javascript">noticetable();</script>';
  }
  else
  {
     echo "Error:".$sql."<br>". $conn->error;
  } 
 
  
}

function view_notice(){         
  global $conn;
  ?>
  <h2 class="mx-3">Latest Notice</h2>
  <?php 
  $sql="SELECT * FROM notice ORDER BY ID DESC";
  $res=mysqli_query($conn, $sql);
  while($row=mysqli_fetch_array($res)) {
    ?>
    <div class="mx-3 my-3">
     <hr class="bg-primary">
     <h3><?php echo $row['subject']; ?></h3>
     Date:<span><?php echo $row['notice_date']; ?></span><hr>
     <?php $string = $row['notice'];
       if (strlen($string) > 500) {
        $trimstring = substr($string, 0, 500). ".......";
       } else {
       $trimstring = $string;
      }
      echo $trimstring;
      ?>
     <?php $id=$row['ID']; ?>
     <a class="btn btn-warning btn-sm" href="?notice&$id=<?php echo $id; ?>">View</a>
    </div>

    
  <?php 
  }
  
}

function view_notices($id){
  global $conn;
  $sql="SELECT * FROM notice WHERE ID=$id";
  $res=mysqli_query($conn, $sql);
  $row=mysqli_fetch_array($res);
?>
<div class="container-fluid py-3">
  <div class="mx-3">
     <h3><?php echo $row['subject']; ?></h3>
     Date:<span><?php echo $row['notice_date']; ?></span><hr>
     <p><?php echo $row['notice']; ?></p>
  </div>
</div>
<?php
}

function Add_notes(){
$msg=$err="";
global $conn;
 if($_SERVER["REQUEST_METHOD"] == "POST") {
  $subject=$_POST['subject'];
  $uploader=$_POST['uploader'];
  $date=$_POST['date'];

  
  $target_dir="uploads/";
  $file=$_FILES["file"]["name"];
  $filen=explode(".",$file);
  $extension=end($filen);
  $target_file=$target_dir.$filen[0].".".$filen[1];
  $temp=$_FILES["file"]["tmp_name"]; 
  $move=move_uploaded_file($temp, $target_file);
   if($move){
     $sql="INSERT INTO materials(subject, uploaded_by, upload_date, filename) VALUES('$subject', '$uploader', '$date', '$file')";
     $res=mysqli_query($conn, $sql);
     if($res === True){
       $msg="Added Successfully";
       /*echo '<script type="text/javascript">noticetable();</script>';*/
      }else {
        $err="Error:".$sql."<br>". $conn->error;
      }
       $conn->close();
   }
   else{
    $err="failed try again...";
   }
 }  

  
?>
  <div class="container-fluid bg py-5">
    <div class="container">
      <div class="d-flex justify-content-center">
        <div class="card card2">
          <div class="card-header">
            <div class="card-header">
              <h3>Add Study Material</h3>
            </div>
            <div class="card-body">
              <form name="notes" action="" method="post" enctype="multipart/form-data">
                <div class="input-group form-group">
                  <div class="input-group-prepend w-100">
                    <span class="input-group-text input-text2 rounded">Subject<span class="text-danger">*</span></span>
                  </div>
                  <select class="form-control" name="subject" required>
                    <option value="" disabled hidden selected>Select Subject</option>
                    <option value="English">English</option>
                    <option value="Maths">Maths</option>
                    <option value="Physics">Physics</option>
                    <option value="Chemistry">Chemistry</option>
                  </select>
                </div>
                
                <div class="input-group form-group">
                  <div class="input-group-prepend w-100">
                    <span class="input-group-text input-text2 rounded">Upload File<span class="text-danger">*</span></span>
                  </div>
                  <input type="file" class="form-control-file bg-white" name="file" id="files" accept=".jpg,.jpeg,.png,.docs,.docx,.pdf,.mp4" required>
                </div>

                <div class="input-group form-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text input-text">Uploaded by<span class="text-danger">*</span></span>
                  </div>
                  <input type="text" class="form-control" name="uploader" value="<?php echo $_SESSION["user"]["name"]; ?>" readonly>
                </div>
                <div class="input-group form-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text input-text">Date<span class="text-danger">*</span></span>
                  </div>
                  <input type="text" class="form-control" name="date" value="<?php echo date('Y-m-d'); ?>" readonly>
                </div>
                
                <div class="form-group text-center">
                  <input type="submit" name="submit" value="Upload" class="btn login_btn">
                  <p class="h5 text-success my-2"><?php echo $msg;?></p>
                  <p class="h5 text-danger my-2"><?php echo $err;?></p>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php


}

function view_notes(){ ?>
  <div class="container bg py-5">
      <div class="d-flex justify-content-center">
        <div class="card card2">
          <div class="card-header text-center">
            <h3>Study Materials</h3>
          </div>
          <div class="card-body">
            <div class="d-flex justify-content-center">
              <a class="btn login_btn w-50" href="?eng">English Study Materials</a>
            </div>
            <br>
            <div class="d-flex justify-content-center">
              <a class="btn login_btn w-50" href="?maths">Maths Study Materials</a>
            </div>
            <br>
            <div class="d-flex justify-content-center">
              <a class="btn login_btn w-50" href="?phy">Physics Study Materials</a>
            </div>
            <br>
            <div class="d-flex justify-content-center">
              <a class="btn login_btn w-50" href="?chem">Chemistry Study Materials</a>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php
}

function view_files($subject){
  ?>
<div class="container-fluid py-2 px-3 bg-light">
    <h4>Study Materials</h4>
  </div>

  <div class="container-fluid table-responsive bg-white py-3">
    <table class="table table-striped table-hover table-light" id="summary">
      <thead class="thead-dark">
        <tr>
         <th scope="col">Sr.No.</th>
         <th scope="col">Uploaded By</th>
         <th scope="col">Upload Date</th>
         <th scope="col">Filename</th>
         <th scope="col">View</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $i=1;
        global $conn;
        $sql="SELECT * FROM materials WHERE subject='$subject' ORDER BY ID ASC";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)>0){
          while($row=mysqli_fetch_assoc($result)){
            $id=$row['ID'];
            $subject=$row['subject'];
            $uploaded_by=$row['uploaded_by'];
            $date=$row['upload_date'];
            $filename=$row['filename'];
            $target_file="uploads/".$filename;?>
            <tr>
              <th scope="row"><?php echo $i;?></th>
              <td><?php echo $uploaded_by;?></td>
              <td><?php echo $date?></td>
              <td><?php echo $filename;?></td>
              <td class="align-center">
                <a href="<?php echo $target_file; ?>" class="btn btn-warning">View</a>
              </td>
           <?php $i++;
          }
        }else{?>
          <tr><td colspan="12">No Notice(s) Found.....</td></tr>
          <?php
        }?>
      </tbody>
    </table>
  </div> 
<?php
}


function Add_topic(){
 $msg=$err="";
 global $conn;
 if($_SERVER["REQUEST_METHOD"] == "POST") {
  $title=$_POST['title'];
  $subject=$_POST['subject'];
  $desc=mysqli_real_escape_string($conn, $_POST['desc']);
  $uploader=$_POST['uploader'];
  $date=$_POST['date'];

  
  $sql="INSERT INTO topics(topic_subject, topic_by, topic_title, topic_desc, topic_date) VALUES('$subject', '$uploader', '$title', '$desc', '$date')";
  $res=mysqli_query($conn, $sql);
  if($res === True){
    $msg="Added Successfully";
  }else {
    echo "Error:".$sql."<br>". $conn->error;
  }
  $conn->close();
  }
?>
  <div class="container-fluid bg py-5">
    <div class="container">
      <div class="d-flex justify-content-center">
        <div class="card card2">
          <div class="card-header">
            <div class="card-header">
              <h3>Add Topic</h3>
            </div>
            <div class="card-body">
              <form name="topic" action="" method="post" >

                <div class="input-group form-group">
                  <div class="input-group-prepend w-100">
                    <span class="input-group-text input-text2 rounded">Title<span class="text-danger">*</span></span>
                  </div>
                  <input type="text" class="form-control" name="title"  required>
                </div>

                <div class="input-group form-group">
                  <div class="input-group-prepend w-100">
                    <span class="input-group-text input-text2 rounded">Subject<span class="text-danger">*</span></span>
                  </div>
                  <select class="form-control" name="subject" required>
                    <option value="" disabled hidden selected>Select Subject</option>
                    <option value="English">English</option>
                    <option value="Maths">Maths</option>
                    <option value="Physics">Physics</option>
                    <option value="Chemistry">Chemistry</option>
                  </select>
                </div>

                <div class="nicEdit-panelContain bg-white text-editor" unselectable="on">
                <div class="input-group form-group">
                  <div class="input-group-prepend w-100">
                    <span class="input-group-text input-text2 rounded">Description<span class="text-danger"></span></span>
                  </div>
                  <textarea class="form-control" name="desc" rows="6" cols="80"></textarea>
                </div>
                </div>
               
                  <input type="hidden" class="form-control" name="uploader" value="<?php echo $_SESSION["user"]["name"]; ?>" readonly>
                  <input type="hidden" class="form-control" name="date" value="<?php echo date('Y-m-d'); ?>" readonly>
                
                
                <div class="form-group text-center">
                  <input type="submit" name="submit" value="Post" class="btn login_btn">
                  <p class="h5 text-success my-2"><?php echo $msg;?></p>
                  <p class="h5 text-danger my-2"><?php echo $err;?></p>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php
}

function view_topic(){?>
  <div class="container bg py-5">
      <div class="d-flex justify-content-center">
        <div class="card card2">
          <div class="card-header text-center">
            <h3>Discussion Subjects</h3>
          </div>
          <div class="card-body">
            <div class="d-flex justify-content-center">
              <a class="btn login_btn w-50" href="?eng2">English Discussion</a>
            </div>
            <br>
            <div class="d-flex justify-content-center">
              <a class="btn login_btn w-50" href="?maths2">Maths Discussion</a>
            </div>
            <br>
            <div class="d-flex justify-content-center">
              <a class="btn login_btn w-50" href="?phy2">Physics Discussion</a>
            </div>
            <br>
            <div class="d-flex justify-content-center">
              <a class="btn login_btn w-50" href="?chem2">Chemistry Discussion</a>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php
}

function view_discussion($subject){
  global $conn;
  ?>
  <h2 class="mx-3 my-3">Latest Discussion</h2>
  <hr class="mx-3 bg-primary">
  <?php 
  $sql="SELECT * FROM topics WHERE topic_subject='$subject' ORDER BY ID DESC";
  $res=mysqli_query($conn, $sql);
  $num=mysqli_num_rows($res);
  if($num==0){?>
    <h4 class="mx-3">No Discussion(s) Found</h4>
  <?php
  }
  while($row=mysqli_fetch_array($res)) {
    ?>
    <a href="?disc&$id=<?php echo $row['ID'];?>" class="text-decoration-none text-dark">
    <div class="mx-3 my-3">
     <h4 class="text-dark"><?php echo $row['topic_title']; ?></h4>
     Asked by:<span><?php echo $row['topic_by']; ?></span><br>
     Date:<span><?php echo $row['topic_date']; ?></span><br><hr>
     <p><?php echo $row['topic_desc'];?></p> 
      <hr class="bg-primary">
    </div>
    </a>
  <?php
  } 
}

function posts($id){
  global $conn;
  $sql="SELECT * FROM posts WHERE post_topic='$id' ORDER BY ID ASC";
  $res=mysqli_query($conn, $sql);
  $num=mysqli_num_rows($res);?>
  <h3 class="mx-3 my-3"><?php echo $num." "."reply(s)";?></h3>
  <hr class="mx-3 bg-dark">
  <?php
  while($row=mysqli_fetch_array($res)) {
    ?>
    <div class="mx-3 my-3">
     Reply by:<span><?php echo $row['post_by']; ?></span><br>
     Date:<span><?php echo $row['post_date']; ?></span><br><hr>
     <p><?php echo $row['post_cont'];?></p> 
     <hr class="bg-primary">
    </div>
  <?php
  } ?>
  <form name="replyform" action="reply.php" method="post">
  <div class="mx-2 col-6">
  <h3>Reply</h3><br>
  <div class="nicEdit-panelContain bg-white text-editor" unselectable="on">
    <textarea name="reply" class="form-control rows="6" cols="30"></textarea>
  </div>
  <input type="hidden" name="uploader" value="<?php echo $_SESSION["user"]["name"]; ?>">
  <input type="hidden" name="date" value="<?php echo date('Y-m-d'); ?>">
  <input type="hidden" name="topic" value="<?php echo $id; ?>">
  <input type="submit" class="my-2 btn btn-success text-center">
  </div>
  </form>
  <?php
  
}

function guide(){?>
  <div class="d-block h-75 bg-gradient-info text-white">
    <h3 class="py-3 text-center">User Guide</h3><hr>
    <pre class="text-white">
      1.Users can register as Student, Teacher or Parents.
      2.Students can create discussions based on the subject matter.
      3.Students can reply to discussion topics based on the subject matter.
      4.Students can get study materials and related documents, videos, images
        uploaded by parents/teachers.
      5.Parents can view the notice board for any announcement (like snow/rainy
        day holidays, reports cards, fee due dates, attendance as well as upcoming 
        school events) uploaded by teachers.
      6.Parents/Teachers can upload photos, videos and other files that they may 
        feel are important for children’s education.
    </pre>
  </div>
<?php
}

function home(){?>
  
  <div class="col-lg-12">
    <h1>Hello!!</h1>
    <div class="alert alert-success" role="alert">
     <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
     <strong><span class="fa fa-bullhorn fa-2x"></span> </strong> <strong>&nbsp;&nbsp;Welcome to Dashboard!!</strong>.
    </div>          
  </div>
 
  <!--cards-->
 <!--<div class="row mx-2 my-3">
    <div class="col-lg-4 mb-2">
      <div class="card">
        <div class="card-body blogs-color">
          <div class="row px-3 py-3">
            <div class="col-6">
              <i class="fa fa-rss fa-5x"></i>
            </div>
            <div class="col-6 text-right">
              <p class="h1"></p>
              <p class="h4"><strong>Blogs</strong></p>
            </div>
          </div>
        </div>
        <a href="?readblog">
        <div class="card-footer">
          <div class="row">
            <div class="col-6">
              View
            </div>
            <div class="col-6 text-right">
             <i class="fa fa-arrow-circle-right"></i>
            </div>
          </div>
        </div>
        </a>
      </div>
    </div>
    <div class="col-lg-4 mb-2">
      <div class="card">
        <div class="card-body bloggers-color">
          <div class="row px-3 py-3">
            <div class="col-6">
              <i class="fab fa-blogger fa-5x"></i>
            </div>
            <div class="col-6 text-right">
              <p class="h1"></p>
              <p class="h4"><strong>Bloggers</strong></p>
            </div>
          </div>
        </div>
        <a href="?viewbloggers">
        <div class="card-footer announcement-bottom">
          <div class="row">
            <div class="col-6">
              View
            </div>
            <div class="col-6 text-right">
             <i class="fa fa-arrow-circle-right"></i>
            </div>
          </div>
        </div>
        </a>
      </div>
    </div>
    <div class="col-lg-4 mb-2">
      <div class="card">
        <div class="card-body users-color">
          <div class="row px-3 py-3">
            <div class="col-6">
              <i class="fas fa-users fa-5x"></i>
            </div>
            <div class="col-6 text-right">
              <p class="h1"></p>
              <p class="h4"><strong>Users</strong></p>
            </div>
          </div>
        </div>
        <a href="?viewusers">
        <div class="card-footer announcement-bottom">
          <div class="row">
            <div class="col-6">
              View
            </div>
            <div class="col-6 text-right">
             <i class="fa fa-arrow-circle-right"></i>
            </div>
          </div>
        </div>
        </a>
      </div>
    </div>
  </div> -->
  <!-- /cards-->
  <?php
}
?>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link href="CSS/dashboard.css" rel="stylesheet" >
    <link href="CSS/style3.css" rel="stylesheet" >
    <link href="CSS/mediaquery2.css" rel="stylesheet" >
    

    <!-- Custom fonts for this template-->
    <!--<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script type="text/javascript" src="javascript/functions.js"></script>
    <script type="text/javascript" src="javascript/blogvalidation.js"></script>
  


  </head>
  <body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
       
      <!-- Sidebar -->
      <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
          <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-book"></i>
          </div>
          <div class="sidebar-brand-text mx-3">Learning</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
          <a class="nav-link" href="dashboard.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
          Interface
        </div>

        <?php if($_SESSION['type']=='Parent'){?>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="?viewnotice" >
            <i class="fas fa-sticky-note"></i>
            <span>View Notice Board</span>
          </a>
        </li>
      <?php }

      if($_SESSION['type']=='Teacher'){?>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-sticky-note"></i>
            <span>Notice Board</span>
          </a>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Sub Menus</h6>
              <a class="collapse-item" href="?Addnotice" >Add Notice</a>
              <a class="collapse-item" href="?updatenotice" >Update Notice</a>
              <a class="collapse-item" href="?viewnotice">View Notice</a>
            </div>
          </div>
        </li>
      <?php }
         
        if($_SESSION['type']=='Student'){?>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
            <i class="fas fa-pen"></i>
            <span>Student Forum</span>
          </a>
          <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Sub Menus</h6>
              <a class="collapse-item" href="?Addtopic" >Add topics</a>
              <a class="collapse-item" href="?viewtopic">View Discussion</a>
            </div>
          </div>
        </li>

         <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="?viewnotes">
            <i class="fas fa-book-open"></i>
            <span>View Study Materials</span>
          </a>
        </li>
        <?php }

       if($_SESSION['type']=='Parent' || $_SESSION['type']=='Teacher'){?>
       <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
            <i class="fas fa-book-open"></i>
            <span>Study Material</span>
          </a>
          <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Sub Menus</h6>
              <a class="collapse-item" href="?Addnotes" >Add Study Materials</a>
              <a class="collapse-item" href="?viewnotes">View Study Materials</a>
            </div>
          </div>
        </li>
        <?php }?>

        <!-- Nav Item - Utilities Collapse Menu -->
        <!--<li class="nav-item">
          <a class="nav-link collapsed" href="#">
            <i class="fas fa-hands-helping"></i>
            <span>Help</span>
          </a>
        </li>-->

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="?guide">
            <i class="fab fa-readme"></i>
            <span>Guide</span>
          </a>
        </li>
        

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
      </ul>
      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content" class="">
          <!-- Topbar -->
          <nav class="navbar navbar-expand navbar-light bg-gradient-primary topbar position-static static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
              <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
            <div class="topbar-divider d-none d-sm-block"></div>

              <!-- Nav Item - User Information -->
              <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="mr-2 d-none d-lg-inline text-white-600 small">
                    <?php if(isset($_SESSION['user'])){ 
                        echo $_SESSION['user']['name']." "."(".$_SESSION['type'].")";
                      } 
                    ?></span>
                  <img class="img-profile rounded-circle" src="image/user.png">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                  </a>
                </div>
              </li>
            </ul>
          </nav>
          <!-- End of Topbar -->
           
          <?php
          if(isset($_GET['Addnotice'])){
           Add_notice();
          }

          else if(isset($_GET['updatenotice'])){
           update_notice();
          }
          else if(isset($_GET['viewnotice'])){
          view_notice();
          }
          else if(isset($_GET['Addnotes'])){
           Add_notes();
          }
          else if(isset($_GET['viewnotes'])){
          view_notes();
          }

          else if(isset($_GET['edit'])){
            $id=$_GET['$id'];
            edit_notice($id);
          }
     
          else if(isset($_GET['eng'])){
            $subject="English";
            view_files($subject);
          }
          
          else if(isset($_GET['maths'])){
            $subject="Maths";
            view_files($subject);
          }
          else if(isset($_GET['phy'])){
            $subject="Physics";
            view_files($subject);
          }
          else if(isset($_GET['chem'])){
            $subject="Chemistry";
            view_files($subject);
          }


          else if(isset($_GET['eng2'])){
            $subject="English";
            view_discussion($subject);
          }
          
          else if(isset($_GET['maths2'])){
            $subject="Maths";
            view_discussion($subject);
          }
          else if(isset($_GET['phy2'])){
            $subject="Physics";
            view_discussion($subject);
          }
          else if(isset($_GET['chem2'])){
            $subject="Chemistry";
            view_discussion($subject);
          }

          else if(isset($_GET['disc'])){
            $id=$_GET['$id'];
            posts($id);
          }

          else if(isset($_GET['notice'])){
            $id=$_GET['$id'];
            view_notices($id);
          }
          else if(isset($_GET['Addtopic'])){
            Add_topic();
          }
          else if(isset($_GET['viewtopic'])){
            view_topic();
          }
          else if(isset($_GET['guide'])){
            guide();
          }

          else{
            home();
          }

          
          if(isset($_POST['delnotice'])){
            $id=$_POST['del1'];
            /*$sql="SELECT * FROM notice WHERE subject='$subject'";
            $res=mysqli_query($conn,$sql);
            $row=mysqli_fetch_assoc($res);
            $id=$row['ID'];*/
            delete_notice($id);
          }

          ?>
           
        </div>
        <!-- End of Main Content -->
    

        <!-- Footer -->
        <footer class="sticky-footer bg-gradient-primary">
          <div class="container my-auto">
            <div class="copyright text-white text-center my-auto">
              <span>Copyright &copy; All rights reserved 2020</span>
            </div>
          </div>
        </footer>
        <!-- End of Footer -->

      </div>
      <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->
    
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-success" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-danger" href="index.php">Logout</a>
          </div>
        </div>
      </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <!--<script src="vendor/jquery-easing/jquery.easing.min.js"></script>-->

    <!-- Custom scripts for all pages-->
    <script src="javascript/sb-admin-2.min.js"></script>

    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-bootstrap/0.5pre/js/jquery-1.8.3.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="javascript/tables.js"></script>
    <script type="text/javascript" src="javascript/popup.js"></script>
    <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>
    <script type="text/javascript"> bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });</script>
  </body>
</html>
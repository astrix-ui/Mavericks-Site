<?php 
// Include the database configuration file  
require_once 'dbconfig.php'; 
 session_start();
 $user=$_SESSION['user'];
// If file upload form is submitted 
$status = $statusMsg = ''; 
if(isset($_POST["submit"])){ 
    $status = 'error'; 
    if(!empty($_FILES["postimage"]["name"])) { 
        // Get file info 
        $fileName = basename($_FILES["postimage"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
        
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            $image = $_FILES['postimage']['tmp_name']; 
            $imgContent = addslashes(file_get_contents($image)); 
            $caption=$_POST['Caption'];
        
            // Insert image content into database 
            $insert = "INSERT into posts (username, image, caption, date_time) VALUES ('$user', '$imgContent', '$caption', NOW())";
            mysqli_query($conn,$insert); 
             
            if($insert){ 
                $status = 'success'; 
                $statusMsg = "File uploaded successfully."; 
                header("location:index.php");
            }else{ 
                $statusMsg = "File upload failed, please try again."; 
            }  
        }else{ 
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
        } 
    }else{ 
        $statusMsg = 'Please select an image file to upload.'; 
    } 
} 
 
// Display status message 
// echo $statusMsg; 
?>
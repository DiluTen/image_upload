<?php
//include the database configuration file
include 'db.php';
$statusMsg = '';
//file upload directory
$targetDir = "uploads/";

if(isset($_POST["submit"])){
    if(!empty($_FILES["file"] ["name"])){
        $fileName = basename($_FILES["file"]["name"]);
        $fileSize = $_FILES["file"]["size"];
        $fileSizeKB = $fileSize/1024;
        $filesizeKBRoundVal = round($fileSizeKB,5);
        //$fileSizeMB = $fileSizeKB/1024;

        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

        //Limit file formats
        // $allowFileTypes = array('jpg','png','jpeg','gif','pdf','jfif');
        //echo $allowFileTypes;
       $allowFileTypes = array('jpg','png','pdf');
        if(in_array($fileType,$allowFileTypes)){
            //upload file to server
            if(move_uploaded_file($_FILES["file"]["tmp_name"],$targetFilePath)){
                //insert image file into the database
               //$insert = $db->query("INSERT into image_load (file_name, uploaded_time) VALUES ('".$fileName."',NOW())");

               $insert = $db->query("INSERT into image_load (file_name, uploaded_time,file_size) VALUES ('".$fileName."', NOW(), '".$filesizeKBRoundVal." KB')");
                if($insert){
                    $statusMsg = "The file ".$fileName. " has been uploaded successfully.";                    
                }else{
                    $statusMsg = "File uploading process failed,please try again";                    
                }
            }else{
                $statusMsg = "Process terminated. There was an error uploading your file.";                
            }
        }else{
            $statusMsg = "Wrong file name. Only JPG,PNG and PDF files are allowed to upload";            
        }
    }else{
        $statusMsg = "Select a file to upload";
    }
}
?>

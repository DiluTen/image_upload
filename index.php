<?php
include "upload.php";
?>


<!DOCTYPE html>
<html lang= "en-us">
    <head>
        <style>
            .button {
                background-color: #4CAF50; /* Green */
                border: none;
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                cursor: pointer;
                border-radius: 8px;
            }
            h2{
                color: #006400;
            }
            .paraclass{
                color: #A70D2A;
                font-size: 18px;
            }

            .frmcolor{
                color: #006400;
                font-weight: bold;
                font-size: 18px;
            }
            .fileview{
                font-style: italic;
                font-size: 16px;
            }

        .status-msg{
            color: #F75D59;
            font-weight: bold;
            font-size: 18px;
        }

        </style>
        <title> Image upload and save them in the database </title>
        <meta charset = "utf-8">
    <!--    <link rel = "stylesheet" href="css/cssstyle.css">  -->
    </head>
    <body> 
        <div class = "imgcontainer">
            <div class = "fileloader"> 
                <?php
                if(!empty($statusMsg)){?>
                    <p class="status-msg" > <?php echo $statusMsg;?> </p>
                    <?php  } ?>
           
                <form class = "frmcolor" action = "" method = "post" autocomplete = "off" enctype="multipart/form-data">
                    Select image file to upload:
                    <input class = "fileview" type="file" name="file">
                    <input class = "button" type="submit" name="submit" value="Upload">
                </form>
            </div>
        <div class="gallery">
            <div class ="imagecontainer">
                <hr>
                <h2>Uploaded Image Viewer</h2>
                <?php 
                //include the database config file
                include "db.php";

                //get images from the database
                $query = $db->query("select * from image_load ORDER BY uploaded_time DESC");

                if($query->num_rows > 0){
                    while($row = $query->fetch_assoc()){
                        $imageURL = 'uploads/'.$row["file_name"];
                        ?>
                       <img src = "<?php echo $imageURL; ?>" alt = " " /> 
                    <?php 
                    } 
                }else{
                    ?>
                      <p class="paraclass"> Not any images available to exist </p>
                <?php 
                }
                ?>
                
            </div>
        </div>
        </div>
    </body>
</html>


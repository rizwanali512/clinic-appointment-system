<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='a'){
            header("location: ../login.php");
        }

    }else{
        header("location: ../login.php");
    }
    
    
    if($_POST){
        if (isset($_POST["title"]) && isset($_FILES["file"])) {
            $title = $_POST["title"];
            $file_name = $_FILES["file"]["name"];
            $file_tmp = $_FILES["file"]["tmp_name"];
            $file_type = $_FILES["file"]["type"];
            $file_size = $_FILES["file"]["size"];
            $file_error = $_FILES["file"]["error"];
    
            // Validate file size and type
            if ($file_size > 15242880) {
                // File size is too large
                echo "Error: File size is too large.";
            } else {
                // Check if file already exists in uploads folder
                if (file_exists("uploads/" . $file_name)) {
                    // File already exists
                    echo "Error: File already exists.";
                } else {
                    // Move uploaded file to uploads folder
                    move_uploaded_file($file_tmp, "uploads/" . $file_name);
    
                    // Insert file details into database
                    include("../connection.php");
                    $title = $_POST["title"];
                    $url = $_POST["url"];
                    // Prepare insert statement
                    $sql="insert into VideosContent (title,url,file) values ('" . $title . "','" . $url . "','$file_name');";
                    $result= $database->query($sql);
                    if ($result === TRUE) {
                        echo "New record created successfully";
                      } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($database);
                    }
                     // File uploaded and details inserted into database
                    // echo "File uploaded successfully!";
                    header("location: videos.php?action=add&error=".$error);
                 }
            }
        } else {
            // Required input fields are missing
            echo "Error: Please fill in all required fields.";
        }



         
        
    }


?>
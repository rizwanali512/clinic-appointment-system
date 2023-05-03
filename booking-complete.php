<?php

    //learn from w3schools.com

    session_start();

    // if(isset($_SESSION["user"])){
    //     if(($_SESSION["user"])=="" or $_SESSION['usertype']!='p'){
    //         header("location: ../login.php");
    //     }else{
    //         $useremail=$_SESSION["user"];
    //     }

    // }else{
    //     header("location: ../login.php");
    // }
    

    //import database
    include("./connection.php");
    // $userrow = $database->query("select * from patient where pemail='$useremail'");
    // $userfetch=$userrow->fetch_assoc();
    // $userid= $userfetch["pid"];
    // $username=$userfetch["pname"];
    if($_POST){
        if(isset($_POST["booknow"])){
            // $apponum=3;
            // $scheduleid=$_POST["scheduleid"];
            $name=$_POST["name"];
            $email=$_POST["email"];
            $cell=$_POST["cell"];
            $type=$_POST["type"];
            $time=$_POST["time"];
            $date=$_POST["date"];
             $sql2="insert into PatientAppointments(name,email,cell,type,date,time) values ('" . $name . "','" . $email . "','" . $cell . "', '" . $type . "',STR_TO_DATE('" . $date . "', '%Y-%m-%d'),STR_TO_DATE('" . $time . "', '%H:%i'))";
              $result= $database->query($sql2);
             if ($result === TRUE) {
                echo "New record created successfully";
              } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($database);
            }
            
             //echo $apponom;
            header("location: index.html");

        }
    }
 ?>
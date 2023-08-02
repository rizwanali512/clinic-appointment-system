<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';


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
            $mail = new PHPMailer();

            $mail->isSMTP();
            $mail->Host= 'smtp.gmail.com';
            $mail->SMTPAuth= 'true';
            $mail->Username= 'dermadenlaserclinic@gmail.com';
            $mail->Password= 'yqmnqddpsiihxfaj';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('dermadenlaserclinic@gmail.com');
            $mail->addAddress("dermadenlaserclinic@gmail.com");
            // $mail->isHTML(true);
            $mail->Subject = 'Dermaden Laser Clinic - New Appointment Booked for ' . $_POST["type"] . '';
            $mail->Body = '
            Hey!

            It is to notify you that an appointment has been booked with ' . $_POST["name"] . ' for ' . $_POST["date"] . ' at ' . $_POST["time"] . ' EST (GMT -4). 
            
            Contact No.: ' . $_POST["cell"] .

            '
            
            This is an automatically generated email. Please do not reply to this email.

            Dermaden Laser Clinic
            ';

            // Send the email
            if ($mail->send()) {
                echo 'Email sent successfully!';
                // return;
            } else {
                echo 'Error sending email. Error message: ' . $mail->ErrorInfo;
                // return;
            }


            $mail1 = new PHPMailer();

            $mail1->isSMTP();
            $mail1->Host= 'smtp.gmail.com';
            $mail1->SMTPAuth= 'true';
            $mail1->Username= 'dermadenlaserclinic@gmail.com';
            $mail1->Password= 'yqmnqddpsiihxfaj';
            $mail1->SMTPSecure = 'ssl';
            $mail1->Port = 465;

            $mail1->setFrom('dermadenlaserclinic@gmail.com');
            $mail1->addAddress($_POST["email"]);
            // $mail->isHTML(true);
            $mail1->Subject = 'Dermaden Laser Clinic - Appointment Scheduled for ' . $_POST["type"] . '';
            $mail1->Body = '
            Hey!

            Thankyou for showing interest in Dermaden Laser Clinic.
            
            It is to notify you that your appointment has been booked with our skin care specialists for ' . $_POST["date"] . ' at ' . $_POST["time"] . ' EST (GMT -4). 
            
            We hope to see you soon!
            
            This is an automatically generated email. Please do not reply to this email.

            Dermaden Laser Clinic
            ';

            // Send the email
            if ($mail1->send()) {
                echo 'Email sent successfully!';
                // return;
            } else {
                echo 'Error sending email. Error message: ' . $mail->ErrorInfo;
                // return;
            }


 
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
<?php
    session_start();
    include 'autoloader.php';
    // $id = $_SESSION['user_id'];
    $conn = DB_OP::get_connection();
    // $user = unserialize($conn->get_column_value("user_details", "user_id", "=", $_SESSION['user_id'], "u_object", ""));
    // $user->set_db($conn);
    // $user->set_row_id($_SESSION['user_id']);
    $application = unserialize($conn->get_column_value("application_details", "app_id", "=", $_SESSION['application_id'], "application_object", ""));
    // $application = $applicant->getApplication();


    $folderPath = "uploads/";
    $image_parts = explode(";base64,", $_POST['signed']); 
    $image_type_aux = explode("image/", $image_parts[0]);
    $image_type = $image_type_aux[1];
    $image_base64 = base64_decode($image_parts[1]);
    $file = $folderPath . uniqid() . '.'.$image_type;
    file_put_contents($file, $image_base64);
    echo "Signature Uploaded Successfully.";

    if($_GET['sign_no']==1){
        $application->setApplicantSign($file);
    }
    elseif($_GET['sign_no']==2){
        $application->setRapSign($file);
    }
    elseif($_GET['sign_no']==3){
        $application->setDsSign($file);
    }
?>
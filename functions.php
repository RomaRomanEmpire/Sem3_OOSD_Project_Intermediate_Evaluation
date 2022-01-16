<?php

function checkFileValidity($filename_in_form)
{
    //upload a file
    if (isset($_FILES[$filename_in_form]) && $_FILES[$filename_in_form]['size'] != 0) {
        $file = $_FILES[$filename_in_form];
        $fileName = $_FILES[$filename_in_form]['name'];
        $fileTmpName = $_FILES[$filename_in_form]['tmp_name'];
        $file = file_get_contents($_FILES[$filename_in_form]['tmp_name']);
        $fileSize = $_FILES[$filename_in_form]['size'];
        $fileError = $_FILES[$filename_in_form]['error'];
        $fileType = $_FILES[$filename_in_form]['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png', 'pdf');

        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 10000000) {
                    $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                    $fileDestination = 'uploads/' . $fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    return $fileDestination;

                } else {
                    echo "<script type='text/javascript'>alert('your file is too big!');</script>";
                }
            } else {
                echo "<script type='text/javascript'>alert('There was an error uploading your file!');</script>";
            }
        } else {
            echo "<script type='text/javascript'>alert('You cannot upload files of this type!');</script>";
        }

    }
}

function notifyIApprovers_absent($conn)
{
    $applications_in_progress = $conn->database_details_2('application_details', 'stat', 'stat', 'sent_to_rap_1', 'sent_to_ds', "");
    foreach ($applications_in_progress as $i => $row):
        if ($row['stat'] == 'sent_to_rap_1') {
            $div_id = $conn->get_column_value($row['address_type'], 'basic_division', '=', $row['gn_div_or_address'], 'staff_id', "");

        }else {
            $div_id = $conn->get_column_value('ds', 'DS', '=', $row['ds'], 'staff_id', "");
        }
        if ($div_id==0) {
            $approvers = unserialize($row['application_object'])->getApprovers();

            foreach ($approvers as $i => $person):
                //notify approvers
            endforeach;
        }
    endforeach;
}

function uploadSign($sign): string
{
    $folderPath = "uploads/";
    $image_parts = explode(";base64,", $sign);
    $image_type_aux = explode("image/", $image_parts[0]);
    $image_type = $image_type_aux[1];
    $image_base64 = base64_decode($image_parts[1]);
    $file = $folderPath . uniqid() . '.' . $image_type;
    file_put_contents($file, $image_base64);
    return $file;
}
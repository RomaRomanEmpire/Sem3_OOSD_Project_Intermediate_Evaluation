<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap.css">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 20px;
            font-weight: bolder;
            color: bisque;
            min-height: 100vh;
            background: rgb(2, 0, 36);
            background: linear-gradient(90deg, rgba(2, 0, 36, 1) 0%, rgba(9, 9, 121, 1) 1%, rgba(0, 212, 255, 1) 100%);

        }

        .Center {
            padding: 50px;
            padding-top: 200px;
            border-color: black;

        }

        .header1 {
            position: fixed;
            top: 0;
            right: 0;
            height: 13vh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: right;


        }

        tr {
            padding: 10px;
        }

    </style>
</head>
<body>
<div class="header1" style="padding-right:10px;">
    <a href="Notfication.php">
        <button type="submit" class="btn btn-sm btn-outline-light" style="width: 100px;font-size:18px;"><b
                    style="color:#000; ">Back</b>
        </button>
    </a>
</div>

<div class="Center">
    <table class="table table-info table-hover" style="text-align: center;">
        <thead>
        <div style="width: 1435px;background-color:#000;text-align: center; font-family: 'Times New Roman', Times, serif;">
            <h1>Confirmation Message</h1></div>
        </thead>
        <tbody>

        <tr class="table-danger">
            <?php
            $u_type = $_GET['u_type'];
            if($u_type!='applicant'){?>
            <th scope="col">ID Number</th>
            <th scope="col">Applicant Name</th>
            <?php }
            if($u_type=='applicant'){?>
            <th scope="col">Confirmed Officer</th>
            <?php }?>
            <th scope="col">View Attachment</th>


        </tr>
        </tbody>
        <tbody>
        <?php
        $n_id = $_GET['n_id'];
        $application_id = $_GET['application_id'];
        ?>
        <tr>
            <?php
            if($u_type!='applicant'){?>
            <td>Otto</td>

            <td><?php
                $applicant_id = $conn->get_column_value('application_details', 'app_id', '=', $application_id, 'applicant_id', "");
                $applicant = $conn->get_column_value('user_details', 'user_id', '=', $applicant_id, 'username', "");
                echo $applicant;
                ?></td>
            <?php }?>
            <td>
                <div class="form-floating">
                    <textarea class="form-control" placeholder="The reason for rejection of application......"
                              id="floatingTextarea2" style="height: 200px; background-color:bisque;"></textarea>
                </div>
            </td>
            <td>Mark</td>


        </tr>


        </tbody>
    </table>
</div>
</body>
</html>
<?php
session_start();
include 'autoloader.php';
$conn = DB_OP::get_connection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "functions.php";

    $photograph = checkFileValidity("photographs");
    $receipt = checkFileValidity("receipt");

    $policeReport = checkFileValidity("policeReport");
    if (!empty($photograph) && !empty($receipt) && !empty(isset($_FILES['policeReport'])?$policeReport:' ')){
        $applicant = unserialize($conn->get_column_value("user_details", "user_id", "=", $_SESSION['user_id'], "u_object", ""));
        $application = $applicant->getApplication();
        $application->setGnDivOrAddress($_GET['basic']);
        $application->setDs($_GET['ds']);
        $application->setDetails($photograph, $receipt,$policeReport, $_POST, $applicant, $_GET['id']);

        $applicant->set_db($conn);


        $applicant->set_row_id($_SESSION['user_id']);

        $applicant->apply_NIC($_GET['table'], $application);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/78dc5e953b.js" crossorigin="anonymous"></script>
    <title>ID Requesting</title>
    <style>
        h1 {
            text-align: center;
            font-size: 40px;
            font-style: italic;
        }

        h2 {
            font-size: 30px;
        }

        p {
            font-size: 20px;
            font-weight: bold;
            align: justify;
            padding: 10px;
            word-spacing: 10px;
            line-height: 20px;
        }

        dl {
            border: 3px double #ccc;
            padding: 5px;
        }

        dt {
            /* float: left; */
            clear: left;
            /* width: 100px; */
            text-align: left;
            font-size: 20px;
            font-weight: bold;
            color: #000;
            padding: 5px;
        }

        dd {
            padding: 5px;
        }


        input[type="text"]:hover,
        input[type="number"]:hover,
        input[type="date"]:hover {
            border-color: #fff;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="number"],
        input[type="date"],
        input[type="tel"],
        select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid rgb(61, 57, 88);
            border-radius: 4px;
            box-sizing: border-box;
            background-color: #b7ddee;
            border-color: rgb(1, 15, 15);
        }

        ::placeholder {
            color: black;
        }

        .step {
            display: none;
        }

        .step.active {
            display: block;
        }

        .container {
            left: 50%;
            align-self: center;
            position: absolute;
            transform: translate(-50%);
            box-sizing: border-box;
            padding: 20px 20px;
            width: 1000px;
        }

        button.next-btn,
        button.previous-btn,
        button.submit-btn {
            float: right;
            margin-top: 20px;
            padding: 10px 30px;
            border: none;
            outline: none;
            background-color: rgb(180, 220, 255);
            font-family: 'Montserrat';
            /* font-size: 10px; */
            cursor: pointer;
            font-weight: bolder;
        }

        button.previous-btn {
            float: left;
            font-weight: bolder;
        }

        button.submit-btn {
            background-color: seagreen;
            font-weight: bolder;
        }

        .required_:after {
            content:" *";
            color: red;
        }

        body {
            background: linear-gradient(#21669b, #a6d8ff, #fff);
            height: 100vh;
            /*background-position: relative;*/
            background-repeat: no-repeat;
            background-size: cover;
        }

        .Button_1 {
            text-align: center;
            background-color: #a6d8ff;
            color: #000;
            font-weight: bolder;
            border: none;
            outline: none;
            width: 110px;
        }

        .header1 {
            position: absolute;
            top: 0;
            right: 0;
            height: 19vh;
            width: 100%;

            display: flex;
            align-items: center;
            justify-content: right;
            z-index: 3;


        }

        .header1 button:hover {
            background: whitesmoke;
            color: #000;
        }

        .header1 button {
            width: 120px;
            font-size: 18px;
            margin-right: 20px;
            color: white;
            background-color: black;
            height: 35px;
            border-radius: 5px;
        }
    </style>


</head>

<body>
<!-- <div class="header1"><button type="submit" class="fas fa-arrow-left" onclick="goback()"> Back</button> </div> -->
<section>

    <div>
        <form onsubmit="return requiredId()" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id=<?php echo $_GET['id']; ?>&
        table=<?php echo $_GET['table']; ?>&basic=<?php echo $_GET['basic']; ?>&ds=<?php echo $_GET['ds']; ?>"
              method="POST" enctype="multipart/form-data">




                    <dl>
                        <dt><b><label class="required_" for="receipt">7.2. Add the receipt</label></b></dt>
                        <dd><input type="file" id="receipt" name="receipt" required></dd>

                    </dl>


                        <button type="submit" class="submit-btn">Submit</button>



            </div>

        </form>
    </div>
</section>




</body>

</html>

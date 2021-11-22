<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['GN_division']) && isset($_POST['DS_division'])){
        $_SESSION['GN_division'] = $_POST['GN_division'];
        $_SESSION['DS_division'] = $_POST['DS_division'];
        header("location: IdRequestForm.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Divisions Select</title>

    <style>
        h1 {
            margin-top: 50px;
            font-size: 30px;
        }

        label {
            font-size: 20px;
            font-style: italic;
        }

        input {
            width: 50%;
            padding: 10px 30px;
            margin: 50px;
            display: inline-block;
            border: 1px solid rgb(61, 57, 88);
            border-radius: 4px;
            box-sizing: border-box;
            background-color: #ca89bc;
            border-color: rgb(1, 15, 15);
        }

        ::placeholder {
            color: #000;
        }

        button {
            float: center;
            margin-top: 20px;
            padding: 10px 30px;
            border: none;
            outline: none;
            background-color: rgb(180, 220, 255);
            font-family: 'Montserrat';
            font-size: 10px;
            cursor: pointer;
        }

        body {
            background-color: cornsilk;
            /* background-size: cover;
            background-repeat: repeat; */
            text-align: center;
            /* margin-top:200px; */
        }
    </style>
</head>

<body>
    <form id="signin-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <h1>Grama Niladari Division and Divisional Secretariat Division</h1>
        <b><label for="GN_division">Grama Niladari Division</label></b><br>
        <input type="text" list="GN_divisions" name="GN_division" placeholder="Select your GN Division...." required />
        <datalist id="GN_divisions">
            <option>Eldeniya East 286E</option>
            <option>Suriyapaluwa East 245B</option>
            <option>Kirillawela South 245B</option>
            <option>Wedamulla 261</option>
            <option>Makola North Ihala 270</option>
            <option>Makola South Ihala 271</option>
            <option>Heiyanthuduwa East 275B</option>
            <option>Yakkaduwa 207A</option>
            <option>Dippitigoda 260</option>
            <option>Kalawana 114</option>
        </datalist><br>

        <b><label for="DS_division">Divisional Secretariat Division</label></b><br>
        <input type="text" list="DS_divisions" name="DS_division" placeholder="Select your DS Division...." required />
        <datalist id="DS_divisions">
            <option>Attanagalla</option>
            <option>Biyagama</option>
            <option>Dompe</option>
            <option>Gampaha</option>
            <option>Katana</option>
            <option>Ja Ela</option>
            <option>Agalawatta</option>
            <option>Bandaragama</option>
            <option>Beruwala</option>
            <option>Ingiriya</option>
        </datalist><br>

        <!-- <button type="button" class="submit-btn">submit</button> -->

        <button type="submit" id="submit-btn" class="submit-btn">Submit</button>
    </form>
</body>

</html>
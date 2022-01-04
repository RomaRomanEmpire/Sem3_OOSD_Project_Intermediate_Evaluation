<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Divisions Select</title>

    <script>
        function ShowDetails() {
            var student = document.getElementById("detailsStudents")
            var estateWorker = document.getElementById("detailsEstateWorkers");
            var other = document.getElementById("detailsOther");
            var student_check = document.getElementById("student")
            var estateWorker_check = document.getElementById("estateWorker");
            var other_check = document.getElementById("otherAppliers");
            var submit_button = document.getElementById("submit");
            if (student_check.checked) {
                estateWorker.style.display = "none";
                other.style.display = "none";
                student.style.display = "block";
            }
            else if (estateWorker_check.checked) {
                student.style.display = "none";
                other.style.display = "none";
                estateWorker.style.display = "block";
            }
            else if (other_check.checked) {
                student.style.display = "none";
                estateWorker.style.display = "none";
                other.style.display = "block";
            }
            submit_button.style.display = "block";
        }
    </script>

    <style>
        fieldset {
            border: none;
        }

        h1 {
            margin: 10px;
            font-size: 30px;
        }

        label {
            font-size: 20px;
            font-style: italic;
            /* margin: 10px; */
        }

        input[type="radio"] {
            margin: 10px;
            text-align: center;
        }

        input[type="text"] {
            width: 50%;
            padding: 10px 10px;
            margin: 10px;
            /* margin-bottom: 10px; */
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
            margin-top: 10px;
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
        }
    </style>

</head>

<body>
    <div>
        <div>
            <fieldset>
                <h1>Who are You?</h1>
                <br>
                <div>
                    <input type="radio" class="check-input" name="applier" id="student" onclick="ShowDetails()">
                    <label class="check-label" for="student">A Student</label>
                </div>
                <div>
                    <input type="radio" class="check-input" name="applier" id="estateWorker" onclick="ShowDetails()">
                    <label class="check-label" for="stateWorker">An Estate Worker</label>
                </div>
                <div>
                    <input type="radio" class="check-input" name="applier" id="otherAppliers" onclick="ShowDetails()">
                    <label class="check-label" for="otherAppliers">Other</label>
                </div>
            </fieldset>

            <fieldset id="detailsStudents" style="display: none;">
                <div>
                    <h2>What is your school?</h2>
                    <b><label for="school">School</label></b><br>
                    <input type="text" list="schools" placeholder="Select your school...." required />
                    <datalist id="schools">
                        <option>Bandaranayake College Gampaha</option>
                        <option>Royal College Colombo 7</option>
                        <option>Ananda College Colmbo 10</option>
                        <option>Veyangoda Central College Veyangoda</option>
                        <option>Dharmaraja College Kandy</option>
                        <option>Visaka Vidyalaya Colombo 5</option>
                        <option>Nalanda College Colombo 10</option>
                        <option>Rathnawali Balika Vidyalaya Gampaha</option>
                        <option>Devi Balika Vidyalaya 8</option>
                        <option>Mahamaya Girl's College Kandy</option>
                    </datalist><br>
                </div>
            </fieldset>

            <fieldset id="detailsEstateWorkers" style="display: none;">
                <div>
                    <h2>What is your Estate Division?</h2>
                    <b><label for="estateDivision">Estate Division</label></b><br>
                    <input type="text" list="estateDivisions" placeholder="Select your Estate Division...." required />
                    <datalist id="estateDivisions">
                        <option>Mabopitiya, Undugoda</option>
                        <option>Maddakelle, Madoolkelle</option>
                        <option>wadupola, Kegalle</option>
                        <option>Walgama, Kurunegala</option>
                        <option>Dallokoya, Elkaduwa</option>
                        <option>Dalugala, Matale</option>
                        <option>Talawatta, Galaha</option>
                        <option>Thalgaswala, Ahangama</option>
                    </datalist><br>
                </div>
            </fieldset>
            <filedset id="detailsOther" style="display: none;">
                <div>
                    <h2>What is your Grama Niladari Division and Divisional Secretariat Division?</h2>
                    <b><label for="GN_division">Grama Niladari Division</label></b><br>
                    <input type="text" list="GN_divisions" placeholder="Select your GN Division...." required />
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
                    <input type="text" list="DS_divisions" placeholder="Select your DS Division...." required />
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
                </div>
            </filedset>

            <fieldset id="submit" style="display: none">
                <br><a href="IdRequestForm.php"><button type="submit" id="submit-btn"
                        class="submit-btn">Submit</button></a>
            </fieldset>
        </div>
    </div>
</body>

</html>
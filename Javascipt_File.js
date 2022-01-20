function show_details() {
    var VEstate_Superintendent = document.getElementById("Officer_E");
    var VDivitional_Secretary = document.getElementById("Officer_D");
    var VGrama_Niladari = document.getElementById("Officer_G");
    var VPrincipal = document.getElementById("Officer_P");
    var VNational_Identity_Card_Issuer = document.getElementById("Officer_N");
    var VStudent = document.getElementById("student");
    var VPerson = document.getElementById("person");
    var VMonk = document.getElementById("monk");

    var IdNumber = document.getElementsByClassName("IdNumber");
    var Email = document.getElementsByClassName("Email");
    var Username = document.getElementsByClassName("Username");
    var EEstate_Address = document.getElementsByClassName("Estate_Address");
    var Grama_Niladari_Divition = document.getElementsByClassName("Grama_Niladari_Divition");
    var Divitional_Secretariat = document.getElementsByClassName("Divitional_Secretariat");
    var School_Name = document.getElementsByClassName("School_Name");
    var Action = document.getElementsByClassName("Action");
    var Table_display = document.getElementById("table_detils");



    var Estate_Superintendent1;
    var Divitional_Secretary1;
    var Grama_Niladari1;
    var Student_And_Principal1;
    var person1;
    var monk1;
    function hide_previous_details() {
        if ((typeof this.Estate_Superintendent1 != 'undefined')) {
            this.Estate_Superintendent1.Hide_Database_Details();
        }

        if (typeof this.Divitional_Secretary1 != 'undefined') {
            this.Divitional_Secretary1.Hide_Database_Details();
        }
        if (typeof this.Grama_Niladari1 != 'undefined') {
            this.Grama_Niladari1.Hide_Database_Details();
        }
        if (typeof this.Student_And_Principal1 != 'undefined') {
            this.Student_And_Principal1.Hide_Database_Details();
        }

    }
    var user1 = new User(IdNumber, Username, Email, Action);
    if (VEstate_Superintendent.checked) {
        hide_previous_details();
        this.Estate_Superintendent1 = new Estate_Superintendent(EEstate_Address);
        user1.Show_Common_Database_Details();
        this.Estate_Superintendent1.Show_Database_Details();
    }
    if (VDivitional_Secretary.checked) {
        hide_previous_details();

        this.Divitional_Secretary1 = new Divitional_Secretary(Divitional_Secretariat);
        user1.Show_Common_Database_Details();
        this.Divitional_Secretary1.Show_Database_Details();

    }
    if (VGrama_Niladari.checked) {
        hide_previous_details();
        this.Grama_Niladari1 = new Grama_Niladari(Divitional_Secretariat, Grama_Niladari_Divition);
        user1.Show_Common_Database_Details();
        this.Grama_Niladari1.Show_Database_Details();
    }
    if (VPrincipal.checked) {
        hide_previous_details();
        this.Student_And_Principal1 = new Student_And_Principal(School_Name);
        user1.Show_Common_Database_Details();
        this.Student_And_Principal1.Show_Database_Details();
    }
    if (VNational_Identity_Card_Issuer.checked) {
        hide_previous_details();
        user1.Show_Common_Database_Details();
    }
    if (VStudent.checked) {
        hide_previous_details();
        this.Student_And_Principal1 = new Student_And_Principal(School_Name);
        user1.Show_Common_Database_Details();
        this.Student_And_Principal1.Show_Database_Details();
    }
    if (VPerson.checked) {
        hide_previous_details();
        user1.Show_Common_Database_Details();
    }
    if (VMonk.checked) {
        hide_previous_details();
        user1.Show_Common_Database_Details();
    }

}
class User {
    constructor(ID_Number, Username, Email, Action) {
        this.ID_Number = ID_Number;
        this.Username = Username;
        this.Email = Email;
        this.Action = Action;
    }
    Show_Common_Database_Details() {
        for (var i = 0; i < this.ID_Number.length; i++) {
            this.ID_Number[i].style.display = "table-cell";
            this.Username[i].style.display = "table-cell";
            this.Email[i].style.display = "table-cell";
            this.Action[i].style.display = "table-cell";
        }
    }
    Hide_Common_Database_Details() {
        for (var i = 0; i < this.ID_Number.length; i++) {
            this.ID_Number[i].style.display = "none"
            this.Username[i].style.display = "none"
            this.Email[i].style.display = "none"
        }
    }

}
class Student_And_Principal {
    constructor(School_Name) {
        this.School_Name = School_Name;
    }
    Show_Database_Details() {
        for (var i = 0; i < this.School_Name.length; i++) {
            this.School_Name[i].style.display = "table-cell";
        }
    }
    Hide_Database_Details() {
        for (var i = 0; i < this.School_Name.length; i++) {
            this.School_Name[i].style.display = "none";
        }
    }
}
class Student extends Student_And_Principal {

}
class Person {

}
class Monk { }
class Estate_Superintendent {
    constructor(Estate_Address) {
        this.Estate_Address = Estate_Address;
    }
    Show_Database_Details() {
        for (var i = 0; i < this.Estate_Address.length; i++) {
            this.Estate_Address[i].style.display = "table-cell";
        }
    }
    Hide_Database_Details() {
        for (var i = 0; i < this.Estate_Address.length; i++) {
            this.Estate_Address[i].style.display = "none";
        }
    }

}
class Divitional_Secretary {
    constructor(Divitional_Secretariat) {
        this.Divitional_Secretariat = Divitional_Secretariat;
    }

    Show_Database_Details() {
        for (var i = 0; i < this.Divitional_Secretariat.length; i++) {
            this.Divitional_Secretariat[i].style.display = "table-cell";
        }
    }
    Hide_Database_Details() {
        for (var i = 0; i < this.Divitional_Secretariat.length; i++) {
            this.Divitional_Secretariat[i].style.display = "none";
        }
    }
}
class Grama_Niladari {
    constructor(Grama_Niladari_Divition, Divitional_Secretariat) {
        this.Divitional_Secretariat = Divitional_Secretariat;
        this.Grama_Niladari_Divition = Grama_Niladari_Divition;
    }

    Show_Database_Details() {
        for (var i = 0; i < this.Grama_Niladari_Divition.length; i++) {
            this.Divitional_Secretariat[i].style.display = "table-cell";
            this.Grama_Niladari_Divition[i].style.display = "table-cell";
        }
    }
    Hide_Database_Details() {
        for (var i = 0; i < this.Grama_Niladari_Divition.length; i++) {
            this.Divitional_Secretariat[i].style.display = "none";
            this.Grama_Niladari_Divition[i].style.display = "none";
        }
    }
}
class Principal extends Student_And_Principal {

}
class National_Identity_Card_Issuer {

}
var bool = false;
var bool2 = false;
//This function use to change the password of user account
function Change_Password() {
    var ChangePassword = document.getElementById("ChangePassword");
    var fieldDisplay = document.getElementById("CPassword");
    var PreviousPassword = document.getElementById("InputPPassword");
    var NewPassword = document.getElementById("InputNPassword");
    var submit_button = document.getElementById("Submit_button");
    if (ChangePassword.checked) {

        fieldDisplay.style.display = "block";
        submit_button.style.display = "block";
        bool = true;
    }
    if (!(ChangePassword.checked)) {
        fieldDisplay.style.display = "none"
        bool = false;

    }


    if (!(ChangePassword.checked) && !(bool) && !(bool2)) {
        fieldDisplay.style.display = "none"
        submit_button.style.display = "none"
    }

}
//This function use to edit the profile details of the user 
function Edit_Profile() {
    var Button = document.getElementById("Submit_button");
    var EditProfile = document.getElementById("EditProfile");
    var Profile = document.getElementById("Profile");
    if (EditProfile.checked) {

        Profile.removeAttribute("disabled");
        Button.style.display = "block";
        bool2 = true;

    }
    if (!(EditProfile.checked)) {
        Profile.setAttribute('disabled', 'disabled');
        bool2 = false;

    }
    if (!(EditProfile.checked) && !(bool) && !(bool2)) {
        Profile.setAttribute('disabled', 'disabled');
        Button.style.display = "none";

    }
}
function GoPreviousFile() {
    window.history.back();
}

//=================Notification File Functions===================
function Notification() {
    if (document.getElementById("btn_check_outlinedc").checked) {

        document.getElementById("Topic").innerHTML = "Confirm Message";
        document.getElementById("confirmation_message").style.display = "block";
        document.getElementById("Inbox_message").style.display = "none";
        document.getElementById("Sent_message").style.display = "none";
        document.getElementById("Sent").style.display = "none";
        document.getElementById("Reject_message").style.display = "none";


    }
    else if (document.getElementById("btn_check_outlinedI").checked) {
        document.getElementById("Topic").innerHTML = "Inbox Messages"
        document.getElementById("Inbox_message").style.display = "block";
        document.getElementById("confirmation_message").style.display = "none";
        document.getElementById("Sent_message").style.display = "none";
        document.getElementById("Sent").style.display = "none";
        document.getElementById("Reject_message").style.display = "none";


    }
    else if (document.getElementById("btn_check_outlinedS").checked) {

        document.getElementById("Sent").style.display = "block";

        if (document.getElementById("btn_check_outlinedT").checked) {
            document.getElementById("Topic").innerHTML = "Sent Messages"
            document.getElementById("Sent_message").style.display = "block";
            document.getElementById("Inbox_message").style.display = "none";
            document.getElementById("confirmation_message").style.display = "none";
            document.getElementById("Reject_message").style.display = "none";

        }
        else if (document.getElementById("btn_check_outlinedR").checked) {
            document.getElementById("Topic").innerHTML = "Sent Messages"
            document.getElementById("Reject_message").style.display = "block";
            document.getElementById("Inbox_message").style.display = "none";
            document.getElementById("confirmation_message").style.display = "none";
            document.getElementById("Sent_message").style.display = "none";
        }
    }
}

function Notification1() {
    if (document.getElementById("btn_check_outlinedT1").checked) {
        document.getElementById("Topic1").innerHTML = "Appointment Time";
        document.getElementById("Time1").style.display = "block";
        document.getElementById("Reject_message1").style.display = "none";
        document.getElementById("Sent_message1").style.display = "none";
    }
    else if (document.getElementById("btn_check_outlinedR1").checked) {
        document.getElementById("Topic1").innerHTML = "Confirmed Message";
        document.getElementById("Time1").style.display = "none";
        document.getElementById("Reject_message1").style.display = "block";
        document.getElementById("Sent_message1").style.display = "none";
    }
    else if (document.getElementById("btn_check_outlinedS1").checked) {
        document.getElementById("Topic1").innerHTML = "Send Messages";
        document.getElementById("Time1").style.display = "none";
        document.getElementById("Reject_message1").style.display = "none";
        document.getElementById("Sent_message1").style.display = "block";
    }
}


var required_;
var required_copy;
var password_validate;

function required() {
    var changePwd = document.getElementById("ChangePassword");
    var edit = document.getElementById("EditProfile");
    var value1 = document.getElementById("InputPPassword").value;
    var value2 = document.getElementById("InputNPassword").value;
    var value3 = document.getElementById("InputCPassword").value;
    if (changePwd.checked) {
        if (value1 == "" && value2 == "" && value3 == "") {
            alert("Please input a Value");
            return false;
        } else {
            return true;
        }
    }
}


function verifyPassword() {
    var pwd = document.getElementById("InputNPassword").value;
    var msg = document.getElementById("msg");
    var grade = document.getElementById("grade");
    function showgrade(min, max, value, low, high) {
        grade.min = min;
        grade.max = max;
        grade.value = value;
        grade.low = low;
        grade.high = high;
    }
    var regExp = /(?=.*[A-Z])\w{4,15}/;
    if (pwd.match(regExp) && pwd.length > 8) {
        msg.innerHTML = "Strong Password";
        showgrade(1, 100, 100, 0, 0);
    }
    else {
        if (pwd.length < 4) {
            msg.innerHTML = "poor password";
            showgrade(1, 100, 100, 60, 80);
        }
        else {
            msg.innerHTML = "Weak Password";
            showgrade(1, 100, 100, 40, 80);
        }
    }
}
function PasswordValidity() {
    var pwd = document.getElementById("InputNPassword").value;
    var pwd2=document.getElementById("InputCPassword").value;
    if (pwd.length >= 8 && pwd.length <= 14 && pwd === pwd2) {
        
        return true;
    }
    else {
        alert("Password conformation is wrong!! and must give strong password length.Character length must be in 8 to 14 range");
        return false;
    }
}












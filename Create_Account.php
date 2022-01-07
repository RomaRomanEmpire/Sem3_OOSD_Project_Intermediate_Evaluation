<?php
include 'autoloader.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
      
      $con = DB_OP::get_connection();
      
      $applicant = new Applicant($_POST);

      $con->create_user_account($_POST["uname"],$_POST["email"],$_POST["password"],$applicant);


}

?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <title>Account Creating</title>
      <style>
            input[type=submit] {
                  width: 100%;
                  background-color: rgb(83, 139, 100);
                  color: rgb(48, 40, 83);
                  padding: 14px 20px;
                  margin: 8px 0;
                  border: none;
                  border-radius: 4px;
                  cursor: pointer;
            }
            input[type=submit]:hover {
                background-color:rgb(30, 17, 71) ;
          }
          input[type="text"],input[type="email"],input[type="password"],input[type="number"],input[type="date"],select{
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid rgb(61, 57, 88);
            border-radius: 4px;
            box-sizing: border-box;
            background-color: #bcc5c9;
            border-color: rgb(1, 15, 15);


      }
      ::placeholder{
            color: black;
      }
      div {
            border-radius: 5px;
            background-color: rgb(155, 150, 170);
            top: 70%;
            left: 50%;

            position: absolute;
            transform: translate(-50%,-50%);
            box-sizing: border-box;
            padding: 20px 20px;
            width: 620px;
            height: 950px;


      }
      td{
            font-size: 20px;
            text-align: left;
      }
      body{
            background: rgb(55, 38, 104);
      }

</style>
<script>
      var password_validate;
      var age_validate;
      var PW_length;
      function verifyPassword(){
            var pwd=document.getElementById("password_1").value;
            var msg=document.getElementById("msg");
            var grade=document.getElementById("grade");
            function showgrade(min,max,value,low,high){
                  grade.min=min;
                  grade.max=max;
                  grade.value=value;
                  grade.low=low;
                  grade.high=high;
            }
            var regExp=/(?=.*[A-Z])\w{4,15}/;
            if(pwd.match(regExp) && pwd.length>8){
                  msg.innerHTML="Strong Password";
                  showgrade(1,100,100,0,0);
            }
            else{
                  if(pwd.length<4){
                        msg.innerHTML="poor password";
                        showgrade(1,100,100,60,80);
                  }
                  else{
                        msg.innerHTML="Weak Password";
                        showgrade(1,100,100,40,80);
                  }
            }
      }
      function PasswordValidity(){
            var pwd1=document.getElementById("password_1").value;
            var pwd_conform=document.getElementById("password_2").value;
            var btn=document.getElementById("button");

            if  ((pwd1==pwd_conform) && (pwd1.length>=8 && pwd1.length<=14)){
              password_validate= true;



        }
        else{
            password_validate= false;

      }

}
function Birthday_Validate(){
      var Birthday=document.getElementById("BDate").value;
      var daten = new Date();
      var Year = daten.getFullYear();
      if ((parseInt(Year) - parseInt(Birthday.slice(0,4))) < 16){

            age_validate=false;

      }
      else{
       age_validate= true;

 }
}
function validation(){
      if (password_validate && age_validate)
      {
            return true;

      }
      else if (!(password_validate )){
            alert("Password conformation is wrong!! and must give strong password length.Charctor length must be in 8 to 14 range");
            return false;
      }

      else if (!(age_validate)){
            alert("You haven't fulfilled your age!!");
            return false;
      }


}

</script>
</head>
<body>

 <div >
       <h1>User Account</h1>
       <form id="signup-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" onsubmit="return validation()">
            <h1><span id="msgx"></span></h1>
            <b> <label for="full_name">Full Name</label></b>
            <input type="text" id="full_name" name="fname" placeholder="Your full name.." required>
            <br>
            <b> <label for="uname">Username</label></b>
            <input type="text" id="uname" placeholder="UserName" name="uname" required>
            <br>
            <b> <label for="address_">Address</label></b>
            <input type="text" id="address_" name="Address" placeholder="Your address.." required>
            <br>
            <b>  <label for="email_">Email address:</label></b>
            <input type="email" id="email_" placeholder="Email Address" name="email" required>
            <br>
            <b>   <label for="mobile_number">Mobile number</label></b>
            <input type="number" id="mobile_number" name="mobileNo" placeholder="Your mobile number.." required>
            <br>
            <b> <label for="">Gender</label></b>
            <br>
            <b> <label for="gender_">Male</label></b>
            <input type="radio" id="gender_" name="gender" value="male" required>

            <b> <label for="gender_">Female</label></b>
            <input type="radio" id="gender_" name="gender" value="female" required>
            <br><br><br>
            <b> <label for="BDate">Birthday</label></b>
            <input type="date" id="BDate" placeholder="Date of birthday" name="Birthday" onchange="Birthday_Validate()"  required>
            <br>
            <b> <label for="password_1">Password</label></b><br>
            <input type="password"    id="password_1" placeholder="password" name="password" onkeyup="verifyPassword()"  required  >
            <meter min="1" max="100" value="0" low="0" high="0" id="grade"></meter>
            <span id="msg"></span>
            <br>
            <b> <label for="password_2">Confirm password</label></b><br>
            <input type="password" id="password_2" placeholder="password" name="con_password" onchange="PasswordValidity()" required>
            <br>

            <input type="submit" id="button">

      </form>
</div>

</body>
</html>

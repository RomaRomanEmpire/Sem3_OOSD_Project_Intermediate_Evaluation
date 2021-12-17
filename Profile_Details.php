<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="bootstrap.css">
      <link rel="stylesheet" href="style.css">
      <link rel="stylesheet" href="style2.css">
      <title>Profile</title>
      <script type="text/javascript" src="Javascipt_File.js">

      </script>
</head>
<body style=" background: rgba(32, 26, 122, 0.486);">
  <div class="side_menu2">
   <br> <br> <br> <br> 
  
  <div style="color: whitesmoke; font-size: larger;   padding-left: 80px;">
  <h1 class="display-3" style="font-family: 'Times New Roman', Times, serif; text-align: left;">Profile</h1><br>
  <img src="Image/Profile.jpg"  style="width: 100px;height: 100px;border-radius: 50%;  display: block;
  margin-left: 20px;
  margin-right: 20px;"><br> <br>
  <div class="mb-3 form-check" >
    <input type="checkbox" class="form-check-input"id="EditProfile" onchange="Edit_Profile()">
    <!-- This function use to edit the profile details of the user -->
    <label class="form-check-label" for="EditProfile"  >Update Account Deatils</label>
  </div>
  <br>
  <br>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="ChangePassword" onclick="Change_Password()">
    <label class="form-check-label" for="ChangePassword">Change Password</label>
  </div></div>
  <br>
 </div>
 <div class="container">
   <div class="header1"><div ><button  class="btn btn-primary" id="Back" onclick=" GoPreviousFile()" >Back</button></div></div> 
     <div style="padding: 100px; " class="Profile_box" >
           
                 <h1 class="display-3" style="font-family: 'Times New Roman', Times, serif; text-align: left;">About</h1>
                 <br>
   <form>
  <fieldset id="Profile" disabled>
  <div class="mb-3">
    <label for="InputFName" class="form-label">Full Name</label>
    <input type="text" class="form-control" id="InputFName" aria-describedby="InputFName" style=" background: transparent; border: solid rgb(252, 251, 251);  border-width: 1px 1px;">  
  </div>
  <div class="mb-3">
    <label for="InputUName" class="form-label">UserName</label>
    <input type="text" class="form-control" id="InputUName" aria-describedby="InputUName" style=" background: transparent; border: solid rgb(252, 251, 251);  border-width: 1px 1px;">
    
  </div>
  <div class="mb-3">
    <label for="InputEmail1" class="form-label">Email address</label>
    <input type="text" class="form-control" id="InputEmail1" aria-describedby="emailHelp" style=" background: transparent; border: solid rgb(252, 251, 251);  border-width: 1px 1px;">
    
  </div>
  <div class="mb-3">
    <label for="InputMNumber" class="form-label">Mobile Number</label>
    <input type="number" class="form-control" id="InputMNumber" aria-describedby="InputMNumber" style=" background: transparent; border: solid rgb(252, 251, 251);  border-width: 1px 1px;" >
    
  </div>
  <div class="mb-3">
    <label for="InputBDay" class="form-label">Birthday</label>
    <input type="date" class="form-control" id="InputBDay" aria-describedby="InputBDay" style=" background: transparent; border: solid rgb(252, 251, 251);  border-width: 1px 1px;" >  
  </div>
  </fieldset>
  <fieldset id="CPassword" style="display: none; ">
  <div class="mb-3">
    <label for="InputPPassword" class="form-label">Previous Password</label>
    <input type="password" class="form-control" id="InputPPassword" aria-describedby="InputPPassword" style=" background: transparent; border: solid rgb(252, 251, 251);  border-width: 1px 1px;">
  </div>
  <div class="mb-3">
    <label for="InputNPassword" class="form-label">New Password</label>
    <input type="password" class="form-control" id="InputNPassword" aria-describedby="InputNPassword" style=" background: transparent; border: solid rgb(252, 251, 251);  border-width: 1px 1px;">
  </div>
</fieldset>  
  
  <fieldset id="Submit_button" style="display: none;">
  <button type="submit" class="btn btn-primary">Submit</button>
  </fieldset>
</form></div></div>
</body>
</html>
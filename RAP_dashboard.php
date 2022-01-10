<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RAP Dashboard</title>
    <link rel="stylesheet" href="style2.css">
    <script src="https://kit.fontawesome.com/78dc5e953b.js" crossorigin="anonymous"></script>
    <script src="Javascipt_File.js"></script>
    <style>
        .container .content .card .icon_case button:hover{
            background-color: rgb(17, 0, 255);
        }
    </style>

</head>
<body >
      
           
      <div class="side_menu">
            <div class="barand_name">
                  <h1>Dashboard</h1>
            </div>
            <div>
                  <ul>
                        
                        <li><img src="Image/student.jpg" alt="">&nbsp;<span><a href="Profile_Details.php">Profile</a></span></li>
                       <li><img src="Image/notification.jpg" alt="">&nbsp;<span><a href="Notfication.php">Notification</a></span></li>
                       <!-- <li><select>
                        <option>Inbox</option>
                        <option>Send</option></select></li> -->
                       <!-- <li><img src="Image/school.png" alt="">&nbsp;<span> School</span></li>  -->
                        <!-- <li><img src="Image/help.png" alt="">&nbsp;<span> Help</span></li>
                        <li><img src="Image/setting.png" alt="">&nbsp;<span>Setting</span></li> -->
                  </ul>
            </div>
      </div>
     
      <div class="container">
            <img src="Image/A.jpg">
            <div class="header">
                  
                  <div class="nav">
                              <!-- <div class="search">
                              <button type="submit"  ><img src="Image/search.png" alt=""></button>
                              <input type="text" name="" id="" placeholder="Search...."> 
                              
                              </div>  -->
                  <div class="user">
                              
                           
                              <div class="img-case">
                                
                              </div>
                              <!-- <a href=""  class="btn" >Notification</a> 
                              <a href=""  class="btn"> Profile</a>   -->
                              <a href="logout.php" class="btn"><i class="fas fa-sign-out-alt"></i> Log Out</a>
                              
                  </div>
                  </div>
            </div>
            <div class="content">
                  <div class="card">
                  <div class="icon_case">
                        <br><br><br><br>
                        <a href="View_Applications_Details.php"><button>View Applications Details </button></a><br><br>
                        <!-- <button>Applying For lost Identity Card </button> -->
                  </div>
                  </div>
                           
            </div>
                   
       </div>
     
      
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Manager Dashboard</title>
    <link rel="stylesheet" href="../style2.css">
    <script src="../Javascipt_File.js"></script>
    <script src="https://kit.fontawesome.com/78dc5e953b.js" crossorigin="anonymous"></script>

</head>
<body>
      
           
      <div class="side_menu">
            <div class="barand_name">
                  <h1>Dashboard</h1>
            </div>
            <div>
                  <ul>
                        
                        <li><img src="../Image/student.jpg" alt="">&nbsp;<span><a href="../Profile_Details.php" > Profile</a></span></li>
                       <!-- <li><img src="Image/notification.jpg" alt="">&nbsp;<span>Notification</span></li> -->

                         <li  href="Add_officer.html"><img src="../Image/Add.png" alt="">&nbsp;<span><a href="../Add_staff_member.php" >Add Officer</a> </span></li>
                        
                  </ul>
            </div>
      </div>
     
      <div class="container">
            <img src="../Image/A.jpg">
            <div class="header">
                  
                  <div class="nav">
                         <!-- <div class="search">
                              <button type="submit"><img src="Image/search.png" alt=""></button>
                              <input type="text" name="" id="" placeholder="Search....">
                              
                        </div> -->
                  <div class="user">
                              
                           
                              <div class="img-case">
                                
                              </div>
                              <a href="../logout.php" class="btn"><i class="fas fa-sign-out-alt"></i> Log Out</a>
                              
                  </div>
                  </div>
            </div>
            <div class="content">
                  <div class="card1">
                  <div id="db_manager-links" class="icon_case">
                        <br><br><br><br>
                      <a href="../user_Details.php" ><button>View Database Details</button></a>
                      <br><br>
                      <a href="../View_Applications_Details.php" ><button>View Application Details</button></a>
                      <br><br>
                      <a href="../DBM_Notification.php" ><button>View Notification Details</button></a>
                      <br><br>
                  </div>
                  </div>
                  
                           
            </div>
                   
       </div>
     
      
</body>
</html>
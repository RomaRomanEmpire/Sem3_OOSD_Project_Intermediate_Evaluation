<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="bootstrap.css">
  <title>Document</title>
  <script src="Javascipt_File.js">
  </script>
  <script src="https://kit.fontawesome.com/78dc5e953b.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style2.css">
  <style>
     body {
			font-family: Arial, Helvetica, sans-serif;
      background: rgb(10,30,235); 
      background: linear-gradient(90deg, rgba(10,30,235,1) 0%, rgba(15,132,139,1) 41%, rgba(15,30,135,1) 100%, rgba(101,181,198,1) 100%);          
		
                  min-height: 100vh;}
    .header1 {
            position: fixed;
            top: 0;
            right: 0;
            height: 19vh;
            width: 100%;
            
            display: flex;
            align-items: center;
            justify-content: right;
            z-index: 3;

        }
  </style>
</head>
<body>
  <div class="header1"><a href="DatabaseManagerDashboard.php">
                                   <button type="submit" class="btn btn-sm btn-outline-light fas fa-arrow-left" style="width: 100px;font-size:18px;margin-right:20px;color:black;"> Back
                                   </button>
                                  </a> </div>
  <div ><div style="padding: 100px;color: white; background: rgb(10,30,235); 
background: linear-gradient(90deg, rgba(10,30,235,1) 0%, rgba(15,132,139,1) 41%, rgba(15,30,135,1) 100%, rgba(101,181,198,1) 100%);">
   
   <div style="margin-top: 30px;margin-bottom:40px;">
      <form id="db-details-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <fieldset id="Disable_Tag" >
          <h2 style="color: black;  ">View Database Deatails</h2>
          <br>
          <div class="mb-3 form-check">
            <input type="radio" class="form-check-input" name="officer" value="Database_Manager" id="Officer_E" onclick="show_details()" required>
            <label class="form-check-label" for="Officer_E">Estate Superintendent</label>
          </div>
          <div class="mb-3 form-check">
            <input type="radio" class="form-check-input" name="officer" value="Divisional_Secretary" id="Officer_D" onclick="show_details()" required>
            <label class="form-check-label" for="Officer_D">Divitional Secretary</label>
          </div> <div class="mb-3 form-check">
            <input type="radio" class="form-check-input" name="officer" value="Grama_Niladari" id="Officer_G" onclick="show_details()" required>
            <label class="form-check-label" for="Officer_G">Grama Niladari</label>
          </div> <div class="mb-3 form-check">
            <input type="radio" class="form-check-input" name="officer" value="Principal" id="Officer_P" onclick="show_details()" required>
            <label class="form-check-label" for="Officer_P">Principal</label>
          </div>
          <div class="mb-3 form-check">
            <input type="radio" class="form-check-input" name="officer" value="National_Identity_Card_Issuer" id="Officer_N" onclick="show_details()" required>
            <label class="form-check-label" for="Officer_N">National Identity Card Issuer</label>
          </div> 
          <div class="mb-3 form-check">
            <input type="radio" class="form-check-input" name="officer" value="Applicant" id="student" onclick="show_details()" required>
            <label class="form-check-label" for="student">Applicant</label>

          </div>
          <input type="submit" name="Submit" style="width: 100px;color:aliceblue;" class="btn btn-outline-primary">
        </fieldset> </form></div>
        <fieldset id="table_detils" >
       

          <table  class="table table-striped table-hover" style="text-align: center;font-weight:bolder; " >
            <thead style="font-size:20px;">
              <tr class="table-info" >
                <th scope="col" id="IdNumber" >ID Number</th>
                <th scope="col" id="Username" >Username</th>
                <th scope="col" id="Email" >Email</th>
                <!-- ================================================================================ -->
                <!-- <th scope="col" class="Estate_Address" style="display: none;">Estate Address</th>
                <th scope="col" id="Grama_Niladari_Divition" style="display: none;">Grama Niladari Divition</th>
                <th scope="col" id="Divitional_Secretariat" style="display: none;">Divitional Secretariat</th>
                <th scope="col" id="School_Name" style="display: none;">School Name</th>  -->
                <th scope="col" id="Action">Action</th>
              </tr>
            </thead>
            <tbody >


              <?php 
              // session_start();
              // if(isset($_SESSION['o_type'])){
              //   $o_type = $_SESSION['o_type'];
              // }
              if ($_SERVER["REQUEST_METHOD"] == "POST") {

                include 'autoloader.php';
                $con = DB_OP::get_connection();

                if($_POST['officer']=="Database_Manager"){
                  $o_type = 'db_manager';

                }
                else if($_POST['officer']=="Estate_Superintendent"){
                  $o_type = 'es';

                }
                else if($_POST['officer']=="Grama_Niladari"){
                  $o_type = 'gn';

                }
                else if($_POST['officer']=="Principal"){
                  $o_type = 'principal';

                }
                else if($_POST['officer']=="Divisional_Secretary"){
                  $o_type = 'ds';

                }
                else if($_POST['officer']=="National_Identity_Card_Issuer"){
                  $o_type = 'ni';

                }
                else if($_POST['officer']=="Applicant"){
                  $o_type = 'applicant';

                }
                // $_SESSION['o_type'] = $o_type;
                $result = $con->database_details('user_details','u_type',$o_type,"ORDER BY user_id DESC");
                foreach($result as $i => $row):?>
                  <tr scope="row" style="font-size: large;" >
                    <td class="IdNumber" style="color: whitesmoke;"><?php echo $row['user_id']?></td>
                    <td class="Username" style="color: whitesmoke;"><?php echo $row['username']?></td>
                    <td class="Email" style="color: whitesmoke;"><?php echo $row['email']?></td>
                    <!--<td class="Estate_Address" style="display: none;">Estate Address</td>
                    <td class="Grama_Niladari_Divition" style="display: none;">34</td>
                    <td class="Divitional_Secretariat" style="display: none;">24</td>
                    <td class="School_Name" style="display: none;">234</td> -->
                    <td class="Action" >
                      <!-- <form style="display: inline-block" > -->
                        <input type="hidden" name="id" >
                        <a href="remove_data.php?id=<?php echo $row['user_id']?>"><button  type="submit" class="btn btn-sm btn-outline-danger" ><b>Remove Account</b></button></a>
                      <!-- </form> -->
                    </td>
                  </tr>

                <?php endforeach; }?>

              </tbody>
            </table></fieldset>
          </div></div>
        </body>
        </html>
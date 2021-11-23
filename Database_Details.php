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
</head>
<body>
  <div><div style="padding: 100px; ">
    <div style="margin: 100px;">
      <form id="db-details-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <fieldset id="Disable_Tag" >
          <h2 style="color: black;  ">View Database Deatails</h2>
          <br>
          <div class="mb-3 form-check">
            <input type="radio" class="form-check-input" name="officer" value="Database_Manager" id="Officer_E" onclick="show_details()">
            <label class="form-check-label" for="Officer_E">Estate Superintendent</label>
          </div>
          <div class="mb-3 form-check">
            <input type="radio" class="form-check-input" name="officer" value="Divisional_Secretary" id="Officer_D" onclick="show_details()">
            <label class="form-check-label" for="Officer_D">Divitional Secretary</label>
          </div> <div class="mb-3 form-check">
            <input type="radio" class="form-check-input" name="officer" value="Grama_Niladari" id="Officer_G" onclick="show_details()">
            <label class="form-check-label" for="Officer_G">Grama Niladari</label>
          </div> <div class="mb-3 form-check">
            <input type="radio" class="form-check-input" name="officer" value="Principal" id="Officer_P" onclick="show_details()">
            <label class="form-check-label" for="Officer_P">Principal</label>
          </div>
          <div class="mb-3 form-check">
            <input type="radio" class="form-check-input" name="officer" value="National_Identity_Card_Issuer" id="Officer_N" onclick="show_details()">
            <label class="form-check-label" for="Officer_N">National Identity Card Issuer</label>
          </div> 
          <div class="mb-3 form-check">
            <input type="radio" class="form-check-input" name="officer" value="Applicant" id="student" onclick="show_details()">
            <label class="form-check-label" for="student">Applicant</label>

          </div>
          <input type="submit" name="Submit">
        </fieldset> </form></div>
        <fieldset id="table_detils" >
          <table  class="table table-striped table-hover"  >
            <thead>
              <tr>
                <th scope="col" id="IdNumber" >ID Number</th>
                <th scope="col" id="Username" >Username</th>
                <th scope="col" id="Email" >Email</th>
                <!-- <th scope="col" class="Estate_Address" style="display: none;">Estate Address</th>
                <th scope="col" id="Grama_Niladari_Divition" style="display: none;">Grama Niladari Divition</th>
                <th scope="col" id="Divitional_Secretariat" style="display: none;">Divitional Secretariat</th>
                <th scope="col" id="School_Name" style="display: none;">School Name</th>  -->
                <th scope="col" id="Action">Action</th>
              </tr>
            </thead>
            <tbody>


              <?php 
              session_start();
              if(isset($_SESSION['o_type'])){
                $o_type = $_SESSION['o_type'];
              }
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
                $_SESSION['o_type'] = $o_type;
                $result = $con->database_details('user_details','u_type',$o_type,"ORDER BY user_id DESC");
                foreach($result as $i => $row):?>
                  <tr scope="row">
                    <td class="IdNumber" ><?php echo $row['user_id']?></td>
                    <td class="Username"><?php echo $row['username']?></td>
                    <td class="Email"><?php echo $row['email']?></td>
                    <!--<td class="Estate_Address" style="display: none;">Estate Address</td>
                    <td class="Grama_Niladari_Divition" style="display: none;">34</td>
                    <td class="Divitional_Secretariat" style="display: none;">24</td>
                    <td class="School_Name" style="display: none;">234</td> -->
                    <td class="Action">
                      <!-- <form style="display: inline-block" > -->
                        <input type="hidden" name="id" >
                        <a href="remove_data.php?id=<?php echo $row['user_id']?>"><button  type="submit" class="btn btn-sm btn-outline-danger" >Remove Account</button></a>
                      <!-- </form> -->
                    </td>
                  </tr>

                <?php endforeach; }?>

              </tbody>
            </table></fieldset>
          </div></div>
        </body>
        </html>
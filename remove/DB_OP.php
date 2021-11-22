<?php
/**
 *
 */
class DB_OP
{
  private $DB_SERVER;
  private $DB_USERNAME;
  private $DB_PASSWORD;
  private $DB_NAME;
  private $link;
  private static $db;

  private function __construct()
  {
    connect();
  }

  public function connect()
  {
    $DB_SERVER = 'localhost';
    $DB_USERNAME = 'root';
    $DB_PASSWORD = 'Timetochange99';
    $DB_NAME = 'login';

    /* Attempt to connect to MySQL database */
    $link = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

    // Check connection
    if($link->connect_error === false){
      die("ERROR: Could not connect. " . $link->connect_error());
    }

  }

  public static function get_connection()
  {
    if($db==NULL){
      $db = new DB_OP();
    }
    return $db;
  }

  public function login_attempt($uname_or_email,$password)
  {
    $sql = "SELECT * FROM user_details where username=? or email = ?";
    if ($stmt = $link->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
      $stmt->bind_param('ss', $uname_or_email,$uname_or_email);



            // Attempt to execute the prepared statement
            // just execute the prepared statement not checking values
      if ($stmt->execute()) {


        $result = $stmt->get_result();

                // Check if Username exists, if yes then verify Password

              //check is there are exactly one entry or not
        if ($result->num_rows == 1) {

          $row = $result->fetch_assoc();
          if (password_verify($password, $row['pwd']))
          {

                        // Store data in session variables

            $_SESSION["u_type"] = $row['u_type'];
                        // Redirect user to welcome page
            if($row['u_type']=='Teacher'){
              header("location: dashboard.php");
            }else{
              header("location: new_view_request.html");
            }

          } else 
          {
            $password_err = "The Password you entered was not valid.";

          }


        } else 
        {
                    // Display an error message if Username doesn't exist
          $username_err = "No account found with that Username."; 
        }
      } else
      {
        echo "Oops! Something went wrong. Please try again later.";
      }

            // Close statement
      $stmt->close();
    }
  }

  public function create_applicant_acc($username,$email,$pwd,$u_object)
  {
    $sql = "INSERT INTO user_details (u_type,username, email, pwd ,u_object) VALUES (?,?,?,?,?)";
    if ($stmt = $link->prepare($sql)) {

            // Bind variables to the prepared statement as parameters

      $stmt->bind_param("sssss", $param_u_type, $param_username, $param_email, $param_pwd, $param_u_object);

            // Set parameters
      $param_u_type = "applicant";
      $param_username = $username;
      $param_email = $email;
      $param_pwd = password_hash($pwd, PASSWORD_DEFAULT);
      $param_u_object = serialize($u_object);

      if($stmt->execute()){
              // Redirect to login page
        echo "<script type='text/javascript'>alert('The request has been send successfully!'); window.location.href = 'new_view_request.html';</script>"; 

      }else{
        echo "<script type='text/javascript'>alert('Ooops! Something went wrong!'); window.location.href = 'newRequest.php';</script>"; 
      }

            // Close statement
      $stmt->close();
    }
  }

  public function create_staff_acc($staff_id,$u_type,$username,$email,$pwd,$u_object)
  {
    $sql = "INSERT INTO user_details (staff_id,u_type,username, email, pwd ,u_object) VALUES (?,?,?,?,?,?)";
    if ($stmt = $link->prepare($sql)) {

            // Bind variables to the prepared statement as parameters

      $stmt->bind_param("ssssss", $param_staff_id, $param_u_type, $param_username, $param_email, $param_pwd, $param_u_object);

             // Set parameters
      $param_staff_id = $staff_id;
      $param_u_type = $u_type;
      $param_username = $username;
      $param_email = $email;
      $param_pwd = $pwd;
      $param_u_object = serialize($u_object);

      if($stmt->execute()){
               // Redirect to login page
        echo "<script type='text/javascript'>alert('The request has been send successfully!'); window.location.href = 'new_view_request.html';</script>"; 

      }else{
        echo "<script type='text/javascript'>alert('Ooops! Something went wrong!'); window.location.href = 'newRequest.php';</script>"; 
      }

              // Close statement
      $stmt->close();
    }
  }



  public function remove_staff_acc($staff_id)
  {
    $sql = "DELETE FROM user_details WHERE staff_id=?";
    if ($stmt = $link->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
      $stmt->bind_param('s', $staff_id);



            // Attempt to execute the prepared statement
            // just execute the prepared statement not checking values
      if ($stmt->execute()) {

      }
    }
  }

  public function add_application($applicant_id,$applicant_id,$division,$application_object)
  {
    $sql = "INSERT INTO application_details (applicant_id,apply_date, division,application_object) VALUES (?,?,?,?)";
    if ($stmt = $link->prepare($sql)) {

            // Bind variables to the prepared statement as parameters

      $stmt->bind_param("ssss", $param_applicant_id, $param_apply_date, $param_division, $param_application_object);

            // Set parameters
      $param_applicant_id = $applicant_id;
      $param_apply_date = $apply_date;
      $param_division = $division;
      $param_application_object = serialize($application_object);

      if($stmt->execute()){
              // Redirect to login page
        echo "<script type='text/javascript'>alert('The request has been send successfully!'); window.location.href = 'new_view_request.html';</script>"; 

      }else{
        echo "<script type='text/javascript'>alert('Ooops! Something went wrong!'); window.location.href = 'newRequest.php';</script>"; 
      }

            // Close statement
      $stmt->close();
    }
  }

  public function issue_ID($applicant_id,$issue_date,$nic_object)
  {
    $sql = "INSERT INTO issued_id_history (applicant_id,issue_date, nic_object) VALUES (?,?,?)";
    if ($stmt = $link->prepare($sql)) {

            // Bind variables to the prepared statement as parameters

      $stmt->bind_param("sss", $param_applicant_id, $param_issue_date, $param_nic_object);

              // Set parameters
      $param_applicant_id = $applicant_id;
      $param_issue_date = $issue_date;
      $param_nic_object = serialize($nic_object);

      if($stmt->execute()){
              // Redirect to login page
        echo "<script type='text/javascript'>alert('The request has been send successfully!'); window.location.href = 'new_view_request.html';</script>"; 

      }else{
        echo "<script type='text/javascript'>alert('Ooops! Something went wrong!'); window.location.href = 'newRequest.php';</script>"; 
      }

            // Close statement
      $stmt->close();
    }
  }

  public function add_notification($from_id,$to_id,$n_object)
  {
   $sql = "INSERT INTO notification_details (from_id,to_id, n_object) VALUES (?,?,?)";
   if ($stmt = $link->prepare($sql)) {

          // Bind variables to the prepared statement as parameters

    $stmt->bind_param("sss", $param_from_id, $param_to_id, $param_n_object);

          // Set parameters
    $param_from_id = $from_id;
    $param_to_id = $to_id;
    $param_n_object = serialize($n_object);

    if($stmt->execute()){
             // Redirect to login page
      echo "<script type='text/javascript'>alert('The request has been send successfully!'); window.location.href = 'new_view_request.html';</script>"; 

    }else{
      echo "<script type='text/javascript'>alert('Ooops! Something went wrong!'); window.location.href = 'newRequest.php';</script>"; 
    }

           // Close statement
    $stmt->close();
  }
}

public function add_application($applicant_id,$division,$application_object)
{
  $sql = "INSERT INTO application_details (applicant_id,apply_date, division,application_object) VALUES (?,?,?)";
  if ($stmt = $link->prepare($sql)) {

          // Bind variables to the prepared statement as parameters

    $stmt->bind_param("ssss", $param_applicant_id, $param_apply_date, $param_division,$param_application_object);

          // Set parameters
    date_default_timezone_set('Asia/Colombo');
    $param_applicant_id = $applicant_id;
    $param_apply_date = date('Y/m/d H:i:s');;
    $param_division = $division;
    $param_application_object = serialize($application_object);

    if($stmt->execute()){
             // Redirect to login page
      echo "<script type='text/javascript'>alert('The request has been send successfully!'); window.location.href = 'new_view_request.html';</script>"; 

    }else{
      echo "<script type='text/javascript'>alert('Ooops! Something went wrong!'); window.location.href = 'newRequest.php';</script>"; 
    }

           // Close statement
    $stmt->close();
  }
}
public function get_row_id($table,$key,$key_value,$id_name)
{
  $sql = "SELECT $id_name FROM $table WHERE $key = ?";
  if ($stmt = $link->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
    $stmt->bind_param('s', $key_value);
            // Attempt to execute the prepared statement
            // just execute the prepared statement not checking values
    if ($stmt->execute()) {


      $result = $stmt->get_result();

                // Check if Username exists, if yes then verify Password

              //check is there are exactly one entry or not
      if ($result->num_rows == 1) {

        $row = $result->fetch_assoc();
        return $row[$id_name];


      } else 

    } else
    {
      echo "Oops! Something went wrong. Please try again later.";
    }

            // Close statement
    $stmt->close();
  }
}

public function approve_application($application_id,$approve_level)
{
  $sql = "UPDATE application_details SET stat=? WHERE app_id =?";
  
  if ($stmt = $link->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
    $stmt->bind_param('ss', $approve_level,$application_id);
            // Attempt to execute the prepared statement
            // just execute the prepared statement not checking values
    if ($stmt->execute()) {





    } else
    {
      echo "Oops! Something went wrong. Please try again later.";
    }

            // Close statement
    $stmt->close();
  }
}
}


?>

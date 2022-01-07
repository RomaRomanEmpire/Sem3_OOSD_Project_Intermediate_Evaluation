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
        $this->connect();
    }

    public function connect()
    {
        $this->DB_SERVER = 'localhost';
        $this->DB_USERNAME = 'root';
        $this->DB_PASSWORD = '';
        $this->DB_NAME = 'projectid';

        /* Attempt to connect to MySQL database */
        $this->link = new mysqli($this->DB_SERVER, $this->DB_USERNAME, $this->DB_PASSWORD, $this->DB_NAME);

        // Check connection
        if ($this->link->connect_error === false) {
            die("ERROR: Could not connect. " . $this->link->connect_error());
        }

    }

    public static function get_connection()
    {
        if (!isset($db)) {
            $db = new DB_OP();
        }
        return $db;
    }

    public function login_attempt($uname_or_email, $password)
    {
        $sql = "SELECT * FROM user_details where username=? or email = ?";
        if ($stmt = $this->link->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param('ss', $uname_or_email, $uname_or_email);

            // Attempt to execute the prepared statement
            // just execute the prepared statement not checking values
            if ($stmt->execute()) {


                $result = $stmt->get_result();

                // Check if Username exists, if yes then verify Password
                //check is there are exactly one entry or not
                if ($result->num_rows == 1) {

                    $row = $result->fetch_assoc();
                    if (password_verify($password, $row['pwd'])) {

                        // Store data in session variables
                        $_SESSION["user_id"] = $row['user_id'];

                        // Redirect user to welcome page
                        if ($row['u_type'] == 'applicant') {
                            header("location: applicant_dashboard.php");
                        } else if ($row['u_type'] == 'db_manager') {
                            header("location: DatabaseManagerDashboard.php");
                        } else if ($row['u_type'] == 'gn' || $row['u_type'] == 'ds' || $row['u_type'] == 'admin' || $row['u_type'] == 'es' || $row['u_type'] == 'principal' || $row['u_type'] == 'ni') {
                            header("location: RAP_Dashboard.php");
                        }
                    } else {
                        echo "<script type='text/javascript'>alert('The Password you entered was not valid!');</script>";
                    }
                } else {
                    // Display an error message if Username doesn't exist
                    echo "<script type='text/javascript'>alert('No account found with that Username!');</script>";
                }
            } else {
                echo "<script type='text/javascript'>alert('Oops! Something went wrong. Please try again later.!');</script>";
            }

            // Close statement
            $stmt->close();
        }
    }

    public function create_applicant_acc($username, $email, $pwd, $u_object)
    {
        $sql = "INSERT INTO user_details (u_type,username, email, pwd ,u_object) VALUES (?,?,?,?,?)";
        if ($stmt = $this->link->prepare($sql)) {

            // Bind variables to the prepared statement as parameters

            $stmt->bind_param("ssssb", $param_u_type, $param_username, $param_email, $param_pwd, $param_u_object);

            // Set parameters
            $param_u_type = "applicant";
            $param_username = $username;
            $param_email = $email;
            $param_pwd = password_hash($pwd, PASSWORD_DEFAULT);
            $param_u_object = serialize($u_object);

            if ($stmt->execute()) {
                // Redirect to login page
                echo "<script type='text/javascript'>alert('The account created successfully!'); window.location.href = 'Login.php';</script>";

            } else {
                echo "<script type='text/javascript'>alert('Ooops! Something went wrong!'); window.location.href = 'Create_Account.php';</script>";
            }

            // Close statement
            $stmt->close();
        }
    }

    public function create_staff_acc($staff_id, $u_type, $username, $email, $pwd, $u_object)
    {
        $sql = "INSERT INTO user_details (staff_id,u_type,username, email, pwd ,u_object) VALUES (?,?,?,?,?,?)";
        if ($stmt = $this->link->prepare($sql)) {

            // Bind variables to the prepared statement as parameters

            $stmt->bind_param("issssb", $param_staff_id, $param_u_type, $param_username, $param_email, $param_pwd, $param_u_object);

            // Set parameters
            $param_staff_id = $staff_id;
            $param_u_type = $u_type;
            $param_username = $username;
            $param_email = $email;
            $param_pwd = password_hash($pwd, PASSWORD_DEFAULT);
            $param_u_object = serialize($u_object);

            if ($stmt->execute()) {
                // Redirect to login page
                echo "<script type='text/javascript'>alert('The request has been send successfully!');</script>";

            } else {
                echo "<script type='text/javascript'>alert('Ooops! Something went wrong!');</script>";
            }

            // Close statement
            $stmt->close();
        }
    }

    public function update_user_account_details($user_id, $username, $email, $pwd, $u_object)
    {

        if (!is_null($pwd)) {
            $sql = "UPDATE user_details SET username=?, email=?, pwd=?, u_object=? WHERE user_id=?";
            if ($stmt = $this->link->prepare($sql)) {
                $stmt->bind_param("sssbi", $param_username, $param_email, $param_pwd, $param_u_object, $param_user_id);

                $param_username = $username;
                $param_email = $email;
                $param_pwd = password_hash($pwd, PASSWORD_DEFAULT);
                $param_user_id = $user_id;
                $param_u_object = serialize($u_object);

                if (!$stmt->execute()) {
                    // Redirect to login page
                    echo "<script type='text/javascript'>alert('Ooops! Something went wrong!'); window.location.href = 'Profile_Details.php';</script>";

                }
            }
        } else {
            $sql = "UPDATE user_details SET username=?, email=?, u_object=? WHERE user_id=?";
            if ($stmt = $this->link->prepare($sql)) {
                $stmt->bind_param("ssbi", $param_username, $param_email, $param_u_object, $param_user_id);

                $param_username = $username;
                $param_email = $email;
                $param_user_id = $user_id;
                $param_u_object = serialize($u_object);

                if (!$stmt->execute()) {
                    // Redirect to login page
                    echo "<script type='text/javascript'>alert('Ooops! Something went wrong!'); window.location.href = 'Profile_Details.php';</script>";
                }
            }
        }
        // Close statement
        $stmt->close();
    }

    public function issue_ID($applicant_id, $issue_date, $nic_object)
    {
        $sql = "INSERT INTO issued_id_history (applicant_id,issue_date, nic_object) VALUES (?,?,?)";
        if ($stmt = $this->link->prepare($sql)) {

            // Bind variables to the prepared statement as parameters

            $stmt->bind_param("isb", $param_applicant_id, $param_issue_date, $param_nic_object);

            // Set parameters
            $param_applicant_id = $applicant_id;
            $param_issue_date = $issue_date;
            $param_nic_object = serialize($nic_object);

            if ($stmt->execute()) {
                // Redirect to login page
                echo "<script type='text/javascript'>alert('The request has been send successfully!'); window.location.href = 'new_view_request.html';</script>";

            } else {
                echo "<script type='text/javascript'>alert('Ooops! Something went wrong!'); window.location.href = 'newRequest.php';</script>";
            }

            // Close statement
            $stmt->close();
        }
    }

    public function add_notification($from_id, $to_id, $n_object)
    {
        $sql = "INSERT INTO notification_details (from_id,to_id, n_object) VALUES (?,?,?)";

        if ($stmt = $this->link->prepare($sql)) {

            $stmt->bind_param("iib", $param_from_id, $param_to_id, $param_n_object);

            $param_from_id = $from_id;
            $param_to_id = $to_id;
            $param_n_object = serialize($n_object);

            if ($stmt->execute()) {
                echo "<script type='text/javascript'>alert('Application has been sent. Keep in touch!'); window.location.href = 'applicant_dashboard.php';</script>";
            } else {
                echo "<script type='text/javascript'>alert('Application has been sent. Keep in touch!'); window.location.href = 'applicant_dashboard.php';</script>";
            }
            $stmt->close();
        }
    }

    public function add_application($applicant_id, $stat, $gn_div_or_address, $ds, $application_object)
    {
        $sql = "INSERT INTO application_details (applicant_id,stat,apply_date, gn_div_or_address,ds,application_object) VALUES (?,?,?,?,?,?)";
        if ($stmt = $this->link->prepare($sql)) {

            // Bind variables to the prepared statement as parameters

            $stmt->bind_param("issssb", $param_applicant_id, $param_stat, $param_apply_date, $param_gn_div_or_address, $param_ds, $param_application_object);

            // Set parameters
            date_default_timezone_set('Asia/Colombo');
            $param_applicant_id = $applicant_id;
            $param_stat = $stat;
            $param_apply_date = date('Y/m/d H:i:s');
            $param_gn_div_or_address = $gn_div_or_address;
            $param_ds = $ds;
            $param_application_object = serialize($application_object);

            if ($stmt->execute()) {
                // Redirect to login page
//                echo "<script type='text/javascript'>alert('Application has been sent. Keep in touch!'); window.location.href = 'applicant_dashboard.php';</script>";
                echo "<script type='text/javascript'>alert('Application has been sent. Keep in touch!');</script>";
//                return $this->get_column_value("application_details", "app_id", ">", "0", "app_id", "ORDER BY staff_id DESC") ?? 0;
            } else {
                echo "<script type='text/javascript'>alert('Ooops! Something went wrong!');</script>";
            }

            // Close statement
            $stmt->close();
        }
    }

    public function get_column_value($table, $key, $operator, $key_value, $id_name, $order)
    {
        $sql = "SELECT $id_name FROM $table WHERE $key $operator ? $order";
        if ($stmt = $this->link->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param('s', $key_value);

            // Attempt to execute the prepared statement
            // just execute the prepared statement not checking values
            if ($stmt->execute()) {
                $result = $stmt->get_result();

                // Check if Username exists, if yes then verify Password
                //check is there are exactly one entry or not
                if ($result->num_rows >= 1) {

                    $row = $result->fetch_assoc();
                    return $row[$id_name];

                } else {
                    return NULL;
                }

                // Close statement
                $stmt->close();
            }
        }
    }

    public function get_column_value2($table, $key1, $key2, $operator, $key_value1, $key_value2, $id_name, $order)
    {
        $sql = "SELECT $id_name FROM $table WHERE $key1 $operator ? and $key2 $operator ? $order";
        if ($stmt = $this->link->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param('ss', $key_value1, $key_value2);

            // Attempt to execute the prepared statement
            // just execute the prepared statement not checking values
            if ($stmt->execute()) {
                $result = $stmt->get_result();

                //check is there are exactly one entry or not
                if ($result->num_rows >= 1) {

                    $row = $result->fetch_assoc();
                    return $row[$id_name];

                } else {
                    return NULL;
                }

                // Close statement
                $stmt->close();
            }
        }
    }

    public function approve_application($application_id, $approve_level)
    {
        $sql = "UPDATE application_details SET stat=? WHERE app_id =?";

        if ($stmt = $this->link->prepare($sql)) {

            // Bind variables to the prepared statement as parameters
            $stmt->bind_param('si', $approve_level, $application_id);

            // Attempt to execute the prepared statement
            // just execute the prepared statement not checking values
            if ($stmt->execute()) {

            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    public function database_details($table, $key, $key_value, $order)
    {
        if (empty($key))
            $sql = "SELECT * FROM $table WHERE ''= ? $order";
        else
            $sql = "SELECT * FROM $table WHERE $key= ? $order";
        if ($stmt = $this->link->prepare($sql)) {

            // Bind variables to the prepared statement as parameters
            $stmt->bind_param('s', $key_value);

            // Attempt to execute the prepared statement
            // just execute the prepared statement not checking values
            if ($stmt->execute()) {
                return $stmt->get_result();
            }
            // Close statement
            $stmt->close();
        }
    }

    public function database_details_2($table, $key1, $key2, $key_value1, $key_value2, $order)
    {
        $sql = "SELECT * FROM $table WHERE ($key1 = ? or $key2 = ?)$order";
        if ($stmt = $this->link->prepare($sql)) {

            // Bind variables to the prepared statement as parameters
            $stmt->bind_param('ss', $key_value1, $key_value2);

            // Attempt to execute the prepared statement
            // just execute the prepared statement not checking values
            if ($stmt->execute()) {
                return $stmt->get_result();
            }
            // Close statement
            $stmt->close();
        }
    }

    public function remove_data($table, $key, $key_value)
    {
        $sql = "DELETE FROM $table WHERE $key = ?";

        if ($stmt = $this->link->prepare($sql)) {

            $stmt->bind_param('s', $key_value);

            if ($stmt->execute()) {

                return true;

            } else {

                return false;
            }
            $stmt->close();
        }
    }

    public function get_table_info($table, $column, $value)
    {
        if ($value)
            $sql = "SELECT $column FROM $table";
        else
            $sql = "SELECT $column FROM $table WHERE staff_id = 0";
        if ($stmt = $this->link->prepare($sql)) {

            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $results = array();
                while ($row = $result->fetch_array(MYSQLI_NUM)) {
                    foreach ($row as $r) {
                        array_push($results, (string)$r);
                    }
                }
                return $results;
            }
            // Close statement
            $stmt->close();
        }
    }

    public function assign_staff_details($table, $basic_division, $staff_id)
    {
        $sql = "UPDATE $table SET staff_id=? WHERE basic_division=?";
        if ($stmt = $this->link->prepare($sql)) {
            $stmt->bind_param("is", $param_staff_id, $param_basic_division);

            $param_staff_id = $staff_id;
            $param_basic_division = $basic_division;

            if ($stmt->execute()) {
                // Redirect to login page
                echo "<script type='text/javascript'>alert('The request has been send successfully!'); window.location.href = 'Profile_Details.php';</script>";

            } else {
                echo "<script type='text/javascript'>alert('Ooops! Something went wrong!'); window.location.href = 'Profile_Details.php';</script>";
            }


        }
        $stmt->close();
    }
}
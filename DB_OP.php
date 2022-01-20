<?php

/**
 *
 */
class DB_OP
{
    private $link;
    private static DB_OP $db;

    private
    function __construct()
    {
        $this->connect();
    }

    private
    function connect()
    {
        $DB_SERVER = 'localhost';
        $DB_USERNAME = 'root';
        $DB_PASSWORD = '';
        $DB_NAME = 'projectid';

        /* Attempt to connect to MySQL database */
        $this->link = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

        // Check connection
        if ($this->link->connect_error === false) {
            die("Failed to connect to MySQL: (" . $this->link->connect_errno . ") " . $this->link->connect_error);
        }

    }

    public
    static function get_connection(): DB_OP
    {
        if (!isset(self::$db)) {
            self::$db = new DB_OP();
        }
        return self::$db;
    }

    public
    function login_attempt($uname_or_email, $password)
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

                        // Redirect user to dashboard page
                        header("location: dashboard.php");

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

    public
    function create_user_account($staff_id, $u_object): ?bool
    {
        if ($staff_id) {
            $sql = "INSERT INTO user_details (user_id, staff_id, u_type, username, email, pwd ,u_object) VALUES (?,?,?,?,?,?,?)";

            if ($stmt = $this->link->prepare($sql)) {

                // Bind variables to the prepared statement as parameters
                $stmt->bind_param("iisssss", $param_user_id, $param_staff_id, $param_u_type, $param_username, $param_email, $param_pwd, $param_u_object);

                // Set parameters
                $param_user_id = ($this->get_column_value("user_details", "user_id", ">", "0",
                            "user_id", "ORDER BY user_id DESC") ?? 0) + 1;
                $u_object->set_row_id($param_user_id);
                $param_staff_id = $staff_id;
                $param_u_type = $u_object->get_user_type();
                $param_username = $u_object->get_user_name();
                $param_email = $u_object->get_user_email();
                $param_pwd = $u_object->get_user_pwd();
                $param_u_object = serialize($u_object);

                if ($stmt->execute()) {
                    echo "<script type='text/javascript'>alert('The request has been send successfully!');</script>";
                    return true;

                } else {
                    echo "<script type='text/javascript'>alert('Ooops! Something went wrong!');</script>";
                }

                // Close statement
                $stmt->close();
            }

        } else {
            $sql = "INSERT INTO user_details (user_id,u_type,username, email, pwd ,u_object) VALUES (?,?,?,?,?,?)";
            if ($stmt = $this->link->prepare($sql)) {
                // Bind variables to the prepared statement as parameters
                $stmt->bind_param("isssss", $param_user_id, $param_u_type, $param_username, $param_email, $param_pwd, $param_u_object);

                // Set parameters
                $param_user_id = ($this->get_column_value("user_details", "user_id", ">", "0",
                            "user_id", "ORDER BY user_id DESC") ?? 0) + 1;
                $u_object->set_row_id($param_user_id);
                $param_u_type = $u_object->get_user_type();
                $param_username = $u_object->get_user_name();
                $param_email = $u_object->get_user_email();
                $param_pwd = $u_object->get_user_pwd();
                $param_u_object = serialize($u_object);

                if ($stmt->execute()) {
                    // Redirect to login page
                    echo "<script type='text/javascript'>alert('The Account Created successfully!');window.location.href='Login.php';</script>";
                    return true;
                } else {
                    echo "<script type='text/javascript'>alert('Ooops! Something went wrong!');</script>";
                }

                // Close statement
                $stmt->close();
            }
        }
        return NULL;
    }

    public
    function update_user_account_details($u_object)
    {
        $sql = "UPDATE user_details SET username=?, email=?, pwd=?, u_object=? WHERE user_id=?";
        if ($stmt = $this->link->prepare($sql)) {
            $stmt->bind_param("ssssi", $param_username, $param_email, $param_pwd, $param_u_object, $param_user_id);

            // Set parameters
            $param_username = $u_object->get_user_name();
            $param_email = $u_object->get_user_email();
            $param_pwd = $u_object->get_user_pwd();
            $param_u_object = serialize($u_object);
            $param_user_id = $u_object->getRowId();

            if ($stmt->execute()) {
                // Redirect to login page
                echo "<script type='text/javascript'>alert('The request has been send successfully!');</script>";

            } else
                echo "<script type='text/javascript'>alert('Ooops! Something went wrong!');</script>";

            // Close statement
            $stmt->close();
        }

    }

    public
    function issue_NIC($application_id, $nic_object)
    {
        $sql = "INSERT INTO issued_id_history (application_id,issue_date, nic_object) VALUES (?,?,?)";
        if ($stmt = $this->link->prepare($sql)) {

            // Bind variables to the prepared statement as parameters

            $stmt->bind_param("iss", $param_application_id, $param_issue_date, $param_nic_object);

            // Set parameters
            $param_application_id = $application_id;
            $param_issue_date = $nic_object->getIssuedDate();
            $param_nic_object = serialize($nic_object);

            if ($stmt->execute()) {
                // Redirect to login page
                echo "<script type='text/javascript'>alert('The request has been send successfully!'); </script>";

            } else {
                echo "<script type='text/javascript'>alert('Ooops! Something went wrong!'); window.location.href = 'newRequest.php';</script>";
            }

            // Close statement
            $stmt->close();
        }
    }

    public
    function add_notification($n_object): ?bool
    {
        $sql = "INSERT INTO notification_details (n_id,application_id, n_type, from_id, to_id, n_object) VALUES (?,?,?,?,?,?)";

        if ($stmt = $this->link->prepare($sql)) {

            $stmt->bind_param("iisiis", $param_n_id, $param_application_id, $param_n_type, $param_from_id, $param_to_id, $param_n_object);

            $param_n_id = ($this->get_column_value("notification_details", "n_id", ">", "0",
                        "n_id", "ORDER BY n_id DESC") ?? 0) + 1;
            $n_object->setRowId($param_n_id);
            $param_application_id = $n_object->getApplicationId();
            $param_n_type = $n_object->getType();
            $param_from_id = $n_object->getFromId();
            $param_to_id = $n_object->getToId();
            $param_n_object = serialize($n_object);

            if ($stmt->execute()) {
                echo "<script type='text/javascript'>alert('Notification has been sent!');</script>";
                return true;
            } else {
                echo "<script type='text/javascript'>alert('Oops!! Something wend wrong!!');</script>";
            }
            $stmt->close();
        }
        return NULL;
    }

    public
    function add_application($applicant_id, $table, $application_object)
    {
        $sql = "INSERT INTO application_details (app_id, applicant_id,stat,apply_date, gn_div_or_address,ds,address_type,application_object) VALUES (?,?,?,?,?,?,?,?)";
        if ($stmt = $this->link->prepare($sql)) {

            // Bind variables to the prepared statement as parameters

            $stmt->bind_param("iissssss", $param_app_id, $param_applicant_id, $param_stat, $param_apply_date, $param_gn_div_or_address, $param_ds, $param_address_type, $param_application_object);

            // Set parameters
            $param_app_id = ($this->get_column_value("application_details", "app_id", ">", "0",
                        "app_id", "ORDER BY app_id DESC") ?? 0) + 1;
            $application_object->setRowId($param_app_id);
            $param_applicant_id = $applicant_id;
            $param_stat = $application_object->getState()->getState();
            $param_apply_date = $application_object->getApplyDate();
            $param_gn_div_or_address = $application_object->getGnDivOrAddress();
            $param_ds = $application_object->getDs();
            $param_address_type = $table;
            $param_application_object = serialize($application_object);

            if ($stmt->execute()) {
                // Redirect to login page
                echo "<script type='text/javascript'>alert('Application has been sent. Keep in touch!');window.location.href='dashboard.php';</script>";
            } else {
                echo "<script type='text/javascript'>alert('Ooops! Something went wrong!');</script>";
            }

            // Close statement
            $stmt->close();
        }
    }

    public
    function application_processed($applicant_id, $application_object)
    {
        $sql = "INSERT INTO application_history(application_id, applicant_id ,basic_division, ds, application_object) VALUES (?,?,?,?,?)";
        if ($stmt = $this->link->prepare($sql)) {

            // Bind variables to the prepared statement as parameters

            $stmt->bind_param("iisss", $param_app_id, $param_applicant_id, $param_gn_div_or_address, $param_ds, $param_application_object);

            // Set parameters
            $param_app_id = $application_object->getRowId();
            $param_applicant_id = $applicant_id;
            $param_gn_div_or_address = $application_object->getGnDivOrAddress();
            $param_ds = $application_object->getDs();
            $param_application_object = serialize($application_object);

            if ($stmt->execute()) {
                // Redirect
                echo "<script type='text/javascript'>alert('Application moved to history!');</script>";
            } else {
                echo "<script type='text/javascript'>alert('Ooops! Something went wrong!');</script>";
            }

            // Close statement
            $stmt->close();
        }
    }

    public
    function save_state_of_application($application_object): ?bool
    {
        $sql = "UPDATE application_details SET application_object=?, stat=? WHERE app_id=?";
        if ($stmt = $this->link->prepare($sql)) {

            // Bind variables to the prepared statement as parameters

            $stmt->bind_param("ssi", $param_application_object, $param_stat, $param_app_id);

            // Set parameters

            $param_stat = $application_object->getState()->getState();
            $param_app_id = $application_object->getRowId();
            $param_application_object = serialize($application_object);

            if ($stmt->execute()) {
                // Redirect
                echo "<script type='text/javascript'>alert('Signature added successfully!');</script>";
                return true;
            } else {
                echo "<script type='text/javascript'>alert('Ooops! Something went wrong!');</script>";
            }

            // Close statement
            $stmt->close();
        }
        return NULL;
    }

    public
    function save_state_of_notification($n_object): ?bool
    {
        $sql = "UPDATE notification_details SET n_object=? WHERE n_id=?";
        if ($stmt = $this->link->prepare($sql)) {

            // Bind variables to the prepared statement as parameters

            $stmt->bind_param("si", $param_n_object, $param_n_id);

            // Set parameters

            $param_n_id = $n_object->getRowId();
            $param_n_object = serialize($n_object);

            if ($stmt->execute()) {
                return true;
            } else {
                echo "<script type='text/javascript'>alert('Ooops! Something went wrong!');</script>";
            }

            // Close statement
            $stmt->close();
        }
        return NULL;
    }

    public
    function remove_application($key, $key_value): ?bool
    {
        $sql = "DELETE FROM 'application details' WHERE $key=?";
        if ($stmt = $this->link->prepare($sql)) {

            // Bind variables to the prepared statement as parameters

            $stmt->bind_param("s", $key_value);

            if ($stmt->execute()) {
                // Redirect
                echo "<script type='text/javascript'>alert('Signature added successfully!');</script>";
                return true;
            } else {
                echo "<script type='text/javascript'>alert('Ooops! Something went wrong!');</script>";
            }

            // Close statement
            $stmt->close();
        }
        return NULL;
    }

    public
    function get_column_value($table, $key, $operator, $key_value, $id_name, $order)
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

                }
                // Close statement
                $stmt->close();
            }
        }
        return NULL;
    }

    public
    function get_column_value2($table, $key1, $key2, $key_value1, $key_value2, $id_name)
    {
        $sql = "SELECT $id_name FROM $table WHERE $key1 = ? and $key2 = ?";
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

                }

                // Close statement
                $stmt->close();
            }
        }
        return NULL;
    }

    public
    function get_column_value3($table, $key1, $key2, $key3, $key_value1, $key_value2, $key_value3, $id_name)
    {
        $sql = "SELECT $id_name FROM $table WHERE $key1 = ? and $key2 = ? and $key3 = ?";
        if ($stmt = $this->link->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param('sss', $key_value1, $key_value2, $key_value3);

            // Attempt to execute the prepared statement
            // just execute the prepared statement not checking values
            if ($stmt->execute()) {
                $result = $stmt->get_result();

                //check is there are exactly one entry or not
                if ($result->num_rows >= 1) {

                    $row = $result->fetch_assoc();
                    return $row[$id_name];

                }
                // Close statement
                $stmt->close();
            }
        }
        return NULL;
    }

    public
    function database_details($table, $key, $key_value, $order)
    {
        if ($key == 'ds')
            $sql = "SELECT * FROM $table WHERE stat != ? $order";
        elseif (empty($key))
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
        return NULL;
    }

    public
    function database_details_2($table, $key1, $key2, $operator1, $operator2, $key_value1, $key_value2, $order)
    {
        $sql = "SELECT * FROM $table WHERE ($key1 $operator1 ? and $key2 $operator2 ?)$order";
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
        return NULL;
    }

    public
    function remove_data($table, $key, $key_value): bool
    {
        $sql = "DELETE FROM $table WHERE $key = ?";

        if ($stmt = $this->link->prepare($sql)) {

            $stmt->bind_param('s', $key_value);

            if ($stmt->execute()) {

                return true;

            }
            $stmt->close();
        }
        return false;
    }

    public
    function get_table_info($table, $column, $value): ?array
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
//                return array_values($result);
            }
            // Close statement
            $stmt->close();
        }
        return NULL;
    }

    public
    function assign_staff_details($table, $division, $staff_id)
    {
        if ($table == 'ds')
            $sql = "UPDATE $table SET staff_id=? WHERE DS=?";
        else
            $sql = "UPDATE $table SET staff_id=? WHERE basic_division=?";
        if ($stmt = $this->link->prepare($sql)) {
            $stmt->bind_param("is", $param_staff_id, $param_division);

            $param_staff_id = $staff_id;
            $param_division = $division;

            if ($stmt->execute()) {
                // Redirect
                echo "<script type='text/javascript'>alert('The request has been send successfully!'); </script>";

            } else {
                echo "<script type='text/javascript'>alert('Ooops! Something went wrong!'); </script>";
            }


        }
        $stmt->close();
    }
}
<?php
include 'autoloader.php';
session_start();
$conn = DB_OP::get_connection();
$applicant = unserialize($conn->get_column_value("user_details", "user_id", "=", $_SESSION['user_id'], "u_object", ""));
$applicant->set_db($conn);

$ref_notification = unserialize($conn->get_column_value("notification_details", "n_id", "=", $_GET['n_id'], "n_object", ""));

if ($_GET['type'] == 'confirm') {
    $notification = $applicant->prepare_notification('confirmation', 'date confirmed');
} else {
    $notification = $applicant->prepare_notification('appointment', 'requesting for another date');
}
$notification->setFromId($_SESSION['user_id']);
$notification->setToId($ref_notification->getFromId());
$notification->setApplicationId($ref_notification->getApplicationId());
$notification->setAppointmentDate($ref_notification->getAppointmentDate());
$notification->setAppointmentTime($ref_notification->getAppointmentTime());
$notification->setReferenceNotificationId($_GET['n_id']);

$applicant->send_notification($notification);

header("location: Applicant_notification.php");


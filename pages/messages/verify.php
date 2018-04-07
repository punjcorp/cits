<?php

require 'connect.php';
$conn = connectDB();
$return_arr = array();

if (isset($_POST['g-recaptcha-response'])) {
	$receivedRecaptcha = $_POST['g-recaptcha-response'];
}
$google_secret = '6Le8U0wUAAAAAEch2gO0ocR5MUhBOIo4MFJFybJT';
$verifiedRecaptcha = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $google_secret . '&response=' . $receivedRecaptcha);

$verResponseData = json_decode($verifiedRecaptcha);

if ($verResponseData->success) {

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (isset($_POST['Name'])) {
			$name = $_POST['Name'];
		}
		if (isset($_POST['Phone'])) {
			$phone = $_POST['Phone'];
		}
		if (isset($_POST['Email'])) {
			$email = $_POST['Email'];
		}
		if (isset($_POST['Subject'])) {
			$subject = $_POST['Subject'];
		}
		if (isset($_POST['Message'])) {
			$message = $_POST['Message'];
		}
		$createdDate = date("Y-m-d H:i:s");

		$insertQuery = $conn->prepare("INSERT into enquiry (name,phone,email, subject,query_text,created_date) VALUES(:name, :phone, :email, :subject, :message, :createdDate)");

		$insertQuery->bindParam(':name', $name);
		$insertQuery->bindParam(':phone', $phone);
		$insertQuery->bindParam(':email', $email);
		$insertQuery->bindParam(':subject', $subject);
		$insertQuery->bindParam(':message', $message);
		$insertQuery->bindParam(':createdDate', $createdDate);

		if (!$insertQuery->execute()) {
			$return_arr[] = array("error" => "Error saving your message!!");
		}

		$return_arr[] = array("status" => "Thank You For Contacting Us.");

		// Encoding array in JSON format
		echo json_encode($return_arr);
	}
} else {
	$return_arr[] = array("error" => "Captcha Validation Failed!!");
	echo json_encode($return_arr);
}
?>
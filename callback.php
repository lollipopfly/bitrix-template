<?php
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
	include "qucikCapthca/result.php";

	$mail_template = "ORDER_CALLBACK";

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$name         = trim($_POST['name']);
		// $phone        = trim($_POST['phone']);
		$email        = trim($_POST['email']);
		$comment      = trim($_POST['message']);

		if ( ($name === '') || ($email === '') ) {
			$status = 'field_error';
			echo $status;
			return false;
		}

	 	if ($string !== $userstring){
	 		$status = 'captcha_error';
	 		echo $status;

	 		return false;
	 	} else {
	 		session_destroy();
	 	}

		$arEventFields = array(
			"NAME"         => htmlspecialchars($name),
			// "PHONE"        => htmlspecialchars($phone),
			"EMAIL"        => htmlspecialchars($email),
			"MESSAGE"      => htmlspecialchars($message),
		);

		if(CEvent::SendImmediate($mail_template, SITE_ID, $arEventFields)){
			$status = "Ваше письмо отправлено!";
			echo $status;
		} else {
			$status = "Ошибка отправки письма!";
			echo $status;
		}
	} else {
		$status = "Не удалось отправить сообщение!";
		echo $status;
	}
?>


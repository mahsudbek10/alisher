<?php

if(session_status() != PHP_SESSION_ACTIVE) session_start ();
if(isset($_SESSION['user_email'])) header("Location: index");
$title = "<span class='text-success'>Astana </span> "
        . "<span class='text-danger'>Education </span> "
        . "<span class='text-primary'>Center </span> "
        . "<span class='text-warning'>Теsт </span>";

function test_input($data) {
    $data1 = trim($data);
    $data2 = strip_tags($data1);
    $data3 = stripslashes($data2);
    $data4 = htmlspecialchars($data3);
    $data5 = htmlentities($data4);
    return $data5;
}

require_once '../db/db.php';
$errors = array();
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['email'], $_POST['_csrf'], $_POST['pass'])) {
    $_POST['email'] = test_input($_POST['email']);
    $_POST['pass'] = test_input($_POST['pass']);
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $user = R::findOne('useraec', 'email = ?', array($_POST['email']));
        if ($user) {
			if($user->is_blocked==0){
				if (password_verify($_POST['pass'], $user->pass)) {
					//если пароль совпадает, то нужно авторизовать пользователя
					$school = R::findOne('school', 'id = ?', array($user->school));
					$_SESSION['user_id'] = $user->id;
					$_SESSION['user_fio'] = $user->fio;
					$_SESSION['user_school_id'] = $user->school;
					$_SESSION['user_school'] = $school->name." (".$school->description.")";
					$_SESSION['user_email'] = $user->email;
					$_SESSION['user_money'] = $user->money;
					$_SESSION['user_city_id'] = $user->city;
					$_POST = NULL;
					unset($_POST);
					$user = NULL;
					header("Location: index");
				} else {
					$errors[] = 'Неверный логин или пароль!';
				}
			} else $errors[] = 'Ваш аккаунт заблокирован';
        }$errors[] = 'Неверный логин или пароль!';
    }$errors[] = 'Неверный логин или пароль!';
}
//    header("Location: login.php");
$_POST = NULL;
$user = NULL;
?>

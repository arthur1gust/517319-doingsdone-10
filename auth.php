<?php
require_once("functions.php");
require_once ("init.php");
require_once('helpers.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form_auth = $_POST;
    $errors = [];
    $required = ['email', 'password'];
	
	foreach ($required as $key) {
	    if (empty($form_auth[$key])) {
	        $errors[$key] = 'Это поле надо заполнить';
        }
    }
	
	$errors['email'] = filter_var($form_auth['email'], FILTER_VALIDATE_EMAIL) ? null : 'Введите корректный email';
	/*
	if (filter_var($form_auth['email'], FILTER_VALIDATE_EMAIL)) {
		$errors['email'] = filter_var($form_auth['email']);
}   else {
		$errors['email'] = "E-mail адрес '$form_auth['email']' указан верно.\n";
}
	*/
    
    $errors = array_filter($errors);
	
	$email = mysqli_real_escape_string($link, $form_auth['email']);
	$sql_auth = "SELECT * FROM users WHERE email = '$email'";
    $res = mysqli_query($link, $sql_auth);
	
	$user = $res ? mysqli_fetch_array($res, MYSQLI_ASSOC) : null;
	
	if (!count($errors) && $user) {
		if (password_verify($form_auth['password'], $user['password'])) {
			$_SESSION['user'] = $user;
		}
		else {
			$errors['password'] = 'Неверный пароль';
		}
	}
	else {
		$errors['email'] = 'Такой пользователь не найден';
	}
	if (count($errors)) {
		$page_content = include_template('auth.php', [
            'form_auth' => $form_auth,
            'errors' => $errors
            ]);
	}
	else {
		header("Location: /index.php");
		exit();
	}
}
else {
    $page_content = include_template('auth.php', []);
    if (isset($_SESSION['user'])) {
        header("Location: /index.php");
        exit();
    }
}
$layout_content = include_template('layout.php', [
    'title' => 'Добавить задачу',
    'content' => $page_content,
	'tasks' => $tasks,
	'projects' => $projects,
	'projects_id' => $projects_id,
	'menu_user' => include_template('menu_user.php')
]);

print($layout_content);





?>
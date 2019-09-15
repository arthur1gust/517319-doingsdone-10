<?php
require_once('init.php');
require_once('funcs.php');
require_once('helpers.php');

	$value = [];
	
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form_reg = $_POST;
    $errors = [];
    $register_value = ['email', 'password', 'name'];
    foreach ($register_value as $key) {
        if (empty($form_reg[$key])) {
            $errors[$key] = 'Это поле надо заполнить';
        }
    }
	
	$errors['email'] = filter_var($form_reg['email'], FILTER_VALIDATE_EMAIL) ? null : 'Введите корректный email';
	$errors = array_filter($errors);
	
	if (empty($errors)) {
        $email = mysqli_real_escape_string($link, $form_reg['email']);
        $sql = "SELECT id 
				FROM users 
				WHERE email = '$email'";
        $result = mysqli_query($link, $sql);
		
        if (mysqli_num_rows($result) > 0) {
            $errors['email'] = 'Пользователь с этим email уже зарегистрирован';
        } else {
            $password = password_hash($form_reg['password'], PASSWORD_DEFAULT);
            $sql = 'INSERT INTO users (email, name, password) VALUES (?, ?, ?)';
            $stmt = db_get_prepare_stmt($link, $sql, [$form_reg['email'], $form_reg['name'], $password]);
            $result = mysqli_stmt_execute($stmt);
        }
        if ($result && empty($errors)) {
            header("Location: /index.php");
            exit();
        }
    }
    $value['errors'] = $errors;
    $value['values'] = $form_reg;
}
$page_content = include_template('registration.php', $value);
	
$layout_content = include_template('layout.php', [
    'content'    => $page_content,
    'title'      => 'Страница регистрации'
]);
print($layout_content);

?>
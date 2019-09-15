<?php
// показывать или нет выполненные задачи
	$show_complete_tasks = rand(0, 1);

	require_once('functions.php');
	require_once('data.php');
	require_once('init.php');
	require_once('helpers.php');


if (!$link) {
    $error = mysqli_connect_error();
    $content = include_template('error.php', ['error' => $error]);
}

if (isset($_SESSION['user'])) { 
	
	$id_user = $_SESSION['user']['id'];
	
	$sql_projects = "SELECT projects.id, projects.name, COUNT(tasks.id) as tasks_count 
		FROM projects LEFT JOIN tasks  
		ON projects.id = tasks.project_id 
		WHERE projects.user_id = '$id' 
		GROUP BY projects.id";
    $result = mysqli_query($link, $sql_projects);
	
	if (!$result) {
        die(mysqli_error($link));
    }
	
	$projects = mysqli_fetch_all($result, MYSQLI_ASSOC);
	
	if (!isset($_GET['id'])) {
        $sql_task = "SELECT * 
					 FROM tasks 
					 WHERE user_id = '$id' ";
        $res = mysqli_query($link, $sql_task);
    }
	else {
        $id_user = mysqli_real_escape_string($link, $_GET['id']);
        $sql = "SELECT * 
				FROM tasks 
				WHERE user_id = '$id'";
        $res = mysqli_query($link, $sql);
        if (!$res) {
            die(mysqli_error($link));
        }
        if (!mysqli_num_rows($res)) {
            http_send_status('404');
			print("404");
			die();
        }
    }

	$user = $_SESSION['user']; //Переменные для layout
    $user_name = $_SESSION['user']['name'];

/*
if (isset($_GET['id'])) {
    $projects_id = mysqli_real_escape_string($link, $_GET['id']);
	
	$sql_projects ="SELECT id, title FROM projects WHERE id=$projects_id";
	
	if ((mysqli_query($link, $sql_projects))===false or count($tasks)===0){
		http_send_status('404');
		print("404");
		die();
    }
	
	$sql_task ="SELECT  dt_doing, name_task, status, project_id FROM tasks
        JOIN projects ON tasks.project_id = projects.id WHERE projects.id=$projects_id";
		
		
	
}
else {
	$sql_task = "select distinct `id`, `name_task` FROM tasks where user_id = '$id' ";
}
*/
		
//$result = mysqli_query($link, $sql);
if ($result = mysqli_query($link, $sql_task)) {
    $tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
else {
		$error = mysqli_error($link);
		$content = include_template('error.php', ['error' => $error]);
	}
//$sql_projects ="SELECT id=$projects_id, title FROM projects";

$sql_projects ="SELECT id, title FROM projects";



 $sql_projects ="SELECT id, title FROM projects WHERE user_id = 1";
 $result = mysqli_query($link, $sql_projects);
 
	if ($result) {
		$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);	
	}
	else {
		$error = mysqli_error($link);
		$content = include_template('error.php', ['error' => $error]);
	}


/*
else {
	// Получаем список проектов
	//$sql_projects = 'select distinct `id`, `title` FROM projects where user_id = 1';

	//Выполняем запрос
	//$result = mysqli_query($link, $sql_projects);
	
	if ($result) {
		$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);	
	}
	else {
		$error = mysqli_error($link);
		$content = include_template('error.php', ['error' => $error]);
	}
	
	$sql_task = 'select distinct `id`, `name_task` FROM tasks where user_id = 1 ';
	$result_task = mysqli_query($link, $sql_task);
	
	if ($result_task) {
		$tasks = mysqli_fetch_all($result_task, MYSQLI_ASSOC);	
	}
	else {
		$error = mysqli_error($link);
		$content = include_template('error.php', ['error' => $error]);
	}
}
*/

	

$page_content = include_template('main.php', [
	'tasks' => $tasks, 
	'projects' => $projects, 
	'projects_id' => $projects_id
]);
$layout_content = include_template('layout.php', [
    'title' => 'Главная страница проекта',
    'content' => $page_content,
	'tasks' => $tasks,
	'projects' => $projects,
	'projects_id' => $projects_id,
	'menu_user' => include_template('menu_user.php'),
	'user' => $user,
    'user_name' => $user_name
]);
}
//Если пользователь не зарегистрирован
else {
$page_content = include_template('guest.php', []);
$layout_content = include_template('layout.php', [
    'title' => 'Главная страница проекта',
    'user' => [],
	'user_name' => '',
	'content' => $page_content
]);
}
print($layout_content);
?>
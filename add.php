<?php
require_once('helpers.php');
require_once('funcs.php');
require_once('init.php');

if (!$link) {
    $error = mysqli_connect_error();
    $content = include_template('error.php', ['error' => $error]);
}

$sql = 'SELECT projects.id, projects.title, COUNT(tasks.id) FROM projects 
LEFT JOIN tasks 
ON projects.id = tasks.project_id WHERE projects.user_id = 1 GROUP BY projects.id ';
$result = mysqli_query($link, $sql);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $required = ['date','project','task_name'];
    $errors = [];
    $rules = [
		'date' => function() {
            return validateDate('date');
        },
		'project' => function() {
            return validateProject('project');
        },
        'task_name' => function() {
            return validateTask('task_name');
        }   
    ];
	
	foreach ($_POST as $key => $value) {
        if (isset($rules[$key])) {
            $form_rules = $rules[$key];
            $errors[$key] = $form_rules();
        }
    }

	$errors = array_filter($errors);
	
	
	if (empty($errors) && isset($_FILES['file'])) {
        $file_name = $_FILES['file']['name'];
        $file_path = __DIR__ . '/uploads/';
		$file_url  = '/uploads/' . $file_name;
		$tmp_name = $_FILES['file']['tmp_name'];
		
		move_uploaded_file($tmp_name, $file_path . $file_name);
		$task['path'] = $file_name;
    }
	
	if (count($errors)) {
		$tasks_template = include_template('tasks_add.php', [
            'task' => $task,
            'projects' => $projects,
			'errors' => $errors]);
	} 
	else {
        $sql = 'INSERT INTO tasks (user_id, id, project_id, name_task, dt_create, dt_doing, status) VALUES (1, ?, ?, ?, NOW(), ?, ?)';
        $stmt = db_get_prepare_stmt($link, $sql, $task);
        $res = mysqli_stmt_execute($stmt);
		
        if (!$res) {
            die(mysqli_error($link));
        }
        header("Location: /index.php");
    }
} 
	else {
    $tasks_template = include_template('tasks_add.php', 
	['projects' => $projects]);
}
	
	

$page_content = include_template('tasks.php', ['tasks' => $tasks, 'categories' => $categories, 'projects_id' => $projects_id]);

$layout_content = include_template('layout.php', [
    'title' => 'Добавить задачу',
    'content' => $page_content
]);

print($layout_content);

?>
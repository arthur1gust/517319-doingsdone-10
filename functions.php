<?php
	function tasks_count($array, $project_id) {
		$i = 0;
	    foreach ($array as $array_key => $array_value) { 
			if ($array_value['project_id'] === $project_id) {
				$i +=1;
			}
		} 
	 return $i;
	}
	
	

	function call_date($date_tasks) {
	date_default_timezone_set("Asia/Krasnoyarsk");
		$current_date = time();
		$task_date = strtotime($date_tasks);
		$hour = 3600;
		$diff = $task_date - $current_date;
		$time_total = floor($diff / $hour);
	return $time_total;
	}
	
	function validationName($name) {
    if (empty($_POST[$name])) {
        return "Поле название задачи пустое, заполните его, пожалуйста";
		}
	}
	
	function validationProject($link, $projects_id) {
    $sql_project ="SELECT id FROM projects WHERE id=$projects_id";
    $res = mysqli_query($link, $sql_project);
    if ($res==false ){
        return "Данного проекта нет в базе данных";
    }
    return null;
}

	function validationDate($date) {
    if ( date('Y-m-d', strtotime($_POST[$date])) !== $_POST[$date] and !empty($_POST[$date])
        or date('Y-m-d', strtotime($_POST[$date]))<date('Y-m-d') and !empty($_POST[$date]) ) {
        return "Дата не выбрана или имеет неверный формат";
		}
    else {
		return null;
	}
}
?>
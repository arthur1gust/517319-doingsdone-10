<?php
	function tasks_count($project_name, $array) {
		$i = 0;
	    foreach ($array as $array_key => $array_value) { 
			if ($array_value['category'] === $project_name) {
				$i +=1;
			}
		} 
	 return $i;
	}
	
	function include_template($name, $data) {
    $name = 'templates/' . $name;
    $result = '';
    if (!file_exists($name)) {
        return $result;
    }
    ob_start();
    extract($data);
    require $name;
    $result = ob_get_clean();
    return $result;
};

	function call_date($date_tasks) {
	date_default_timezone_set("Asia/Krasnoyarsk");
		$current_date = time();
		$task_date = strtotime($date_tasks);
		$hour = 3600;
		$diff = $task_date - $current_date;
		$time_total = floor($diff / $hour);
	return $time_total;
	}
?>
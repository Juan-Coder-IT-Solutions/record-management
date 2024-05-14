<?php
	if($page == 'dashboard'){
		require view.'dashboard.php';
	}else if($page == 'users'){
		require view.'users.php';
	}else if($page == 'programs'){
		require view.'programs.php';
	}else if($page == 'tasks'){
		require view.'tasks.php';
	}else if($page == 'list-tasks'){
		require view.'list_tasks.php';
	}else if($page == 'assign-task'){
		require view.'assign_task.php';
	}else if($page == 'profile'){
		require view.'profile.php';
	}else{
		if(!empty($page) or $page != $page){
			require view.'error.php';
		}else{
			require view.'dashboard.php';
		}
	}
	
 ?>

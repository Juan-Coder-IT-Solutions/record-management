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
	}else if($page == 'faculty-task-report'){
		require view.'faculty_task_report.php';
	}else if($page == 'manage-assigned-task'){
		require view.'manage_assigned_task.php';
	}else if($page == 'list-task'){
		require view.'task_report.php';
	}else if($page == 'task-report'){
		require view.'task_report_details.php';
	}else if($page == 'users-report'){
		require view.'users_report.php';
	}else if($page == 'evaluation-report'){
		require view.'evaluation_report.php';
	}else if($page == 'chair-task'){
		require view.'chair_task.php';
	}else{
		if(!empty($page) or $page != $page){
			require view.'error.php';
		}else{
			require view.'dashboard.php';
		}
	}
	
 ?>

<?php
	function create_classwork($week,$list_of_subjects,$reg_id)
	{
		$insert_sql="insert into `classwork` (classwork_id,registration_id,subject,score,week) values";
		$mysubjects=explode(',', $list_of_subjects);
		$no_of_subjects=count($mysubjects);
		
		for($count_sub=0;$count_sub<$no_of_subjects;$count_sub++)
		{
			$subject=$mysubjects[$count_sub];
			$classwork_id=$reg_id.$subject.$week;
			$score=0.0;
			$insert_sql .= "('$classwork_id','$reg_id','$subject','$score','$week'),";
		}
		$insert_sql=trim($insert_sql,",");
		$execute_sql=mysql_query($insert_sql);
		if($execute_sql==FALSE)
		{
			?>
            	<p class="error">Error encountered setting classwork construct! <?php echo mysql_error(); ?></p>
            <?php
			die();
		}
	}
	
	
	function create_assignment($week,$list_of_subjects,$reg_id)
	{
		$insert_sql="insert into `assignment` (assignment_id,registration_id,subject,score,week) values";
		$mysubjects=explode(',', $list_of_subjects);
		$no_of_subjects=count($mysubjects);
		
		for($count_sub=0;$count_sub<$no_of_subjects;$count_sub++)
		{
			$subject=$mysubjects[$count_sub];
			$assignment_id=$reg_id.$subject.$week;
			$score=0.0;
			$insert_sql .= "('$assignment_id','$reg_id','$subject','$score','$week'),";
		}
		$insert_sql=trim($insert_sql,",");
		$execute_sql=mysql_query($insert_sql);
		if($execute_sql==FALSE)
		{
			?>
            	<p class="error">Error encountered setting assignment construct! <?php echo mysql_error(); ?></p>
            <?php
			die();
		}
	}
	
	
	function create_test($week,$list_of_subjects,$reg_id)
	{
		$insert_sql="insert into `test` (test_id,registration_id,subject,score,week) values";
		$mysubjects=explode(',', $list_of_subjects);
		$no_of_subjects=count($mysubjects);
		
		for($count_sub=0;$count_sub<$no_of_subjects;$count_sub++)
		{
			$subject=$mysubjects[$count_sub];
			$test_id=$reg_id.$subject.$week;
			$score=0.0;
			$insert_sql .= "('$test_id','$reg_id','$subject','$score','$week'),";
		}
		$insert_sql=trim($insert_sql,",");
		$execute_sql=mysql_query($insert_sql);
		if($execute_sql==FALSE)
		{
			?>
            	<p class="error">Error encountered setting test construct! <?php echo mysql_error(); ?></p>
            <?php
			die();
		}
	}
?>


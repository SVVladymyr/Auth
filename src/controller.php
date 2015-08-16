<?php
 include_once("action_form.php");
 $aform = new Action_form();
 if($_POST['num'] == 1)
	$aform->login();
 else
	if($_POST['num'] == 2)
		$aform->registration();
?>
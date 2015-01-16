<?php
	require_once('../cloudns.php');
	
	$cloudns = new ClouDNS();
	$result = $cloudns->set_options(array('auth_id' => '384','auth_password' => 'password'));
	
	if($result['status'] != 'Success'){
		echo $result['statusDescription'];
		exit;
	} 

	echo '<h1>List Zone Statistics</h1>';
	
	$zones = $cloudns->list_zone_stats();
	
	echo 'Zones used: '.$zones['count'].'/'.$zones['limit'];
?>
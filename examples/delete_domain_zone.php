<?php
	require_once('../cloudns.php');
	
	$cloudns = new ClouDNS();
	$result = $cloudns->set_options(array('auth_id' => '384','auth_password' => 'password'));
	
	if($result['status'] != 'Success'){
		echo $result['statusDescription'];
		exit;
	} 

	echo '<h1>Delete domain zone</h1>';
	
	$delete_result = $cloudns->delete_domain_zone('myawesomedomain.com');
	
	print_r($delete_result);
?>
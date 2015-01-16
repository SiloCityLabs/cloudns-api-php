<?php
	require_once('../cloudns.php');
	
	$cloudns = new ClouDNS();
	$result = $cloudns->set_options(array('auth_id' => '384','auth_password' => 'password'));
	
	if($result['status'] != 'Success'){
		echo $result['statusDescription'];
		exit;
	} 

	echo '<h1>List Zones</h1>';
	
	$page = 1;
	$rows = 10;
	$zones = $cloudns->list_zones($page,$rows);
	
	echo '<table>';
		echo '<tr><td>Zone</td><td>Zone type</td></tr>';
	
		foreach ($zones['Data'] as $key => $zone)
		{
			echo 	'<tr>
						<td>'.$zone['name'].'</td>
						<td>'.$zone['type'].'</td>
					</tr>';
		}
	
	echo '</table>';
	
	echo 'Page '.$page.' of '.$zones['Pages'];
?>
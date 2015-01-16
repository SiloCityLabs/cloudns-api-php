<?php
	require_once('../cloudns.php');
	
	$cloudns = new ClouDNS();
	$result = $cloudns->set_options(array('auth_id' => '384','auth_password' => 'password'));
	
	if($result['status'] != 'Success'){
		echo $result['statusDescription'];
		exit;
	} 

	echo '<h1>List Available name servers</h1>';
	
	$nameservers = $cloudns->list_name_servers();
	
	echo '<table>';
		echo '<tr><td>Type</td><td>Name</td><td>ipv4</td><td>ipv6</td><td>location</td><td>location_cc</td></tr>';
	
		foreach ($nameservers as $key => $nameserver)
		{
			echo 	'<tr>
						<td>'.$nameserver['type'].'</td>
						<td>'.$nameserver['name'].'</td>
						<td>'.$nameserver['ip4'].'</td>
						<td>'.$nameserver['ip6'].'</td>
						<td>'.$nameserver['location'].'</td>
						<td>'.$nameserver['location_cc'].'</td>
					</tr>';
		}
	
	echo '</table>';
?>
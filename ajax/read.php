<?php
	require 'lib.php';
	
	$object = new CRUD();
	
	$data = '
		<table class="table table-bordered table-striped">
			<tr>
				<th>No.</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Update</th>
				<th>Delete</th>
			</tr>
	';
	
	$users = $object->Read();
	
	if(count($users)>0) {
		$number = 1;
		
		foreach($users as $user) {
			$data .= '
			<tr>
				<td>'.$number.'</td>
				<td>'.$user['first_name'].'</td>
				<td>'.$user['last_name'].'</td>
				<td>'.$user['email'].'</td>
				<td>
					<button class="btn btn-warning" onclick="GetUserDetails('.$user['id'].')">Update</button>
				</td>
				<td>
					<button class="btn btn-danger" onclick="DeleteUser('.$user['id'].')">Delete</button>
				</td>
			</tr>
			';
			$number++;
		}
	}
	else {
		$data .= '<tr><td colspan="6">Records not found!</td></tr>';
	}
	$data .= '
		</table>
	';
	
	echo $data;
?>
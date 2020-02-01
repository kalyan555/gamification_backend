<?php 

require_once '../includes/DbOperations.php';

$response = array(); 

if($_SERVER['REQUEST_METHOD']=='POST'){
	if(isset($_POST['goalId'])){
		$db = new DbOperations(); 

		if($db->getGoalbyId($_POST['goalId'])){
			$result = $db->getGoalbyId($_POST['goalId']);
			$response['error'] = false; 
			$response['id'] = $result['goal_id'];
			$response['goal_name'] = $result['goal_name'];
            $response['goal_amount'] = $result['goal_amount'];
            $response['saved_amount'] = $result['saved_amount'];
			$response['goal_status'] = $result['goal_status'];

		}else{
			$response['error'] = true; 
			$response['message'] = "Invalid Goal ID";			
		}
    }
}

echo json_encode($response);
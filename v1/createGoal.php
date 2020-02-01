<?php 

require_once '../includes/DbOperations.php';

$response = array(); 

if($_SERVER['REQUEST_METHOD']=='POST'){
	if(isset($_POST['username']) and isset($_POST['goalName']) and isset($_POST['amount'])){
            $db = new DbOperations(); 
    
            $result = $db->createGoal( 	$_POST['username'],
                                        $_POST['goalName'],
                                        $_POST['amount']
                                    );
            if($result == 1){
                $response['error'] = false; 
                $response['message'] = "Goal Created successfully";
            }elseif($result == 2){
                $response['error'] = true; 
                $response['message'] = "Some error occurred please try again";			
            }
        }
        else{
            $response['error'] = true; 
            $response['message'] = "Required fields are missing";
        }
    }else{
        $response['error'] = true; 
        $response['message'] = "Invalid Request";
    }

echo json_encode($response);
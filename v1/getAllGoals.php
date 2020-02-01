<?php          
    		$servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "gamification";

            $conn = mysqli_connect ( $servername, $username, $password, $dbname);
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $response=array();  
            if($_SERVER['REQUEST_METHOD']=='POST'){
                if(isset($_POST['username'])){
                    $username=$_POST['username'];
                    $sql="select * from tbl_goals where username='$username'";
                    $result=mysqli_query($conn,$sql); 
                    while($row=mysqli_fetch_assoc($result)){
                        $data=array();
                        $data['id'] = $row['goal_id'];
                        $data['goal_name'] = $row['goal_name'];
                        $data['goal_amount'] = $row['goal_amount'];
                        $data['saved_amount'] = $row['saved_amount'];
                        $data['goal_status'] = $row['goal_status'];
                        $response[$row['goal_id']]= $data;
                }
            }
            echo json_encode($response);
        }		
?>
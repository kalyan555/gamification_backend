<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gamification";

$conn = mysqli_connect ( $servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['goalId']) && isset($_POST['amount'])){
        $goalId=$_POST['goalId'];
        $amount=$_POST['amount'];
        $saved_amount=0;
        $goal_amount=0;
        $username;
        $sql="select * from `tbl_goals` where `goal_id`=$goalId";
        $result=mysqli_query($conn,$sql);
        // echo $result;
        if($row=mysqli_fetch_assoc($result)){
            $saved_amount=$row['saved_amount'];
            $goal_amount=$row['goal_amount'];
            $username=$row['username'];
        }
        $saved_amount=$saved_amount+$amount;
        if($saved_amount==$goal_amount)
            $sql="UPDATE `tbl_goals` SET `saved_amount`=$saved_amount `goal_status`=1 WHERE `goal_id`=$goalId";
        else 
            $sql="UPDATE `tbl_goals` SET `saved_amount`=$saved_amount WHERE `goal_id`=$goalId";
        $result=mysqli_query($conn,$sql);

        $curent_transaction_date=date("Y-m-d");


        $sql="INSERT INTO `tbl_goal_transacfions`(`goal_id`, `amount`, `date`) VALUES ($goalId,$amount,'$curent_transaction_date')";
        $result=mysqli_query($conn,$sql);


        $final_transaction_date;
        $sql="select * from `tbl_goal_streak` where `username`='$username'";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)!=0){
            $row=mysqli_fetch_assoc($result);
            $final_transaction_date=$row['last_date'];
            $streak=$row['streak_count'];
            $diff=date_diff(date_create($final_transaction_date),date_create($curent_transaction_date));
            if($diff->format("%R%a")==="+1"){
                $streak=$streak+1;
                $sql="UPDATE `tbl_goal_streak` set `last_date`='$curent_transaction_date', `streak_count`=$streak where `username`='$username'";
                if (mysqli_query($conn, $sql)) {
                    echo "Streak Increased";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }
            elseif($diff->format("%R%a")==="+0" || $diff->format("%R%a")==="-0"){
                echo "Streak Unchanged";
            }
            else echo "Streak Reset to 1";

        }
        else{
            $sql="INSERT INTO `tbl_goal_streak`(`username`, `last_date`, `streak_count`) VALUES ('$username','$curent_transaction_date',1)";
            if (mysqli_query($conn, $sql)) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }
    else echo "Invalid Request";
}

?>
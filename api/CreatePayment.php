<?php
    session_start();
    //require('razorpay-php/Razorpay.php');
    require_once $_SERVER["DOCUMENT_ROOT"]."/event_management/api/vendor/autoload.php";
    use Razorpay\Api\Api;
    

    include "../conn.php";
    
    $enroll=$_REQUEST['enroll'];
    $event_id=$_REQUEST['event_id'];
    $amt=$_REQUEST['amt'];
    $date=$_REQUEST['date'];
    $curtime=$_REQUEST['curtime'];
    $keyId="rzp_test_qp4uEp2A5RYhgI";
    $keySecret="R9IENBdt2w2RIS63Ibhsq4aK";
    $amt_val=intval($amt);


    $api = new Api($keyId, $keySecret);
    $orderData = [
        'receipt'         => 'rc_1',
        'amount'          => $amt_val * 100,
        'currency'        => "INR",
    ];
    $razorpayOrder = $api->order->create($orderData);
    $orderid=$razorpayOrder['id'];
    $orderStatus=$razorpayOrder['status'];
    $orderAmount=$razorpayOrder['amount'];

    $sql="INSERT INTO transaction (order_id,amount,receipt,status,event_id,enrollment,date,time) VALUES ('$orderid','$amt','rc_1','created','$event_id','$enroll','$date','$curtime')";
    if(mysqli_query($conn,$sql))
        {
            $jsonresponse ='{ "id": "'.$orderid.'","amount":'.$orderAmount.',"status":"'.$orderStatus.'" }';
            echo $jsonresponse;
        }
        else
        {
            echo "Error".$sql."<br>".mysqli_error($conn);
        }
        mysqli_close($conn);
    
?>
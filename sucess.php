<?php
    require "Connection.php";
    if(isset($_REQUEST['q'])){ 
        $id=$_REQUEST['q'];
        $refid=$_REQUEST['refId'];
        $query="select * from temp where id='$id'";
        $result=mysqli_query($con,$query);
        $row=mysqli_fetch_assoc($result);
        if(mysqli_num_rows($result)==0){

            die();
        }
        $id=$row['pid'];
        $isbn=$row['isbnno'];
        $price=$row['totalPrice'];
        $uname=$row['username'];
        $upto=$row['upto'];
        $url = "https://uat.esewa.com.np/epay/transrec";
        $data =[
            'amt'=> $price,
            'rid'=> $refid,
            'pid'=>$id,
            'scd'=> 'EPAYTEST'
        ];
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        $date=date('y-m-d');
        if( strpos($response,'Success')){
            $query="delete from temp where id='$id'";
            mysqli_query($con,$query);
            $query2="insert into rentedbook values('$isbn','$uname','$date','$upto')";
            mysqli_query($con,$query2);
            header("Location:userui.php");      
        }
        curl_close($curl);
    }
?>
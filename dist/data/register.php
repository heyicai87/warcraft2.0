<?php
header('Content-Type:application/json');
@$uid=$_REQUEST['userId'] or die('["code":1,"msg":"userId required"]');
@$un=$_REQUEST['username'] or die('["code":3,"msg":"username required"]');
@$mail=$_REQUEST['mailAddr'] or die('["code":4,"msg":"mailAddr required"]');
@$upwd=$_REQUEST['upwd'] or die('["code":5,"msg":"upwd required"]');
@$sid=$_REQUEST['safeVal'] or die('["code":6,"msg":"safeVal required"]');
@$sask=$_REQUEST['safeAsk'] or die('["code":7,"msg":"safeAsk required"]');
@$pc=$_REQUEST['poolChk'] or die('["code":8,"msg":"poolChk required"]');
require('0_init.php');
$sql="SELECT * FROM wow_user WHERE username='$un' or mailAddr='$mail'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_row($result);
$output=[];
if($row!=NULL){
	$output=[
		"code"=>11,
		"msg"=>"用户名或邮箱已使用"
	];
	echo json_encode($output);	
}
else{
	$sql="INSERT INTO wow_user VALUES(NULL,'$un','$mail','$upwd',$sid,'$sask',$uid,'$pc')";
	$result=mysqli_query($conn,$sql);
	if($result===true){
	  $output=[
		"code"=>2,
		"rgcode"=>mysqli_insert_id($conn),
		"msg"=>"注册成功",
		"name"=>$un
	  ];
	}else{
	  $output=[
		"code"=>9,
		"msg"=>"注册失败"
	  ];
	}
	echo json_encode($output);
}
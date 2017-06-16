<?php
header('Content-Type:application/json;charset=UTF-8');
@$um=$_REQUEST['mailAddr'] or die('{"code":1,"msg":"mailAddr required"}');
@$upwd=$_REQUEST['upwd'] or die('{"code":3,"msg":"upwd required"}');
require('0_init.php');
$sql="SELECT * FROM wow_user WHERE mailAddr='$um' and upwd='$upwd'";
$result=mysqli_query($conn,$sql);
$uname=mysqli_fetch_assoc($result)['username'];
//var_dump($uname);
if($uname===NULL){
  $output=[
    'code'=>4,
    'msg'=>'账号不存在或密码错误'
  ];
}else{
  $output=[
    'code'=>2,
    'msg'=>$uname
  ];
}
echo json_encode($output);
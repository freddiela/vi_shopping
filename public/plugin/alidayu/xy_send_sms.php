<?php

function xy_send($appkey,$secret,$phone,$sendtxt,$sign,$smstemplate){

include "TopSdk.php";
date_default_timezone_set('Asia/Shanghai'); 

$c = new TopClient;
$c ->appkey = $appkey ;
$c ->secretKey = $secret ;
$req = new AlibabaAliqinFcSmsNumSendRequest;
$req ->setExtend( "" );
$req ->setSmsType( "normal" );
$req ->setSmsFreeSignName( $sign );
$req ->setSmsParam( "{code:'8888'}" );
$req ->setRecNum( $phone );
$req ->setSmsTemplateCode( "SMS_5046933" );
$resp = $c ->execute( $req );
return $resp;
}

?>
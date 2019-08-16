
<?
    $login_wsdl = "http://tw.every8d.com/API20/Security.asmx?wsdl";
    $sms_wsdl = "http://tw.every8d.com/API20/Message.asmx?wsdl";
    
    $custID ="av8d20";   //請勿更改
    $userID="TKUAHRX";  //您的EVERY8D帳號 
    $password="smsAHRX@tku_7012"; //您的EVERY8D密碼
    $client = new SoapClient($login_wsdl);
    // login
    $params = array("custID"=>$custID,"userID"=>$userID,"password"=>$password,"APIType"=>"","version"=>""); 
    $objResult =$client->Login($params);
    $xmlstr= $objResult->LoginResult;
    
    $xml = new SimpleXMLElement($xmlstr);
    
    if($xml->ERROR_CODE =="0000"){
    	
    	echo "<font color=red>登入簡訊伺服器，成功!!</font><br/>";
    }else{
    	echo "登入簡訊伺服器，失敗!!<br/>";
    	exit;
    }
    
    // send sms
    
    $UserNo = $xml->USER_NO;      //從登入結果取得UserNo
    $CompanyNo = $xml->COMPANY_NO; //從登入結果取得Company_No
    $Credit = $xml->CREDIT;        //從登入結果取得目前剩餘額度
    $subject = iconv("BIG5","UTF-8", "修繕完工通知簡訊");   //發送主旨
    $sms_content="蘭陽校園通知：報修編號".$_GET[isno]."已完成，請協助確認及評價，謝謝。";
    $content = iconv("BIG5","UTF-8", $sms_content);  //發送內容
//    $content = iconv("BIG5","UTF-8", $sms_content);  //發送內容
   
    $mobile = $_GET[phone]; //發送號碼
    $email = "";  //發送email位置
    $sendTime= "";  //發送時間
    
    $sms_xml =	'<REPS>';
    $sms_xml .=		'<IP></IP>';
    $sms_xml .=		'<CARD_NO/>';
    $sms_xml .=		'<USER NAME="" MOBILE="'.$mobile.'" EMAIL="'.$email.'" SENDTIME="'.$sendTime.'" PARAM=""/>';
    $sms_xml .=	'</REPS>';


    
    $params_sms = array("custID"=>$custID,
    			"CompanyNo"=>$CompanyNo,
    			"userNo"=>$UserNo,
    			"sendtype"=>"110",
    			"msgCategory"=>"10",
    			"subject"=>$subject,
    			"content"=>$content,
    			"image"=>"",
    			"Audio"=>"",
    			"xml"=>$sms_xml,
    			"batchID"=>"",
    			"certified"=>"");
    
    $sms_Service = new SoapClient($sms_wsdl);		
    $sendResult = $sms_Service->QueueIn($params_sms);
    $sendResultStr = $sendResult->QueueInResult;
    if( substr($sendResultStr,0,1) =="-"){
        echo "Send SMS Failure!<br/>";	
    }else{
    	echo "Send SMS Successfully<br/>";
    }
    
    
    
?>
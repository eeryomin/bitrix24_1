<?php 		
	$queryUrl = 'https://b24-ma2x0d.bitrix24.ru/rest/1/bneamtpgmf1q4cno/crm.lead.add.json';		
	$queryData = http_build_query(array(
		'fields' => array(
		  "TITLE" => "Заявка от ".$_REQUEST['name'].' '.$_REQUEST['surname'],
		  "LAST_NAME" => $_REQUEST['surname'],
		  "NAME" => $_REQUEST['name'],
		  "EMAIL" => array(array("VALUE" => $_REQUEST['email'], "VALUE_TYPE" => "WORK" )),
		  "SOURCE_DESCRIPTION" => "CRM-форма",
		  "COMMENTS" => $_REQUEST['text'],
		  "ASSIGNED_BY_ID" => 1
        ),
        'params' => array("REGISTER_SONET_EVENT" => "Y")
    ));		  
		
	$curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_SSL_VERIFYPEER => 0,
      CURLOPT_POST => 1,
      CURLOPT_HEADER => 0,
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_URL => $queryUrl,
      CURLOPT_POSTFIELDS => $queryData,
    ));
 
    $result = curl_exec($curl);
    curl_close($curl);
 
    $result = json_decode($result, 1);
 
    if (array_key_exists('error', $result)) {
		echo "Ошибка при сохранении лида: ".$result['error_description'];
	}
    else {
	  readfile("response.htm");
    }
 ?>

        <?php
 						
		class OAMUser{
			public $guid;
			public $customerType;
			public $gncCustomerID;
			public $gncCoachID;
			public $sponsorREPID;
			public $telephoneNumber;
			public $firstName;
			public $lastName;
			public $username;
			public $email;
			public $dob;
			public $lastCC;
			public $cardWarning;
			public $cardType;
			public $gender;
			public $leadWheelType;
			public $companyName;
			public $startDate;
			public $govID;
			public $termAndCondition;
			public $leadWheelLanguage;
			public $continuity;
			public $coachId;
			public $coachRank;
			public $coachRankDesc;
		}

		function retrieveUserDetails($guidParam, $coachId, $country, $agentId)
		{			
			$user = new OAMUser();
			$user->guid = $guidParam;
			$user->continuity = array();
			$user->cardWarning = 'N';
			$user->coachId = $coachId;
			
			$soapUser="opauser";
			#$soapPassword="I10ve3h@k0logy";
			$soapPassword="ZAQ!2wsx";
			#$url = 'https://apim.beachbody.com:8443/api/v1/isg/getCustomerOrders';
			$url = 'https://apimqa.beachbody.com:8443/api/v1/isg/getCoachVerificationDetails';
			
			$request = '{"InputParameters": {"P_GUID": "'.$guidParam.'","P_COUNTRY": "'.$country.'","P_EMAIL_ADDRESS": "","P_CALLING_MODULE":"UAD","P_CALLING_EBS_USER":"'.$agentId.'","P_ATTRIBUTE1": "","P_ATTRIBUTE2": "","P_ATTRIBUTE3": "","P_ATTRIBUTE4": "","P_ATTRIBUTE5": ""}}';					
			$response = callWebService('POST',$soapUser,$soapPassword,$request,$url,3); 
			$jsonResponse = json_decode($response, false);
			
			$user = retrieveCreditCardDetails($user,$jsonResponse,"ENTERED");
			
			if ($user->lastCC == null)
			{
				$user = retrieveCreditCardDetails($user,$jsonResponse,"CLOSED");
			}
			$user = retrieveContinuity($user, $jsonResponse);
			
			$user->continuity = array_unique($user->continuity);
			
			$user = retrieveBirthDetails($user,$jsonResponse);
			
			return $user;
		}
		
		function retrieveContinuity($user, $jsonResponse)
		{
			if (is_array($jsonResponse->OutputParameters->P_CUST_ORDER_DETAILS_TAB->P_CUST_ORDER_DETAILS_TAB_ITEM->ORD_DETAIL_TAB->ORD_DETAIL_TAB_ITEM))
			{
				foreach($jsonResponse->OutputParameters->P_CUST_ORDER_DETAILS_TAB->P_CUST_ORDER_DETAILS_TAB_ITEM->ORD_DETAIL_TAB->ORD_DETAIL_TAB_ITEM as $order)
				{
					if ($order->GROUP_LIST === 'BSF' && $order->FLOW_STATUS_CODE === "ENTERED")
					{
						$user->continuity[] = "Business Service Fee";
					}
					else if ($order->GROUP_LIST === 'MYB' && $order->FLOW_STATUS_CODE === "ENTERED")
					{
						$user->continuity[] = "Beachbody on demand";
					}
					else if ($order->GROUP_LIST === 'SHK' && $order->FLOW_STATUS_CODE === "ENTERED")
					{
						$user->continuity[] = "Shakeology";
					}
					else if ($order->GROUP_LIST === 'ACT' && $order->FLOW_STATUS_CODE === "ENTERED")
					{
						$user->continuity[] = "Activit";
					}
				}
			}
			else{
				$order = $jsonResponse->OutputParameters->P_CUST_ORDER_DETAILS_TAB->P_CUST_ORDER_DETAILS_TAB_ITEM->ORD_DETAIL_TAB->ORD_DETAIL_TAB_ITEM;
				if ($order->GROUP_LIST === 'BSF' && $order->FLOW_STATUS_CODE === "ENTERED")
				{
					$user->continuity[] = "Business Service Fee";
				}
				else if ($order->GROUP_LIST === 'MYB' && $order->FLOW_STATUS_CODE === "ENTERED")
				{
					$user->continuity[] = "Beachbody on demand";
				}
				else if ($order->GROUP_LIST === 'SHK' && $order->FLOW_STATUS_CODE === "ENTERED")
				{
					$user->continuity[] = "Shakeology";
				}
				else if ($order->GROUP_LIST === 'ACT' && $order->FLOW_STATUS_CODE === "ENTERED")
				{
					$user->continuity[] = "Activit";
				}
			}
			return $user;
		}
		
		function retrieveCreditCardDetails($user, $jsonResponse, $flowStatusCode)
		{
			if (is_array($jsonResponse->OutputParameters->P_CUST_ORDER_DETAILS_TAB->P_CUST_ORDER_DETAILS_TAB_ITEM->ORD_DETAIL_TAB->ORD_DETAIL_TAB_ITEM))
			{
				foreach($jsonResponse->OutputParameters->P_CUST_ORDER_DETAILS_TAB->P_CUST_ORDER_DETAILS_TAB_ITEM->ORD_DETAIL_TAB->ORD_DETAIL_TAB_ITEM as $order)
				{
					if ($order->GROUP_LIST === 'BSF' && $order->FLOW_STATUS_CODE === $flowStatusCode)
					{
						$user->lastCC = $order->PAYMENT_INFO->CC_TOKEN_NO;
						$user->cardType = $order->PAYMENT_INFO->CARD_TYPE;	
						$user->cardWarning = isCardExpired($order->PAYMENT_INFO->EXPIRAY_DATE);
						break;
					}
				}
			}
			else{
				$order = $jsonResponse->OutputParameters->P_CUST_ORDER_DETAILS_TAB->P_CUST_ORDER_DETAILS_TAB_ITEM->ORD_DETAIL_TAB->ORD_DETAIL_TAB_ITEM;
				if ($order->GROUP_LIST === 'BSF' && $order->FLOW_STATUS_CODE === $flowStatusCode)
				{
					$user->lastCC = $order->PAYMENT_INFO->CC_TOKEN_NO;
					$user->cardType = $order->PAYMENT_INFO->CARD_TYPE;	
					$user->cardWarning = isCardExpired($order->PAYMENT_INFO->EXPIRAY_DATE);
				}
			}
			return $user;
		}
		
		function isCardExpired($expiredDate)
		{
			$cardExpired = "N";
			$cardTime = strtotime(substr($expiredDate,0,10));
			if ($cardTime < time())
			{
			  $cardExpired = "Y";
			}
			return $cardExpired;
		}
		
		function retrieveCoachRank($user)
		{
			$soapUser="";
			$soapPassword="";
			if ($user->guid)
			{
				$url = 'https://g6sllhcc5e.execute-api.us-west-2.amazonaws.com/prod/getLifeTimeRank?guid='.$user->guid;				
			}
			else{
				$url = 'https://g6sllhcc5e.execute-api.us-west-2.amazonaws.com/prod/getLifeTimeRank?member_id='.$user->coachId;
			}			
			
			$response = callWebService("GET",$soapUser,$soapPassword,null,$url,3); 
			
			$jsonResponse = json_decode($response, false);				
			$user->coachRank = $jsonResponse->result->rank_id;
			$user->coachRankDesc = $jsonResponse->result->rank_desc;
			return $user;
		}

		function retrieveBirthDetails($user,$jsonResponse)
		{			
			$user->customerType = $jsonResponse->IdentityResponse->searchUser->customerType;
			$user->gncCustomerID = $jsonResponse->IdentityResponse->searchUser->gncCustomerID;
			$user->gncCoachID = $jsonResponse->IdentityResponse->searchUser->gncCoachID;
			$user->sponsorREPID = $jsonResponse->IdentityResponse->searchUser->sponsorREPID;
			$user->telephoneNumber = $jsonResponse->IdentityResponse->searchUser->telephoneNumber;
			$user->firstName = $jsonResponse->IdentityResponse->searchUser->firstName;
			$user->lastName = $jsonResponse->IdentityResponse->searchUser->lastName;
			$user->username = $jsonResponse->IdentityResponse->searchUser->username;
			$user->email = $jsonResponse->IdentityResponse->searchUser->email;
			$user->dob = $jsonResponse->IdentityResponse->searchUser->dob;			
			$user->gender = $jsonResponse->IdentityResponse->searchUser->gender;
			$user->leadWheelType = $jsonResponse->IdentityResponse->searchUser->leadWheelType;
			$user->companyName = $jsonResponse->IdentityResponse->searchUser->companyName;
			$user->startDate = $jsonResponse->IdentityResponse->searchUser->startDate;
			$user->govID = $jsonResponse->IdentityResponse->searchUser->govID;
			$user->termAndCondition = $jsonResponse->IdentityResponse->searchUser->termAndCondition;
			$user->leadWheelLanguage = $jsonResponse->IdentityResponse->searchUser->leadWheelLanguage;
			return $user;
		}
		
		function callWebService($method, $soapUser, $soapPassword, $requestPayload, $webserviceEndPoint, $noOfRetries)
		{
			$counter      = 0;
			$retry        = true;
			$errorMessage = "Success";
			$response = "";
					
			while (($counter < $noOfRetries) && $retry) {
				$counter = $counter + 1;
				$ch      = curl_init();
				curl_setopt($ch, CURLOPT_URL, $webserviceEndPoint);
				curl_setopt($ch, CURLOPT_FAILONERROR, true); 
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
				curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
				// Indicate that the message should be returned to a variable
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_FORBID_REUSE, true);
				curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
				curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
				if (!empty($soapUser))
				{
					curl_setopt($ch, CURLOPT_USERPWD, $soapUser . ":" . $soapPassword);				
					curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
				}
				if (!empty($requestPayload) && $method == 'POST'){
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $requestPayload);	
				}
				if (!empty($requestPayload) && $method == 'PUT'){
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
					curl_setopt($ch, CURLOPT_POSTFIELDS, $requestPayload);				
				}
				// Make request
				$response = curl_exec($ch);
				if (curl_errno($ch)) {			
					$errorMessage = curl_getinfo($ch, CURLINFO_HTTP_CODE).':'.curl_error($ch);
					curl_close($ch);
					sleep (2);
				} else {
					$retry = false;
					curl_close($ch);
				}
			}
			return $response;
		}
    			
		?>
         <?php
			$guidParam = $_GET['p_guid'];			
			$country = $_GET['p_country'];
			$coachId = $_GET['p_coachId'];
			$agentId = $_GET['p_agent'];
            if (isset($_GET['p_guid']) && !empty($_GET['p_guid'])) {
				$guidParam = $_GET['p_guid'];
				load_curl();
				$user = retrieveUserDetails($guidParam, $coachId, $country, $agentId);
            }
         ?>
<html><data>{"Card":"<?php echo $user->lastCC; ?>", "CardType":"<?php echo $user->cardType; ?>", "CardWarning":"<?php echo $user->cardWarning; ?>","DateOfBirth":"<?php echo $user->dob; ?>", "Countinuity":"<?php echo implode(",",$user->continuity); ?>", "CoachRank":""}</data><head></head>
<body></body>
</html>
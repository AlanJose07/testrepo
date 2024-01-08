
<html>
<head>

</head>
<body>
<?php
load_curl();
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://identity.prod.gateway.beachbody.com/search',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "searchFilterName": "email",
    "searchFilterValue": "francesse@yopmail.com"
}',
  CURLOPT_HTTPHEADER => array(
    'api-key: AGENT:US:1234',
    'Content-Type: application/json',
    'x-api-key: 4JS1NWuyYgaNZNDjrJAI97dSFWyL8aoS9UrTA0yG'
  ),
));

$resp = json_decode(curl_exec($curl));
		echo "<pre>";
		print_r($resp);

curl_close($curl);

?>
</body>
</html>

<?php
namespace Custom\Models;
use RightNow\Utils\Framework as Framework, RightNow\Utils,
   RightNow\Connect\v1_4 as RNCPHP;
class oauthjwkCOModal extends \RightNow\Models\Base {
    function __construct() {
		
        parent::__construct();
		
		
    }
	
	function validateToken($id)
	{
		
		$pieces = explode(".", $id);
		$data = $pieces[0].".".$pieces[1];
		$signature = base64_decode(str_replace(['-','_'], ['+','/'], $pieces[2]));
		$header = json_decode(base64_decode(str_replace(['-','_'], ['+','/'], $pieces[0])), true);
		$payload = json_decode(base64_decode(str_replace(['-','_'], ['+','/'], $pieces[1])), true);
		$alg = $header['alg'];
		$kid = $header['kid'];
		$email = $payload['email'];
		$guid = $payload['guid'];
		$exp = $payload['exp'];
		logmessage($exp .'-'. time());
		if(time() >= $exp )
		{
			return array('validity' =>'invalid','cid' => '');
		}
		if(!empty($kid)){
			logmessage($kid);
					try
					{
						$dataresult = RNCPHP\ROQL::query( "SELECT ID,exponent,modulus FROM BB.akamai_jwk WHERE kid='".$kid."'")->next();
						$row = $dataresult->next();
						if(!empty($row['ID']))
						{
							$e = trim($row['exponent']);
							$n = trim($row['modulus']);
						}
						else
						{
							$login_url = \RightNow\Utils\Config::getConfig(1000081); //CUSTOM_CFG_BB_AUTH_URL
							logmessage("login url ".str_replace("authorize","jwk",$login_url));
								load_curl();
								$curl = curl_init();
								curl_setopt_array($curl, array(
								CURLOPT_URL => $login_url,
								CURLOPT_RETURNTRANSFER => true,
								CURLOPT_ENCODING => "",
								CURLOPT_MAXREDIRS => 10,
								CURLOPT_SSL_VERIFYHOST =>0,
								CURLOPT_SSL_VERIFYPEER =>0,
								CURLOPT_TIMEOUT => 0,
								CURLOPT_FOLLOWLOCATION => true,
								CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
								CURLOPT_CUSTOMREQUEST => "GET",
								));
								
								$jwkdetails = json_decode(curl_exec($curl),true);
								logmessage($jwkdetails);
								$err1 = curl_error($curl);
								if(empty($err1))
								{
									$jwkkeys = $jwkdetails['keys'];
									foreach ($jwkkeys as &$key) {
										
															if($kid == $key['kid'])
															{
																	$e = $key['e'];
																	$n = $key['n'];
															}
															$jwk_key = new RNCPHP\BB\akamai_jwk();
															$jwk_key->use_jwk = $key['use'];
															$jwk_key->kty = $key['kty'];
															$jwk_key->kid = $key['kid'];
															$jwk_key->alg = $key['alg'];
															$jwk_key->modulus = $key['n'];
															$jwk_key->exponent = $key['e'];
															$jwk_key->save(RNCPHP\RNObject::SuppressAll);
															
															}
								}
								curl_close($curl);
						}
						
						
					}
						catch(Exception $e)
					  {
							logmessage($e->getMessage());
						 return 0;
					  }
				logmessage($n.'-'.$e);
				$n = str_replace(['-','_'], ['+','/'], $n);
				$n = base64_decode($n);

				//$e = 'AQAB';
				$e = base64_decode($e);
				$this->CI->load->library('math_biginteger');
				$this->CI->load->library('Crypt_Hash');
				$this->CI->load->library('crypt_rsa');
				$rsa = new $this->CI->crypt_rsa();
				 $rsa->loadKey([
					'n' => new $this->CI->math_biginteger($n, 256),
					'e' => new $this->CI->math_biginteger($e, 256)
				]);
		 
				$rsa->setHash('sha256');
				$rsa->setSignatureMode(CRYPT_RSA_SIGNATURE_PKCS1);
				$validity=  $rsa->verify($data, $signature) ?
					'valid' :
					'invalid';
				$c_id = $this->CI->model('Contact')->lookupContactByEmail($email)->result;
				return array('validity' =>$validity,'cid' => $c_id);
		}
		
	}
	
	
}
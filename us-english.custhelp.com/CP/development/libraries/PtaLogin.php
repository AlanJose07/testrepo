<?php 

namespace Custom\Libraries;
use RightNow\Connect\Crypto\v1_4 as Crypto,
	RightNow\Utils\Config;

class PtaLogin
{
    private $CI;
    private $mode_id = 1;
    private $IV_value = '1234567812345678';
    private $key_size_lookup_name = '128_bits';
    //private $aes_key = "fnpptats86452937";

    function __construct(){
        $this->CI = get_instance();
    }

    function ptaUrlGenerator($contacts,$redirect_url) {

        $user_name = $contacts->Login;
        //$first_name = $contacts->Name->First;
        //$last_name = $contacts->Name->Last;
		$email = $contacts->Emails[0]->Address;
        //$name = $first_name;
         
        $ptaDataArray = [ 'p_email.addr'=> $email, 'p_userid' => (string)$user_name, 'p_passwd' => '' ,'p_li_expiry' => time() + (1*15)];


        //Convert PTA data array to query string
        //$ptaDataString = http_build_query($ptaDataArray);

		$ptaDataString = "";
		foreach($ptaDataArray as $key=>$value){
		    $ptaDataString .= ($ptaDataString === "") ? '' : '&';
		    $ptaDataString .= "$key=$value";
		}


        $iv = "\x0\x0\x0\x0\x0\x0\x0\x0\x0\x0\x0\x0\x0\x0\x0\x0";
        try{
            $cipher = new Crypto\AES();
            $cipher->Mode->ID = $this->mode_id;
            $cipher->IV->Value = $this->IV_value;
            $cipher->KeySize->LookupName = $this->key_size_lookup_name;
            $cipher->Key = Config::getConfig(PTA_SECRET_KEY);
            $cipher->Text = (string)$ptaDataString;
            $cipher->Padding->Id = 2;
            $cipher->encrypt();
            $encrypted_text = $cipher->EncryptedText;
            $encrypted_text = strtr(base64_encode($encrypted_text), ['+' => '_', '/' => '~', '=' => '*']);

        } catch (Exception $err ){
            echo $err->getMessage();
            exit;
        }
        $encrypted_url = $redirect_url . $encrypted_text;

        return $encrypted_url;
    }
}

<?php

require_once(get_cfg_var("doc_root") . "/ConnectPHP/Connect_init.php" );
initConnectAPI();
use RightNow\Connect\Crypto\v1_3 as Crypto;

/**
 * This helper can be loaded a few different ways depending on where it's being called:
 *
 * From a widget or model: $this->CI->load->helper('opa_v3')
 *
 * From a custom controller: $this->load->helper('opa_v3')
 *
 * Once loaded you can call this function by simply using getOPAURL()
 */
function getOPAURL($profile, $baseUrl, $policy_model_attr, $locale_attr, $init_id_attr, $seed_data, $checkpointId, $shared_secret) {

    $wdUrl = getWebDeterminationsUrl($baseUrl);

    if ($profile != null) {
        $userToken = generateUserToken($profile, $shared_secret);
        if ($userToken != '') {
            $security_params = '?user=' . $userToken;
        }
    }

    if ($policy_model_attr != '') {
        $policy_model = '/' . $policy_model_attr;

        // locale only applicable if policy model is specified
        if ($locale_attr != '') {
            $locale = '/' . $locale_attr;
        }
    }

    if ($init_id_attr != '' && $security_params != '') {
        $initID = '&initID=' . $init_id_attr;
    }

    if ($checkpointId != null) {
        $sessionAction = "/resumesession";
        $params = $security_params . $initID . '&cpfid=' . strval($checkpointId);

    } else {
        if ($seed_data != '') {

            if ($security_params != '') {
                $seed_param = '&seedData=' . urlencode($seed_data);
                
            } else {
                $seed_param = '?seedData=' . urlencode($seed_data);
            }
        }

        $sessionAction = "/startsession";
        $params = $security_params . $initID . $seed_param;
    }

    return $wdUrl . $sessionAction . $policy_model . $locale . $params;
}

function getWebDeterminationsUrl($baseUrl) {
    if (substr($baseUrl, 0, 4) !== 'http') {
        $baseUrl = 'https://' . $baseUrl;
    }
    return $baseUrl . "/web-determinations";
}

function generateUserToken($profile, $shared_secret) {

    if ($profile != null) {
        $contactID = $profile->c_id->value;

        if ($contactID > 0 && $shared_secret != '') {
            $ts = round(microtime(true) * 1000);
            $plaintext = $contactID . ';' . $ts . ';';
            $token = sha256($plaintext . $shared_secret);
            return $plaintext . $token;
        }
    }
}

function sha256($text) {
    try {
         $md = new Crypto\MessageDigest();  
         $md->Algorithm->ID = 3;
         $md->Text = $text;
         $md->Encoding->ID = 1;
         $md->hash();
         return bin2Hex($md->HashText);

    } catch (Exception $err) {
         echo $err->getMessage();
    }
}
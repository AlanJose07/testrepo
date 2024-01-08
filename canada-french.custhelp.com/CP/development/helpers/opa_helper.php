<?php

function getOPAURL($profile, $url_attr, $policy_model_attr, $locale_attr, $init_id_attr,$seed_data)
{
    /**
     * This helper can be loaded a few different ways depending on where it's being called:
     *
     * From a widget or model: $this->CI->load->helper('opa')
     *
     * From a custom controller: $this->load->helper('opa')
     *
     * Once loaded you can call this function by simply using getOPAURL()
     */

    // SET THIS TO THE VALUE OBTAINED FROM OPA-HUB -> DATA SERVICE
    $shared_secret = '118faa6c-09c3-4693-bd75-55ee040b75d1';

    if ($profile != null)
    {
        $contactID = $profile->c_id->value;

        if ($contactID > 0 && $shared_secret != '')
        {
            $ts = round(microtime(true) * 1000);
            $plaintext = $contactID . ';' . $ts . ';';
            $token = sha1($plaintext . $shared_secret);
            $security_params = '?user=' . $plaintext . $token;
        }
    }

    if ($policy_model_attr != '')
    {
        $policy_model = '/' . $policy_model_attr;

        // locale only applicable if policy model is specified
        if ($locale_attr != '')
        {
            $locale = '/' . $locale_attr;
        }
    }

    if ($init_id_attr != '' && $security_params != '')
    {
        $initID = '&initID=' . $init_id_attr;
    }
	if ($checkpointId != null) {
        $sessionAction = "/resumesession";
        $params = $security_params . $initID . '&cpfid=' . strval($checkpointId);

    } else {
        if ($seed_data != '') {

            if ($security_params != '') {
                //$seed_param = '&seedData=' . urlencode($seed_data);
                $seed_param = '&seedData=' . ($seed_data);
                
            } else {
                //$seed_param = '?seedData=' . urlencode($seed_data);
                $seed_param = '?seedData=' . ($seed_data);
            }
        }

        $sessionAction = "/startsession";
        $params = $security_params . $initID . $seed_param;
    }

	//    echo $security_params;

    $url = $url_attr . '/startsession' . $policy_model . $locale . $params;
	//echo $url;
    return $url;
}

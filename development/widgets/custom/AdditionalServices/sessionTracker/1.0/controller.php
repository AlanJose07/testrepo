<?php
namespace Custom\Widgets\AdditionalServices;
class sessionTracker extends \RightNow\Libraries\Widget\Base {
    function __construct($attrs) {
        parent::__construct($attrs);
        
        $this->setAjaxHandlers(array('default_ajax_endpoint' => array(
                'method'      => 'handle_default_ajax_endpoint',
                'clickstream' => 'custom_action',
            ),
        ));
       
    }
    function getData() {
        parent::getData();
        $CI     =   get_instance();
        if($this->data['attrs']['usertype'] == "AMCC_Agent"){
            $this->data['js']['pageurl']    =   $CI->page;
            // $this->data['js']['sessionID']  =   $CI->session->getSessionData('sessionID');
        }

    }    /**
     * Handles the default_ajax_endpoint AJAX request
     * @param array $params Get / Post parameters
     */
    function handle_default_ajax_endpoint($params) {
        try{
            $CI     =   get_instance();
            $parameters    =   json_decode($params['parameter']);
            try{
                if($CI->session->getSessionData('sessionID')){
                    $parameters->sessionID =  $CI->session->getSessionData('sessionID'); 
                }
                else{
                    echo "session error ";exit;
                }
                
            }
            catch (Exception $err){
                echo json_encode("Controller Error::".$err->getMessage());
            }
            
            if(isset($parameters->sessionID) == null || isset($parameters->sessionID) == ""){
                echo json_encode("Session Error");
            }
            $param['w_id']=$params['w_id'];
            $param['parameter'] = json_encode($parameters);
            $response=$this->CI->model('custom/sessionLogger')->storeSession($param);
            echo json_encode($response);
        }
        catch (Exception $err ){  
          echo json_encode($err->getMessage());
        }  
        
    }
}
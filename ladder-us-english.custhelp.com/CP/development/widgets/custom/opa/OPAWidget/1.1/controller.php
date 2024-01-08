<?php
namespace Custom\Widgets\opa;

class OPAWidget extends \RightNow\Libraries\Widget\Base
{
    function __construct($attrs)
    {
        parent::__construct($attrs);
        //$this->CI->load->helper('opa_v3_helper');
        //$this->CI->load->model('custom/OPA_checkpoint_model');
    }

    function getData()
    {
        $this->CI->load->helper('opa');

        $this->data['url'] = getOPAURL($this->CI->session->getProfile(), $this->data['attrs']['web_determinations_url'], $this->data['attrs']['policy_model'], $this->data['attrs']['locale'], $this->data['attrs']['init_id'], $this->data['attrs']['seed_data']);
    }
}
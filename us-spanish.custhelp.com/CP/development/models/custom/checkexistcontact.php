<?php /* Originating Release: February 2013 */

namespace Custom\Models;
$CI = get_instance();

$CI->model('Contact');
use RightNow\Utils\Url,
    RightNow\Utils\Framework,
    RightNow\Utils\Config,
    RightNow\Api,
    RightNow\Connect\v1_2 as Connect,
    RightNow\Internal\Sql\Contact as Sql,
    RightNow\Utils\Connect as ConnectUtil,
    RightNow\Libraries\Hooks,
    RightNow\ActionCapture,
	RightNow\Connect\v1_2 as RNCPHP;

require_once CORE_FILES . 'compatibility/Internal/Sql/Contact.php';
class checkexistcontact extends \RightNow\Models\Contact{

       public function __construct(){
        parent::__construct('Contact');
    }
	
	public function checkcontact($inc_id,$firstname,$lastname,$conemail)
	{
             $res = RNCPHP\ROQL::queryObject("select Contact from Contact where Contact.Emails.Address='".$conemail."'")->next();
			 if($res->count()>0) {
			        try{
					$existcontact = $res->next();
				    $existcontact->Name->First = $firstname;
                    $existcontact->Name->Last = $lastname;
					$existcontact->save();
					}
					catch(Exception $err){
					   
					}
				
			}
	}
}

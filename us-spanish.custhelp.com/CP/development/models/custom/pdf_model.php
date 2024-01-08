<?php /* Originating Release: February 2013 */

namespace Custom\Models;

$CI = get_instance();

$CI->model('Incident');
$CI->load->library('fpdf_obj');
//require_once( get_cfg_var("doc_root")."/ConnectPHP/Connect_init.php");
//$ip_dbreq = true;


use RightNow\Connect\Knowledge\v1 as KnowledgeFoundation,
    RightNow\Utils\Connect as ConnectUtil,
	RightNow\Libraries\Hooks,
    RightNow\Api,
    RightNow\Internal\Sql\Incident as Sql,
    RightNow\Utils\Framework,
    RightNow\Utils\Text,
    RightNow\ActionCapture,      
    RightNow\Utils\Config,
    RightNow\Libraries\AbuseDetection,
	RightNow\Connect\v1_2 as RNCPHP;
	
	
	
class pdf_model extends \RightNow\Models\Incident{
    function __construct()
    { 
        parent::__construct();
		$CI = get_instance();
		$CI->model('Incident');
		
    }
	
	
	/*
	*Creates an incident
	*Returns the Reference # of the Incident Created
	*/
	
	
	function createIncident(array $formData)
	{
	
	initConnectAPI();	
	$encoded_data=$formData['base64_encoded_string'];
	
	$ci=& get_instance();
	
	
	/*
	*Loads the Library for PDF generation
	*Gets the LOGO and converts it into base64 encoded string
	*/
	
	
	//$ci->load->library("fpdf_obj");
	
	$sign=$formData['signatureText'];//$encoded_data;
	
	
	/*$filename3 = "/vhosts/us_english/euf/assets/images/team_beachbody_logo.png";
	$fp3= fopen($filename3, "r");
	$test=file_get_contents($filename3);
	$tbb_logo="data:image/png;base64,".base64_encode($test);
	
	
	
	$filename4 = "/vhosts/us_english/euf/assets/images/checkbox_unchecked.png";
	$fp4= fopen($filename4, "r");
	$content=file_get_contents($filename4);
	$pic4="data:image/png;base64,".base64_encode($content);
	
	$filename5 = "/vhosts/us_english/euf/assets/images/checkbox_checked.png";
	$fp5= fopen($filename5, "r");
	$content=file_get_contents($filename5);
	$pic5="data:image/png;base64,".base64_encode($content);*/
	
	$email=$formData['Contact_Emails_PRIMARY_Address'];
	$incident= new RNCPHP\Incident();
	/*
	*Fetches the contact for the corresponding Email Address
	*And checks whether it exists or not
	*If the email address doesn't exiat, a new contact is created
	*and Incident fields are updated
	*else Incident fields alone are updated
	*/
	
	$contact_check = RNCPHP\Contact::first("Emails.Address='$email'");
	if($contact_check->ID=="")
	{
		$contact = new RNCPHP\Contact();
		$contact->Name = new RNCPHP\PersonName();
		$contact->Name->First = $formData['Incident_CustomFields_c_ccf_first_name'];
		$contact->Name->Last = $formData['Incident_CustomFields_c_ccf_last_name'];
		
		$contact->Emails = new RNCPHP\EmailArray();
		$contact->Emails[0] = new RNCPHP\Email();
		$contact->Emails[0]->AddressType=new RNCPHP\NamedIDOptList();
		$contact->Emails[0]->AddressType->ID = 0;
		$contact->Emails[0]->Address =$formData['Contact_Emails_PRIMARY_Address'];

		
		$contact->Phones = new RNCPHP\PhoneArray();
		$contact->Phones[0] = new RNCPHP\Phone();
		$contact->Phones[0]->PhoneType = new RNCPHP\NamedIDOptList();
		$contact->Phones[0]->PhoneType->LookupName = 'Mobile Phone';
		$contact->Phones[0]->Number = $formData['Contact_Phones_MOBILE_Number'];
		
		//---saving country---
		 $contact->Address = new RNCPHP\Address();
		 $contact->Address->Country = RNCPHP\Country::fetch($formData["Contact_Address_Country"]);
		//---saving country---
		
		AbuseDetection::check();
		$r=$contact->save();
	}
	else
	{
		$contact=$contact_check;
		
		$contact->Address->Country = RNCPHP\Country::fetch($formData["Contact_Address_Country"]);
		$contact->save();
		$r=true;
	}
	$incident->CustomFields->c->ccf_first_name= $formData['Incident_CustomFields_c_ccf_first_name'];
	$incident->CustomFields->c->ccf_last_name= $formData['Incident_CustomFields_c_ccf_last_name'];
    $incident->CustomFields->c->ccf_business_name= $formData['Incident_CustomFields_c_ccf_business_name'];
	$incident->CustomFields->c->ccf_phone_number=  $formData['Contact_Phones_MOBILE_Number'];
	
	/*
	*Field Labels for PDF
	*/
	
	if($r)
	{		
		// extract dimensions from image
		/*$info = getimagesize($tbb_logo);*/
		$date = date("m-d-Y"); 
		$time= date("G:i:s");
		/*$link="Contact-Us Link";
		$title="Independent Coach Cancellation Form";
		$text_main_1="This form allows you to permanently cancel your Team Beachbody Coach accounts and any other memberships or ";
		$text_main_2="subscriptions in which you may have enrolled. Please fill out all required information accurately. Your cancellation";
		$text_main_3="may be delayed if we receive incorrect information. ";
		$required="*Required";
		$coach_id_label="Coach ID";
		$email_label="Email*";
		$first_name_label="First Name*";
		$last_name_label="Last Name*";
		$business_name_label="Business Name(If Applicable)";
		//$ssn_label="Last 4 of SSN, EIN or SIN*";
		//$ssn_label="Last 4 digits of Credit Card on file for BSF OR Last 4 of SSN / SIN*";
		$ssn_label="Last 4 digits of Credit Card on file for BSF Fees*";//"Last 4 digits of Credit Card on file for BSF OR Last 4 of SSN / SIN*";
		$life_time_rank_label="Lifetime Rank*";
		
		
		$phone_label="Phone*";
		$no_value_label="No Value";

		$reason_label="Select the primary reason that best describes your cancellation*";
		$comment_label="Please provide any details concerning your coaching experience below. We appreciate your feedback.";
		$sub_title1_label="Other Memberships and Subscriptions*";
		$text_1="*Prices quoted below do not include shipping and handling.";
		$continued_service_label_1="Please check the box next to which services ";
		$continued_service_label_2="you would like to continue:";
		$text_2="**Please remember, if you cancel or do not have a Beachbody On Demand membership, you will not have access to stream and will not get  ";
		$performance_label="   Beachbody Performance";
		$shakeology_boost_label="   Shakeology Boost";
		$refresh_label="   3 Day Refresh";
		$text_3="   10% off on future orders. If you keep your Beachbody On Demand membership, you will get 10% off the prices listed.";
		$text_3_b="";
		$sub_title2_label="Terms of Cancellation*";
		$text_4="Please check all boxes to sign and submit your cancellation";
		$sign_submit_label="By signing and submitting this form, I understand the following:";
		$submit_condition_1=" I will lose the 25% Coach discount on all future orders and any memberships or subscriptions I continued above";
		$submit_condition_2_a=" For any memberships or subscriptions which I continued, I agree to the charges for those products and ";
		$submit_condition_2_b="understand I may cancel at any time by calling Customer Service at 1 (800) 470-7870 .";
		$submit_condition_3=" I lose the right to sell Team Beachbody products";
		$submit_condition_4=" I am no longer eligible to earn commission under the Team Beachbody Compensation Plan";
		$submit_condition_5_a=" I am permanently abandoning my position within the Team Beachbody genealogy, as well as any pending ";
		$submit_condition_5_b="bonuses, commissions, or any other forms of compensation.";
		$submit_condition_6="I may not re-enroll as a Team Beachbody Coach until six calendar months from the date of my cancellation ";
		$submit_condition_7="if I wish to re-enroll with a new sponsor, or with my original sponsor on a different leg of the sponsor's ";
		$submit_condition_8="organization (please refer to the Team Beachbody Coach Policies & Procedures, Section 3.6.3).";
		$signature_label="Signature*";
		$date_label="Date";
		$time_label="Time";
		$text_5_a="By signing, I certify I am the current account holder of the Coach Business Center and/or authorized to cancel this account.";
		$text_5_b="If we have any questions, we will contact you at the information you provided above.";
		$text_6="IMPORTANT";
		$text_7_a="Submission of this form does not hold or cancel pending charges/shipment already in progress or";
		$text_7_b="scheduled during this processing time. You may be charged for these orders.";
		$title2="CONFIRMATION PAGE";
		$text_8="Your request has been received. Your reference # is";
		$text_9_a="For security purposes, a separate confirmation email will be sent to the ";
		$text_9_b="address on your file for Coach Account.";
		$text_10_a="If you need further information regarding the Coach Network,";
		$text_10_b= "Team Beachbody products and/or services, please [";
		$text_10_c="].";*/
		
		
		
		/*
		*Incident Fields are saved
		*/
		
		$incident->PrimaryContact = $contact;
		$incident->Subject= $formData['Incident_Subject'];
		$incident->CustomFields->c->coachcustomernumber=$formData['Incident_CustomFields_c_coachcustomernumber'];
		$incident->CustomFields->c->ccf_cancel_all_enrollments=$formData['Incident_CustomFields_c_ccf_cancel_all_enrollments'];
		$incident->CustomFields->c->ccf_tbb_club_membership=$formData['Incident_CustomFields_c_ccf_tbb_club_membership'];
		$incident->CustomFields->c->ccf_pro_team=$formData['Incident_CustomFields_c_ccf_pro_team'];
		$incident->CustomFields->c->ccf_shakeology=$formData['Incident_CustomFields_c_ccf_shakeology'];
		//$incident->CustomFields->c->ccf_coaching_experience=$formData['Incident_CustomFields_c_ccf_coaching_experience'];
		$incident->CustomFields->c->form_routing->ID=$formData['Incident_CustomFields_c_form_routing'];
		$incident->CustomFields->c->ccf_other_continued_services=$formData['Incident_CustomFields_c_ccf_other_continued_services'];
		$incident->CustomFields->c->ccf_membership_and_enrollment=$formData['Incident_CustomFields_c_ccf_membership_and_enrollment'];
		$incident->CustomFields->c->last_four_ssn=$formData['Incident_CustomFields_c_last_four_ssn'];
		
		if($formData['Incident_CustomFields_c_ccf_reason_for_cancellation'])
		{
			$cancellation = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\Incident", "customFields.c.ccf_reason_for_cancellation"); 
				
				
				foreach($cancellation as $items)
				{
					if($items->LookupName == $formData['Incident_CustomFields_c_ccf_reason_for_cancellation'])
					{
						$incident->CustomFields->c->ccf_reason_for_cancellation->ID = $items->ID;
						$id=$items->ID;
					}
				}  
		
			if($id==652)
			{
			$flag=1;
			$incident->CustomFields->c->ccf_other_reason=$formData['Incident_CustomFields_c_ccf_other_reason'];
			}
		}
		
	
		
		
		//---saving life time rank--
		if($formData['Incident_CustomFields_c_life_time_rank'])
		{
			$life_time_rank = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\Incident", "customFields.c.life_time_rank"); 
				
				foreach($life_time_rank as $items)
				{
					
					if($items->ID == $formData['Incident_CustomFields_c_life_time_rank'])
					{
						$incident->CustomFields->c->life_time_rank->ID = $items->ID;
						$lifeTimeRankID=$items->ID;
					}
				}  
		
		}
		if($lifeTimeRankID==478)
		{
			$lifeTimeRank="Coach - Diamond";
		}
		if($lifeTimeRankID==1365)
		{
			$lifeTimeRank="1 - 4 Star Diamond";
		}
		if($lifeTimeRankID==492)
		{
			$lifeTimeRank="5 Star Diamond and Above";
		}
		
		//-----life time rank-------
		
		
		
		/*
		*PDF Generation starts here.
		*AddPage: Adds a new page to PDF
		*Cell: Writes the content to the PDF(Parameters:width,height,CONTENT,border,ln=0,align,fill,link)
		*Image: Inserts an Image(Parameters:file,x,y,w,h,type,link)
		*SetFont: Sets the font size, family, weight etc
		*/
		
		/*$pdf_obj = $ci->fpdf_obj->fpdf_obj_create();
		//$size=array(210,370);
		$size=array(210,330);
		
		$y=21;
		$pdf_obj->AddPage('',$size);
		$pdf_obj->SetFont('Arial','B',16);
		$pdf_obj->Image($tbb_logo, 15,3, 60, 12, 'png');
		$y+=5;
		$pdf_obj->Cell(10,$y,'');
		$pdf_obj->Cell(20,$y,$title);
		$pdf_obj->SetFont('Arial','I',9);
		
		
		$y+=20;
		$pdf_obj->Cell(-20,$y,'');
		$pdf_obj->Cell(20,$y,$text_main_1);
		
		$y+=8;
		$pdf_obj->Cell(-20,$y,'');
		$pdf_obj->Cell(20,$y,$text_main_2);
		
		$y+=8;
		$pdf_obj->Cell(-20,$y,'');
		$pdf_obj->Cell(20,$y,$text_main_3);
		
		
		$pdf_obj->SetFont('Arial','',10);
		
		$y+=18;
		$pdf_obj->Cell(-20,$y,'');
		$pdf_obj->Cell(-20,$y,$required);
		
		$y+=20;
		$pdf_obj->SetFont('Arial','B',10);
		$pdf_obj->Cell(20,$y,'');
		$pdf_obj->Cell(90,$y,$coach_id_label);
		$pdf_obj->Cell(-89,$y,$email_label,0,0,'L');
		$pdf_obj->SetFont('Arial','',10);
		$y+=16;
		if($formData['Incident_CustomFields_c_coachcustomernumber'])
		{
		$pdf_obj->Cell(90,$y,$formData['Incident_CustomFields_c_coachcustomernumber'],0,0,'L');
		}
		else
		{
		$pdf_obj->Cell(90,$y,$no_value_label,0,0,'L');
		}
		$pdf_obj->Cell(-91,$y,$formData['Contact_Emails_PRIMARY_Address'],0,0,'L');
		
		$y+=18;
		
		$pdf_obj->SetFont('Arial','B',10);
		$pdf_obj->Cell(90,$y,$first_name_label,0,0,'L');
		$pdf_obj->Cell(-89,$y,$last_name_label,0,0,'L');
		$pdf_obj->SetFont('Arial','',10);
		$y+=16;
		$pdf_obj->Cell(90,$y,$formData['Incident_CustomFields_c_ccf_first_name'],0,0,'L');
		$pdf_obj->Cell(-91,$y,$formData['Incident_CustomFields_c_ccf_last_name'],0,0,'L');
		
		$pdf_obj->SetFont('Arial','B',10);
		$y+=17;
		$pdf_obj->Cell(1,$y,$business_name_label,0,0,'L');
		$pdf_obj->SetFont('Arial','',10);
		$y+=16;
		if($formData['Incident_CustomFields_c_ccf_business_name'])
		{
		$pdf_obj->Cell(20,$y,$formData['Incident_CustomFields_c_ccf_business_name'],0,0,'L');
		}
		else
		{
		$pdf_obj->Cell(20,$y,$no_value_label,0,0,'L');
		}
		
		$y+=19;
		$pdf_obj->SetFont('Arial','B',10);
		$pdf_obj->Cell(-21,$y,'');
		$pdf_obj->Cell(-1,$y,'');
		$pdf_obj->Cell(1,$y,$ssn_label,0,0,'L');
		$y+=16;
		$pdf_obj->SetFont('Arial','',10);
		if($formData['Incident_CustomFields_c_last_four_ssn'])
		{
		$pdf_obj->Cell(-1,$y,$formData['Incident_CustomFields_c_last_four_ssn'],0,0,'L');
		}
		else
		{
		$pdf_obj->Cell(-1,$y,$no_value_label,0,0,'L');
		}
		
		//-----life time rank-----
		$y+=19;
		$pdf_obj->SetFont('Arial','B',10);
		$pdf_obj->Cell(1,$y,$life_time_rank_label,0,0,'L');
		$y+=16;
		$pdf_obj->SetFont('Arial','',10);
		$pdf_obj->Cell(-1,$y,$lifeTimeRank,0,0,'L');
		
		//------------------------
		
		
		
		$y+=16;
		$pdf_obj->SetFont('Arial','B',10);
		$pdf_obj->Cell(1,$y,$phone_label,0,0,'L');
		$y+=16;
		$pdf_obj->SetFont('Arial','',10);
		$pdf_obj->Cell(-1,$y,$formData['Contact_Phones_MOBILE_Number'],0,0,'L');
		
		
		$y+=15;
		
		$pdf_obj->SetFont('Arial','B',10);
		$pdf_obj->Cell(1,$y,$reason_label,0,0,'L');
		$pdf_obj->SetFont('Arial','',10);
		
		
		
		$y+=16;
		
		if($formData['Incident_CustomFields_c_ccf_reason_for_cancellation']||$formData['Incident_CustomFields_c_ccf_reason_for_cancellation'])
		{
			if($flag==1)
			{
				$other_reason=$formData['Incident_CustomFields_c_ccf_reason_for_cancellation']."* : ".$formData['Incident_CustomFields_c_ccf_other_reason'];
				$pdf_obj->Cell(-1,$y,$other_reason,0,0,'L');
			}
			else
			{
				$pdf_obj->Cell(-1,$y,$formData['Incident_CustomFields_c_ccf_reason_for_cancellation'],0,0,'L');
			}
		}
		else
		{
		$pdf_obj->Cell(-1,$y,$no_value_label,0,0,'L');
		}  
		$y+=15;*/
		/*$pdf_obj->SetFont('Arial','',7);
		$y+=15;
		//$y=220;
		$inc=7;
		$pdf_obj->SetDrawColor(0,71,179);//51,102,200
		
		$y+=30;
		//$y_line=$y-180;
		$y_line=$y-195;//first line
		
		
		
		
		$pdf_obj->Line(25,$y_line,190,$y_line);
		
		$pdf_obj->SetFont('Arial','B',16);
		$pdf_obj->Cell(-2,$y,'',0,0,'L');
		$pdf_obj->Cell(2,$y,$sub_title1_label,0,0,'L');
		$pdf_obj->SetFont('Arial','I',8);
		$y+=14;
		$pdf_obj->Cell(-2,$y,'',0,0,'L');
		//$pdf_obj->Cell(-1,$y,$text_1,0,0,'L');
		$pdf_obj->Cell(1,$y,'',0,0,'L');
		
		
		$service1=$formData['Incident_CustomFields_c_ccf_cancel_all_enrollments'];
		$service2=$formData['Incident_CustomFields_c_ccf_tbb_club_membership'];
		$service3=$formData['Incident_CustomFields_c_ccf_shakeology'];
		$service4=$formData['Incident_CustomFields_c_ccf_other_continued_services'];
		$service5=$formData['Incident_CustomFields_c_ccf_pro_team'];
		$other_service=$formData['Incident_CustomFields_c_ccf_membership_and_enrollment'];*/
		
		/*
		* The Text for corresponding service is taken from Message Bases
		*/
		
		
		/*$service_enroll="   ".\RightNow\Utils\Config::getMessage(CUSTOM_MSG_CANCEL_ALL_ENROLLMENTS);
		$service_tbb="   ".\RightNow\Utils\Config::getMessage(CUSTOM_MSG_TBB_CLUB_MEMBERSHIP);
		$service_tbb = str_replace('</br>','    ',$service_tbb);
		$service_shakeology="   ".\RightNow\Utils\Config::getMessage(CUSTOM_MSG_SHAKEOLOGY);
		$service_pro = "   Pro Team";
		if($other_service)
		{
			$service_other="   Other*:  ".$other_service;
		}
		else
		{
			$service_other="   Other";
		}
		
		
	 $y-=30;
			*/
		///CHK	
			
		/*if(($comment_y==1)||($comment_y==0))
		{
			
			//adjusting the check box of other member ship and subscriptions
			$y_checkbox1=$y-141;
			$y_checkbox2=$y-134;
			$y_checkbox3=$y-127;
			$y_checkbox_per=$y-119;
			$y_checkbox_shk =$y-111;
			$y_checkbox_refresh=$y-104;
			$y_checkbox4=$y-89;
			$y_checkbox_pro=$y-96;
			
			 
			$y_checkbox5=$y-41;
			$y_checkbox6=$y-35;
			$y_checkbox7=$y-29;
			$y_checkbox8=$y-23;
			$y_checkbox9=$y-17;
		}
		else
		{}
		
		$y+=45;
		
		$pdf_obj->SetFont('Arial','B',10);
		$pdf_obj->Cell(75,$y,$continued_service_label_1,0,0,'L');
		$pdf_obj->SetFont('Arial','BU',10);
		$pdf_obj->Cell(1,$y,$continued_service_label_2,0,0,'L');
		$pdf_obj->SetFont('Arial','',9);
		$pdf_obj->Cell(-75,$y,'',0,0,'L');
		
		
		
		
		
		$counter=0;
		$y+=15;
		$inc=15;
		
		if($service1)
		{
			$pdf_obj->Image($pic5, 22,$y_checkbox1, 3, 3, 'png');
		}
		else
		{
			$pdf_obj->Image($pic4, 22,$y_checkbox1, 3, 3, 'png');
		}
		
		$pdf_obj->Cell(5,$y,'',0,0,'L');
		$pdf_obj->Cell(-1,$y,$service_enroll,0,0,'L');
		$y+=$inc;
		$counter++;
		
		
		if($service2)
		{
			$pdf_obj->Image($pic5, 22,$y_checkbox2, 3, 3, 'png');
		}
		else
		{
			$pdf_obj->Image($pic4, 22,$y_checkbox2, 3, 3, 'png');
		}
		
		$pdf_obj->Cell(1,$y,'',0,0,'L');
		$pdf_obj->Cell(-1,$y,$service_tbb,0,0,'L');
		$y+=$inc;
		$counter++;
		
		if($service3)
		{
			$pdf_obj->Image($pic5, 22,$y_checkbox3, 3, 3, 'png');
		}
		else
		{
			$pdf_obj->Image($pic4, 22,$y_checkbox3, 3, 3, 'png');
		}
		
		$pdf_obj->Cell(1,$y,'',0,0,'L');
		$pdf_obj->Cell(-1,$y,$service_shakeology,0,0,'L');
		$y+=$inc;
		$counter++;
		
		
		if($service5)
		{
			$pdf_obj->Image($pic5, 22,$y_checkbox_pro, 3, 3, 'png');
		}
		else
		{
			$pdf_obj->Image($pic4, 22,$y_checkbox_pro, 3, 3, 'png');
		}
		if($service4)
		{
			$pdf_obj->Image($pic5, 22,$y_checkbox4, 3, 3, 'png');
		}
		else
		{
			$pdf_obj->Image($pic4, 22,$y_checkbox4, 3, 3, 'png');
		}*/
		
		
		
		/*$counter++;
		$pdf_obj->Cell(-5,$y,'',0,0,'L');*/
		if($formData['Incident_CustomFields_c_ccf_performance'])
		{
			$performance = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\Incident", "customFields.c.ccf_performance"); 
				foreach($performance as $items)
				{
					if($items->ID == $formData['Incident_CustomFields_c_ccf_performance'])
					{
						$incident->CustomFields->c->ccf_performance->ID = $items->ID;
						$performance=$items->LookupName;
					}
				}  
		}
		
		
		if($formData['Incident_CustomFields_c_ccf_shakeology_boost'])
		{
			$shakeology_boost = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\Incident", "customFields.c.ccf_shakeology_boost"); 
				foreach($shakeology_boost as $items)
				{
					if($items->ID == $formData['Incident_CustomFields_c_ccf_shakeology_boost'])
					{
						$incident->CustomFields->c->ccf_shakeology_boost->ID = $items->ID;
						$shakeology_boost=$items->LookupName;
					}
				}  
		}
		
		
		
		if($formData['Incident_CustomFields_c_ccf_3_day_refresh'])
		{
			$refresh = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\Incident", "customFields.c.ccf_3_day_refresh"); 
				foreach($refresh as $items)
				{
					if($items->ID == $formData['Incident_CustomFields_c_ccf_3_day_refresh'])
					{
						$incident->CustomFields->c->ccf_3_day_refresh->ID = $items->ID;
						$refresh=$items->LookupName;
					}
				}  
		}
		
		
		
		
		/*if($performance)
		{
		$performance_label ="   Beachbody Performance*:  ".$performance;
		}
		if($shakeology_boost)
		{
		$shakeology_boost_label ="   Shakeology Boost*:  ".$shakeology_boost;
		}
		if($refresh)
		{
		$refresh_label = "   3 Day Refresh*:  ".$refresh; 
		}
		
		
		
		$y+=1;
		$pdf_obj->SetFont('Arial','',9);
		$pdf_obj->Cell(6,$y,'',0,0,'L');
		if($performance)
		{
		$pdf_obj->Image($pic5, 22,$y_checkbox_per, 3, 3, 'png');
		$pdf_obj->Cell(1,$y,$performance_label,0,0,'L');
		}
		else
		{
		$pdf_obj->Image($pic4, 22,$y_checkbox_per, 3, 3, 'png');
		$pdf_obj->Cell(1,$y,$performance_label,0,0,'L');
		}*/
		
		
		/*$y+=15;
		$pdf_obj->SetFont('Arial','',9);
		$pdf_obj->Cell(-1,$y,'',0,0,'L');
		if($shakeology_boost)
		{
		$pdf_obj->Image($pic5, 22,$y_checkbox_shk, 3, 3, 'png');
		$pdf_obj->Cell(1.5,$y,$shakeology_boost_label,0,0,'L');
		}
		else
		{
		$pdf_obj->Image($pic4, 22,$y_checkbox_shk, 3, 3, 'png');
		$pdf_obj->Cell(1.5,$y,$shakeology_boost_label,0,0,'L');
		}*/
		
		
		
		/*$y+=15;
		$pdf_obj->SetFont('Arial','',9);
		$pdf_obj->Cell(-1,$y,'',0,0,'L');
		if($refresh)
		{
		$pdf_obj->Image($pic5, 22,$y_checkbox_refresh, 3, 3, 'png');
		$pdf_obj->Cell(1,$y,$refresh_label,0,0,'L');
		}
		else
		{
		$pdf_obj->Image($pic4, 22,$y_checkbox_refresh, 3, 3, 'png');
		$pdf_obj->Cell(1,$y,$refresh_label,0,0,'L');
		}
		$y+=$inc;
		
		$pdf_obj->Cell(-1,$y,'',0,0,'L');
		$pdf_obj->Cell(1,$y,$service_pro,0,0,'L');
		$y+=$inc;
		$pdf_obj->Cell(-1,$y,'',0,0,'L');
		$pdf_obj->Cell(-1,$y,$service_other,0,0,'L');
		*/
		
		
		
		
		/*$y+=20;
		$pdf_obj->SetFont('Arial','I',8);
		
		$pdf_obj->Cell(-3,$y,'',0,0,'L');
		$pdf_obj->Cell(-1,$y,'*Prices do not include shipping & handling, and tax.',0,0,'L');
		$y+=12;
		$pdf_obj->SetFont('Arial','I',8);
		$pdf_obj->Cell(1,$y,'',0,0,'L');
		$pdf_obj->Cell(-1,$y,$text_2,0,0,'L');
		$y+=8;
		$pdf_obj->Cell(2,$y,$text_3,0,0,'L');*/
		//*****//*****//*****//
		/*$y+=8;
		$pdf_obj->Cell(-1,$y,$text_3_b,0,0,'L');*/
		
		
		//*****//*****//*****//
		
		/*$pdf_obj->SetDrawColor(0,71,179);//51,102,200
		
		$y+=25;*/
		//203
		//TOCC
		/*$comment_y=$line_count;
		if(($comment_y==1)||($comment_y==0))
		{
			$y_line=$y-287;//second line
		}
		else
		{}
				
		

		$pdf_obj->Line(25,$y_line,190,$y_line);
		
		
		
		
		
		$pdf_obj->Cell(-50,$y,'',0,0,'L');
		
		
		$comment_y=$line_count;
		
		
		if(($counter==1)||($counter==0))
		{
			$y_img=$y-173;
		}
		else if($counter==2)
		{
			$y_img=$y-170;
		}
		else if($counter==3)
		{
			$y_img=$y-175;
		}
		else if($counter==4)
		{
			$y_img=$y-185;
		}
		else
		{
			$y_img=$y-175;
		}
		
		
		if(($comment_y==1)||($comment_y==0))
		{
			
				$y_img+=$comment_y-6;
		
		}
		else
		{}
		
		$y_img-=52;
		
		$pdf_obj->AddPage('',$size);*/
		
		//----------***************************************************************************************
		/*$y=21;
		$pdf_obj->SetFont('Arial','B',16);
		$pdf_obj->Cell(7,$y,'',0,0,'L');
		$pdf_obj->Cell(1,$y,$sub_title2_label,0,0,'L');
		$pdf_obj->SetFont('Arial','I',9);
		$y+=15;
		$pdf_obj->Cell(-1,$y,$text_4,0,0,'L');
		$y+=15;
		$pdf_obj->SetFont('Arial','B',10);
		$pdf_obj->Cell(2,$y,$sign_submit_label,0,0,'L');
		$pdf_obj->SetFont('Arial','',10);
		$y+=15;
		
		$pdf_obj->SetFont('Arial','B',24);
	
		$y_check_box=42;
		$pdf_obj->SetFont('Arial','',10);
		$pdf_obj->Cell(5,$y,'',0,0,'L');
		$y_check_box-=0.5;
		$pdf_obj->Image($pic5, 20,$y_check_box, 3, 3, 'png');
		$pdf_obj->Cell(1,$y,$submit_condition_1,0,0,'L');
		$y_check_box+=0.5;
		$y+=12;
		$pdf_obj->SetFont('Arial','B',24);
	
		$pdf_obj->SetFont('Arial','',10);
		$pdf_obj->Cell(-1,$y,'',0,0,'L');
		$y_check_box+=6;
		$pdf_obj->Image($pic5, 20,$y_check_box, 3, 3, 'png');
		$pdf_obj->Cell(1,$y,$submit_condition_2_a,0,0,'L');
		$y+=12;
		$pdf_obj->Cell(1,$y,$submit_condition_2_b,0,0,'L');
		$y+=12;
		$pdf_obj->SetFont('Arial','B',24);
		
		
		$pdf_obj->SetFont('Arial','',10);
		$pdf_obj->Cell(-2,$y,'',0,0,'L');
		$y_check_box+=11;
		$pdf_obj->Image($pic5, 20,$y_check_box, 3, 3, 'png');
		$pdf_obj->Cell(1,$y,$submit_condition_3,0,0,'L');
		$y+=12;
		$pdf_obj->SetFont('Arial','B',24);
	
	
		$pdf_obj->SetFont('Arial','',10);
		$pdf_obj->Cell(-1,$y,'',0,0,'L');
		$y_check_box+=7;
		$pdf_obj->Image($pic5, 20,$y_check_box, 3, 3, 'png');
		$pdf_obj->Cell(1,$y,$submit_condition_4,0,0,'L');
		$y+=12;
		$pdf_obj->SetFont('Arial','B',24);
		
		
		$pdf_obj->SetFont('Arial','',10);
		$pdf_obj->Cell(-1,$y,'',0,0,'L');
		$y_check_box+=6;
		$pdf_obj->Image($pic5, 20,$y_check_box, 3, 3, 'png');
		$pdf_obj->Cell(1,$y,$submit_condition_5_a,0,0,'L');
		$y+=12;
		$pdf_obj->Cell(1,$y,$submit_condition_5_b,0,0,'L');
		$y+=12;
		$pdf_obj->SetFont('Arial','B',24);
		
		
		$pdf_obj->SetFont('Arial','',10);
		$pdf_obj->Cell(-1,$y,'',0,0,'L');
		$y_check_box+=11;
		$pdf_obj->Image($pic5, 20,$y_check_box, 3, 3, 'png');
		$pdf_obj->Cell(1,$y,$submit_condition_6,0,0,'L');
		$y+=12;
		$pdf_obj->Cell(-1,$y,$submit_condition_7,0,0,'L');
		$y+=12;
		$pdf_obj->Cell(1,$y,'',0,0,'L');
		$pdf_obj->Cell(-3,$y,$submit_condition_8,0,0,'L');
		$y+=20;
		
		$pdf_obj->SetFont('Arial','B',10);
		$pdf_obj->Cell(1,$y,$signature_label,0,0,'L');
		
		$y+=18;
		$pdf_obj->SetFont('Arial','B',10);
		//$pdf_obj->Image($sign,20,110, 60, 16, 'jpg');
		$pdf_obj->Cell(-1,$y,$sign,0,0,'L');
		
		$pdf_obj->SetFont('Arial','I',9);
		$y+=20;
		$pdf_obj->Cell(1,$y,$text_5_a,0,0,'L');
		$y+=10;
		$pdf_obj->Cell(-1,$y,'',0,0,'L');
		$pdf_obj->Cell(1,$y,$text_5_b,0,0,'L');
		//$y+=35;
		$y+=30;
		$pdf_obj->SetFont('Arial','B',10);
		$pdf_obj->Cell(25,$y,$text_6,0,0,'L');
		$pdf_obj->SetFont('Arial','',9);
		$pdf_obj->Cell(-25,$y,$text_7_a,0,0,'L');
		$y+=10;
		$pdf_obj->Cell(-1,$y,$text_7_b,0,0,'L');*/
		
		/*$pdf_obj->Output(); // remove the comment for these two lines inorder to view the generated PDF without creating an incident
		exit;*/
		//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
		
		/*
		*Saves the Incident and Reference # is returned
		*/
		
		AbuseDetection::check();
		$res=$incident->save();
		
		/*
		* Gets the Incident ID and updates the incident by attaching the pdf with Incident ID on it
		*/
		
		$refno = $incident->ReferenceNumber;
		$inc_id=$incident->ID;
		/*$incident = RNCPHP\Incident::fetch($inc_id);
		
		$pdf_obj->SetFont('courier','',10);
		$y+=32;
		
		$date_time=$date." ".$time." Pacific Time; ";
		$pdf_obj->Cell(1,$y,'',0,0,'L');
		$pdf_obj->Cell(1,$y,'Submitted ',0,0,'L');
		$pdf_obj->Cell(20,$y,'',0,0,'L');
		$pdf_obj->Cell(5,$y,$date_time,0,0,'L');
		
		$pdf_obj->Cell(68,$y,'',0,0,'L');
		$pdf_obj->Cell(1,$y,'Incident Reference # ',0,0,'L');
		$pdf_obj->Cell(43,$y,'',0,0,'L');
		$pdf_obj->Cell(5,$y,$refno,0,0,'L');
		 
		
		$pdf_str=$pdf_obj->Output('S');
		
		$current_date=date("m/d/Y");
		$current_time=date("G:i:s");
		
		$folder="/tmp/";
		$fname="DS3_".$date.".pdf";
		$filename = $folder.$fname;
		$fp= fopen($filename, "w");
		$str=$pdf_str;
		fputs($fp,$str);
		fclose($fp);
		
		$incident->FileAttachments =new RNCPHP\FileAttachmentIncidentArray();
		$fattach = new RNCPHP\FileAttachmentIncident();
		$fattach->ContentType = "application/pdf";
		
		$fp = $fattach->makeFile();
		$fattach->Data=$fname;
		$date = date("m-d-Y"); 
		$fattach->FileName = "TBB Coach Cxl Form_".$date.".pdf";
		$incident->FileAttachments[] = $fattach;
		AbuseDetection::check();
		$res=$incident->save();*/
		
		if($res)
		{
			return $refno;
		}
		
		
	}
	}
	
	
		/*
	*Creates an incident
	*Returns the Reference # of the Incident Created
	*/
	
	
	function createIncidentFrench(array $formData)
	{
	
	initConnectAPI();	

		
	$encoded_data=$formData['base64_encoded_string'];
	
	$ci=& get_instance();
	/*
	*Loads the Library for PDF generation
	*Gets the LOGO and converts it into base64 encoded string
	*/
	
	
	
	
	
	
	/*$sign=$formData['signatureText'];//$encoded_data;
	
	
	$filename3 = "/vhosts/us_english/euf/assets/images/team_beachbody_logo.jpg";
	$fp3= fopen($filename3, "r");
	$test=file_get_contents($filename3);
	$pic2="data:image/jpeg;base64,".base64_encode($test);
	
	
	
	$filename4 = "/vhosts/us_english/euf/assets/images/checkbox_unchecked.jpg";
	$fp4= fopen($filename4, "r");
	$content=file_get_contents($filename4);
	$pic4="data:image/jpeg;base64,".base64_encode($content);
	
	$filename5 = "/vhosts/us_english/euf/assets/images/checkbox_checked.jpg";
	$fp5= fopen($filename5, "r");
	$content=file_get_contents($filename5);
	$pic5="data:image/jpeg;base64,".base64_encode($content);
	*/
	$email=$formData['Contact_Emails_PRIMARY_Address'];
	$incident= new RNCPHP\Incident();
	/*
	*Fetches the contact for the corresponding Email Address
	*And checks whether it exists or not
	*If the email address doesn't exiat, a new contact is created
	*and Incident fields are updated
	*else Incident fields alone are updated
	*/
	
	$contact_check = RNCPHP\Contact::first("Emails.Address='$email'");
	if($contact_check->ID=="")
	{
		$contact = new RNCPHP\Contact();
		$contact->Name = new RNCPHP\PersonName();
		$contact->Name->First = $formData['Incident_CustomFields_c_ccf_first_name'];
		$contact->Name->Last = $formData['Incident_CustomFields_c_ccf_last_name'];
		
		$contact->Emails = new RNCPHP\EmailArray();
		$contact->Emails[0] = new RNCPHP\Email();
		$contact->Emails[0]->AddressType=new RNCPHP\NamedIDOptList();
		$contact->Emails[0]->AddressType->ID = 0;
		$contact->Emails[0]->Address =$formData['Contact_Emails_PRIMARY_Address'];

		
		$contact->Phones = new RNCPHP\PhoneArray();
		$contact->Phones[0] = new RNCPHP\Phone();
		$contact->Phones[0]->PhoneType = new RNCPHP\NamedIDOptList();
		$contact->Phones[0]->PhoneType->LookupName = 'Mobile Phone';
		$contact->Phones[0]->Number = $formData['Contact_Phones_MOBILE_Number'];
		
		
	
		
		AbuseDetection::check();
		$r=$contact->save();
	}
	else
	{
		$contact=$contact_check;
		$r=true;
	}
	$incident->CustomFields->c->ccf_first_name= $formData['Incident_CustomFields_c_ccf_first_name'];
	$incident->CustomFields->c->ccf_last_name= $formData['Incident_CustomFields_c_ccf_last_name'];
    $incident->CustomFields->c->ccf_business_name= $formData['Incident_CustomFields_c_ccf_business_name'];
	$incident->CustomFields->c->ccf_phone_number=  $formData['Contact_Phones_MOBILE_Number'];
	
	/*
	*Field Labels for PDF
	*/
	
	if($r)
	{		
		// extract dimensions from image
		/*$info = getimagesize($pic2);*/
		$date = date("m-d-Y"); 
		$time= date("G:i:s");
		/*$title_1= utf8_decode("Formulaire d'annulation de coach indépendant de ");
		$title_2=utf8_decode("Team Beachbody Canada, LP");
		$text_main_1=utf8_decode("Ce formulaire vous permet d'annuler définitivement votre compte Coach Team Beachbody et tous les autres ");
		$text_main_2=utf8_decode("abonnements et inscriptions dont vous aurez pu vous être inscrits. S'il vous plaît remplir toutes les informations");
		$text_main_3=utf8_decode("requises avec précision. Votre annulation peut être retardée si nous recevons des informations incorrectes.");
		$required=utf8_decode("*Obligatoire");
		$coach_id_label=utf8_decode("Id. de Coach Team Beachbody (si connu)");
		$email_label=utf8_decode("Courriel*");
		$first_name_label=utf8_decode("Prénom *");
		$last_name_label=utf8_decode("Nom*");
		$business_name_label=utf8_decode("Nom de l'entreprise (si applicable)");
		//$ssn_label=utf8_decode("4 derniers chiffres du numéro d'assurance sociale (NAS)*");
		//$ssn_label_one=utf8_decode("4 derniers chiffres de la carte de crédit enregistrée pour vos frais de services du compte");
		$ssn_label_one=utf8_decode(" 4 derniers chiffres de la carte de crédit enregistrée pour vos frais de services du");
		
		$lifeTimeRankFrenchLabel="Rang à vie *";
		
		$ssn_label_two=utf8_decode("compte Coach*");
		
		$phone_label=utf8_decode("Téléphone*");
		$no_value_label=utf8_decode("Aucune valeur");

		$reason_label=utf8_decode("Raison principale de l'annulation*");
		$comment_label=utf8_decode("Veuillez ajouter tout commentaire sur votre expérience de Coach Team Beachbody dans la case ci-dessous.");
		$comment_label2=utf8_decode("Votre avis nous est précieux.");
		$sub_title1_label=utf8_decode("Autres abonnements et Inscriptions*");
		$text_1=utf8_decode("Les prix ci-dessous indiqués n'inclus pas les frais de port et taxes");
		$continued_service_label_1=utf8_decode("Veuillez cocher la case correspondante du service ");
		$continued_service_label_2=utf8_decode("que vous désirez continuer:");
		$text_tax=utf8_decode("*Les prix ci-dessous indiqués n'inclus pas les frais de port et taxes");
		$text_2=utf8_decode("**Souvenez-vous que si vous annulez ou n'avez pas d'abonnement à Beachbody On Demand, vous n'aurez pas accès au téléchargement, ");
		$text_3=utf8_decode("  et vous n'obtiendrez pas 10% de rabais sur vos prochains achats. Si vous conservez votre adhésion à Beachbody On Demand, vous");
		$text_3_b=utf8_decode(" obtiendrez 10% de rabais sur les prix indiqués.");
		$sub_title2_label=utf8_decode("Conditions de l'annulation*");
		$text_4=utf8_decode("Veuillez cocher toutes les cases pour signer et soumettre votre annulation");
		$sign_submit_label=utf8_decode("En signant et soumettant ce formulaire, J'atteste ce qui suit :");
		$submit_condition_1=utf8_decode(" Je perdrai le 25% de rabais sur tous les produits Team Beachbody et abonnements  indiqués plus haut");
		$submit_condition_2_a=utf8_decode("Pour tout abonnement et inscription que je désire continuer, J'atteste les charges qui surviendront");
		$submit_condition_2_b=utf8_decode("et approuve que je pourrai annuler à tout moment en appelant le service à la clientèle au 1 (800) 470-7870");
		$submit_condition_3=utf8_decode(" Je perdrai mon droit de vendre les produits Team Beachbody");
		$submit_condition_4=utf8_decode(" Je ne suis plus admissible à gagner des commissions selon les termes du plan de compensation Team Beachbody");
		$submit_condition_5=utf8_decode(" J'abandonne indéfiniment ma position dans l'arbre généalogique de Team Beachbody, y compris les ");
		$submit_condition_5_b=utf8_decode("bonus et commissions en cours ou tout autre forme de compensation ");
		$submit_condition_6_a=utf8_decode(" Je ne pourrai pas me réinscrire en tant que Coach Team Beachbody avant une période de 6 mois suivant la date");
		$submit_condition_6_b=utf8_decode(" de mon annulation si je désire me réinscrire avec un nouveau Sponsor Coach, ou avec mon Sponsor Coach");
		$submit_condition_6_c=utf8_decode(" d'origine sur une Jambe différente de son organisation (veuillez consulter la Section 3.6.3 des politiques");
		$submit_condition_6_d=utf8_decode("   et procédures de coach du Team Beachbody).");
		$signature_label=utf8_decode("Entrez votre Signature dans la case ci-dessous*");
		$date_label="Date"; 
		$time_label="Time";
		$text_5_a=utf8_decode("En signant ce formulaire, je certifie que je suis le propriétaire véritable du compte d'entreprise Coach et/ou autorise");
		$text_5_b=utf8_decode("l'annulation de ce compte. Si nous avons des questions, nous vous contacterons au travers des informations fournies plus haut.");
		$text_6="IMPORTANT";
		$text_7_a=utf8_decode(" La soumission de ce formulaire  n'annule pas/ou mettre en attente les facturations en cours ");
		$text_7_b=utf8_decode("pendant ce processus. Vous pourriez être facturé pour ces commandes.");
		*/
		
		
		
		
		/*
		*Incident Fields are saved
		*/
		
		$incident->PrimaryContact = $contact;
		$incident->Subject= $formData['Incident_Subject'];
		$incident->CustomFields->c->coachcustomernumber=$formData['Incident_CustomFields_c_coachcustomernumber'];
		$incident->CustomFields->c->ccf_cancel_all_enrollments=$formData['Incident_CustomFields_c_ccf_cancel_all_enrollments'];
		$incident->CustomFields->c->ccf_tbb_club_membership=$formData['Incident_CustomFields_c_ccf_tbb_club_membership'];
		$incident->CustomFields->c->ccf_pro_team=$formData['Incident_CustomFields_c_ccf_pro_team'];
		$incident->CustomFields->c->ccf_shakeology=$formData['Incident_CustomFields_c_ccf_shakeology'];
		//$incident->CustomFields->c->ccf_coaching_experience=$formData['Incident_CustomFields_c_ccf_coaching_experience'];
		$incident->CustomFields->c->form_routing->ID=$formData['Incident_CustomFields_c_form_routing'];
		$incident->CustomFields->c->ccf_other_continued_services=$formData['Incident_CustomFields_c_ccf_other_continued_services'];
		$incident->CustomFields->c->ccf_membership_and_enrollment=$formData['Incident_CustomFields_c_ccf_membership_and_enrollment'];
		$incident->CustomFields->c->last_four_ssn=$formData['Incident_CustomFields_c_last_four_ssn'];
		if($formData['Incident_CustomFields_c_ccf_reason_for_cancellation_fr'])
		{
			$cancellation = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\Incident", "customFields.c.ccf_reason_for_cancellation_fr"); 
				
				
				foreach($cancellation as $items)
				{
					if($items->LookupName == $formData['Incident_CustomFields_c_ccf_reason_for_cancellation_fr'])
					{
						$incident->CustomFields->c->ccf_reason_for_cancellation_fr->ID = $items->ID;
						$id=$items->ID;
					}
				}  
		
		/*echo "reached".$incident->CustomFields->c->ccf_reason_for_cancellation_fr->ID;
		die("--------------------------------------");*/
			/*if($id==663)
			{
			$flag=1;
			$incident->CustomFields->c->ccf_other_reason=$formData['Incident_CustomFields_c_ccf_other_reason'];
			}*/
		}
		
		//---saving life time rank--
		if($formData['Incident_CustomFields_c_life_time_rank'])
		{
			$life_time_rank = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\Incident", "customFields.c.life_time_rank"); 
				
				foreach($life_time_rank as $items)
				{
					
					if($items->ID == $formData['Incident_CustomFields_c_life_time_rank'])
					{
						$incident->CustomFields->c->life_time_rank->ID = $items->ID;
						$lifeTimeRankFrenchID=$items->ID;
					}
				}  
		
		}/*
		if($lifeTimeRankFrenchID==478)
		{
			$lifeTimeRankFrench="Coach – Diamant";
		}
		if($lifeTimeRankFrenchID==1365)
		{
			$lifeTimeRankFrench="1 - 4 étoiles Diamant";
		}
		if($lifeTimeRankFrenchID==492)
		{
			$lifeTimeRankFrench="5 étoiles Diamant et au-dessus";
		}
		*/
		
		//-----life time rank-------
		
		/*
		*PDF Generation starts here.
		*AddPage: Adds a new page to PDF
		*Cell: Writes the content to the PDF(Parameters:width,height,CONTENT,border,ln=0,align,fill,link)
		*Image: Inserts an Image(Parameters:file,x,y,w,h,type,link)
		*SetFont: Sets the font size, family, weight etc
		*/
		/*$pdf_obj = $ci->fpdf_obj->fpdf_obj_create();
		$size=array(210,335);
		
		$y=23;
		
		$pdf_obj->AddPage('',$size);
		$pdf_obj->SetFont('Arial','B',16);
		$pdf_obj->Image($pic2, 15,3, 60, 12, 'jpg');
		$pdf_obj->Cell(80,$y,'');
		$pdf_obj->Cell(17,$y,$title_1,0,0,'C');
		$y+=15;
		$pdf_obj->Cell(-30,$y,$title_2,0,0,'C');
		$pdf_obj->SetFont('Arial','',10);
		$y+=18;
		$pdf_obj->SetFont('Arial','I',9);
		$pdf_obj->Cell(-56,$y,'');
		$pdf_obj->Cell(10,$y,$text_main_1,0,0,'L');
		$y+=10;
		$pdf_obj->Cell(-10,$y,'');
		$pdf_obj->Cell(10,$y,$text_main_2,0,0,'L');
		$y+=10;
		$pdf_obj->Cell(-10,$y,'');
		$pdf_obj->Cell(10,$y,$text_main_3,0,0,'L');
		$y+=18;
		$pdf_obj->SetFont('Arial','',9);
		$pdf_obj->Cell(-10,$y,'');
		$pdf_obj->Cell(-20,$y,$required);
		
		
		
		
		$y+=21;
		
		$pdf_obj->SetFont('Arial','B',10);
		$pdf_obj->Cell(20,$y,'');
		$pdf_obj->Cell(100,$y,$coach_id_label);
		$pdf_obj->Cell(-100,$y,$email_label,0,0,'L');
		$pdf_obj->SetFont('Arial','',10);
		$y+=17;
		if($formData['Incident_CustomFields_c_coachcustomernumber'])
		{
		$pdf_obj->Cell(101,$y,utf8_decode($formData['Incident_CustomFields_c_coachcustomernumber']),0,0,'L');
		}
		else
		{
		$pdf_obj->Cell(101,$y,$no_value_label,0,0,'L');
		}
		$pdf_obj->Cell(-101,$y,utf8_decode($formData['Contact_Emails_PRIMARY_Address']),0,0,'L');
		
		
		$y+=20;
		$pdf_obj->SetFont('Arial','B',10);
		$pdf_obj->Cell(100,$y,$first_name_label,0,0,'L');
		$pdf_obj->Cell(-100,$y,$last_name_label,0,0,'L');
		$pdf_obj->SetFont('Arial','',10);*/
		//$weirdword = "Dï¿½as, Miï¿½rcoles, Sï¿½bado,miï¿½rcoles"; //Some spanish days
//		$word = ;
//		$new_word=utf8_decode($word);//urldecode($word);
		//
		
		
		/*$y+=17;
		$pdf_obj->Cell(101,$y,utf8_decode($formData['Incident_CustomFields_c_ccf_first_name']),0,0,'L');
		$pdf_obj->Cell(-101,$y,utf8_decode($formData['Incident_CustomFields_c_ccf_last_name']),0,0,'L');
		
		$y+=20;
		$pdf_obj->SetFont('Arial','B',10);
		$pdf_obj->Cell(1,$y,$business_name_label,0,0,'L');
		$pdf_obj->SetFont('Arial','',10);
		$y+=17;
		if($formData['Incident_CustomFields_c_ccf_business_name'])
		{
		$pdf_obj->Cell(20,$y,utf8_decode($formData['Incident_CustomFields_c_ccf_business_name']),0,0,'L');
		}
		else
		{
		$pdf_obj->Cell(20,$y,$no_value_label,0,0,'L');
		}
		
		$y+=20;
		$pdf_obj->SetFont('Arial','B',10);
		$pdf_obj->Cell(-22,$y,'');
		$pdf_obj->Cell(1,$y,$ssn_label_one,0,0,'L');
		$y+=15;
		$pdf_obj->Cell(1,$y,$ssn_label_two,0,0,'L');
		$y+=15; 
		$pdf_obj->SetFont('Arial','',10);
		if($formData['Incident_CustomFields_c_last_four_ssn'])
		{
		$pdf_obj->Cell(-1,$y,$formData['Incident_CustomFields_c_last_four_ssn'],0,0,'L');
		}
		else
		{
		$pdf_obj->Cell(-1,$y,$no_value_label,0,0,'L');
		}
		$pdf_obj->SetFont('Arial','B',10);
		//-----life time rank----
		
		$y+=20;
		$pdf_obj->Cell(1,$y,utf8_decode($lifeTimeRankFrenchLabel),0,0,'L');
		$pdf_obj->SetFont('Arial','',10);
		$y+=17;
		$pdf_obj->Cell(-1,$y,utf8_decode($lifeTimeRankFrench),0,0,'L');
		
		//-----------------------
		 
		$pdf_obj->SetFont('Arial','B',10);
		$y+=20;
		$pdf_obj->Cell(1,$y,$phone_label,0,0,'L');
		$pdf_obj->SetFont('Arial','',10);
		$y+=17;
		$pdf_obj->Cell(-1,$y,$formData['Contact_Phones_MOBILE_Number'],0,0,'L');
		
		
		
		$y+=20;
		$pdf_obj->SetFont('Arial','B',10);
		$pdf_obj->Cell(1,$y,$reason_label,0,0,'L');
		$pdf_obj->SetFont('Arial','',10);
		
		
		
		$y+=17;
		*/
		/*if($formData['Incident_CustomFields_c_ccf_reason_for_cancellation_fr'])
		{
				$pdf_obj->Cell(-1,$y,utf8_decode($formData['Incident_CustomFields_c_ccf_reason_for_cancellation_fr']),0,0,'L');
			
		}
		else
		{
		$pdf_obj->Cell(-1,$y,$no_value_label,0,0,'L');
		}
		$y+=17;
		$inc=7;
		$line_count=0;
		$comments=$formData['Incident_CustomFields_c_ccf_coaching_experience'];
		$pdf_obj->SetDrawColor(0,71,179);//51,102,200
		
		$y+=25;
		//203 first line
		//COMMENTS
		$comment_y=$line_count;
		$y_line=$y-179;
				
		$y_line-=25;
		
		$pdf_obj->Line(25,$y_line,190,$y_line);
		
		$pdf_obj->SetFont('Arial','B',16);
		$pdf_obj->Cell(-2,$y,'',0,0,'L');
		$pdf_obj->Cell(1,$y,$sub_title1_label,0,0,'L');
		$pdf_obj->SetFont('Arial','I',8);
		$y+=7;
		//$pdf_obj->Cell(-1,$y,$text_1,0,0,'L');
		
		
		$service1=$formData['Incident_CustomFields_c_ccf_cancel_all_enrollments'];
		$service2=$formData['Incident_CustomFields_c_ccf_tbb_club_membership'];
		$service3=$formData['Incident_CustomFields_c_ccf_shakeology'];
		$service4=$formData['Incident_CustomFields_c_ccf_other_continued_services'];
		$service_pro=$formData['Incident_CustomFields_c_ccf_pro_team'];
		$service5=$formData['Incident_CustomFields_c_ccf_performance_french'];
		$service6=$formData['Incident_CustomFields_c_ccf_shakeology_boost_french'];
		$service7=$formData['Incident_CustomFields_c_ccf_3_day_refresh_french'];
		$other_service=$formData['Incident_CustomFields_c_ccf_membership_and_enrollment'];
		*/
		/*
		* The Text for corresponding service is taken from Message Bases
		*/
		
		
		
		if($formData['Incident_CustomFields_c_ccf_performance_french'])
		{
			$performance = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\Incident", "customFields.c.ccf_performance_french"); 
				foreach($performance as $items)
				{
					if($items->ID == $formData['Incident_CustomFields_c_ccf_performance_french'])
					{
						$incident->CustomFields->c->ccf_performance_french->ID = $items->ID;
						$performance=$items->LookupName;
					}
				}  
		}
		
		
		if($formData['Incident_CustomFields_c_ccf_shakeology_boost_french'])
		{
			$shakeology_boost = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\Incident", "customFields.c.ccf_shakeology_boost_french"); 
				foreach($shakeology_boost as $items)
				{
					if($items->ID == $formData['Incident_CustomFields_c_ccf_shakeology_boost_french'])
					{
						$incident->CustomFields->c->ccf_shakeology_boost_french->ID = $items->ID;
						$shakeology_boost=$items->LookupName;
					}
				}  
		}
		
		
		
		if($formData['Incident_CustomFields_c_ccf_3_day_refresh_french'])
		{
			$refresh = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\Incident", "customFields.c.ccf_3_day_refresh_french"); 
				foreach($refresh as $items)
				{
					if($items->ID == $formData['Incident_CustomFields_c_ccf_3_day_refresh_french'])
					{
						$incident->CustomFields->c->ccf_3_day_refresh_french->ID = $items->ID;
						$refresh=$items->LookupName;
					}
				}  
		}
		
		
		
	/*	if($performance)
		{
		$performance_label ="Beachbody Performance*:  ".$performance;
		}
		else
		{
		$performance_label ="Beachbody Performance";
		}
		
		if($shakeology_boost)
		{
		$shakeology_boost_label ="Shakeology Boost*:  ".$shakeology_boost;
		}
		else
		{
		$shakeology_boost_label ="Shakeology Boost";
		}
		
		if($refresh)
		{
		$refresh_label = "3 Day Refresh*:  ".$refresh; 
		}
		else
		{
		$refresh_label = "3 Day Refresh";
		}
		
		
		
		
		
		
		$service_enroll=\RightNow\Utils\Config::getMessage(CUSTOM_MSG_CCF_CANCEL_ALL_ENROLLMENTS_FRENCH);
		$service_tbb=\RightNow\Utils\Config::getMessage(CUSTOM_MSG_TBB_CLUB_MEMBERSHIP_FRENCH);
		$service_tbb=str_replace("</br>","     ",$service_tbb);
		$service_shakeology=\RightNow\Utils\Config::getMessage(CUSTOM_MSG_CCF_SHAKEOLOGY_FRENCH);
		$service_pro_label = "Pro Team";
		if($other_service)
		{
			$service_other="Autres* : ".$other_service;
		}
		else
		{
			$service_other="Autres";
		}
		$y+=25;
		$y_checkbox1=$y-205;
		$y_checkbox2=$y-197;
		$y_checkbox3=$y-189;
		
		$y_checkbox_per=$y-182;
		$y_checkbox_shk =$y-174;
		$y_checkbox_refresh=$y-167;
		
		$y_checkbox_pro=$y-160;
		
		$y_checkbox4=$y-152;//157
		
		
		
		
		//$y+=10;
		
		$pdf_obj->SetFont('Arial','B',10);
		$pdf_obj->Cell(86,$y,$continued_service_label_1,0,0,'L');
		$pdf_obj->SetFont('Arial','BU',10);
		$pdf_obj->Cell(-86,$y,$continued_service_label_2,0,0,'L');
		$pdf_obj->SetFont('Arial','',9);
		
		
		
		
		
		
		$counter=0;
		$y+=15;
		$inc=15;
		
		if($service1)
		{
			$pdf_obj->Image($pic5, 22,$y_checkbox1, 3, 3, 'jpg');
		}
		else
		{
			$pdf_obj->Image($pic4, 22,$y_checkbox1, 3, 3, 'jpg');
		}
		
		$pdf_obj->Cell(5,$y,'',0,0,'L');
		$pdf_obj->Cell(-1,$y,utf8_decode($service_enroll),0,0,'L');
		$y+=$inc;
		$counter++;
		
		
		if($service2)
		{
			$pdf_obj->Image($pic5, 22,$y_checkbox2, 3, 3, 'jpg');
		}
		else
		{
			$pdf_obj->Image($pic4, 22,$y_checkbox2, 3, 3, 'jpg');
		}
		
		$pdf_obj->Cell(1,$y,'',0,0,'L');
		$pdf_obj->Cell(-1,$y,utf8_decode($service_tbb),0,0,'L');
		$y+=$inc;
		$counter++;
		
		if($service3)
		{
			$pdf_obj->Image($pic5, 22,$y_checkbox3, 3, 3, 'jpg');
		}
		else
		{
			$pdf_obj->Image($pic4, 22,$y_checkbox3, 3, 3, 'jpg');
		}
		
		$pdf_obj->Cell(1,$y,'',0,0,'L');
		$pdf_obj->Cell(-1,$y,utf8_decode($service_shakeology),0,0,'L');
		$y+=$inc;
		$counter++;
		
		if($service5)
		{
			$pdf_obj->Image($pic5, 22,$y_checkbox_per, 3, 3, 'jpg');
		}
		else
		{
			$pdf_obj->Image($pic4, 22,$y_checkbox_per, 3, 3, 'jpg');
		}
		
		$pdf_obj->Cell(1,$y,'',0,0,'L');
		$pdf_obj->Cell(-1,$y,utf8_decode($performance_label),0,0,'L');
		$y+=$inc;
		$counter++;
		
		if($service6)
		{
			$pdf_obj->Image($pic5, 22,$y_checkbox_shk, 3, 3, 'jpg');
		}
		else
		{
			$pdf_obj->Image($pic4, 22,$y_checkbox_shk, 3, 3, 'jpg');
		}
		
		$pdf_obj->Cell(1,$y,'',0,0,'L');
		$pdf_obj->Cell(-1,$y,utf8_decode($shakeology_boost_label),0,0,'L');
		$y+=$inc;
		$counter++;
		
		
		if($service7)
		{
			$pdf_obj->Image($pic5, 22,$y_checkbox_refresh, 3, 3, 'jpg');
		}
		else
		{
			$pdf_obj->Image($pic4, 22,$y_checkbox_refresh, 3, 3, 'jpg');
		}
		
		$pdf_obj->Cell(1,$y,'',0,0,'L');
		$pdf_obj->Cell(-1,$y,utf8_decode($refresh_label),0,0,'L');
		$y+=$inc;
		$counter++;
		
		
		
		if($service_pro)
		{
			$pdf_obj->Image($pic5, 22,$y_checkbox_pro, 3, 3, 'jpg');
		}
		else
		{
			$pdf_obj->Image($pic4, 22,$y_checkbox_pro, 3, 3, 'jpg');
		}
		
		if($service4)
		{
			$pdf_obj->Image($pic5, 22,$y_checkbox4, 3, 3, 'jpg');
		}
		else
		{
			$pdf_obj->Image($pic4, 22,$y_checkbox4, 3, 3, 'jpg');
		}
		
		$pdf_obj->Cell(1,$y,'',0,0,'L');
		$pdf_obj->Cell(-1,$y,utf8_decode($service_pro_label),0,0,'L');
		$y+=$inc;
		
		$pdf_obj->Cell(1,$y,'',0,0,'L');
		$pdf_obj->Cell(-1,$y,utf8_decode($service_other),0,0,'L');
		$y+=$inc;
		
		$pdf_obj->SetFont('Arial','I',8);
		
		$y+=7;
		$pdf_obj->Cell(3,$y,$text_tax,0,0,'L');
		$y+=10;
		$counter++;
		$pdf_obj->Cell(-5,$y,'',0,0,'L');
		//$y+=15;
		$pdf_obj->SetFont('Arial','I',8);
		$pdf_obj->Cell(2,$y,'',0,0,'L');
		$pdf_obj->Cell(1,$y,$text_2,0,0,'L');
		$y+=8;
		$pdf_obj->Cell(-1,$y,$text_3,0,0,'L');
		$y+=8;
		$pdf_obj->Cell(1,$y,'',0,0,'L');
		$pdf_obj->Cell(-1,$y,$text_3_b,0,0,'L');
		
		
		
		$pdf_obj->SetDrawColor(0,71,179);//51,102,200
		
		$y+=25;
		//203
		//TOC
		$comment_y=$line_count;
		$y_line=$y-310;
				
		//107
		
		$pdf_obj->Line(25,$y_line,190,$y_line);
		
		
			$pdf_obj->AddPage('',$size);
		
		$y=10;
		 
		$pdf_obj->SetFont('Arial','B',16);
		$pdf_obj->Cell(10,$y,'',0,0,'L');
		$pdf_obj->Cell(2,$y,$sub_title2_label,0,0,'L');
		$pdf_obj->SetFont('Arial','I',9);
		$y+=20;
		$pdf_obj->Cell(-2,$y,$text_4,0,0,'L');
		$y+=20;
		$pdf_obj->SetFont('Arial','B',10);
		$pdf_obj->Cell(2,$y,$sign_submit_label,0,0,'L');
		$pdf_obj->SetFont('Arial','',10);
		$y+=20;
		
		$pdf_obj->SetFont('Arial','B',24);
		
		$y_checkbox=43;
	
		$pdf_obj->SetFont('Arial','',10);
		$pdf_obj->Cell(4,$y,'',0,0,'L');
		$pdf_obj->Image($pic5, 22,$y_checkbox, 3, 3, 'jpg');
		$pdf_obj->Cell(1,$y,$submit_condition_1,0,0,'L');
		$y+=17;
		$pdf_obj->SetFont('Arial','B',24);
	
		$y_checkbox+=9;
	
		$pdf_obj->SetFont('Arial','',10);
		$pdf_obj->Image($pic5, 22,$y_checkbox, 3, 3, 'jpg');
		$pdf_obj->Cell(-1,$y,$submit_condition_2_a,0,0,'L');
		$y+=12;
		$pdf_obj->Cell(1,$y,'',0,0,'L');
		$pdf_obj->Cell(-1,$y,$submit_condition_2_b,0,0,'L');
		$y+=17;
		$pdf_obj->SetFont('Arial','B',24);
		
		
		$y_checkbox+=14;
		$pdf_obj->SetFont('Arial','',10);
		$pdf_obj->Cell(-1,$y,'',0,0,'L');
		$pdf_obj->Cell(1,$y,'',0,0,'L');
		$pdf_obj->Image($pic5, 22,$y_checkbox, 3, 3, 'jpg');
		$pdf_obj->Cell(1,$y,$submit_condition_3,0,0,'L');
		$y+=17;
		$pdf_obj->SetFont('Arial','B',24);
	
		$y_checkbox+=9;
		$pdf_obj->SetFont('Arial','',10);
		$pdf_obj->Cell(-1,$y,'',0,0,'L');
		$pdf_obj->Image($pic5, 22,$y_checkbox, 3, 3, 'jpg');
		$pdf_obj->Cell(1,$y,$submit_condition_4,0,0,'L');
		$y+=17;
		$pdf_obj->SetFont('Arial','B',24);
		
		$y_checkbox+=8;
		$pdf_obj->SetFont('Arial','',10);
		$pdf_obj->Cell(-1,$y,'',0,0,'L');
		$pdf_obj->Image($pic5, 22,$y_checkbox, 3, 3, 'jpg');
		$pdf_obj->Cell(-1,$y,$submit_condition_5,0,0,'L');
		$y+=12;
		$pdf_obj->Cell(2,$y,'',0,0,'L');
		$pdf_obj->Cell(-3,$y,$submit_condition_5_b,0,0,'L');
		$y+=17;
		$pdf_obj->SetFont('Arial','B',24);
		
		$y_checkbox+=14;
		$pdf_obj->SetFont('Arial','',10);
		$pdf_obj->Cell(2,$y,'',0,0,'L');
		$pdf_obj->Image($pic5, 22,$y_checkbox, 3, 3, 'jpg');
		$pdf_obj->Cell(1,$y,$submit_condition_6_a,0,0,'L');
		$y+=12;
		$pdf_obj->Cell(-1,$y,'',0,0,'L');
		$pdf_obj->Cell(-1,$y,$submit_condition_6_b,0,0,'L');
		$y+=12;
		$pdf_obj->Cell(1,$y,'',0,0,'L');
		$pdf_obj->Cell(-2,$y,$submit_condition_6_c,0,0,'L');
		$y+=12;
		$pdf_obj->Cell(-3,$y,$submit_condition_6_d,0,0,'L');
		$y+=25;
		$pdf_obj->SetFont('Arial','B',10);
		$pdf_obj->Cell(1,$y,$signature_label,0,0,'L');*/
		/*$pdf_obj->Cell(50,$y,$date_label,0,0,'L');
		$pdf_obj->Cell(-50,$y,$time_label,0,0,'L');*/
		
		/*$y+=18;
		//$pdf_obj->Image($sign,25,133, 60, 16, 'jpg');
		//$y+=12;
		
		$pdf_obj->SetFont('Arial','B',10);
		//$pdf_obj->Image($sign,20,110, 60, 16, 'jpg');
		$pdf_obj->Cell(-1,$y,$sign,0,0,'L');	

		$pdf_obj->SetFont('Arial','I',9);
		$y+=20;
		$pdf_obj->Cell(1,$y,$text_5_a,0,0,'L');
		$y+=10;
		$pdf_obj->Cell(-1,$y,'',0,0,'L');
		$pdf_obj->Cell(1,$y,$text_5_b,0,0,'L');*/
	
		/*$y+=35;
		$pdf_obj->SetFont('Arial','B',10);
		$pdf_obj->Cell(25,$y,$text_6,0,0,'L');
		$pdf_obj->SetFont('Arial','',9);
		$pdf_obj->Cell(-25,$y,$text_7_a,0,0,'L');
		$y+=10;
		$pdf_obj->Cell(-1,$y,$text_7_b,0,0,'L');*/
		
		/*$pdf_obj->Output(); // remove the comment for these two lines inorder to view the generated PDF without creating an incident
		exit;   */
		
		/*
		*Saves the Incident and Reference # is returned
		*/
		AbuseDetection::check();
		$res=$incident->save();
		
		/*
		* Gets the Incident ID and updates the incident by attaching the pdf with Incident ID on it
		*/
		
		$refno = $incident->ReferenceNumber;
		$inc_id=$incident->ID;
		/*$incident = RNCPHP\Incident::fetch($inc_id);
		
		$pdf_obj->SetFont('courier','',10);
		$y+=32;
		
		$date_time=$date." ".$time." Pacific Time; ";
		$pdf_obj->Cell(1,$y,'',0,0,'L');
		$pdf_obj->Cell(1,$y,'Submitted ',0,0,'L');
		$pdf_obj->Cell(20,$y,'',0,0,'L');
		$pdf_obj->Cell(5,$y,$date_time,0,0,'L');
		
		$pdf_obj->Cell(68,$y,'',0,0,'L');
		$pdf_obj->Cell(1,$y,'Incident Reference # ',0,0,'L');
		$pdf_obj->Cell(43,$y,'',0,0,'L');
		$pdf_obj->Cell(5,$y,$refno,0,0,'L');
		*/
		
		
		/*$pdf_str=$pdf_obj->Output('S');
		
		$current_date=date("m/d/Y");
		$current_time=date("G:i:s");
		
		$folder="/tmp/";
		$fname="DS3_".$date.".pdf";
		$filename = $folder.$fname;
		$fp= fopen($filename, "w");
		$str=$pdf_str;
		fputs($fp,$str);
		fclose($fp);
		
		$incident->FileAttachments =new RNCPHP\FileAttachmentIncidentArray();
		$fattach = new RNCPHP\FileAttachmentIncident();
		$fattach->ContentType = "application/pdf";
		
		$fp = $fattach->makeFile();
		$fattach->Data=$fname;
		$date = date("m-d-Y"); 
		$fattach->FileName = "TBB Coach Cxl Form_".$date.".pdf";
		$incident->FileAttachments[] = $fattach;
		AbuseDetection::check();
		$res=$incident->save();*/
		
		if($res)
		{
			return $refno;
		}
		
		
	}
	
	
	
	}
	
	
	function createIncidentSpanish(array $formData)
	{
	initConnectAPI();	

		
	$encoded_data=$formData['base64_encoded_string'];
	
	$ci=& get_instance();
	/*
	*Loads the Library for PDF generation
	*Gets the LOGO and converts it into base64 encoded string
	*/
	
	//$ci->load->library("fpdf_ds");
	/*$sign=$formData['signatureText'];//$encoded_data;
	
	
	$filename3 = "/vhosts/us_english/euf/assets/images/team_beachbody_logo.jpg";
	$fp3= fopen($filename3, "r");
	$test=file_get_contents($filename3);
	$pic2="data:image/jpeg;base64,".base64_encode($test);
	
	
	
	$filename4 = "/vhosts/us_english/euf/assets/images/checkbox_unchecked.jpg";
	$fp4= fopen($filename4, "r");
	$content=file_get_contents($filename4);
	$pic4="data:image/jpeg;base64,".base64_encode($content);
	
	$filename5 = "/vhosts/us_english/euf/assets/images/checkbox_checked.jpg";
	$fp5= fopen($filename5, "r");
	$content=file_get_contents($filename5);
	$pic5="data:image/jpeg;base64,".base64_encode($content);*/
	
	$email=$formData['Contact_Emails_PRIMARY_Address'];
	$incident= new RNCPHP\Incident();
	/*
	*Fetches the contact for the corresponding Email Address
	*And checks whether it exists or not
	*If the email address doesn't exiat, a new contact is created
	*and Incident fields are updated
	*else Incident fields alone are updated
	*/
	
	$contact_check = RNCPHP\Contact::first("Emails.Address='$email'");
	if($contact_check->ID=="")
	{
		$contact = new RNCPHP\Contact();
		$contact->Name = new RNCPHP\PersonName();
		$contact->Name->First = $formData['Incident_CustomFields_c_ccf_first_name'];
		$contact->Name->Last = $formData['Incident_CustomFields_c_ccf_last_name'];
		
		$contact->Emails = new RNCPHP\EmailArray();
		$contact->Emails[0] = new RNCPHP\Email();
		$contact->Emails[0]->AddressType=new RNCPHP\NamedIDOptList();
		$contact->Emails[0]->AddressType->ID = 0;
		$contact->Emails[0]->Address =$formData['Contact_Emails_PRIMARY_Address'];

		
		$contact->Phones = new RNCPHP\PhoneArray();
		$contact->Phones[0] = new RNCPHP\Phone();
		$contact->Phones[0]->PhoneType = new RNCPHP\NamedIDOptList();
		$contact->Phones[0]->PhoneType->LookupName = 'Mobile Phone';
		$contact->Phones[0]->Number = $formData['Contact_Phones_MOBILE_Number'];
		
		
	
		
		AbuseDetection::check();
		$r=$contact->save();
	}
	else
	{
		$contact=$contact_check;
		$r=true;
	}
	$incident->CustomFields->c->ccf_first_name= $formData['Incident_CustomFields_c_ccf_first_name'];
	$incident->CustomFields->c->ccf_last_name= $formData['Incident_CustomFields_c_ccf_last_name'];
    $incident->CustomFields->c->ccf_business_name= $formData['Incident_CustomFields_c_ccf_business_name'];
	$incident->CustomFields->c->ccf_phone_number=  $formData['Contact_Phones_MOBILE_Number'];
	
	/*
	*Field Labels for PDF
	*/
	
	if($r)
	{		
		// extract dimensions from image
		/*$info = getimagesize($pic2);
		$date = date("m-d-Y"); 
		$time= date("G:i:s");
		$title=utf8_decode("Formulario de cancelación de coach independiente");
		$text_main_1=utf8_decode("Este formulario te permite cancelar permanentemente tus cuentas de coach de Team Beachbody y cualquier otra membresía ");
		$text_main_2=utf8_decode("o suscripción a la que estés inscrito. Completa con precisión toda la información requerida. Tu cancelación podría");
		$text_main_3=utf8_decode("demorarse si recibimos la información incorrecta.");
		$required=utf8_decode("*Campo obligatorio");
		$coach_id_label=utf8_decode("Identificación del coach");
		$email_label=utf8_decode("Correo electrónico*");
		$first_name_label=utf8_decode("Nombre*");
		$last_name_label=utf8_decode("Apellido*");
		$business_name_label=utf8_decode("Nombre del negocio (si corresponde) ");
		//$ssn_label=utf8_decode("Últimos cuatro dígitos de SSN, EIN o SIN*");
		
		$ssn_label_one=utf8_decode("Los últimos 4 dígitos de la tarjeta de crédito que es utilizada para el pago de la");
		$ssn_label_two=utf8_decode("tarifa de Servicio de Negocios*");
		
		$lifeTimeRankSpanish_label=utf8_decode("Rango de por Vida*");
		
		$phone_label=utf8_decode("Teléfono *");
		$no_value_label=utf8_decode("Nulo");

		$reason_label=utf8_decode("Selecciona la razón principal que mejor describa tu cancelación");
		$comment_label=utf8_decode("A continuación, proporciona cualquier detalle sobre tu experiencia como coach. Agradecemos");
		$comment_label2=utf8_decode("tus comentarios.");
		$sub_title1_label=utf8_decode("Otras membresías y suscripciones*");
		$text_tax=utf8_decode("Marca la casilla junto a los servicios que deseas continuar recibiendo:");
		$text_1=utf8_decode("*Los precios no incluyen cargos por envío y manejo ni impuestos");
		$continued_service_label_1=utf8_decode("Marca la casilla junto a los servicios que ");
		$continued_service_label_2=utf8_decode("deseas continuar recibiendo:");
		$text_2=utf8_decode("**Por favor recuerde, que si usted cancela o no cuenta con una membresia de Beachbody On Demand, usted no tendra acceso");
		$text_3_a=utf8_decode("a transmitir los videos y no obtendra el 10% de descuento en sus futuras compras. Si usted continua con la membresia  ");
		$text_3_b=utf8_decode("de Beachbody On Demand, usted obtendra el 10% de descuento sobre precios de lista.");
		$sub_title2_label=utf8_decode("Términos de cancelación*");
		$text_4=utf8_decode("Marca todas las casillas para firmar y enviar tu cancelación");
		$sign_submit_label=utf8_decode("Al firmar y enviar este formulario, entiendo lo siguiente :");
		$submit_condition_1_a=utf8_decode("Perderé el 25 % de descuento para coaches en todos los pedidos futuros, y toda membresía ");
		$submit_condition_1_b=utf8_decode("o suscripción continuada indicada arriba.");
		$submit_condition_2_a=utf8_decode("Acepto el cargo por los productos relacionados con cualquier membresía o suscripción continuada, y ");
		$submit_condition_2_b=utf8_decode("entiendo que puedo cancelar en cualquier momento llamando a Servicio al cliente al 1 (800) 470-7870.");
		$submit_condition_3=utf8_decode("Pierdo el derecho de vender productos de Team Beachbody.");
		$submit_condition_4=utf8_decode("Ya no seré elegible para ganar una comisión en virtud del plan de compensación de Team Beachbody.");
		$submit_condition_5_a=utf8_decode(" Abandono permanentemente mi posición dentro de la genealogía de Team Beachbody, así como todas  ");
		$submit_condition_5_b=utf8_decode("las bonificaciones, comisiones u otros tipos de compensación pendientes.");
		$submit_condition_6_a=utf8_decode(" No podré volver a registrarme como un coach de Team Beachbody hasta dentro de seis meses calendario ");
		$submit_condition_6_b=utf8_decode("a partir de la fecha de mi cancelación, o si deseara volver a registrarme con un nuevo patrocinador, o con ");
		$submit_condition_6_c=utf8_decode("mi patrocinador original en una rama diferente de la organización de mi patrocinador, (consulta la ");
		$submit_condition_6_d=utf8_decode("Sección 3.6.3 de las Políticas y procedimientos del coach de Team Beachbody).");
		$signature_label=utf8_decode("Firma a continuación*");
		$date_label=utf8_decode("Fecha");
		$time_label=utf8_decode("Hora");
		$text_5_a=utf8_decode("Al firmar, certifico que soy el titular actual de la cuenta del Centro de negocio de coaches y/o estoy autorizado ");
		$text_5_b=utf8_decode("a cancelar esta cuenta. Si tenemos cualquier pregunta, nos comunicaremos contigo a la información que indicaste arriba.");
		$text_6=utf8_decode("IMPORTANTE :");
		$text_7_a=utf8_decode(" El envío de este formulario no suspende ni cancela los cargos o envíos pendientes que estén en proceso");
		$text_7_b=utf8_decode("o programados durante el tiempo que tome este proceso. Se te podrían hacer cargos por estos pedidos.");
		*/
		
		
		
		/*
		*Incident Fields are saved
		*/
		
		$incident->PrimaryContact = $contact;
		$incident->Subject= $formData['Incident_Subject'];
		$incident->CustomFields->c->coachcustomernumber=$formData['Incident_CustomFields_c_coachcustomernumber'];
		$incident->CustomFields->c->ccf_cancel_all_enrollments=$formData['Incident_CustomFields_c_ccf_cancel_all_enrollments'];
		$incident->CustomFields->c->ccf_tbb_club_membership=$formData['Incident_CustomFields_c_ccf_tbb_club_membership'];
		$incident->CustomFields->c->ccf_pro_team=$formData['Incident_CustomFields_c_ccf_pro_team'];
		$incident->CustomFields->c->ccf_shakeology=$formData['Incident_CustomFields_c_ccf_shakeology'];
		//$incident->CustomFields->c->ccf_coaching_experience=$formData['Incident_CustomFields_c_ccf_coaching_experience'];
		$incident->CustomFields->c->form_routing->ID=$formData['Incident_CustomFields_c_form_routing'];
		$incident->CustomFields->c->ccf_other_continued_services=$formData['Incident_CustomFields_c_ccf_other_continued_services'];
		$incident->CustomFields->c->ccf_membership_and_enrollment=$formData['Incident_CustomFields_c_ccf_membership_and_enrollment'];
		$incident->CustomFields->c->last_four_ssn=$formData['Incident_CustomFields_c_last_four_ssn'];
		if($formData['Incident_CustomFields_c_ccf_reason_for_cancellation_sp'])
		{
			$cancellation = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\Incident", "customFields.c.ccf_reason_for_cancellation_sp"); 
				
				
				foreach($cancellation as $items)
				{
					if($items->LookupName == $formData['Incident_CustomFields_c_ccf_reason_for_cancellation_sp'])
					{
						$incident->CustomFields->c->ccf_reason_for_cancellation_sp->ID = $items->ID;
						$id=$items->ID;
					}
				}  
		
			/*if($id==673)
			{
			$flag=1;
			$incident->CustomFields->c->ccf_other_reason=$formData['Incident_CustomFields_c_ccf_other_reason'];
			}*/
		}
		
		
		//---saving life time rank--
		if($formData['Incident_CustomFields_c_life_time_rank'])
		{
			$life_time_rank = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\Incident", "customFields.c.life_time_rank"); 
				
				foreach($life_time_rank as $items)
				{
					
					if($items->ID == $formData['Incident_CustomFields_c_life_time_rank'])
					{
						$incident->CustomFields->c->life_time_rank->ID = $items->ID;
						$lifeTimeRankSpanishID=$items->ID;
					}
				}  
		
		}
		
		/*if($lifeTimeRankSpanishID==478)
		{
			$lifeTimeRankSpanish="Entrenador(a) - Diamante";
		}
		if($lifeTimeRankSpanishID==1365)
		{
			$lifeTimeRankSpanish="1 - 4 Estrellas de Diamante";
		}
		if($lifeTimeRankSpanishID==492)
		{
			$lifeTimeRankSpanish="5 Estrellas de Diamante y superior";
		}
		*/
		//-----life time rank-------
		
		/*
		*PDF Generation starts here.
		*AddPage: Adds a new page to PDF
		*Cell: Writes the content to the PDF(Parameters:width,height,CONTENT,border,ln=0,align,fill,link)
		*Image: Inserts an Image(Parameters:file,x,y,w,h,type,link)
		*SetFont: Sets the font size, family, weight etc
		*/
		/*$pdf_obj = $ci->fpdf_obj->fpdf_obj_create();
		$size=array(210,330);
		
		$y=25;
		$pdf_obj->AddPage('',$size);
		$pdf_obj->SetFont('Arial','B',16);
		$pdf_obj->Image($pic2, 15,3, 60, 12, 'jpg');
		$pdf_obj->Cell(10,$y,'');
		$pdf_obj->Cell(1,$y,$title);
		$pdf_obj->SetFont('Arial','I',9);
		$y+=20;
		$pdf_obj->Cell(-1,$y,$text_main_1,0,0,'L');
		$y+=8;
		$pdf_obj->Cell(1,$y,'',0,0,'L');
		$pdf_obj->Cell(-1,$y,$text_main_2,0,0,'L');
		$y+=8;
		$pdf_obj->Cell(1,$y,'',0,0,'L');
		$pdf_obj->Cell(20,$y,$text_main_3,0,0,'L');
		$pdf_obj->SetFont('Arial','',10);
		$y+=21;
		$pdf_obj->Cell(-20,$y,'');
		$pdf_obj->Cell(-20,$y,$required);
		
		$y+=19;
		$pdf_obj->SetFont('Arial','B',10);
		$pdf_obj->Cell(20,$y,'');
		$pdf_obj->Cell(100,$y,$coach_id_label);
		$pdf_obj->Cell(-100,$y,$email_label,0,0,'L');
		$pdf_obj->SetFont('Arial','',10);
		$y+=17;
		if($formData['Incident_CustomFields_c_coachcustomernumber'])
		{
		$pdf_obj->Cell(101,$y,utf8_decode($formData['Incident_CustomFields_c_coachcustomernumber']),0,0,'L');
		}
		else
		{
		$pdf_obj->Cell(101,$y,$no_value_label,0,0,'L');
		}
		$pdf_obj->Cell(-101,$y,utf8_decode($formData['Contact_Emails_PRIMARY_Address']),0,0,'L');
		
		
		$y+=19;
		$pdf_obj->SetFont('Arial','B',10);
		$pdf_obj->Cell(100,$y,$first_name_label,0,0,'L');
		$pdf_obj->Cell(-100,$y,$last_name_label,0,0,'L');
		$pdf_obj->SetFont('Arial','',10);*/
		//$weirdword = "Dï¿½as, Miï¿½rcoles, Sï¿½bado,miï¿½rcoles"; //Some spanish days
//		$word = ;
//		$new_word=utf8_decode($word);//urldecode($word);
		//
		/*$y+=17;
		$pdf_obj->Cell(101,$y,utf8_decode($formData['Incident_CustomFields_c_ccf_first_name']),0,0,'L');
		$pdf_obj->Cell(-101,$y,utf8_decode($formData['Incident_CustomFields_c_ccf_last_name']),0,0,'L');
		
		$y+=19;
		$pdf_obj->SetFont('Arial','B',10);
		$pdf_obj->Cell(1,$y,$business_name_label,0,0,'L');
		$pdf_obj->SetFont('Arial','',10);
		$y+=15;
		if($formData['Incident_CustomFields_c_ccf_business_name'])
		{
		$pdf_obj->Cell(20,$y,utf8_decode($formData['Incident_CustomFields_c_ccf_business_name']),0,0,'L');
		}
		else
		{
		$pdf_obj->Cell(20,$y,$no_value_label,0,0,'L');
		}
		
		$y+=20;
		$pdf_obj->SetFont('Arial','B',10);
		$pdf_obj->Cell(-21,$y,'');
		$pdf_obj->Cell(-1,$y,$ssn_label_one,0,0,'L');
		$y+=15;
		$pdf_obj->Cell(1,$y,'');
		$pdf_obj->Cell(1,$y,$ssn_label_two,0,0,'L');
		
		$y+=15;
		$pdf_obj->SetFont('Arial','',10);
		if($formData['Incident_CustomFields_c_last_four_ssn'])
		{
		$pdf_obj->Cell(-1,$y,$formData['Incident_CustomFields_c_last_four_ssn'],0,0,'L');
		}
		else
		{
		$pdf_obj->Cell(-1,$y,$no_value_label,0,0,'L');
		}
		
		$pdf_obj->SetFont('Arial','B',10);
		//==========life time rank===
		$y+=20;
		$pdf_obj->Cell(1,$y,$lifeTimeRankSpanish_label,0,0,'L');
		$y+=17;
		$pdf_obj->SetFont('Arial','',10);
		$pdf_obj->Cell(-1,$y,utf8_decode($lifeTimeRankSpanish),0,0,'L');
		//==========================
		
		$y+=20;
		$pdf_obj->SetFont('Arial','B',10);
		$pdf_obj->Cell(1,$y,$phone_label,0,0,'L');
		$y+=17;
		$pdf_obj->SetFont('Arial','',10);
		$pdf_obj->Cell(1,$y,$formData['Contact_Phones_MOBILE_Number'],0,0,'L');
		
		
		$y+=19;
		$pdf_obj->Cell(-2,$y,'');
		$pdf_obj->SetFont('Arial','B',10);
		$pdf_obj->Cell(1,$y,$reason_label,0,0,'L');
		$pdf_obj->SetFont('Arial','',10);
		
		
		
		$y+=17;
		*/
		/*if($formData['Incident_CustomFields_c_ccf_reason_for_cancellation_sp'])
		{
			if($flag==1)
			{
				$other_reason=$formData['Incident_CustomFields_c_ccf_reason_for_cancellation_sp']."* : ".$formData['Incident_CustomFields_c_ccf_other_reason'];
				$pdf_obj->Cell(-1,$y,utf8_decode($other_reason),0,0,'L');
			}
			else
			{
				$pdf_obj->Cell(-1,$y,utf8_decode($formData['Incident_CustomFields_c_ccf_reason_for_cancellation_sp']),0,0,'L');
			}
		}
		else
		{
		$pdf_obj->Cell(-1,$y,$no_value_label,0,0,'L');
		}
		
		$y+=19;*/
	/*	$inc=7;
		$line_count=0;
		
		
		$y+=20;
		//203
		//COMMENTS
		$comment_y=$line_count;
	
				
	
		//$y-=5;
		$pdf_obj->SetFont('Arial','B',16);
		$pdf_obj->Cell(-2,$y,'',0,0,'L');
		$pdf_obj->Cell(1,$y,$sub_title1_label,0,0,'L');
		$pdf_obj->SetFont('Arial','I',8);
		$y+=5;
		
		
		
		$service1=$formData['Incident_CustomFields_c_ccf_cancel_all_enrollments'];
		$service2=$formData['Incident_CustomFields_c_ccf_tbb_club_membership'];
		$service3=$formData['Incident_CustomFields_c_ccf_shakeology'];
		$service4=$formData['Incident_CustomFields_c_ccf_other_continued_services'];
		$service_pro=$formData['Incident_CustomFields_c_ccf_pro_team'];
		$service5=$formData['Incident_CustomFields_c_ccf_performance_spanish'];
		$service6=$formData['Incident_CustomFields_c_ccf_shakeology_boost_spanish'];
		$service7=$formData['Incident_CustomFields_c_ccf_3_day_refresh_spanish'];
		$other_service=$formData['Incident_CustomFields_c_ccf_membership_and_enrollment'];*/
		
		/*
		* The Text for corresponding service is taken from Message Bases
		*/
		if($formData['Incident_CustomFields_c_ccf_performance_spanish'])
		{
			$performance = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\Incident", "customFields.c.ccf_performance_spanish"); 
				foreach($performance as $items)
				{
					if($items->ID == $formData['Incident_CustomFields_c_ccf_performance_spanish'])
					{
						$incident->CustomFields->c->ccf_performance_spanish->ID = $items->ID;
						$performance=$items->LookupName;
					}
				}  
		}
		
		
		if($formData['Incident_CustomFields_c_ccf_shakeology_boost_spanish'])
		{
			$shakeology_boost = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\Incident", "customFields.c.ccf_shakeology_boost_spanish"); 
				foreach($shakeology_boost as $items)
				{
					if($items->ID == $formData['Incident_CustomFields_c_ccf_shakeology_boost_spanish'])
					{
						$incident->CustomFields->c->ccf_shakeology_boost_spanish->ID = $items->ID;
						$shakeology_boost=$items->LookupName;
					}
				}  
		}
		
		
		
		if($formData['Incident_CustomFields_c_ccf_3_day_refresh_spanish'])
		{
			$refresh = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\Incident", "customFields.c.ccf_3_day_refresh_spanish"); 
				foreach($refresh as $items)
				{
					if($items->ID == $formData['Incident_CustomFields_c_ccf_3_day_refresh_spanish'])
					{
						$incident->CustomFields->c->ccf_3_day_refresh_spanish->ID = $items->ID;
						$refresh=$items->LookupName;
					}
				}  
		}
		
		
		
	/*	
		if($performance)
		{
		$performance_label ="Beachbody Performance*:  ".$performance;
		}
		else
		{
		$performance_label ="Beachbody Performance";
		}
		
		if($shakeology_boost)
		{
		$shakeology_boost_label ="Shakeology Boost*:  ".$shakeology_boost;
		}
		else
		{
		$shakeology_boost_label ="Shakeology Boost";
		}
		
		if($refresh)
		{
		$refresh_label = "3 Day Refresh*:  ".$refresh; 
		}
		else
		{
		$refresh_label = "3 Day Refresh";
		}
		
		$service_enroll=\RightNow\Utils\Config::getMessage(CUSTOM_MSG_CCF_CANCEL_ALL_ENROLLMENTS_SPANISH);
		$service_tbb=\RightNow\Utils\Config::getMessage(CUSTOM_MSG_TBB_CLUB_MEMBERSHIP_SPANISH);
		$service_tbb=str_replace("</br>","     ",$service_tbb);
		$service_shakeology=\RightNow\Utils\Config::getMessage(CUSTOM_MSG_CCF_SHAKEOLOGY_SPANISH);
		$service_pro_label = "Pro Team";
		if($other_service)
		{
			$service_other="Otros* : ".$other_service;
		}
		else
		{
			$service_other="Otros";
		}
		$y+=27;
		$y_checkbox1=$y-193;
		$y_checkbox2=$y-185;
		$y_checkbox3=$y-178;
		
		$y_checkbox_per=$y-171;
		$y_checkbox_shk =$y-163;
		$y_checkbox_refresh=$y-156;
		
		$y_checkbox_pro=$y-148;
		
		$y_checkbox4=$y-141;
		        
		$y-=3;
		$y_line_1=$y-224;
		$y_line_2=$y-101;
		
		$pdf_obj->SetDrawColor(0,71,179);//51,102,200
		$pdf_obj->Line(25,$y_line_1,190,$y_line_1);
		
		
		$pdf_obj->SetFont('Arial','B',10);
		$pdf_obj->Cell(70,$y,$continued_service_label_1,0,0,'L');
		$pdf_obj->SetFont('Arial','BU',10);
		$pdf_obj->Cell('-68',$y,$continued_service_label_2,0,0,'L');
		$pdf_obj->SetFont('Arial','',9);
		
		
		
		
		
		
		$counter=0;
		$y+=18;
		$inc=15;
		
		if($service1)
		{
			$pdf_obj->Image($pic5, 22,$y_checkbox1, 3, 3, 'jpg');
		}
		else
		{
			$pdf_obj->Image($pic4, 22,$y_checkbox1, 3, 3, 'jpg');
		}
		
		$pdf_obj->Cell(5,$y,'',0,0,'L');
		$pdf_obj->Cell(-1,$y,utf8_decode($service_enroll),0,0,'L');
		$y+=$inc;
		$counter++;
		
		
		if($service2)
		{
			$pdf_obj->Image($pic5, 22,$y_checkbox2, 3, 3, 'jpg');
		}
		else
		{
			$pdf_obj->Image($pic4, 22,$y_checkbox2, 3, 3, 'jpg');
		}
		
		$pdf_obj->Cell(1,$y,'',0,0,'L');
		$pdf_obj->Cell(-1,$y,utf8_decode($service_tbb),0,0,'L');
		$y+=$inc;
		$counter++;
		
		if($service3)
		{
			$pdf_obj->Image($pic5, 22,$y_checkbox3, 3, 3, 'jpg');
		}
		else
		{
			$pdf_obj->Image($pic4, 22,$y_checkbox3, 3, 3, 'jpg');
		}
		
		$pdf_obj->Cell(1,$y,'',0,0,'L');
		$pdf_obj->Cell(-1,$y,utf8_decode($service_shakeology),0,0,'L');
		$y+=$inc;
		$counter++;
		
		if($service5)
		{
			$pdf_obj->Image($pic5, 22,$y_checkbox_per, 3, 3, 'jpg');
		}
		else
		{
			$pdf_obj->Image($pic4, 22,$y_checkbox_per, 3, 3, 'jpg');
		}
		
		$pdf_obj->Cell(1,$y,'',0,0,'L');
		$pdf_obj->Cell(-1,$y,utf8_decode($performance_label),0,0,'L');
		$y+=$inc;
		$counter++;
		
		if($service6)
		{
			$pdf_obj->Image($pic5, 22,$y_checkbox_shk, 3, 3, 'jpg');
		}
		else
		{
			$pdf_obj->Image($pic4, 22,$y_checkbox_shk, 3, 3, 'jpg');
		}
		
		$pdf_obj->Cell(1,$y,'',0,0,'L');
		$pdf_obj->Cell(-1,$y,utf8_decode($shakeology_boost_label),0,0,'L');
		$y+=$inc;
		$counter++;
		
		
		if($service7)
		{
			$pdf_obj->Image($pic5, 22,$y_checkbox_refresh, 3, 3, 'jpg');
		}
		else
		{
			$pdf_obj->Image($pic4, 22,$y_checkbox_refresh, 3, 3, 'jpg');
		}
		
		$pdf_obj->Cell(1,$y,'',0,0,'L');
		$pdf_obj->Cell(-1,$y,utf8_decode($refresh_label),0,0,'L');
		$y+=$inc;
		$counter++;
		
		if($service_pro)
		{
			$pdf_obj->Image($pic5, 22,$y_checkbox_pro, 3, 3, 'jpg');
		}
		else
		{
			$pdf_obj->Image($pic4, 22,$y_checkbox_pro, 3, 3, 'jpg');
		}
		if($service4)
		{
			$pdf_obj->Image($pic5, 22,$y_checkbox4, 3, 3, 'jpg');
		}
		else
		{
			$pdf_obj->Image($pic4, 22,$y_checkbox4, 3, 3, 'jpg');
		}
		$pdf_obj->Cell(1,$y,'',0,0,'L');
		$pdf_obj->Cell(-1,$y,utf8_decode($service_pro_label),0,0,'L');
		$y+=$inc;
		$pdf_obj->Cell(1,$y,'',0,0,'L');
		$pdf_obj->Cell(-8,$y,utf8_decode($service_other),0,0,'L');
		$y+=20;
		$counter++;
		$pdf_obj->SetFont('Arial','I',8);
		$pdf_obj->Cell(-1,$y,$text_1,0,0,'L');
		$y+=15;
		$pdf_obj->Cell(1,$y,'',0,0,'L');
		$pdf_obj->Cell(-1,$y,$text_2,0,0,'L');
		$y+=8;
		$pdf_obj->Cell(1,$y,'',0,0,'L');
		$pdf_obj->Cell(-1,$y,$text_3_a,0,0,'L');
		$y+=8;
		$pdf_obj->Cell(1,$y,'',0,0,'L');
		$pdf_obj->Cell(-1,$y,$text_3_b,0,0,'L');
		
		
		$pdf_obj->SetDrawColor(0,71,179);//51,102,200
		
		$y+=25;
		
		$pdf_obj->Line(25,$y_line_2,190,$y_line_2);
		
		
		
		
		
		
		
		
		$pdf_obj->AddPage('',$size);
		
		$y=10;
		
		$pdf_obj->SetFont('Arial','B',16);
		$pdf_obj->Cell(12,$y,'',0,0,'L');
		$pdf_obj->Cell(1,$y,$sub_title2_label,0,0,'L');
		$pdf_obj->SetFont('Arial','I',9);
		$y+=18;
		$pdf_obj->Cell(-1,$y,$text_4,0,0,'L');
		$y+=18;
		$pdf_obj->SetFont('Arial','B',10);
		$pdf_obj->Cell(1,$y,'',0,0,'L');
		$pdf_obj->Cell(2,$y,$sign_submit_label,0,0,'L');
		$pdf_obj->SetFont('Arial','',10);
		$y+=24;
		
		$pdf_obj->SetFont('Arial','B',24);
	
		$y_checkbox=43.5;
		$pdf_obj->SetFont('Arial','',10);
		$pdf_obj->Cell(5,$y,'',0,0,'L');
		$pdf_obj->Image($pic5, 24,$y_checkbox, 3, 3, 'jpg');
		$pdf_obj->Cell(1,$y,$submit_condition_1_a,0,0,'L');
		$y+=12;
		$pdf_obj->Cell(-1,$y,'',0,0,'L');
		$pdf_obj->Cell(1,$y,$submit_condition_1_b,0,0,'L');
		$y+=16;
		$pdf_obj->SetFont('Arial','B',24);
	
		$y_checkbox+=14;
		$pdf_obj->SetFont('Arial','',10);
	
		$pdf_obj->Image($pic5, 24,$y_checkbox, 3, 3, 'jpg');
		$pdf_obj->Cell(-1,$y,'',0,0,'L');
		$pdf_obj->Cell(1,$y,$submit_condition_2_a,0,0,'L');
		$y+=12;
		$pdf_obj->Cell(-1,$y,'',0,0,'L');
		$pdf_obj->Cell(1,$y,$submit_condition_2_b,0,0,'L');
		$y+=16;
		$pdf_obj->SetFont('Arial','B',24);
	
		$y_checkbox+=14;
		$pdf_obj->SetFont('Arial','',10);
		$pdf_obj->Image($pic5, 24,$y_checkbox, 3, 3, 'jpg');
		$pdf_obj->Cell(-1,$y,'',0,0,'L');
		$pdf_obj->Cell(1,$y,$submit_condition_3,0,0,'L');
		$y+=16;
		$pdf_obj->SetFont('Arial','B',24);
		
		$y_checkbox+=8;
		$pdf_obj->SetFont('Arial','',10);
		$pdf_obj->Cell(-1,$y,'',0,0,'L');
		$pdf_obj->Image($pic5, 24,$y_checkbox, 3, 3, 'jpg');
		$pdf_obj->Cell(1,$y,$submit_condition_4,0,0,'L');
		$y+=16;
		$pdf_obj->SetFont('Arial','B',24);
		
		$y_checkbox+=8;
		$pdf_obj->SetFont('Arial','',10);
		$pdf_obj->Cell(-2,$y,'',0,0,'L');
		$pdf_obj->Image($pic5, 24,$y_checkbox, 3, 3, 'jpg');
		$pdf_obj->Cell(1,$y,$submit_condition_5_a,0,0,'L');
		$y+=12;
		$pdf_obj->Cell(1,$y,$submit_condition_5_b,0,0,'L');
		$y+=16;
		$y_checkbox+=13.5;
		$pdf_obj->Cell(-2,$y,'',0,0,'L');
		$pdf_obj->Image($pic5, 24,$y_checkbox, 3, 3, 'jpg');
		$pdf_obj->Cell(1,$y,$submit_condition_6_a,0,0,'L');
		$y+=12;
		$pdf_obj->Cell(-1,$y,$submit_condition_6_b,0,0,'L');
		$y+=12;
		$pdf_obj->Cell(1,$y,'',0,0,'L');
		$pdf_obj->Cell(-1,$y,$submit_condition_6_c,0,0,'L');
		$y+=12;
		$pdf_obj->Cell(1,$y,'',0,0,'L');
		$pdf_obj->Cell(1,$y,$submit_condition_6_d,0,0,'L');
		$y+=25;
		$pdf_obj->Cell(-8,$y,'',0,0,'L');
		$pdf_obj->SetFont('Arial','B',10);*/
		//$pdf_obj->Cell(75,$y,$signature_label,0,0,'L');
		/*$pdf_obj->Cell(50,$y,$date_label,0,0,'L');
		$pdf_obj->Cell(-50,$y,$time_label,0,0,'L');*/
		
	
		/*$pdf_obj->Image($sign,25,141, 60, 20, 'jpg');
		//$y+=12;
		
		
		$pdf_obj->SetFont('Arial','I',8);
		$y+=18;*/
		/*$pdf_obj->Cell(1,$y,$signature_label,0,0,'L');
		$y+=18;
		$pdf_obj->SetFont('Arial','B',10);
		//$pdf_obj->Image($sign,20,110, 60, 16, 'jpg');
		$pdf_obj->Cell(-1,$y,$sign,0,0,'L');	
			
		$pdf_obj->SetFont('Arial','I',9);
		$y+=20;

		$pdf_obj->Cell(1,$y,$text_5_a,0,0,'L');
		$y+=10;
		$pdf_obj->Cell(-1,$y,'',0,0,'L');
		$pdf_obj->Cell(-2,$y,$text_5_b,0,0,'L');
		/*$y+=8;
		$pdf_obj->Cell(-1,$y,'',0,0,'L');
		$pdf_obj->Cell(-75,$y,$text_5_c,0,0,'L');
		$y+=43;
		$pdf_obj->SetFont('Arial','B',10);
		$pdf_obj->Cell(3,$y,'',0,0,'L');
		$pdf_obj->Cell(25,$y,$text_6,0,0,'L');
		$pdf_obj->SetFont('Arial','',9);
		$pdf_obj->Cell(-25,$y,$text_7_a,0,0,'L');
		$y+=10;
		$pdf_obj->Cell(-1,$y,$text_7_b,0,0,'L');*/
		
	/*$pdf_obj->Output(); // remove the comment for these two lines inorder to view the generated PDF without creating an incident
		exit;
		*/
		/*
		*Saves the Incident and Reference # is returned
		*/
		
		AbuseDetection::check();
		$res=$incident->save();
		
		/*
		* Gets the Incident ID and updates the incident by attaching the pdf with Incident ID on it
		*/
		
		$refno = $incident->ReferenceNumber;
		$inc_id=$incident->ID;
		/*$incident = RNCPHP\Incident::fetch($inc_id);

		
		$pdf_obj->SetFont('courier','',10);
		$y+=32;
		
		$date_time=$date." ".$time.utf8_decode(" Hora del Pacífico; ");
		$pdf_obj->Cell(1,$y,'',0,0,'L');
		$pdf_obj->Cell(1,$y,'Presentada',0,0,'L');
		$pdf_obj->Cell(23,$y,'',0,0,'L');
		$pdf_obj->Cell(5,$y,$date_time,0,0,'L');
		
		$pdf_obj->Cell(77,$y,'',0,0,'L');
		$pdf_obj->Cell(1,$y,'Incident Reference # ',0,0,'L');
		$pdf_obj->Cell(44,$y,'',0,0,'L');
		$pdf_obj->Cell(5,$y,$refno,0,0,'L');
		*/
		
		/*$pdf_obj->AddPage();
		$pdf_obj->SetFont('Arial','B',16);
		$pdf_obj->Image($pic2, 15,3, 60, 12, 'jpg');
		$pdf_obj->Cell(10,21,'');
		$pdf_obj->Cell(20,21,$title);
		$pdf_obj->SetFont('Arial','',10);
		$pdf_obj->Cell(-20,35,'');
		$pdf_obj->Cell(-20,35,$required);*/
		
		
		
		/*$pdf_str=$pdf_obj->Output('S');
		
		$current_date=date("m/d/Y");
		$current_time=date("G:i:s");
		
		$folder="/tmp/";
		$fname="DS3_".$date.".pdf";
		$filename = $folder.$fname;
		$fp= fopen($filename, "w");
		$str=$pdf_str;
		fputs($fp,$str);
		fclose($fp);
		
		$incident->FileAttachments =new RNCPHP\FileAttachmentIncidentArray();
		$fattach = new RNCPHP\FileAttachmentIncident();
		$fattach->ContentType = "application/pdf";
		
		$fp = $fattach->makeFile();
		$fattach->Data=$fname;
		$date = date("m-d-Y"); 
		$fattach->FileName = "TBB Coach Cxl Form_".$date.".pdf";
		$incident->FileAttachments[] = $fattach;
		AbuseDetection::check();
		$res=$incident->save();
		*/
		if($res)
		{
			return $refno;
		}
		
		
	}
	
	
	
	
	
	
	}
	
	
	
} 
<?php /* Originating Release: February 2013 */

namespace Custom\Models;

$CI = get_instance();

$CI->model('Incident');
$CI->load->library('fpdf_obj');
require_once( get_cfg_var("doc_root")."/ConnectPHP/Connect_init.php");
$ip_dbreq = true;


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
	
	
	/*$ci->load->library("fpdf_obj");*/
	
	$sign=$formData['signatureText'];//$encoded_data;
	
	
	/*$filename3 = "/vhosts/uk_english/euf/assets/images/team_beachbody_logo.jpg";
	$fp3= fopen($filename3, "r");
	$test=file_get_contents($filename3);
	$tbb_logo="data:image/jpeg;base64,".base64_encode($test);
	
	
	
	$filename4 = "/vhosts/uk_english/euf/assets/images/checkbox_unchecked.jpg";
	$fp4= fopen($filename4, "r");
	$content=file_get_contents($filename4);
	$pic4="data:image/jpeg;base64,".base64_encode($content);
	
	$filename5 = "/vhosts/uk_english/euf/assets/images/checkbox_checked.jpg";
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
		/*$info = getimagesize($tbb_logo);*/
		$date = date("m-d-Y"); 
		$time= date("G:i:s");
		/*$link="Contact-Us Link";
		$title="Independent Coach Cancellation Form (UK)";
		$text_main_1="This form allows you to permanently cancel your Team Beachbody Coach accounts and any other memberships or ";
		$text_main_2="subscriptions in which you may have enrolled. Please fill out all required information accurately. Your cancellation";
		$text_main_3="may be delayed if we receive incorrect information. ";
		$required="*Required";
		$coach_id_label="Coach ID";
		$email_label="Email*";
		$first_name_label="First Name*";
		$last_name_label="Last Name*";
		$business_name_label="Business Name(If Applicable)";
		$ssn_label="Last 4 digits of Credit Card on file for BSF Fees*";
		
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
		$text_2="";
		
		$performance_label="Monthly Beachbody Performance";
		$shakeology_boost_label="Shakeology Boost";
		$refresh_label="3 Day Refresh";
		$text_3="   10% off on future orders. If you keep your Beachbody On Demand membership, you will get 10% off the prices listed.";
		$text_3="";
		
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
		
		
		/*$comment=$formData['Incident_CustomFields_c_ccf_coaching_experience'];
		$comment1=substr($comment,0,104);
		$comment2=substr($comment,104,104);
		$comment3=substr($comment,208,104);
		$comment4=substr($comment,312,104);
		$comment5=substr($comment,416,104);
		$comment6=substr($comment,520,104);
		$comment7=substr($comment,624,104);
		$comment8=substr($comment,728,104);
		$comment9=substr($comment,832,104);
		$comment10=substr($comment,936,104);
		$comment11=substr($comment,1040,104);
		$comment12=substr($comment,1144,104);
		$comment13=substr($comment,1248,52);*/
		 
		
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
		//$incident->CustomFields->c->last_four_ssn=$formData['Incident_CustomFields_c_last_four_ssn'];
		
		$incident->CustomFields->c->last_four_cc=$formData['Incident_CustomFields_c_last_four_cc'];
		
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
		/*if($lifeTimeRankID==478)
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
		}*/
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
		$pdf_obj->Image($tbb_logo, 15,3, 60, 12, 'jpg');
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
		$pdf_obj->Cell(90,$y,$ssn_label,0,0,'L');
		$pdf_obj->Cell(1,$y,$phone_label,0,0,'L');
		$y+=16;
		$pdf_obj->SetFont('Arial','',10);
		$pdf_obj->Cell(-90,$y,$formData['Contact_Phones_MOBILE_Number'],0,0,'L');*/
		
		/*if($formData['Incident_CustomFields_c_last_four_ssn'])
		{
		$pdf_obj->Cell(-1,$y,$formData['Incident_CustomFields_c_last_four_ssn'],0,0,'L');
		}
		*/
		/*if($formData['Incident_CustomFields_c_last_four_cc'])
		{
		$pdf_obj->Cell(-1,$y,$formData['Incident_CustomFields_c_last_four_cc'],0,0,'L');
		}
		else
		{
		$pdf_obj->Cell(-1,$y,$no_value_label,0,0,'L');
		}
		
		
		//-----life time rank-----
		$y+=16;
		$pdf_obj->SetFont('Arial','B',10);
		$pdf_obj->Cell(1,$y,$life_time_rank_label,0,0,'L');
		$y+=16;
		$pdf_obj->SetFont('Arial','',10);
		$pdf_obj->Cell(-1,$y,$lifeTimeRank,0,0,'L');
		//------------------------
		
		
		
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
		$y+=15;
		
		$pdf_obj->SetFont('Arial','',7);
		$y+=15;
		
		$inc=7;
		
		$pdf_obj->SetDrawColor(0,71,179);//51,102,200
		
		$y+=30;
		$y_line=$y-175;
		
		
		
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
		$other_service=$formData['Incident_CustomFields_c_ccf_membership_and_enrollment'];
		
		$service5=$formData['Incident_CustomFields_c_ccf_pro_team'];
		*/
		
		/*
		* The Text for corresponding service is taken from Message Bases
		*/
		
		
		/*$service_enroll=\RightNow\Utils\Config::getMessage(CUSTOM_MSG_CANCEL_ALL_ENROLLMENTS);
		$service_tbb=\RightNow\Utils\Config::getMessage(CUSTOM_MSG_TBB_CLUB_MEMBERSHIP);
		$service_tbb = str_replace('</br>','    ',$service_tbb);
		$service_shakeology=\RightNow\Utils\Config::getMessage(CUSTOM_MSG_SHAKEOLOGY);
		
		$service_pro=" Pro Team";
		
		if($other_service)
		{
			$service_other=" Other*:  ".$other_service;
		}
		else
		{
			$service_other=" Other";
		}
		
		
	 $y-=30;
			
		///CHK	
			
		if(($comment_y==1)||($comment_y==0))
		{
			$y_checkbox1=$y-124;
			$y_checkbox2=$y-117;
			$y_checkbox3=$y-109;
			$y_checkbox_per=$y-102;
			
			$y_checkbox_shk =$y-94;
			$y_checkbox_refresh=$y-90;
			$y_checkbox4=$y-86;
			
			$y_checkbox_pro=$y-94;
			
			$y_checkbox5=$y-41;
			$y_checkbox6=$y-35;
			$y_checkbox7=$y-29;
			$y_checkbox8=$y-23;
			$y_checkbox9=$y-17;
		}
		else if($comment_y==2)
		{
			$y_checkbox1=$y-111;
			$y_checkbox2=$y-104;
			$y_checkbox3=$y-96;
			$y_checkbox_per=$y-89;
			$y_checkbox_shk =$y-81;
			$y_checkbox_refresh=$y-74;
			$y_checkbox4=$y-66;
			
			
			
			
			$y_checkbox5=$y-46;
			$y_checkbox6=$y-40;
			$y_checkbox7=$y-34;
			$y_checkbox8=$y-28;
			$y_checkbox9=$y-22;
		}
		else if($comment_y==3)
		{
			$y_checkbox1=$y-115;
			$y_checkbox2=$y-108;
			$y_checkbox3=$y-100;
			$y_checkbox_per=$y-93;
			$y_checkbox_shk =$y-85;
			$y_checkbox_refresh=$y-77;
			$y_checkbox4=$y-70;
			
			$y_checkbox5=$y-48;
			$y_checkbox6=$y-42;
			$y_checkbox7=$y-36;
			$y_checkbox8=$y-30;
			$y_checkbox9=$y-24;
		}
		else if($comment_y==4)
		{
			$y_checkbox1=$y-118;
			$y_checkbox2=$y-111;
			$y_checkbox3=$y-103;
			$y_checkbox_per=$y-96;
			$y_checkbox_shk =$y-88;
			$y_checkbox_refresh=$y-80;
			$y_checkbox4=$y-73;
			$y_checkbox5=$y-51;
			$y_checkbox6=$y-45;
			$y_checkbox7=$y-39;
			$y_checkbox8=$y-33;
			$y_checkbox9=$y-27;
		}
		else if($comment_y==5)
		{
			$y_checkbox1=$y-122;
			$y_checkbox2=$y-115;
			$y_checkbox3=$y-107;
			$y_checkbox_per=$y-100;
			$y_checkbox_shk =$y-92;
			$y_checkbox_refresh=$y-84;
			$y_checkbox4=$y-77;
			$y_checkbox5=$y-55;
			$y_checkbox6=$y-49;
			$y_checkbox7=$y-43;
			$y_checkbox8=$y-37;
			$y_checkbox9=$y-31;
		}
		else if($comment_y==6)
		{
			$y_checkbox1=$y-126;
			$y_checkbox2=$y-119;
			$y_checkbox3=$y-111;
			$y_checkbox_per=$y-104;
			$y_checkbox_shk =$y-95;
			$y_checkbox_refresh=$y-88;
			$y_checkbox4=$y-81;
			$y_checkbox5=$y-59;
			$y_checkbox6=$y-53;
			$y_checkbox7=$y-47;
			$y_checkbox8=$y-41;
			$y_checkbox9=$y-35;
		}
		else if($comment_y==7)
		{
			$y_checkbox1=$y-129;
			$y_checkbox2=$y-122;
			$y_checkbox3=$y-114;
			$y_checkbox_per=$y-107;
			$y_checkbox_shk =$y-99;
			$y_checkbox_refresh=$y-91;
			$y_checkbox4=$y-84;
			$y_checkbox5=$y-62;
			$y_checkbox6=$y-56;
			$y_checkbox7=$y-50;
			$y_checkbox8=$y-44;
			$y_checkbox9=$y-38;
		}
		else if($comment_y==8)
		{
			$y_checkbox1=$y-133;
			$y_checkbox2=$y-126;
			$y_checkbox3=$y-118;
			$y_checkbox_per=$y-110;
			$y_checkbox_shk =$y-102;
			$y_checkbox_refresh=$y-95;
			$y_checkbox4=$y-87;
			$y_checkbox5=$y-65;
			$y_checkbox6=$y-59;
			$y_checkbox7=$y-53;
			$y_checkbox8=$y-47;
			$y_checkbox9=$y-41;
		}
		else if($comment_y==9)
		{
			$y_checkbox1=$y-136;
			$y_checkbox2=$y-129;
			$y_checkbox3=$y-121;
			$y_checkbox_per=$y-114;
			$y_checkbox_shk =$y-106;
			$y_checkbox_refresh=$y-98;
			$y_checkbox4=$y-91;
			$y_checkbox5=$y-69;
			$y_checkbox6=$y-63;
			$y_checkbox7=$y-57;
			$y_checkbox8=$y-51;
			$y_checkbox9=$y-45;
		}
		else if($comment_y==10)
		{
			$y_checkbox1=$y-140;
			$y_checkbox2=$y-133;
			$y_checkbox3=$y-125;
			$y_checkbox_per=$y-117;
			$y_checkbox_shk =$y-109;
			$y_checkbox_refresh=$y-101;
			$y_checkbox4=$y-94;
			$y_checkbox5=$y-73;
			$y_checkbox6=$y-67;
			$y_checkbox7=$y-61;
			$y_checkbox8=$y-55;
			$y_checkbox9=$y-49;
		}
		else if($comment_y==11)
		{
			$y_checkbox1=$y-143;
			$y_checkbox2=$y-137;
			$y_checkbox3=$y-129;
			$y_checkbox_per=$y-121;
			$y_checkbox_shk =$y-113;
			$y_checkbox_refresh=$y-105;
			$y_checkbox4=$y-98;
			$y_checkbox5=$y-76;
			$y_checkbox6=$y-70;
			$y_checkbox7=$y-64;
			$y_checkbox8=$y-58;
			$y_checkbox9=$y-52;
		}
		else if($comment_y==12)
		{
			$y_checkbox1=$y-147;
			$y_checkbox2=$y-140;
			$y_checkbox3=$y-132;
			$y_checkbox_per=$y-124;
			$y_checkbox_shk =$y-116;
			$y_checkbox_refresh=$y-109;
			$y_checkbox4=$y-101;
			$y_checkbox5=$y-80;
			$y_checkbox6=$y-74;
			$y_checkbox7=$y-68;
			$y_checkbox8=$y-62;
			$y_checkbox9=$y-56;
		}
		else if($comment_y==13)
		{
			$y_checkbox1=$y-150;
			$y_checkbox2=$y-143;
			$y_checkbox3=$y-135;
			$y_checkbox_per=$y-128;
			$y_checkbox_shk =$y-120;
			$y_checkbox_refresh=$y-112;
			$y_checkbox4=$y-105;
			$y_checkbox5=$y-83;
			$y_checkbox6=$y-77;
			$y_checkbox7=$y-71;
			$y_checkbox8=$y-65;
			$y_checkbox9=$y-59;
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
			$pdf_obj->Image($pic5, 22,$y_checkbox1, 3, 3, 'jpg');
		}
		else
		{
			$pdf_obj->Image($pic4, 22,$y_checkbox1, 3, 3, 'jpg');
		}
		
		$pdf_obj->Cell(5,$y,'',0,0,'L');
		$pdf_obj->Cell(-1,$y,$service_enroll,0,0,'L');
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
		$pdf_obj->Cell(-1,$y,$service_tbb,0,0,'L');
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
		$pdf_obj->Cell(-1,$y,$service_shakeology,0,0,'L');
		$y+=$inc;
		$counter++;
		
		if($service5)
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
		
		     
		
		
		$counter++;
		$pdf_obj->Cell(-5,$y,'',0,0,'L');
		*/
		
		if($formData['Incident_CustomFields_c_ccf_performance_uk'])
		{
			$performance = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\Incident", "customFields.c.ccf_performance_uk"); 
				foreach($performance as $items)
				{
					if($items->ID == $formData['Incident_CustomFields_c_ccf_performance_uk'])
					{
						$incident->CustomFields->c->ccf_performance_uk->ID = $items->ID;
						$performance=$items->LookupName;
					}
				}  
		}
		
		/*
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
		
		*/
		
		
		/*if($performance)
		{
		$performance_label ="Monthly Beachbody Performance*:  ".$performance;
		}*/
		/*
		if($shakeology_boost)
		{
		$shakeology_boost_label ="Shakeology Boost*:  ".$shakeology_boost;
		}
		if($refresh)
		{
		$refresh_label = "3 Day Refresh*:  ".$refresh; 
		}
		*/
		
		
	/*	$y+=1;
		$pdf_obj->SetFont('Arial','',9);
		$pdf_obj->Cell(6,$y,'',0,0,'L');
		if($performance)
		{
		$pdf_obj->Image($pic5, 22,$y_checkbox_per, 3, 3, 'jpg');
		$pdf_obj->Cell(1,$y,$performance_label,0,0,'L');
		}
		else
		{
		$pdf_obj->Image($pic4, 22,$y_checkbox_per, 3, 3, 'jpg');
		$pdf_obj->Cell(1,$y,$performance_label,0,0,'L');
		}
		
		
		$y+=15;
		$pdf_obj->SetFont('Arial','',9);
		$pdf_obj->Cell(-1,$y,'',0,0,'L');
		*/
		/*if($shakeology_boost)
		{
		$pdf_obj->Image($pic5, 22,$y_checkbox_shk, 3, 3, 'jpg');
		$pdf_obj->Cell(1.5,$y,$shakeology_boost_label,0,0,'L');
		}
		else
		{
		$pdf_obj->Image($pic4, 22,$y_checkbox_shk, 3, 3, 'jpg');
		$pdf_obj->Cell(1.5,$y,$shakeology_boost_label,0,0,'L');
		}
		*/
		
		
		//$y+=15;
		//$pdf_obj->SetFont('Arial','',9);
		//$pdf_obj->Cell(-1,$y,'',0,0,'L');
		
		/*if($refresh)
		{
		$pdf_obj->Image($pic5, 22,$y_checkbox_refresh, 3, 3, 'jpg');
		$pdf_obj->Cell(1,$y,$refresh_label,0,0,'L');
		}
		else
		{
		$pdf_obj->Image($pic4, 22,$y_checkbox_refresh, 3, 3, 'jpg');
		$pdf_obj->Cell(1,$y,$refresh_label,0,0,'L');
		}
		*/
		
		//$y+=$inc;
		
		/*$pdf_obj->Cell(-1,$y,'',0,0,'L');
		$pdf_obj->Cell(1,$y,$service_pro,0,0,'L');
		$y+=$inc;
		
		
		$pdf_obj->Cell(-1,$y,'',0,0,'L');
		$pdf_obj->Cell(-1,$y,$service_other,0,0,'L');
		
		
		
		
		
		
		$y+=20;
		$pdf_obj->SetFont('Arial','I',8);
		
		$pdf_obj->Cell(-3,$y,'',0,0,'L');
		$pdf_obj->Cell(-1,$y,'*Prices do not include postage & package, and tax.',0,0,'L');
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
		
		$y+=25;
		//203
		//TOCC
		$comment_y=$line_count;
		if(($comment_y==1)||($comment_y==0))
		{
			$y_line=$y-245;
		}
		else if($comment_y==2)
		{
			$y_line=$y-252;
		}
		else if($comment_y==3)
		{
			$y_line=$y-259;
		}
		else if($comment_y==4)
		{
			$y_line=$y-260;
		}
		else if($comment_y==5)
		{
			$y_line=$y-250;
		}
		else if($comment_y==6)
		{
			$y_line=$y-267;
		}
		else if($comment_y==7)
		{
			$y_line=$y-270;
		}
		else if($comment_y==8)
		{
			$y_line=$y-265;
		}
		else if($comment_y==9)
		{
			$y_line=$y-260;
		}
		else if($comment_y==10)
		{
			$y_line=$y-276;
		}
		else if($comment_y==11)
		{
			$y_line=$y-282;
		}
		else if($comment_y==12)
		{*/
			/*$y_line=$y-300;*/
			/*$y_line=$y-287;
		}
		else if($comment_y==13)
		{
			//$y_line=$y-305;
			$y_line=$y-292;
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
		else if($comment_y==2)
		{
		
				$y_img+=$comment_y-10;
	
		}
		else if($comment_y==3)
		{
		$y_img+=$comment_y-15;
		}
		else if($comment_y==4)
		{
				$y_img+=$comment_y-20;
		}
		else if($comment_y==5)
		{
			
				$y_img+=$comment_y-27;	
		
		}
		else if($comment_y==6)
		{
				$y_img+=$comment_y-28;
		}
		else if($comment_y==7)
		{
				$y_img+=$comment_y-33;		
				
		}
		else if($comment_y==8)
		{
			
				$y_img+=$comment_y-37;
		}
		else if($comment_y==9)
		{
				$y_img+=$comment_y-42;	
		
		}
		else if($comment_y==10)
		{
				$y_img+=$comment_y-46;
		}
		else if($comment_y==11)
		{
		$y_img+=$comment_y-51;
		}
		else if($comment_y==12)
		{
				$y_img+=$comment_y-56;
		}
		else if($comment_y==13)
		{
		$y_img+=$comment_y-61;
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
		$pdf_obj->Image($pic5, 20,$y_check_box, 3, 3, 'jpg');
		$pdf_obj->Cell(1,$y,$submit_condition_1,0,0,'L');
		$y_check_box+=0.5;
		$y+=12;
		$pdf_obj->SetFont('Arial','B',24);
	
		$pdf_obj->SetFont('Arial','',10);
		$pdf_obj->Cell(-1,$y,'',0,0,'L');
		$y_check_box+=6;
		$pdf_obj->Image($pic5, 20,$y_check_box, 3, 3, 'jpg');
		$pdf_obj->Cell(1,$y,$submit_condition_2_a,0,0,'L');
		$y+=12;
		$pdf_obj->Cell(1,$y,$submit_condition_2_b,0,0,'L');
		$y+=12;
		$pdf_obj->SetFont('Arial','B',24);
		
		
		$pdf_obj->SetFont('Arial','',10);
		$pdf_obj->Cell(-2,$y,'',0,0,'L');
		$y_check_box+=11;
		$pdf_obj->Image($pic5, 20,$y_check_box, 3, 3, 'jpg');
		$pdf_obj->Cell(1,$y,$submit_condition_3,0,0,'L');
		$y+=12;
		$pdf_obj->SetFont('Arial','B',24);
	
	
		$pdf_obj->SetFont('Arial','',10);
		$pdf_obj->Cell(-1,$y,'',0,0,'L');
		$y_check_box+=7;
		$pdf_obj->Image($pic5, 20,$y_check_box, 3, 3, 'jpg');
		$pdf_obj->Cell(1,$y,$submit_condition_4,0,0,'L');
		$y+=12;
		$pdf_obj->SetFont('Arial','B',24);
		
		
		$pdf_obj->SetFont('Arial','',10);
		$pdf_obj->Cell(-1,$y,'',0,0,'L');
		$y_check_box+=6;
		$pdf_obj->Image($pic5, 20,$y_check_box, 3, 3, 'jpg');
		$pdf_obj->Cell(1,$y,$submit_condition_5_a,0,0,'L');
		$y+=12;
		$pdf_obj->Cell(1,$y,$submit_condition_5_b,0,0,'L');
		$y+=12;
		$pdf_obj->SetFont('Arial','B',24);
		
		
		$pdf_obj->SetFont('Arial','',10);
		$pdf_obj->Cell(-1,$y,'',0,0,'L');
		$y_check_box+=11;
		$pdf_obj->Image($pic5, 20,$y_check_box, 3, 3, 'jpg');
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
		$pdf_obj->Cell(1,$y,$text_5_b,0,0,'L');*/
		/*$y+=6;
		$pdf_obj->Cell(-1,$y,'',0,0,'L');
		$pdf_obj->Cell(1,$y,$text_5_c,0,0,'L');*/
		//$y+=35;
		/*$y+=30;
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
	
	
	
	
	
} 
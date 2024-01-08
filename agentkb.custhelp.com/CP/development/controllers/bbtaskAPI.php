<?php

namespace Custom\Controllers;
// TST2
use RightNow\Libraries\AbuseDetection,
RightNow\Utils\Config,
RightNow\Utils\Framework,
RightNow\Libraries\SEO,
RightNow\Connect\v1_4 as RNCPHP,
RightNow\Connect\v1_4\ConnectAPI;
use Exception;

class bbtaskAPI extends \RightNow\Controllers\Base
{
    //This is the constructor for the custom controller. Do not modify anything within
    //this function.TST 2
    function __construct()
    {
        parent::__construct();
        try {

            $context = RNCPHP\ConnectAPI::getCurrentContext();
            $context->ApplicationContext = "Task API";
        } catch (ConnectAPIErrorFatal $e) {
            echo "**ConnectAPIErrorFatal: " . $e->getMessage() . "\n";
        } catch (ConnectAPIError $e) {
            echo "**ConnectAPIError: " . $e->getMessage() . "\n";
        } catch (Exception $e) {
            echo "**CPHP Error: " . $e->getMessage() . "\n";
        }
    }

    /*
    Function for calling skuInfo
    */
    function taskApi()
    {
        $http_origin = $_SERVER["HTTP_ORIGIN"];

        $allowed_domains = [
            "https://beachbodyopa--tst1.custhelp.com",
            "http://localhost:8080",
        ];

        if (in_array(strtolower($http_origin), $allowed_domains)) {
            //header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Origin: $http_origin");
            header("Access-Control-Allow-Credentials: true");
            header("Access-Control-Max-Age: 86400");
            header("Content-Type: application/json");
        }
        if ($_SERVER["REQUEST_METHOD"] == "OPTIONS") {
            header("Access-Control-Allow-Methods: GET");
            header("Access-Control-Allow-Headers: api-key, Origin");
            header("Content-Type: application/json");
            exit(0);
        }

        $url = $actual_link =
            (empty($_SERVER["HTTPS"]) ? "http" : "https") .
            "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url_components = parse_url($url);
        $query = $url_components["query"];
        $url_decode = strip_tags(urldecode($query));
        $url_decodes = str_replace("&quot;", '"', $url_decode);
        $data = json_decode($url_decodes, true);
        echo "<pre>";
        print_r($data);

        $ResultCount = $data["taskList"];
        $count = count($ResultCount);
        print_r("count" . $count . "\n");

        // process start

        if ($count == 1) {
            $selectedcustomer["Single"] = $data["taskList"];
            $OrderNo = $selectedcustomer["Single"]["orderNo"];
            $OrderSource = $selectedcustomer["Single"]["orderSource"];
            $CustomerName = $selectedcustomer["Single"]["customerName"];
            $CustomerEmail = $selectedcustomer["Single"]["customerEmail"];
            $TaskType = $selectedcustomer["Single"]["taskType"];
            $TaskStatus = $selectedcustomer["Single"]["taskStatus"];
            $comments = $selectedcustomer["Single"]["comments"];

            $name_parts = explode(" ", $CustomerName);
            $first_name = $name_parts[0];
            $last_name = $name_parts[1];
            print_r("OrderNo" . $OrderNo . "\n");
            print_r("CustomerName" . $CustomerName . "\n");
            print_r("first_name" . $first_name . "\n");
            print_r("last_name" . $last_name . "\n");

            if (!empty($CustomerEmail)) {
                $contact = RNCPHP\ROQL::query(
                    "select ID from Contact C where Contact.Emails.Address = '" .
                    $CustomerEmail .
                    "'"
                )
                    ->next()
                    ->next();

                $ContactID = trim($contact["ID"]);
                print_r("ContactID" . $ContactID . "\n");

                if (!empty($ContactID)) {
                    //Exsiting Contact.
                    $ContactDetails_existing = RNCPHP\Contact::fetch(
                        $ContactID
                    );
                } else {
                    $ContactDetails = new RNCPHP\Contact();
                    $ContactDetails->Emails = new RNCPHP\EmailArray();
                    $ContactDetails->Emails[0] = new RNCPHP\Email();
                    $ContactDetails->Emails[0]->AddressType = new RNCPHP\NamedIDOptList();
                    $ContactDetails->Emails[0]->AddressType->LookupName =
                        "Email - Primary";
                    $ContactDetails->Emails[0]->Address = $CustomerEmail;
                    $ContactDetails->Name->First = $first_name;
                    $ContactDetails->Name->Last = $last_name;
                    $ContactDetails->save();

                    $ContactID = $ContactDetails->ID;
                }

                $TaskDetails = new RNCPHP\Task();
                $TaskDetails->Name =
                    "Order Errors for Order Number - " . $OrderNo;
                $TaskDetails->CustomFields->c->order_number = $OrderNo;
                $TaskDetails->CustomFields->c->order_source->LookupName = $OrderSource;
                $TaskDetails->CustomFields->c->import_task_type->LookupName = $TaskType;
                //$TaskDetails->CustomFields->c->status_id->LookupName = $TaskStatus;
                $TaskDetails->CustomFields->c->order_error_message = $comments;
                $TaskDetails->Contact = RNCPHP\Contact::fetch($ContactID);
                $TaskDetails->StatusWithType = new RNCPHP\StatusWithType();
                $TaskDetails->StatusWithType->Status->LookupName =
                    "Not Started";
                $TaskDetails->save();

                $resp = "Task created successfully for Order - " . $OrderNo;
                echo json_encode($resp);
            } else {
            }
        }
        // If more than one payload
        elseif ($count > 1) {
            $multiplerecords = $data["taskList"];

            // group by group key
            foreach ($multiplerecords as $element) {
                $arraysByGroup[$element["customerEmail"]][] = $element;
            }

            foreach ($arraysByGroup as &$group) {
                $Email = [];

                foreach ($group as $key => $value) {
                    $Email[$key] = $value["customerEmail"];
                }
            }

            foreach ($arraysByGroup as $key => $value) {
                $j = 0;
                if (!empty($key)) {
                    $selectedcustomer["Multiple"][] = $value[$j];
                    $j++;
                }
            }
            $count = count($multiplerecords);

            //$count = count($selectedcustomer['Multiple']);
            print_r("Count" . $count . "\n");
            $row = 0;
            foreach ($selectedcustomer["Multiple"] as $key => $value) {
                $OrderNo = $value["orderNo"];
                $OrderSource = $value["orderSource"];
                $CustomerName = $value["customerName"];
                $CustomerEmail = $value["customerEmail"];
                $TaskType = $value["taskType"];
                $TaskStatus = $value["taskStatus"];
                $comments = $value["comments"];

                $name_parts = explode(" ", $CustomerName);
                $first_name = $name_parts[0];
                $last_name = $name_parts[1];
                print_r("OrderNo" . $OrderNo . "\n");
                print_r("orderSource" . $OrderSource . "\n");
                print_r("taskType" . $TaskType . "\n");
                print_r("taskStatus" . $TaskStatus . "\n");
                print_r("comments" . $comments . "\n");
                print_r("customerEmail" . $CustomerEmail . "\n");
                print_r("CustomerName" . $CustomerName . "\n");
                print_r("first_name" . $first_name . "\n");
                print_r("last_name" . $last_name . "\n");

                $contact = RNCPHP\ROQL::query(
                    "select ID from Contact C where Contact.Emails.Address = '" .
                    $CustomerEmail .
                    "'"
                )
                    ->next()
                    ->next();

                $ContactID = trim($contact["ID"]);
                print_r("ContactID" . $ContactID . "\n");

                if (!empty($ContactID)) {
                    //Exsiting Contact.
                    $ContactDetails_existing = RNCPHP\Contact::fetch(
                        $ContactID
                    );
                } else {
                    $ContactDetails = new RNCPHP\Contact();
                    $ContactDetails->Emails = new RNCPHP\EmailArray();
                    $ContactDetails->Emails[0] = new RNCPHP\Email();
                    $ContactDetails->Emails[0]->AddressType = new RNCPHP\NamedIDOptList();
                    $ContactDetails->Emails[0]->AddressType->LookupName =
                        "Email - Primary";
                    $ContactDetails->Emails[0]->Address = $CustomerEmail;
                    $ContactDetails->Name->First = $first_name;
                    $ContactDetails->Name->Last = $last_name;
                    $ContactDetails->save();
                    $ContactID = $ContactDetails->ID;
                }
                $TaskDetails = new RNCPHP\Task();
                $TaskDetails->Name =
                    "Order Errors for Order Number - " . $OrderNo;
                $TaskDetails->CustomFields->c->order_number = $OrderNo;
                $TaskDetails->CustomFields->c->order_source->LookupName = $OrderSource;
                $TaskDetails->CustomFields->c->import_task_type->LookupName = $TaskType;
                //$TaskDetails->CustomFields->c->status_id->LookupName = $TaskStatus;
                // $TaskDetails->CustomFields->c->notes = $comments;
                $TaskDetails->CustomFields->c->order_error_message = $comments;
                $TaskDetails->Contact = RNCPHP\Contact::fetch($ContactID);
                $TaskDetails->StatusWithType = new RNCPHP\StatusWithType();
                $TaskDetails->StatusWithType->Status->LookupName =
                    "Not Started";
                //$TaskDetails->save();

                try {
                    $TaskDetails->save();
                    if (!empty($TaskDetails)) {
                        $resp =
                            "Task created successfully for Order - " . $OrderNo;
                        $data[] = [
                            "orderNo" => $OrderNo,
                            "message" => "Task created successfully",
                        ];
                        echo "<pre>";
                        print_r($data);
                    } else {
                        $resp = "Task not created for Order - " . $OrderNo;
                    }
                    //  echo  json_encode($resp);
                    $msg = ["status" => "success", "taskresp" => $data];
                    $final = json_encode($msg);
                    echo $final;
                } catch (Exception $e) {
                    echo "ERROR->" . $e->getMessage();
                    logmessage($e->getMessage());
                }
                $row++;
            }
        }

        // If more than one payload ends

        //process ends
    }
    function posttask()
    {
        $logfile1 = fopen(
            "/tmp/customlogs_snow  " . date("Ymd") . ".log",
            "a+"
        );
        
        fwrite(
            $logfile1,
            "\n---------------------------" .
            date("Y-m-d H:i:s") .
            "--------------------------------\n"
        );
        
        $http_origin = $_SERVER["HTTP_ORIGIN"];
        header("Content-Type: application/json");
        
        $allowed_domains = [
            "https://beachbodyopa--tst1.custhelp.com",
            "http://localhost:8080",
            "http://localhost:3000"
        ];
        
        if (in_array(strtolower($http_origin), $allowed_domains)) {
            //header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Origin: $http_origin");
            header("Access-Control-Allow-Credentials: true");
            header("Access-Control-Max-Age: 86400");
            header("Content-Type: application/json");
        }
        if ($_SERVER["REQUEST_METHOD"] == "OPTIONS") {
            header("Access-Control-Allow-Methods: GET");
            header("Access-Control-Allow-Headers: api-key, Origin");
            header("Content-Type: application/json");
            exit(0);
        }
        $data = [];
        $dataarray = [];
        
        $Body = file_get_contents("php://input");
        //echo $Body;
        $data = json_decode($Body, true);
        /*echo "<pre>";
        print_r($data);
        */
        
        fwrite($logfile1, "<br> Body : " . $Body . "\n");
        
        fwrite($logfile1, "<br> request_xml type : " . gettype($Body) . "\n");
        
        fwrite($logfile1, "<br> decode : " . $data . "\n");
        
        $ResultCount = $data["taskList"];
        $count = count($ResultCount);
        //print_r ("count".$count."\n");
        fwrite($logfile1, "<br> count : " . $count . "\n");
        
        // process start
        $incident = new RNCPHP\Incident();
       
        
        // $incident->ID;
        foreach ($ResultCount as $data) {
            // $selectedcustomer["Single"] = $data["taskList"];
            $OrderNo = $data["orderNo"];
            $OrderSource = $data["orderSource"];
            $CustomerName = $data["customerName"];
            $CustomerEmail = $data["customerEmail"];
            $TaskType = $data["taskType"];
            $TaskStatus = $data["taskStatus"];
            $comments = $data["comments"];
        
            $name_parts = explode(" ", $CustomerName);
            $first_name = $name_parts[0];
            $last_name = $name_parts[1];
            /*		print_r ("OrderNo".$OrderNo."\n"); 
                print_r ("CustomerName".$CustomerName."\n"); 
                print_r ("first_name".$first_name."\n"); 
                print_r ("last_name".$last_name."\n"); */
        
            if (!empty($CustomerEmail)) {
                $contact = RNCPHP\ROQL::query(
                    "select ID from Contact C where Contact.Emails.Address = '" .
                    $CustomerEmail .
                    "'"
                )
                    ->next()
                    ->next();
        
                $ContactID = trim($contact["ID"]);
                //	print_r ("ContactID".$ContactID."\n");
        
                if (!empty($ContactID)) {
                    //Exsiting Contact.
                    $ContactDetails_existing = RNCPHP\Contact::fetch(
                        $ContactID
                    );
                } else {
                    $ContactDetails = new RNCPHP\Contact();
                    $ContactDetails->Emails = new RNCPHP\EmailArray();
                    $ContactDetails->Emails[0] = new RNCPHP\Email();
                    $ContactDetails->Emails[0]->AddressType = new RNCPHP\NamedIDOptList();
                    $ContactDetails->Emails[0]->AddressType->LookupName =
                        "Email - Primary";
                    $ContactDetails->Emails[0]->Address = $CustomerEmail;
                    $ContactDetails->Name->First = $first_name;
                    $ContactDetails->Name->Last = $last_name;
                    $ContactDetails->save();
        
                    $ContactID = $ContactDetails->ID;
                }
                $incident->Queue = new RNCPHP\NamedIDLabel();
                $incident->Queue->ID = 99;
                $incident->PrimaryContact = RNCPHP\Contact::fetch($ContactID);
                $incident->save();
                $TaskDetails = new RNCPHP\Task();
                $TaskDetails->Name =
                    "Order Errors for Order Number - " . $OrderNo;
                $TaskDetails->CustomFields->c->order_number = $OrderNo;
        
                $TaskDetails->CustomFields->c->import_task_type->LookupName = $TaskType;
                //$TaskDetails->CustomFields->c->status_id->LookupName = $TaskStatus;
                $TaskDetails->CustomFields->c->order_error_message = $comments;
                $TaskDetails->Contact = RNCPHP\Contact::fetch($ContactID);
                $TaskDetails->StatusWithType = new RNCPHP\StatusWithType();
                $TaskDetails->StatusWithType->Status->LookupName = "Not Started";
                $TaskDetails->ServiceSettings->Incident = RNCPHP\Incident::fetch((int) $incident->ID);
                $roql_result = RNCPHP\ROQL::query("SELECT Task.CustomFields.c.order_source.LookupName FROM Task WHERE Task.CustomFields.c.order_source.LookupName = '" . $OrderSource . "'")->next();
                $OrderSourceLookupName = 'Undefined';
                if ($roql_result->count() > 0) {
                    $OrderSourceLookupName = $OrderSource;
                }
                $TaskDetails->CustomFields->c->order_source->LookupName = $OrderSourceLookupName;
                try {
                    $TaskDetails->save();
                    if (!empty($TaskDetails)) {
                        $dataarray[] = [
                            "orderNo" => $OrderNo,
                            "status" => "success",
                            "message" => "Task created successfully",
                            "Incident" => $incident->ReferenceNumber
                        ];
                    } else {
                        $dataarray[] = [
                            "orderNo" => $OrderNo,
                            "status" => "failure",
                            "message" => "Task not created successfully",
                        ];
                    }
                } catch (Exception $e) {
                    $dataarray[] = [
                        "orderNo" => $OrderNo,
                        "status" => "failure",
                        "message" => explode(';', $e->getMessage())[0]
                    ];
                    // echo "ERROR->" . $e->getMessage();
                    logmessage($e->getMessage());
                }
        
                // $jsonArray = json_decode($final, true);
                // foreach ($jsonArray as $key => $value) {
                //     unset($jsonArray[taskResponse][taskList]);
                //     $status = json_encode($jsonArray);
                // }
                //	echo "<pre>";
        
            } else {
                $dataarray[] = [
                    "orderNo" => $OrderNo,
                    "status" => "failure",
                    "message" => "Missing Customer Email"
                ];
        
            }
        
        
        }
        $incidentQueue = RNCPHP\Incident::fetch((int)$incident->ID);
        $incidentQueue->Queue = new RNCPHP\NamedIDLabel();
        $incidentQueue->Queue->ID = 99;
        $incidentQueue->save();
        $msg = array('taskResponse' => $dataarray);
        $final = json_encode($msg);
        echo $final;
        exit;
        
    }




    function taskApinew()
    {
        $http_origin = $_SERVER["HTTP_ORIGIN"];

        $allowed_domains = [
            "https://beachbodyopa--tst1.custhelp.com",
            "http://localhost:8080",
        ];
        header("Content-Type: application/json");

        if (in_array(strtolower($http_origin), $allowed_domains)) {
            //header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Origin: $http_origin");
            header("Access-Control-Allow-Credentials: true");
            header("Access-Control-Max-Age: 86400");
            header("Content-Type: application/json");
            echo "loop 1";
        }
        if ($_SERVER["REQUEST_METHOD"] == "OPTIONS") {
            header("Access-Control-Allow-Methods: GET");
            header("Access-Control-Allow-Headers: api-key, Origin");
            header("Content-Type: application/json");
            echo "loop 2";

            exit(0);
        }
        //   echo "<br>";
        // echo"-----------------------------------";
        // echo "<br>";
        $data = [];
        $dataarray = [];
        $url = $actual_link =
            (empty($_SERVER["HTTPS"]) ? "http" : "https") .
            "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url_components = parse_url($url);
        $query = $url_components["query"];
        $url_decode = strip_tags(urldecode($query));
        $url_decodes = str_replace("&quot;", '"', $url_decode);
        $data = json_decode($url_decodes, true);
        echo "<pre>";
        print_r($data);

        $ResultCount = $data["taskList"];
        $count = count($ResultCount);
        // print_r("count: " . $count . "<b>");

        // process start

        if ($count == 1) {
            print_r("count: " . $count . "<br>");

            $selectedcustomer["Single"] = $data["taskList"];
            $OrderNo = $selectedcustomer["Single"][0]["orderNo"];
            $OrderSource = $selectedcustomer["Single"][0]["orderSource"];
            $CustomerName = $selectedcustomer["Single"][0]["customerName"];
            $CustomerEmail = $selectedcustomer["Single"][0]["customerEmail"];
            $TaskType = $selectedcustomer["Single"][0]["taskType"];
            $TaskStatus = $selectedcustomer["Single"][0]["taskStatus"];
            $comments = $selectedcustomer["Single"][0]["comments"];

            $name_parts = explode(" ", $CustomerName);
            $first_name = $name_parts[0];
            $last_name = $name_parts[1];
            /*     print_r("OrderNo" . $OrderNo . "\n");
                 print_r("CustomerName" . $CustomerName . "\n");
                 print_r("CustomerEmail" . $CustomerEmail . "\n");

                 print_r("first_name" . $first_name . "\n");
                 print_r("last_name" . $last_name . "\n");*/

            if (!empty($CustomerEmail)) {
                $contact = RNCPHP\ROQL::query("select ID from Contact C where Contact.Emails.Address = '" . $CustomerEmail . "'")->next()->next();

                $ContactID = trim($contact["ID"]);
                //  print_r("ContactID" . $ContactID . "\n");

                if (!empty($ContactID)) {
                    //Exsiting Contact.
                    $ContactDetails_existing = RNCPHP\Contact::fetch($ContactID);
                    //    print_r("ContactDetails_existing \n");
                } else {
                    $ContactDetails = new RNCPHP\Contact();
                    $ContactDetails->Emails = new RNCPHP\EmailArray();
                    $ContactDetails->Emails[0] = new RNCPHP\Email();
                    $ContactDetails->Emails[0]->AddressType = new RNCPHP\NamedIDOptList();
                    $ContactDetails->Emails[0]->AddressType->LookupName =
                        "Email - Primary";
                    $ContactDetails->Emails[0]->Address = $CustomerEmail;
                    $ContactDetails->Name->First = $first_name;
                    $ContactDetails->Name->Last = $last_name;
                    $ContactDetails->save();

                    $ContactID = $ContactDetails->ID;
                }

                $TaskDetails = new RNCPHP\Task();
                $TaskDetails->Name =
                    "Order Errors for Order Number - " . $OrderNo;
                $TaskDetails->CustomFields->c->order_number = $OrderNo;
                $TaskDetails->CustomFields->c->order_source->LookupName = $OrderSource;
                $TaskDetails->CustomFields->c->import_task_type->LookupName = $TaskType;
                //$TaskDetails->CustomFields->c->status_id->LookupName = $TaskStatus;
                $TaskDetails->CustomFields->c->order_error_message = $comments;
                $TaskDetails->Contact = RNCPHP\Contact::fetch($ContactID);
                $TaskDetails->StatusWithType = new RNCPHP\StatusWithType();
                $TaskDetails->StatusWithType->Status->LookupName =
                    "Not Started";
                $TaskDetails->save();

                $resp = "Task created successfully for Order - " . $OrderNo;
                echo json_encode($resp);
            } else {
            }
        }
        // If more than one payload
        elseif ($count > 1) {
            //echo "multiple";
            $multiplerecords = $data["taskList"];
            //	echo "<pre>";
            //	print_r($multiplerecords);

            $count = count($multiplerecords);

            //$count = count($selectedcustomer['Multiple']);
            //  print_r("Count" . $count . "\n");

            foreach ($multiplerecords as $key => $value) {
                $OrderNo = $value["orderNo"];
                $OrderSource = $value["orderSource"];
                $CustomerName = $value["customerName"];
                $CustomerEmail = $value["customerEmail"];
                $TaskType = $value["taskType"];
                $TaskStatus = $value["taskStatus"];
                $comments = $value["comments"];

                $name_parts = explode(" ", $CustomerName);
                $first_name = $name_parts[0];
                $last_name = $name_parts[1];
                /* print_r("OrderNo" . $OrderNo . "\n");
                 print_r("orderSource" . $OrderSource . "\n");
                 print_r("taskType" . $TaskType . "\n");
                 print_r("taskStatus" . $TaskStatus . "\n");
                 print_r("comments" . $comments . "\n");
                 print_r("customerEmail" . $CustomerEmail . "\n");
                 print_r("CustomerName" . $CustomerName . "\n");
                 print_r("first_name" . $first_name . "\n");
                 print_r("last_name" . $last_name . "\n");
                 echo"---------------------------------";*/
                $contact = RNCPHP\ROQL::query(
                    "select ID from Contact C where Contact.Emails.Address = '" .
                    $CustomerEmail .
                    "'"
                )
                    ->next()
                    ->next();

                $ContactID = trim($contact["ID"]);
                //  print_r("ContactID" . $ContactID . "\n");

                if (!empty($ContactID)) {
                    //Exsiting Contact.
                    $ContactDetails_existing = RNCPHP\Contact::fetch(
                        $ContactID
                    );
                } else {
                    $ContactDetails = new RNCPHP\Contact();
                    $ContactDetails->Emails = new RNCPHP\EmailArray();
                    $ContactDetails->Emails[0] = new RNCPHP\Email();
                    $ContactDetails->Emails[0]->AddressType = new RNCPHP\NamedIDOptList();
                    $ContactDetails->Emails[0]->AddressType->LookupName =
                        "Email - Primary";
                    $ContactDetails->Emails[0]->Address = $CustomerEmail;
                    $ContactDetails->Name->First = $first_name;
                    $ContactDetails->Name->Last = $last_name;
                    $ContactDetails->save();
                    $ContactID = $ContactDetails->ID;
                }
                $TaskDetails = new RNCPHP\Task();
                $TaskDetails->Name =
                    "Order Errors for Order Number - " . $OrderNo;
                $TaskDetails->CustomFields->c->order_number = $OrderNo;
                $TaskDetails->CustomFields->c->order_source->LookupName = $OrderSource;
                $TaskDetails->CustomFields->c->import_task_type->LookupName = $TaskType;
                //$TaskDetails->CustomFields->c->status_id->LookupName = $TaskStatus;
                $TaskDetails->CustomFields->c->order_error_message = $comments;
                $TaskDetails->Contact = RNCPHP\Contact::fetch($ContactID);
                $TaskDetails->StatusWithType = new RNCPHP\StatusWithType();
                $TaskDetails->StatusWithType->Status->LookupName =
                    "Not Started";
                $TaskDetails->save();
                //print_r ('OrderNos' .$OrderNo. "\n");
                /* echo "<br>";
                 echo "created task with ID : ".$TaskDetails->ID;
                 echo "<br>";
                 echo "order number ".$OrderNo;*/

                try {
                    //   $TaskDetails->save();
                    if (!empty($TaskDetails)) {
                        $dataarray[] = [
                            "orderNo" => $OrderNo,
                            "status" => "success",
                            "message" => "Task created successfully",
                        ];

                    } else {
                        $resp = "Task not created for Order - " . $OrderNo;
                    }
                } catch (Exception $e) {
                    echo "ERROR->" . $e->getMessage();
                    logmessage($e->getMessage());
                }
                //  echo  json_encode($resp);
            }

            $msg = array(["taskResponse" => $dataarray]);
            //  echo( json_encode($msg) );

            $final = json_encode($msg);
            $jsonArray = json_decode($final, true);
            $status = json_encode($jsonArray);
            // echo "<pre>";
            // print_r($status);
            // header("Content-Type: application/json");
            // $status = json_encode($jsonArray);
            // print_r(json_encode($status));
            //  print_r (gettype(json_encode($jsonArray)));
            var_dump($final);
            //     print_r (gettype($jsonArray));

            //print_r($status);

            // If more than one payload ends

            //process ends
        }
    }

    //test

    function orderimport()
    {
        try {

            $request_xml1 = '{
        "environment": "qa",
        "orderFrom": "UAD",
        "creationDate": "sysdate",
        "header": {
            "sourceSystem": "TBB WEB",
            "correlationId": "STORE_2023090858130",
            "origSysDocumentRef": "STORE_2023090858130",
            "businessUnit": "NETWORK",
            "orderDateTime": "2023-09-09T15:06:42.319-04:00",
            "offerCode": "2020-APPWHSE-US-CO-SALE",
            "orderType": "WEB ORDER_NT",
            "shipMethodCode": "FedEx SmartPost",
            "orderSubtotal": 74.25,
            "orderShAmount": 6.95,
            "orderTaxRate": 0.0,
            "totalTaxAmount": 8.32,
            "orderTaxAmount": 8.32,
            "personalUse": "Y",
            "priceSuppression": "N",
            "zeroOutShakeolagy": "0",
            "referenceCode": "6861648017996398803954",
            "ipAddress": "199.187.237.194",
            "sessionId": "im0sl1x0Ct_RKQn5k8pCeVXzDGsrSX71NIBwhE-L",
            "paymentPlanCode": "1 Pay",
            "paymentTerm": "1 pay",
            "paymentMethod": "CREDIT_CARD",
            "ccType": "VISA",
            "ccNo": "7010000000007679584",
            "expDate": "2024-08-28",
            "authCode": "888888",
            "holderNameOnCc": "testing volllmhucqtest",
            "currencyCode": "USD",
            "customer": {
                "guid": "52433D07-B005-4D15-AA0A-6FAF0C5AD456",
                "origSysDocumentRef": "STORE_2023090858130",
                "customerNo": "304330495",
                "customerType": "COACH",
                "gncCoachId": "2982957",
                "gncSponsorId": "994",
                "firstName": "User A",
                "lastName": "volllmhucq",
                "billToAddress1": "3301 Exposit",
                "billToAddress2": "abc123456789",
                "billToCity": "Santa Monica",
                "billToState": "CA",
                "billToZipcode": "90404",
                "billToCountry": "US",
                "shipToFirstName": "User A",
                "shipToLastName": "volllmhucq",
                "shipToAddress1": "3301 Exposit",
                "shipToAddress2": "abc123456789",
                
                "shipToCity": "Santa Monica",
                "shipToState": "CA",
                "shipToCountry": "US",
                "shipToZipcode": "90404",
                "communication": [
                    {
                        "commValue": "18588639478",
                        "commType": "GEN",
                        "purpose": "DAY_PHONE",
                        "primary": "",
                        "owner": "BILL_TO",
                        "sourceSystem": ""
                    },
                    {
                        "commValue": "18588639478",
                        "commType": "GEN",
                        "purpose": "DAY_PHONE",
                        "primary": "",
                        "owner": "SHIP_TO",
                        "sourceSystem": ""
                    },
                    {
                        "commType": "EMAIL",
                        "commValue": "volllmhucq1686164593@beachbodytest.com",
                        "purpose": "",
                        "primary": "",
                        "owner": "BILL_TO",
                        "sourceSystem": ""
                    }
                ]
            },
            "lines": [
                {
                    "origSysDocumentRef": "STORE_2023090858123",
                    "lineNumber": 1,
                    "offerCode": "2020-APPWHSE-US-CO-SALE",
                    "itemNumber": "MD2BSTREAM6",
                    "originalPrice": 99.00,
                    "retailPrice": 0.00,
                    "commissions": "0",
                    "subscriptionCommissions": "0.0",
                    "cv": "74.00",
                    "pv": "74.00",
                    "qty": 1,
                    "uom": "EA",
                    "fastStartAmount": "0.0",
                    "hdTriggerFlag": 0,
                    "itemPrice": 74.25,
                    "itemPaymentPlanCode": "1 Pay",
                    "primaryProductType": "2B",
                    "sendToByd": "Y",
                    "lineReference": "ci6690000428"
                },
                {
                    "origSysDocumentRef": "STORE_2023090858123",
                    "lineNumber": 1002,
                    "offerCode": "2020-APPWHSE-US-CO-SALE",
                    "itemNumber": "MD2BSTREAM",
                    "originalPrice": 0,
                    "retailPrice": 0,
                    "commissions": "0",
                    "subscriptionCommissions": "0",
                    "cv": 0,
                    "pv": 0,
                    "qty": 1,
                    "uom": "EA",
                    "fastStartAmount": "0",
                    "hdTriggerFlag": "0",
                    "itemPrice": 0,
                    "itemPaymentPlanCode": "1 Pay",
                    "primaryProductType": "2B",
                    "topModelLineReference": "ci6690000428",
                    "sendToByd": "Y"
                }
            ],
            "adjustment": [
                {
                    "adjustmentLevel": "LINE",
                    "adjustmentType": "TIER_DISCOUNT",
                    "lineNumber": 1,
                    "itemNumber": "MD2BSTREAM6",
                    "promotionId": "COACH",
                    "discountAmount": 24.75,
                    "promoDesc": "TIER_DISCOUNT"
                }
            ]
        }
    }';

            $url = 'https://qa.esi.beachbody.com/orders/import';
            $key = 'FRGvCHs9WU3pn921Fbgoc6jEe6HyRzfDLQDHvyZb';
            if (!function_exists("\curl_init")) {
                \load_curl();
            }
            $ch = curl_init();
            //curl_setopt($ch, CURLOPT_USERPWD, $soapUser.":".$soapPassword);
            curl_setopt($ch, CURLOPT_URL, $url);
            // Set header supression
//curl_setopt($ch, CURLOPT_HEADER,0); 
// Disable SSL peer verification
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml', 'Accept: application/json', 'x-api-key: ' . $key));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $request_xml1);
            curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
            // Indicate that the message should be returned to a variable
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            // Make request
            $response = curl_exec($ch);
            //$retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
// print_r("response is ".$response);
            print_r($response);
            //print_r($retcode);
/* if(!$response)
{
	echo "response is empty";
}
else{
	
	echo "response is not empty";
} */

            $arr = array();
            $xml_parser = xml_parser_create();
            xml_parse_into_struct($xml_parser, $response, $arr);
            xml_parser_free($xml_parser);

            //echo "-----<pre>";
//var_dump($arr[10]["value"]);


            if (curl_errno($ch)) {
                exit;
                print "Error: " . curl_error($ch);
            } else {
                curl_close($ch);
            }
        } catch (Exception $e) {
            print_r("exception is " . $e->getMessage());
        }
    }

    //test

    function orderstatus($orderNum)
    {
        try {
            $http_origin = $_SERVER["HTTP_ORIGIN"];

            $allowed_domains = [
                "https://beachbodyopa--tst1.custhelp.com",
                "http://localhost:8080",
            ];
            header("Content-Type: application/json");

            if (in_array(strtolower($http_origin), $allowed_domains)) {
                //header("Access-Control-Allow-Origin: *");
                header("Access-Control-Allow-Origin: $http_origin");
                header("Access-Control-Allow-Credentials: true");
                header("Access-Control-Max-Age: 86400");
                header("Content-Type: application/json");
                echo "loop 1";
            }
            if ($_SERVER["REQUEST_METHOD"] == "OPTIONS") {
                header("Access-Control-Allow-Methods: GET");
                header("Access-Control-Allow-Headers: api-key, Origin");
                header("Content-Type: application/json");
                echo "loop 2";

                exit(0);
            }
            if (!function_exists("\curl_init")) {
                \load_curl();
            }

            $curl = curl_init();

            $url = "https://agentkb--tst1.custhelp.com/services/rest/connect/v1.4/queryResults/?query=Select Tasks.ID,Tasks.StatusWithType.Status.LookupName from Tasks where Tasks.CustomFields.c.order_number =" . $orderNum;

            curl_setopt_array(
                $curl,
                array(
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_HTTPHEADER => array(
                        'OSvC-CREST-Application-Context: task',
                        'Authorization: Basic bmJhbGFrcmlzaG5hbjpuYmFsYWtyaXNobmFu'
                    ),
                )
            );

            $response = curl_exec($curl);

            curl_close($curl);
            echo $response;
            print_r($response);

        } catch (Exception $e) {
            print_r("exception is " . $e->getMessage());
        }
    }

    // update task starts

    function taskupdate()
    {
        $logfile1 = fopen(
            "/tmp/customlogs_snow  " . date("Ymd") . ".log",
            "a+"
        );

        fwrite(
            $logfile1,
            "\n---------------------------" .
            date("Y-m-d H:i:s") .
            "--------------------------------\n"
        );

        $http_origin = $_SERVER["HTTP_ORIGIN"];
        header("Content-Type: application/json");

        $allowed_domains = [
            "https://beachbodyopa--tst1.custhelp.com",
            "http://localhost:8080",
            "http://localhost:3000"
        ];

        if (in_array(strtolower($http_origin), $allowed_domains)) {
            //header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Origin: $http_origin");
            header("Access-Control-Allow-Credentials: true");
            header("Access-Control-Max-Age: 86400");
            header("Content-Type: application/json");
        }
        if ($_SERVER["REQUEST_METHOD"] == "OPTIONS") {
            header("Access-Control-Allow-Methods: GET");
            header("Access-Control-Allow-Headers: api-key, Origin");
            header("Content-Type: application/json");
            exit(0);
        }
        $data = [];
        $dataarray = [];

        $Body = file_get_contents("php://input");
        //echo $Body;
        $data = json_decode($Body, true);
        /*echo "<pre>";
    print_r($data);
    */

        fwrite($logfile1, "<br> Body : " . $Body . "\n");

        fwrite($logfile1, "<br> request_xml type : " . gettype($Body) . "\n");

        fwrite($logfile1, "<br> decode : " . $data . "\n");

        $ResultCount = $data["taskIDs"];
        $count = count($ResultCount);
        //print_r ("count".$count."\n");
        fwrite($logfile1, "<br> count : " . $count . "\n");

        // process start

        if ($count == 1) {
            $selectedcustomer["Single"] = $data["taskIDs"];
            $TaskId = $selectedcustomer["Single"][0]["taskid"];

            if (!empty($TaskId)) {

                $TaskDetails = RNCPHP\Task::fetch($TaskId);
                $TaskDetails->StatusWithType = new RNCPHP\StatusWithType();
                $TaskDetails->StatusWithType->Status->LookupName = "Completed";
                $TaskDetails->save();

            }

        }         // If more than one payload
        elseif ($count > 1) {
            $multiplerecords = $data["taskIDs"];
            $count = count($multiplerecords);

            foreach ($multiplerecords as $key => $value) {
                $TaskId = $value["taskid"];

                $TaskDetails = RNCPHP\Task::fetch($TaskId);
                $TaskDetails->StatusWithType = new RNCPHP\StatusWithType();
                $TaskDetails->StatusWithType->Status->LookupName = "Completed";
                $TaskDetails->save();

                // If more than one payload ends
                //process ends
            }


        }

        // task update ends

    }


            // new update task starts

            // function taskfieldupdate()
        // {

            //     $http_origin = $_SERVER["HTTP_ORIGIN"];
        //     header("Content-Type: application/json");

            //     $allowed_domains = [
        //         "https://beachbodyopa--tst1.custhelp.com",
        //         "http://localhost:8080",
        //         "http://localhost:3000"
        //     ];

            //     if (in_array(strtolower($http_origin), $allowed_domains)) {
        //         //header("Access-Control-Allow-Origin: *");
        //         header("Access-Control-Allow-Origin: $http_origin");
        //         header("Access-Control-Allow-Credentials: true");
        //         header("Access-Control-Max-Age: 86400");
        //         header("Content-Type: application/json");
        //     }
        //     if ($_SERVER["REQUEST_METHOD"] == "OPTIONS") {
        //         header("Access-Control-Allow-Methods: GET");
        //         header("Access-Control-Allow-Headers: api-key, Origin");
        //         header("Content-Type: application/json");
        //         exit(0);
        //     }

            //     $query = http_build_query($_GET);
        //     $encodedString = strip_tags(urldecode($query));
        //     $decodedString = str_replace('&quot;', '"', $encodedString);
        //     $decodedString1 = str_replace('_"taskIDs":_', '"taskIDs":', $decodedString);
        //     $decodedString2 = str_replace(']=', '] }', $decodedString1);

            //     //print_r($decodedString2);
        //     logmessage($decodedString2);


            //     $data = json_decode($decodedString2, true);
        //     /*   echo "<pre>";
        //        print_r($data);*/
        //     $ResultCount = $data["taskIDs"];
        //     $count = count($ResultCount);
        //     //    print_r ("count".$count."\n");

            //     // process start

            //     if ($count == 1) {
        //         $selectedcustomer["Single"] = $data["taskIDs"];
        //         $TaskId = $selectedcustomer["Single"][0]["taskid"];
        //         $TaskOrderNo = $selectedcustomer["Single"][0]["order_number"];
        //         $TaskName = $selectedcustomer["Single"][0]["LookupName"];
        //         $TaskSource = $selectedcustomer["Single"][0]["order_source"];
        //         $import_task_type = $selectedcustomer["Single"][0]["import_task_type"];
        //         $TaskStatus = $selectedcustomer["Single"][0]["Status"];
        //         $TaskError = $selectedcustomer["Single"][0]["order_error_message"];
        //         /*
        //                 print_r ("TaskId".$TaskId."\n");
        //                 print_r ("TaskOrderNo".$TaskOrderNo."\n");
        //                 print_r ("TaskName".$TaskName."\n");
        //                 print_r ("TaskSource".$TaskSource."\n");
        //                 print_r ("import_task_type".$import_task_type."\n");
        //                 print_r ("TaskStatus".$TaskStatus."\n");
        //                 print_r ("TaskError".$TaskError."\n");
        //         */
        //         if (!empty($TaskId)) {

            //             $TaskDetails = RNCPHP\Task::fetch($TaskId);
        //             if (!empty($TaskName)) {
        //                 $TaskDetails->Name = $TaskName;
        //             }
        //             if (!empty($TaskOrderNo)) {
        //                 $TaskDetails->CustomFields->c->order_number = $TaskOrderNo;
        //             }
        //             if (!empty($TaskSource)) {
        //                 $TaskDetails->CustomFields->c->order_source = new RNCPHP\NamedIDLabel();
        //                 $TaskDetails->CustomFields->c->order_source->LookupName = $TaskSource;
        //             }
        //             if (!empty($import_task_type)) {
        //                 $TaskDetails->CustomFields->c->import_task_type = new RNCPHP\NamedIDLabel();
        //                 $TaskDetails->CustomFields->c->import_task_type->LookupName = $import_task_type;
        //             }
        //             if (!empty($TaskError)) {
        //                 $TaskDetails->CustomFields->c->order_error_message = $TaskError;
        //             }
        //             if (!empty($TaskStatus)) {
        //                 $TaskDetails->StatusWithType = new RNCPHP\StatusWithType();
        //                 $TaskDetails->StatusWithType->Status->LookupName = $TaskStatus;
        //             }
        //             try {
        //                 //echo "in";
        //                 $TaskDetails->save();
        //             } catch (Exception $err) {
        //                 //echo "out";

            //                 echo $err->getMessage();
        //                 echo "error";
        //             }
        //         }

            //     }         // If more than one payload
        //     elseif ($count > 1) {
        //         $multiplerecords = $data["taskIDs"];
        //         $count = count($multiplerecords);

            //         foreach ($multiplerecords as $key => $value) {


            //             $multiplerecords["Single"] = $data["taskIDs"];
        //             $TaskId = $value["taskid"];
        //             $TaskOrderNo = $value["order_number"];
        //             $TaskName = $value["LookupName"];
        //             $TaskSource = $value["order_source"];
        //             $import_task_type = $value["import_task_type"];
        //             $TaskStatus = $value["Status"];
        //             $TaskError = $value["order_error_message"];

            //             /*    print_r ("TaskId".$TaskId."\n");
        //                 print_r ("TaskOrderNo".$TaskOrderNo."\n");
        //                 print_r ("TaskName".$TaskName."\n");
        //                 print_r ("TaskSource".$TaskSource."\n");
        //                 print_r ("import_task_type".$import_task_type."\n");
        //                 print_r ("TaskStatus".$TaskStatus."\n");
        //                 print_r ("TaskError".$TaskError."\n");*/

            //             $TaskDetails = RNCPHP\Task::fetch($TaskId);
        //             $TaskDetails = RNCPHP\Task::fetch($TaskId);
        //             if (!empty($TaskName)) {
        //                 $TaskDetails->Name = $TaskName;
        //             }
        //             if (!empty($TaskOrderNo)) {
        //                 $TaskDetails->CustomFields->c->order_number = $TaskOrderNo;
        //             }
        //             if (!empty($TaskSource)) {
        //                 $TaskDetails->CustomFields->c->order_source = new RNCPHP\NamedIDLabel();
        //                 $TaskDetails->CustomFields->c->order_source->LookupName = $TaskSource;
        //             }
        //             if (!empty($import_task_type)) {
        //                 $TaskDetails->CustomFields->c->import_task_type = new RNCPHP\NamedIDLabel();
        //                 $TaskDetails->CustomFields->c->import_task_type->LookupName = $import_task_type;
        //             }
        //             if (!empty($TaskError)) {
        //                 $TaskDetails->CustomFields->c->order_error_message = $TaskError;
        //             }
        //             if (!empty($TaskStatus)) {
        //                 $TaskDetails->StatusWithType = new RNCPHP\StatusWithType();
        //                 $TaskDetails->StatusWithType->Status->LookupName = $TaskStatus;
        //             }
        //             //$TaskDetails->save();
        //             try {
        //                 //echo "in";
        //                 $TaskDetails->save();
        //             } catch (Exception $err) {
        //                 //echo "out";

            //                 echo $err->getMessage();
        //                 echo "error";
        //             }
        //             // If more than one payload ends
        //             //process ends
        //         }


            //     }


            // }

    // Task Field Update 

    function taskfieldupdate()
    {
        // try {
        $responseTask = [];


        $http_origin = $_SERVER['HTTP_ORIGIN'];
        header("Access-Control-Allow-Origin: $http_origin");
        header("Access-Control-Allow-Methods: POST");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');
        header('Content-Type: application/json');


        // if ($_SERVER["REQUEST_METHOD"] == "OPTIONS") {
        //     header("Access-Control-Allow-Methods: GET");
        //     header("Access-Control-Allow-Headers: api-key, Origin");
        //     header("Content-Type: application/json");
        //     exit(0);
        // }
        $Body = file_get_contents("php://input");

        $bodyObject = json_decode($Body, true);


        $payload = $bodyObject["taskIDs"];

        // if (count($payload) <= 0) {
        //     $response['Status Code'] = "400";
        //     $response['Status'] = "Bad Request";
        //     $response['Reason'] = "Empty Payload";
        //     echo json_encode($response);
        //     exit;
        // }
        foreach ($payload as $data) {
            $TaskId = $data["taskid"];
            $TaskOrderNo = $data["order_number"];
            $TaskName = $data["LookupName"];
            $TaskSource = $data["order_source"];
            $import_task_type = $data["import_task_type"];
            $TaskStatus = $data["Status"];
            $TaskError = $data["order_error_message"];
            try {
                $TaskDetails = RNCPHP\Task::fetch($TaskId);
            } catch (Exception $err) {
                $response['Task ID'] = $TaskId;
                // $response['Status Code'] = "450";
                $response['status'] = "Update Failed";
                $response['message'] = explode(';', $err->getMessage())[0];
                array_push($responseTask, $response);
            }
            if (!empty($TaskName)) {
                $TaskDetails->Name = $TaskName;
            }
            if (!empty($TaskOrderNo)) {
                $TaskDetails->CustomFields->c->order_number = $TaskOrderNo;
            }
            if (!empty($TaskSource)) {
                $TaskDetails->CustomFields->c->order_source = new RNCPHP\NamedIDLabel();
                $roql_result = RNCPHP\ROQL::query("SELECT Task.CustomFields.c.order_source.LookupName FROM Task WHERE Task.CustomFields.c.order_source.LookupName = '" . $TaskSource . "'")->next();
                $OrderSourceLookupName = 'Undefined';
                if ($roql_result->count() > 0) {
                    $OrderSourceLookupName = $TaskSource;
                }
                $TaskDetails->CustomFields->c->order_source->LookupName = $OrderSourceLookupName;

                // $TaskDetails->CustomFields->c->order_source->LookupName = $TaskSource;
            }
            if (!empty($import_task_type)) {
                $TaskDetails->CustomFields->c->import_task_type = new RNCPHP\NamedIDLabel();
                $TaskDetails->CustomFields->c->import_task_type->LookupName = $import_task_type;
            }
            if (!empty($TaskError)) {
                $TaskDetails->CustomFields->c->order_error_message = $TaskError;
            }
            if (!empty($TaskStatus)) {
                $TaskDetails->StatusWithType = new RNCPHP\StatusWithType();
                $TaskDetails->StatusWithType->Status->LookupName = $TaskStatus;
            }
            //$TaskDetails->save();
            try {
                //echo "in";
                if ($TaskDetails->save()) {
                    $response['Task ID'] = $TaskId;
                    $response['Status Code'] = "204";
                    $response['Status'] = "Updated Successfully";
                } else {
                    $response['Task ID'] = $TaskId;
                    $response['Status Code'] = "450";
                    $response['Status'] = "Failed";
                }

            } catch (Exception $err) {
                //echo "out";
                $response['Task ID'] = $TaskId;
                $response['status'] = "Update Failed";
                $response['message'] = explode(';', $err->getMessage())[0];
                // echo $err->getMessage();
                // echo "error";
            }
            array_push($responseTask, $response);
            // If more than one payload ends
            //process ends
        }
        // } catch (Exception $e) {
        //     $response['Task ID'] = $TaskId;
        //     $response['code'] = "450";
        //     $response['status'] = "Update Failed";
        //     $response['message'] = explode(';', $e->getMessage())[0];
        //     array_push($responseTask, $response);
        // }
        echo json_encode($responseTask);
        exit;
    }

    // task update new ends

    //function for get task details api

    function gettask($params = '')
    {
        $filter = explode('&', $params);

        $filterValue[explode('=', $filter[0])[0]] = explode('=', $filter[0])[1];
        $filterValue[explode('=', $filter[1])[0]] = explode('=', $filter[1])[1];
        //$orderid = "STORE_463293531";
        // echo '<pre>';
        // print_r($filterValue);exit;
        $http_origin = $_SERVER['HTTP_ORIGIN'];
        header("Access-Control-Allow-Origin: $http_origin");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');
        header('Content-Type: application/json');

        if (!function_exists("\curl_init")) {
            \load_curl();
        }

        $curl = curl_init();
        //    $url_org = 'https://agentkb--tst1.custhelp.com/services/rest/connect/v1.4/queryResults/?query=Select%20Tasks.Contact.ID%2CTasks.LookupName%2CTasks.CreatedTime%2CTasks.CustomFields.c.order_number%2CTasks.CustomFields.c.order_source%2CTasks.CustomFields.c.import_task_type%2CTasks.CustomFields.c.order_error_message%2CTasks.AssignedToAccount%2CTasks.StatusWithType.Status.LookupName%20from%20Tasks%20Where%20Tasks.CustomFields.c.import_task_type%20%3D%201992%20AND%20Tasks.StatusWithType.Status.LookupName%20%3D%20%27Completed%27';

        $space = "%20";
        $comma = "%2C";
        $equals = "%3D";
        $apostrophe = "%27";

        //$url = 'https://us-english--tst1.custhelp.com/services/rest/connect/v1.4/queryResults/?query=Select'.$space.'Tasks.ID'.$comma.'Tasks.StatusWithType.Status.LookupName'.$space.'from'.$space.'Tasks'.$space.'where'.$space.'Tasks.CustomFields.c.order_number'.$space.$equals.$apostrophe.$orderNum.$apostrophe;
        //echo $url;
        $query = 'SELECT' . $space . 'Tasks.Contact.ID' . $space . 'AS' . $space . 'Contact' . $comma;
        $query = $query . 'Tasks.ID' . $comma . 'Tasks.LookupName' . $space . 'AS' . $space . 'TaskName';
        $query = $query . $comma . 'Tasks.CreatedTime' . $comma . 'Tasks.UpdatedTime' . $comma;
        $query = $query . 'Tasks.CustomFields.c.order_number' . $comma;
        $query = $query . 'Tasks.CustomFields.c.order_source.Lookupname' . $space . 'AS' . $space . 'order_source';
        $query = $query . $comma . 'Tasks.CustomFields.c.import_task_type.Lookupname';
        $query = $query . $space . 'AS' . $space . 'import_task_type' . $comma;
        $query = $query . 'Tasks.CustomFields.c.order_error_message' . $comma;
        $query = $query . 'Tasks.AssignedToAccount' . $comma . 'Tasks.StatusWithType.Status.LookupName';
        $query = $query . $space . 'AS' . $space . 'Status' . $space . 'from' . $space . 'Tasks' . $space;
        $query = $query . 'WHERE';
        // $query = $query . $space.'Tasks.CustomFields.c.import_task_type.LookupName'.$equals.$apostrophe.$filterValue['import_task_type'].$apostrophe;



        // $query = $query .$space.'OR'.$space . 'Tasks.CustomFields.c.import_task_type' . $space . 'in' . $space . '(1992' . $comma . '2000)' . $space;
        // $query = $query .$space.'AND' . $space . 'Tasks.StatusWithType.Status.LookupName' . $space . $equals . $space . $apostrophe .  $filterValue['status'] . $apostrophe.'';
        if ($filterValue['import_task_type']) {
            if ($filterValue['status']) {
                $query = $query . $space . 'Tasks.StatusWithType.Status.LookupName' . $space . $equals . $space . $apostrophe . $filterValue['status'] . $apostrophe . $space . 'AND';

            }
            $query = $query . $space . 'Tasks.CustomFields.c.import_task_type.LookupName' . $equals . $apostrophe . $filterValue['import_task_type'] . $apostrophe;
        } else {
            if ($filterValue['status']) {
                $query = $query . $space . 'Tasks.StatusWithType.Status.LookupName' . $space . $equals . $space . $apostrophe . $filterValue['status'] . $apostrophe . $space . 'AND';

            }
            $query = $query . $space . 'Tasks.CustomFields.c.import_task_type' . $space . 'in' . $space . '(1992' . $comma . '2000)' . $space;
        }


        // echo $query;exit;
        $url = 'https://agentkb--tst2.custhelp.com/services/rest/connect/v1.4/queryResults/?query=' . $query;


        //echo $url;
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'OSvC-CREST-Application-Context: task',
                    'Authorization: Basic QWxhbi1leHQ6UGFzc3dvcmQxMjM='
                ),
            )
        );

        $response = curl_exec($curl);

        if ($errno = curl_errno($curl)) {
            $error_message = curl_strerror($errno);
            echo "cURL error ({$errno}):\n {$error_message}";

            echo "inside error";
            echo $error_message;

        }

        curl_close($curl);
        echo $response;
        logmessage($response);

    }

}
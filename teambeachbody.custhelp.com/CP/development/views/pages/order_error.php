<rn:meta title="#rn:msg:ERROR_LBL#" template="standardOrder.php" />

<?
switch(getUrlParm("error_id"))
{
    case 1:
        $error_title = getMessage(PERMISSION_DENIED_LBL);
        $error_msg   = getMessage(ANSWER_IS_NO_LONGER_AVAILABLE_MSG);
        break;
    case 2:
        $error_title = getMessage(PERMISSION_DENIED_LBL);
        $error_msg   = getMessage(SERV_CONTRACT_PERMIT_VIEWING_ANS_LBL);
        break;
    case 3:
        $error_title = getMessage(FILE_DOWNLOAD_ERROR_LBL); 
        $error_msg = getMessage(SORRY_ERROR_DOWNLOADING_FILE_MSG);
        break;
    case 4:
        $error_title = getMessage(PERMISSION_DENIED_LBL);
        $error_msg   = getMessage(NO_ACCESS_PERMISSION_MSG);
        break;            
    case 5:
        $error_title = getMessage(OPERATION_FAILED_LBL);
        $error_msg   = "<strong>Submission Failed</strong><br><br>The page could not be submitted and the operation timed out. Refresh the page so that you can resubmit the information.";
        break;            
    case 6:
        $error_title = getMessage(PERMISSION_DENIED_LBL);
        $error_msg   = getMessage(ILLEGAL_PARAMETER_LBL);
        break;            
    default:
        $error_title = getMessage(UNKNOWN_ERR_MSG);
        $error_msg   = getMessage(UNKNOWN_ERR_LBL);
        break;
}
$page_title .= " - " . $error_title;
?>

<div id="rn_IFrameContent" class="rn_OrderPage">
    <div id="rn_content" class="rn_mostpopular">
        <div class="rn_wrap">

            <h2><?=$error_title;?></h2>
            <p><?=$error_msg;?></p>

        </div>
    </div>
</div>

<?php
namespace Custom\Models;

use RightNow\Connect\v1_3 as RNCPHP;
use RightNow\Connect\v1_3\ConnectAPIError as RNException;
use RightNow\Utils\Framework as Utils;

class OPA_checkpoint_model extends \RightNow\Models\Base
{
    function __construct()
    {
        parent::__construct();
    }

    function getCheckpointId($contact, $initID, $policyModel) 
    {
        // See if there are any Checkpoints for this user's previous encounters with this Interview
        try {
            // Exception thrown if table doesn't exist (Checkpoints unsupported)
            $resultSet = RNCPHP\ROQL::query("SELECT ID FROM OPA.ContactCheckpoint WHERE Contact=" . $contact
                                            . " AND PolicyModel='" . Utils::escapeForSql($policyModel)
                                            . "' AND InitID " . ($initID != '' ? "= " . Utils::escapeForSql($initID) : "IS NULL")
                                            . " ORDER BY CreatedTime DESC LIMIT 1")->next();
            $row = $resultSet->next();
            if ($row != null) {
                $checkpointId = $row['ID'];
                $checkpoint = RNCPHP\OPA\ContactCheckpoint::fetch($checkpointId + 0);
                $checkpointFile = $checkpoint->FileAttachments[0];
                if ($checkpointFile != null) {
                    return $checkpointFile->ID;
                }
            }
        } catch (RNException $e) {
            // no checkpoints, generate only the start session url
        }
        return null;
    }
}

?>
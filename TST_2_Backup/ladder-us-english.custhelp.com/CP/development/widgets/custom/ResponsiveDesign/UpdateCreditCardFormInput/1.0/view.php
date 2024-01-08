<?php /* Originating Release: May 2016 */?>
<rn:block id="top"/>
<? switch ($this->data["js"]["dataType"]):
    case 'Menu':
    case 'Boolean':
    case 'Country':
    case 'NamedIDLabel':
    case 'NamedIDOptList':
    case 'Status':
    case 'Asset':
    case 'bool':
    case 'AssignedSLAInstance':?>
        <rn:widget path="ResponsiveDesign/UpdateCreditCardSelection" sub_id="selection"/>
        <? break;
    case 'Date':
    case 'DateTime':?>
        <rn:widget path="input/DateInput" sub_id="date"/>
        <? break;
    default: ?>
           <!-- <rn:widget path="responsive/UpdateCreditCradText" />-->
		    <rn:widget path="ResponsiveDesign/UpdateCreditCardText" />
        <? break;
endswitch;?>
<rn:block id="bottom"/>
 
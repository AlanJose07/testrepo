<style>

#more-web-products{
display:none;
}


.mobile_mode {
	display:none;
}
.desktop_mode {
	display:block;
}

@media all and (max-width: 768px) { 
	.mobile_mode {
		display: block;
	}
	.desktop_mode {
		display:none;
	}
	.visible-xs {
		display: block !important;
	}
}

</style>

<script>
function showMoreProduct()
{

	var toggleProduct=$('#more_web_prod_link').html();
	toggleProduct=toggleProduct.trim();
	
	
	if(toggleProduct == 'More Tools')
	{
	
		$('#more-web-products').css("display", "block");
		$('#more_web_prod_link').html("Fewer Tools");
		
		$('#more_link_product').addClass(' parent_more_product');
	}
	
	if(toggleProduct=="Fewer Tools")
	{
		$('#more-web-products').css("display", "none");
		$('#more_web_prod_link').html("More Tools");
		
		$('#more_link_product').removeClass(' parent_more_product');
	}
	

}
</script>

<?php
$totalProductCount=count($this->data["attrs"]["product_details"]);
$lessthan9count = ($totalProductCount <= 9) ? $totalProductCount : 9;
$listProductCount=$totalProductCount-9;
$productPointer=0;
?>


<div id="show_web_mode" class="desktop_mode">


<section>
<div class="container-fluid">
<div class="row">
<div class="self-service-desktop">
<h1>Self Service Tools</h1>  
<div class="card-list">

<? 
for($i = 0; $i < $lessthan9count; $i++) 
{ 
		$product = $this->data["attrs"]["product_details"][$i];
		
			if($product['content_type_name']=='text')
			{
			?>
			    
				<div class="card"> <a href="javascript:void(0);" onclick="document.location='<?=$product['content']?>';click_tracking('Service Tools - <?=$product['product_name'];?>')">
				<div class="icon"><img src="/euf/assets/themes/responsive/images/home_selfservice/<?=$product['image_name'];?>"></div>
				<h2><?=$product['product_name'];?></h2>
				</a> 
				<? if($product['tool_tip']!="null"):?>
				<div class="tooltips"><?=$product['tool_tip'];?></div>
				<? endif;?>
				
				</div>
			
			<?
			}
			else
			{
			?>
				<div class="card"> <a href="javascript:void(0);" onclick="showPopup('<?=$product['product_name']?>');click_tracking('Service Tools - <?=$product['product_name'];?>')">
				<div class="icon"><img src="/euf/assets/themes/responsive/images/home_selfservice/<?=$product['image_name'];?>"></div>
				<h2><?=$product['product_name'];?></h2>
				</a> 
				<? if($product['tool_tip']!="null"):?>
				<div class="tooltips"><?=$product['tool_tip'];?></div>
				<? endif;?>
				</div>
				
			<?
			}
			$productPointer++;
		
}
if($listProductCount>0)
{
?>
<div id="more_link_product" class="more_categ_display">
<a  onclick="showMoreProduct()" id="more_web_prod_link"> More Tools </a>
</div>
<div id="more-web-products">
<?php

for($i = 0; $i < $listProductCount; $i++) 
{ 
		    $product = $this->data["attrs"]["product_details"][$productPointer];
			if($product['content_type_name']=='text')
			{
			?>
			<div class="card">  <a href="javascript:void(0);" onclick="document.location='<?=$product['content']?>';click_tracking('Service Tools - <?=$product['product_name'];?>')">
				<div class="icon"><img src="/euf/assets/themes/responsive/images/home_selfservice/<?=$product['image_name'];?>"></div>
				<h2><?=$product['product_name'];?></h2>
				</a> 
				
				</div>
			<?
			}
			else
			{
			?>
			<div class="card">  <a href="javascript:void(0);" onclick="showPopup('<?=$product['product_name']?>');click_tracking('Service Tools - <?=$product['product_name'];?>')">
				<div class="icon"><img src="/euf/assets/themes/responsive/images/home_selfservice/<?=$product['image_name'];?>"></div>
				<h2><?=$product['product_name'];?></h2>
				</a> 
			
				</div>
			<?
			}
			
			$productPointer++;
		
}
?>
</div>
<?php


}

?>

</div>
</div>
</div>
</div>
</section>


</div>

<div id="show_mob_mode" class="mobile_mode">

<? $total_count=count($this->data["attrs"]["product_details"]);
  // $list_count=$total_count-6; //comment this line since more tools click in not needed in mobile now
   $k=0;
?>

<section>
<div class="container-fluid">    
<div class="row">
<div class="self-service">
<h1>Self Service Tools </h1>
<div class="card-list">

<? for($i = 0; $i < $total_count; $i++)  //changed $i<6 to current line
{ 
		    $product = $this->data["attrs"]["product_details"][$i];
			if($product['content_type_name']=='text')
			{
			?>
			
			<div class="card"> <a href="javascript:void(0);" onclick="document.location='<?=$product['content']?>';click_tracking('Service Tools - <?=$product['product_name'];?>')">
				<div class="icon"><img src="/euf/assets/themes/responsive/images/home_selfservice/<?=$product['image_name'];?>"></div>
				<h2><?=$product['product_name'];?></h2>
				</a> 
				</div>
				
			<?
			}
			else
			{
			?>
			<div class="card"> <a href="javascript:void(0);" onclick="showPopup('<?=$product['product_name']?>');click_tracking('Service Tools - <?=$product['product_name'];?>')">
				<div class="icon"><img src="/euf/assets/themes/responsive/images/home_selfservice/<?=$product['image_name'];?>"></div>
				<h2><?=$product['product_name'];?></h2>
				</a> 
				</div>
			<?
			}
			
			$k++;
		
}
?>
<!--</div>--><!-- card-list-->
<!--</div>
</div>
</div>
</section>-->
<?
if($list_count>0)
{
?>
<div class="visible-xs text-center more-products">
<button data-toggle="collapse" data-target="#balance-product" class="more-product" onclick="change()" id="more_prod_link"> More Tools </button>
<div class="product-more collapse" id="balance-product">
<?

for($i=0; $i<$list_count;$i++)
{
            $product = $this->data["attrs"]["product_details"][$k];
			if($product['content_type_name']=='text')
			{
			?>
			<div class="col-xs-12" onclick="document.location='<?=$product['content']?>';click_tracking('Service Tools - <?=$product['product_name'];?>')">
			<?
			}
			else                 
			{
			?>
			<div class="col-xs-12" onclick="showPopup('<?=$product['product_name']?>');click_tracking('Service Tools - <?=$product['product_name'];?>')">
			<?
			}
			?>
			<?=$product['product_name'];?>         
			</div>
			<?
$k++;
}
?>
</div>
</div><!--visible-xs -->
<?
}
?>
</div><!-- card-list-->
</div>
</div>
</div>
</section>



</div><!--show_mob_mode -->


 
<!--ORDER  STATUS-->

<div id="myModal" class="modal View_Modal pop-modal">

 
  <div class="modal-content Bb_modal">
  	<div class="model-inner">
    <span class="close" id="orderClose" >X</span>
	 <div class="cmp_logo"><img src="/euf/assets/images/beachbody_logo_site.png"></div>
	<div id="headingOrder">ORDER STATUS</div>    
	
	 <div class="info-text" id="odrSub"  style="display:block; visibility:visible">
	 <p>*Coaches-Coach Online Office results are <br>updated more frequently. Please visit the Coach <br>Online Office for timely updates.</p>
	 </div> 
	 
	 
	<div id="invalid_data" name="invalid_phone"></div>
	  
	<div id="valid_data">
	</div>  
	       
	<div id="errors"></div>
	<div id="display_chat"></div>
    
  <form id="rn_QuestionSubmit" method="post">
  
        <div id="rn_ErrorLocation"></div>
		 	
        <div class="form-dv">
        
       		     <div class="left-box">
                     <rn:widget path="custom/ResponsiveDesign/countrySelectionInput_OrderStatus" name="Contact.Address.Country" required="false" label_input = "Country/Pais/Pays" default_value='1' />
                </div>
          
		  
			  <div class="left-box">
                    <rn:widget path="custom/ResponsiveDesign/TextInputCO" name="CO.order_tracking_new.order_number"
       		          label_input="Order Number" required="false"/>
                </div>
                
                   
                <div class="mid-box">
                 <span class="text-1">Step 1:</span>
               <span class="text-center"> -or- </span></div>
                 
               <div class="right-box">
              	 <rn:widget path="custom/ResponsiveDesign/TextInputCO" name="CO.order_tracking_new.email" 
               	  label_input="Email" required="false"/>    
                </div>
             
        </div>
        
        
        <div class="dvd-Dv">
        	<p> </p>
        </div>
        
            <div class="form-dv"> 
            
                <div class="center-box">
                <div class="text-2">Step 2:</div>
                	<rn:widget path="custom/ResponsiveDesign/TextInputCO" name="CO.order_tracking_new.zip_code" 
               		label_input="Zip/Postal Code" required="false"/>
                     
                </div>
                 
                            
                <div class="info-text"><p>*Enter email and zip / post / postal code of shipping address.</p></div>
                
               
                 
			</div>
			 <div class="model-footer">
                   
					    <rn:widget path="custom/ResponsiveDesign/FormSubmitOrderStatus" error_location="rn_ErrorLocation" interface_type="true"/>
                      
              </div>
			
			
			
		<input type="text" id="email_instance" style="display:none"/>
		<input type="text" id="zip_code_instance" style="display:none"/>
		<input type="text" id="order_number_instance" style="display:none"/>
				
        </form>
		
		
  </div>
</div>
</div>

<!--ORDER  STATUS-->

<!--CREDIT CARD UPDATE-->

<div id="myModal_ccu" class="modal View_Modal pop-modal card_popup">

  <!-- Modal content -->
  <div class="modal-content Bb_modal">
  	<div class="model-inner">
   <!-- <span class="close" onClick="closePopUp()"  style="display: none">X</span>-->
	<span class="close" onClick="closePopUp()">X</span>
	 <div class="cmp_logo"><img src="/euf/assets/images/beachbody_logo_site.png"></div>
	<div id="heading">Credit Card Update</div>
	

	
	<!-- <div class="info-text" id="odrSub"  style="display:block; visibility:visible">
	 <p>*Coaches-Coach Online Office results are <br>updated more frequently. Please visit the Coach <br>Online Office for timely updates.</p>
	 </div>-->
	 
	  
	<div id="invalid_data" name="invalid_phone"></div>
	  
	<div id="valid_data_vv">
	</div>  
	       
	<div id="errors"></div>
	<div id="display_chat"></div>
    <div id="form123"> 
		<form id="rn_QuestionSubmit_vv" method="post">
   
        <div id="rn_ErrorLocation_vv"></div>
        
        
        
			
        <div class="form-dv">
        
       		          		
			<div class="center-box">
                <div class="text-2">Step 1:</div>
                	<rn:widget path="custom/ResponsiveDesign/TextInputCOCreditCardUpdate" name="CO.order_tracking_new.email" 
               	  label_input="Email" required="false"/>
                     
                </div>	
		       
        </div>
		
		 
        
        <div class="dvd-Dv">
        	<p> <!-- enter your order number below --></p>
        </div>
        
            <div class="form-dv"> 
            
                <div class="center-box">
                <div class="text-2">Step 2:</div>
                	<rn:widget path="custom/ResponsiveDesign/TextInputCOCreditCardUpdate" name="CO.order_tracking_new.zip_code" 
               		label_input="Zip / Postal Code" required="false"/>
                     
                </div>
                
                  
                            
                <!--<div class="info-text"><p>*Enter email and zip / postal code of Shipping Address.</p></div>-->
                		
                  
			</div>
			<div class="model-footer">
                      
                      <rn:widget path="custom/ResponsiveDesign/recordSearchSubmit" error_location="rn_ErrorLocation_vv" interface_type="true"/> 
                </div>
			
			
		<intput type="text" id="email_instance_cc" style="display:none"/>
		<intput type="text" id="zip_code_instance_cc" style="display:none"/>
	
				
        </form>
	</div>
	<div id="responseMessage_cc"></div>
	<div id="closeButton" style="display:none !important"> <input type="button" name="close" value="CLOSE" onClick="closePopUp()"></div>
	<div id="formdisplay" style="display: none">
		
		<form id="form" onsubmit="return false">
				
				<div id="displaynote" >
					<h4 style="color: red">Please expect these changes to take up to 24 hours to be applied to your account.</h4>
				</div>
				<br/><br/>
				<div class="clsCardTypes">
						
    				<div class="clsCardDetails"><p>Please enter your new card details</p>
      				  <img src="/euf/assets/images/cardTypes.png"/>
					</div>
					
   				 </div><br/><br/>
				 
				 
   				 <div id="rn_ErrorLocation_vv" style="color:red"></div>
   				 
				
				
				<!--<rn:widget path="input/UpdateCreditCardFormInput" name="Update_Acnt.Update_Account_Info.full_name" label="Name on the card"/>-->
				
				<div id="firstName" style="display: none">	
				<rn:widget path="input/TextInput" name="Contact.Name.First" required="true" label="First Name" label_input="First name"/><br/>
				</div>
				<div id="lastName" style="display: none">	
				<rn:widget path="input/TextInput" name="Contact.Name.Last" required="true" label="Last Name" label_input="Last name"/>
				</div><br/><br/><br/>
				<!---------------------------------Updated by jithin(below code) select credit card type based on country selection------------------------------------------>
				<div class="country">
				<rn:widget path="custom/ResponsiveDesign/countrySelectionInput_ccu" name="Contact.Address.Country" required="true" label_input = "Country" default_value='1'/>
				</div>
				
				<div class="card_type" id="test">		  		
				<rn:widget path="custom/ResponsiveDesign/UpdateCreditCardFormInput" name="Update_Acnt.Update_Account_Info.credit_card_type" required="true" label_input="Credit Card Type"/>
				</div>
				<!---------------------------------Updated by jithin(above code) select credit card type based on country selection------------------------------------------>
				<div>	
				<rn:widget path="ResponsiveDesign/UpdateCreditCardFormInput" name="Update_Acnt.Update_Account_Info.full_name" required="true" label="Name on the card"/><br/>
				</div>
				<div class="">
				<div class=""><!--credit_card_number-->
				<rn:widget path="ResponsiveDesign/UpdateCreditCardFormInput" name="Update_Acnt.Update_Account_Info.credit_card_number" required="true" label="Credit card number"/>
				</div>
				<!--<div class="credit_card_cvv">
				<rn:widget path="ResponsiveDesign/UpdateCreditCardFormInput" name="Update_Acnt.Update_Account_Info.security_code" required="true" label="CVV / CSC"/><br/>
				</div>-->
				</div><br/>
				<div class="credit_card_expiry">
				<rn:widget path="ResponsiveDesign/UpdateCreditCardFormInput" name="Update_Acnt.Update_Account_Info.exp_month" required="true" label="Expiration"/>
				<div class="cvv year">
				<rn:widget path="ResponsiveDesign/UpdateCreditCardFormInput" name="Update_Acnt.Update_Account_Info.exp_year" required="true" label=""/><br/>
				</div>
				</div><br/><br/>
				

				<br/><br/><br/>
				<div  class="clsCredirCardLbl">
				<br/>
					Enter your credit card billing address
				</div>        
				<br/><br/>
				
				<div>
				<rn:widget path="ResponsiveDesign/UpdateCreditCardFormInput" name="Update_Acnt.Update_Account_Info.bill_to_address" required="true" label="Address line1"/><br/>
				</div>
				<div>
				<rn:widget path="ResponsiveDesign/UpdateCreditCardFormInput" name="Update_Acnt.Update_Account_Info.apt_suite" label="Address line2"/>
				</div>
				<div class="">
					<div class="city">
					<rn:widget path="ResponsiveDesign/UpdateCreditCardFormInput" name="Update_Acnt.Update_Account_Info.bill_to_city" required="true" label="City/Town"/>
					</div>
					<div class="state" id="state_req">
					<!--<rn:widget path="input/SelectionInput" name="Contact.Address.StateOrProvince" label_input="State / Province" required="true" required="false" />-->
					
					<rn:widget path="custom/ResponsiveDesign/SelectionInputState" name="Contact.Address.StateOrProvince" label_input="State / Province" required="true" required="false" />
					</div>
				</div>
				<!--<rn:widget path="input/UpdateCreditCardFormInput" name="Update_Acnt.Update_Account_Info.bill_to_state_province" label="State"/>-->
				<div class="">
					<div class="zip">
					<rn:widget path="ResponsiveDesign/UpdateCreditCardFormInput" name="Update_Acnt.Update_Account_Info.bill_to_postal_code" required="true" label="Zip / Post / Postal code"/>
					</div>
					<!--<div class="country">
					<rn:widget path="custom/input/countrySelectionInput_ccu" name="Contact.Address.Country" required="true" label_input = "Country"/>
					</div>-->
				</div>
				
				<div>
				<rn:widget path="custom/ResponsiveDesign/UpdateCreditCardFormSubmit" name="" required="false" />
				</div>

		</form>
	</div>

  </div>
</div>
</div>
<!--CREDIT CARD UPDATE-->





<script>
function change() // no ';' here -- "i know !"
{
    var button=document.getElementById("more_prod_link");
    if (button)
    { 
      if (button.childNodes[0])
      { 
		var child = String(button.childNodes[0].nodeValue);
		child = child.replace(/^\s+|\s+$/gm,'');

	    if(child == "More Tools")//More Tools
		{
		  button.childNodes[0].nodeValue="Fewer Tools";
		  $('#more_prod_link').addClass(' parent_more_category');
		}
		else
		{ 
		  button.childNodes[0].nodeValue="More Tools";
		  $('#more_prod_link').removeClass(' parent_more_category');
		}      
        
      }    
      
    }
  
}
</script>   





	

	

		
	<script>
	
	

//========================ORDER STATUS========================//	
	
// When the user clicks on <span> (x), close the modal
var modal = document.getElementById('myModal');
//var span = document.getElementsByClassName("close")[0];

var span = document.getElementById('orderClose');
	
	
	
span.onclick = function() {
	
	
document.getElementsByName("Contact.Address.Country")[0].value=1;
	
document.getElementById("rn_QuestionSubmit").style.display = "block";

var email_label = 'rn_'+document.getElementById("email_instance").value+'_Label';
var zip_label = 'rn_'+document.getElementById("zip_code_instance").value+'_Label';
var order_label = 'rn_'+document.getElementById("order_number_instance").value+'_Label';

/*
document.getElementById(email_label).className = "rn_Label";
document.getElementById(zip_label).className = "rn_Label";
document.getElementById(order_label).className = "rn_Label";
*/

document.getElementById("errors").innerHTML = "";
document.getElementById("rn_ErrorLocation").innerHTML = "";

document.getElementById("rn_ErrorLocation").className = "";
document.getElementById("valid_data").innerHTML="";

document.getElementById("display_chat").innerHTML = "";

document.getElementsByName("CO.order_tracking_new.email")[0].value ="";
document.getElementsByName("CO.order_tracking_new.email")[0].className="rn_Text";

document.getElementsByName("CO.order_tracking_new.zip_code")[0].value="";
document.getElementsByName("CO.order_tracking_new.zip_code")[0].className="rn_Text";


document.getElementsByName("CO.order_tracking_new.order_number")[0].value="";
document.getElementsByName("CO.order_tracking_new.order_number")[0].className="rn_Text";




modal.style.display = "none";
	
document.getElementById('odrSub').style.display="block";
document.getElementById('odrSub').style.visibility="visible";	
	
}

//========================ORDER STATUS========================//

//========================CREDIT CARD UPDATE==================//
function redirectNextPage_vv() {

  
   //track_credit_card_update_clicks('next');

	$("div #rn_ErrorLocation_vv").hide();
	//$("#responseMessage").hide();

	document.getElementById("valid_data_vv").style.display = "none";
	document.getElementById("rn_QuestionSubmit_vv").style.display = "none";	

	document.getElementById("formdisplay").style.display = "block";
	
		
	//Edited by jithin[below code] 
    document.getElementsByName("Contact.Address.Country")[1].value=1;
	document.getElementsByName('Contact.Address.StateOrProvince')[0].removeAttribute("disabled");
	var children = document.getElementById("state_req").children;
	//document.getElementById(children[0].id+"_Label")['childNodes'][0]['data']="State / Province";
	document.getElementById(children[0].id+"_Label")['innerHTML']="State / Province<span class='rn_Required'> *</span>";
	//console.log(document.getElementById(children[0].id+"_Label"));
	//----------------------------ajax call for creating the state corresponding to country US----------------
		var c_id = document.getElementsByName("Contact.Address.Country")[1].value;
 	 	$.ajax({
	            url:"/cc/AjaxCustom1/countrybasedstateorprovince",
	            data:{ country_id: c_id}, 
	            type:'POST',
	            dataType:'json'
	        }).done(function(response) {
				var children = document.getElementById("state_req").children;	
			    document.getElementById(children[0].id+"_Contact.Address.StateOrProvince").innerHTML = '';
				var select= document.getElementById(children[0].id+"_Contact.Address.StateOrProvince");
				var option = document.createElement('option');
				option.value = "";
				option.text  = "--";  
				select.add(option);
		        for(var i=0;i<response.length;i++) {
				var option = document.createElement('option');
				option.value = response[i].ID;
				option.text  = response[i].Name;  
				select.add(option);
	        	}
	          });
			  
			  /*.error(function(response) {
	            alert("got error");
	           
       	 });*/
		 
		 $.ajax({
	            url:"/cc/AjaxCustom1/screenCardTypesByCountry",
	            data:{ country_id: c_id}, 
	            type:'POST',
	            dataType:'json'
	        }).done(function(response) {
				var children = document.getElementById("test").children;
                document.getElementById(children[1].id).innerHTML='';
				var select= document.getElementById(children[1].id);
				var option = document.createElement('option');
				option.value = "";
				option.text  = "--";  
				select.add(option);
		        for(var i=0;i<response.length;i++) {
				var option = document.createElement('option');
				option.value = response[i].ID;
				option.text  = response[i].LookupName;  
				select.add(option);
	        	}
	          });
			  /*.error(function(response) {
	            alert("got error");
	           
       	 });*/
	//----------------------------------------------------------------------------------------------
	
	  
	//Edited by jithin[above code]
	
	
	document.getElementById("LoadingIconMain").setAttribute("class", "rn_Hidden");
	
	document.getElementsByName("form3_submitMain")[0].removeAttribute("disabled");
	

	$("div #heading").empty();
	$("div #rn_ErrorLocation_vv").empty();
	
	


	//document.getElementById('myModal_ccu').style.display = "none";
	
	
	//----------------------------ajax call for checking whether the contact exists or not----------------
	
	
		var fdata = {};
		//console.log(JSON.stringify($("#rn_QuestionSubmit_vv").serializeArray()));
  		fdata["form"] = JSON.stringify($("#rn_QuestionSubmit_vv").serializeArray());
  		
 	 	$.ajax({
	            url:"/cc/CreditCardUpdate/UpdateCreditCard1",
	            data:fdata, 
	            type:'POST',
	            dataType:'json'
	        }).done(function(response) {
	        	//console.log(response);
				
							 
	        	if(response.result.count > 0){
	        		document.getElementById("firstName").style.display="none";
	        		document.getElementById("lastName").style.display="none";

	        		
	        	}else{
	        		document.getElementById("firstName").style.display="block";
	        		document.getElementById("lastName").style.display="block";



	        	}
	          });
			  /*.error(function(response) {
	            alert("got error");
	           
       	 });*/
	
	
	//----------------------------------------------------------------------------------------------
	
}


function closePopUp()
{
	
	document.getElementById('closeButton').style.display = "none";
	
	document.getElementsByName("Update_Acnt.Update_Account_Info.full_name")[0].value="";
	document.getElementsByName("Update_Acnt.Update_Account_Info.credit_card_number")[0].value="";
	//document.getElementsByName("Update_Acnt.Update_Account_Info.security_code")[0].value="";
	document.getElementsByName("Update_Acnt.Update_Account_Info.exp_year")[0].value="";
	document.getElementsByName("Update_Acnt.Update_Account_Info.exp_month")[0].value="";
	document.getElementsByName("Contact.Address.StateOrProvince")[0].value="";
	document.getElementsByName("Contact.Address.Country")[0].value=1;
	document.getElementsByName("Update_Acnt.Update_Account_Info.bill_to_address")[0].value="";
	document.getElementsByName("Update_Acnt.Update_Account_Info.apt_suite")[0].value="";
	document.getElementsByName("Update_Acnt.Update_Account_Info.bill_to_city")[0].value="";
	document.getElementsByName("Update_Acnt.Update_Account_Info.bill_to_postal_code")[0].value="";
	
	
	
	$("#responseMessage_cc").hide();
	document.getElementById('myModal_ccu').style.display = "none";
	
	
document.getElementById("rn_QuestionSubmit_vv").style.display = "block";

var email_label_cc = 'rn_'+document.getElementById("email_instance_cc").value+'_Label';
var zip_label_cc = 'rn_'+document.getElementById("zip_code_instance_cc").value+'_Label';

/*
document.getElementById(email_label_cc).className = "rn_Label";
document.getElementById(zip_label_cc).className = "rn_Label";
*/


document.getElementById("errors").innerHTML = "";
document.getElementById("rn_ErrorLocation_vv").innerHTML = "";

document.getElementById("rn_ErrorLocation_vv").className = "";
document.getElementById("valid_data_vv").innerHTML="";

document.getElementById("display_chat").innerHTML = "";


document.getElementsByName("CO.order_tracking_new.email")[1].value ="";
document.getElementsByName("CO.order_tracking_new.email")[1].className="rn_Text";

document.getElementsByName("CO.order_tracking_new.zip_code")[1].value="";
document.getElementsByName("CO.order_tracking_new.zip_code")[1].className="rn_Text";


}
//========================CREDIT CARD UPDATE==================//

	
	function showPopup(product_name)
	{
	
		if(product_name=="Check Order Status")
		{
			var modal = document.getElementById('myModal');
			modal.style.display = "block";
			
		}
		if(product_name=="Update Credit Card")
		{
			$("#responseMessage").hide();
			$("div #heading").html("Credit Card Update");
			document.getElementById("valid_data_vv").innerHTML = "";
			document.getElementById("rn_ErrorLocation_vv").style.display = "none";
			document.getElementById("valid_data_vv").style.display = "block";
			document.getElementById('myModal_ccu').style.display = "block";
			document.getElementById("formdisplay").style.display = "none";
			
		}
		
	}
	
	
	
	
	function test1(c)   
	{ 
	  if(c=="1717"){ 
	  $("#orderstatus").modal('hide');     
	  }
	  if(c=="1720"){ 
	  $("#creditcard").modal('hide');         
	  }
	}
	

	</script>
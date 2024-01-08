<rn:meta title="#rn:msg:SHP_TITLE_HDG#" template="standard_responsive_bb.php" clickstream="signing_intermediate"/>
<script src="/euf/assets/themes/responsive/js/jquery.min.js">
$(".full-wrapper").fadeIn(100);
</script>
<style>
.loader {
  border: 7px solid #f3f3f3; /* Light grey */
  border-radius: 50%;
  border-top: 7px solid #555;
  width: 90px;
  height: 90px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.centered {
    position: fixed;
    top: 36%;
    left: 46%;
    transform: translate(-50%, -50%);
    transform: -webkit-translate(-50%, -50%);
    transform: -moz-translate(-50%, -50%);
    transform: -ms-translate(-50%, -50%);
    color:darkred;
  }
.full-wrapper {
   position: absolute;
   top: 0;
   left: 0;
   right: 0;
   bottom: 0;
   opacity: 0.80;
   background: #aaa;
   z-index: 10;
   pointer-events: none;
}  
</style>
<? $code_verifier = $this->session->getSessionData('code_verifier');?>
<? $requestToken = $this->session->getSessionData('requestToken');?>
<? header('Access-Control-Allow-Origin: *');  ?>
<div class="loader centered"></div>

<script>
$( document ).ready(function() {
var code_verifier = '<?php echo $code_verifier ?>';
var requestToken = '<?php echo $requestToken ?>';

var settings = {
  "url": "https://loginuat.beachbody.com/03ed5554-4840-327e-9346-6e5c74000000/login/token",
  "method": "POST",
  "timeout": 0,
  "headers": {
    "Content-Type": "application/x-www-form-urlencoded"
  },
  "data": {
    "code": requestToken,
    "code_verifier": code_verifier,
    "client_id": "19ccd759-6180-4bdd-aea6-49629f5ffe24",
    "grant_type": "authorization_code",
    "redirect_uri": "https://us-english--tst2.custhelp.com/cc/openlogin/oauth/callback/beachbody"
  }
};

$.ajax(settings).done(function (response) {
  //console.log(response);
  //var myJSON = JSON.stringify(response);
  //alert(myJSON);
  var saveData = $.ajax({
      type: 'POST',
      url: "/cc/bbresponsivecontroller/tokenstorage",
      data: response,
      dataType: "text",
	  async: false,
	  error: function() {
	  	window.location.href = "/app/errorpage";
	  },

      success: function(resultData) {
		window.location.href = "/cc/Openlogin/callbackBeachbodyRetry";
	  
	  }
});

})
.fail(function() {
    window.location.href = "/app/errorpage";
  });

});

</script>



<rn:meta title="#rn:msg:SHP_TITLE_HDG#" template="standard_responsive_bb.php" clickstream="home"/>
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<style>
.rn_PageNotFound #title_support_pagenotfound {
    font-size: 18px !important; 
    font-weight: 300;
    margin: 0;
    padding: 24px 0 10px 3px;
}
.rn_PageNotFound #title_support_pagenotfound h2 
{
	font-size:25px !important;
}
.rn_PageNotFound #title_support_pagenotfound a
{
	color: #1378db; !important;
}
footer {
    background-color: #282b41;
    padding: 20px 0;
    text-align: center;
    position: relative;
    bottom: 0;
    left: 0;
    width: 100%;
}
.rn_PageNotFound #title_support_pagenotfound{
	padding-bottom:30px;
	min-height:200px;
}
.c-dropdown__list{
	max-width:100%;
}
@media(max-width:480px){
	.content-wrapper {
		padding: 20px 0;
		position: absolute;
		height: calc(100% - 115px);
	}
	.pos-maker {
		position: relative;
		z-index: 9;
	}
	footer {
		position: absolute;
		bottom: -60px;
	}
	#rn_DevelopmentHeader {
		width: 100%;
		margin-left: 0 !important;
		left: 0 !important;
	}
	#rn_DevelopmentHeader .rn_DevelopmentHeaderPanelContainer {
		border: 0;
		left: 0 !important;
		width: 100% !important;
	}
	.v-scroll{
		overflow: hidden;
	}
	.full-wrapper{
		margin-bottom:0px;
	}
}
@media(max-width:767px){
	#rn_DevelopmentHeader {
		width: 100%;
		margin-left: 0 !important;
		left: 0 !important;
	}
	#rn_DevelopmentHeader .rn_DevelopmentHeaderPanelContainer {
		border: 0;
		left: 0 !important;
		width: 100% !important;
	}
	.push{
		display:none;
	}
	.full-wrapper{
		margin-bottom:0px;
	}
}
/* Portrait */
@media only screen 
  and (min-device-width: 375px) 
  and (max-device-width: 667px) 
  and (-webkit-min-device-pixel-ratio: 2)
  and (orientation: portrait) { 
	footer {
		position: absolute;
		bottom: -60px;
	}
}
@media
only screen and (-webkit-min-device-pixel-ratio: 2)      and (min-width: 375px),
only screen and (   min--moz-device-pixel-ratio: 2)      and (min-width: 375px),
only screen and (     -o-min-device-pixel-ratio: 2/1)    and (min-width: 375px),
only screen and (        min-device-pixel-ratio: 2)      and (min-width: 375px),
only screen and (                min-resolution: 192dpi) and (min-width: 375px),
only screen and (                min-resolution: 2dppx)  and (min-width: 375px) { 

	footer {
		position: absolute;
		bottom: -150px;
	}
	.full-wrapper{
		margin-bottom:0px;
	}

}
/* Portrait */
@media only screen 
  and (min-device-width: 393px) 
  and (max-device-width: 786px) 
  and (orientation: portrait){ 
	footer {
		position: absolute;
		bottom: -60px;
	}
}
@media only screen 
  and (min-device-width: 1080) 
  and (max-device-width: 540px) 
  and (orientation: landscape){ 
	footer {
		position: absolute;
		bottom: 0px;
	}
}
footer.fixed-footer{
	position:fixed !important;
	bottom:0 !important;
}
.full-wrapper.nm{
	margin-botttom:0 !important;
}
</style>

<div class="pos-maker">
	<div id="rn_PageNotFound" class="rn_PageNotFound">
		<div id="title_support_pagenotfound" style="display:block; text-align:center;margin-top: 10px;">
			<h2> La page que vous recherchez n'existe plus.</h2>
			Visitez notre <a href='/app/home'>page d'accueil du support Beachbody.</a>		
		</div>	
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
	$(document).ready(function(){
		console.log('yes');
		var isiPad = navigator.userAgent.toLowerCase().indexOf("ipad");
		if(isiPad > -1) {
			$('footer').addClass('fixed-footer');	
			$('.full-wrapper').addClass('nm');
		}			
	});
</script>
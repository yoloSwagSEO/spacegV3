<html>
<head>
<title>{-title-}</title>

	<link rel="apple-touch-icon" href="styles/images/icoipad.png" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<link rel="apple-touch-startup-image" href="styles/images/startipad.png" />
	<meta name="viewport" content="user-scalable=yes, width=device-width" />


{-favi-}

<link rel="stylesheet" href="styles/css/colorbox.css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    {-style-}
		<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>
		<script src="js/jquery.colorbox-min.js"></script>
		<script>
			function showGouvernementType(gouv){
				var gouvString = new Array('Gouv 0','Gouv 1','Gouv 2','Gouv 3','Gouv 4','Gouv 5','Gouv 6');
				var returnString = '';
				
				returnString = gouvString[gouv];
				
				return returnString;
			}
			$(document).ready(function(){
                            
                                
				$("#tabs_banque").tabs();
                                
				$(".infoshow").click(function(){
					$(this).colorbox();
				});
				
				metalS = $('#top_metal_rate').val()/3600;
				cristalS = $('#top_crystal_rate').val()/3600;
				deutS = $('#top_deut_rate').val()/3600;
                                credS = $('#top_cred_rate').val()/3600;
				setInterval(function(){

					$('#total_metal').val(parseFloat($('#total_metal').val())+parseFloat(metalS));
					$('#total_crystal').val(parseFloat($('#total_crystal').val())+parseFloat(cristalS));
					$('#total_deut').val(parseFloat($('#total_deut').val())+parseFloat(deutS));
                                        $('#total_credit').val(parseFloat($('#total_credit').val())+parseFloat(credS));
					$('#metal_val').text(Math.round($('#total_metal').val()).toLocaleString());
					$('#crystal_val').text(Math.round($('#total_crystal').val()).toLocaleString());
					$('#deut_val').text(Math.round($('#total_deut').val()).toLocaleString());
                                        $('#cred_val').text(Math.round($('#total_credit').val()).toLocaleString());
				},1000);
				
				$('.tooltipbat').tooltip({
					show: null, // show immediately 
					position: { my: "left top", at: "right top" },
					content: function(){
						var element = $( this );
						var html = $('#itemm_info_'+element.attr('data-id')).html();
						
						return html+element.attr('title');
					}, //from params
					hide: { effect: "" },
					close: function(event, ui){
						ui.tooltip.hover(
							function () {
								$(this).stop(true).fadeTo(400, 1); 
								
							},
							function () {
								$(this).fadeOut("400", function(){
									$(this).remove(); 
								})
							}
						);
					}  
				});

				$('.coloCh').on('click',function(event){
					$('.coloCh').addClass('active');
					$('.sectorsCh').removeClass('active');
                    $('.menuColo').show();
                    $('.menuSecteur').hide();
				});
				$('.sectorsCh').on('click',function(event){
					$('.sectorsCh').addClass('active');
					$('.coloCh').removeClass('active');
					$('.menuColo').hide();
                    $('.menuSecteur').show();
				});
				$('.tooltipship').tooltip({
					show: null, // show immediately 
					position: { my: "left top", at: "right top" },
					content: function(){
						var element = $( this );
						var html = $('#itemm_info_'+element.attr('data-id')).html();
						
						return html+element.attr('title');
					}, //from params
					hide: { effect: "" },
					close: function(event, ui){
						ui.tooltip.hover(
							function () {
								$(this).stop(true).fadeTo(400, 1); 
								
							},
							function () {
								$(this).fadeOut("400", function(){
									$(this).remove(); 
								})
							}
						);
					}  
				});

				$("a").click(function (event) {
					if (  (navigator.standalone)&&((navigator.userAgent.indexOf("iPhone") > -1) || (navigator.userAgent.indexOf("iPad") > -1))) {
							// On bloque les liens quand on est en mode web-app sur iPhone et iPad
						if($(this).hasClass('message')||$(this).hasClass('infoshow')){
						
						}else{
							event.preventDefault();
							// On recâble le lien à la main grâce à window.location
							window.location = $(this).attr("href");
						}
					}
				});
			});
		</script>

{-meta-}
<!-- <link type="text/css" href="/cometchat/cometchatcss.php" rel="stylesheet" charset="utf-8"> -->

<link type="text/css" href="styles/skins/xgproyect/jquery-ui.css" rel="stylesheet">
<!-- <script type="text/javascript" src="/cometchat/cometchatjs.php" charset="utf-8"></script> -->
</head>
<body class="{class}" onLoad="" onUnload="">
<div class="container">
<!-- <h1 style="color:red">Travaux sur la liste des planete</h1> -->
{-postBody-}




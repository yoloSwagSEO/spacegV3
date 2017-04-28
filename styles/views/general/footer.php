
<script>
jQuery(document).ready(function($){
    $('.itemR-planete').click(function(){
		if($(this).hasClass('close')){
			$(this).addClass('open');
			$(this).animate({
				width: "234px",
			}, 500 );
			$(this).css('z-index',1);
			$(this).removeClass('close');
		}else{
			$(this).addClass('close');
			$(this).animate({
				width: "35px",
			}, 500 );
			$(this).css('z-index',0);
			$(this).removeClass('open');
		}

	    
	}
	//,function(){
    //    var that =  $(this);
    // 
    //    	   that.animate({
    //    		    width: "35px",
    //    		  }, 500 );
    //    	   that.css('z-index',0);
    //
	// 
	//}
	
	
	);
	
	$('.iframeShow').colorbox({iframe:true,innerWidth:'800px',height:'600px'});
});

</script>
<div id='messagebox'>
<center>
</center>
</div>
<div id='errorbox'>
<center>
</center>
</div>
<div class="clear"></div>
</div><!-- end div#game -->

<script src="js/fm.scrollator.jquery.js"></script>
<link rel="stylesheet" href="styles/css/fm.scrollator.jquery.css">
<script>
$(function () {
$('#right_Menu2').scrollator();
});
</script>
</div>
</div>
</body>
<html>
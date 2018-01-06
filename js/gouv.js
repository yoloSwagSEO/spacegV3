function showGouvernementType(gouv){
	var gouvString = new Array('Gouv 0','Gouv 1','Gouv 2','Gouv 3','Gouv 4','Gouv 5','Gouv 6');
	var returnString = '';
	
	returnString = gouvString[gouv];
	return returnString;
}

function changeGouvernementText(val){
	if(typeof val == 'undefined'){
		var gouvernementString = showGouvernementType($( "#sliderGouv1" ).slider("value"));
	}else{
		var gouvernementString = val;
	}
	$('.GouvName').html(gouvernementString); 
}
$(document).ready(function($){
	$( "#sliderGouv1" ).slider({
		value:2,
		min: 0,
		max: 4,
		step: 1,
		slide: function( event, ui ) {
			//$( "#amount" ).val( "$" + ui.value );
			console.log(showGouvernementType(ui.value));
			changeGouvernementText(showGouvernementType(ui.value)); 
		}
	});
	
	$( "#sliderGouv2" ).slider({
		value:250,
		min: 0,
		max: 500,
		step: 50,
		slide: function( event, ui ) {
			//$( "#amount" ).val( "$" + ui.value );
			console.log(ui.value);
		}
	});
	
	$( "#sliderGouv3" ).slider({
		value:250,
		min: 0,
		max: 500,
		step: 50,
		slide: function( event, ui ) {
			//$( "#amount" ).val( "$" + ui.value );
			console.log(ui.value);
		}
	});
	changeGouvernementText();

	$('.Btabs').on('click',function(){
		var id = $(this).attr('data-tabs');

		$('.sTabs').each(function(){
			$(this).hide();
		});
		$('#tabs-'+id).show();
	});
});
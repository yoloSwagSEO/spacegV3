jQuery(document).ready(function($){
	$('#speed_factor').change(function(){
		var dure = Math.round(((35000 / $(this).val() * Math.sqrt($('#distance').text() * 10 / $('#vitessemax').text()) + 10) / $('#speedfactor').val() ));
		var s = dure	%60;
		var m = Math.floor((dure	%3600)/60);
		var h = Math.floor((dure	%86400)/3600);
		$('#duree').html(h+':'+m+':'+s);
		
		var consumption = 0;
		for (i = 200; i < 290; i++) {
		if (document.getElementsByName("ship" + i)[0]) {
			shipspeed = document.getElementsByName("speed" + i)[0].value;
			spd = 35000 / (dure * $('#speedfactor').val() - 10) * Math.sqrt($('#distance').text() * 10 / shipspeed);

			//spd = Math.max(msp / document.getElementsByName("speed" + i)[0].value, 0.1);
			//spd = Math.min(spd, 1.0);
			//spd = spd * sp;
			//spd = 10;
			basicConsumption = document.getElementsByName("consumption" + i)[0].value
			* document.getElementsByName("ship" + i)[0].value;
			consumption += basicConsumption * $('#distance').text() / 35000 * ((spd / 10) + 1) * ((spd / 10) + 1);
			//      values = values + " " + spd;
		}
		}
	
		//var spd = 35000 / ( dure * $('#speedfactor').val() - 10 ) * Math.sqrt ( $('#distance').text() * 10 / $('#vitessemax').text() );
		//console.log(spd);
		//var consomation = $('#consobase').val() * $('#distance').text() / 35000 * ( ( spd / 10 ) + 1 ) * ( ( spd / 10 ) + 1 );
		$('#consomation').html(Math.round(consumption)+ 1);
	});
	
	$('#metal_e').blur(function(){ 
		$('#metal_in').val(Math.floor($('#total_metal').val()));
		if($(this).val() > $('#metal_in').val()){
			$(this).val($('#metal_in').val());
		}
		var used_total = parseInt($('#metal_e').val())+parseInt($('#crital_e').val())+parseInt($('#uradium_e').val());
		if((used_total)>parseInt($('#capacite').text())){
			var used = parseInt($('#crital_e').val())+parseInt($('#uradium_e').val());
			$(this).val(parseInt($('#capacite').text())-used);
		}
	});
	
	$('#crital_e').blur(function(){ 
		$('#cristal_in').val(Math.floor($('#total_crystal').val()));
		if($(this).val() > $('#crital_in').val()){
			$(this).val($('#crital_in').val());
		}
		var used_total = parseInt($('#metal_e').val())+parseInt($('#crital_e').val())+parseInt($('#uradium_e').val());
		if((used_total)>parseInt($('#capacite').text())){
			var used = parseInt($('#metal_e').val())+parseInt($('#uradium_e').val());
			$(this).val(parseInt($('#capacite').text())-used);
		}
	});
	
	$('#uradium_e').blur(function(){ 
		$('#uradium_in').val(Math.floor($('#total_deut').val()));
		if($(this).val() > $('#uradium_in').val()){
			$(this).val($('#uradium_in').val());
		}
		var used_total = parseInt($('#metal_e').val())+parseInt($('#crital_e').val())+parseInt($('#uradium_e').val());
		if((used_total)>parseInt($('#capacite').text())){
			var used = parseInt($('#cristal_e').val())+parseInt($('#uradium_e').val());
			$(this).val(parseInt($('#capacite').text())-used);
		}
	});
});
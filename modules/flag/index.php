<?php
session_start();
$id = $_SESSION['userid'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>jQuery MiniColors</title>
    <meta charset="utf-8">

    <!-- jQuery -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <!-- MiniColors -->
    <script src="jquery.minicolors.js"></script>
    <link rel="stylesheet" href="jquery.minicolors.css">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js"></script>

    <script>
	
	function hexToRgb(hex) {
    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? {
        r: parseInt(result[1], 16),
        g: parseInt(result[2], 16),
        b: parseInt(result[3], 16)
    } : null;
}


        $(document).ready( function() {

		var img = 'flag-0003';
		
$('.logo').click(function(){
    img = $(this).attr('data-value');
	$('#img').val(img);
    $('#result').attr('src','image.php?r1='+$('#r1').val()+'&g1='+$('#g1').val()+'&b1='+$('#b1').val()+'&r2='+$('#r2').val()+'&g2='+$('#g2').val()+'&b2='+$('#b2').val()+'&img='+$('#img').val()+'&embl='+$('#emblem').val());
    $('#formSave').attr('action','saveImage.php?r1='+$('#r1').val()+'&g1='+$('#g1').val()+'&b1='+$('#b1').val()+'&r2='+$('#r2').val()+'&g2='+$('#g2').val()+'&b2='+$('#b2').val()+'&img='+$('#img').val()+'&embl='+$('#emblem').val());
            
});		
$('.emblem').click(function(){
    img = $(this).attr('data-value');
	$('#emblem').val(img);
	console.log($('#emblem').val());
    $('#result').attr('src','image.php?r1='+$('#r1').val()+'&g1='+$('#g1').val()+'&b1='+$('#b1').val()+'&r2='+$('#r2').val()+'&g2='+$('#g2').val()+'&b2='+$('#b2').val()+'&img='+$('#img').val()+'&embl='+$('#emblem').val());
    $('#formSave').attr('action','saveImage.php?r1='+$('#r1').val()+'&g1='+$('#g1').val()+'&b1='+$('#b1').val()+'&r2='+$('#r2').val()+'&g2='+$('#g2').val()+'&b2='+$('#b2').val()+'&img='+$('#img').val()+'&embl='+$('#emblem').val());
            
});	
$('.minicolor1').minicolors({
        animationSpeed: 50,
        animationEasing: 'swing',
        change: null,
        changeDelay: 0,
        control: 'hue',
        dataUris: true,
        defaultValue: '',
        format: 'hex',
        hide: null,
        hideSpeed: 100,
        inline: false,
        keywords: '',
        letterCase: 'lowercase',
        opacity: false,
        position: 'bottom left',
        show: null,
        showSpeed: 100,
        theme: 'default',
        swatches: [],
		change: function(value, opacity) {
		    var color = hexToRgb(value);
		    r1 = color.r;
            g1 = color.g;
		    b1 = color.b;
			r1 = $('#r1').val(r1);
			g1 = $('#g1').val(g1);
			b1 = $('#b1').val(b1);
			
			$('#result').attr('src','image.php?r1='+$('#r1').val()+'&g1='+$('#g1').val()+'&b1='+$('#b1').val()+'&r2='+$('#r2').val()+'&g2='+$('#g2').val()+'&b2='+$('#b2').val()+'&img='+$('#img').val()+'&embl='+$('#emblem').val());
            $('#formSave').attr('action','saveImage.php?r1='+$('#r1').val()+'&g1='+$('#g1').val()+'&b1='+$('#b1').val()+'&r2='+$('#r2').val()+'&g2='+$('#g2').val()+'&b2='+$('#b2').val()+'&img='+$('#img').val()+'&embl='+$('#emblem').val());
        
		}
    });
$('.minicolor2').minicolors({
        animationSpeed: 50,
        animationEasing: 'swing',
        change: null,
        changeDelay: 0,
        control: 'hue',
        dataUris: true,
        defaultValue: '',
        format: 'hex',
        hide: null,
        hideSpeed: 100,
        inline: false,
        keywords: '',
        letterCase: 'lowercase',
        opacity: false,
        position: 'bottom left',
        show: null,
        showSpeed: 100,
        theme: 'default',
        swatches: [],
		change: function(value, opacity) {
		    var color = hexToRgb(value);

			r2 = $('#r2').val(color.r);
			g2 = $('#g2').val(color.g);
			b2 = $('#b2').val(color.b);
			
			
			$('#result').attr('src','image.php?r1='+$('#r1').val()+'&g1='+$('#g1').val()+'&b1='+$('#b1').val()+'&r2='+$('#r2').val()+'&g2='+$('#g2').val()+'&b2='+$('#b2').val()+'&img='+$('#img').val()+'&embl='+$('#emblem').val());
            $('#formSave').attr('action','saveImage.php?r1='+$('#r1').val()+'&g1='+$('#g1').val()+'&b1='+$('#b1').val()+'&r2='+$('#r2').val()+'&g2='+$('#g2').val()+'&b2='+$('#b2').val()+'&img='+$('#img').val()+'&embl='+$('#emblem').val());
        
    	}
    });
	 $( "#tabs" ).tabs();
        });
    </script>
	<style>
	body{
		background:black;
	}
	.clear{
	    clear:both;
	}
	#left{
		float: left;
        width: 220px;
	}
	#right{
        float: left;
        width: 530px;
	}
	.ui-tabs-panel{
		height: 400px;
        overflow-y: scroll;
	}
	</style>
</head>
<body>
<div id="main">
    <div id="left">
        <img id="result" src="image.php?r1=84&g1=21&b1=21&r2=0&g2=0&b2=0&img=flag-0003&embl=emblem-0003" />
		<input class="minicolor1" />
        <input class="minicolor2" /> 
		<form method="post" id="formSave" action="saveImage.php?r1=84&g1=21&b1=21&r2=0&g2=0&b2=0&img=flag-0003&embl=emblem-0003">
		    <input type="submit" value="Sauvegarder" />
		</form>
    </div>
    <div id="right">
    <div id="tabs">
  <ul>
    <li><a href="#tabs-1">Background</a></li>
    <li><a href="#tabs-2">Emblem</a></li>
  </ul>
  <div id="tabs-1">
<?php
// nom du répertoire qui contient les images
$nomRepertoire = "flags";
if (is_dir($nomRepertoire))
   {
   $dossier = opendir($nomRepertoire);
   while ($Fichier = readdir($dossier))
       {
      if ($Fichier != "." AND $Fichier != ".." AND  stristr($Fichier,'.png') )
        {
        // Hauteur de toutes les images
          echo '<img class="logo" data-value="'.str_replace('.png','',$Fichier).'" src="flags/'.$Fichier.'" style="float:left;width:64px;margin-right:2px;" />';
          }
        }    
   closedir($dossier);
   }else{
   echo' Le répertoire spécifié n\'existe pas';
   }
?>
<div class="clear"></div>
  </div>
  <div id="tabs-2">
<?php
// nom du répertoire qui contient les images
$nomRepertoire = "emblem";
if (is_dir($nomRepertoire))
   {
   $dossier = opendir($nomRepertoire);
   while ($Fichier = readdir($dossier))
       {
      if ($Fichier != "." AND $Fichier != ".." AND  stristr($Fichier,'.png') )
        {
        // Hauteur de toutes les images
          echo '<img class="emblem" data-value="'.str_replace('.png','',$Fichier).'" src="emblem/'.$Fichier.'" style="float:left;width:64px;margin-right:2px;" />';
          }
        }    
   closedir($dossier);
   }else{
   echo' Le répertoire spécifié n\'existe pas';
   }
?>
	<div class="clear"></div>
    </div>
</div>
    </div>
</div>
<input type="hidden" id="r1" value="5"/>
<input type="hidden" id="g1" value="5"/>
<input type="hidden" id="b1" value="5"/>
<input type="hidden" id="r2" value="140"/>
<input type="hidden" id="g2" value="23"/> 
<input type="hidden" id="b2" value="23"/> 
<input type="hidden" id="img" value="flag-0003" />
<input type="hidden" id="emblem" value="emblem-0003" />

   
   
  
   
   

</body>
</html>

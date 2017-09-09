<?php
session_start();
$id = $_SESSION['userid'];

$image = new Imagick('flags/'.$_GET['img'].'.dds');
$mask = new Imagick('mask.dds');
$over = new Imagick('frame.dds');

$fuzz = 0;

$image->opaquePaintImage ( 'rgb(248,0,0)' ,'rgb('.$_GET['r1'].','.$_GET['g1'].','.$_GET['b1'].')' ,$fuzz,false  );
$image->opaquePaintImage ( 'rgb(198,57,1)' ,'rgb('.$_GET['r1'].','.$_GET['g1'].','.$_GET['b1'].')' ,$fuzz ,false  );
$image->opaquePaintImage ( 'rgb(243,12,0)' ,'rgb('.$_GET['r1'].','.$_GET['g1'].','.$_GET['b1'].')' ,$fuzz ,false  );


$image->opaquePaintImage ( 'rgb(0,252,0)' ,'rgb('.$_GET['r2'].','.$_GET['g2'].','.$_GET['b2'].')' , $fuzz,false  );

$image->opaquePaintImage ( 'rgb(255,0,0)' ,'rgb('.$_GET['r1'].','.$_GET['g1'].','.$_GET['b1'].')' , $fuzz ,false  );
$image->opaquePaintImage ( 'rgb(0,255,0)' ,'rgb('.$_GET['r2'].','.$_GET['g2'].','.$_GET['b2'].')' ,  $fuzz,false  );
$image->opaquePaintImage ( 'rgb(0,255,6)' ,'rgb('.$_GET['r2'].','.$_GET['g2'].','.$_GET['b2'].')' ,  1.0,false  );


$image->oilPaintImage(5);
//$image->edgeImage();
$image->enhanceImage();
$image->resizeImage(212, 212, Imagick::FILTER_LANCZOS, 1);
if($_GET['embl'] != "none" || !empty($_GET['embl']) ){
		$image2 = new Imagick('emblem/'.$_GET['embl'].'.dds');
	
	//$image2->resizeImage(212, 212, Imagick::FILTER_LANCZOS, 1);
	$image2->setImageBackgroundColor("transparent");
	$image2->setImageVirtualPixelMethod(Imagick::VIRTUALPIXELMETHOD_TRANSPARENT);
    $image->compositeImage($image2,
                           Imagick::COMPOSITE_DEFAULT,
						   (((($image->getImageWidth()) - ($image2->getImageWidth())))/2),
						   (((($image->getImageHeight())- ($image2->getImageHeight())))/2),
						   Imagick::CHANNEL_ALPHA);


    
	$image2->setImageBackgroundColor("transparent");
	$image2->setImageVirtualPixelMethod(Imagick::VIRTUALPIXELMETHOD_TRANSPARENT);
}else{

}
$image->setImageAlphaChannel (1 );
$image->compositeImage($mask, Imagick::COMPOSITE_DSTIN, 0, 0, Imagick::CHANNEL_ALPHA);
$image->compositeImage($over, Imagick::COMPOSITE_DEFAULT, 0, 0);


$image->setimageformat('png');


file_put_contents ($_SERVER["DOCUMENT_ROOT"].'/styles/images/emblem/'.$id.'.png', $image);

$imageMini = new Imagick($_SERVER["DOCUMENT_ROOT"].'/styles/images/emblem/'.$id.'.png');
$imageMini->setimageformat('png');
$imageMini->resizeImage(64, 64, Imagick::FILTER_LANCZOS, 1);
file_put_contents ($_SERVER["DOCUMENT_ROOT"].'/styles/images/emblem/mini/'.$id.'_64.png', $imageMini);

$imageMini->resizeImage(32, 32, Imagick::FILTER_LANCZOS, 1);
file_put_contents ($_SERVER["DOCUMENT_ROOT"].'/styles/images/emblem/mini/'.$id.'_32.png', $imageMini);
//echo '<script>parent.window.location.reload();</script>';


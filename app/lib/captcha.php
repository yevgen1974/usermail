<?php
class Captcha {
	
public function create () 
{

  $string =Str::random(7,'alpha');
  Session::put('captcha', $string);

  $width =100;
  $height = 40;
  $image = imagecreatetruecolor($width, $height);
  $text_color = imagecolorallocate($image, 110,110,110);
  $bg_color = imagecolorallocare($image, 200,200,200);
  imagefilledrectangle($image,0,0,$width, $height, $bg_color);
  imagestring ($image,5,15,4,$sring, $text_color);
  ob_start();
  imagepeg($image);
  $jpg=ob_get_clean();
  return "data:image/jpeg;base64,"base64_encode($jpg);
}




?>
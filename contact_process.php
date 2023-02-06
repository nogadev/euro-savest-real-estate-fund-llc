<?php

if (isset($_POST)){
$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
$recaptcha_secret = '6Lc0wlokAAAAAOfZZIeab2aoyfAEOyPKUsN0_I05';
$recaptcha_response = $_POST['token'];
$recaptcha = file_get_contents($recaptcha_url.'?secret='.$recaptcha_secret.'&response='.$recaptcha_response);
$recaptcha = json_decode($recaptcha);

 if($recaptcha -> success == true && $recaptcha -> score >= 0.5 ){ 

  $to = "marklm@eurusavest.com";
  $from = $_POST['email'];
  $name = $_POST['name'];
  $csubject = $_POST['subject'];
  $number = $_POST['number'];
  $cmessage = $_POST['message'];
  
  $headers = "From: $from";
	$headers = "From: " . $from . "\r\n";
	$headers .= "Reply-To: ". $from . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=utf-8\r\n";


  $subject = "You have a message from Eurusavest.com";
  

	$body = "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><title>Express Mail</title></head><body>";
	$body .= "<table style='width: 100%;'>";
	$body .= "<thead style='text-align: center;'><tr><td style='border:none;' colspan='2'>";
	$body .= "</td></tr></thead><tbody><tr>";
	$body .= "<td style='border:none;'><strong>Name:</strong> {$name}</td>";
	$body .= "<td style='border:none;'><strong>Email:</strong> {$from}</td>";
	$body .= "</tr>";
	$body .= "<tr><td style='border:none;'><strong>Subject:</strong> {$csubject}</td></tr>";
	$body .= "<tr><td></td></tr>";
	$body .= "<tr><td colspan='2' style='border:none;'>{$cmessage}</td></tr>";
	$body .= "</tbody></table>";
	$body .= "</body></html>";

  $send = mail($to, $subject, $body, $headers);

  if ($send) {
    $res = [
     "err" => false,
     "message" => "Tus datos han sido enviados"
    ];
 }else{
    $res = [
    "err" => true,
    "message" => "Error al enviar tus datos. Intenta nuevamente"
    ];
 }

 header("Access-Control-Allow-Origin:*");
 header('Content-type: application/json');

 echo json_encode($res);
 exit;


}else{
       
echo "Error"

}
  }

?>
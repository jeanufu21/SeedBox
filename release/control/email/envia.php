

<?php


function enviaEmail($parceiro,$data,$descricao,$gerente,$produto,$quantidade,$medida,$size,$address){
	//error_reporting(E_ALL);
	error_reporting(E_STRICT);
	//print_r($produto);
	//print_r($quantidade);
	//print_r($medida);


	date_default_timezone_set('America/Brasil');

	require_once('class.phpmailer.php');
	include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

	$mail = new PHPMailer();

	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->SMTPDebug  = true;                     // enables SMTP debug information (for testing)
	                                           // 1 = errors and messages
	                                           // 2 = messages only
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
	$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
	$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
	$mail->Username   = "sistemaeagleufu@gmail.com";  // GMAIL username
	$mail->Password   = "techmob123";            // GMAIL password

	$mail->SetFrom("sistemaeagleufu@gmail.com", "Novo Pedido");

	$mail->AddReplyTo("sistemaeagleufu@gmail.com","Novo Pedido");

	$mail->Subject = "Novo Pedido";

	$mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

	$body = " 
		Dear Manager  <b><i>".$gerente."</b></i>,<br><br>
	 The partner <b><i>".$parceiro."</b></i> made a request on date <i><b>".$data."</i></b>, of these products:<br> 
	<br><br>	
	<table style='border:1px solid #000;' cellpadding=10 cellspacing=7>
	<tr style='background:#DFF0D8;text-align:center;padding:10px;'>
		<td>Product</td>
		<td>Account</td>
		<td>Measure</td>
	</tr>";
	for($i=0;$i<$size;$i++){
				
		$body  .= "<tr style='text-align:center;padding:10px;'>
			<td>".$produto[$i]."</td>
			<td>".$quantidade[$i]."</td>
			<td>".$medida[$i]."</td>
		</tr>";
	}

	$body .= "</table>
	<br><br>Observations :
	".$descricao."
	
	<br><br>Thanks.";
	
	$mail->MsgHTML($body);
	
	$mail->AddAddress($address, $gerente);

	//$mail->AddAttachment("images/phpmailer.gif");      // attachment
	//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

	if(!$mail->Send()) {
	  /*echo "Mailer Error: " . $mail->ErrorInfo;*/
	} else {
	  /*echo "Message sent!";*/
	}
}

?>

<?php
/**
* Para incluir los datos necesarios de su producto, es necesario consultar el panel de control del mismo e incluir:
*
*  $merchantCode	= Código de cliente
*  $password		= Contraseña
*  $terminal		= Número de terminal
*
*/
include("class/paycomet_bankstore.php");

$merchantCode	= "";
$password		= "";
$terminal		= "";
$jetid			= NULL; // Opcional si no se utiliza BankStore JET

$paycomet = new Paycomet_Bankstore($merchantCode, $terminal, $password, $jetid);

//------------------------------------------------  datos de pago                 ------------------------------------->
$transreference=time(); //refencia
$amount="40"; //0.40 centimos
$currency="EUR";
$description="Pruebas";
//------------------------------------------------  métodos por IFRAME/Fullscreen  ------------------------------------->
//$response = $paycomet->AddUserUrl("3456", "ES");
$response = $paycomet->ExecutePurchaseUrl($transreference, $amount, $currency, $lang = "ES", $description , $secure3d = true, $scoring = null, $urlOk = null, $urlKo = null, $merchant_data = null, $merchant_description = null, $sca_exception = null, $trx_type = null, $scrow_targets = null);

if ($response->RESULT == "KO") {
	//var_dump($response);
	echo "Error en pasarela de pago.";
} else {	
	//echo "OK: ";
        //var_dump($response);
	//echo $response->URL_REDIRECT;
	?>
	<iframe title="titulo"  sandbox="allow-top-navigation allow-scripts allow-same-origin allow-forms" src="<?=$response->URL_REDIRECT?>" width="500" height="100%" frameborder="0" marginheight="0" marginwidth="0" scrolling="yes" style="border: 0px solid #000000; padding: 0px; margin: 0px"></iframe>
	<?php
	
}


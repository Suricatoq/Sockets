<!DOCTYPE html>
<html>
<head>
	<title>Conta-Corrente</title>
</head>
<body>
<center>
<h1>Conta-Corrente</h1>
<p>Bem-vindo!</p>

<?php

$erro = '';

$address = "127.0.0.1";
$service_port = 6006;
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

if ($socket === false) {
    echo "socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n";
}

$result = socket_connect($socket, $address, $service_port);
if ($result === false) {
    echo "socket_connect() failed.\nReason: ($result) " . socket_strerror(socket_last_error($socket)) . "\n";
}

if(isset($_POST['valor'])){

	$valor = $_POST['valor'];

	$in = "deposito $valor";

	socket_write($socket, $in, strlen($in));

	$out = socket_read($socket, 2048);

	if($out == 1){
		$erro = 'Saldo muito pequeno.';
	}
	else{
		$valores = explode(" ", $out);
		$erro = "Deposito efetuado com sucesso.<br>Saldo Atual: R$ $valores[0]<br>Saldo Anterior: R$ $valores[1]";
	}

}

socket_close($socket);

?>
<form action="" method="POST" style="margin-top: 140px">

	<?php echo $erro ?>
	
	<h2>Valor</h2>
	<input type="number" name="valor" style="height: 30px; font-size: 20px; text-align: center">
	<br>
	<input type="submit" style="height: 30px; font-size: 20px; text-align: center; margin-top: 10px">

</form>

<p style="margin-top: 120px">
	<a href="index.php">
		<button><h3>Voltar</h3></button>
	</a>
</p>
</center>
</body>
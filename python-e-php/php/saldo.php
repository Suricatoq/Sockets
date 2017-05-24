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

$in = "saldo 1";

socket_write($socket, $in, strlen($in));

$out = socket_read($socket, 2048);

echo "<h1 style='margin-top: 170px'>SALDO: R$ $out</h1>";

socket_close($socket);
?>
<p style="margin-top: 90px">
	<a href="index.php">
		<button><h3>Voltar</h3></button>
	</a>
</p>
</center>
</body>
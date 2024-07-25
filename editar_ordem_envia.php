<?php
require_once("valida_session.php");
require_once("bd/bd_ordem.php");

$codigo = $_POST["cod"];
$cod_terceirizado = $_POST["cod_terceirizado"];
$data_servico = $_POST["data_servico"];
$status = $_POST["status"];
$data = date("y/m/d");

$dados = editarOrdem($codigo, $cod_terceirizado, $data_servico, $status, $data);
if ($dados == 1) {
	$_SESSION['texto_sucesso'] = 'Os dados da ordem de serviço foram alterados no sistema.';
	if ($_SESSION['perfil'] == 1)
		header("Location:ordem.php");
	else if ($status == 1)
		header("Location:ordem_aberta.php");
	else if ($status == 2)
		header("Location:ordem_execucao.php");
	else if ($status == 3)
		header("Location:ordem_concluida.php");
} else {
	$_SESSION['texto_erro'] = 'Os dados da ordem de serviço não foram alterados no sistema!';
	if ($_SESSION['perfil'] == 1)
		header("Location:ordem.php");
	else if ($status == 1)
		header("Location:ordem_aberta.php");
	else if ($status == 2)
		header("Location:ordem_execucao.php");
	else if ($status == 3)
		header("Location:ordem_concluida.php");
}

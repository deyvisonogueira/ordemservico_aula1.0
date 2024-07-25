<?php
require_once("conecta_bd.php");

function listaServicos()
{
    $conexao = conecta_bd();
    $servicos = array();
    $query = "select * from servico order by nome";

    $resultado = mysqli_query($conexao, $query);
    while ($dados =  mysqli_fetch_array($resultado)) {
        array_push($servicos, $dados);
    }
    return $servicos;
}

function cadastraServico($nome, $valor, $data)
{
    $conexao = conecta_bd();
    $query = "insert into servico(nome, valor, data) value ('$nome','$valor','$data')";

    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_affected_rows($conexao);
    return $dados;
}

function buscaServicoeditar($codigo){
    $conexao = conecta_bd();

    $query = "Select * From servico Where cod = '$codigo'";

    $resultado= mysqli_query($conexao, $query);
    $dados = mysqli_fetch_array($resultado);

    return $dados;
}

function editarServico($codigo, $nome, $valor, $data)
{
    $conexao = conecta_bd();

    $query = "Select * From servico Where cod = '$codigo'";

    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_num_rows($resultado);
    if ($dados == 1) {
        $query = "Update servico Set nome = '$nome', valor = '$valor', data = '$data'
        where cod = '$codigo'";
        $resultado = mysqli_query($conexao, $query);
        $dados = mysqli_affected_rows($conexao);
        return $dados;
    }
}

<?php

require_once("conecta_bd.php");

function checaTerceirizado($email, $senha) {
    $conexao = conecta_bd();
    $senhaMd5 = md5($senha);
    $query = "select *
              from terceirizado
              where email='$email' and
                    senha='$senhaMd5'";

    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_fetch_array($resultado);

    return $dados;
}

function listaTerceirizados(){
    $conexao = conecta_bd();
    $terceirizados = array();
    $query = "select *
              from terceirizado
              order by nome";

    $resultado = mysqli_query($conexao, $query);
    while ($dados = mysqli_fetch_array($resultado)){
        array_push($terceirizados, $dados);
    }
    return $terceirizados;

}

function buscaTerceirizado($email){
    $conexao = conecta_bd();
    $query = "select *
              from terceirizado
              where email='$email'";

    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_num_rows($resultado);

    return $dados;
}

function cadastraTerceirizado($nome,$email,$telefone,$senha,$status,$perfil,$data){

    $conexao = conecta_bd();
    $query = "Insert Into terceirizado(nome,email,telefone,senha,status,perfil,data) values('$nome','$email','$telefone','$senha','$status','$perfil','$data')";

    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_affected_rows($conexao);

    return $dados;

}

function removeTerceirizado($codigo){
     $conexao = conecta_bd();
    $query = "delete from terceirizado where cod = '$codigo'";

    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_affected_rows($conexao);

    return $dados;

}

function buscaTerceirizadoeditar($codigo){
    $conexao = conecta_bd();
    $query = "select *
              from terceirizado
              where cod='$codigo'";

    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_fetch_array($resultado);

    return $dados;

}

function editarTerceirizado($codigo,$status,$data){
    $conexao = conecta_bd();
    $query = "select *
              from terceirizado
              where cod='$codigo'";

    $resultado = mysqli_query($conexao,$query);
    $dados = mysqli_num_rows($resultado);
    if($dados == 1){
        $query = "update terceirizado
        set status = '$status', data = '$data'
        where cod = '$codigo'";
        $resultado = mysqli_query($conexao,$query);
        $dados = mysqli_affected_rows($conexao);
        return $dados;
    }

}

?>
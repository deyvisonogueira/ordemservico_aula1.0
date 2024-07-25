<?php 
require_once("conecta_bd.php");

function checaCliente($email, $senha){
    $conexao = conecta_bd();
    $senhaMd5 = md5($senha);
    $query = "select * from cliente where email = '$email' and senha ='$senhaMd5'";

    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_fetch_array($resultado);

    return $dados;
}

function listaClientes(){
    $conexao = conecta_bd();
    $usuarios = array();
    $query = "select * from cliente order by nome";

    $resultado = mysqli_query($conexao, $query);
    while($dados =  mysqli_fetch_array($resultado)){
        array_push($usuarios, $dados);
    }
    return $usuarios;
}

function buscaCliente($email){
    $conexao = conecta_bd();
   
    $query = "select * from cliente where email = '$email'";

    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_num_rows($resultado);

    return $dados;
}

function cadastraCliente($nome,$email,$senha,$endereco,$numero,$bairro,$cidade,$telefone,$status,$perfil,$data){
    $conexao = conecta_bd();
    $query = "insert into cliente(nome, email, senha, endereco, numero, bairro, cidade, telefone, status, perfil, data) value ('$nome','$email','$senha','$endereco','$numero','$bairro','$cidade','$telefone','$status','$perfil','$data')";

    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_affected_rows($conexao);
    return $dados;
}

function editarSenhaCliente($codigo,$senha){
    $conexao = conecta_bd();

    $query = "Select * From cliente Where cod = '$codigo'";

    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_num_rows($resultado);
    if($dados == 1){
        $query = "Update cliente 
        Set senha = '$senha'
        where cod = '$codigo'";
        $resultado = mysqli_query($conexao, $query);
        $dados= mysqli_affected_rows($conexao);
        return $dados;
    }
}

function buscaClienteeditar($codigo){
    $conexao = conecta_bd();

    $query = "Select * From cliente Where cod = '$codigo'";

    $resultado= mysqli_query($conexao, $query);
    $dados = mysqli_fetch_array($resultado);

    return $dados;
}

function editarPerfilCliente($codigo, $nome, $email, $data, $endereco, $numero, $bairro, $cidade, $telefone){
    $conexao = conecta_bd();

    $query = "Select * From cliente Where cod = '$codigo'";

    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_num_rows($resultado);
    if($dados == 1){
        $query = "Update cliente Set nome = '$nome', email = '$email',endereco = '$endereco', numero = '$numero', bairro = '$bairro', cidade = '$cidade', telefone = '$telefone', data = '$data'
        where cod = '$codigo'";
        $resultado = mysqli_query($conexao, $query);
        $dados= mysqli_affected_rows($conexao);
        return $dados;
    }

}

function editarCliente($codigo, $status, $data){
    $conexao = conecta_bd();

    $query = "Select * From cliente Where cod = '$codigo'";

    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_num_rows($resultado);
    if($dados == 1){
        $query = "Update cliente Set status = '$status', data = '$data'
        where cod = '$codigo'";
        $resultado = mysqli_query($conexao, $query);
        $dados= mysqli_affected_rows($conexao);
        return $dados;
    }
}

<?php
require_once("conecta_bd.php");

function consultaStatusUsuario($status)
{
    $conexao = conecta_bd();
    $query = "select count(*) AS total from ordem where status = '$status'";

    $resultado = mysqli_query($conexao, $query);
    $total = mysqli_fetch_array($resultado);

    return $total;
}

function consultaStatusCliente($cod_usuario, $status)
{
    $conexao = conecta_bd();
    $query = "select count(*) AS total from ordem where status = '$status' and cod_cliente = '$cod_usuario'";

    $resultado = mysqli_query($conexao, $query);
    $total = mysqli_fetch_array($resultado);

    return $total;
}

function consultaStatusTerceirizado($cod_usuario, $status)
{
    $conexao = conecta_bd();
    $query = "select count(*) AS total from ordem where status = '$status' and cod_terceirizado = '$cod_usuario'";

    $resultado = mysqli_query($conexao, $query);
    $total = mysqli_fetch_array($resultado);

    return $total;
}

function listaOrdem()
{
    $conexao = conecta_bd();

    $ordem = array();

    $query = "Select
           o.cod AS cod,
           c.nome AS nome_cliente,
           t.nome AS nome_terceirizada,
           s.nome AS nome_servico,
           o.data_servico AS data_servico,
           o.status AS status
           From ordem o, servico s, cliente c, terceirizado t where o.cod_cliente = c.cod AND o.cod_servico = s.cod AND o.cod_terceirizado = t.cod order by o.status ASC";

    $resultado = mysqli_query($conexao, $query);

    while ($dados = mysqli_fetch_array($resultado)) {
        array_push($ordem, $dados);
    }
    return $ordem;
}

function listaOrdemStatus($status, $codigo, $perfil)
{
    $conexao = conecta_bd();

    $ordem = array();

    $query = "SELECT o.cod AS cod,
           c.nome AS nome_cliente,
           t.nome AS nome_terceirizada,
           s.nome AS nome_servico,
           o.data_servico AS data_servico,
           o.status AS status
           FROM ordem o
           INNER JOIN servico s ON o.cod_servico = s.cod
           INNER JOIN cliente c ON o.cod_cliente = c.cod
           INNER JOIN terceirizado t ON o.cod_terceirizado = t.cod
           WHERE o.status = '$status'";

    if ($perfil == 2)
        $query .= " AND o.cod_cliente = '$codigo'";
    else if ($perfil == 3)
        $query .= " AND o.cod_terceirizado = '$codigo'";


    $query .= " ORDER BY o.status ASC";


    $resultado = mysqli_query($conexao, $query);

    while ($dados = mysqli_fetch_array($resultado)) {
        array_push($ordem, $dados);
    }
    return $ordem;
}


function  cadastraOrdem($cod_cliente, $cod_servico, $cod_terceirizado, $data_servico, $status, $data)
{
    $conexao = conecta_bd();

    $query = "insert into ordem(cod_cliente,cod_servico,cod_terceirizado,data_servico,status,data) values('$cod_cliente','$cod_servico','$cod_terceirizado','$data_servico','$status','$data')";

    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_affected_rows($conexao);
    return $dados;
}

function buscaOrdemadd()
{
    $conexao = conecta_bd();

    $query = "Select
           c.nome AS nome_cliente,
           t.nome AS nome_terceirizada,
           s.nome AS nome_servico,
           o.data_servico AS data_servico,
           o.status AS status
           From ordem o, servico s, cliente c, terceirizado t where o.cod_cliente = c.cod AND o.cod_servico = s.cod AND o.cod_terceirizado = t.cod order by o.cod DESC LIMIT 1";

    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_fetch_array($resultado);


    return $dados;
}

function buscaOrdemeditar($codigo)
{
    $conexao = conecta_bd();
    $query = "Select 
			  o.cod AS cod,
			  c.nome AS nome_cliente,
			  t.nome AS nome_terceirizada,
			  s.nome AS nome_servico,
			  o.data_servico AS data_servico,
			  o.status AS status,
			  t.cod AS cod_terceirizado
			  From ordem o,servico s, cliente c, terceirizado t 
			  Where o.cod_cliente = c.cod AND 
			        o.cod_servico = s.cod AND 
			        o.cod_terceirizado = t.cod AND
			        o.cod = '$codigo'";

    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_fetch_array($resultado);

    return $dados;
}

function editarOrdem($codigo, $cod_terceirizado, $data_servico, $status, $data)
{
    $conexao = conecta_bd();
    $query = "SELECT * 
              FROM ordem
              WHERE cod='$codigo'";

    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_num_rows($resultado);

    if ($dados == 1) {
        $query = "UPDATE  ordem
                SET cod_terceirizado = '$cod_terceirizado', data_servico = '$data_servico', status = '$status', data = '$data'
                WHERE cod = '$codigo'";
        $resultado = mysqli_query($conexao, $query);
        $dados = mysqli_affected_rows($conexao);
        return $dados;
    }
}

function removeOrdem($codigo)
{
    $conexao = conecta_bd();
    $query = "SELECT * 
              FROM ordem
              WHERE cod='$codigo'";

    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_num_rows($resultado);

    if ($dados == 1) {
        $query = "DELETE FROM ordem WHERE cod='$codigo'";
        $resultado = mysqli_query($conexao, $query);
        $dados = mysqli_affected_rows($conexao);
        return $dados;
    }
}

<?php
require_once('valida_session.php');
require_once('header.php');
require_once('sidebar.php');
?>

<!-- Main Content -->
<div id="content">

    <?php require_once('navbar.php'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="card shadow mb-2">
            <div class="card-header py-3">

                <div class="row">
                    <div class="col-md-8">
                        <h6 class="m-0 font-weight-bold text-primary" id="title">GERENCIAR ORDEM DE SERVIÇO EM ABERTO</h6>
                    </div>
                    <div class="col-md-4 card_button_title">
                        <?php
                        if ($_SESSION['perfil'] == 1) {
                            echo  '<a title="Adicionar nova ordem" href="cad_ordem.php"><button type="button" class="btn btn-primary btn-sm card_button_title" 
                       data-toggle="modal" id=" "> <i class="fas fa-fw fa-clipboard-list">&nbsp;</i> Adicionar Ordem</button></a>';
                        }
                        ?>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <?php
                if (isset($_SESSION['texto_erro'])) :
                ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;<?= $_SESSION['texto_erro'] ?></strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php
                    unset($_SESSION['texto_erro']);
                endif;
                ?>

                <?php
                if (isset($_SESSION['texto_sucesso'])) :
                ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-check"></i>&nbsp;&nbsp;<?= $_SESSION['texto_sucesso'] ?></strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php
                    unset($_SESSION['texto_sucesso']);
                endif;
                ?>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="display:none" ;>cod</th>
                                <th>Nome do Cliente</th>
                                <th>Terceirizado</th>
                                <th>Serviço</th>
                                <th class="text-center">Data do Serviço</th>
                                <th class="text-center">Situação</th>
                                <th class="text-center" data-orderable="false">Atualizar</th>
                                <th class="text-center" data-orderable="false">Excluir</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once("bd/bd_ordem.php");
                            $cod_usuario = $_SESSION['cod_usu'];
                            $perfil = $_SESSION['perfil'];
                            $ordem = listaOrdemStatus(1, $cod_usuario, $perfil);
                            foreach ($ordem as $dados) :
                            ?>
                                <tr>
                                    <td style="display:none" ;><?= $dados[0] ?></td>
                                    <td><?= $dados[1] ?></td>
                                    <td><?= $dados[2] ?></td>
                                    <td><?= $dados[3] ?></td>
                                    <td class="text-center"><?= date('d/m/Y', strtotime($dados[4])) ?></td>
                                    <td class="text-center"><?= ($dados[5] == 1) ? '<span class="badge badge-danger">Aberta</span>' : (($dados[5] == 2) ? '<span class="badge badge-warning">Executando</span>' : '<span class="badge badge-info">Concluida</span>') ?></td>
                                    <td class="text-center">
                                        <?php if ($dados[5] == 1) : ?>
                                            <?php
                                            $perfil = $_SESSION['perfil'];
                                            if ($_SESSION['perfil'] != 2) {
                                                echo '<a title="Atualizar" href="editar_ordem.php?cod=<?= $dados[0]; ?>" class="btn btn-sm btn-success"><i class="fas fa-edit">&nbsp;</i>Atualizar</a>';
                                            } ?>
                                        <?php endif ?>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        $perfil = $_SESSION['perfil'];
                                        if (($dados[5] == 1) or ($dados[5] == 3)) : ?>
                                            <?php
                                            $perfil = $_SESSION['perfil'];
                                            if ($_SESSION['perfil'] == 1) {
                                                echo '<a title="Excluir" href="javascript(void)" data-toggle="modal" data-target="#excluir-<?= $dados[0]; ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt">&nbsp;</i>Excluir</a:';
                                            } ?>
                                        <?php endif ?>
                                    </td>
                                </tr>


                                <div class="modal fade" id="excluir-<?= $dados[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Excluir ordem</h5>
                                            </div>
                                            <div class="modal-body">Deseja realmente excluir esta informação?</div>
                                            <div class="modal-footer">
                                                <a href="remove_ordem.php?cod=<?= $dados[0]; ?>"><button class="btn btn-primary btn-user" type="button">Confirmar</button></a>
                                                <a href="ordem_aberta.php"><button class="btn btn-danger btn-user" type="button">Cancelar</button></a>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->


    <?php
    require_once('footer.php');
    ?>
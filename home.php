<?php
require_once('valida_session.php');
require_once('header.php'); 
require_once('sidebar.php'); 
require_once ("bd/bd_ordem.php");
?>

<!-- Main Content -->
<div id="content">
 <?php require_once('navbar.php');?>

 <!-- Begin Page Content -->
 <div class="container-fluid">

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4" id="cards-notice">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Ordens de Serviço Abertas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php
                                if ($_SESSION['perfil'] == 1) {
                                    $status = 1;
                                    $total = consultaStatusUsuario($status);
                                    echo ($total['total']);
                                }
                                if ($_SESSION['perfil'] == 2) {
                                    $cod_usuario = $_SESSION['cod_usu'];
                                    $status = 1;
                                    $total = consultaStatusCliente($cod_usuario,$status);
                                    echo ($total['total']);
                                }
                                if ($_SESSION['perfil'] == 3) {
                                    $cod_usuario = $_SESSION['cod_usu'];
                                    $status = 1;
                                    $total = consultaStatusTerceirizado($cod_usuario,$status);
                                    echo ($total['total']);
                                }
                            ?>

                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4" id="cards-notice">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Ordens de Serviço em Execussão</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                              <?php
                                if ($_SESSION['perfil'] == 1) {
                                    $status = 2;
                                    $total = consultaStatusUsuario($status);
                                    echo ($total['total']);
                                }
                                if ($_SESSION['perfil'] == 2) {
                                    $cod_usuario = $_SESSION['cod_usu'];
                                    $status = 2;
                                    $total = consultaStatusCliente($cod_usuario,$status);
                                    echo ($total['total']);
                                }
                                if ($_SESSION['perfil'] == 3) {
                                    $cod_usuario = $_SESSION['cod_usu'];
                                    $status = 2;
                                    $total = consultaStatusTerceirizado($cod_usuario,$status);
                                    echo ($total['total']);
                                }
                            ?>  
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-briefcase fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4" id="cards-notice">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Ordens de Serviço Concluídas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
                                if ($_SESSION['perfil'] == 1) {
                                    $status = 3;
                                    $total = consultaStatusUsuario($status);
                                    echo ($total['total']);
                                }
                                if ($_SESSION['perfil'] == 2) {
                                    $cod_usuario = $_SESSION['cod_usu'];
                                    $status = 3;
                                    $total = consultaStatusCliente($cod_usuario,$status);
                                    echo ($total['total']);
                                }
                                if ($_SESSION['perfil'] == 3) {
                                    $cod_usuario = $_SESSION['cod_usu'];
                                    $status = 3;
                                    $total = consultaStatusTerceirizado($cod_usuario,$status);
                                    echo ($total['total']);
                                }
                            ?>  
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>


</div>
<!-- /.container-fluid -->

</div>


<?php
require_once('footer.php');
?>
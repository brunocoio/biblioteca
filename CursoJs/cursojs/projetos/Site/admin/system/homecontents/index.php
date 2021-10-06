<?php
if (empty($login)) :
    header('Location: ../../painel.php');
    die;
endif;
?>
        <?php
        $empty = filter_input(INPUT_GET, 'empty', FILTER_VALIDATE_BOOLEAN);
        if ($empty):
            WSErro("Oppsss: Você tentou editar um homecontent que não existe no sistema!", WS_INFOR);
        endif;
        $action = filter_input(INPUT_GET, 'action', FILTER_DEFAULT);
        if ($action):
            require ('_models/AdminHomeContent.class.php');
            $homecontentAction = filter_input(INPUT_GET, 'homecontent', FILTER_VALIDATE_INT);
            $homecontentUpdate = new AdminHomeContent;
            ?>
            <div class="container alert alert-info sticky-float-bottom">
                <div class="row justify-content-between align-items-center">
                    <div class="col-lg-auto mt-2 mb-2">
                    <?php
                    switch ($action):
                        case 'active':
                            $homecontentUpdate->ExeStatus($homecontentAction, '1');
                            WSErro("O registro foi atualizado para <b>ativo</b> e publicado!", WS_ACCEPT);
                            break;
                        case 'inative':
                            $homecontentUpdate->ExeStatus($homecontentAction, '0');
                            WSErro("O registro foi atualizado para <b>inativo</b> e agora é um rascunho!", WS_ALERT);
                            break;
                        case 'delete':
                            $homecontentUpdate->ExeDelete($homecontentAction);
                            WSErro($homecontentUpdate->getError()[0], $homecontentUpdate->getError()[1]);
                            break;
                        default :
                            WSErro("Ação não foi identifica pelo sistema, favor utilize os botões!", WS_ALERT);
                    endswitch;
                    ?>                        
                    </div>
                    <div class="col-lg-auto mt-3 mt-lg-0">
                        <button type="button" class="close btn btn-link float-lg-none text-dark ml-md-3" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                </div>
            </div>
            <?php
        endif;
        ?>
<h2>Parte destaque do site na primeira página</h2><small>Primeira parte após o banner, apresentação.</small><br /><br />
<div class="card">
    <!-- Default panel contents -->
    <div class="card-header">
        Conteúdo da Página Home
    </div>
    <!-- Table -->
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Thumb</th>
                <th>Nome</th>
                <th>Ver no Site</th>
                <th>Status</th>
                <th colspan="2">Alterar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $homecontenti = 0;
            $getPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
            $Pager = new Pager('painel.php?exe=homecontents/index&page=');
            $Pager->ExePager($getPage, 10);
            $readBlindagens = new Read;
            $readBlindagens->ExeRead("cad_homecontents", "ORDER BY homecontent_status ASC, homecontent_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
            if ($readBlindagens->getResult()):
                foreach ($readBlindagens->getResult() as $homecontent):
                    //$homecontenti++;
                    extract($homecontent);
                    $status = (!$homecontent_status ? 'style="background: #fffed8"' : '');
                    ?>
                    <tr>
                        <td><?= $homecontent_id ?></td>
                        <td><?= Check::Image('../uploads/' . $homecontent_image, $homecontent_title, 25, 25); ?></td>
                        <td><?= $homecontent_title; ?></td>
                        <td><a class="act_view text-view" target="_blank" href="<?= HOME ?>" title="Ver no site"><i class="icon-tv"></i></a></td>
                        <td>
                            <?php if (!$homecontent_status): ?>
                                <a class="act_inative text-create" href="painel.php?exe=homecontents/index&homecontent=<?= $homecontent_id; ?>&action=active" title="Ativar"><i class="icon-line2-like"></i> Ativar</a>
                            <?php else: ?>
                                <a class="act_ative text-delete" href="painel.php?exe=homecontents/index&homecontent=<?= $homecontent_id; ?>&action=inative" title="Inativar"><i class="icon-line2-dislike"></i> Inativar</a>
                            <?php endif; ?>
                        </td>
                        <td><a class="act_edit text-alter" href="painel.php?exe=homecontents/update&homecontentid=<?= $homecontent_id; ?>" title="Editar"><i class="icon-pen1"></i></a></td>
                        <td><!--a class="act_delete" href="painel.php?exe=homecontents/index&homecontent=<?= $homecontent_id; ?>&action=delete" title="Excluir"><i class="fa fa-times-circle text-red"></i> Deletar</a--></td>
                    </tr>
                    <?php
                endforeach;
            else:
                $Pager->ReturnPage();
                WSErro("Desculpe, ainda não existem homecontents cadastrados!", WS_INFOR);
            endif;
            /* $Pager->ExePaginator("cad_homecontents");
              echo $Pager->getPaginator(); */
            ?>
        </tbody>
    </table>
</div>
<?php
$Pager->ExePaginator("cad_homecontents");
echo $Pager->getPaginator();
?>
<?php
if (empty($login)) :
    header('Location: ../../painel.php');
    die;
endif;
?>
        <?php
        $empty = filter_input(INPUT_GET, 'empty', FILTER_VALIDATE_BOOLEAN);
        if ($empty):
            WSErro("Oppsss: Você tentou editar um page que não existe no sistema!", WS_INFOR);
        endif;
        $action = filter_input(INPUT_GET, 'action', FILTER_DEFAULT);
        if ($action):
            require ('_models/AdminPage.class.php');
            $pageAction = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
            $pageUpdate = new AdminPage;
            ?>
            <div class="container alert alert-info sticky-float-bottom">
                <div class="row justify-content-between align-items-center">
                    <div class="col-lg-auto mt-2 mb-2">
                    <?php
                    switch ($action):
                        case 'active':
                            $pageUpdate->ExeStatus($pageAction, '1');
                            WSErro("O registro foi atualizado para <b>ativo</b> e publicado!", WS_ACCEPT);
                            break;
                        case 'inative':
                            $pageUpdate->ExeStatus($pageAction, '0');
                            WSErro("O registro foi atualizado para <b>inativo</b> e agora é um rascunho!", WS_ALERT);
                            break;
                        case 'delete':
                            $pageUpdate->ExeDelete($pageAction);
                            WSErro($pageUpdate->getError()[0], $pageUpdate->getError()[1]);
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
<h2>Parte Conteúdo das páginas do menu</h2><br /><br />
<div class="card">
    <!-- Default panel sections -->
    <div class="card-header">
        Capa de Página
    </div>
    <!-- Table -->
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Thumb</th>
                <th>Nome</th>
                <!--th>Ver no Site</th-->
                <th>Status</th>
                <th colspan="2">Alterar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $pagei = 0;
            $getPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
            $Pager = new Pager('painel.php?exe=pages/index&page=');
            $Pager->ExePager($getPage, 10);
            $readBlindagens = new Read;
            $readBlindagens->ExeRead("cad_pages", "ORDER BY page_status ASC, page_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
            if ($readBlindagens->getResult()):
                foreach ($readBlindagens->getResult() as $page):
                    //$pagei++;
                    extract($page);
                    $status = (!$page_status ? 'style="background: #fffed8"' : '');
                    ?>
                    <tr>
                        <td><?= $page_id ?></td>
                        <td><?= Check::Image('../uploads/' . $page_image, $page_title, 25, 25); ?></td>
                        <td><?= $page_title; ?></td>
                        <!--td><a class="act_view text-view" target="_blank" href="<?= HOME ?>" title="Ver no site"><i class="icon-tv"></i></a></td-->
                        <td>
                            <?php if (!$page_status): ?>
                                <a class="act_inative text-create" href="painel.php?exe=pages/index&page=<?= $page_id; ?>&action=active" title="Ativar"><i class="icon-line2-like"></i> Ativar</a>
                            <?php else: ?>
                                <a class="act_ative text-delete" href="painel.php?exe=pages/index&page=<?= $page_id; ?>&action=inative" title="Inativar"><i class="icon-line2-dislike"></i> Inativar</a>
                            <?php endif; ?>
                        </td>
                        <td><a class="act_edit text-alter" href="painel.php?exe=pages/update&pageid=<?= $page_id; ?>" title="Editar"><i class="icon-pen1"></i></a></td>
                        <td><!--a class="act_delete" href="painel.php?exe=pages/index&page=<?= $page_id; ?>&action=delete" title="Excluir"><i class="fa fa-times-circle text-red"></i> Deletar</a--></td>
                    </tr>
                    <?php
                endforeach;
            else:
                $Pager->ReturnPage();
                WSErro("Desculpe, ainda não existem pages cadastrados!", WS_INFOR);
            endif;
            /* $Pager->ExePaginator("cad_pages");
              echo $Pager->getPaginator(); */
            ?>
        </tbody>
    </table>
</div>
<?php
$Pager->ExePaginator("cad_pages");
echo $Pager->getPaginator();
?>
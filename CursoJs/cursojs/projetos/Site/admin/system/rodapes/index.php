<?php
if (empty($login)) :
    header('Location: ../../painel.php');
    die;
endif;
?>
        <?php
        $empty = filter_input(INPUT_GET, 'empty', FILTER_VALIDATE_BOOLEAN);
        //if ($empty):
        //    WSErro("Oppsss: Você tentou editar um banner que não existe no sistema!", WS_INFOR);
        //endif;
        $action = filter_input(INPUT_GET, 'action', FILTER_DEFAULT);
        if ($action):
            require ('_models/AdminRodape.class.php');
            $rodapeAction = filter_input(INPUT_GET, 'rodape', FILTER_VALIDATE_INT);
            $rodapeUpdate = new AdminRodape;
            ?>
            <div class="container alert alert-info sticky-float-bottom">
                <div class="row justify-content-between align-items-center">
                    <div class="col-lg-auto mt-2 mb-2">
                    <?php
                    switch ($action):
                        case 'active':
                            $rodapeUpdate->ExeStatus($rodapeAction, '1');
                            WSErro("O registro foi atualizado para <b>ativo</b> e publicado!", WS_ACCEPT);
                            break;
                        case 'inative':
                            $rodapeUpdate->ExeStatus($rodapeAction, '0');
                            WSErro("O registro foi atualizado para <b>inativo</b> e agora é um rascunho!", WS_ALERT);
                            break;
                        case 'delete':
                            $rodapeUpdate->ExeDelete($rodapeAction);
                            WSErro($rodapeUpdate->getError()[0], $rodapeUpdate->getError()[1]);
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
<div class="card">
    <!-- Default panel contents -->
    <div class="card-header">
        Rodape
    </div>
    <!-- Table -->
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Ver no Site</th>
                <th>Status</th>
                <th colspan="2">Alterar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $empi = 0;
            $getPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
            $Pager = new Pager('painel.php?exe=rodapes/index&page=');
            $Pager->ExePager($getPage, 10);
            $readEmp = new Read;
            $readEmp->ExeRead("cad_rodapes", "ORDER BY rodape_name DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
            if ($readEmp->getResult()):
                foreach ($readEmp->getResult() as $rodape):
                    $empi++;
                    extract($rodape);
                    ?>            
                    <tr>
                        <td><?= $rodape_id; ?></td>
                        <td><?= $rodape_name; ?></td>
                        <td><a class="act_view text-view" target="_blank" href="<?= HOME ?>" title="Ver no site"><i class="icon-tv"></i></a>
                        <td>
                            <?php if (!$rodape_status): ?>
                                <a class="act_inative text-create" href="painel.php?exe=rodapes/index&rodape=<?= $rodape_id; ?>&action=active" title="Ativar"><i class="icon-line2-like"></i> Ativar</a>
                            <?php else: ?>
                                <a class="act_ative text-delete" href="painel.php?exe=rodapes/index&rodape=<?= $rodape_id; ?>&action=inative" title="Inativar"><i class="icon-line2-dislike"></i> Inativar</a>
                            <?php endif; ?>
                        </td>  
                        <td><a class="act_edit text-alter" href="painel.php?exe=rodapes/update&rodape=<?= $rodape_id; ?>" title="Editar"><i class="icon-pen1"></i></a></td>
                        <td><!--a class="act_delete" href="painel.php?exe=rodapes/index&rodape=<?= $rodape_id; ?>&action=delete" title="Excluir">Deletar</a--></td>
                    </tr>
                    <?php
                endforeach;
            else:
                $Pager->ReturnPage();
                WSErro("Desculpe, ainda não existem rodapes cadastrados!", WS_INFOR);
            endif;
            ?>
        </tbody>
    </table>
</div>
<?php
$Pager->ExePaginator("cad_rodapes");
echo $Pager->getPaginator();
?>
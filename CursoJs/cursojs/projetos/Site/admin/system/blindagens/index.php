<?php
if (empty($login)) :
    header('Location: ../../painel.php');
    die;
endif;
?>
        <?php
        $empty = filter_input(INPUT_GET, 'empty', FILTER_VALIDATE_BOOLEAN);
        if ($empty):
            WSErro("Oppsss: Você tentou editar um blindagem que não existe no sistema!", WS_INFOR);
        endif;
        $action = filter_input(INPUT_GET, 'action', FILTER_DEFAULT);
        if ($action):
            require ('_models/AdminBlindagem.class.php');
            $blindagemAction = filter_input(INPUT_GET, 'blindagem', FILTER_VALIDATE_INT);
            $blindagemUpdate = new AdminBlindagem;
            ?>
            <div class="container alert alert-info sticky-float-bottom">
                <div class="row justify-content-between align-items-center">
                    <div class="col-lg-auto mt-2 mb-2">
                    <?php
                    switch ($action):
                        case 'active':
                            $blindagemUpdate->ExeStatus($blindagemAction, '1');
                            WSErro("O registro foi atualizado para <b>ativo</b> e publicado!", WS_ACCEPT);
                            break;
                        case 'inative':
                            $blindagemUpdate->ExeStatus($blindagemAction, '0');
                            WSErro("O registro foi atualizado para <b>inativo</b> e agora é um rascunho!", WS_ALERT);
                            break;
                        case 'delete':
                            $blindagemUpdate->ExeDelete($blindagemAction);
                            WSErro($blindagemUpdate->getError()[0], $blindagemUpdate->getError()[1]);
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
        Blindagem
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
            $blindagemi = 0;
            $getPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
            $Pager = new Pager('painel.php?exe=blindagens/index&page=');
            $Pager->ExePager($getPage, 10);
            $readBlindagens = new Read;
            $readBlindagens->ExeRead("cad_blindagens", "ORDER BY blindagem_status ASC, blindagem_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
            if ($readBlindagens->getResult()):
                foreach ($readBlindagens->getResult() as $blindagem):
                    //$blindagemi++;
                    extract($blindagem);
                    $status = (!$blindagem_status ? 'style="background: #fffed8"' : '');
                    ?>
                    <tr>
                        <td><?= $blindagem_id ?></td>
                        <td><?= Check::Image('../uploads/' . $blindagem_image, $blindagem_name, 25, 25); ?></td>
                        <td><?= $blindagem_name; ?></td>
                        <td><a class="act_view text-view" target="_blank" href="<?= HOME ?>/<?= $blindagem_link; ?>" title="Ver no site"><i class="icon-tv"></i></a>
                        <td>
                            <?php if (!$blindagem_status): ?>
                                <a class="act_inative text-create" href="painel.php?exe=blindagens/index&blindagem=<?= $blindagem_id; ?>&action=active" title="Ativar"><i class="icon-line2-like"></i> Ativar</a>
                            <?php else: ?>
                                <a class="act_ative text-delete" href="painel.php?exe=blindagens/index&blindagem=<?= $blindagem_id; ?>&action=inative" title="Inativar"><i class="icon-line2-dislike"></i> Inativar</a>
                            <?php endif; ?>
                        </td>
                        <td><a class="act_edit text-alter" href="painel.php?exe=blindagens/update&blindagemid=<?= $blindagem_id; ?>" title="Editar"><i class="icon-pen1"></i></a></td>
                        <td><!--a class="act_delete" href="painel.php?exe=blindagens/index&blindagem=<?= $blindagem_id; ?>&action=delete" title="Excluir"><i class="fa fa-times-circle text-red"></i> Deletar</a--></td>
                    </tr>
                    <?php
                endforeach;
            else:
                $Pager->ReturnPage();
                WSErro("Desculpe, ainda não existem blindagens cadastrados!", WS_INFOR);
            endif;
            /* $Pager->ExePaginator("cad_blindagens");
              echo $Pager->getPaginator(); */
            ?>
        </tbody>
    </table>
</div>
<?php
$Pager->ExePaginator("cad_blindagens");
echo $Pager->getPaginator();
?>
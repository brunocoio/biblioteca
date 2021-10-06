<?php
if (empty($login)) :
    header('Location: ../../painel.php');
    die;
endif;
?>
        <?php
        $empty = filter_input(INPUT_GET, 'empty', FILTER_VALIDATE_BOOLEAN);
        if ($empty):
            WSErro("Oppsss: Você tentou editar um produto que não existe no sistema!", WS_INFOR);
        endif;
        $action = filter_input(INPUT_GET, 'action', FILTER_DEFAULT);
        if ($action):
            require ('_models/AdminProduto.class.php');
            $produtoAction = filter_input(INPUT_GET, 'produto', FILTER_VALIDATE_INT);
            $produtoUpdate = new AdminProduto;
            ?>
            <div class="container alert alert-info sticky-float-bottom">
                <div class="row justify-content-between align-items-center">
                    <div class="col-lg-auto mt-2 mb-2">
                    <?php
                    switch ($action):
                        case 'active':
                            $produtoUpdate->ExeStatus($produtoAction, '1');
                            WSErro("O registro foi atualizado para <b>ativo</b> e publicado!", WS_ACCEPT);
                            break;
                        case 'inative':
                            $produtoUpdate->ExeStatus($produtoAction, '0');
                            WSErro("O registro foi atualizado para <b>inativo</b> e agora é um rascunho!", WS_ALERT);
                            break;
                        case 'delete':
                            $produtoUpdate->ExeDelete($produtoAction);
                            WSErro($produtoUpdate->getError()[0], $produtoUpdate->getError()[1]);
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
<h2>Itens Produtos</h2><small>Cadastro de itens para exibição na página produtos.</small><br /><br />
<div class="card">
    <!-- Default panel sections -->
    <div class="card-header">
        Produto
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
            $produtoi = 0;
            $getPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
            $Pager = new Pager('painel.php?exe=produtos/index&page=');
            $Pager->ExePager($getPage, 10);
            $readBlindagens = new Read;
            $readBlindagens->ExeRead("cad_produtos", "ORDER BY produto_status ASC, produto_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
            if ($readBlindagens->getResult()):
                foreach ($readBlindagens->getResult() as $produto):
                    //$produtoi++;
                    extract($produto);
                    $status = (!$produto_status ? 'style="background: #fffed8"' : '');
                    ?>
                    <tr>
                        <td><?= $produto_id ?></td>
                        <td><?= Check::Image('../uploads/' . $produto_image, $produto_title, 25, 25); ?></td>
                        <td><?= $produto_title; ?></td>
                        <td><a class="act_view text-view" target="_blank" href="<?= HOME ?>/<?= $produto_link; ?>" title="Ver no site"><i class="icon-tv"></i></a>
                        <td>
                            <?php if (!$produto_status): ?>
                                <a class="act_inative text-create" href="painel.php?exe=produtos/index&produto=<?= $produto_id; ?>&action=active" title="Ativar"><i class="icon-line2-like"></i> Ativar</a>
                            <?php else: ?>
                                <a class="act_ative text-delete" href="painel.php?exe=produtos/index&produto=<?= $produto_id; ?>&action=inative" title="Inativar"><i class="icon-line2-dislike"></i> Inativar</a>
                            <?php endif; ?>
                        </td>
                        <td><a class="act_edit text-alter" href="painel.php?exe=produtos/update&produtoid=<?= $produto_id; ?>" title="Editar"><i class="icon-pen1"></i></a></td>
                        <td><!--a class="act_delete" href="painel.php?exe=produtos/index&produto=<?= $produto_id; ?>&action=delete" title="Excluir"><i class="fa fa-times-circle text-red"></i> Deletar</a--></td>
                    </tr>
                    <?php
                endforeach;
            else:
                $Pager->ReturnPage();
                WSErro("Desculpe, ainda não existem produtos cadastrados!", WS_INFOR);
            endif;
            /* $Pager->ExePaginator("cad_produtos");
              echo $Pager->getPaginator(); */
            ?>
        </tbody>
    </table>
</div>
<?php
$Pager->ExePaginator("cad_produtos");
echo $Pager->getPaginator();
?>
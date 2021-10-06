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
            require ('_models/AdminMenu.class.php');
            $menuAction = filter_input(INPUT_GET, 'menu', FILTER_VALIDATE_INT);
            $menuUpdate = new AdminMenu;
            ?>
            <div class="container alert alert-info sticky-float-bottom">
                <div class="row justify-content-between align-items-center">
                    <div class="col-lg-auto mt-2 mb-2">
                    <?php
                    switch ($action):
                        case 'active':
                            $menuUpdate->ExeStatus($menuAction, '1');
                            WSErro("O registro foi atualizado para <b>ativo</b> e publicado!", WS_ACCEPT);
                            break;
                        case 'inative':
                            $menuUpdate->ExeStatus($menuAction, '0');
                            WSErro("O registro foi atualizado para <b>inativo</b> e agora é um rascunho!", WS_ALERT);
                            break;
                        case 'delete':
                            $menuUpdate->ExeDelete($menuAction);
                            WSErro($menuUpdate->getError()[0], $menuUpdate->getError()[1]);
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
        Menu
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
            $Pager = new Pager('painel.php?exe=menus/index&page=');
            $Pager->ExePager($getPage, 10);
            $readEmp = new Read;
            $readEmp->ExeRead("cad_menus", "ORDER BY menu_name DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
            if ($readEmp->getResult()):
                foreach ($readEmp->getResult() as $menu):
                    $empi++;
                    extract($menu);
                    ?>            
                    <tr>
                        <td><?= $menu_id; ?></td>
                        <td><?= $menu_name; ?></td>
                        <td><a class="act_view text-view" target="_blank" href="<?= HOME ?>" title="Ver no site"><i class="icon-tv"></i></a></td>
                        <td>
                            <?php if (!$menu_status): ?>
                                <a class="act_inative text-create" href="painel.php?exe=menus/index&menu=<?= $menu_id; ?>&action=active" title="Ativar"><i class="icon-line2-like"></i> Ativar</a>
                            <?php else: ?>
                                <a class="act_ative text-delete" href="painel.php?exe=menus/index&menu=<?= $menu_id; ?>&action=inative" title="Inativar"><i class="icon-line2-dislike"></i> Inativar</a>
                            <?php endif; ?>
                        </td>  
                        <td><a class="act_edit text-alter" href="painel.php?exe=menus/update&menu=<?= $menu_id; ?>" title="Editar"><i class="icon-pen1"></i></a></td>
                        <td><!--a class="act_delete" href="painel.php?exe=menus/index&menu=<?= $menu_id; ?>&action=delete" title="Excluir">Deletar</a--></td>
                    </tr>
                    <?php
                endforeach;
            else:
                $Pager->ReturnPage();
                WSErro("Desculpe, ainda não existem menus cadastrados!", WS_INFOR);
            endif;
            ?>
        </tbody>
    </table>
</div>
<?php
$Pager->ExePaginator("cad_menus");
echo $Pager->getPaginator();
?>
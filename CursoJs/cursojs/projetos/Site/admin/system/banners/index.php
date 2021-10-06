<?php
if (empty($login)) :
    header('Location: ../../painel.php');
    die;
endif;
?>
        <?php
        $empty = filter_input(INPUT_GET, 'empty', FILTER_VALIDATE_BOOLEAN);
        if ($empty):
            WSErro("Oppsss: Você tentou editar um banner que não existe no sistema!", WS_INFOR);
        endif;
        $action = filter_input(INPUT_GET, 'action', FILTER_DEFAULT);
        if ($action):
            require ('_models/AdminBanner.class.php');
            $bannerAction = filter_input(INPUT_GET, 'banner', FILTER_VALIDATE_INT);
            $bannerUpdate = new AdminBanner;
            ?>
            <div class="container alert alert-info sticky-float-bottom">
                <div class="row justify-content-between align-items-center">
                    <div class="col-lg-auto mt-2 mb-2">
                    <?php
                    switch ($action):
                        case 'active':
                            $bannerUpdate->ExeStatus($bannerAction, '1');
                            WSErro("O registro foi atualizado para <b>ativo</b> e publicado!", WS_ACCEPT);
                            break;
                        case 'inative':
                            $bannerUpdate->ExeStatus($bannerAction, '0');
                            WSErro("O registro foi atualizado para <b>inativo</b> e agora é um rascunho!", WS_ALERT);
                            break;
                        case 'delete':
                            $bannerUpdate->ExeDelete($bannerAction);
                            WSErro($bannerUpdate->getError()[0], $bannerUpdate->getError()[1]);
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
        Banner
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
            $banneri = 0;
            $getPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
            $Pager = new Pager('painel.php?exe=banners/index&page=');
            $Pager->ExePager($getPage, 10);
            $readBanners = new Read;
            $readBanners->ExeRead("cad_banners", "ORDER BY banner_status ASC, banner_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
            if ($readBanners->getResult()):
                foreach ($readBanners->getResult() as $banner):
                    //$banneri++;
                    extract($banner);
                    $status = (!$banner_status ? 'style="background: #fffed8"' : '');
                    ?>
                    <tr>
                        <td><?= $banner_id ?></td>
                        <td><?= Check::Image('../uploads/' . $banner_image, $banner_name, 25, 25); ?></td>
                        <td><?= $banner_name; ?></td>
                        <td><a class="act_view text-view" target="_blank" href="<?= HOME ?>" title="Ver no site"><i class="icon-tv"></i></a></td>
                        <td>
                            <?php if (!$banner_status): ?>
                                <a class="act_inative text-create" href="painel.php?exe=banners/index&banner=<?= $banner_id; ?>&action=active" title="Ativar"><i class="icon-line2-like"></i> Ativar</a>
                            <?php else: ?>
                                <a class="act_ative text-delete" href="painel.php?exe=banners/index&banner=<?= $banner_id; ?>&action=inative" title="Inativar"><i class="icon-line2-dislike"></i> Inativar</a>
                            <?php endif; ?>
                        </td>
                        <td><a class="act_edit text-alter" href="painel.php?exe=banners/update&bannerid=<?= $banner_id; ?>" title="Editar"><i class="icon-pen1"></i></a></td>
                        <td><!--a class="act_delete" href="painel.php?exe=banners/index&banner=<?= $banner_id; ?>&action=delete" title="Excluir"><i class="fa fa-times-circle text-red"></i> Deletar</a--></td>
                    </tr>
                    <?php
                endforeach;
            else:
                $Pager->ReturnPage();
                WSErro("Desculpe, ainda não existem banners cadastrados!", WS_INFOR);
            endif;
            /* $Pager->ExePaginator("cad_banners");
              echo $Pager->getPaginator(); */
            ?>
        </tbody>
    </table>
</div>
<?php
$Pager->ExePaginator("cad_banners");
echo $Pager->getPaginator();
?>
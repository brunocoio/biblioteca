<?php
if (empty($login)) :
    header('Location: ../../painel.php');
    die;
endif;
?>
        <?php
        $empty = filter_input(INPUT_GET, 'empty', FILTER_VALIDATE_BOOLEAN);
        if ($empty):
            WSErro("Oppsss: Você tentou editar um hometestimonial que não existe no sistema!", WS_INFOR);
        endif;
        $action = filter_input(INPUT_GET, 'action', FILTER_DEFAULT);
        if ($action):
            require ('_models/AdminHomeTestimonial.class.php');
            $hometestimonialAction = filter_input(INPUT_GET, 'hometestimonial', FILTER_VALIDATE_INT);
            $hometestimonialUpdate = new AdminHomeTestimonial;
            ?>
            <div class="container alert alert-info sticky-float-bottom">
                <div class="row justify-content-between align-items-center">
                    <div class="col-lg-auto mt-2 mb-2">
                    <?php
                    switch ($action):
                        case 'active':
                            $hometestimonialUpdate->ExeStatus($hometestimonialAction, '1');
                            WSErro("O registro foi atualizado para <b>ativo</b> e publicado!", WS_ACCEPT);
                            break;
                        case 'inative':
                            $hometestimonialUpdate->ExeStatus($hometestimonialAction, '0');
                            WSErro("O registro foi atualizado para <b>inativo</b> e agora é um rascunho!", WS_ALERT);
                            break;
                        case 'delete':
                            $hometestimonialUpdate->ExeDelete($hometestimonialAction);
                            WSErro($hometestimonialUpdate->getError()[0], $hometestimonialUpdate->getError()[1]);
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
    <!-- Default panel testimonials -->
    <div class="card-header">
        Conteúdo do Testemunho
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
            $hometestimoniali = 0;
            $getPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
            $Pager = new Pager('painel.php?exe=hometestimonials/index&page=');
            $Pager->ExePager($getPage, 10);
            $readBlindagens = new Read;
            $readBlindagens->ExeRead("cad_hometestimonials", "ORDER BY hometestimonial_status ASC, hometestimonial_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
            if ($readBlindagens->getResult()):
                foreach ($readBlindagens->getResult() as $hometestimonial):
                    //$hometestimoniali++;
                    extract($hometestimonial);
                    $status = (!$hometestimonial_status ? 'style="background: #fffed8"' : '');
                    ?>
                    <tr>
                        <td><?= $hometestimonial_id ?></td>
                        <td><?= Check::Image('../uploads/' . $hometestimonial_image, $hometestimonial_title, 25, 25); ?></td>
                        <td><?= $hometestimonial_title; ?></td>
                        <td><a class="act_view text-view" target="_blank" href="<?= HOME ?>" title="Ver no site"><i class="icon-tv"></i></a></td>
                        <td>
                            <?php if (!$hometestimonial_status): ?>
                                <a class="act_inative text-create" href="painel.php?exe=hometestimonials/index&hometestimonial=<?= $hometestimonial_id; ?>&action=active" title="Ativar"><i class="icon-line2-like"></i> Ativar</a>
                            <?php else: ?>
                                <a class="act_ative text-delete" href="painel.php?exe=hometestimonials/index&hometestimonial=<?= $hometestimonial_id; ?>&action=inative" title="Inativar"><i class="icon-line2-dislike"></i> Inativar</a>
                            <?php endif; ?>
                        </td>
                        <td><a class="act_edit text-alter" href="painel.php?exe=hometestimonials/update&hometestimonialid=<?= $hometestimonial_id; ?>" title="Editar"><i class="icon-pen1"></i></a></td>
                        <td><!--a class="act_delete" href="painel.php?exe=hometestimonials/index&hometestimonial=<?= $hometestimonial_id; ?>&action=delete" title="Excluir"><i class="fa fa-times-circle text-red"></i> Deletar</a--></td>
                    </tr>
                    <?php
                endforeach;
            else:
                $Pager->ReturnPage();
                WSErro("Desculpe, ainda não existem hometestimonials cadastrados!", WS_INFOR);
            endif;
            /* $Pager->ExePaginator("cad_hometestimonials");
              echo $Pager->getPaginator(); */
            ?>
        </tbody>
    </table>
</div>
<?php
$Pager->ExePaginator("cad_hometestimonials");
echo $Pager->getPaginator();
?>
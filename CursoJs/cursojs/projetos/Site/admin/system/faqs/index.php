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
            require ('_models/AdminFaq.class.php');
            $faqAction = filter_input(INPUT_GET, 'faq', FILTER_VALIDATE_INT);
            $faqUpdate = new AdminFaq;
            ?>
            <div class="container alert alert-info sticky-float-bottom">
                <div class="row justify-content-between align-items-center">
                    <div class="col-lg-auto mt-2 mb-2">
                    <?php
                    switch ($action):
                        case 'active':
                            $faqUpdate->ExeStatus($faqAction, '1');
                            WSErro("O registro foi atualizado para <b>ativo</b> e publicado!", WS_ACCEPT);
                            break;
                        case 'inative':
                            $faqUpdate->ExeStatus($faqAction, '0');
                            WSErro("O registro foi atualizado para <b>inativo</b> e agora é um rascunho!", WS_ALERT);
                            break;
                        case 'delete':
                            $faqUpdate->ExeDelete($faqAction);
                            WSErro($faqUpdate->getError()[0], $faqUpdate->getError()[1]);
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
        Faq
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
            $Pager = new Pager('painel.php?exe=faqs/index&page=');
            $Pager->ExePager($getPage, 10);
            $readEmp = new Read;
            $readEmp->ExeRead("cad_faqs", "ORDER BY faq_name DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
            if ($readEmp->getResult()):
                foreach ($readEmp->getResult() as $faq):
                    $empi++;
                    extract($faq);
                    ?>            
                    <tr>
                        <td><?= $faq_id; ?></td>
                        <td><?= $faq_name; ?></td>
                        <td><a class="act_view text-view" target="_blank" href="<?= HOME ?>/faqs" title="Ver no site"><i class="icon-tv"></i></a>
                        <td>
                            <?php if (!$faq_status): ?>
                                <a class="act_inative text-create" href="painel.php?exe=faqs/index&faq=<?= $faq_id; ?>&action=active" title="Ativar"><i class="icon-line2-like"></i> Ativar</a>
                            <?php else: ?>
                                <a class="act_ative text-delete" href="painel.php?exe=faqs/index&faq=<?= $faq_id; ?>&action=inative" title="Inativar"><i class="icon-line2-dislike"></i> Inativar</a>
                            <?php endif; ?>
                        </td>  
                        <td><a class="act_edit text-alter" href="painel.php?exe=faqs/update&faq=<?= $faq_id; ?>" title="Editar"><i class="icon-pen1"></i></a></td>
                        <td><!--a class="act_delete" href="painel.php?exe=faqs/index&faq=<?= $faq_id; ?>&action=delete" title="Excluir">Deletar</a--></td>
                    </tr>
                    <?php
                endforeach;
            else:
                $Pager->ReturnPage();
                WSErro("Desculpe, ainda não existem faqs cadastrados!", WS_INFOR);
            endif;
            ?>
        </tbody>
    </table>
</div>
<?php
$Pager->ExePaginator("cad_faqs");
echo $Pager->getPaginator();
?>
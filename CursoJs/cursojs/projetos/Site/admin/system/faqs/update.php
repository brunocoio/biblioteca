<?php
if (empty($login)) :
    header('Location: ../../painel.php');
    die;
endif;
?>
<?php
$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$dataid = filter_input(INPUT_GET, 'faq', FILTER_VALIDATE_INT);
$form = '';
if ($data && $data['SendFaqForm']):
    $data['faq_status'] = ($data['SendFaqForm'] == 'Atualizar' ? '0' : '1');
    unset($data['SendFaqForm']);
    require('_models/AdminFaq.class.php');
    $cadastra = new AdminFaq;
    $cadastra->ExeUpdate($dataid, $data);
    WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
    $form = 'display:none';
else:
    $readEmp = new Read;
    $readEmp->ExeRead("cad_faqs", "WHERE faq_id = :faq", "faq={$dataid}");
    if (!$readEmp->getResult()):
        header('Location: painel.php?exe=faqs/index&empty=true');
    else:
        $data = $readEmp->getResult()[0];
    endif;
endif;
$checkCreate = filter_input(INPUT_GET, 'create', FILTER_VALIDATE_BOOLEAN);
if ($checkCreate && empty($cadastra)):
    WSErro("O faq <b>{$data['faq_title']}</b> foi cadastrada com sucesso no sistema!", WS_ACCEPT);
    $form = 'display:none';
endif;
?>
<div class="form">
    <form class="row" name="PostForm" action="" method="post" enctype="multipart/form-data">
        <div class="col-lg-6" style="<?= $form ?>">
            <div class="row checkout-form-billing">
                <div class="col-12">
                    <h3>Alterar Faq</h3>
                </div>
                <div class="col-12 form-group">
                    <label>Pergunta</label>
                    <textarea
                        class="form-control"
                        placeholder="Descrição"
                        name="faq_name"
                        id="editor1"
                        rows="10"
                        required
                        ><?php if (isset($data['faq_name'])) echo htmlspecialchars($data['faq_name']); ?></textarea>
                </div>
                <div class="col-12 form-group">
                    <label>Resposta</label>
                    <textarea
                        class="form-control"
                        placeholder="Descrição"
                        name="faq_content"
                        id="editor1"
                        rows="10"
                        required
                        ><?php if (isset($data['faq_content'])) echo htmlspecialchars($data['faq_content']); ?></textarea>
                </div>
                <div class="form-group input-field col-lg-12 clearfix btnAtualiza">
                    <input type="submit" name="SendFaqForm" value="Atualizar" class="btn btn-info pull-right waves-effect waves-light" />
                    <input type="submit" name="SendFaqForm" value="Atualizar & Publicar" class="btn btn-success pull-right waves-effect waves-light" />
                </div>
            </div>
        </div>
    </form>
</div>
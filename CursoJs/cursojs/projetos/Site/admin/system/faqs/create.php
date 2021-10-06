<?php
if (empty($login)) :
    header('Location: ../../painel.php');
    die;
endif;
?>
<?php
$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$form = '';
if (isset($data) && $data['SendFaqForm']):
    $data['faq_status'] = ($data['SendFaqForm'] == 'Cadastrar' ? '0' : '1' );
    unset($data['SendFaqForm']);
    require('_models/AdminFaq.class.php');
    $cadastra = new AdminFaq;
    $cadastra->ExeCreate($data);
    if ($cadastra->getResult()):
        header('Location: painel.php?exe=faqs/update&create=true&faqid=' . $cadastra->getResult());
    else:
        WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
        $form = '';
    endif;
endif;
?>
<div class="form">
    <form class="row" name="PostForm" action="" method="post" enctype="multipart/form-data">
        <div class="col-lg-6" style="<?= $form ?>">
            <div class="row checkout-form-billing">
                <div class="col-12">
                    <h3>Cadastrar Faq</h3>
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
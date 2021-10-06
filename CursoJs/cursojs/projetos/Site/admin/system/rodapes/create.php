<?php
if (empty($login)) :
    header('Location: ../../painel.php');
    die;
endif;
?>
<?php
$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$form = '';
if (isset($data) && $data['SendRodapeForm']):
    $data['rodape_status'] = ($data['SendRodapeForm'] == 'Cadastrar' ? '0' : '1' );
    unset($data['SendRodapeForm']);
    require('_models/AdminRodape.class.php');
    $cadastra = new AdminRodape;
    $cadastra->ExeCreate($data);
    if ($cadastra->getResult()):
        header('Location: painel.php?exe=rodapes/update&create=true&rodapeid=' . $cadastra->getResult());
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
                    <h3>Cadastrar Rodape</h3>
                </div>
                <div class="col-12 form-group">
                    <label>Pergunta</label>
                    <textarea
                        class="form-control"
                        placeholder="Descrição"
                        name="rodape_name"
                        id="editor1"
                        rows="10"
                        required
                        ><?php if (isset($data['rodape_name'])) echo htmlspecialchars($data['rodape_name']); ?></textarea>
                </div>
                <div class="col-12 form-group">
                    <label>Resposta</label>
                    <textarea
                        class="form-control"
                        placeholder="Descrição"
                        name="rodape_content"
                        id="editor1"
                        rows="10"
                        required
                        ><?php if (isset($data['rodape_content'])) echo htmlspecialchars($data['rodape_content']); ?></textarea>
                </div>
                <div class="form-group input-field col-lg-12 clearfix btnAtualiza">
                    <input type="submit" name="SendRodapeForm" value="Atualizar" class="btn btn-info pull-right waves-effect waves-light" />
                    <input type="submit" name="SendRodapeForm" value="Atualizar & Publicar" class="btn btn-success pull-right waves-effect waves-light" />
                </div>
            </div>
        </div>
    </form>
</div>
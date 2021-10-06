<?php
if (empty($login)) :
    header('Location: ../../painel.php');
    die;
endif;
?>
<?php
$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$form = '';
if (isset($data) && $data['SendMidiasocialForm']):
    $data['midiasocial_status'] = ($data['SendMidiasocialForm'] == 'Cadastrar' ? '0' : '1' );
    unset($data['SendMidiasocialForm']);
    require('_models/AdminMidiasocial.class.php');
    $cadastra = new AdminMidiasocial;
    $cadastra->ExeCreate($data);
    if ($cadastra->getResult()):
        header('Location: painel.php?exe=midiassociais/update&create=true&midiasocialid=' . $cadastra->getResult());
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
                    <h3>Cadastrar Midiasocial</h3>
                </div>
                <div class="col-12 form-group">
                    <label>Pergunta</label>
                    <textarea
                        class="form-control"
                        placeholder="Descrição"
                        name="midiasocial_name"
                        id="editor1"
                        rows="10"
                        required
                        ><?php if (isset($data['midiasocial_name'])) echo htmlspecialchars($data['midiasocial_name']); ?></textarea>
                </div>
                <div class="col-12 form-group">
                    <label>Resposta</label>
                    <textarea
                        class="form-control"
                        placeholder="Descrição"
                        name="midiasocial_content"
                        id="editor1"
                        rows="10"
                        required
                        ><?php if (isset($data['midiasocial_content'])) echo htmlspecialchars($data['midiasocial_content']); ?></textarea>
                </div>
                <div class="form-group input-field col-lg-12 clearfix btnAtualiza">
                    <input type="submit" name="SendMidiasocialForm" value="Atualizar" class="btn btn-info pull-right waves-effect waves-light" />
                    <input type="submit" name="SendMidiasocialForm" value="Atualizar & Publicar" class="btn btn-success pull-right waves-effect waves-light" />
                </div>
            </div>
        </div>
    </form>
</div>
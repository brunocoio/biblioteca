<?php
if (empty($login)) :
    header('Location: ../../painel.php');
    die;
endif;
?>
<?php
$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$dataid = filter_input(INPUT_GET, 'midiasocial', FILTER_VALIDATE_INT);
$form = '';
if ($data && $data['SendMidiasocialForm']):
    $data['midiasocial_status'] = ($data['SendMidiasocialForm'] == 'Atualizar' ? '0' : '1');
    unset($data['SendMidiasocialForm']);
    require('_models/AdminMidiasocial.class.php');
    $cadastra = new AdminMidiasocial;
    $cadastra->ExeUpdate($dataid, $data);
    WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
    $form = 'display:none';
else:
    $readEmp = new Read;
    $readEmp->ExeRead("cad_midiassociais", "WHERE midiasocial_id = :midiasocial", "midiasocial={$dataid}");
    if (!$readEmp->getResult()):
        header('Location: painel.php?exe=midiassociais/index&empty=true');
    else:
        $data = $readEmp->getResult()[0];
    endif;
endif;
$checkCreate = filter_input(INPUT_GET, 'create', FILTER_VALIDATE_BOOLEAN);
if ($checkCreate && empty($cadastra)):
    WSErro("O midiasocial <b>{$data['midiasocial_title']}</b> foi cadastrada com sucesso no sistema!", WS_ACCEPT);
    $form = 'display:none';
endif;
?>
<div class="form">
    <form class="row" name="PostForm" action="" method="post" enctype="multipart/form-data">
        <div class="col-lg-6" style="<?= $form ?>">
            <div class="row checkout-form-billing">
                <div class="col-12">
                    <h3>Alterar MídiaSocial</h3>
                </div>
                <div class="col-12 form-group"> 
                    <label for="midiasocial_name">Título</label>
                    <input
                        class="form-control"
                        type = "text"
                        name = "midiasocial_name"
                        value="<?php if (!empty($data['midiasocial_name'])) echo $data['midiasocial_name']; ?>"
                        title = "Informe o título"
                        required
                        />
                </div>
                <div class="col-12 form-group"> 
                    <label for="midiasocial_url">Link</label>
                    <input
                        class="form-control"
                        type = "text"
                        name = "midiasocial_url"
                        value="<?php if (!empty($data['midiasocial_url'])) echo $data['midiasocial_url']; ?>"
                        title = "Informe o link"
                        required
                        />
                </div>
                <div class="col-12 form-group">
                    <label>Categoria</label>
                    <select class="form-control required" name="midiasocial_category" id="banner_target">
                        <option value="facebook" <?php if (isset($banner['midiasocial_category']) && $banner['midiasocial_category'] == 'facebook') echo 'selected'; ?>> Facebook </option>
                        <option value="instagram" <?php if (isset($banner['midiasocial_category']) && $banner['midiasocial_category'] == 'instagram') echo 'selected'; ?>> Instagram </option>
                        <option value="youtube" <?php if (isset($banner['midiasocial_category']) && $banner['midiasocial_category'] == 'youtube') echo 'selected'; ?>> YouTube </option>
                        <option value="linkedin" <?php if (isset($banner['midiasocial_category']) && $banner['midiasocial_category'] == 'linkedin') echo 'selected'; ?>> Linkedin </option>
                        <option value="whatsapp" <?php if (isset($banner['midiasocial_category']) && $banner['midiasocial_category'] == 'whatsapp') echo 'selected'; ?>> WhatsApp </option>
                    </select>
                </div>
                <div class="form-group input-field col-lg-12 clearfix btnAtualiza">
                    <input type="submit" name="SendMidiasocialForm" value="Atualizar" class="btn btn-info pull-right waves-effect waves-light" />
                    <input type="submit" name="SendMidiasocialForm" value="Atualizar & Publicar" class="btn btn-success pull-right waves-effect waves-light" />
                </div>
            </div>
        </div>
    </form>
</div>
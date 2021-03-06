<?php
if (empty($login)) :
    header('Location: ../../painel.php');
    die;
endif;
?>
<?php
$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$dataid = filter_input(INPUT_GET, 'blindagemid', FILTER_VALIDATE_INT);
$form = '';
if (isset($data) && $data['SendBlindagemForm']):
    $data['blindagem_status'] = ($data['SendBlindagemForm'] == 'Atualizar' ? '0' : '1' );
    $data['blindagem_image'] = ( $_FILES['blindagem_image']['tmp_name'] ? $_FILES['blindagem_image'] : 'null' );
    unset($data['SendBlindagemForm']);
    require('_models/AdminBlindagem.class.php');
    $cadastra = new AdminBlindagem;
    $cadastra->ExeUpdate($dataid, $data);
    WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
    $form = 'display:none';
else:
    $read = new Read;
    $read->ExeRead("cad_blindagens", "WHERE blindagem_id = :id", "id={$dataid}");
    if (!$read->getResult()):
        header('Location: painel.php?exe=blindagens/index&empty=true');
    else:
        $data = $read->getResult()[0];
    endif;
endif;
$checkCreate = filter_input(INPUT_GET, 'create', FILTER_VALIDATE_BOOLEAN);
if ($checkCreate && empty($cadastra)):
    WSErro("O blindagem <b>{$data['blindagem_name']}</b> foi cadastrado com sucesso no sistema!", WS_ACCEPT);
    $form = 'display:none';
endif;
?>
<div class="form">
    <form class="row" name="PostForm" action="" method="post" enctype="multipart/form-data">
        <div class="col-lg-6" style="<?= $form ?>">
            <div class="row checkout-form-billing">
                <div class="col-12">
                    <h3>Alterar Blindagem</h3>
                </div>
                <?php
                if (!empty($data['blindagem_image'])):
                    $cpi = 0;
                    $Capa = new Read;
                    $Capa->ExeRead("cad_blindagens", "WHERE blindagem_id = :blindagem", "blindagem={$dataid}");
                    if ($Capa->getResult()):
                        foreach ($Capa->getResult() as $cp):
                            $cpi++;
                            ?>
                            <div class="col-lg-12">
                                <?= Check::Image('../uploads/' . $cp['blindagem_image'], $cpi, 146, 100); ?>
                            </div>
                            <?php
                        endforeach;
                    endif;
                endif;
                ?>
                <div class="col-12 form-group">          
                    <span class="field">Enviar Capa</span>
                    <input type="file" name="blindagem_image" class="btn btn-danger" />
                </div>
                <div class="col-12 form-group"> 
                    <label for="blindagem_name">T??tulo</label>
                    <input
                        class="form-control"
                        type = "text"
                        name = "blindagem_name"
                        value="<?php if (!empty($data['blindagem_name'])) echo $data['blindagem_name']; ?>"
                        title = "Informe o t??tulo"
                        required
                        />
                </div>
                <div class="col-12 form-group"> 
                    <label for="blindagem_link">Link</label>
                    <input
                        class="form-control"
                        type = "text"
                        name = "blindagem_link"
                        value="<?php if (!empty($data['blindagem_link'])) echo $data['blindagem_link']; ?>"
                        title = "Informe o link"
                        />
                </div>
                <div class="col-12 form-group">
                    <label>Target</label>
                    <select class="form-control required" name="blindagem_target" id="blindagem_target">
                        <option value="self" <?php if (isset($data['blindagem_target']) && $data['blindagem_target'] == 'self') echo 'selected'; ?>> Mesma p??gina </option>
                        <option value="_blank" <?php if (isset($data['blindagem_target']) && $data['blindagem_target'] == '_blank') echo 'selected'; ?>> Nova p??gina </option>
                        <option value=""> Selecionar </option>
                    </select>
                </div>
                <div class="col-12 form-group">
                    <label>Conte??do</label>
                    <textarea
                        class="form-control"
                        placeholder="Descri????o"
                        name="blindagem_content"
                        id="editor1"
                        rows="10"
                        required
                        ><?php if (isset($data['blindagem_content'])) echo htmlspecialchars($data['blindagem_content']); ?></textarea>
                </div>
                <div class="col-12 form-group">
                    <label>Resumo</label>
                    <textarea
                        class="form-control"
                        placeholder="Descri????o"
                        name="blindagem_resumo"
                        id="editor1"
                        rows="10"
                        required
                        ><?php if (isset($data['blindagem_resumo'])) echo htmlspecialchars($data['blindagem_resumo']); ?></textarea>
                </div>
                <div class="form-group input-field col-lg-12 clearfix btnAtualiza">
                    <input type="submit" name="SendBlindagemForm" value="Atualizar" class="btn btn-info pull-right waves-effect waves-light" />
                    <input type="submit" name="SendBlindagemForm" value="Atualizar & Publicar" class="btn btn-success pull-right waves-effect waves-light" />
                </div>
            </div>
        </div>
    </form>
</div>
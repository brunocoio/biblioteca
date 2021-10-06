<?php
if (empty($login)) :
    header('Location: ../../painel.php');
    die;
endif;
?>
<?php
$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$form = '';
if (isset($data) && $data['SendBlindagemForm']):
    $data['blindagem_status'] = ($data['SendBlindagemForm'] == 'Cadastrar' ? '0' : '1' );
    $data['blindagem_image'] = ( $_FILES['blindagem_image']['tmp_name'] ? $_FILES['blindagem_image'] : null );
    unset($data['SendBlindagemForm']);
    require('_models/AdminBlindagem.class.php');
    $cadastra = new AdminBlindagem;
    $cadastra->ExeCreate($data);
    if ($cadastra->getResult()):
        header('Location: painel.php?exe=blindagens/update&create=true&blindagemid=' . $cadastra->getResult());
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
                    <h3>Cadastrar Páginas</h3>
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
                    <span class="field">Enviar Capa:</span>
                    <input type="file" name="blindagem_image" class="btn btn-danger" />
                </div>
                <div class="col-12 form-group"> 
                    <label for="blindagem_name">Título</label>
                    <input
                        class="form-control"
                        type = "text"
                        name = "blindagem_name"
                        value="<?php if (!empty($data['blindagem_name'])) echo $data['blindagem_name']; ?>"
                        title = "Informe o título"
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
                    <label>Target:</label>
                    <select class="form-control required" name="blindagem_target" id="blindagem_target">
                        <option value="self" <?php if (isset($data['blindagem_target']) && $data['blindagem_target'] == 'self') echo 'selected'; ?>> Mesma página </option>
                        <option value="_blank" <?php if (isset($data['blindagem_target']) && $data['blindagem_target'] == '_blank') echo 'selected'; ?>> Nova página </option>
                        <option value="" selected> Selecionar </option>
                    </select>
                </div>
                <div class="col-12 form-group">
                    <label>Conteúdo:</label>
                    <textarea
                        class="form-control"
                        placeholder="Descrição"
                        name="blindagem_content"
                        id="editor1"
                        rows="10"
                        required
                        ><?php if (isset($data['blindagem_content'])) echo htmlspecialchars($data['blindagem_content']); ?></textarea>
                </div>
                <div class="col-12 form-group">
                    <label>Resumo:</label>
                    <textarea
                        class="form-control"
                        placeholder="Descrição"
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
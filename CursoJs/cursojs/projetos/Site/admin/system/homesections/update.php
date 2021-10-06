<?php
if (empty($login)) :
    header('Location: ../../painel.php');
    die;
endif;
?>
<?php
$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$dataid = filter_input(INPUT_GET, 'homesectionid', FILTER_VALIDATE_INT);
$form = '';
if (isset($data) && $data['SendHomeSectionForm']):
    $data['homesection_status'] = ($data['SendHomeSectionForm'] == 'Atualizar' ? '0' : '1' );
    $data['homesection_image'] = ( $_FILES['homesection_image']['tmp_name'] ? $_FILES['homesection_image'] : 'null' );
    unset($data['SendHomeSectionForm']);
    require('_models/AdminHomeSection.class.php');
    $cadastra = new AdminHomeSection;
    $cadastra->ExeUpdate($dataid, $data);
    WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
    $form = 'display:none';
else:
    $read = new Read;
    $read->ExeRead("cad_homesections", "WHERE homesection_id = :id", "id={$dataid}");
    if (!$read->getResult()):
        header('Location: painel.php?exe=homesections/index&empty=true');
    else:
        $data = $read->getResult()[0];
    endif;
endif;
$checkCreate = filter_input(INPUT_GET, 'create', FILTER_VALIDATE_BOOLEAN);
if ($checkCreate && empty($cadastra)):
    WSErro("O homesection <b>{$data['homesection_title']}</b> foi cadastrado com sucesso no sistema!", WS_ACCEPT);
    $form = 'display:none';
endif;
?>
<div class="form">
    <form class="row" name="PostForm" action="" method="post" enctype="multipart/form-data">
        <div class="col-lg-6" style="<?= $form ?>">
            <div class="row checkout-form-billing">
                <div class="col-12">
                    <h3>Alterar HomeSection</h3>
                </div>
                <?php
                if (!empty($data['homesection_image'])):
                    $cpi = 0;
                    $Capa = new Read;
                    $Capa->ExeRead("cad_homesections", "WHERE homesection_id = :homesection", "homesection={$dataid}");
                    if ($Capa->getResult()):
                        foreach ($Capa->getResult() as $cp):
                            $cpi++;
                            ?>
                            <div class="col-lg-12">
                                <?= Check::Image('../uploads/' . $cp['homesection_image'], $cpi, 146, 100); ?>
                            </div>
                            <?php
                        endforeach;
                    endif;
                endif;
                ?>
                <div class="col-12 form-group">          
                    <span class="field">Enviar Capa</span>
                    <input type="file" name="homesection_image" class="btn btn-danger" />
                </div>
                <div class="col-12 form-group"> 
                    <label for="homesection_title">Título</label>
                    <input
                        class="form-control"
                        type = "text"
                        name = "homesection_title"
                        value="<?php if (!empty($data['homesection_title'])) echo $data['homesection_title']; ?>"
                        title = "Informe o título"
                        required
                        />
                </div>
                <div class="col-12 form-group"> 
                    <label for="homesection_subtitle">SubTítulo</label>
                    <input
                        class="form-control"
                        type = "text"
                        name = "homesection_subtitle"
                        value="<?php if (!empty($data['homesection_subtitle'])) echo $data['homesection_subtitle']; ?>"
                        title = "Informe o título"
                        required
                        />
                </div>
                <div class="col-6 form-group"> 
                    <label for="homesection_subtitle1">SubTítulo 1</label>
                    <input
                        class="form-control"
                        type = "text"
                        name = "homesection_subtitle1"
                        value="<?php if (!empty($data['homesection_subtitle1'])) echo $data['homesection_subtitle1']; ?>"
                        title = "Informe o título"
                        required
                        />
                </div>
                <div class="col-6 form-group"> 
                    <label for="homesection_subtitle3">SubTítulo 3</label>
                    <input
                        class="form-control"
                        type = "text"
                        name = "homesection_subtitle3"
                        value="<?php if (!empty($data['homesection_subtitle3'])) echo $data['homesection_subtitle3']; ?>"
                        title = "Informe o título"
                        required
                        />
                </div>
                <div class="col-6 form-group">
                    <label>Conteúdo 1</label>
                    <textarea
                        class="form-control"
                        placeholder="Descrição"
                        name="homesection_content1"
                        id="editor1"
                        rows="10"
                        required
                        ><?php if (isset($data['homesection_content1'])) echo htmlspecialchars($data['homesection_content1']); ?></textarea>
                </div>
                <div class="col-6 form-group">
                    <label>Conteúdo 3</label>
                    <textarea
                        class="form-control"
                        placeholder="Descrição"
                        name="homesection_content3"
                        id="editor1"
                        rows="10"
                        required
                        ><?php if (isset($data['homesection_content3'])) echo htmlspecialchars($data['homesection_content3']); ?></textarea>
                </div>
                <div class="col-6 form-group"> 
                    <label for="homesection_subtitle2">SubTítulo 2</label>
                    <input
                        class="form-control"
                        type = "text"
                        name = "homesection_subtitle2"
                        value="<?php if (!empty($data['homesection_subtitle2'])) echo $data['homesection_subtitle2']; ?>"
                        title = "Informe o título"
                        required
                        />
                </div>
                <div class="col-6 form-group"> 
                    <label for="homesection_subtitle4">SubTítulo 4</label>
                    <input
                        class="form-control"
                        type = "text"
                        name = "homesection_subtitle4"
                        value="<?php if (!empty($data['homesection_subtitle4'])) echo $data['homesection_subtitle4']; ?>"
                        title = "Informe o título"
                        required
                        />
                </div>
                <div class="col-6 form-group">
                    <label>Conteúdo 2</label>
                    <textarea
                        class="form-control"
                        placeholder="Descrição"
                        name="homesection_content2"
                        id="editor1"
                        rows="10"
                        required
                        ><?php if (isset($data['homesection_content2'])) echo htmlspecialchars($data['homesection_content2']); ?></textarea>
                </div>
                <div class="col-6 form-group">
                    <label>Conteúdo 4</label>
                    <textarea
                        class="form-control"
                        placeholder="Descrição"
                        name="homesection_content4"
                        id="editor1"
                        rows="10"
                        required
                        ><?php if (isset($data['homesection_content4'])) echo htmlspecialchars($data['homesection_content4']); ?></textarea>
                </div>
                <div class="form-group input-field col-lg-12 clearfix btnAtualiza">
                    <input type="submit" name="SendHomeSectionForm" value="Atualizar" class="btn btn-info pull-right waves-effect waves-light" />
                    <input type="submit" name="SendHomeSectionForm" value="Atualizar & Publicar" class="btn btn-success pull-right waves-effect waves-light" />
                </div>
            </div>
        </div>
    </form>
</div>
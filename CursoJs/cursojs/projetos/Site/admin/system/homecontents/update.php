<?php
if (empty($login)) :
    header('Location: ../../painel.php');
    die;
endif;
?>
<?php
$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$dataid = filter_input(INPUT_GET, 'homecontentid', FILTER_VALIDATE_INT);
$form = '';
if (isset($data) && $data['SendHomeContentForm']):
    $data['homecontent_status'] = ($data['SendHomeContentForm'] == 'Atualizar' ? '0' : '1' );
    $data['homecontent_image'] = ( $_FILES['homecontent_image']['tmp_name'] ? $_FILES['homecontent_image'] : 'null' );
    unset($data['SendHomeContentForm']);
    require('_models/AdminHomeContent.class.php');
    $cadastra = new AdminHomeContent;
    $cadastra->ExeUpdate($dataid, $data);
    WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
    $form = 'display:none';
else:
    $read = new Read;
    $read->ExeRead("cad_homecontents", "WHERE homecontent_id = :id", "id={$dataid}");
    if (!$read->getResult()):
        header('Location: painel.php?exe=homecontents/index&empty=true');
    else:
        $data = $read->getResult()[0];
    endif;
endif;
$checkCreate = filter_input(INPUT_GET, 'create', FILTER_VALIDATE_BOOLEAN);
if ($checkCreate && empty($cadastra)):
    WSErro("O homecontent <b>{$data['homecontent_title']}</b> foi cadastrado com sucesso no sistema!", WS_ACCEPT);
    $form = 'display:none';
endif;
?>
<div class="form">
    <form class="row" name="PostForm" action="" method="post" enctype="multipart/form-data">
        <div class="col-lg-6" style="<?= $form ?>">
            <div class="row checkout-form-billing">
                <div class="col-12">
                    <h3>Alterar HomeContent</h3>
                </div>
                <?php
                if (!empty($data['homecontent_image'])):
                    $cpi = 0;
                    $Capa = new Read;
                    $Capa->ExeRead("cad_homecontents", "WHERE homecontent_id = :homecontent", "homecontent={$dataid}");
                    if ($Capa->getResult()):
                        foreach ($Capa->getResult() as $cp):
                            $cpi++;
                            ?>
                            <div class="col-lg-12">
                                <?= Check::Image('../uploads/' . $cp['homecontent_image'], $cpi, 146, 100); ?>
                            </div>
                            <?php
                        endforeach;
                    endif;
                endif;
                ?>
                <div class="col-12 form-group">          
                    <span class="field">Enviar Capa</span>
                    <input type="file" name="homecontent_image" class="btn btn-danger" />
                </div>
                <div class="col-12 form-group"> 
                    <label for="homecontent_title">Título</label>
                    <input
                        class="form-control"
                        type = "text"
                        name = "homecontent_title"
                        value="<?php if (!empty($data['homecontent_title'])) echo $data['homecontent_title']; ?>"
                        title = "Informe o título"
                        required
                        />
                </div>
                <div class="col-12 form-group">
                    <label>Conteúdo</label>
                    <textarea
                        class="form-control"
                        placeholder="Descrição"
                        name="homecontent_content"
                        id="editor1"
                        rows="10"
                        required
                        ><?php if (isset($data['homecontent_content'])) echo htmlspecialchars($data['homecontent_content']); ?></textarea>
                </div>
                <div class="form-group input-field col-lg-12 clearfix btnAtualiza">
                    <input type="submit" name="SendHomeContentForm" value="Atualizar" class="btn btn-info pull-right waves-effect waves-light" />
                    <input type="submit" name="SendHomeContentForm" value="Atualizar & Publicar" class="btn btn-success pull-right waves-effect waves-light" />
                </div>
            </div>
        </div>
    </form>
</div>
<?php
if (empty($login)) :
    header('Location: ../../painel.php');
    die;
endif;
?>
<?php
$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$dataid = filter_input(INPUT_GET, 'pageid', FILTER_VALIDATE_INT);
$form = '';
if (isset($data) && $data['SendPageForm']):
    $data['page_status'] = ($data['SendPageForm'] == 'Atualizar' ? '0' : '1' );
    $data['page_image'] = ( $_FILES['page_image']['tmp_name'] ? $_FILES['page_image'] : 'null' );
    unset($data['SendPageForm']);
    require('_models/AdminPage.class.php');
    $cadastra = new AdminPage;
    $cadastra->ExeUpdate($dataid, $data);
    WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
    $form = 'display:none';
else:
    $read = new Read;
    $read->ExeRead("cad_pages", "WHERE page_id = :id", "id={$dataid}");
    if (!$read->getResult()):
        header('Location: painel.php?exe=pages/index&empty=true');
    else:
        $data = $read->getResult()[0];
    endif;
endif;
$checkCreate = filter_input(INPUT_GET, 'create', FILTER_VALIDATE_BOOLEAN);
if ($checkCreate && empty($cadastra)):
    WSErro("O page <b>{$data['page_title']}</b> foi cadastrado com sucesso no sistema!", WS_ACCEPT);
    $form = 'display:none';
endif;
?>
<div class="form">
    <form class="row" name="PostForm" action="" method="post" enctype="multipart/form-data">
        <div class="col-lg-6" style="<?= $form ?>">
            <div class="row checkout-form-billing">
                <div class="col-12">
                    <h3>Alterar Capa de Página <?=$data['page_name']?></h3>
                </div>
                <?php
                if (!empty($data['page_image'])):
                    $cpi = 0;
                    $Capa = new Read;
                    $Capa->ExeRead("cad_pages", "WHERE page_id = :page", "page={$dataid}");
                    if ($Capa->getResult()):
                        foreach ($Capa->getResult() as $cp):
                            $cpi++;
                            ?>
                            <div class="col-lg-12">
                                <?= Check::Image('../uploads/' . $cp['page_image'], $cpi, 146, 100); ?>
                            </div>
                            <?php
                        endforeach;
                    endif;
                endif;
                ?>
                <div class="col-12 form-group">          
                    <span class="field">Enviar Capa</span>
                    <input type="file" name="page_image" class="btn btn-danger" />
                </div>
                <div class="col-12 form-group"> 
                    <label for="page_title">Título</label>
                    <input
                        class="form-control"
                        type = "text"
                        name = "page_title"
                        value="<?php if (!empty($data['page_title'])) echo $data['page_title']; ?>"
                        title = "Informe o título"
                        required
                        />
                </div>
                <div class="col-12 form-group"> 
                    <label for="page_subtitle">SubTítulo</label>
                    <input
                        class="form-control"
                        type = "text"
                        name = "page_subtitle"
                        value="<?php if (!empty($data['page_subtitle'])) echo $data['page_subtitle']; ?>"
                        title = "Informe o título"
                        required
                        />
                </div>
                <div class="col-12 form-group">
                    <label>Conteúdo</label>
                    <textarea
                        class="form-control"
                        placeholder="Descrição"
                        name="page_content"
                        id="editor1"
                        rows="10"
                        ><?php if (isset($data['page_content'])) echo htmlspecialchars($data['page_content']); ?></textarea>
                </div>
                <div class="form-group input-field col-lg-12 clearfix btnAtualiza">
                    <input type="submit" name="SendPageForm" value="Atualizar" class="btn btn-info pull-right waves-effect waves-light" />
                    <input type="submit" name="SendPageForm" value="Atualizar & Publicar" class="btn btn-success pull-right waves-effect waves-light" />
                </div>
            </div>
        </div>
    </form>
</div>
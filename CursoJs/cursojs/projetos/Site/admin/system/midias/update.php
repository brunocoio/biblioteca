<?php
if (empty($login)) :
    header('Location: ../../painel.php');
    die;
endif;
?>
<?php
$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$dataid = filter_input(INPUT_GET, 'midia', FILTER_VALIDATE_INT);
$form = '';
if ($data && $data['SendMidiaForm']):
    $data['midia_status'] = ($data['SendMidiaForm'] == 'Atualizar' ? '0' : '1');
    unset($data['SendMidiaForm']);
    require('_models/AdminMidia.class.php');
    $cadastra = new AdminMidia;
    $cadastra->ExeUpdate($dataid, $data);
    WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
    $form = 'display:none';
else:
    $readEmp = new Read;
    $readEmp->ExeRead("cad_midias", "WHERE midia_id = :midia", "midia={$dataid}");
    if (!$readEmp->getResult()):
        header('Location: painel.php?exe=midias/index&empty=true');
    else:
        $data = $readEmp->getResult()[0];
    endif;
endif;
$checkCreate = filter_input(INPUT_GET, 'create', FILTER_VALIDATE_BOOLEAN);
if ($checkCreate && empty($cadastra)):
    WSErro("O midia <b>{$data['midia_title']}</b> foi cadastrada com sucesso no sistema!", WS_ACCEPT);
    $form = 'display:none';
endif;
?>
<div class="form">
    <form class="row" name="PostForm" action="" method="post" enctype="multipart/form-data">
        <div class="col-lg-6" style="<?= $form ?>">
            <div class="row checkout-form-billing">
                <div class="col-12">
                    <h3>Alterar Mídia</h3>
                </div>
                <div class="col-12 form-group"> 
                    <label for="midia_name">Título</label>
                    <input
                        class="form-control"
                        type = "text"
                        name = "midia_name"
                        value="<?php if (!empty($data['midia_name'])) echo $data['midia_name']; ?>"
                        title = "Informe o título"
                        required
                        />
                </div>
                <div class="col-12 form-group">
                    <label>Link</label>
                    <textarea
                        class="form-control"
                        placeholder="Descrição"
                        name="midia_url"
                        id="editor1"
                        rows="10"
                        required
                        ><?php if (isset($data['midia_url'])) echo htmlspecialchars($data['midia_url']); ?></textarea>
                </div>
                <div class="col-12 form-group">
                    <label>Conteúdo</label>
                    <textarea
                        class="form-control"
                        placeholder="Descrição"
                        name="midia_content"
                        id="editor1"
                        rows="10"
                        required
                        ><?php if (isset($data['midia_content'])) echo htmlspecialchars($data['midia_content']); ?></textarea>
                </div>
                <div class="form-group input-field col-lg-12 clearfix btnAtualiza">
                    <input type="submit" name="SendMidiaForm" value="Atualizar" class="btn btn-info pull-right waves-effect waves-light" />
                    <input type="submit" name="SendMidiaForm" value="Atualizar & Publicar" class="btn btn-success pull-right waves-effect waves-light" />
                </div>
            </div>
        </div>
    </form>
</div>
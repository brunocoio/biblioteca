<?php
if (empty($login)) :
    header('Location: ../../painel.php');
    die;
endif;
?>
<?php
$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$dataid = filter_input(INPUT_GET, 'rodape', FILTER_VALIDATE_INT);
$form = '';
if ($data && $data['SendRodapeForm']):
    $data['rodape_status'] = ($data['SendRodapeForm'] == 'Atualizar' ? '0' : '1');
    unset($data['SendRodapeForm']);
    require('_models/AdminRodape.class.php');
    $cadastra = new AdminRodape;
    $cadastra->ExeUpdate($dataid, $data);
    WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
    $form = 'display:none';
else:
    $readEmp = new Read;
    $readEmp->ExeRead("cad_rodapes", "WHERE rodape_id = :rodape", "rodape={$dataid}");
    if (!$readEmp->getResult()):
        header('Location: painel.php?exe=rodapes/index&empty=true');
    else:
        $data = $readEmp->getResult()[0];
    endif;
endif;
$checkCreate = filter_input(INPUT_GET, 'create', FILTER_VALIDATE_BOOLEAN);
if ($checkCreate && empty($cadastra)):
    WSErro("O rodape <b>{$data['rodape_title']}</b> foi cadastrada com sucesso no sistema!", WS_ACCEPT);
    $form = 'display:none';
endif;
?>
<div class="form">
    <form class="row" name="PostForm" action="" method="post" enctype="multipart/form-data">
        <div class="col-lg-6" style="<?= $form ?>">
            <div class="row checkout-form-billing">
                <div class="col-12">
                    <h3>Alterar Rodape</h3>
                </div>
                <div class="col-12 form-group"> 
                    <label for="rodape_name">Título</label>
                    <input
                        class="form-control"
                        type = "text"
                        name = "rodape_name"
                        value="<?php if (!empty($data['rodape_name'])) echo $data['rodape_name']; ?>"
                        title = "Informe o título"
                        required
                        />
                </div>
                <div class="col-12 form-group">
                    <label>Endereço</label>
                    <textarea
                        class="form-control"
                        placeholder="Descrição"
                        name="rodape_content"
                        id="editor1"
                        rows="10"
                        required
                        ><?php if (isset($data['rodape_content'])) echo htmlspecialchars($data['rodape_content']); ?></textarea>
                </div>
                <div class="col-12 form-group"> 
                    <label for="rodape_tel">Telefone</label>
                    <input
                        class="form-control"
                        type = "text"
                        name = "rodape_tel"
                        value="<?php if (!empty($data['rodape_tel'])) echo $data['rodape_tel']; ?>"
                        title = "Informe o telefone"
                        />
                </div>
                <div class="col-12 form-group"> 
                    <label for="rodape_mail">E-mail</label>
                    <input
                        class="form-control"
                        type = "text"
                        name = "rodape_mail"
                        value="<?php if (!empty($data['rodape_mail'])) echo $data['rodape_mail']; ?>"
                        title = "Informe o E-mail"
                        />
                </div>
                <div class="form-group input-field col-lg-12 clearfix btnAtualiza">
                    <input type="submit" name="SendRodapeForm" value="Atualizar" class="btn btn-info pull-right waves-effect waves-light" />
                    <input type="submit" name="SendRodapeForm" value="Atualizar & Publicar" class="btn btn-success pull-right waves-effect waves-light" />
                </div>
            </div>
        </div>
    </form>
</div>
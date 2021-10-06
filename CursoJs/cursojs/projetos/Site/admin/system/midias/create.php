<?php
if (empty($login)) :
    header('Location: ../../painel.php');
    die;
endif;
?>
<?php
$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$form = '';
if (isset($data) && $data['SendMenuForm']):
    $data['menu_status'] = ($data['SendMenuForm'] == 'Cadastrar' ? '0' : '1' );
    unset($data['SendMenuForm']);
    require('_models/AdminMenu.class.php');
    $cadastra = new AdminMenu;
    $cadastra->ExeCreate($data);
    if ($cadastra->getResult()):
        header('Location: painel.php?exe=menus/update&create=true&menuid=' . $cadastra->getResult());
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
                    <h3>Alterar Mídias</h3>
                </div>
                <div class="col-12 form-group"> 
                    <label for="menu_name">Título</label>
                    <input
                        class="form-control"
                        type = "text"
                        name = "menu_name"
                        value="<?php if (!empty($data['menu_name'])) echo $data['menu_name']; ?>"
                        title = "Informe o título"
                        required
                        />
                </div>
                <div class="col-12 form-group"> 
                    <label for="menu_url">Link</label>
                    <input
                        class="form-control"
                        type = "text"
                        name = "menu_url"
                        value="<?php if (!empty($data['menu_url'])) echo $data['menu_url']; ?>"
                        title = "Informe o link"
                        />
                </div>
                <div class="col-12 form-group">
                    <label>Target:</label>
                    <select class="form-control required" name="menu_target" id="menu_target">
                        <option value="self" <?php if (isset($data['menu_target']) && $data['menu_target'] == 'self') echo 'selected'; ?>> Mesma página </option>
                        <option value="_blank" <?php if (isset($data['menu_target']) && $data['menu_target'] == '_blank') echo 'selected'; ?>> Nova página </option>
                        <option value=""> Selecionar </option>
                    </select>
                </div>
                <div class="form-group input-field col-lg-12 clearfix btnAtualiza">
                    <input type="submit" name="SendMenuForm" value="Atualizar" class="btn btn-info pull-right waves-effect waves-light" />
                    <input type="submit" name="SendMenuForm" value="Atualizar & Publicar" class="btn btn-success pull-right waves-effect waves-light" />
                </div>
            </div>
        </div>
    </form>
</div>
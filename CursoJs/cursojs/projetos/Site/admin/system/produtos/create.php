<?php
if (empty($login)) :
    header('Location: ../../painel.php');
    die;
endif;
?>
<?php
$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$form = '';
if (isset($data) && $data['SendProdutoForm']):
    $data['produto_status'] = ($data['SendProdutoForm'] == 'Cadastrar' ? '0' : '1' );
    $data['produto_image'] = ( $_FILES['produto_image']['tmp_name'] ? $_FILES['produto_image'] : null );
    unset($data['SendProdutoForm']);
    require('_models/AdminProduto.class.php');
    $cadastra = new AdminProduto;
    $cadastra->ExeCreate($data);
    if ($cadastra->getResult()):
        header('Location: painel.php?exe=blindagens/update&create=true&produtoid=' . $cadastra->getResult());
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
                    <h3>Cadastrar Produto</h3>
                </div>
                <?php
                if (!empty($data['produto_image'])):
                    $cpi = 0;
                    $Capa = new Read;
                    $Capa->ExeRead("cad_produtos", "WHERE produto_id = :produto", "produto={$dataid}");
                    if ($Capa->getResult()):
                        foreach ($Capa->getResult() as $cp):
                            $cpi++;
                            ?>
                            <div class="col-lg-12">
                                <?= Check::Image('../uploads/' . $cp['produto_image'], $cpi, 146, 100); ?>
                            </div>
                            <?php
                        endforeach;
                    endif;
                endif;
                ?>
                <div class="col-12 form-group">          
                    <span class="field">Enviar Capa</span>
                    <input type="file" name="produto_image" class="btn btn-danger" />
                </div>
                <div class="col-12 form-group"> 
                    <label for="produto_name">Nome</label>
                    <input
                        class="form-control"
                        type = "text"
                        name = "produto_name"
                        value="<?php if (!empty($data['produto_name'])) echo $data['produto_name']; ?>"
                        title = "Informe o nome"
                        required
                        />
                </div>
                <div class="col-12 form-group"> 
                    <label for="produto_title">T??tulo</label>
                    <input
                        class="form-control"
                        type = "text"
                        name = "produto_title"
                        value="<?php if (!empty($data['produto_title'])) echo $data['produto_title']; ?>"
                        title = "Informe o t??tulo"
                        required
                        />
                </div>
                <div class="col-12 form-group"> 
                    <label for="produto_nivel">N??vel</label>
                    <input
                        class="form-control"
                        type = "text"
                        name = "produto_nivel"
                        value="<?php if (!empty($data['produto_nivel'])) echo $data['produto_nivel']; ?>"
                        title = "Informe o n??vel"
                        required
                        />
                </div>
                <div class="col-12 form-group">
                    <label>Conte??do</label>
                    <textarea
                        class="form-control"
                        placeholder="Descri????o"
                        name="produto_content"
                        id="editor1"
                        rows="10"
                        required
                        ><?php if (isset($data['produto_content'])) echo htmlspecialchars($data['produto_content']); ?></textarea>
                </div>
                <div class="col-12 form-group">
                    <label>Descri????o</label>
                    <textarea
                        class="form-control"
                        placeholder="Descri????o"
                        name="produto_desc"
                        id="editor1"
                        rows="10"
                        required
                        ><?php if (isset($data['produto_desc'])) echo htmlspecialchars($data['produto_desc']); ?></textarea>
                </div>
                <div class="col-12 form-group"> 
                    <label for="produto_link">Link</label>
                    <input
                        class="form-control"
                        type = "text"
                        name = "produto_link"
                        value="<?php if (!empty($data['produto_link'])) echo $data['produto_link']; ?>"
                        title = "Informe o link"
                        required
                        />
                </div>
                <div class="col-12 form-group">
                    <label>Categoria</label>
                    <select class="form-control required" name="produto_categoria" id="produto_categoria">
                        <option value="Civil" <?php if (isset($banner['produto_categoria']) && $banner['produto_categoria'] == 'Civil') echo 'selected'; ?>> Civil </option>
                        <option value="Policial" <?php if (isset($banner['produto_categoria']) && $banner['produto_categoria'] == 'Policial') echo 'selected'; ?>> Policial </option>
                        <option value="Militar" <?php if (isset($banner['produto_categoria']) && $banner['produto_categoria'] == 'Militar') echo 'selected'; ?>> Militar </option>
                        <option value="Patrimonial" <?php if (isset($banner['produto_categoria']) && $banner['produto_categoria'] == 'Patrimonial') echo 'selected'; ?>> Patrimonial </option>
                    </select>
                </div>
                <div class="form-group input-field col-lg-12 clearfix btnAtualiza">
                    <input type="submit" name="SendProdutoForm" value="Atualizar" class="btn btn-info pull-right waves-effect waves-light" />
                    <input type="submit" name="SendProdutoForm" value="Atualizar & Publicar" class="btn btn-success pull-right waves-effect waves-light" />
                </div>
            </div>
        </div>
    </form>
</div>
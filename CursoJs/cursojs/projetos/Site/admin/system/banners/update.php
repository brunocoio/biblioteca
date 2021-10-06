<?php
if (empty($login)) :
    header('Location: ../../painel.php');
    die;
endif;
?>
<?php
$banner = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$bannerid = filter_input(INPUT_GET, 'bannerid', FILTER_VALIDATE_INT);
$form = '';
if (isset($banner) && $banner['SendBannerForm']):
    $banner['banner_status'] = ($banner['SendBannerForm'] == 'Atualizar' ? '0' : '1' );
    $banner['banner_image'] = ( $_FILES['banner_image']['tmp_name'] ? $_FILES['banner_image'] : 'null' );
    unset($banner['SendBannerForm']);
    require('_models/AdminBanner.class.php');
    $cadastra = new AdminBanner;
    $cadastra->ExeUpdate($bannerid, $banner);
    WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
    $form = 'display:none';
else:
    $read = new Read;
    $read->ExeRead("cad_banners", "WHERE banner_id = :id", "id={$bannerid}");
    if (!$read->getResult()):
        header('Location: painel.php?exe=banners/index&empty=true');
    else:
        $banner = $read->getResult()[0];
    endif;
endif;
$checkCreate = filter_input(INPUT_GET, 'create', FILTER_VALIDATE_BOOLEAN);
if ($checkCreate && empty($cadastra)):
    WSErro("O banner <b>{$banner['banner_title']}</b> foi cadastrado com sucesso no sistema!", WS_ACCEPT);
    $form = 'display:none';
endif;
?>
<div class="form">
    <form class="row" name="PostForm" action="" method="post" enctype="multipart/form-data">
        <div class="col-lg-6" style="<?= $form ?>">
            <div class="row checkout-form-billing">
                <div class="col-12">
                    <h3>Alterar Banner</h3>
                </div>
                <?php
                if (!empty($banner['banner_image'])):
                    $cpi = 0;
                    $Capa = new Read;
                    $Capa->ExeRead("cad_banners", "WHERE banner_id = :banner", "banner={$bannerid}");
                    if ($Capa->getResult()):
                        foreach ($Capa->getResult() as $cp):
                            $cpi++;
                            ?>
                            <div class="col-lg-12">
                                <?= Check::Image('../uploads/' . $cp['banner_image'], $cpi, 146, 100); ?>
                            </div>
                            <?php
                        endforeach;
                    endif;
                endif;
                ?>
                <div class="col-12 form-group">          
                    <span class="field">Enviar Capa</span>
                    <input type="file" name="banner_image" class="btn btn-danger" />
                </div>
                <div class="col-12 form-group"> 
                    <label for="banner_title">Título</label>
                    <input
                        class="form-control"
                        type = "text"
                        name = "banner_name"
                        value="<?php if (!empty($banner['banner_name'])) echo $banner['banner_name']; ?>"
                        title = "Informe o título"
                        required
                        />
                </div>
                <div class="col-12 form-group"> 
                    <label for="banner_title">Destaque</label>
                    <input
                        class="form-control"
                        type = "text"
                        name = "banner_title"
                        value="<?php if (!empty($banner['banner_title'])) echo $banner['banner_title']; ?>"
                        title = "Informe o destaque"
                        required
                        />
                </div>
                <div class="col-12 form-group"> 
                    <label for="banner_link">Link</label>
                    <input
                        class="form-control"
                        type = "text"
                        name = "banner_link"
                        value="<?php if (!empty($banner['banner_link'])) echo $banner['banner_link']; ?>"
                        title = "Informe o link"
                        />
                </div>
                <div class="col-12 form-group">
                    <label>Target</label>
                    <select class="form-control required" name="banner_target" id="banner_target">
                        <option value="self" <?php if (isset($banner['banner_target']) && $banner['banner_target'] == 'self') echo 'selected'; ?>> Mesma página </option>
                        <option value="_blank" <?php if (isset($banner['banner_target']) && $banner['banner_target'] == '_blank') echo 'selected'; ?>> Nova página </option>
                    </select>
                </div>
                <div class="col-12 form-group">
                    <label>Transição</label>
                    <select class="form-control required" name="banner_transicao" id="banner_transicao">
                        <option value="slideup" <?php if (isset($banner['banner_transicao']) && $banner['banner_transicao'] == 'slideup') echo 'selected'; ?>> Slide </option>
                        <option value="fade" <?php if (isset($banner['banner_transicao']) && $banner['banner_transicao'] == 'fade') echo 'selected'; ?>> Fade </option>
                    </select>
                </div>
                <div class="col-12 form-group">
                    <label>Tempo</label>
                    <select class="form-control required" name="banner_tempo" id="banner_tempo">
                        <option value="12000" <?php if (isset($banner['banner_tempo']) && $banner['banner_tempo'] == '12000') echo 'selected'; ?>> Médio </option>
                        <option value="10000" <?php if (isset($banner['banner_tempo']) && $banner['banner_tempo'] == '10000') echo 'selected'; ?>> Curto </option>
                    </select>
                </div>
                <div class="col-12 form-group">
                    <label>Cor Texto</label>
                    <select class="form-control required" name="banner_estilo" id="banner_estilo">
                        <option value="clean" <?php if (isset($banner['banner_estilo']) && $banner['banner_estilo'] == 'clean') echo 'selected'; ?>> Escuro </option>
                        <option value="dark" <?php if (isset($banner['banner_estilo']) && $banner['banner_estilo'] == 'dark') echo 'selected'; ?>> Claro </option>
                    </select>
                </div>
                <div class="col-12 form-group">
                    <label>Conteúdo</label>
                    <textarea
                        class="form-control"
                        placeholder="Descrição"
                        name="banner_content"
                        id="editor1"
                        rows="10"
                        required
                        ><?php if (isset($banner['banner_content'])) echo htmlspecialchars($banner['banner_content']); ?></textarea>
                </div>
                <div class="form-group input-field col-lg-12 clearfix btnAtualiza">
                    <input type="submit" name="SendBannerForm" value="Atualizar" class="btn btn-info pull-right waves-effect waves-light" />
                    <input type="submit" name="SendBannerForm" value="Atualizar & Publicar" class="btn btn-success pull-right waves-effect waves-light" />
                </div>
            </div>
        </div>
    </form>
</div>
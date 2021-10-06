<?php
if (empty($login)) :
    header('Location: ../../painel.php');
    die;
endif;
?>
<?php
$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$dataid = filter_input(INPUT_GET, 'hometestimonialid', FILTER_VALIDATE_INT);
$form = '';
if (isset($data) && $data['SendHomeTestimonialForm']):
    $data['hometestimonial_status'] = ($data['SendHomeTestimonialForm'] == 'Atualizar' ? '0' : '1' );
    $data['hometestimonial_image'] = ( $_FILES['hometestimonial_image']['tmp_name'] ? $_FILES['hometestimonial_image'] : 'null' );
    unset($data['SendHomeTestimonialForm']);
    require('_models/AdminHomeTestimonial.class.php');
    $cadastra = new AdminHomeTestimonial;
    $cadastra->ExeUpdate($dataid, $data);
    WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
    $form = 'display:none';
else:
    $read = new Read;
    $read->ExeRead("cad_hometestimonials", "WHERE hometestimonial_id = :id", "id={$dataid}");
    if (!$read->getResult()):
        header('Location: painel.php?exe=hometestimonials/index&empty=true');
    else:
        $data = $read->getResult()[0];
    endif;
endif;
$checkCreate = filter_input(INPUT_GET, 'create', FILTER_VALIDATE_BOOLEAN);
if ($checkCreate && empty($cadastra)):
    WSErro("O hometestimonial <b>{$data['hometestimonial_title']}</b> foi cadastrado com sucesso no sistema!", WS_ACCEPT);
    $form = 'display:none';
endif;
?>
<div class="form">
    <form class="row" name="PostForm" action="" method="post" enctype="multipart/form-data">
        <div class="col-lg-6" style="<?= $form ?>">
            <div class="row checkout-form-billing">
                <div class="col-12">
                    <h3>Alterar Testimonial</h3>
                </div>
                <?php
                if (!empty($data['hometestimonial_image'])):
                    $cpi = 0;
                    $Capa = new Read;
                    $Capa->ExeRead("cad_hometestimonials", "WHERE hometestimonial_id = :hometestimonial", "hometestimonial={$dataid}");
                    if ($Capa->getResult()):
                        foreach ($Capa->getResult() as $cp):
                            $cpi++;
                            ?>
                            <div class="col-lg-12">
                                <?= Check::Image('../uploads/' . $cp['hometestimonial_image'], $cpi, 146, 100); ?>
                            </div>
                            <?php
                        endforeach;
                    endif;
                endif;
                ?>
                <div class="col-12 form-group">          
                    <span class="field">Enviar Capa</span>
                    <input type="file" name="hometestimonial_image" class="btn btn-danger" />
                </div>
                <div class="col-12 form-group"> 
                    <label for="hometestimonial_title">Título</label>
                    <input
                        class="form-control"
                        type = "text"
                        name = "hometestimonial_title"
                        value="<?php if (!empty($data['hometestimonial_title'])) echo $data['hometestimonial_title']; ?>"
                        title = "Informe o título"
                        required
                        />
                </div>
                <div class="col-12 form-group"> 
                    <label for="hometestimonial_pessoa">Pessoa</label>
                    <input
                        class="form-control"
                        type = "text"
                        name = "hometestimonial_pessoa"
                        value="<?php if (!empty($data['hometestimonial_pessoa'])) echo $data['hometestimonial_pessoa']; ?>"
                        title = "Informe a pessoa"
                        required
                        />
                </div>
                <div class="col-12 form-group"> 
                    <label for="hometestimonial_cargo">Cargo</label>
                    <input
                        class="form-control"
                        type = "text"
                        name = "hometestimonial_cargo"
                        value="<?php if (!empty($data['hometestimonial_cargo'])) echo $data['hometestimonial_cargo']; ?>"
                        title = "Informe o cargo"
                        required
                        />
                </div>
                <div class="form-group input-field col-lg-12 clearfix btnAtualiza">
                    <input type="submit" name="SendHomeTestimonialForm" value="Atualizar" class="btn btn-info pull-right waves-effect waves-light" />
                    <input type="submit" name="SendHomeTestimonialForm" value="Atualizar & Publicar" class="btn btn-success pull-right waves-effect waves-light" />
                </div>
            </div>
        </div>
    </form>
</div>
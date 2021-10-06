            <!-- foto capa -->
            <?php
            $readPage = new Read;
            $readPage->ExeRead("cad_pages", "WHERE page_status = 1 and page_name = 'PRODUTOS' ORDER BY page_id ASC");
            if ($readPage->getResult()):
                $gb = 0;
                foreach ($readPage->getResult() as $pages):
                    $gb++;
                    extract($pages);
                    $destaque = ($gb % 2) ? "" : "";
                    ?>
                    <!-- <?= $page_title?> -->
                    <section id="page-title" class="page-title-parallax include-header min-vh-60" style="background: transparent; padding: 120px 0;">
                        <div class="container" style="z-index: 2;">
                            <h1 class="nott colot-text-white"><?= $page_title?></h1>
                        </div>
                        <div class="swiper-slide-bg lazy entered lazy-loaded" style="z-index: 1; background-image: linear-gradient(to top, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.50)), url(<?= HOME; ?>/uploads/<?= $page_image ?>);" data-bg=""></div>
                        <div class="shape-divider" data-shape="valley" data-position="bottom" data-height="120" data-flip="true" data-flip-vertical="true" data-fill="#FFF"></div>
                    </section>                                 
                    <!-- /<?= $page_title?> -->
                    <?php
                endforeach;
            endif; 
            ?>
            <!-- /foto capa -->
            <!-- Content ============================================= -->
            <section id="content-wrap">
                <!-- bloco 1 -->
                <div class="container clearfix">
                    <div class="container clearfix">
                        <div class="heading-block topmargin-lg center">
                            <h2><?= $page_title?></h2>
                        </div>
                        <div class="center">
                            <span class="mx-auto"><?= $page_subtitle?></span>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Revolution Slider ============================================= -->
            <div class="section mb-0" style="background: #FFF url('<?= INCLUDE_PATH; ?>/demos/car/images/revslider/bg.png') center 70% no-repeat; background-size: 100% auto; padding: 100px 0 10px">
                <div class="container">
                    <div id="rev_slider_424_1_wrapper" class="rev_slider_wrapper my-0 p-0 fullwidthbanner-container mx-auto" data-alias="image-gallery" style="max-width: 1240px;">
                        <!-- START REVOLUTION SLIDER 5.2.0 auto mode -->
                        <div id="rev_slider_424_1" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.2.0">
                            <ul>
                                <?php
                                $readProduto = new Read;                                
                                $readProduto->ExeRead("cad_produtos", "WHERE produto_status = :produto_status ORDER BY produto_id ASC", "produto_status=1");
                                if ($readProduto->getResult()):
                                    $gb = 0;
                                    foreach ($readProduto->getResult() as $produtos):
                                        $gb++;
                                        extract($produtos);
                                        $destaque = ($gb % 2) ? "" : "";
                                        $ancora = explode('#',$produto_link);
                                        if($produto_categoria == 'Civil'){
                                            $icon = 'icon-line2-user-female';
                                        }elseif($produto_categoria == 'Militar'){
                                            $icon = 'icon-shield-alt';
                                        }elseif($produto_categoria == 'Policial'){
                                            $icon = 'icon-line-shield';
                                        }else{
                                            $icon = 'icon-users2';
                                        }
                                        ?>
                                        <!-- <?= $produto_title?> -->
                                        <li data-index="rs-<?= $produto_id?>" data-thumb="<?= HOME; ?>/uploads/<?= $produto_image ?>"  data-title="<?= $produto_name?> <br /> <i class='<?= $icon ?>'></i> <?= $produto_categoria?>" data-param1="<?= $produto_nivel?>" data-transition="slidefromleft" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="default" data-easeout="default" data-masterspeed="300"  data-rotate="0"  data-saveperformance="off" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                                            <img src="<?= INCLUDE_PATH; ?>/include/rs-plugin/demos/assets/images/dummy.png" alt="Combat Armor Defense do Brasil" title="Combat Armor Defense do Brasil" data-lazyload="<?= HOME; ?>/uploads/<?= $produto_image ?>" data-bgposition="left center" data-bgfit="contain" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                                            <div class="tp-caption font-body ls2 text-uppercase tp-resizeme" id="slide-luxo-layer-1" data-x="['left','left','left','left']" data-hoffset="['30','30','30','30']"data-y="['top','top','top','top']" data-voffset="['0','0','0','90']" data-fontsize="['15','15','13','13']" data-lineheight="['15','15','13','13']" data-width="['370','370','290','210']" data-height="none" data-whitespace="nowrap" data-type="text" data-actions='' data-basealign="slide" data-responsive_offset="on" data-textAlign="['left','left','left','left']" data-frames='[{"from":"y:20px;opacity:0;","speed":2000,"to":"o:1;","delay":400,"ease":"Power4.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]' data-start="600" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 6; min-width: 370px; max-width: 370px; white-space: nowrap;">
                                                <?= $produto_title?>
                                            </div>
                                            <div class="tp-caption font-primary text-uppercase font-weight-bold tp-resizeme" id="slide-luxo-layer-2" data-x="['left','left','left','left']" data-hoffset="['30','30','30','30']" data-y="['top','top','top','top']" data-voffset="['30','30','92','68']" data-fontsize="['40','40','30','20']" data-lineheight="['40','40','30','20']" data-width="['500','500','400','210']" data-height="none" data-whitespace="normal" data-type="text" data-actions='' data-basealign="slide" data-responsive_offset="on" data-textAlign="['left','left','left','left']" data-frames='[{"from":"y:20px;opacity:0;","speed":2000,"to":"o:1;","delay":600,"ease":"Power4.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]' data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 7; letter-spacing: 2px; white-space: normal;">
                                                <?= $produto_name?>
                                            </div>
                                            <div class="tp-caption font-primary text-uppercase tp-resizeme" id="slide-luxo-layer-3" data-x="['right','right','right','right']" data-hoffset="['30','30','30','30']" data-y="['top','top','top','top']" data-voffset="['25','115','215','154']" data-fontsize="['60','60','30','20']" data-lineheight="['23','23','21','20']" data-width="['360','360','290','210']" data-height="none" data-whitespace="normal" data-type="text" data-actions='' data-basealign="slide" data-responsive_offset="on" data-textAlign="['right','right','right','right']" data-frames='[{"from":"y:20px;opacity:0;","speed":2000,"to":"o:1;","delay":800,"ease":"Power4.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]' data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 8; min-width: 360px; max-width: 360px; font-weight: 700; white-space: normal;">
                                                <?= $produto_nivel?>
                                            </div>
                                            <div class="tp-caption font-body ls0 tp-resizeme" id="slide-luxo-layer-4" data-x="['right','right','right','right']" data-hoffset="['30','30','30','30']" data-y="['top','top','top','top']" data-voffset="['100','200','215','154']" data-fontsize="['14','14','14','13']" data-lineheight="['23','23','21','20']" data-width="['360','360','290','210']" data-height="none" data-whitespace="normal" data-type="text" data-actions='' data-basealign="slide" data-responsive_offset="on" data-textAlign="['right','right','right','right']" data-frames='[{"from":"y:20px;opacity:0;","speed":2000,"to":"o:1;","delay":1000,"ease":"Power4.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]' data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 8; min-width: 360px; max-width: 360px; white-space: normal;">
                                                <?= $produto_content?>
                                            </div>
                                            <div class="tp-caption tp-resizeme" id="slide-luxo-layer-5" data-x="['right','right','right','right']" data-hoffset="['25','25','25','25']" data-y="['top','top','top','top']" data-voffset="['336','346','336','366']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="text" data-actions='' data-basealign="slide" data-responsive_offset="on" data-textAlign="['right','right','right','right']" data-frames='[{"from":"y:20px;opacity:0;","speed":2000,"to":"o:1;","delay":1200,"ease":"Power4.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]' data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 9; white-space: nowrap;cursor:pointer;">
                                                <a href="#<?= $ancora[1]?>" class="button button-border button-circle button-rounded button-fill button-white"><span>Acessar Produto</span></a>
                                            </div>
                                        </li>
                                        <!-- /<?= $produto_title?> -->
                                        <?php
                                    endforeach;
                                endif; 
                                ?>
                            </ul>
                            <div class="tp-bannertimer d-none"></div>
                        </div>
                    </div>
                    <!-- END REVOLUTION SLIDER -->
                </div>
            </div>
            <!-- 360 degree car ============================================= -->
            <div class="section dark mb-0 clearfix" style="background: #FFF url('<?= INCLUDE_PATH; ?>/demos/car/images/1.jpg') right bottom no-repeat; background-size: cover; padding: 80px 0 40px">
                <div class="container-fluid clearfix" style="position: relative; z-index: 2;">
                    <div class="row clearfix">
                        <div class="col-lg-8">
                            <div class="heading-block border-0 mb-0 center">
                                <h3 style="font-size: 32px; font-weight: 700;">Blindagem 360°</h3>
                            </div>
                            <!-- 360 degree Car Content -->
                            <div class="threesixty 360-car">
                                <div class="spinner">
                                    <span>0%</span>
                                </div>
                                <ol class="threesixty_images"></ol>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row clearfix">
                                <div class="col-lg-10">
                                    <div class="heading-block topmargin-sm border-0">
                                        <h3>Garantia</h3>
                                        <span>Certificação de fábrica do carro garantida.</span>
                                        <p>Após a aplicação da blindagem (independente do nível), o veículo manterá suas características mantidas e a garantia do fabricante.</p>
                                        <p>O veículo poderá ter ajustes como reforço nas dobradiças das portas, amortecedor, molas e outros componentes para que suporte o peso da blindagem sem alterar a estrutura do chassi.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="video-wrap d-block d-md-block d-lg-none" style="z-index: 0;">
                    <div class="video-overlay" style="background: rgba(255,255,255,0.8);"></div>
                </div>
            </div>
            <!-- 360 Degree Section End -->
            <!-- Content ============================================= -->
            <section id="content-wrap">
                <?php
                $readProduto = new Read;                                
                $readProduto->ExeRead("cad_produtos", "WHERE produto_status = :produto_status ORDER BY produto_id ASC", "produto_status=1");
                if ($readProduto->getResult()):
                    $gb1 = 0;
                    foreach ($readProduto->getResult() as $produtos):
                        $gb1++;
                        extract($produtos);
                        $destaque = ($gb1 % 2) ? "" : "";
                        $ancora = explode('#',$produto_link);
                        if($produto_categoria == 'Civil'){
                            $icon = 'icon-line2-user-female';
                        }elseif($produto_categoria == 'Militar'){
                            $icon = 'icon-shield-alt';
                        }elseif($produto_categoria == 'Policial'){
                            $icon = 'icon-line-shield';
                        }else{
                            $icon = 'icon-users2';
                        }
                        ?>
                        <!-- <?= $produto_title?> -->
                        <?php
                        if($gb1 != 1){
                        ?>
                        <div id="<?= $ancora[1]?>" class="section lazy mt-5 p-0 min-vh-16 entered lazy-loaded" style="background-position: center center; background-repeat: no-repeat; background-size: cover; background-image: linear-gradient(to right, #b7b7b7, #fff, #b7b7b7);" data-ll-status="loaded">
                            <div class="shape-divider" data-shape="slant-3" data-height="50" id="shape-divider-2938"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1280 10" preserveAspectRatio="none" class="op-ts op-1"><path class="shape-divider-fill" d="M1280 140V0H0l1280 140z" opacity="0.5"></path><path class="shape-divider-fill" d="M1280 98V0H0l1280 98z"></path></svg></div>
                            <div class="shape-divider" data-shape="slant-3" data-position="bottom" data-height="50" id="shape-divider-476"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1280 140" preserveAspectRatio="none" class="op-ts op-1"><path class="shape-divider-fill" d="M1280 140V0H0l1280 140z" opacity="0.5"></path><path class="shape-divider-fill" d="M1280 98V0H0l1280 98z"></path></svg></div>
                        </div>
                        <?php }else{?>
                        <div class="container clearfix">
                            <div class="topmargin-lg center">
                                <span id="<?= $ancora[1]?>">&nbsp;</span>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="container clearfix">
                            <div class="heading-block topmargin-lg center">
                                <h2><?= $produto_name?></h2>
                            </div>
                            <div class="row align-items-center col-mb-50">
                                <div class="col-md-12">
                                    <?= $produto_desc?>
                                </div>
                            </div>
                        </div>
                        <!-- /<?= $produto_title?> -->
                        <?php
                    endforeach;
                endif; 
                ?>
                <div class="section lazy mt-5 p-0 min-vh-16 entered lazy-loaded" style="background-position: center center; background-repeat: no-repeat; background-size: cover; background-image: linear-gradient(to right, #b7b7b7, #fff, #b7b7b7);" data-ll-status="loaded">
                    <div class="shape-divider" data-shape="slant-3" data-height="50" id="shape-divider-2938"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1280 10" preserveAspectRatio="none" class="op-ts op-1"><path class="shape-divider-fill" d="M1280 140V0H0l1280 140z" opacity="0.5"></path><path class="shape-divider-fill" d="M1280 98V0H0l1280 98z"></path></svg></div>
                    <div class="shape-divider" data-shape="slant-3" data-position="bottom" data-height="50" id="shape-divider-476"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1280 140" preserveAspectRatio="none" class="op-ts op-1"><path class="shape-divider-fill" d="M1280 140V0H0l1280 140z" opacity="0.5"></path><path class="shape-divider-fill" d="M1280 98V0H0l1280 98z"></path></svg></div>
                </div>
                <!-- legenda -->
                <div class="container clearfix">
                    <div class="heading-block topmargin-lg center">
                        <h2>Balística NIJ (National Institute of Justice - USA)</h2>
                    </div>
                    <div class="col-lg-12">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col"> Euro Norm Stardard </th>
                                    <th scope="col"> Munition Type </th>
                                    <th scope="col"> Velocity </th>
                                    <th scope="col"> Grain </th>
                                    <th scope="col" colspan="2"> Weapon </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <!---->
                                    <th rowspan="5" scope="row" style="background: rgb(206, 207, 209) none repeat scroll 0% 0%;">
                                        <div class="my-5 py-5">
                                            European B4 NIJ III-A
                                        </div>
                                    </th>
                                    <td>9mm FMj</td><td>1120 ft/s</td>
                                    <td>124</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <!---->
                                    <td>.357 Mag SP</td>
                                    <td>1450 ft/s</td>
                                    <td>240</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <!---->
                                    <td>.38 Super Auto FMJ</td>
                                    <td>1280 ft/s</td>
                                    <td>130</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <!---->
                                    <td>44 Mag SWC</td>
                                    <td>1475 ft/s</td>
                                    <td>240</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <!---->
                                    <td>12 Gauge Slug</td>
                                    <td>1575 ft/s</td>
                                    <td>7/8 oz</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <!---->
                                    <th rowspan="3" scope="row" style="background: rgb(176, 177, 179) none repeat scroll 0% 0%;">
                                        <div class="my-3 py-3"> 
                                            European B6 NIJ III
                                        </div>
                                    </th>
                                    <td>7.62 x 51 NATO</td>
                                    <td>2700 ft/s</td>
                                    <td>147</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <!---->
                                    <td>5.56 (.223) FMJ</td>
                                    <td>2920 ft/s</td>
                                    <td>55</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <!---->
                                    <td>7.62 x 39 FMJ</td>
                                    <td>2550 ft/s</td>
                                    <td>123</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th rowspan="4" scope="row" style="background: rgb(133, 135, 139) none repeat scroll 0% 0%;">
                                        <div class="my-4 py-4"> 
                                            European B7 NIJ IV<br><span>(Note: not available in all vehicle types)</span>
                                        </div>
                                    </th>
                                    <td>5.56 (.223) AP</td>
                                    <td>2920 ft/s</td>
                                    <td>55</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <!---->
                                    <td>7.62 x 39 FMJ</td>
                                    <td>2700 ft/s</td>
                                    <td>147</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <!---->
                                    <td>30.06 AP</td>
                                    <td>2410 ft/s</td>
                                    <td>220</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <!---->
                                    <td>7.62 x 39 FMJ AP</td>
                                    <td>2550 ft/s</td>
                                    <td>123</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="2" >Abbreviations</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>FMJ</strong> = Full Metal Jacket</td>
                                    <td><strong>SWC</strong> = Semi-Wad Cutter, Gas Checked</td>
                                </tr>
                                <tr>
                                    <td><strong>SP</strong> = Soft (lead) Point</td>
                                    <td><strong>NATO</strong> = FMJ with lead Core</td>
                                </tr>
                                <tr>
                                    <td><strong>AP</strong> = Armor-Piercing (FMJ width Special Core)</td>
                                    <td><strong>ft/s</strong> = Feet/Second</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /legenda -->
            </section>
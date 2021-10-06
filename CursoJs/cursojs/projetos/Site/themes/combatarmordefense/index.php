            <!-- #banner -->
            <section id="slider" class="slider-element revslider-wrap include-header h-auto">
                <div class="slider-inner">
                    <!-- THEMEPUNCH BANNER - ################################# -->
                    <div id="rev_slider_679_1_wrapper" class="rev_slider_wrapper fullwidth-container"  style="padding:0px;">
                        <!-- START REVOLUTION SLIDER 5.1.4 fullwidth mode -->
                        <div id="rev_slider_679_1" class="rev_slider fullwidthbanner" style="display:none;" data-version="5.1.4">
                            <ul>
                                <?php
                                $readBanner = new Read;
                                $readBanner->ExeRead("cad_banners", "WHERE banner_status = :banner_status ORDER BY banner_id ASC", "banner_status=1");
                                if ($readBanner->getResult()):
                                    $gb = 0;
                                    foreach ($readBanner->getResult() as $banners):
                                        $gb++;
                                        extract($banners);
                                        ?>
                                        <!-- SLIDE  -->
                                        <li class="<?= $banner_estilo; ?>" data-transition="<?= $banner_transicao; ?>" data-slotamount="1" data-masterspeed="1500" data-delay="<?= $banner_tempo; ?>"  data-saveperformance="off" data-title="Responsive Design">
                                            <img src="<?= HOME; ?>/uploads/<?= $banner_image ?>" alt="Combat Armor Defense do Brasil" title="Combat Armor Defense do Brasil" data-bgposition="center bottom" data-bgpositionend="center top" data-kenburns="on" data-duration="12000" data-ease="Linear.easeNone" data-scalestart="100" data-scaleend="120" data-rotatestart="0" data-rotateend="0" data-blurstart="0" data-blurend="0" data-offsetstart="0 0" data-offsetend="0 0" class="rev-slidebg" data-no-retina>
                                            <div class="tp-caption customin ltl tp-resizeme revo-slider-caps-text text-center" data-x="middle" data-hoffset="0" data-y="top" data-voffset="310" data-transform_in="x:0;y:0;z:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;s:800;e:Power4.easeOutQuad;" data-speed="800" data-start="1000" data-easing="easeOutQuad" data-splitin="none" data-splitout="none" data-elementdelay="0.01" data-endelementdelay="0.1" data-endspeed="1000" data-endeasing="Power4.easeIn" style="z-index: 3; white-space: nowrap;">
                                                <?= $banner_content; ?>
                                            </div>
                                            <div class="tp-caption customin ltl tp-resizeme revo-slider-emphasis-text p-0 border-0" data-x="middle" data-hoffset="0" data-y="top" data-voffset="400" data-fontsize="['60','50','40','34']" data-transform_in="x:0;y:0;z:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;s:800;e:Power4.easeOutQuad;" data-speed="800" data-start="1000" data-easing="easeOutQuad" data-splitin="none" data-splitout="none" data-elementdelay="0.01" data-endelementdelay="0.1" data-endspeed="1000" data-endeasing="Power4.easeIn" style="z-index: 3; white-space: nowrap;">
                                                <?= $banner_title; ?>
                                            </div>
                                            <?php
                                            if($banner_link != '#'){
                                            ?>
                                                <div class="tp-caption customin ltl tp-resizeme" data-x="middle" data-hoffset="0" data-y="top" data-voffset="500" data-transform_in="x:0;y:150;z:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;s:800;e:Power4.easeOutQuad;" data-speed="800" data-start="1550" data-easing="easeOutQuad" data-splitin="none" data-splitout="none" data-elementdelay="0.01" data-endelementdelay="0.1" data-endspeed="1000"
                                                     data-endeasing="Power4.easeIn" style="z-index: 3;">
                                                    <a href="<?php $banner_link?>" class="button button-border button-large button-rounded text-right m-0"><span>Saiba mais</span> <i class="icon-plus-sign"></i></a>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </li>
                                        <!-- SLIDE  -->
                                        <?php
                                    endforeach;
                                endif; 
                                ?>
                            </ul>
                        </div>
                    </div>
                    <!-- END REVOLUTION SLIDER -->
                </div>
            </section>
            <!-- #banner end -->
            <!-- Content ============================================= -->
            <section id="content">
                <div class="content">
                    <?php
                    $readHomeContent = new Read;
                    $readHomeContent->ExeRead("cad_homecontents", "WHERE homecontent_status = :homecontent_status ORDER BY homecontent_id ASC", "homecontent_status=1");
                    if ($readHomeContent->getResult()):
                        ?>                            
                        <!-- bloco 1 -->
                        <div class="container clearfix content-wrap">
                        <?php
                            $gb = 0;
                            foreach ($readHomeContent->getResult() as $homecontents):
                                $gb++;
                                extract($homecontents);
                                ?>
                                <div class="heading-block center">
                                    <h2><?= $homecontent_title; ?></h2>
                                </div>
                                <div class="row align-items-center col-mb-50 topmargin-lg">
                                    <div class="col-md-4 center">
                                        <img src="<?= HOME; ?>/uploads/<?= $homecontent_image ?>" alt="Combat Armor do Brasil" title="Combat Armor Defense do Brasil" class="img-prop-10">
                                        <?php
                                        $readHomeTestimonial = new Read;
                                        $readHomeTestimonial->ExeRead("cad_hometestimonials", "WHERE hometestimonial_status = :hometestimonial_status ORDER BY hometestimonial_id ASC", "hometestimonial_status=1");
                                        if ($readHomeTestimonial->getResult()):
                                            $gb = 0;
                                            foreach ($readHomeTestimonial->getResult() as $hometestimonials):
                                                $gb++;
                                                extract($hometestimonials);
                                                ?>
                                                <div class="testimonial col-lg-10 offset-lg-1 pbsmall">
                                                    <div class="testi-image">
                                                        <a href="#"><img src="<?= HOME; ?>/uploads/<?= $hometestimonial_image ?>" alt="<?= $hometestimonial_pessoa ?> - <?= $hometestimonial_cargo ?> - Combat Armor Defense do Brasil" title="<?= $hometestimonial_pessoa ?> - <?= $hometestimonial_cargo ?> - Combat Armor Defense do Brasil"></a>
                                                    </div>
                                                    <div class="testi-content">
                                                        <p><i class="icon-quote-left1"></i> <?= $hometestimonial_title ?> <i class="icon-quote-right1"></i></p>
                                                    </div>
                                                    <div class="testi-content col-lg-12">
                                                        <div class="testi-meta">
                                                            <?= $hometestimonial_pessoa ?> <span><?= $hometestimonial_cargo ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            endforeach;
                                        endif; 
                                        ?>
                                    </div>
                                    <div class="col-md-8">
                                        <?= $homecontent_content; ?>
                                    </div>
                                </div>
                                <?php
                            endforeach;?>
                        </div>
                        <!-- /bloco 1 -->
                        <?php
                    endif; 
                    ?>
                    <!-- home section -->
                    <?php
                    $readHomeSection = new Read;
                    $readHomeSection->ExeRead("cad_homesections", "WHERE homesection_status = :homesection_status ORDER BY homesection_id ASC", "homesection_status=1");
                    if ($readHomeSection->getResult()):
                        ?>
                        <div class="section">
                            <div class="container clearfix">
                                <?php
                                $gb = 0;
                                foreach ($readHomeSection->getResult() as $homesections):
                                    $gb++;
                                    extract($homesections);
                                    ?>                                    
                                    <div class="heading-block topmargin-lg center">
                                        <h2><?= $homesection_title ?></h2>
                                    </div>
                                    <div class="center">
                                        <span class="mx-auto"><?= $homesection_subtitle ?></span>
                                    </div>
                                    <div class="row col-mb-50 mb-4 topmargin-lg">
                                        <div class="col-lg-4 col-md-6">
                                            <div class="feature-box flex-md-row-reverse">
                                                <div class="fbox-content">
                                                    <h3><?= $homesection_subtitle1 ?></h3>
                                                    <p><?= $homesection_content1 ?></p>
                                                </div>
                                            </div>
                                            <div class="feature-box flex-md-row-reverse mt-5">
                                                <div class="fbox-content">
                                                    <h3><?= $homesection_subtitle2 ?></h3>
                                                    <p><?= $homesection_content2 ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 d-md-none d-lg-block text-center">
                                            <img src="<?= HOME; ?>/uploads/<?= $homesection_image ?>" alt="Empresa Combat Armor do Brasil" title="Combat Armor Defense do Brasil">
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="feature-box">
                                                <div class="fbox-content">
                                                    <h3><?= $homesection_subtitle3 ?></h3>
                                                    <p><?= $homesection_content3 ?></p>
                                                </div>
                                            </div>
                                            <div class="feature-box mt-5">
                                                <div class="fbox-content">
                                                    <h3><?= $homesection_subtitle4 ?></h3>
                                                    <p><?= $homesection_content4 ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                endforeach;
                                ?>                                
                            </div>
                        </div>  
                        <?php
                    endif; 
                    ?>
                    <!-- /home section -->  
                    <!-- blindagem -->
                    <div class="container clearfix">
                        <?php
                        $readPage = new Read;
                        $readPage->ExeRead("cad_pages", "WHERE page_status = 1 and page_name = 'BLINDAGEM' ORDER BY page_id ASC");
                        if ($readPage->getResult()):
                            $gb = 0;
                            foreach ($readPage->getResult() as $pages):
                                $gb++;
                                extract($pages);
                                $destaque = ($gb % 2) ? "" : "";
                                ?>
                                <!-- <?= $page_title?> -->
                                <div class="heading-block topmargin-lg center">
                                    <h2><?= $page_title?></h2>
                                </div>
                                <div class="center">
                                    <span class="mx-auto"><?= $page_subtitle?></span>
                                </div>
                                <div class="center topmargin-lg">
                                    <span class="mx-auto"><?= $page_content?></span>
                                </div>                                        
                                <!-- /<?= $page_title?> -->
                                <?php
                            endforeach;
                        endif; 
                        ?>
                        <div id="oc-portfolio" class="owl-carousel portfolio-carousel carousel-widget topmargin-lg" data-pagi="false" data-items-xs="1" data-items-sm="2" data-items-md="3" data-items-lg="4">
                            <?php
                            $readBlindagem = new Read;
                            $readBlindagem->ExeRead("cad_blindagens", "WHERE blindagem_status = :blindagem_status ORDER BY blindagem_id ASC", "blindagem_status=1");
                            if ($readBlindagem->getResult()):
                                $gb = 0;
                                foreach ($readBlindagem->getResult() as $blindagens):
                                    $gb++;
                                    extract($blindagens);
                                    $destaque = ($gb % 2) ? "destaque" : "";
                                    ?>
                                    <!-- <?= $blindagem_name?> -->
                                    <div class="portfolio-item">
                                        <div class="portfolio-image">
                                            <a href="<?= HOME; ?>/<?= $blindagem_link?>">
                                                <img src="<?= HOME; ?>/uploads/<?= $blindagem_image ?>" alt="<?= $blindagem_name ?> - Combat Armor Defense do Brasil" title="<?= $blindagem_name ?> - Combat Armor Defense do Brasil" ></a>
                                            </a>
                                            <div class="bg-overlay">
                                                <div class="bg-overlay-content dark" data-hover-animate="fadeIn" data-hover-speed="350">
                                                    <a href="<?= HOME; ?>/<?= $blindagem_link?>" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeInUpSmall" data-hover-speed="350"><i class="icon-line-plus"></i></a>
                                                </div>
                                                <div class="bg-overlay-bg dark" data-hover-animate="fadeIn" data-hover-speed="350"></div>
                                            </div>
                                        </div>
                                        <div class="portfolio-desc <?= $destaque ?>">
                                            <h3><a href="<?= HOME; ?>/<?= $blindagem_link?>"><?= $blindagem_name?></a></h3>
                                            <span><?= $blindagem_resumo?></span>
                                            <span><a class="menu-link" href="<?= HOME; ?>/<?= $blindagem_link?>">Saiba mais <i class="icon-line-circle-plus"></i></a></span>
                                        </div>
                                    </div>
                                    <!-- /<?= $blindagem_name?> -->
                                    <?php
                                endforeach;
                            endif; 
                            ?>
                        </div>
                    </div>
                    <!-- /blindagem -->
                </div>
            </section>
            <!-- #content end -->
            <!-- foto capa -->
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
            <section id="content">
                <div class="content-wrap">
                    <?php
                    $readBanner = new Read;
                    $readBanner->ExeRead("cad_blindagens", "WHERE blindagem_status = :blindagem_status ORDER BY blindagem_id ASC", "blindagem_status=1");
                    if ($readBanner->getResult()):
                        $gb = 0;
                        foreach ($readBanner->getResult() as $blindagens):
                            $gb++;
                            extract($blindagens);
                            $destaque = ($gb % 2) ? "destaque" : "";
                            $ancora = explode('#',$blindagem_link);
                            ?>
                            <!-- <?= $blindagem_name?> -->                            
                            <div class="container clearfix">
                                <div class="center">
                                    <span id="<?= $ancora[1]?>">&nbsp;</span>
                                </div>
                            </div>
                            <div class="container clearfix">
                                <div class="heading-block topmargin-lg center">
                                    <h2><?= $blindagem_name?></h2>
                                </div>
                                <div class="row align-items-center col-mb-50 topmargin-lg">
                                    <div class="col-md-4 center">
                                        <img src="<?= HOME; ?>/uploads/<?= $blindagem_image ?>" alt="<?= $blindagem_name?> - Combat Armor do Brasil" title="<?= $blindagem_name?> - Combat Armor Defense do Brasil">
                                    </div>
                                    <div class="col-md-8">
                                        <?= $blindagem_content?>
                                    </div>
                                </div>
                            </div>
                            <!-- /<?= $blindagem_name?> -->
                            <?php
                        endforeach;
                    endif; 
                    ?>
                </div>
            </section>
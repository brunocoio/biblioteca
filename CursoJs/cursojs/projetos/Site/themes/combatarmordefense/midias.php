            <!-- foto capa -->
            <?php
            $readPage = new Read;
            $readPage->ExeRead("cad_pages", "WHERE page_status = 1 and page_name = 'MÍDIAS' ORDER BY page_id ASC");
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
                    <!-- bloco 1 -->
                    <div class="container clearfix">
                        <div class="heading-block topmargin-lg center">
                            <h2><?= $page_title?></h2>
                        </div>
                        <div class="center">
                            <span class="mx-auto"><?= $page_subtitle?></span>
                        </div>
                        <div class="center topmargin-lg">
                            <span class="mx-auto"><?= $page_content?></span>
                        </div>
                        <div id="oc-portfolio" class="owl-carousel portfolio-carousel carousel-widget topmargin-lg" data-pagi="false" data-items-xs="1" data-items-sm="2" data-items-md="3" data-items-lg="4">
                            <?php
                            $readMidias = new Read;
                            $readMidias->ExeRead("cad_midias", "WHERE midia_status = :midia_status ORDER BY midia_id ASC", "midia_status=1");
                            if ($readMidias->getResult()):
                                $gb = 0;
                                foreach ($readMidias->getResult() as $midias):
                                    $gb++;
                                    extract($midias);
                                    $destaque = ($gb % 2) ? "destaque" : "";
                                    ?>
                                    <!-- <?= $midia_name?> -->
                                    <div class="portfolio-item <?=$destaque?>">
                                        <div class="portfolio-image">
                                            <a href="">
                                                <?= $midia_url?>
                                            </a>
                                        </div>
                                        <div class="portfolio-desc">
                                            <h3><a href=""><?= $midia_name?></a></h3>
                                            <span><?= $midia_content?></span>
                                        </div>
                                    </div>
                                    <!-- /<?= $midia_name?> -->
                                    <?php
                                endforeach;
                            endif; 
                            ?>
                        </div>
                    </div>
                    <!-- /bloco 1 -->
                </div>
            </section>
            <!-- #content end -->
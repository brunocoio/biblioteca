            <!-- foto capa -->
            <?php
            $readPage = new Read;
            $readPage->ExeRead("cad_pages", "WHERE page_status = 1 and page_name = \"FAQ'S\" ORDER BY page_id ASC");
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
                        
                        <div class="row align-items-center col-mb-50 topmargin-lg">
                            <div class="col-lg-12">
                                <div class="accordion accordion-bg accordion-border" data-collapsible="true">
                                    <?php
                                    $readBlindagem = new Read;
                                    $readBlindagem->ExeRead("cad_faqs", "WHERE faq_status = :faq_status ORDER BY faq_id ASC", "faq_status=1");
                                    if ($readBlindagem->getResult()):
                                        $gb = 0;
                                        foreach ($readBlindagem->getResult() as $faqs):
                                            $gb++;
                                            extract($faqs);
                                            $destaque = ($gb % 2) ? "destaque" : "";
                                            ?>
                                            <!-- <?= $faq_name?> -->
                                            <div class="accordion-header">
                                                <div class="accordion-icon">
                                                    <i class="accordion-closed icon-ok-circle"></i>
                                                    <i class="accordion-open icon-remove-circle"></i>
                                                </div>
                                                <div class="accordion-title">
                                                    <?= $faq_name?>
                                                </div>
                                            </div>
                                            <div class="accordion-content" style="display: none;">
                                                <?= $faq_content?>
                                            </div>
                                            <!-- /<?= $faq_name?> -->
                                            <?php
                                        endforeach;
                                    endif; 
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /bloco 1 -->
                </div>
            </section>
            <!-- #content end -->
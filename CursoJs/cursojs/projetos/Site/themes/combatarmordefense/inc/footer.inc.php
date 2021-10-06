            <!-- #content end -->
            <div class="container clearfix">
                <div class="topmargin-lg center">
                    <span>&nbsp;</span>
                </div>
                <div class="topmargin-lg center">
                    <span>&nbsp;</span>
                </div>
            </div>            <!-- Footer ============================================= -->
            <footer id="footer" class="dark border-top-0">
                <div class="shape-divider" data-shape="cliff" data-height="100" data-outside="true" data-fill="#282828"></div>
                <div class="container">
                    <!-- Footer Widgets ============================================= -->
                    <div class="footer-widgets-wrap">
                        <div class="row col-mb-50">
                            <div class="col-lg-12">
                                <div class="row col-mb-50">
                                    <div class="col-md-4" style="background: url('<?= INCLUDE_PATH; ?>/images/world-map.png') no-repeat center center; background-size: 100%;">
                                        <div class="widget clearfix">
                                            <img src="<?= INCLUDE_PATH; ?>/images/site/rodapecombatarmordobrasil.png" alt="Combat Armor do Brasil" title="Combat Armor Defense do Brasil" class="footer-logo">
                                            <div class="col-lg-6 center"><img src="<?= INCLUDE_PATH; ?>/images/site/USA_Brasil_combatarmordobrasil.png" alt="Combat Armor Defense do Brasil USA" title="Combat Armor Defense do Brasil" class="usabr center"/></div>
                                        </div>
                                    </div>
                                    <?php
                                    $readRodape = new Read;
                                    $readRodape->ExeRead("cad_rodapes", "WHERE rodape_status = :rodape_status ORDER BY rodape_id ASC", "rodape_status=1");
                                    if ($readRodape->getResult()):
                                        $gb = 0;
                                        foreach ($readRodape->getResult() as $rodapes):
                                            $gb++;
                                            extract($rodapes);
                                            ?>
                                            <div class="col-md-4">
                                                <div class="widget clearfix">
                                                    <h4><?= $rodape_name; ?></h4>
                                                    <div >
                                                        <address><?= $rodape_content; ?></address>
                                                        <?= !empty($rodape_tel)?'<strong>Telefone:</strong> '.$rodape_tel:''; ?><br>
                                                        <?= !empty($rodape_mail)?'<strong>E-mail:</strong> '.$rodape_tel:''; ?><br>
                                                        <?php if($gb == 2){ ?><a href="<?= INCLUDE_PATH; ?>/pdf/combat_armor_defense_catalogo2020.pdf" class="button button-border button-circle" target="_blank" download="Catálogo">Catálogo</a><?php  } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        endforeach;
                                    endif; 
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- .footer-widgets-wrap end -->
                </div>
                <!-- Copyrights ============================================= -->
                <div id="copyrights">
                    <div class="container">
                        <div class="row col-mb-30">
                            <div class="col-md-6 text-center text-md-left">
                                <script language=javascript type="text/javascript"> now = new Date; document.write("Copyrights &copy; Combat Armor Defense do Brasil | Todos os direitos reservados | 2019 - " + now.getFullYear());</script>
                            </div>
                            <div class="col-md-6 text-center text-md-right">
                                <div class="d-flex justify-content-center justify-content-md-end">
                                    <?php
                                    $readMidiasocial = new Read;
                                    $readMidiasocial->ExeRead("cad_midiassociais", "WHERE midiasocial_status = :midiasocial_status ORDER BY midiasocial_id DESC", "midiasocial_status=1");
                                    if ($readMidiasocial->getResult()):
                                        $gb = 0;
                                        foreach ($readMidiasocial->getResult() as $midiassociais):
                                            $gb++;
                                            extract($midiassociais);
                                            ?>
                                            <a href="<?= $midiasocial_url; ?>" target="_blank" class="social-icon si-small si-borderless si-<?= $midiasocial_category; ?>" title="Combat Armor Defense do Brasil">
                                                <i class='icon-<?= $midiasocial_category; ?>'></i>
                                                <i class='icon-<?= $midiasocial_category; ?>'></i>
                                            </a>
                                            <?php
                                        endforeach;
                                    endif; 
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #copyrights end -->
            </footer>
            <!-- #footer end -->
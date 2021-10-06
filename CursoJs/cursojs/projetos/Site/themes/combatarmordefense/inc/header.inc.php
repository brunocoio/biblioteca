            <!-- Header ============================================ -->
            <header id="header" class="transparent-header" data-sticky-class="not-dark">
                <div id="header-wrap">
                    <div class="container">
                        <div class="header-row">
                            <!-- Logo ============================================= -->
                            <div id="logo">
                                <a href="index" class="standard-logo" data-dark-logo="<?= INCLUDE_PATH; ?>/images/logo-dark.png"><img src="<?= INCLUDE_PATH; ?>/images/logo.png" alt="Combat Armor Defense do Brasil" title="Combat Armor Defense do Brasil"></a>
                                <a href="index" class="retina-logo" data-dark-logo="<?= INCLUDE_PATH; ?>/images/logo-dark@2x.png"><img src="<?= INCLUDE_PATH; ?>/images/logo@2x.png" alt="Combat Armor Defense do Brasil" title="Combat Armor Defense do Brasil"></a>
                                <strong>Combat Armor Defense do Brasil</strong>
                            </div>
                            <!-- #logo end -->
                            <!-- mobile -->
                            <div id="primary-menu-trigger">
                                <svg class="svg-trigger" viewBox="0 0 100 100"><path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path><path d="m 30,50 h 40"></path><path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path></svg>
                            </div>
                            <!-- /mobile -->
                            <!-- Primary Navigation ============================================= -->
                            <nav class="primary-menu">
                                <ul class="menu-container">
                                    <?php
                                    $MenuView = new Read;
                                    $MenuView->ExeRead("cad_menus", "WHERE menu_status = 1 ORDER BY menu_id ASC");
                                    if (!$MenuView->getResult()):
                                        WSErro("Nenhum menu cadastrado.", WS_INFOR);
                                    else:
                                        foreach ($MenuView->getResult() as $Menus):
                                            echo "<li class=\"menu-item\"><a class=\"menu-link\" href=\"{$Menus['menu_url']}\" target=\"{$Menus['menu_target']}\"><div>{$Menus['menu_name']}</div></a></li>";
                                        endforeach;
                                    endif;
                                    ?>
                                    <li class="menu-item">
                                        <div class="floating-contact-btn menu-link"><div><a class="menu-link nopad"><div>Contato</div></a></div></div>
                                    </li>
                                </ul>
                            </nav>
                            <!-- #primary-menu end -->
                        </div>
                    </div>
                </div>
                <div class="header-wrap-clone"></div>
            </header>
            <!-- #header end -->
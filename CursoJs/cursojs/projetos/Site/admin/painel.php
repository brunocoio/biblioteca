<?php
ob_start();
session_start();
require('../_app/Config.inc.php');

$login = new Login(3);
$logoff = filter_input(INPUT_GET, 'logoff', FILTER_VALIDATE_BOOLEAN);
$getexe = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT);

if (!$login->CheckLogin()):
    unset($_SESSION['userlogin']);
    header('Location: index.php?exe=restrito');
    exit;
else:
    $userlogin = $_SESSION['userlogin'];
endif;

if ($logoff):
    unset($_SESSION['userlogin']);
    header('Location: index.php?exe=logoff');
endif;
?>

<?php
//ATIVA MENU
if (isset($getexe)):
    $linkto = explode('/', $getexe);
else:
    $linkto = array();
endif;
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="mit" content="2021-04-28T16:33:16-03:00+22773">
        <?php
        $Link = new Link;
        $Link->getTags();
        ?>
        <link rel="shortcut icon" href="<?= INCLUDE_PATH; ?>/images/favicon.ico" type="image/x-icon" />        
        <link href="<?= INCLUDE_PATH; ?>/images/favicon.png" rel="icon" type="image/png" />
        <!-- Stylesheets ============================================= -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,300;0,400;0,700;1,400&family=Poppins:ital,wght@0,300;0,400;0,700;1,400&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="<?= INCLUDE_PATH; ?>/css/bootstrap.css" type="text/css" />
        <link rel="stylesheet" href="<?= INCLUDE_PATH; ?>/css/style.css" type="text/css" />
        <link rel="stylesheet" href="<?= INCLUDE_PATH; ?>/css/swiper.css" type="text/css" />
        <link rel="stylesheet" href="<?= INCLUDE_PATH; ?>/css/dark.css" type="text/css" />
        <link rel="stylesheet" href="../themes/combatarmordefense/css/font-icons.css" type="text/css" />
        <link rel="stylesheet" href="<?= INCLUDE_PATH; ?>/css/animate.css" type="text/css" />
        <link rel="stylesheet" href="<?= INCLUDE_PATH; ?>/css/magnific-popup.css" type="text/css" />
        <link rel="stylesheet" href="<?= INCLUDE_PATH; ?>/css/custom.css" type="text/css" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!-- Document Title ============================================= -->
        <!-- SLIDER REVOLUTION 5.x CSS SETTINGS -->
        <!-- /  -->
        <title>Combat Armor Defense</title>
    </head>
    <body class="stretched">
        <!-- Document Wrapper
        ============================================= -->
        <div id="wrapper" class="clearfix">
            <!-- Header ============================================ -->
            <header id="header" class="transparent-header" data-sticky-class="not-dark">
                <div id="header-wrap">
                    <div class="container">
                        <div class="header-row">
                            <!-- Logo ============================================= -->
                            <div id="logo">
                                <a href="painel.php" class="standard-logo" data-dark-logo="<?= INCLUDE_PATH; ?>/images/logo-dark.png"><img src="<?= INCLUDE_PATH; ?>/images/logo.png" alt="Combat Armor Defense do Brasil"></a>
                                <a href="painel.php" class="retina-logo" data-dark-logo="<?= INCLUDE_PATH; ?>/images/logo-dark@2x.png"><img src="<?= INCLUDE_PATH; ?>/images/logo@2x.png" alt="Combat Armor Defense do Brasil"></a>
                                <strong><?= $userlogin['user_name']; ?> <?= $userlogin['user_lastname']; ?></strong>
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
                                    <li class="menu-item">
                                        <a class="menu-link" href="painel.php"><div>Home</div></a>
                                        <ul class="sub-menu-container">
                                            <li class="menu-item">
                                                <a class="menu-link" href="painel.php?exe=homecontents/index"><div><i class="icon-search"></i>Home Content</div></a>
                                            </li>
                                            <li class="menu-item">
                                                <a class="menu-link" href="painel.php?exe=hometestimonials/index"><div><i class="icon-search"></i>Home Testimonial</div></a>
                                            </li>
                                            <li class="menu-item">
                                                <a class="menu-link" href="painel.php?exe=homesections/index"><div><i class="icon-search"></i>Home Section</div></a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-item">
                                        <a class="menu-link" href="painel.php?exe=banners/index"><div>Banners</div></a>
                                        <ul class="sub-menu-container">
                                            <li class="menu-item">
                                                <a class="menu-link" href="painel.php?exe=banners/index"><div><i class="icon-search"></i>Listar</div></a>
                                            </li>
                                            <li class="menu-item">
                                                <a class="menu-link" href="painel.php?exe=banners/create"><div><i class="icon-plus"></i>Cadastrar</div></a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-item">
                                        <a class="menu-link" href="painel.php?exe=menus/index"><div>Menus</div></a>
                                        <ul class="sub-menu-container">
                                            <li class="menu-item">
                                                <a class="menu-link" href="painel.php?exe=menus/index"><div><i class="icon-search"></i>Listar</div></a>
                                            </li>
                                            <li class="menu-item">
                                                <a class="menu-link" href="painel.php?exe=menus/create"><div><i class="icon-plus"></i>Cadastrar</div></a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-item">
                                        <a class="menu-link" href="painel.php?exe=pages/index"><div>Páginas</div></a>
                                        <ul class="sub-menu-container">
                                            <li class="menu-item">
                                                <a class="menu-link" href="painel.php?exe=pages/index"><div><i class="icon-search"></i>Listar</div></a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-item">
                                        <a class="menu-link" href="painel.php?exe=blindagens/index"><div>Blindagem</div></a>
                                        <ul class="sub-menu-container">
                                            <li class="menu-item">
                                                <a class="menu-link" href="painel.php?exe=blindagens/index"><div><i class="icon-search"></i>Listar</div></a>
                                            </li>
                                            <li class="menu-item">
                                                <a class="menu-link" href="painel.php?exe=blindagens/create"><div><i class="icon-plus"></i>Cadastrar</div></a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-item">
                                        <a class="menu-link" href="painel.php?exe=produtos/index"><div>Produtos</div></a>
                                        <ul class="sub-menu-container">
                                            <li class="menu-item">
                                                <a class="menu-link" href="painel.php?exe=produtos/index"><div><i class="icon-search"></i>Listar</div></a>
                                            </li>
                                            <li class="menu-item">
                                                <a class="menu-link" href="painel.php?exe=produtos/create"><div><i class="icon-plus"></i>Cadastrar</div></a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-item">
                                        <a class="menu-link" href="painel.php?exe=midias/index"><div>Mídias</div></a>
                                        <ul class="sub-menu-container">
                                            <li class="menu-item">
                                                <a class="menu-link" href="painel.php?exe=midias/index"><div><i class="icon-search"></i>Listar</div></a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-item">
                                        <a class="menu-link" href="painel.php?exe=faqs/index"><div>FAQ'S</div></a>
                                        <ul class="sub-menu-container">
                                            <li class="menu-item">
                                                <a class="menu-link" href="painel.php?exe=faqs/index"><div><i class="icon-search"></i>Listar</div></a>
                                            </li>
                                            <li class="menu-item">
                                                <a class="menu-link" href="painel.php?exe=faqs/create"><div><i class="icon-plus"></i>Cadastrar</div></a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-item">
                                        <a class="menu-link" href="painel.php?exe=rodapes/index"><div>Rodapé</div></a>
                                        <ul class="sub-menu-container">
                                            <li class="menu-item">
                                                <a class="menu-link" href="painel.php?exe=rodapes/index"><div><i class="icon-search"></i>Listar</div></a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-item">
                                        <a class="menu-link" href="painel.php?exe=midiassociais/index"><div>MS</div></a>
                                        <ul class="sub-menu-container">
                                            <li class="menu-item">
                                                <a class="menu-link" href="painel.php?exe=midiassociais/index"><div><i class="icon-search"></i>Listar</div></a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-item">
                                        <a class="menu-link" href="painel.php?logoff=true" alt="Sair" title="Sair"><div><i class="icon-off"></i></div></a>
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
            <!-- Content
            ============================================= -->
            <section id="content">
                <div class="content-wrap">
                    <!-- bloco -->
                    <div class="container clearfix">
                        <div class="topmargin-lg">
                            <?php
                            //QUERY STRING
                            if (!empty($getexe)):
                                $includepatch = __DIR__ . DIRECTORY_SEPARATOR . 'system' . DIRECTORY_SEPARATOR . strip_tags(trim($getexe) . '.php');
                            else:
                                $includepatch = __DIR__ . DIRECTORY_SEPARATOR . 'system' . DIRECTORY_SEPARATOR . 'home.php';
                            endif;

                            if (file_exists($includepatch)):
                                require_once($includepatch);
                            else:
                                echo "<div class=\"content notfound\">";
                                WSErro("<b>Erro ao incluir tela:</b> Erro ao incluir o controller /{$getexe}.php!", WS_ERROR);
                                echo "</div>";
                            endif;
                            ?>
                        </div>
                    </div>
                    <!-- /bloco -->  
                </div>
            </section>
            <!-- #content end -->
            <!-- Footer ============================================= -->
            <footer id="footer" class="dark border-top-0 topmargin-all">
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
                                                        <?= !empty($rodape_tel) ? '<strong>Telefone:</strong> ' . $rodape_tel : ''; ?><br>
                                                        <?= !empty($rodape_mail) ? '<strong>E-mail:</strong> ' . $rodape_tel : ''; ?><br>
                                                        <?php if ($gb == 2) { ?><a href="<?= INCLUDE_PATH; ?>/pdf/combat_armor_defense_catalogo2020.pdf" class="button button-border button-circle" target="_blank" download="Catálogo">Catálogo</a><?php } ?>
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
        </div>
        <!-- #wrapper end -->
        <!-- Go To Top
        ============================================= -->
        <div id="gotoTop" class="icon-angle-up"></div>
        <!-- JavaScripts ============================================= -->
        <script src="<?= INCLUDE_PATH; ?>/js/jquery.js"></script>
        <script src="<?= INCLUDE_PATH; ?>/js/plugins.min.js"></script>
        <!-- Footer Scripts ============================================= -->
        <script src="<?= INCLUDE_PATH; ?>/js/functions.js"></script>
    </body>
</html>
<?php
ob_end_flush();

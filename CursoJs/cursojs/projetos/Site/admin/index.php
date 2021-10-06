<?php
ob_start();
session_start();
require('../_app/Config.inc.php');
?>
<!DOCTYPE html>
<html dir="ltr" lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="mit" content="2021-04-28T16:33:16-03:00+22773">
        <link rel="canonical" href="https://combatarmordefense.com.br" />        
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Combat Armor Defense do Brasil"/>
        <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
        <meta name="google-site-verification" content="YQcSPdgxA1kTLaUxbmP0fvFDPoRXdiXAy3Lwv3SIoGA">
        <meta name="author" content="Combat Armor Defense do Brasil" />
        <meta property="og:locale" content="pt_BR" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="Combat Armor Defense do Brasil" />
        <meta property="og:description" content="Combat Armor Defense do Brasil" />
        <meta property="og:url" content="https://www.combatarmordefense.com.br" />
        <meta property="og:site_name" content="Combat Armor Defense do Brasil">
        <meta property="og:determiner" content="the">
        <link rel="shortcut icon" href="../themes/combatarmordefense/images/favicon.ico" type="image/x-icon" />        
        <link href="../themes/combatarmordefense/images/favicon.png" rel="icon" type="image/png" />
        <!-- Stylesheets
        ============================================= -->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Poppins:300,400,500,600,700|PT+Serif:400,400i&display=swap" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="../themes/combatarmordefense/css/bootstrap.css" type="text/css" />
        <link rel="stylesheet" href="../themes/combatarmordefense/css/style.css" type="text/css" />
        <link rel="stylesheet" href="../themes/combatarmordefense/css/dark.css" type="text/css" />
        <link rel="stylesheet" href="../themes/combatarmordefense/css/font-icons.css" type="text/css" />
        <link rel="stylesheet" href="../themes/combatarmordefense/css/animate.css" type="text/css" />
        <link rel="stylesheet" href="../themes/combatarmordefense/css/magnific-popup.css" type="text/css" />
        <link rel="stylesheet" href="../themes/combatarmordefense/css/custom.css" type="text/css" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!-- Document Title
        ============================================= -->
        <title>Combat Armor Defense do Brasil</title>
    </head>
    <body class="stretched">
        <!-- Document Wrapper
        ============================================= -->
        <div id="wrapper" class="clearfix">
            <!-- Content
            ============================================= -->
            <section id="content">
                <div class="content-wrap py-0">
                    <div class="section p-0 m-0 h-100 position-absolute" style="background: url('../themes/combatarmordefense/images/site/logincombatarmordobrasil.png') center center no-repeat; background-size: cover;"></div>
                    <div class="section bg-transparent min-vh-100 p-0 m-0">
                        <div class="vertical-middle">
                            <div class="container-fluid py-5 mx-auto">
                                <div class="center">
                                    <a href="index.html"><img src="../themes/combatarmordefense/images/logo-dark.png" alt="Canvas Logo"></a>
                                </div>
                                <div class="card mx-auto rounded-0 border-0" style="max-width: 400px; background-color: rgba(255,255,255,0.93);">
                                    <div class="card-body" style="padding: 40px;">
                                        <form id="login-form" name="login-form" class="mb-0" action="#" method="post">
                                            <?php
                                            $login = new Login(3);
                                            if ($login->CheckLogin()):
                                                header('Location: painel.php');
                                            endif;
                                            $dataLogin = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                                            if (!empty($dataLogin['AdminLogin'])):
                                                $login->ExeLogin($dataLogin);
                                                if (!$login->getResult()):
                                                    WSErro($login->getError()[0], $login->getError()[1]);
                                                else:
                                                    header('Location: painel.php');
                                                endif;
                                            endif;
                                            $get = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT);
                                            if (!empty($get)):
                                                if ($get == 'restrito'):
                                                    WSErro('Erro ao efetuar o login.', WS_ALERT);
                                                elseif ($get == 'logoff'):
                                                    WSErro('Sua sessão foi finalizada.', WS_ACCEPT);
                                                else:
                                                    WSErro('', WS_ACCEPT);
                                                endif;
                                            endif;
                                            ?>
                                            <div class="row">
                                                <div class="col-12 form-group">
                                                    <label for="login-form-username">Login:</label>
                                                    <input type="email" id="login-form-username" name="user" value="" class="form-control not-dark" />
                                                </div>
                                                <div class="col-12 form-group">
                                                    <label for="login-form-password">Senha:</label>
                                                    <input type="password" id="login-form-password" name="pass" value="" class="form-control not-dark" />
                                                </div>
                                                <div class="col-12 form-group">
                                                    <input type="submit" name="AdminLogin" value="Logar" class="button button-3d button-black m-0" id="login-form-submit"/>
                                                    <!--a href="#" class="float-right">Forgot Password?</a-->
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="text-center dark mt-3"><small><script language=javascript type="text/javascript"> now = new Date; document.write("Copyrights &copy; Combat Armor Defense do Brasil | Todos os direitos reservados | 2019 - " + now.getFullYear());</script></small></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section><!-- #content end -->
        </div><!-- #wrapper end -->
        <!-- Go To Top
        ============================================= -->
        <div id="gotoTop" class="icon-angle-up"></div>
        <!-- JavaScripts
        ============================================= -->
        <script src="../themes/combatarmordefense/js/jquery.js"></script>
        <script src="../themes/combatarmordefense/js/plugins.min.js"></script>
        <!-- Footer Scripts
        ============================================= -->
        <script src="../themes/combatarmordefense/js/functions.js"></script>
    </body>
</html>
<?php
ob_end_flush();

<?php
ob_start();
require('./_app/Config.inc.php');
$Session = new Session;
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
        <link rel="stylesheet" href="themes/combatarmordefense/css/font-icons.css" type="text/css" />
        <link rel="stylesheet" href="<?= INCLUDE_PATH; ?>/css/animate.css" type="text/css" />
        <link rel="stylesheet" href="<?= INCLUDE_PATH; ?>/css/magnific-popup.css" type="text/css" />
        <link rel="stylesheet" href="<?= INCLUDE_PATH; ?>/css/custom.css" type="text/css" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!-- Document Title ============================================= -->
        <!-- SLIDER REVOLUTION 5.x CSS SETTINGS -->
        <link rel="stylesheet" type="text/css" href="themes/combatarmordefense/include/rs-plugin/css/settings.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?= INCLUDE_PATH; ?>/include/rs-plugin/css/layers.css">
        <link rel="stylesheet" type="text/css" href="<?= INCLUDE_PATH; ?>/include/rs-plugin/css/navigation.css">
        <!-- Bootstrap Select CSS -->
        <link rel="stylesheet" href="<?= INCLUDE_PATH; ?>/css/components/bs-select.css" type="text/css" />
        <!-- car Specific Stylesheet -->
        <link rel="stylesheet" href="<?= INCLUDE_PATH; ?>/demos/car/car.css" type="text/css" />
        <link rel="stylesheet" href="<?= INCLUDE_PATH; ?>/demos/car/css/car-icons/style.css" type="text/css" />
        <!-- /  -->
        <title>Combat Armor Defense</title>
    </head>
    <body class="stretched">
        <!-- Document Wrapper ============================================= -->
        <div id="wrapper" class="clearfix">
            <?php
            require(REQUIRE_PATH . '/inc/header.inc.php');
            if (!require($Link->getPatch())):
                WSErro('Erro ao incluir arquivo de navegação!', WS_ERROR, true);
            endif;
            require(REQUIRE_PATH . '/inc/footer.inc.php');
            ?>
        </div>
        <!-- #wrapper end -->
        <!-- Floating Contact ============================================= -->
        <div class="floating-contact-wrap">
            <div class="floating-contact-btn shadow">
                <i class="floating-contact-icon btn-unactive icon-envelope21"></i>
                <i class="floating-contact-icon btn-active icon-line-plus"></i>
            </div>
            <div class="floating-contact-box">
                <div id="q-contact" class="widget quick-contact-widget clearfix">
                    <div class="floating-contact-heading bg-color dark p-4 rounded">
                        <h3 class="mb-0 text-white">Contato</h3>
                    </div>
                    <div class="form-widget">
                        <form name="FormContato" class="p-4 mb-0" id="FormContato" action="#contactForm" role="form" method="post">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-transparent"><i class="icon-user-alt"></i></span>
                                </div>
                                <input 
                                    type="text" 
                                    name="RemetenteNome" 
                                    id="RemetenteNome" 
                                    class="form-control required" 
                                    value="" 
                                    placeholder="Nome">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-transparent"><i class="icon-at"></i></span>
                                </div>
                                <input 
                                    type="email" 
                                    name="RemetenteEmail" 
                                    id="RemetenteEmail" 
                                    class="form-control required" 
                                    value="" 
                                    placeholder="E-mail">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-transparent"><i class="icon-phone"></i></span>
                                </div>
                                <input 
                                    type="tel" 
                                    name="RemetenteTelefone" 
                                    id="RemetenteTelefone" 
                                    class="form-control required" 
                                    value="" 
                                    placeholder="Telefone">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-transparent"><i class="icon-comment21"></i></span>
                                </div>
                                <textarea 
                                    name="Mensagem" 
                                    placeholder="Mensagem"
                                    id="Mensagem" 
                                    class="form-control required" 
                                    cols="30" 
                                    rows="4"></textarea>
                            </div>
                            <button type="submit" name="SendFormContato" value="Enviar" id="SendFormContato" class="button button-rounded button-reveal button-large button-border text-right"><i class="icon-email2"></i><span>Enviar</span></button>
                            <div class="form-group col-lg-12">
                                <input
                                    class="form-control"
                                    placeholder="description"
                                    type = "hidden"
                                    name = "RemetenteDescription"
                                    title = "description"
                                    value = "Contato"
                                    />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /contact -->
        <!-- Go To Top ============================================= -->
        <div id="gotoTop" class="icon-angle-up"></div>
        <!-- JavaScripts ============================================= -->
        <script src="<?= INCLUDE_PATH; ?>/js/jquery.js"></script>
        <script src="<?= INCLUDE_PATH; ?>/js/plugins.min.js"></script>
        <script src="<?= INCLUDE_PATH; ?>/demos/car/js/360rotator.js"></script>
        <script src="<?= INCLUDE_PATH; ?>/js/components/bs-select.js"></script>
        <!-- Footer Scripts ============================================= -->
        <script src="<?= INCLUDE_PATH; ?>/js/functions.js"></script>
        <!-- SLIDER REVOLUTION 5.x SCRIPTS  -->
        <script src="<?= INCLUDE_PATH; ?>/include/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
        <script src="<?= INCLUDE_PATH; ?>/include/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
        <script src="<?= INCLUDE_PATH; ?>/include/rs-plugin/js/extensions/revolution.extension.video.min.js"></script>
        <script src="<?= INCLUDE_PATH; ?>/include/rs-plugin/js/extensions/revolution.extension.slideanims.min.js"></script>
        <script src="<?= INCLUDE_PATH; ?>/include/rs-plugin/js/extensions/revolution.extension.actions.min.js"></script>
        <script src="<?= INCLUDE_PATH; ?>/include/rs-plugin/js/extensions/revolution.extension.carousel.min.js"></script>
        <script src="<?= INCLUDE_PATH; ?>/include/rs-plugin/js/extensions/revolution.extension.layeranimation.min.js"></script>
        <script src="<?= INCLUDE_PATH; ?>/include/rs-plugin/js/extensions/revolution.extension.kenburn.min.js"></script>
        <script src="<?= INCLUDE_PATH; ?>/include/rs-plugin/js/extensions/revolution.extension.navigation.min.js"></script>
        <script src="<?= INCLUDE_PATH; ?>/include/rs-plugin/js/extensions/revolution.extension.migration.min.js"></script>
        <script src="<?= INCLUDE_PATH; ?>/include/rs-plugin/js/extensions/revolution.extension.parallax.min.js"></script>
        <!-- form -->
        <script>
            /*envio de form*/
            $('#FormContato').validate({
                submitHandler: function (form) {
                    var RemetenteNome = $('#RemetenteNome').val();
                    var RemetenteEmail = $('#RemetenteEmail').val();
                    var RemetenteTelefone = $('#RemetenteTelefone').val();
                    var Mensagem = $('#Mensagem').val();
                    /* construindo url */
                    var urlData = "&RemetenteNome=" + RemetenteNome + "&RemetenteEmail=" + RemetenteEmail + "&RemetenteTelefone=" + RemetenteTelefone + "&Mensagem=" + Mensagem;
                    /* Ajax */
                    $.ajax({
                        type: "POST",
                        url: "<?= INCLUDE_PATH; ?>/sendmail.php", /* endereço do phpmailer */
                        async: true,
                        data: urlData, /* informa Url */
                        success: function (data) { /* sucesso */
                            $('#FormContato').html(data);
                        }
                    });
                }
            });
        </script>
        <!-- banner animado -->
        <script>
            var tpj = jQuery;
            var revapi31;
            var $ = jQuery.noConflict();
            tpj(document).ready(function () {
                if (tpj("#rev_slider_679_1").revolution == undefined) {
                    revslider_showDoubleJqueryError("#rev_slider_679_1");
                } else {
                    revapi31 = tpj("#rev_slider_679_1").show().revolution({
                        sliderType: "standard",
                        jsFileLocation: "<?= INCLUDE_PATH; ?>/include/rs-plugin/js/",
                        sliderLayout: "fullwidth",
                        dottedOverlay: "none",
                        delay: 16000,
                        hideThumbs: 200,
                        thumbWidth: 100,
                        thumbHeight: 50,
                        thumbAmount: 5,
                        navigation: {
                            keyboardNavigation: "on",
                            keyboard_direction: "horizontal",
                            mouseScrollNavigation: "off",
                            onHoverStop: "off",
                            touch: {
                                touchenabled: "on",
                                swipe_threshold: 75,
                                swipe_min_touches: 1,
                                swipe_direction: "horizontal",
                                drag_block_vertical: false
                            },
                            arrows: {
                                style: "hades",
                                enable: true,
                                hide_onmobile: false,
                                hide_onleave: false,
                                tmp: '<div class="tp-arr-allwrapper">	<div class="tp-arr-imgholder"></div></div>',
                                left: {
                                    h_align: "left",
                                    v_align: "center",
                                    h_offset: 10,
                                    v_offset: 0
                                },
                                right: {
                                    h_align: "right",
                                    v_align: "center",
                                    h_offset: 10,
                                    v_offset: 0
                                }
                            },
                        },
                        responsiveLevels: [1140, 1024, 778, 480],
                        visibilityLevels: [1140, 1024, 778, 480],
                        gridwidth: [1140, 1024, 778, 480],
                        gridheight: [700, 768, 960, 720],
                        lazyType: "none",
                        shadow: 0,
                        spinner: "off",
                        stopLoop: "off",
                        stopAfterLoops: -1,
                        stopAtSlide: -1,
                        shuffle: "off",
                        autoHeight: "off",
                        fullScreenAutoWidth: "off",
                        fullScreenAlignForce: "off",
                        fullScreenOffsetContainer: "",
                        fullScreenOffset: "0px",
                        hideThumbsOnMobile: "off",
                        hideSliderAtLimit: 0,
                        hideCaptionAtLimit: 0,
                        hideAllCaptionAtLilmit: 0,
                        debugMode: false,
                        fallbacks: {
                            simplifyAll: "off",
                            nextSlideOnWindowFocus: "off",
                            disableFocusListener: false,
                        }
                    });
                }
                revapi31.on("revolution.slide.onloaded", function (e) {
                    setTimeout(function () {
                        SEMICOLON.slider.sliderDimensions();
                    }, 200);
                });
                revapi31.on("revolution.slide.onchange", function (e, data) {
                    SEMICOLON.slider.revolutionSliderMenu();
                });
            });
            /*ready*/
        </script>
        <!-- /banner animado -->
        <!-- contato modal -->
        <script>
            jQuery(document).ready(function ($) {
                var elementParent = $('.floating-contact-wrap');
                $('.floating-contact-btn').off('click').on('click', function () {
                    elementParent.toggleClass('active', );
                });
            });
        </script>
        <!-- contato modal -->
        <!-- gallery -->
        <script>
            var tpj = jQuery;
            var revapi19;
            var $ = jQuery.noConflict();
            tpj(document).ready(function () {
                if (tpj("#discover").revolution == undefined) {
                    revslider_showDoubleJqueryError("#discover");
                } else {
                    revapi19 = tpj("#discover").show().revolution({
                        sliderType: "standard",
                        jsFileLocation: "<?= INCLUDE_PATH; ?>/include/rs-plugin/js/",
                        sliderLayout: "fullwidth",
                        dottedOverlay: "none",
                        delay: 9000,
                        navigation: {
                            onHoverStop: "off",
                        },
                        viewPort: {
                            enable: true,
                            outof: "wait",
                            visible_area: "80%"
                        },
                        responsiveLevels: [1170, 1024, 778, 480],
                        visibilityLevels: [1170, 1024, 778, 480],
                        gridwidth: [1240, 1024, 778, 480],
                        gridheight: [840, 700, 550, 1720],
                        lazyType: "single",
                        parallax: {
                            type: "scroll",
                            origo: "slidercenter",
                            speed: 400,
                            levels: [5, 20, 30, 40, 50, -4, -6, -8, 45, 46, 47, 48, 49, 50, 51, 55],
                            type: "scroll",
                            disable_onmobile: "on"
                        },
                        shadow: 0,
                        spinner: "off",
                        stopLoop: "on",
                        stopAfterLoops: 0,
                        stopAtSlide: 1,
                        shuffle: "off",
                        autoHeight: "off",
                        disableProgressBar: "on",
                        hideThumbsOnMobile: "off",
                        hideSliderAtLimit: 0,
                        hideCaptionAtLimit: 0,
                        hideAllCaptionAtLilmit: 0,
                        debugMode: false,
                        fallbacks: {
                            simplifyAll: "off",
                            nextSlideOnWindowFocus: "off",
                            disableFocusListener: false,
                        }
                    });
                    var is_safari = (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1);
                    revapi19.on("revolution.slide.onloaded", function (e) {
                        var npe = document.getElementsByClassName("nopointerevent");
                        for (var i = 0; i < npe.length; i++) {
                            npe[i].parentNode.parentNode.parentNode.style.pointerEvents = "none";
                            npe[i].parentNode.parentNode.parentNode.style.zIndex = 100;
                        }
                        jQuery('.ddd_mousebox').on('mousemove', function (e) {
                            var sto = revapi19.offset(),
                                    dim = this.getBoundingClientRect(),
                                    tpos = jQuery(this.parentNode.parentNode.parentNode).position(),
                                    pos = {top: e.pageY - sto.top - tpos.top, left: e.pageX - tpos.left},
                                    perc = {wp: (pos.left / dim.width) - 0.5, hp: (pos.top / dim.height) - 0.5};
                            getOverlaps(this);
                            punchgs.TweenLite.to(this.overlapps, 0.4, {force3D: "true", overwrite: "auto", transformOrigin: "50% 50% 100%", z: "300px", rotationY: 0 - ((perc.wp) * 5), rotationX: ((perc.hp) * 5), zIndex: 30});
                            punchgs.TweenLite.set(this.parentNode.parentNode.parentNode, {zIndex: 10});
                            if (is_safari)
                                punchgs.TweenLite.to(this, 0.4, {force3D: "true", overwrite: "auto", z: "10px", transformOrigin: "50% 50%", rotationY: 0 - ((perc.wp) * 10), rotationX: ((perc.hp) * 10)});
                            else
                                punchgs.TweenLite.to(this, 0.4, {force3D: "true", overwrite: "auto", z: "10px", transformOrigin: "50% 50%", rotationY: 0 - ((perc.wp) * 10), rotationX: ((perc.hp) * 10), boxShadow: "0 50px 100px rgba(15,20,40,0.35),0 20px 45px rgba(15,20,40,0.35)"});
                        });
                        jQuery('.ddd_mousebox').on('mouseleave', function (e) {
                            punchgs.TweenLite.set(this.parentNode.parentNode.parentNode, {zIndex: 5});
                            punchgs.TweenLite.to(this, 0.5, {force3D: "true", overwrite: "auto", z: "0px", transformOrigin: "50% 50%", rotationY: 0, rotationX: 0, boxShadow: "0,0,0,0 rgba(0,0,0,0)"});
                            punchgs.TweenLite.to(this.overlapps, 0.5, {force3D: "true", z: "0px", overwrite: "auto", transformOrigin: "50% 50% 100%", rotationY: 0, rotationX: 0});
                        });
                    });
                    function getOverlaps(el) {
                        if (el.overlapps == undefined) {
                            el.overlapps = [];
                            var jel = jQuery(el),
                                    jpel = jQuery(el.parentNode.parentNode.parentNode),
                                    pos_e = jpel.position();
                            pos_e.bottom = jel.height() + pos_e.top;
                            pos_e.right = jel.width() + pos_e.left;
                            revapi19.find('.tp-caption').each(function () {
                                var cel = jQuery(this.parentNode.parentNode.parentNode),
                                        pos_cel = cel.position();
                                if (this !== el && pos_cel.top >= pos_e.top && pos_cel.top <= pos_e.bottom && pos_cel.left >= pos_e.left && pos_cel.left <= pos_e.right)
                                    el.overlapps.push(cel);
                            });
                        }
                    }
                }
            });
            /*ready*/
        </script>
        <!-- /gallery -->
        <!-- car -->
        <script>
            var $ = jQuery.noConflict();
            //Car Appear In View
            function isScrolledIntoView(elem) {
                var docViewTop = $(window).scrollTop();
                var docViewBottom = docViewTop + $(window).height();

                var elemTop = $(elem).offset().top + 180;
                var elemBottom = elemTop + $(elem).height() - 500;

                return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
            }
            $(window).scroll(function () {
                $('.running-car').each(function () {
                    if (isScrolledIntoView(this) === true) {
                        $(this).addClass('in-view');
                    } else {
                        $(this).removeClass('in-view');
                    }
                });
            });
            //threesixty degree
            window.onload = init;
            var car;
            function init() {
                car = $('.360-car').ThreeSixty({
                    totalFrames: 52, // Total no. of image you have for 360 slider
                    endFrame: 52, // end frame for the auto spin animation
                    currentFrame: 3, // This the start frame for auto spin
                    imgList: '.threesixty_images', // selector for image list
                    progress: '.spinner', // selector to show the loading progress
                    imagePath: '<?= INCLUDE_PATH; ?>/demos/car/images/360degree-cars/', // path of the image assets
                    filePrefix: '', // file prefix if any
                    ext: '.png', // extention for the assets
                    height: 887,
                    width: 500,
                    navigation: true,
                    responsive: true,
                });
            }
            ;
            // Rev Slider
            var tpj = jQuery;
            var revapi424;
            tpj(document).ready(function () {
                if (tpj("#rev_slider_424_1").revolution == undefined) {
                    revslider_showDoubleJqueryError("#rev_slider_424_1");
                } else {
                    revapi424 = tpj("#rev_slider_424_1").show().revolution({
                        sliderType: "carousel",
                        jsFileLocation: "<?= INCLUDE_PATH; ?>/include/rs-plugin/js/",
                        sliderLayout: "auto",
                        dottedOverlay: "none",
                        delay: 7000,
                        navigation: {
                            keyboardNavigation: "off",
                            keyboard_direction: "horizontal",
                            mouseScrollNavigation: "off",
                            mouseScrollReverse: "default",
                            onHoverStop: "off",
                            touch: {
                                touchenabled: "on",
                                swipe_threshold: 75,
                                swipe_min_touches: 1,
                                swipe_direction: "horizontal",
                                drag_block_vertical: false
                            }
                            ,
                            arrows: {
                                style: "uranus",
                                enable: false,
                                hide_onmobile: false,
                                hide_onleave: true,
                                hide_delay: 200,
                                hide_delay_mobile: 1200,
                                tmp: '',
                                left: {
                                    h_align: "left",
                                    v_align: "center",
                                    h_offset: -10,
                                    v_offset: 0
                                },
                                right: {
                                    h_align: "right",
                                    v_align: "center",
                                    h_offset: -10,
                                    v_offset: 0
                                }
                            },
                            carousel: {
                                maxRotation: 65,
                                vary_rotation: "on",
                                minScale: 55,
                                vary_scale: "on",
                                horizontal_align: "center",
                                vertical_align: "center",
                                fadeout: "on",
                                vary_fade: "on",
                                maxVisibleItems: 5,
                                infinity: "off",
                                space: 0,
                                stretch: "on"
                            }
                            ,
                            tabs: {
                                style: "ares",
                                enable: true,
                                width: 270,
                                height: 80,
                                min_width: 270,
                                wrapper_padding: 10,
                                wrapper_color: "transparent",
                                wrapper_opacity: "0.5",
                                tmp: '<div class="tp-tab-content">  <span class="tp-tab-date">{{param1}}</span>  <span class="tp-tab-title">{{title}}</span></div><div class="tp-tab-image"></div>',
                                visibleAmount: 7,
                                hide_onmobile: false,
                                hide_under: 420,
                                hide_onleave: false,
                                hide_delay_mobile: 1200,
                                hide_delay: 200,
                                direction: "horizontal",
                                span: true,
                                position: "outer-bottom",
                                space: 20,
                                h_align: "left",
                                v_align: "bottom",
                                h_offset: 0,
                                v_offset: 0
                            }
                        },
                        visibilityLevels: [1240, 1024, 778, 480],
                        gridwidth: [1240, 992, 768, 420],
                        gridheight: [600, 500, 960, 720],
                        lazyType: "single",
                        shadow: 0,
                        spinner: "off",
                        stopLoop: "off",
                        stopAfterLoops: 0,
                        stopAtSlide: 1,
                        shuffle: "off",
                        autoHeight: "off",
                        hideThumbsOnMobile: "off",
                        hideSliderAtLimit: 0,
                        hideCaptionAtLimit: 0,
                        hideAllCaptionAtLilmit: 0,
                        debugMode: false,
                        fallbacks: {
                            simplifyAll: "off",
                            nextSlideOnWindowFocus: "off",
                            disableFocusListener: false,
                        }
                    });
                }
            });
            /*ready*/
            // Video on play on hover
            jQuery(document).ready(function ($) {
                $('.videoplay-on-hover').hover(function () {
                    if ($(this).find('video').length > 0) {
                        $(this).find('video').get(0).play();
                    }
                }, function () {
                    if ($(this).find('video').length > 0) {
                        $(this).find('video').get(0).pause();
                    }
                });
            });
        </script>
        <!-- /car -->
    </body>
</html>
<?php
ob_end_flush();
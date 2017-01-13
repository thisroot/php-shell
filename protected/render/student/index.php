<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student's tool</title>
    <script src="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Vendor CSS -->
    <link href="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/animate.css/animate.min.css" rel="stylesheet">
    <link href="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css" rel="stylesheet">
    <link href="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet">
    <link href="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/google-material-color/dist/palette.css" rel="stylesheet">
    <link href="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet">
    <link href="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.css" rel="stylesheet">
    <link href="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/nouislider/src/jquery.nouislider.css" rel="stylesheet">

     <? APP::Render('core/widgets/css') ?>
    <style type="text/css">
        .toggle-switch {
            margin-top: 10px;
        }

        .h-logo a {
            font-size: 14px;
        }

        .main-menu {
            padding-top: 120px;
        }

        .not-active {
            pointer-events: none;
            cursor: default;
        }
    </style>
</head>
<body >
    <? APP::Render('student/widgets/page_loader') ?>
    <script>
       (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
       (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
       m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
       })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

       ga('create', 'UA-63396844-3', 'auto');
       ga('send', 'pageview');
    </script>
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function (d, w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter36066965 = new Ya.Metrika({
                        id:36066965,
                        clickmap:true,
                        trackLinks:true,
                        accurateTrackBounce:true,
                        webvisor:true,
                        trackHash:true
                    });
                } catch(e) { }
            });

            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () { n.parentNode.insertBefore(s, n); };
            s.type = "text/javascript";
            s.async = true;
            s.src = "https://mc.yandex.ru/metrika/watch.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else { f(); }
        })(document, window, "yandex_metrika_callbacks");
    </script>
<noscript><div><img src="https://mc.yandex.ru/watch/36066965" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
   <!-- Render Header -->
   <? APP::Render('student/widgets/header', 'include', [
       'img' => APP::Module('Student')->user_data['user_settings']['img_crop']
           ]); ?>
     <!-- Stop Render Header -->
    <section id="main">
        <? APP::Render('student/widgets/sidebar') ?>

        <section id="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                         <div class="card">
                            <div class="card-header">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<? APP::Render('student/widgets/footer') ?>
    </section>


    <? APP::Render('student/widgets/ie_warning') ?>

    <!-- Javascript Libraries -->
    <script src="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/Waves/dist/waves.min.js"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.js"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.min.js"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/ui/vendors/bower_components/nouislider/distribute/jquery.nouislider.all.min.js"></script>
    <script src="<?= APP::Module('Routing')->root ?>public/ui/vendors/bootstrap-growl/bootstrap-growl.min.js" type="text/javascript"></script>

<? APP::Render('core/widgets/js') ?>

    <script type="text/javascript">
    $(document).ready(function() {

        function notify(message, type){
            $.growl({
                message: message
            },{
                type: type,
                allow_dismiss: true,
                label: 'Cancel',
                className: 'btn-xs btn-inverse',
                placement: {
                    from: 'bottom',
                    align: 'right'
                },
                delay: 10000,
                animate: {
                        enter: 'animated bounceInRight',
                        exit: 'animated bounceOut'
                },
                offset: {
                    x: 40,
                    y: 40
                }
            });
        };

        switch('<?= $data['role'] ?>') {
            case 'default':
                 notify('If you want to use all scopes, you need  register','inverse');
                 break;

            case 'new':
                 notify('If you want to use scopes of your personal profile, you need activate it via email','inverse');
                 break;

        }





    });
    </script>

</body>
</html>

<!DOCTYPE html>
<html lang="ru-RU">
    <head>
        <title>Test</title>
        <meta charset="UTF-8">
        <meta name="robots" content="none">

        <script src="<?= APP::Module('Routing')->root ?>public/js/jquery-3.1.0.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
        <!-- include libraries(jQuery, bootstrap) -->
        <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
        <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>
        <!-- include summernote css/js-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>


        <style>
            body {
                font-family: 'Play', sans-serif;
                color: #38062e;
                background-color: #f9f9f9;
                padding: 15px;
            }

            .item {
                border-bottom: 1px solid #9f9f9f;
                padding: 10px;
            }

            .item:nth-child(2n) {
                background-color: #f5d1d1;
            }

            #theme {
                margin-bottom: 10px;
            }

            /*----- Accordion -----*/
            .accordion, .accordion * {
                -webkit-box-sizing:border-box;
                -moz-box-sizing:border-box;
                box-sizing:border-box;
            }

            .accordion {
                overflow:hidden;
                box-shadow:0px 1px 3px rgba(0,0,0,0.25);
                border-radius:3px;
                background:#f7f7f7;
            }

            /*----- Section Titles -----*/
            .accordion-section-title {
                width:100%;
                padding:10px;
                padding-right: 50px;
                display:inline-block;
                border-bottom: 1px solid #9f9f9f;
                transition:all linear 0.15s;
                /* Type */
                color:#353535;
                text-decoration: none;
            }

            .accordion-section:nth-child(2n) {
                background-color: #f5d1d1;
                transition:all linear 0.15s;
            }

            .accordion-section:nth-child(2n):hover {
                background-color: #f0bcbc;
                transition:all linear 0.15s;
            }

            .accordion-section:nth-child(2n-1) {
                background:#d9f3f2;
                transition:all linear 0.15s;
            }
            .accordion-section:nth-child(2n-1):hover {
                background:#ade1df;
                transition:all linear 0.15s;
            }

            .accordion-section:last-child .accordion-section-title {
                border-bottom:none;

            }

            /*----- Section Content -----*/
            .accordion-section-content {
                background-color: white;
                padding:10px;
                display:none;
            }

            .float {
                position: absolute;
                right: 10px;
                top: 55px;
                cursor: pointer;
                z-index: 1000;
            }

            input#text {
                width: 100%;
            }

            a:hover, a:focus {
                text-decoration: none;
            }

            .change-item {
                position: relative;
            }

            .change-item-sign {
                cursor: pointer;
                position: absolute;
                right: 10px;
                top: 5px;
                z-index: 10000;
                color: rgb(96, 96, 96);
                padding: 5px 10px;
                border: 1px solid #337ab7;
                border-radius: 3px;
            }
            .change-item-sign:hover, .change-item-sign:focus {
                background-color: #f9f9f9;
            }
        </style>

    </head>
    <body>

        <form id="settings">

            <div id="theme">
                <label><input checked type="checkbox" name="themeblock[]" id="themeblock" value="Архитектура компьютера">Архитектура компьютера</label>
                <label><input type="checkbox" name="themeblock[]" id="themeblock" value="Языки программирования">Языки программирования</label>
                <label><input type="checkbox" name="themeblock[]" id="themeblock" value="Операционные системы">Операционные системы</label>
                <label><input type="checkbox" name="themeblock[]" id="themeblock" value="Компьютерные сети">Компьютерные сети</label>
            </div>

            <select name="count_items">
                <option value="3">3</option>
                <option selected value="5">5</option>
                <option value="7">7</option>
                <option value="9">9</option>
                <option value="11">11</option>
                <option value="13">13</option>
            </select>

            <input type="submit" value="Обновить">

        </form>
        <a class="float" href="<? echo APP::Module('Routing')->root; ?>examine/add"><button>Добавить</button></a>

        <hr style="background: rgba(105, 25, 25, 0) linear-gradient(135deg, rgb(225, 136, 177) 21%, rgb(209, 160, 194) 30%, rgb(150, 84, 203) 71%, rgb(191, 98, 189) 86%) repeat scroll 0% 0%; color: rgb(53, 207, 180); border: 0px none; height: 5px;">

        <div class="accordion"></div>

        <div id="items"></div>


        <script>

            function getItems(settings) {

                //   $('#items').html('Loading');
                $('.accordion').html('Loading');

                $.ajax({
                    type: 'post',
                    url: '<?= APP::Module('Routing')->root ?>api/examine/items.json',
                    data: settings ? settings : [0],
                    success: function (result) {
                        $('#items').empty();
                        $('.accordion').empty();


                        $.each(result, function (index, item) {


                            var text = "<p>" + item.descriptions + "</p>"
                            var div_section = $('<div/>', {
                                id: 'accordion-' + item.id,
                                class: 'accordion-section-content'
                            })

                            var change_item = $('<div/>', {
                                class: 'change-item'

                            }).attr('data-item', item.id);


                            $(div_section).append(text);
                            var a = $('<a>', {
                                class: 'accordion-section-title',
                                href: '#accordion-' + item.id
                            }).append(item.text);

                            $(change_item).append('<a href="javascript:changeItem(' + item.id + ')"><div class="change-item-sign"><span class="fa fa-edit"></span></div></a>');


                            var accordion_section = $('<div />', {
                                class: 'accordion-section'
                            })

                            $(accordion_section).append(change_item);
                            $(accordion_section).append(a);

                            $(accordion_section).append(div_section);
                            $('.accordion').append(accordion_section);
                        })

                        function close_accordion_section() {
                            $('.accordion .accordion-section-title').removeClass('active');
                            $('.accordion .accordion-section-content').slideUp(300).removeClass('open');
                        }

                        $('.accordion-section-title').click(function (e) {
                            // Grab current anchor value
                            var currentAttrValue = $(this).attr('href');

                            if ($(e.target).is('.active')) {
                                close_accordion_section();
                            } else {
                                close_accordion_section();

                                // Add active class to section title
                                $(this).addClass('active');
                                // Open up the hidden content panel
                                $('.accordion ' + currentAttrValue).slideDown(300).addClass('open');
                            }

                            e.preventDefault();
                        });
                    }
                });
            }

            getItems();

            var counter;
            function changeItem(item) {

                $('a[href="#accordion-' + item + '"]').trigger('click');
                $('*[data-item=' + item + ']').empty();
                $('*[data-item=' + item + ']').append('<a href="javascript:updateItem(' + item + ')"><div class="change-item-sign"><span class="fa fa-save"></span></div></a>');

                ($('a[href="#accordion-' + item + '"]')).next().summernote({
                    height: 400, // set editor height
                    minHeight: null, // set minimum height of editor
                    maxHeight: null, // set maximum height of editor
                    focus: true, // set focus to editable area after initializing summernote
                    fontNames: ['Arial', 'Arial Black', 'Play', 'Tahoma']

                });

            }

            function updateItem(item) {

                var data = {'descriptions': $('a[href="#accordion-' + item + '"]').next().summernote('code'),
                    'id': item};

                console.log(data);

                $.ajax({
                    type: 'post',
                    url: '<?= APP::Module('Routing')->root ?>api/examine/edit.json',
                    data: data ? data : [0],
                    success: function (result) {
                        console.log(result);
                        $('a[href="#accordion-' + item + '"]').next().summernote('destroy');

                        $('*[data-item=' + item + ']').empty();
                        $('*[data-item=' + item + ']').append('<a href="javascript:changeItem(' + item + ')"><div class="change-item-sign"><span class="fa fa-edit"></span></div></a>');
                        $('a[href="#accordion-' + item + '"]').next().append(data);
                        $('a[href="#accordion-' + item + '"]').trigger('click');

                    }

                });

            }

            $('#settings').submit(function (event) {
                event.preventDefault();
                console.log($(this).serialize());
                getItems($(this).serialize());

            });

        </script>
    </body>
</html>




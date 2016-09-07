<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <title>Add</title>
    <meta charset="UTF-8">
    <meta name="robots" content="none">

    <script src="<?= APP::Module('Routing')->root ?>public/js/jquery-3.1.0.min.js"></script>
   
    <link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet">
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
    <a class="float" href="<? echo APP::Module('Routing')->root; ?>examine"><button>К тестам</button></a>


        <form>
            <input id="text">
        </form>

  <div id="summernote"></div>

  <div>
      <form id="submit">
          <select name="theme">
            <option value="Архитектура компьютера">Архитектура компьютера</option>
            <option selected value="Языки программирования">Языки программирования</option>
            <option value="Операционные системы">Операционные системы</option>
            <option value="Компьютерные сети">Компьютерные сети</option>
        </select>

          <input id="input-submit" type="submit" value="Добавить">
      </form>
      <div id="status"></div>
    </div>
  <script>
   $('#summernote').summernote({
  height: 300,                 // set editor height
  minHeight: null,             // set minimum height of editor
  maxHeight: null,             // set maximum height of editor
  focus: true                  // set focus to editable area after initializing summernote
   });


   function add(data) {

        $.ajax({
            type: 'post',
            url: '<?= APP::Module('Routing')->root ?>api/examine/add.json',
            data: data ? data : [0],
            success: function(result) {
                if(result == 'success') {
                    $('#summernote').summernote('code', '');
                    $('#text').val('');
                    $('#input-submit').val('Записано');
                    setTimeout(function() { $('#input-submit').val('Добавить')}, 1000);
                    
            } else {
                $('#input-submit').val('Ошибка');
                setTimeout(function() { $('#input-submit').val('Добавить')}, 1000);
            }
        }
        })
   }



    $('#submit').submit(function(event) {
                event.preventDefault();
                var descriptions = $('#summernote').summernote('code');
                var theme = $('option:selected').val();
                var text = $('#text').val();
                var data = {'text': text,
                            'theme':theme,
                            'descriptions': descriptions };
                add(data);
              });

  </script>

</body>
</html>




<?
$nav = [];

foreach ($data['path'] as $key => $value) {
    $title = $key ? $value : 'Leters';
    $nav[] = '<a href="' . APP::Module('Routing')->root . 'admin/mail/letters/' . APP::Module('Crypt')->Encode($key) . '">' . $title . '</a>';
}
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Mail</title>
    <meta charset="UTF-8">
    <meta name="robots" content="none">
    <style>
        .has-error {
            background: #fdd3d3;
        }
        .error {
            display: none;
        }
        .is-visible {
            display: block;
        }
    </style>
    <script src="<?= APP::Module('Routing')->root ?>public/js/jquery-3.1.0.min.js"></script>
</head>
<body>
    <h1>Mail</h1>
    <a href="<?= APP::Module('Routing')->root ?>admin">Admin</a> > <a href="<?= APP::Module('Routing')->root ?>admin/mail">Mail</a> > <?= implode(' > ', $nav) ?> > Add letter
    <hr>
    
    <form id="add-letter">
        <input type="hidden" name="group_id" value="<?= APP::Module('Crypt')->Encode($data['group_sub_id']) ?>">
        
        <label for="sender_id">Sender</label>
        <br>
        <input id="sender_id" type="text" name="sender_id">
        <div class="error"></div>
        <br><br>
        
        <label for="subject">Subject</label>
        <br>
        <input id="subject" type="text" name="subject" style="width: 400px;">
        <div class="error"></div>
        <br><br>
        
        <label for="html">HTML-version</label>
        <br>
        <textarea name="html" id="html" style="width: 100%; height: 300px;"></textarea>
        <div class="error"></div>
        <br><br>
        
        <label for="plaintext">Plaintext-version</label>
        <br>
        <textarea name="plaintext" id="plaintext" style="width: 100%; height: 300px;"></textarea>
        <div class="error"></div>
        <br><br>
        
        <label for="list_id">List-ID header</label>
        <br>
        <input id="list_id" type="text" name="list_id">
        <div class="error"></div>
        <br><br>

        <input type="submit" value="Add">
    </form>
    
    <script>
        $('#add-letter').submit(function(event) {
            event.preventDefault();

            var sender_id = $(this).find('#sender_id');
            var subject = $(this).find('#subject');
            var html = $(this).find('#html');
            var plaintext = $(this).find('#plaintext');
            
            sender_id.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            subject.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            html.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            plaintext.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            
            if (sender_id.val() === '') { sender_id.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }
            if (subject.val() === '') { subject.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }
            if (html.val() === '') { html.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }
            if (plaintext.val() === '') { plaintext.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }

            $(this).find('[type="submit"]').attr('disabled', true);
            
            $.ajax({
                type: 'post',
                url: '<?= APP::Module('Routing')->root ?>admin/mail/api/letters/add.json',
                data: $(this).serialize(),
                success: function(result) {
                    switch(result.status) {
                        case 'success': 
                            alert('Letter "' + subject.val() + '" has been added');
                            window.location.href = '<?= APP::Module('Routing')->root ?>admin/mail/letters/<?= APP::Module('Crypt')->Encode($data['group_sub_id']) ?>';
                            break;
                        case 'error': 
                            $.each(result.errors, function(i, error) {
                                switch(error) {}
                            });
                            break;
                    }
                    
                    $('#add-letter').find('[type="submit"]').attr('disabled', false);
                }
            });
          });
    </script>
</body>
</html>
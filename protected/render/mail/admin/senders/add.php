<?
$nav = [];

foreach ($data['path'] as $key => $value) {
    $title = $key ? $value : 'Senders';
    $nav[] = '<a href="' . APP::Module('Routing')->root . 'admin/mail/senders/' . APP::Module('Crypt')->Encode($key) . '">' . $title . '</a>';
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
    <a href="<?= APP::Module('Routing')->root ?>admin">Admin</a> > <a href="<?= APP::Module('Routing')->root ?>admin/mail">Mail</a> > <?= implode(' > ', $nav) ?> > Add sender
    <hr>
    
    <form id="add-sender">
        <input type="hidden" name="group_id" value="<?= APP::Module('Crypt')->Encode($data['group_sub_id']) ?>">

        <label for="name">Name</label>
        <br>
        <input id="name" type="text" name="name">
        <div class="error"></div>
        <br><br>
        
        <label for="email">E-Mail</label>
        <br>
        <input id="email" type="email" name="email">
        <div class="error"></div>
        <br><br>

        <input type="submit" value="Add">
    </form>
    
    <script>
        $('#add-sender').submit(function(event) {
            event.preventDefault();

            var name = $(this).find('#name');
            var email = $(this).find('#email');
            
            name.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            email.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            
            if (name.val() === '') { name.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }
            if (email.val() === '') { email.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }
 
            $(this).find('[type="submit"]').attr('disabled', true);
            
            $.ajax({
                type: 'post',
                url: '<?= APP::Module('Routing')->root ?>admin/mail/api/senders/add.json',
                data: $(this).serialize(),
                success: function(result) {
                    switch(result.status) {
                        case 'success': 
                            alert('Sender "' + name.val() + '" has been added');
                            window.location.href = '<?= APP::Module('Routing')->root ?>admin/mail/senders/<?= APP::Module('Crypt')->Encode($data['group_sub_id']) ?>';
                            break;
                        case 'error': 
                            $.each(result.errors, function(i, error) {
                                switch(error) {}
                            });
                            break;
                    }
                    
                    $('#add-sender').find('[type="submit"]').attr('disabled', false);
                }
            });
          });
    </script>
</body>
</html>
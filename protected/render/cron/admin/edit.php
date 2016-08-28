<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Cron</title>
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
    <h1>Cron</h1>
    <a href="<?= APP::Module('Routing')->root ?>admin">Admin</a> > <a href="<?= APP::Module('Routing')->root ?>admin/cron">Cron</a> > <a href="<?= APP::Module('Routing')->root ?>admin/cron/jobs/<?= APP::Module('Crypt')->Encode($data['ssh'][0]) ?>"><?= $data['ssh'][1][2] ?>@<?= $data['ssh'][1][0] ?>:<?= $data['ssh'][1][1] ?></a> > Edit job
    <hr>
    
    <form id="edit-cronjob">
        <input type="hidden" name="job_id_hash" value="<?= APP::Module('Routing')->get['job_id_hash'] ?>">

        <label for="job_0">Minute</label>
        <br>
        <input id="job_0" type="text" name="job[0]" value="<?= $data['job'][0] ?>">
        <div class="error"></div>
        <br><br>
        
        <label for="job_1">Hour</label>
        <br>
        <input id="job_1" type="text" name="job[1]" value="<?= $data['job'][1] ?>">
        <div class="error"></div>
        <br><br>
        
        <label for="job_2">Day of month</label>
        <br>
        <input id="job_2" type="text" name="job[2]" value="<?= $data['job'][2] ?>">
        <div class="error"></div>
        <br><br>
        
        <label for="job_3">Month</label>
        <br>
        <input id="job_3" type="text" name="job[3]" value="<?= $data['job'][3] ?>">
        <div class="error"></div>
        <br><br>
        
        <label for="job_4">Day of week</label>
        <br>
        <input id="job_4" type="text" name="job[4]" value="<?= $data['job'][4] ?>">
        <div class="error"></div>
        <br><br>
        
        <label for="job_5">CMD</label>
        <br>
        <input id="job_5" type="text" name="job[5]" style="width: 500px" value="<?= $data['job'][5] ?>">
        <div class="error"></div>
        <br><br>

        <input type="submit" value="Save changes">
    </form>
    
    <script>
        $('#edit-cronjob').submit(function(event) {
            event.preventDefault();

            var job_0 = $(this).find('#job_0');
            job_0.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            if (job_0.val() === '') { job_0.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }
            
            var job_1 = $(this).find('#job_1');
            job_1.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            if (job_1.val() === '') { job_1.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }
            
            var job_2 = $(this).find('#job_2');
            job_2.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            if (job_2.val() === '') { job_2.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }
            
            var job_3 = $(this).find('#job_3');
            job_3.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            if (job_3.val() === '') { job_3.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }
            
            var job_4 = $(this).find('#job_4');
            job_4.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            if (job_4.val() === '') { job_4.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }
            
            var job_5 = $(this).find('#job_5');
            job_5.removeClass('has-error').nextAll('.error').eq(0).removeClass('is-visible').empty();
            if (job_5.val() === '') { job_5.addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); return false; }

            $(this).find('[type="submit"]').attr('disabled', true);
            
            $.ajax({
                type: 'post',
                url: '<?= APP::Module('Routing')->root ?>admin/cron/api/jobs/update.json',
                data: $(this).serialize(),
                success: function(result) {
                    switch(result.status) {
                        case 'success': 
                            alert('Cronjob has been updated');
                            window.location.href = '<?= APP::Module('Routing')->root ?>admin/cron/jobs/<?= APP::Module('Crypt')->Encode($data['ssh'][0]) ?>';
                            break;
                        case 'error': 
                            $.each(result.errors, function(i, error) {
                                switch(error) {
                                    case 2: $('#job_0').addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); break;
                                    case 3: $('#job_1').addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); break;
                                    case 4: $('#job_2').addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); break;
                                    case 5: $('#job_3').addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); break;
                                    case 6: $('#job_4').addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); break;
                                    case 7: $('#job_5').addClass('has-error').nextAll('.error').eq(0).addClass('is-visible').html('Not specified'); break;
                                    case 8: alert('Command already exists'); break;
                                }
                            });
                            break;
                    }
                    
                    $('#edit-cronjob').find('[type="submit"]').attr('disabled', false);
                }
            });
          });
    </script>
</body>
</html>
<ul class="pull-right h-menu">
        <li class="dropdown hidden-xs">
            <a data-toggle="dropdown" href=""><i class="hm-icon zmdi zmdi-more-vert"></i></a>
            <ul class="dropdown-menu dm-icon pull-right">
                <li class="hidden-xs">
                    <a data-action="fullscreen" href=""><i class="zmdi zmdi-fullscreen"></i> Toggle Fullscreen</a>
                </li>
            </ul>
            
        </li>
        <li class="hm-alerts" data-user-alert="shell-app" data-ma-action="sidebar-open" data-ma-target="main-menu">
            <a href=""><i class="hm-icon zmdi zmdi-apps"></i></a>
        </li>
        <? if(isset(APP::Module('Users')->user['email'])) { ?>
        <li class="dropdown hm-profile">
            <a data-toggle="dropdown" href="">
               <? if(isset($data['img']) && ($data['img'] != NULL)) { echo '<img src="'.$data['img'].'">';} else { ?>
                <img src="<?= APP::$conf['location'][0] ?>://www.gravatar.com/avatar/<?= md5(APP::Module('Users')->user['email']) ?>?s=40&d=<?= urlencode(APP::Module('Routing')->root . 'public/ui/img/profile-pics/default.png') ?>&t=<?= time() ?>">
               <? } ?>
            </a>

            <ul class="dropdown-menu pull-right dm-icon">
                <li>
                    <a href="<?= APP::Module('Routing')->root ?>users/profile"><i class="zmdi zmdi-account"></i> View profile</a>
                </li>
                <li>
                    <a href="<?= APP::Module('Routing')->root ?>users/actions/change-password"><i class="zmdi zmdi-key"></i> Change password</a>
                </li>
                <li>
                    <a href="<?= APP::Module('Routing')->root ?>users/logout"><i class="zmdi zmdi-time-restore"></i> Logout</a>
                </li>
            </ul>
        </li>
        <? } else { ?>
            
             <li class="dropdown hm-profile">
            <a data-toggle="dropdown" href="">
               <img src="<?= APP::Module('Routing')->root . 'public/ui/img/profile-pics/default.png'?>">
            </a>

            <ul class="dropdown-menu pull-right dm-icon">
                
                <li>
                    <a href="<?= APP::Module('Routing')->root ?>users/actions/login?return=<?= APP::Module('Crypt')->SafeB64Encode(APP::Module('Routing')->root)?>"><i class="zmdi zmdi-time-restore"></i> Login</a>
                </li>
                <li>
                    <a href="<?= APP::Module('Routing')->root ?>users/actions/register?return=<?= APP::Module('Crypt')->SafeB64Encode(APP::Module('Routing')->root)?>"><i class="zmdi zmdi-time-restore"></i> Registration</a>
                </li>
            </ul>
        </li>
            
     <?   } ?>
        
    </ul>

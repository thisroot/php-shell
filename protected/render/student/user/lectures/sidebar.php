<?
$system = APP::Module('Admin')->System();
$modules = [];
        
?>


<aside id="s-main-menu" class="sidebar">
   
    <!--Start Page menu buttons-->
    
    <? if($data['page'] == 'lecture_edit') {?>
    <ul class="round-button-container">
        <li>
            <button id="add-block" class="btn btn-default  btn-icon-text waves-effect"><i class="zmdi zmdi-collection-plus"></i>Create block</button>
        </li>
    </ul>
    <? } 
    elseif ($data['page'] == 'lecture_view') {
        $user_info = APP::Module('Student')->GetLecture('owner', APP::Module('Routing')->get['hash']);
        
        
        
        ?>
    <ul class="round-button-container">
            <li>
                <div class="media" href="">
                    <div class="pull-left">
                        <? if($user_info['img_crop'] != NULL) { ?>
                        <img src="<?= $user_info['img_crop'] ?>" alt="" class="avatar-img"> <? } else { ?>
                        <img src="<?= APP::$conf['location'][0] ?>://www.gravatar.com/avatar/<?= md5(APP::Module('Users')->user['email']) ?>?s=40&d=<?= urlencode(APP::Module('Routing')->root . 'public/ui/img/profile-pics/default.png') ?>&t=<?= time() ?>" alt="" class="avatar-img">
                        <? } ?>
                    </div>
                    <div class="media-body">
                        <div class="lgi-heading name"><?= $user_info['first_name'].' '.$user_info['last_name'] ?></div>
                        <small class="lgi-text about"><?= $user_info['about'] ?></small>
                    </div>
                </div>
            </li>
        </ul>
   <? }?>
    
    <!--End Page menu buttons-->
    
     <ul class="main-menu">
        
        <!-- Role Default -->
          <? if(APP::Module('Users')->user['role'] == 'default') { ?>
        
                <li>
                   <a href="<?= APP::Module('Routing')->root ?>"><i class="zmdi zmdi-home"></i>Home</a>
               </li>
                <li>
                   <a href="<?= APP::Module('Routing')->root ?>students/lectures/find"><i class="zmdi zmdi-file-text"></i>Lectures</a>
               </li>
                <li>
                    <a href=""><i class="zmdi zmdi-library"></i>Exams</a>
               </li>
        
         <!-- Role User -->
          <? } elseif(APP::Module('Users')->user['role'] !== 'default') { ?>
        
          <li>
            <a href="<?= APP::Module('Routing')->root ?>"><i class="zmdi zmdi-home"></i>Home</a>
        </li>
        <li class="sub-menu">
            <a href="" data-ma-action="submenu-toggle"><i class="zmdi zmdi-file-text"></i>Lectures</a>
            <ul>
                <li><a href="<?= APP::Module('Routing')->root ?>students/lectures/find">Search</a></li>
                <li><a href="<?= APP::Module('Routing')->root ?>students/user/lectures/list">My lectures</a></li>
                <li><a href="<?= APP::Module('Routing')->root ?>students/user/lectures/add">Create</a></li>
            </ul>
        </li>
        
        <li class="sub-menu">
            <a href="" data-ma-action="submenu-toggle"><i class="zmdi zmdi-library"></i>Exams</a>
            <ul>
                <li><a href="#">Search</a></li>
                <li><a href="#" class="not-active">My exams</a></li>
                <li><a href="#">Create</a></li>
            </ul>
        </li>
        
       <li>
           <a href="<?= APP::Module('Routing')->root ?>students/user/settings"><i class="zmdi zmdi-settings"></i>Settings</a>
        </li>
         
          <? } ?>
        
       
       
    </ul>
</aside>
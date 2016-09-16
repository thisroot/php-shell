<?
$system = APP::Module('Admin')->System();
$modules = [];
?>


<aside id="s-main-menu" class="sidebar">
    
    <ul class="main-menu">
        
        <li>
            <a href="<?= APP::Module('Routing')->root ?>"><i class="zmdi zmdi-home"></i>Home</a>
        </li>
        <li class="sub-menu">
            <a href="" data-ma-action="submenu-toggle"><i class="zmdi zmdi-file-text"></i>Lectures</a>
            <ul>
                <li><a href="<?= APP::Module('Routing')->root ?>students/lectures/find">Search</a></li>
                <? if(APP::Module('Users')->user['role'] != 'default') { ?>
                <li><a href="<?= APP::Module('Routing')->root ?>students/user/lectures/list">My lectures</a></li>
                <li><a href="<?= APP::Module('Routing')->root ?>students/user/lectures/add">Create</a></li>
                <? } ?>
            </ul>
        </li>
        
        <li class="sub-menu">
            <a href="" data-ma-action="submenu-toggle"><i class="zmdi zmdi-library"></i>Exams</a>
            <ul>
                <li><a href="#">Search</a></li>
                 <? if(APP::Module('Users')->user['role'] != 'default') { ?>
                <li><a href="#" class="not-active">My exams</a></li>
                <li><a href="#">Create</a></li>
                <? } ?>
            </ul>
        </li>
         <? if(APP::Module('Users')->user['role'] != 'default') { ?>
       <li>
           <a href="<?= APP::Module('Routing')->root ?>students/user/settings"><i class="zmdi zmdi-settings"></i>Settings</a>
        </li>
        <? } ?>
    </ul>
</aside>
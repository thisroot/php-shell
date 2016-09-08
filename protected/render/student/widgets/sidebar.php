<?
$system = APP::Module('Admin')->System();
$modules = [];
?>


<aside id="s-main-menu" class="sidebar">
    <div class="smm-header">
        <i class="zmdi zmdi-long-arrow-left" data-ma-action="sidebar-close"></i>
    </div>

    

    <ul class="main-menu">

        <li>
            <a href="<?= APP::Module('Routing')->root ?>"><i class="zmdi zmdi-home"></i>Home</a>
        </li>
        <li class="sub-menu">
            <a href="" data-ma-action="submenu-toggle"><i class="zmdi zmdi-file-text"></i>Lectures</a>
            <ul>
                <li><a href="#">Read</a></li>
                <li><a href="<?= APP::Module('Routing')->root ?>students/lectures/manage">Manage</a></li>
                <li><a href="<?= APP::Module('Routing')->root ?>students/lectures/add">Create</a></li>
            </ul>
        </li>
        
        <li class="sub-menu">
            <a href="" data-ma-action="submenu-toggle"><i class="zmdi zmdi-library"></i>Exams</a>
            <ul>
                <li><a href="#">Learn</a></li>
                <li><a href="#">Create</a></li>
            </ul>
        </li>

    </ul>
</aside>


<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= route('index.php')?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">IT BLOG <sup>20</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="<?= route('index.php')?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Categories -->
    <li class="nav-item">
        <a class="nav-link" href="<?= route('categories/lists.php')?>">
            <i class="fas fa-fw fa-solid fa-layer-group"></i>
            <span>Categories</span></a>
    </li>

    <!-- Nav Item - Posts -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePosts"
            aria-expanded="true" aria-controls="collapseStudents">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Posts</span>
        </a>
        <div id="collapsePosts" class="collapse" aria-labelledby="headingStudents"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Students:</h6>
                <a class="collapse-item" href="<?= route('posts/lists.php')?>">Lists</a>
                <a class="collapse-item" href="<?= route('#')?>">Register</a>               
                <a class="collapse-item" href="<?= route('#')?>">Lists</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Assignments
    </div>

    <!-- Nav Item - Students Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStudents"
            aria-expanded="true" aria-controls="collapseStudents">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Students</span>
        </a>
        <div id="collapseStudents" class="collapse" aria-labelledby="headingStudents"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Students:</h6>
                <a class="collapse-item" href="<?= route('students/dashboard.php')?>">Dashboard</a>
                <a class="collapse-item" href="<?= route('students/register.php')?>">Register</a>               
                <a class="collapse-item" href="<?= route('students/lists.php')?>">Lists</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - ToDo Lists -->
    <li class="nav-item">
        <a class="nav-link" href="<?= route('todo.php')?>">
            <i class="fas fa-fw fa-solid fa-newspaper"></i>
            <span>To Do Lists</span></a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
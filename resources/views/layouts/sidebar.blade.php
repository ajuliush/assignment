<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('user.index')   ? '' : 'collapsed' }}" href="{{ route('user.index') }}">
                <i class="bi bi-box"></i>
                <span>User</span>
            </a>
        </li><!-- End Product Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('product-fetch') ||request()->routeIs('product-create')  ? '' : 'collapsed' }}" href="{{ route('product-fetch') }}">
                <i class="bi bi-person-badge"></i>
                <span>Product</span>
            </a>
        </li><!-- End Role Nav -->
    </ul>


</aside><!-- End Sidebar -->

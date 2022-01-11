
<div class="sl-logo"><a href="{{ route('admin.dashboard') }}"><i class="icon ion-android-star-outline"></i> SHopmama</a></div>
<div class="sl-sideleft">

    <div class="sl-sideleft-menu">
        <a href="{{ route('admin.dashboard') }}" class="sl-menu-link @yield('dashboard')">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
                <span class="menu-item-label">Dashboard</span>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <a href="{{ route('brand.view') }}" class="sl-menu-link @yield('brand')">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-navigate-outline tx-22"></i>
                <span class="menu-item-label">Brand</span>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->

        <a href="#" class="sl-menu-link @yield('category-info')">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-navigate-outline tx-24"></i>
                <span class="menu-item-label">Category Info</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('category.view') }}" class="nav-link @yield('category')">Category</a></li>
            <li class="nav-item"><a href="map-vector.html" class="nav-link">Vector Maps</a></li>
        </ul>

    </div><!-- sl-sideleft-menu -->

    <br>
</div><!-- sl-sideleft -->

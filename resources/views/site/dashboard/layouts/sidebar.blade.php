<div class="dashboard_tab_button">
    <ul role="tablist" class="nav flex-column dashboard-list">
        <li><a href="{{route('dashboard.index')}}" class="nav-link">پروفایل کاربری</a></li>
        @if (auth()->user()->hasRole('seller'))
            <li><a href="{{route('dashboard.profile.business')}}" class="nav-link">پروفایل کسب و کار</a></li>
            <li> <a href="{{route('dashboard.products.index')}}" class="nav-link">محصولات</a></li>
            <li> <a href="{{route('dashboard.services.index')}}" class="nav-link">خدمات</a></li>
        @endif
        <li><a wire:click="logout" href="#" class="nav-link">خروج</a></li>
    </ul>
</div>

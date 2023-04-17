<div class="landing_menu clearfix">
    <div class="menu_cell m01">
        <a href="{{ route('personal') }}" title="Thông tin cá nhân">
            <span class="zid_subnav_icon"></span>
            Thông tin cá nhân
        </a>
    </div>
    <div class="menu_cell m02">
        <a href="{{ route('general') }}" title="Thông tin cá nhân">
            <span class="zid_subnav_icon"></span>
            Thông tin đăng nhập
        </a>
    </div>
    <div class="menu_cell m05">
        <a href="{{ route('pass-update') }}" title="Đổi mật khẩu">
            <span class="zid_subnav_icon"></span>
            Mật khẩu
        </a>
    </div>
    <div class="menu_cell m04">
        <a href="{{ route('twofa') }}" title="Xác thực 2 bước">
            <span class="zid_subnav_icon"></span>
            Xác thực 2 bước
        </a>
    </div>
    <div class="menu_cell m07">
        <a href="{{ route('twofa.device') }}" title="Quản lý thiết bị">
            <span class="zid_subnav_icon"></span>
            Quản lý thiết bị
        </a>
    </div>
    <div class="menu_cell m06">
        <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="Quản lý thiết bị">
            <span class="zid_subnav_icon"></span>
            Thoát
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">{{ csrf_field() }}</form>
    </div>
</div>
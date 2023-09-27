<li class="nav-item">
    <a href="{{ url('/home') }}" class="nav-link {{ Request::is('/home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-qrcode"></i>
        <p>QRスキャン</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('visitors.index') }}" class="nav-link {{ Request::is('visitors') ? 'active' : '' }}">
        <i class="nav-icon fas fa-bars"></i>
        <p>入場者ログ</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('visitors_sum') }}" class="nav-link {{ Request::is('visitors_sum*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-th-list"></i>
        <p>ブース集計</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ url('export') }}" class="nav-link {{ Request::is('export') ? 'active' : '' }}">
        <i class="nav-icon fas fa-file-export"></i>
        <p>エクセル出力</p>
    </a>
</li>

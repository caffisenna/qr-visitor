
<li class="nav-item">
    <a href="{{ route('visitors.index') }}" class="nav-link {{ Request::is('visitors') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>入場者</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ url('visitors_sum') }}" class="nav-link {{ Request::is('visitors_sum*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>集計</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ url('export') }}" class="nav-link {{ Request::is('export') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>エクセル出力</p>
    </a>
</li>

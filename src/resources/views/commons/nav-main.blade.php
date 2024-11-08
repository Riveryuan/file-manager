<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{url('fm/file-list/')}}" class="brand-link">
        <img src="{{$assets_path}}/images/riveryuan_500.jpg" alt="Riveryuan Logo" class="brand-image  elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Riveryuan</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{url('fm/file-list/')}}" class="nav-link @if($menu_tag=='m-file-list') active @endif">
                        <i class="nav-icon fas fa-list"></i>
                        <p>文件列表<span class="right badge badge-danger">New</span></p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

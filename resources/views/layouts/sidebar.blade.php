<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <!-- User Info -->
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="{{ asset(Auth::user()->avatar) }}" alt="User Image" class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            {{ Auth::user()->nama }}
                            <span class="user-level">{{ Auth::user()->role == 'admin' ? 'Administrator' : 'Penulis' }}</span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>
                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="{{ route('user.index') }}">
                                    <span class="link-collapse">My Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.edit', Auth::user()->id) }}">
                                    <span class="link-collapse">Edit Profile</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Navigation Menu -->
            <ul class="nav nav-primary">
                <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
                    <a href="/dashboard" aria-expanded="false">
                         <i class="fas fa-home fa-bounce"></i>
                        <p>Dashboard</p>
                        <span class="caret"></span>
                    </a>
                </li>

                <li class="nav-section ">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Menu</h4>
                </li>

                <li class="nav-item {{ Request::is('kategoris') ? 'active' : '' }}">
                    <a href="{{ route('kategoris.index') }}">
                      <i class="fas fa-list fa-shake"></i>
                        <p>Kategori</p>
                        <span class="caret"></span>
                    </a>
                </li>

                <li class="nav-item {{ Request::is('artikel') ? 'active' : '' }}">
                    <a href="{{ route('artikel.index') }}">
                        <i class="fas fa-newspaper fa-beat"></i>
                        <p>Artikel</p>
                        <span class="caret"></span>
                    </a>
                </li>

                <li class="nav-item {{ Request::is('tag') ? 'active' : '' }}">
                    <a href="{{ route('tag.index') }}">
                        <i class="fas fa-tags fa-bounce"></i>
                        <p>Tag</p>
                        <span class="caret"></span>
                    </a>
                </li>

                <li class="nav-item {{ Request::is('komentar') ? 'active' : '' }}">
                    <a href="{{ route('komentar.index') }}">
                        <i class="fas fa-comments fa-bounce"></i>
                        <p>Komentar</p>
                        <span class="caret"></span>
                    </a>
                </li>

                <li class="nav-item {{ Request::is('playlist') ? 'active' : '' }}">
                    <a href="{{ route('playlist.index') }}">
                        <i class="fas fa-play-circle fa-beat"></i>
                        <p>Playlist Video</p>
                        <span class="caret"></span>
                    </a>
                </li>

                <li class="nav-item {{ Request::is('materi') ? 'active' : '' }}">
                    <a href="{{ route('materi.index') }}">
                        <i class="fas fa-beat fa-video"></i>
                        <p>Materi</p>
                        <span class="caret"></span>
                    </a>
                </li>

                @can('admin')
                <li class="nav-item {{ Request::is('slide') ? 'active' : '' }}">
                    <a href="{{ route('slide.index') }}">
                        <i class="fas fa-flip fa-image"></i>
                        <p>Slide</p>
                        <span class="caret"></span>
                    </a>
                </li>
                    
                <li class="nav-item {{ Request::is('iklan') ? 'active' : '' }}">
                    <a href="{{ route('iklan.index') }}">
                        <i class="fas fa-shake fa-bell"></i>
                        <p>Iklan</p>
                        <span class="caret"></span>
                    </a>
                </li>
                    
                                    <li class="nav-item {{ Request::is('manajemen') ? 'active' : '' }}">
                                        <a href="{{ route('manajemen.index') }}">
                                            <i class="fas fa-flip fa-users"></i>
                                            <p>Manajemen Akun</p>
                                            <span class="caret"></span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{ Request::is('settings') ? 'active' : '' }}">
                                        <a href="{{ route('settings.edit') }}">
                                            <i class="fas fa-flip fa-gear"></i>
                                            <p>Settings</p>
                                            <span class="caret"></span>
                                        </a>
                                    </li>
                @endcan
            </ul>
        </div>
    </div>
</div>

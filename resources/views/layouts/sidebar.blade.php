<div class="site-menubar">
    <div class="site-menubar-body">
        <div>
            <div>
                <ul class="site-menu" data-plugin="menu">
                    <li class="site-menu-category">General</li>
                    @if (auth()->user()->role == 'pengelola_wisata' && auth()->user()->wisata->status != 'terima')
                    <li class="site-menu-item active">
                        <a class="animsition-link" href="{{route('wisata.pengajuan')}}">
                            <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
                            <span class="site-menu-title">Pengajuan Wisata</span>
                        </a>
                    </li>
                    @elseif(auth()->user()->role == 'pengelola_wisata' && auth()->user()->wisata->status == 'terima')
                    <li class="site-menu-item active">
                      <a class="animsition-link" href="{{route('wisata.kelola')}}">
                          <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
                          <span class="site-menu-title">Kelola Wisata</span>
                      </a>
                  </li>
                    @endif
                    @if (auth()->user()->role == 'admin')
                    <li class="site-menu-item active">
                      <a class="animsition-link" href="{{route('wisata.data')}}">
                          <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
                          <span class="site-menu-title">Data Pengajuan</span>
                      </a>
                  </li>
                  <li class="site-menu-item has-sub">
                      <a href="javascript:void(0)">
                          <i class="site-menu-icon md-google-pages" aria-hidden="true"></i>
                          <span class="site-menu-title">Managemen Pengguna</span>
                          <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li class="site-menu-item">
                                <a class="animsition-link" href="{{route('user.all','wisatawan')}}">
                                    <span class="site-menu-title">Wisatawan</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="{{route('user.all','pengelola_wisata')}}">
                                    <span class="site-menu-title">Pengelola Wisata</span>
                                </a>
                            </li>
                            
                        </ul>
                    </li>
                    @endif
                    @if (auth()->user()->role == 'wisatawan')
                    <li class="site-menu-item active">
                      <a class="animsition-link" href="{{route('etalase.index')}}">
                          <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
                          <span class="site-menu-title">Tempat Wisata</span>
                      </a>
                    </li>
                  @endif
                  <li class="site-menu-item active">
                    <a class="animsition-link" href="{{route('transaksi.riwayat')}}">
                        <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
                        <span class="site-menu-title">Riwayat Transaksi</span>
                    </a>
                </li>
                </ul>
                <div class="site-menubar-section">
                    <h5>
                        Milestone
                        <span class="float-right">30%</span>
                    </h5>
                    <div class="progress progress-xs">
                        <div class="progress-bar active" style="width: 30%;" role="progressbar"></div>
                    </div>
                    <h5>
                        Release
                        <span class="float-right">60%</span>
                    </h5>
                    <div class="progress progress-xs">
                        <div class="progress-bar progress-bar-warning" style="width: 60%;" role="progressbar"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
			<nav class="navbar navbar-header navbar-expand-lg bg-success" data-background-color="blue2">

				<div class="container-fluid">
					<div class="collapse" id="search-nav">
						<form class="navbar-left navbar-form nav-search mr-md-3">
							<div class="input-group">
						
								
								<select id="select2-search" class="form-control"><i class="fa fa-search search-icon"></i></select>
							</div>
						</form>
					</div>
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item toggle-nav-search hidden-caret">
							<a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
								<i class="fa fa-search"></i>
							</a>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-envelope"></i>
							</a>
							<ul class="dropdown-menu messages-notif-box animated fadeIn p-3" style="width: 350px;" aria-labelledby="messageDropdown">
							@can('admin')
								<li>
									<div class="dropdown-title d-flex justify-content-between align-items-center mb-2">
										<span>Kirim Pesan ke Penulis</span>
									</div>
								</li>
									
								
								<li>
									<form action="{{ route('pesan.kirim') }}" method="POST" class="border p-4 rounded shadow-sm bg-white">
											@csrf

											<h5 class="mb-3 text-primary fw-bold">Kirim Pesan ke Semua Penulis</h5>

											<div class="mb-3">
												<label for="subject" class="form-label">Judul Pesan</label>
												<input type="text" name="nama" id="subject" class="form-control" placeholder="Contoh: Pemberitahuan Penting" required>
											</div>

											<div class="mb-3">
												<label for="isi_pesan" class="form-label">Isi Pesan</label>
												<textarea name="isi" id="isi_pesan" class="form-control" placeholder="Tulis isi pesan untuk para penulis..." rows="5" required></textarea>
											</div>

											<button type="submit" class="btn btn-primary w-100">
												<i class="bi bi-send me-1"></i> Kirim Pesan
											</button>
										</form>


								</li>
								@endcan
								<li class="mt-3">
									<a class="see-all text-center d-block small text-muted" href="{{ route('pesan.index') }}">
										Lihat Semua Pesan <i class="fa fa-angle-right ms-1"></i>
									</a>
								</li>
							</ul>

						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link dropdown-toggle" href="/" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-bell"></i>
								@if(auth()->user()->unreadNotifications)
								<span class="notification">{{ auth()->user()->unreadNotifications->count() }}</span>
								@endif
							</a>
							<ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
								<li>
									 
										
									
								</li>
								<li>
									<div class="notif-scroll scrollbar-outer">
									<div class="notif-center">
										@forelse(auth()->user()->unreadNotifications as $notif)
											<a href="{{ route('notification.baca', $notif->id) }}">
												<div class="notif-icon notif-success">
													<i class="fa fa-comment"></i>
												</div>
												<div class="notif-content">
													<span class="block">
														{{ $notif->data['nama'] }} mengomentari artikel
													</span>
													<span class="time">{{ \Carbon\Carbon::parse($notif->data['waktu'])->diffForHumans() }}</span>
												</div>
											</a>
										@empty
											<a href="#">
												<div class="notif-icon notif-primary">
													<i class="fa fa-info-circle"></i>
												</div>
												<div class="notif-content">
													<span class="block">Belum ada notifikasi baru</span>
												</div>
											</a>
										@endforelse
									</div>
								</div>

								</li>
								<li>
									<a class="see-all" href="javascript:void(0);">See all notifications<i class="fa fa-angle-right"></i> </a>
								</li>
							</ul>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
								<i class="fas fa-layer-group"></i>
							</a>
							<div class="dropdown-menu quick-actions quick-actions-info animated fadeIn">
								<div class="quick-actions-header">
									<span class="title mb-1">Quick Actions</span>
									<span class="subtitle op-8">Shortcuts</span>
								</div>
								<div class="quick-actions-scroll scrollbar-outer">
									<div class="quick-actions-items">
										<div class="row m-0">
											<a class="col-6 col-md-4 p-0" href="/artikel/create">
												<div class="quick-actions-item">
													<i class="flaticon-file-1"></i>
													<span class="text">Buat Artikel</span>
												</div>
											</a>
											<a class="col-6 col-md-4 p-0" href="/kategoris/create">
												<div class="quick-actions-item">
													<i class="flaticon-database"></i>
													<span class="text">Tambah Kategori</span>
												</div>
											</a>
											<a class="col-6 col-md-4 p-0" href="/tag/create">
												<div class="quick-actions-item">
													<i class="flaticon-pen"></i>
													<span class="text">Tambah Tag</span>
												</div>
											</a>
											<a class="col-6 col-md-4 p-0" href="/materi/create">
												<div class="quick-actions-item">
													<i class="flaticon-interface-1"></i>
													<span class="text">Tambah Video</span>
												</div>
											</a>
											<a class="col-6 col-md-4 p-0" href="/playlist/create">
												<div class="quick-actions-item">
													<i class="flaticon-list"></i>
													<span class="text">Tambah Playlist</span>
												</div>
											</a>
											<a class="col-6 col-md-4 p-0" href="/pesan">
												<div class="quick-actions-item">
													<i class="flaticon-file"></i>
													<span class="text">Pesan Masuk</span>
												</div>
											</a>
										</div>
									</div>
								</div>
							</div>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									<img src="{{ asset(Auth::user()->avatar) }}" alt="..." class="avatar-img rounded-circle">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									<li>
										<div class="user-box">
											<div class="avatar-lg"><img src="{{ asset(Auth::user()->avatar) }}" alt="image profile" class="avatar-img rounded"></div>
											<div class="u-text">
												<h4>{{ Auth::user()->nama }}</h4>
												<p class="text-muted">{{ Auth::user()->email }}</p><a href="/user" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
											</div>
										</div>
									</li>
									<li>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="/user">My Profile</a>
										<a class="dropdown-item" href="/user/{{ Auth::user()->id }}/edit">Edit Profile</a>
										<div class="dropdown-divider"></div>
										<form method="POST" action="{{ route('logout') }}">
											@csrf
											<button type="submit" class="btn btn-danger btn-block text-left">
												<i class="fas fa-sign-out-alt fa-shake"></i> Logout
											</button>
										</form>
										
									</li>
								</div>
							</ul>
						</li>
					</ul>
				</div>
			</nav>

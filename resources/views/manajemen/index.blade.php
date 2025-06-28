
@extends('layouts.default')

@section('content')
      <div class="panel-header bg-primary-gradient">
					<div class="page-inner py-5">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
						</div>
					</div>
				</div>
			<div class="page-inner mt--5">
	            <div class="row">
						<div class="col-sm-12">
							<div class="card full-height">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h4 class="card-title">Data Users/Author</h4>
										<a class="btn btn-primary btn-round ml-auto" href="{{ route('manajemen.create') }}">
											<i class="fa fa-plus"></i>
											Add User/Author
										</a>
									</div>
  								<div class="card-body">
									<!-- Modal -->
									<div class="table-responsive">
										<table id="add-row" class="display table table-striped table-hover table-bordered" >
											<thead>
                                                @if (session()->has('success'))
                                                    <div class="alert alert-success">
                                                        {{ session('success') }}
                                                    </div>
                                                @endif
                                                @if (session()->has('danger'))

                                                    <div class="alert alert-danger">
                                                        {{ session('danger') }}
                                                    </div>

                                                @endif
												<tr class="text-center">

                                                    <th>No</th>
													<th>Nama</th>
													<th>Username</th>
													<th>Email</th>
													<th>No Hp</th>
													<th>Tanggal Lahir</th>
													<th>Role</th>
                                                    <th>Foto</th>
													<th style="width: 10%">Action</th>
												</tr>
											</thead>
											<tbody>

                                                @forelse  ($user as $ply)
												<tr>
                                                    <td>{{ $loop->iteration }}</td>
													<td>{{ $ply->nama }}</td>
													<td>{{ $ply->username }}</td>
													<td>{{ $ply->email }}</td>
													<td>{{ $ply->no_hp }}</td>
													<td>{{ \Carbon\Carbon::parse($ply->tanggal_lahir)->translatedFormat('d-F-Y') }}</td>
													<td><span class="badge {{ $ply->role == "admin" ? "bg-success" : "bg-primary" }} text-white">{{ $ply->role == 'admin' ? 'Admin' : 'Penulis' }}</span></td>
                                                    <td class="text-center "><img src="{{ asset('storage/' . $ply->avatar) }}" alt="" class="rounded-circle" width="50"></td>
													<td>
														<div class="form-button-action">
                                                            <a type="button" href="{{ route('manajemen.show', $ply->id) }}"  title="show" class="btn btn-link btn-primary" >
                                                                 <i class="fa fa-eye"></i>
                                                            <a type="button" href="{{ route('manajemen.edit', $ply->id) }}"  title="edit" class="btn btn-link btn-primary" >
                                                                     <i class="fa fa-edit"></i>
                                                            </a>
															 @method('DELETE')
                                                              <form action="{{ route('manajemen.destroy', $ply->id) }}" method="POST" style="display:inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-link btn-danger btn-lg" onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                                                        <i class="fa fa-times"></i>
                                                                    </button>
                                                                </form>
                                                            </a>
														</div>
													</td>
                                                    @empty
													<td colspan="8" class="text-center" >Belum Ada Data Slide</td>

                                                @endforelse

												</tr>

											</tbody>
										</table>
									</div>
								</div>
                                </div>
                            </div>
                     </div>
                </div>
            </div>

@endsection

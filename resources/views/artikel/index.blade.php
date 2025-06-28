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
										<h4 class="card-title">Data Artikel</h4>
										<a class="btn btn-primary btn-round ml-auto" href="{{ route('artikel.create') }}">
											<i class="fa fa-plus"></i>
											Add Artikel
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
												<tr>

                                                    <th>No</th>
													<th>Judul</th>
													<th>slug</th>
													<th>Kategori</th>
													<th>Author</th>
													<th>Status</th>
                                                    <th>Gambar</th>
													<th style="width: 10%">Action</th>
												</tr>
											</thead>
											<tbody>

                                                @forelse  ($artikel as $art)
												<tr>
                                                    <td>{{ $loop->iteration }}</td>
													<td>{{ $art->judul }}</td>
													<td>{{ $art->slug }}</td>
													<td>{{ $art->kategori->nama_kategori }}</td>
													<td>{{ $art->users->nama }}</td>
													<td><span class="badge {{ $art->is_actived == 1 ? "bg-success" : "bg-primary" }} text-white">{{ $art->is_actived == 1 ? 'Published' : 'Draft' }}</span></td>
                                                    <td><img src="{{ asset($art->gambar_artikel) }}" alt="" width="90"></td>
													<td>
														<div class="form-button-action">
                                                            <a type="button" href="{{ route('artikel.edit', $art->id) }}"  title="edit" class="btn btn-link btn-primary" >
                                                                     <i class="fa fa-edit"></i>
                                                            </a>
															 @method('DELETE')
                                                              <form action="{{ route('artikel.destroy', $art->id) }}" method="POST" style="display:inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-link btn-danger btn-lg" onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                                                        <i class="fa fa-times"></i>
                                                                    </button>
                                                                </form>
														</div>
													</td>
                                                    @empty
													<td >Belum Ada Data Kategori</td>

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

@extends('layouts.default')

@section('content')

                <div class="panel-header bg-primary-gradient">
					<div class="page-inner py-5">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white pb-2 fw-bold">Data Kategori</h2>
								<h5 class="text-white op-7 mb-2">Manajemen Kategori Silahkan Tambahkan Kategori Sesuai Kebutuhan</h5>
							</div>

						</div>
					</div>
				</div>
	            <div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h4 class="card-title">Data Kategori</h4>
										<a class="btn btn-primary btn-round ml-auto" href="{{ route('kategoris.create') }}">
											<i class="fa fa-plus"></i>
											Add Kategori
										</a>
									</div>
								</div>
								<div class="card-body">
									<!-- Modal -->
									<div class="table-responsive">
										<table id="add-row" class="display table table-striped table-hover" >
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
													<th>Name Kategori</th>
													<th>slug</th>
													<th style="width: 10%">Action</th>
												</tr>
											</thead>
											<tbody>

                                                @forelse  ($kategori as $ktg)
												<tr>
                                                    <td>{{ $loop->iteration }}</td>
													<td>{{ $ktg->nama_kategori }}</td>
													<td>{{ $ktg->slug }}</td>
													<td>
														<div class="form-button-action">
                                                            <a type="button" href="{{ route('kategoris.edit', $ktg->id) }}"  title="edit" class="btn btn-link btn-primary" >
                                                                     <i class="fa fa-edit"></i>
                                                            </a>
															 @method('DELETE')
                                                              <form action="{{ route('kategoris.destroy', $ktg->id) }}" method="POST" style="display:inline;">
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
		</div>
	</div>




@endsection

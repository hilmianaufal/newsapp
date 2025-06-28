
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
										<h4 class="card-title">Data Iklan</h4>
										<a class="btn btn-primary btn-round ml-auto" href="{{ route('iklan.create') }}">
											<i class="fa fa-plus"></i>
											Add Iklan
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
													<th>Judul Iklan</th>
													<th>URL</th>
													<th>Status</th>
                                                    <th>Gambar</th>
													<th style="width: 10%">Action</th>
												</tr>
											</thead>
											<tbody>

                                                @forelse  ($iklan as $ply)
												<tr>
                                                    <td>{{ $loop->iteration }}</td>
													<td>{{ $ply->judul_iklan }}</td>
													<td>{{ $ply->link }}</td>
                                                    <td class="text-center">
													 @if ($ply->status == 1)
                                                            <span class="badge bg-success text-white">Active</span>
                                                        @else
                                                            <span class="badge bg-warning text-white">Draft</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center "><img src="{{ asset('uploads/' . $ply->gambar_iklan) }}" alt="" width="90"></td>
													<td>
														<div class="form-button-action">
                                                            <a type="button" href="{{ route('iklan.edit', $ply->id) }}"  title="edit" class="btn btn-link btn-primary" >
                                                                     <i class="fa fa-edit"></i>
                                                            </a>
															 @method('DELETE')
                                                              <form action="{{ route('iklan.destroy', $ply->id) }}" method="POST" style="display:inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-link btn-danger btn-lg" onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                                                        <i class="fa fa-times"></i>
                                                                    </button>
                                                                </form>
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

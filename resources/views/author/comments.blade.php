@extends('layouts.backend.app')
@section('title', 'Comment')
@push('css')
<link href="{{ asset('assets/backend') }}/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
@endpush
@section('content')
<section class="content">
	<div class="container-fluid">
		<!-- Exportable Table -->
		<div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						<h2>
						All Comment
						</h2>
					</div>
					<div class="body">
						<div class="table-responsive">
							<table class="table table-bordered table-striped table-hover dataTable js-exportable">
								<thead>
									<tr>
										<th class="text-center">Comment Info</th>
										<th class="text-center">Post Info</th>
										<th class="text-center">Manage</th>
									</tr>
								</thead>
								<tbody>
									@foreach($posts as $post)
										@foreach($post->comments as $comment)
										<tr>
											<td>
												<div class="media">
													<div class="media-left">
														<a href="#">
															<img src="{{ Storage::disk('public')->url('profile/' . $comment->user->image) }}" alt="" class="media-object img-thumbnail" style="height: 90px; width: 130px;">
														</a>
													</div>
													<div class="media-body">
														<h4 class="media-heading">{{ $comment->user->name }} <small>{{ $comment->created_at->diffForHumans() }}</small></h4>
														<p>{{ $comment->comment }}</p>
														<a href="{{ route('post.details', $comment->post->slug) }}" target="blank">reply</a>
													</div>
												</div>
											</td>
											<td>
												<div class="media">
													<div class="media-right">
														<a href="{{ route('post.details', $comment->post->slug) }}">
															<img src="{{ Storage::disk('public')->url('post/' . $comment->post->image) }}" alt="" class="media-object img-thumbnail" style="height: 90px; width: 130px;">
														</a>
													</div>
													<div class="media-body">
														<h4 class="media-heading"> 
															<a target="blank" href="{{ route('post.details', $comment->post->slug) }}">
																{{ str_limit($comment->post->title, 15) }}
															</a>
															 <small>{{ $comment->post->created_at->diffForHumans() }}</small>
															</h4>
														<p>by <strong>{{ $comment->user->name }}</strong></p>
													</div>
												</div>
											</td>
											<td>
												



												<button onclick="deleteComment({{ $comment->id }})" type="button" class="btn btn-danger waves-effect"><i class="material-icons">delete</i></button>
												<form id="delete-form-{{ $comment->id }}" action="{{ route('author.comment.destroy', $comment->id) }}" method="post" style="display: none;">
													@csrf
													@method('delete')
												</form>
											</td>
										</tr>
										@endforeach
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- #END# Exportable Table -->
	</div>
</section>
@endsection
@push('js')
    <script src="{{ asset('assets/backend') }}/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="{{ asset('assets/backend') }}/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="{{ asset('assets/backend') }}/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="{{ asset('assets/backend') }}/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="{{ asset('assets/backend') }}/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="{{ asset('assets/backend') }}/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="{{ asset('assets/backend') }}/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="{{ asset('assets/backend') }}/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="{{ asset('assets/backend') }}/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
    <script src="{{ asset('assets/backend') }}/js/pages/tables/jquery-datatable.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.32.2/sweetalert2.all.js"></script>
	<script>
		function deleteComment(id){
			const swalWithBootstrapButtons = Swal.mixin({
			  confirmButtonClass: 'btn btn-success',
			  cancelButtonClass: 'btn btn-danger',
			  buttonsStyling: false,
			})

			swalWithBootstrapButtons({
			  title: 'Are you sure?',
			  text: "You won't be able to revert this!",
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonText: 'Yes, delete it!',
			  cancelButtonText: 'No, cancel!',
			  reverseButtons: true
			}).then((result) => {
			  if (result.value) {
			    event.preventDefault();
			    document.getElementById('delete-form-'+id).submit();
			  } else if (
			    // Read more about handling dismissals
			    result.dismiss === Swal.DismissReason.cancel
			  ) {
			    swalWithBootstrapButtons(
			      'Cancelled',
			      'Your imaginary file is safe :)',
			      'error'
			    )
			  }
			})
		};


	</script>
@endpush
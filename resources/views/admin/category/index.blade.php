@extends('layouts.backend.app')
@section('title', 'Category')
@push('css')
<link href="{{ asset('assets/backend') }}/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
@endpush
@section('content')
<section class="content">
	<div class="container-fluid">
		<div class="block-header">
			<a href="{{ route('admin.category.create') }}" class="btn btn-info waves-effect"><i class="material-icons">add</i><span>Add New Category</span></a>
		</div>
		<!-- Exportable Table -->
		<div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						<h2>
						Category Table
						<span class="badge bg-blue">{{ $categories->count() }}</span>
						</h2>
					</div>
					<div class="body">
						<div class="table-responsive">
							<table class="table table-bordered table-striped table-hover dataTable js-exportable">
								<thead>
									<tr>
										<th>Id</th>
										<th>Name</th>
										<th>Created At</th>
										<th>Updated At</th>
										<th>Manage</th>
									</tr>
								</thead>
								<tbody>
									@foreach($categories as $key => $category)
										<tr>
											<td>{{ $key + 1 }}</td>
											<td>{{ $category->name }}</td>
											<td>{{ $category->created_at }}</td>
											<td>{{ $category->updated_at }}</td>
											<td class="text-center">
												<a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-primary waves-effect"><i class="material-icons">edit</i></a>
												<button onclick="deleteCategory({{ $category->id }})" type="button" class="btn btn-danger waves-effect"><i class="material-icons">delete</i></button>
												<form id="data-form-{{ $category->id }}" action="{{ route('admin.category.destroy', $category->id) }}" method="post">
													@csrf
													@method('delete')
												</form>
											</td>
										</tr>
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
		function deleteCategory(id){
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
			    document.getElementById('data-form-'+id).submit();
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
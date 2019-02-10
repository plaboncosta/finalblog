@extends('layouts.backend.app')
@section('title', 'Social')
@push('css')
@endpush
@section('content')
@endsection
@push('js')
<section class="content">
	<div class="container-fluid">
		<div class="block-header">
			<h2>UPDATE SOCIAL ICON LINKS</h2>
		</div>
		<form action="{{ route('admin.social.update') }}" method="post">
			@csrf
			@method('put')
			<div class="row form-group">
				<div class="col col-md-6">
					<div class="input-group">
						<div class="input-group-btn"><button class="btn btn-primary"><i class="fab fa-facebook-f"></i>
						</button></div>
						<input type="text" id="input3-group2" name="facebook" value="{{ $social->facebook }}" style="padding-left: 10px;" class="form-control">
					</div>
				</div>
				<div class="col col-md-6">
					<div class="input-group">
						<div class="input-group-btn"><button class="btn btn-primary"><i class="fab fa-twitter"></i>
						</button></div>
						<input type="text" id="input3-group2" name="twitter" value="{{ $social->twitter }}" style="padding-left: 10px;" class="form-control">
					</div>
				</div>
				<div class="col col-md-6">
					<div class="input-group">
						<div class="input-group-btn"><button class="btn btn-primary"><i class="fab fa-instagram"></i>
						</button></div>
						<input type="text" id="input3-group2" name="instagram" value="{{ $social->instagram }}" style="padding-left: 10px;" class="form-control">
					</div>
				</div>
				<div class="col col-md-6">
					<div class="input-group">
						<div class="input-group-btn"><button class="btn btn-primary"><i class="fab fa-vimeo"></i>
						</button></div>
						<input type="text" id="input3-group2" name="vemio" value="{{ $social->vemio }}" style="padding-left: 10px;" class="form-control">
					</div>
				</div>
				<div class="col col-md-6">
					<div class="input-group">
						<div class="input-group-btn"><button class="btn btn-primary"><i class="fab fa-pinterest"></i>
						</button></div>
						<input type="text" id="input3-group2" name="pinterest" value="{{ $social->pinterest }}" style="padding-left: 10px;" class="form-control">
					</div>
				</div>
				<div class="col col-md-6">
					<button type="submit" class="btn btn-info waves-effect text-left"><i class="material-icons">done</i>Update</button>
				</div>
			</div>
		</form>
	</div>
</section>
@endpush
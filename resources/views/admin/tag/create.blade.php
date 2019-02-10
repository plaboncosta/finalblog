@extends('layouts.backend.app')
@section('title', 'Tag')
@push('css')

@endpush
@section('content')
<section class="content">
	<div class="container-fluid">
		<!-- Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ADD NEW TAG
                            </h2>
                        </div>
                        <div class="body">
                            <form action="{{ route('admin.tag.store') }}" method="post">
                            	@csrf
                                <label for="name">Tag Name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="name" id="name" class="form-control">
                                    </div>
                                </div>
                                <a href="{{ route('admin.tag.index') }}" class="btn btn-danger m-t-15 waves-effect">Back</a>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Vertical Layout -->
	</div>
</section>
@endsection
@push('js')

@endpush
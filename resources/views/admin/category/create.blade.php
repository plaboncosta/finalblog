@extends('layouts.backend.app')
@section('title', 'Category')
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
                                ADD NEW Category
                            </h2>
                        </div>
                        <div class="body">
                            <form action="{{ route('admin.category.store') }}" method="post" enctype="multipart/form-data">
                            	@csrf
                                <label for="name">Category Name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="name" id="name" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="image">Select Category Image</label>
                                    <input type="file" id="image" name="image" class="form-control">
                                </div>
                                <a href="{{ route('admin.category.index') }}" class="btn btn-danger m-t-15 waves-effect">Back</a>
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
@extends('layouts.backend.app')
@section('title', 'Post')
@push('css')
<link href="{{ asset('assets/backend') }}/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
@endpush
@section('content')
<section class="content">
    <div class="container-fluid">
        <form action="{{ route('admin.post.update', $post->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                            Edit Post
                            </h2>
                        </div>
                        <div class="body">
                            <label for="title">Post Title</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="title" id="title" class="form-control" value="{{ $post->title }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="image">Select Post Image</label>
                                <input type="file" id="image" name="image" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="checkbox" id="publish" name="status" class="filled-in" value="1" {{ $post->status == true ? 'checked' : '' }}>
                                <label for="publish">Publish</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                            Categories and Tags
                            </h2>
                        </div>
                        <div class="body">
                            <div class="form-group">
                                <div class="form-line {{ $errors->has('categories') ? 'focused error' : '' }}">
                                    <label for="categories">Select Categories</label>
                                    <select name="categories[]" id="categories" class="form-control show-tick" data-live-search="true" multiple>
                                        @foreach($categories as $category)
                                            <option
                                            @foreach($post->categories as $postcategory)
                                                {{ $postcategory->id == $category->id ? 'selected' : '' }}
                                            @endforeach
                                             value="{{ $category->id }}">{{ $category->name }}</option>
                                                }
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line {{ $errors->has('tags') ? 'focused error' : '' }}">
                                    <label for="tags">Tags</label>
                                    <select name="tags[]" id="tags" class="form-control show-tick" data-live-search="true" multiple>
                                        @foreach($tags as $tag)
                                            <option
                                                @foreach($post->tags as $posttag)
                                                    {{ $posttag->id == $tag->id ? 'selected' : ''}}
                                                @endforeach
                                             value="{{ $tag->id }}">{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <a href="{{ route('admin.post.index') }}" class="btn btn-danger m-t-15 waves-effect">Back</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Body
                            </h2>
                        </div>
                        <div class="body">
                            <textarea name="body" id="tinymce">{{ $post->body }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
@push('js')
 <script src="{{ asset('assets/backend') }}/plugins/bootstrap-select/js/bootstrap-select.js"></script>
  <script src="{{ asset('assets/backend') }}/plugins/tinymce/tinymce.js"></script>
  <script>
      $(function () {

    //TinyMCE
    tinymce.init({
        selector: "textarea#tinymce",
        theme: "modern",
        height: 300,
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons',
        image_advtab: true
    });
    tinymce.suffix = ".min";
    tinyMCE.baseURL = '{{ asset('assets/backend') }}/plugins/tinymce';
});
  </script>
@endpush
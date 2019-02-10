@extends('layouts.backend.app')
@section('title', 'Post')
@push('css')
<link href="{{ asset('assets/backend') }}/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
@endpush
@section('content')
<section class="content">
    <div class="container-fluid">
        <a href="{{ route('admin.post.index') }}" class="btn btn-danger">Back</a>
        @if($post->is_approved == false)
            <button type="button" class="btn btn-danger pull-right" onclick="approvePost()"><i class="material-icons">done</i><span>Approve</span></button>
            <form action="{{ route('admin.post.approve', $post->id) }}" method="post" id="approve-form" style="display: none;">
                @csrf
                @method('put')
            </form>
        @else
            <button type="button" class="btn btn-danger pull-right" disabled>Approved</button>
        @endif
        <br><br>
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                        {{ $post->title }}
                        <small>Posted by <strong><a href="#">{{ $post->user->name }}</a></strong> on {{ $post->created_at->toFormattedDateString() }} </small>
                        </h2>
                    </div>
                    <div class="body">
                        {!! $post->body !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header bg-cyan">
                        <h2>
                        Categories
                        </h2>
                    </div>
                    <div class="body">
                        @foreach($post->categories as $category)
                            <span class="label bg-cyan">{{ $category->name }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="card">
                    <div class="header bg-amber">
                        <h2>
                        Tags
                        </h2>
                    </div>
                    <div class="body">
                        @foreach($post->tags as $tag)
                            <span class="label bg-amber">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="card">
                    <div class="header bg-amber">
                        <h2>
                        Images
                        </h2>
                    </div>
                    <div class="body">
                        <img class="img-responsive thumbnail" src="{{ Storage::disk('public')->url('post/' . $post->image) }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('js')
<script src="{{ asset('assets/backend') }}/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<script src="{{ asset('assets/backend') }}/plugins/tinymce/tinymce.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.32.2/sweetalert2.all.js"></script>
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



    // Post Approve 
    function approvePost(){
            const swalWithBootstrapButtons = Swal.mixin({
              confirmButtonClass: 'btn btn-success',
              cancelButtonClass: 'btn btn-danger',
              buttonsStyling: false,
            })

            swalWithBootstrapButtons({
              title: 'Are you sure?',
              text: "You want to approve this post!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Yes, approve it!',
              cancelButtonText: 'No, cancel!',
              reverseButtons: true
            }).then((result) => {
              if (result.value) {
                event.preventDefault();
                document.getElementById('approve-form').submit();
              } else if (
                // Read more about handling dismissals
                result.dismiss === Swal.DismissReason.cancel
              ) {
                swalWithBootstrapButtons(
                  'Cancelled',
                  'Your imaginary file is safe :)',
                  'info'
                )
              }
            })
        };
</script>
@endpush
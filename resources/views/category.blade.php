@extends('layouts.frontend.app')
@section('title', 'Comment')
@push('css')
<link rel="stylesheet" href="{{ asset('assets/frontend/css/category/styles.css') }}">
<link rel="stylesheet" href="{{ asset('assets/frontend/css/category/responsive.css') }}">
<style>
        .favorite-posts{
            color: blue;
        }
        .slider{
            background-image: url({{ Storage::disk('public')->url('category/' . $category->image) }});
        }
    </style>
@endpush
@section('content')
<div class="slider display-table center-text">
		<h1 class="title display-table-cell"><b>{{ $category->name }}</b></h1>
	</div><!-- slider -->

	<section class="blog-area section">
		<div class="container">

			<div class="row">
                @if($posts->count() > 0)
				@foreach($posts as $post)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100">
                            <div class="single-post post-style-1">

                                <div class="blog-image"><a href="{{ route('post.details', $post->slug) }}"><img src="{{ Storage::disk('public')->url('post/'. $post->image) }}" alt="{{ $post->title }}"></a></div>

                                <a class="avatar" href="{{ route('author.profile', $post->user->username) }}"><img src="{{ Storage::disk('public')->url('profile/'. $post->user->image) }}" alt="{{ $post->title }}"></a>

                                <div class="blog-info">

                                    <h4 class="title"><a href="{{ route('post.details', $post->slug) }}"><b>{{ $post->title }}</b></a></h4>

                                    <ul class="post-footer">
                                        <li>
                                            @guest
                                                <a href="javascript:void();" onclick="toastr.info('To add favorite list you need to login first!', 'Info', {
                                                    'closeButton' : 'true',
                                                    'progressBar' : 'true',
                                                })"><i class="ion-heart"></i>{{ $post->favorite_to_users->count() }}</a>
                                            @else
                                                <a href="javascript:void();" onclick="document.getElementById('favorite-form-{{ $post->id }}').submit()" class="{{ !Auth::user()->favorite_posts()->where('post_id', $post->id)->count() == 0 ? 'favorite-posts' : '' }}"><i class="ion-heart"></i>{{ $post->favorite_to_users->count() }}</a>
                                                <form action="{{ route('favorite.post', $post->id) }}" method="post" style="display: none;" id="favorite-form-{{ $post->id }}">
                                                    @csrf
                                                </form>
                                            @endguest
                                        </li>
                                        <li><a href="#"><i class="ion-chatbubble"></i>{{ $post->comments->count() }}</a></li>
                                        <li><a href="#"><i class="ion-eye"></i>{{ $post->view_count }}</a></li>
                                    </ul>

                                </div><!-- blog-info -->
                            </div><!-- single-post -->
                        </div><!-- card -->
                    </div><!-- col-lg-4 col-md-6 -->
                @endforeach
                @else
                    <div class="col-lg-12 col-md-12">
                        <div class="card h-100">
                            <div class="single-post post-style-1">
                                <div class="title">
                                    <h3>No post found for this category!!</h3>
                                </div>
                            </div><!-- single-post -->
                        </div><!-- card -->
                    </div><!-- col-lg-4 col-md-6 -->
                @endif

			</div><!-- row -->

		</div><!-- container -->
	</section><!-- section -->


@endsection
@push('js')

@endpush
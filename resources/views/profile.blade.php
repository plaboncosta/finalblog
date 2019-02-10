@extends('layouts.frontend.app')
@section('title')
{{ $author->name }}
@endsection
@push('css')
<link href="{{ asset('assets/frontend/css/home') }}/styles.css" rel="stylesheet">
<link href="{{ asset('assets/frontend/css/home') }}/responsive.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/frontend/css/profile/styles.css') }}">
<link rel="stylesheet" href="{{ asset('assets/frontend/css/profile/responsive.css') }}">
<style>
     .favorite-posts{
      color: blue;
     }
</style>
@endpush
@section('content')
	<div class="slider display-table center-text">
		<h1 class="title display-table-cell"><b>{{ $author->name }}</b></h1>
	</div><!-- slider -->

	<section class="blog-area section">
		<div class="container">

			<div class="row">

				<div class="col-lg-8 col-md-12">
					<div class="row">
					@if($posts->count() > 0)
						@foreach($posts as $post)
                    		<div class="col-lg-6 col-md-6">
                        <div class="card h-100">
                            <div class="single-post post-style-1">
                                <div class="blog-image"><a href="{{ route('post.details', $post->slug) }}"><img src="{{ Storage::disk('public')->url('post/' . $post->image) }}" alt="{{ $post->title }}"></a></div>

                                <a class="avatar" href="{{ route('author.profile', $post->user->username) }}"><img src="{{ Storage::disk('public')->url('profile/' . $post->user->image) }}" alt="Profile Image"></a>

                                <div class="blog-info">

                                    <h4 class="title"><a href="{{ route('post.details', $post->slug) }}"><b>{{ $post->title }}</b></a></h4>

                                    <ul class="post-footer">
                                        <li>
                                            @guest
                                                <a href="javascript:void(0);" onclick="toastr.info('To add favorite list you need to login first!', 'Info', {
                                                    'closeButton' : 'true',
                                                    'progressBar' : 'true',
                                                })"><i class="ion-heart" ></i>{{ $post->favorite_to_users->count() }}</a>
                                            @else
                                                 <a href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{ $post->id }}').submit();" class="{{ !Auth::user()->favorite_posts->where('pivot.post_id', $post->id)->count() == 0 ? 'favorite-posts' : '' }}"><i class="ion-heart" ></i>{{ $post->favorite_to_users->count() }}</a>
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
                                    <h3>No post found for this Editor!!</h3>
                                </div>
                            </div><!-- single-post -->
                        </div><!-- card -->
                    </div><!-- col-lg-4 col-md-6 -->
                	@endif
					</div><!-- row --></a>

				</div><!-- col-lg-8 col-md-12 -->

				<div class="col-lg-4 col-md-12 ">

					<div class="single-post info-area ">

						<div class="about-area">
							<h4 class="title"><b>ABOUT EDITOR</b></h4>
							<p>{{ $author->name }}</p><br>
							<p>{{ $author->about }}</p><br>
							<strong>Since From : {{ $author->created_at->toDateString() }}</strong><br>
							<strong>Total Posts : {{ $author->posts()->approved()->published()->count() }}</strong>
						</div>

						</div><!-- subscribe-area -->

					</div><!-- info-area -->

				</div><!-- col-lg-4 col-md-12 -->

			</div><!-- row -->

		</div><!-- container -->
	</section><!-- section -->

@endsection
@push('js')

@endpush
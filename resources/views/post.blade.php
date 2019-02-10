@extends('layouts.frontend.app')
@section('title')
{{ $post->title }}
@endsection
@push('css')
 <link href="{{ asset('assets/frontend/css/details-page/styles.css') }}" rel="stylesheet">
 <link href="{{ asset('assets/frontend/css/details-page/responsive.css') }}" rel="stylesheet">
    <style>
        .favorite-posts{
            color: blue;
        }
        .slider{
        	background-image: url({{  Storage::disk('public')->url('post/') . $post->image }});
        }
    </style>
@endpush
@section('content')
<div class="slider">
		<div class="display-table  center-text">
			<h1 class="title display-table-cell"><b>{{ $post->title }}</b></h1>
		</div>
	</div><!-- slider -->

	<section class="post-area section">
		<div class="container">

			<div class="row">

				<div class="col-lg-8 col-md-12 no-right-padding">

					<div class="main-post">

						<div class="blog-post-inner">

							<div class="post-info">

								<div class="left-area">
									<a class="avatar" href="{{ route('author.profile', $post->user->username) }}"><img src="{{  Storage::disk('public')->url('profile/') . $post->user->image }}" alt="Profile Image"></a>
								</div>

								<div class="middle-area">
									<a class="name" href="#"><b>{{ $post->user->name }}</b></a>
									<h6 class="date">{{ $post->created_at->diffForHumans() }}</h6>
								</div>

							</div><!-- post-info -->

							<h3 class="title"><a href="#"><b>{{ $post->title }}</b></a></h3>

							<div class="para">
								{!! html_entity_decode($post->body) !!}
							</div>

							<ul class="tags">
								@foreach($post->tags as $tag)
									<li><a href="{{ route('tag.posts', $tag->slug) }}">{{ $tag->name }}</a></li>
								@endforeach
							</ul>
						</div><!-- blog-post-inner -->

						<div class="post-icons-area">
							<ul class="post-icons">
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

							<div class="sharethis-inline-share-buttons"></div>

						</div>

					</div><!-- main-post -->
				</div><!-- col-lg-8 col-md-12 -->

				<div class="col-lg-4 col-md-12 no-left-padding">

					<div class="single-post info-area">

						<div class="sidebar-area about-area">
							<h4 class="title"><b>{{ $post->user->name }}</b></h4>
							<p>{{ $post->user->about }}</p>
						</div>

						<div class="tag-area">

							<h4 class="title"><b>CATEGORY</b></h4>
							<ul>
								@foreach($post->categories as $category)
									<li><a href="{{ route('category.posts', $category->slug) }}">{{ $category->name }}</a></li>
								@endforeach
							</ul>

						</div><!-- subscribe-area -->

					</div><!-- info-area -->

				</div><!-- col-lg-4 col-md-12 -->

			</div><!-- row -->

		</div><!-- container -->
	</section><!-- post-area -->


	<section class="recomended-area section">
		<div class="container">
			<div class="row">

				@foreach($randomposts as $post)
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

			</div><!-- row -->

		</div><!-- container -->
	</section>

	<section class="comment-section">
		<div class="container">
			<h4><b>POST COMMENT</b></h4>
			<div class="row">

				<div class="col-lg-8 col-md-12">
					@guest
						<p>For post a new comment you need to login first <a href="{{ route('login') }}">(click here to login)</a></p>
					@else
					<div class="comment-form">
						<form method="post" action="
						{{ route('comment.store', $post->id) }}">
						@csrf
							<div class="row">
								<div class="col-sm-12">
									<textarea name="comment" rows="2" class="text-area-messge form-control"
										placeholder="Enter your comment" aria-required="true" aria-invalid="false"></textarea >
								</div><!-- col-sm-12 -->
								<div class="col-sm-12">
									<button class="submit-btn" type="submit" id="form-submit"><b>POST COMMENT</b></button>
								</div><!-- col-sm-12 -->

							</div><!-- row -->
						</form>
					</div><!-- comment-form -->
					@endguest

					<h4><b>COMMENTS({{ $post->comments->count() }})</b></h4>
					@if($post->comments->count() > 0)
						@foreach($post->comments as $comment)
							<div class="commnets-area ">

							<div class="comment">

								<div class="post-info">

									<div class="left-area">
										<a class="avatar" href="#"><img src="{{ Storage::disk('public')->url('profile/' . $comment->user->image) }}" alt="Profile Image"></a>
									</div>

									<div class="middle-area">
										<a class="name" href="#"><b>{{ $comment->user->name }}</b></a>
										<h6 class="date">{{ $comment->created_at->diffForHumans() }}</h6>
									</div>

								</div><!-- post-info -->

								<p>{{ $comment->comment }}</p>

							</div>
						@endforeach
					@else
						<div class="commnets-area">
							<div class="comment">
								<p>There is no comment yet. Be the first one :)</p>
							</div>
						</div>
					@endif
					</div><!-- commnets-area -->

				</div><!-- col-lg-8 col-md-12 -->

			</div><!-- row -->

		</div><!-- container -->
	</section>

@endsection
@push('js')
<script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5c333cd8a47fe500116a8e9a&product=inline-share-buttons' async='async'></script>
@endpush
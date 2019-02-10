@extends('layouts.backend.app')
@section('title', 'Dashboard')
@push('css')
@endpush
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>DASHBOARD</h2>
        </div>
        <!-- Widgets -->
        <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-green hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">playlist_add_check</i>
                    </div>
                    <div class="content">
                        <div class="text">TOTAL POSTS</div>
                        <div class="number count-to" data-from="0" data-to="{{ $posts->count() }}" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-cyan hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">favorite</i>
                    </div>
                    <div class="content">
                        <div class="text">TOTAL FAVORITE POSTS</div>
                        <div class="number count-to" data-from="0" data-to="{{ Auth::user()->favorite_posts()->count() }}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-light-green hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">forum</i>
                    </div>
                    <div class="content">
                        <div class="text">TOTAL PENDING POSTS</div>
                        <div class="number count-to" data-from="0" data-to="{{ $total_pending_post }}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-orange hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">person_add</i>
                    </div>
                    <div class="content">
                        <div class="text">ALL VIEWS</div>
                        <div class="number count-to" data-from="0" data-to="{{ $total_views }}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Widgets -->
        <!-- Widgets -->
        <div class="row clearfix">
            <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                <div class="info-box bg-pink hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">apps</i>
                    </div>
                    <div class="content">
                        <div class="text">CATEGORIES</div>
                        <div class="number count-to" data-from="0" data-to="{{ $category_count }}" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>
                <div class="info-box bg-blue-grey hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">labels</i>
                    </div>
                    <div class="content">
                        <div class="text">TAGS</div>
                        <div class="number count-to" data-from="0" data-to="{{ $tag_count }}" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>
                <div class="info-box bg-purple hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">account_circle</i>
                    </div>
                    <div class="content">
                        <div class="text">TOTAL AUTHORS</div>
                        <div class="number count-to" data-from="0" data-to="{{ $total_authors }}" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>
                <div class="info-box bg-deep-purple hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">fiber_new</i>
                    </div>
                    <div class="content">
                        <div class="text">NEW AUTHOR TODAY</div>
                        <div class="number count-to" data-from="0" data-to="{{ $today_new_authors }}" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>MOST POPULAR POSTS</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
                                <thead>
                                    <tr>
                                        <th>RANK</th>
                                        <th>TITLE</th>
                                        <th>AUTHOR</th>
                                        <th>VIEWS</th>
                                        <th>COMMENTS</th>
                                        <th>FAVORITE</th>
                                        <th>STATUS</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($popular_posts as $key =>  $post)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ str_limit($post->title, 20) }}</td>
                                        <td>{{ $post->user->name }}</td>
                                        <td>{{ $post->view_count }}</td>
                                        <td>{{ $post->comments_count }}</td>
                                        <td>{{ $post->favorite_to_users_count }}</td>
                                        <td>
                                            @if($post->status == true)
                                                <span class="label bg-green">published</span>
                                            @else
                                                <span class="label bg-red">pending</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($post->status == true)
                                                <a href="{{ route('post.details', $post->slug) }}" class="btn btn-sm btn-primary waves-effect" target="_blank">view</a>
                                            @else
                                                <button class="btn btn-sm btn-danger" disabled="">wait</button>
                                            @endif
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
        <!-- #END# Widgets -->
        <div class="row clearfix">
            <!-- Task Info -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>TASK INFOS</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
                                <thead>
                                    <tr>
                                        <th>RANK LIST</th>
                                        <th>NAME</th>
                                        <th>POST</th>
                                        <th>COMMENTS</th>
                                        <th>FAVORITE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach($active_authors as $key => $author)
                                   <tr>
                                       <td>{{ $key+1 }}</td>
                                       <td>{{ $author->name }}</td>
                                       <td>{{ $author->posts_count }}</td>
                                       <td>{{ $author->comments_count }}</td>
                                       <td>{{ $author->favorite_posts_count }}</td>
                                   </tr>
                                   @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Task Info -->
        </div>
    </div>
</section>
@endsection
@push('js')
<!-- Jquery CountTo Plugin Js -->
<script src="{{ asset('assets/backend') }}/plugins/jquery-countto/jquery.countTo.js"></script>
<!-- Morris Plugin Js -->
<script src="{{ asset('assets/backend') }}/plugins/raphael/raphael.min.js"></script>
<script src="{{ asset('assets/backend') }}/plugins/morrisjs/morris.js"></script>
<!-- ChartJs -->
<script src="{{ asset('assets/backend') }}/plugins/chartjs/Chart.bundle.js"></script>
<!-- Flot Charts Plugin Js -->
<script src="{{ asset('assets/backend') }}/plugins/flot-charts/jquery.flot.js"></script>
<script src="{{ asset('assets/backend') }}/plugins/flot-charts/jquery.flot.resize.js"></script>
<script src="{{ asset('assets/backend') }}/plugins/flot-charts/jquery.flot.pie.js"></script>
<script src="{{ asset('assets/backend') }}/plugins/flot-charts/jquery.flot.categories.js"></script>
<script src="{{ asset('assets/backend') }}/plugins/flot-charts/jquery.flot.time.js"></script>
<!-- Sparkline Chart Plugin Js -->
<script src="{{ asset('assets/backend') }}/plugins/jquery-sparkline/jquery.sparkline.js"></script>
<script src="{{ asset('assets/backend') }}/js/pages/index.js"></script>
@endpush
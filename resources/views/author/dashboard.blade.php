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
                <div class="info-box bg-pink hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">playlist_add_check</i>
                    </div>
                    <div class="content">
                        <div class="text">Total Posts</div>
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
                        <div class="text">Total Favorite Posts</div>
                        <div class="number count-to" data-from="0" data-to="{{ $user->favorite_posts()->count() }}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-light-green hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">forum</i>
                    </div>
                    <div class="content">
                        <div class="text">Pending Posts</div>
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
                        <div class="text">Total Views</div>
                        <div class="number count-to" data-from="0" data-to="{{ $all_views }}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <!-- Task Info -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>Top 5 Popular Posts</h2>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>Rank list</th>
                                            <th>Title</th>
                                            <th>Views</th>
                                            <th>Favorite</th>
                                            <th>Comments</th>
                                            <th>Status</th>
                                            <th>Approval</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($popular_posts as $key => $post)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ str_limit($post->title, 20) }}</td>
                                                <td>{{ $post->view_count }}</td>
                                                <td>{{ $post->favorite_to_users_count }}</td>
                                                <td>{{ $post->comments_count }}</td>
                                                <td>
                                                    @if($post->status == true)
                                                        <span class="label bg-green">published</span>
                                                    @else
                                                        <span class="label bg-red">published</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($post->is_approved == true)
                                                        <span class="label bg-green">approved</span>
                                                    @else
                                                        <span class="label bg-red">pending</span>
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
                <!-- #END# Task Info -->
            </div>
        </div>
    </section>
    @endsection
    @push('js')
    <!-- Jquery CountTo Plugin Js -->
    <script src="{{ asset('assets/backend') }}/plugins/jquery-countto/jquery.countTo.js"></script>
    <script src="{{ asset('assets/backend') }}/js/pages/index.js"></script>
    @endpush
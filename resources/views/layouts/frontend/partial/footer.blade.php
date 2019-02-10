<footer>

        <div class="container">
            <div class="row">

                <div class="col-lg-4 col-md-6">
                    <div class="footer-section">

                        <a class="logo" href="{{ route('home') }}"><img src="{{ asset('assets/frontend') }}/images/logo.png" alt="Logo Image"></a>
                        <p class="copyright">{{ config('app.name') }} @ 2019. All rights reserved.</p>
                        <p class="copyright">Designed by <a href="https://colorlib.com" target="_blank">Colorlib</a> and developed by <a href="https://www.facebook.com/plabon.costa.9" target="_blank">Plabon Costa</a></p>
                        @php
                            $social = App\Social::findOrFail(1);
                        @endphp
                        <ul class="icons">
                            <li><a href="{{ $social->facebook }}" target="_blank"><i class="ion-social-facebook-outline"></i></a></li>
                            <li><a href="{{ $social->twitter }}" target="_blank"><i class="ion-social-twitter-outline"></i></a></li>
                            <li><a href="{{ $social->instagram }}" target="_blank"><i class="ion-social-instagram-outline" ></i></a></li>
                            <li><a href="{{ $social->vemio }}" target="_blank"><i class="ion-social-vimeo-outline"></i></a></li>
                            <li><a href="{{ $social->pinterest }}" target="_blank"><i class="ion-social-pinterest-outline" ></i></a></li>
                        </ul>

                    </div><!-- footer-section -->
                </div><!-- col-lg-4 col-md-6 -->

                <div class="col-lg-4 col-md-6">
                        <div class="footer-section">
                        <h4 class="title"><b>CATAGORIES</b></h4>
                        <ul>
                            @foreach($categories as $category)
                                <li><a href="{{ route('category.posts', $category->slug) }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </div><!-- footer-section -->
                </div><!-- col-lg-4 col-md-6 -->

                <div class="col-lg-4 col-md-6">
                    <div class="footer-section">

                        <h4 class="title"><b>SUBSCRIBE</b></h4>
                        <div class="input-area">
                            <form action="{{ route('subscriber.store') }}" method="post">
                                @csrf
                                @method('put')
                                <input name="email" class="email-input" type="email" placeholder="Enter your email">
                                <button class="submit-btn" type="submit"><i class="icon ion-ios-email-outline"></i></button>
                            </form>
                        </div>

                    </div><!-- footer-section -->
                </div><!-- col-lg-4 col-md-6 -->

            </div><!-- row -->
        </div><!-- container -->
    </footer>
@section('title', 'Deep Convos')

@section('header')

    <header>
        <div class="nav-bar">
            <div class="menu">
                <div class="logo">
                    <a href="/" class="item--logo"><img src="{{asset('img/logo.svg')}}" alt=""></a>
                </div>
                <div class="user-actions">
                    <ul>
                        <li><a href="{{ isset($for_artists_page) && $for_artists_page ? '/' : '/main' }}" class="link-painters">{{ isset($for_artists_page) && $for_artists_page ? $translates['for_customers'] : $translates['for_artists'] }}</a></li>
                        @if(Auth::check())
                            <li class="user-enter"><a href="/logout" class="link-enter">{{$translates['logout']}}</a></li>
                        @else
                            <li class="user-enter"><a href="/login" class="link-enter">{{$translates['login']}}</a></li>
                            <li>|</li>
                            <li><a href="/sign-up" class="link-register">{{$translates['sign_up']}}</a></li>
                        @endif
                    </ul>
                    <div class="language">
                        <div class="language-switch" data-lang="{{$next_locale}}">{{$next_locale_text}}</div>
                    </div>
                </div>
                <div class="burger-menu">
                    <div class="menu-icon-wrapper menu--open">
                        <div class="menu-icon"></div>
                    </div>
                </div>
                <!--burger menu-->
            </div>
        </div>
        <!--Media nav -->

        <div class="mobile-navigation" style="display:none">
            <div class="navigation--layer">
                <div class="navigation__container">
                    <ul class="navigation--list">
                        <li class="navigation--item">
                            <ul>
                                <li>
                                    <img data-src="{{asset('img/menu/3.svg')}}" alt="">
                                    <p>{{$translates['for_customers']}}</p>
                                </li>
                                <li><a href="/login">{{$translates['sign_up']}}</a></li>
                                <li><a href="/artists">{{$translates['find_artist']}}</a></li>
                                <li><a href="#">{{$translates['show_portfolio']}}</a></li>
                                <li><a href="/">{{$translates['how_to_order']}}</a></li>
                                <li><a href="/collections">{{$translates['make_collection_pre_order']}}</a></li>
                                <li><a href="#">{{$translates['send_review']}}</a></li>
                            </ul>
                        </li>
                        <li class="navigation--item">
                            <ul>
                                <li>
                                    <img data-src="{{asset('img/menu/1.svg')}}" alt="">
                                    <p>{{$translates['for_artists']}}</p>
                                </li>
                                <li><a href="/main">{{$translates['how_become_artist']}}</a></li>
                                <li><a href="#">{{$translates['artist_requirements']}}</a></li>
                                <li><a href="#">{{$translates['make_apply']}}</a></li>
                                <li><a href="/terms">{{$translates['site_terms']}}</a></li>
                                <li><a href="/collections">{{$translates['best_collections']}}</a></li>
                            </ul>
                        </li>
                        <li class="navigation--item">
                            <ul>
                                <li>
                                    <img data-src="{{asset('img/menu/2.svg')}}" alt="">
                                    <p>{{$translates['collections']}}</p>
                                </li>
                                <li><a href="#">Male Tracksuit</a></li>
                                <li><a href="#">Fermale Tracksuit</a></li>
                                <li><a href="#">Etc.</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <script src="{{asset('js/server.js')}}"></script>
        <script src="{{asset('js/header.js')}}"></script>

        <!--End NavBar-->
    </header>

@endsection

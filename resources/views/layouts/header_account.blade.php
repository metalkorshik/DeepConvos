@section('title', 'Deep Convos')

@section('header')

    <header>
        <div class="nav-bar">
            <div class="menu">
                <div class="logo">
                    <a href="/" class="item--logo"><img src="{{asset('img/logo-black.svg')}}" alt=""></a>
                </div>
                <nav class="navigation">
                    <ul>
                        <li><a href="/" class="link"><p><i class="icon-star"></i>{{$translates['for_customer']}}</p></a></li>
                        <li><a href="/artists" class="link"><p><i class="icon-star"></i>{{$translates['artists']}}</p></a></li>
                        <li><a href="/terms" class="link"><p><i class="icon-star"></i>{{$translates['for_performers']}}</p></a></li>
                        <li><a href="/collections" class="link"><p><i class="icon-star"></i>{{$translates['collections']}}</p></a></li>
                    </ul>
                </nav>
                <div class="user-actions">
                    <ul>
                        <li><a href="/account" class="link-register"><span>{{$translates['customer']}}</span></a></li>
                        <li><a href="/account" class="link-register">{{ isset($user_info) ? $user_info['name'] . ' ' . $user_info['surname'] : 'Ксения Голдман' }}</a></li>
                    </ul>
                    <div class="logged-wrapper">
                    <div class="logged">
                        <a href="#">{{strtoupper($user_info['name'][0])}}<div class="arrows">
                            <i class="icon-rounding-arrow"></i>
                        </div></a>
                        <div class="logged-menu">
                            <div class="logged-menu__title">
                                {{$translates['personal_account']}}
                            </div>
                            <div class="logged-menu__buttons-wrapper">
                                <div class="btn--customer {{ $user_info['is_artist'] ? '' : 'active-user-tab' }}"><a href="#">{{$translates['customer']}}</a></div>
                                <div class="btn--painter {{ $user_info['is_artist'] ? 'active-user-tab' : '' }}"><a href="#">{{$translates['artist']}}</a></div>
                            </div>
                            <div class="logged-menu__exit">
                                <a href="/logout">{{$translates['logout']}}</a>
                            </div>
                        </div>

                    </div>

                    </div>
                    <div class="language">
                        <div class="language-switch" data-lang="{{$next_locale}}">{{$next_locale_text}}</div>
                    </div>
                </div>
                <!--burger menu-->
                <div class="burger-menu menu--open">
                    <span class="menu-icon"></span>
                </div>
            </div>
        </div>
        <!--Media nav -->
        <div class="mobile-navigation">
            <div class="mobile-navigation__inner">
                <div class="logged-menu">
                    <div class="logged-menu__title">{{$translates['personal_account']}}</div>
                    <div class="logged-menu__body">
                        <div class="logged-menu__buttons-wrapper">
                            <div class="btn--customer"><a href="#">{{$translates['customer']}}</a></div>
                            <div class="btn--painter"><a href="#">{{$translates['artist']}}</a></div>
                        </div>
                        <div class="logged-menu__exit">
                            <a href="/logout">{{$translates['logout']}}</a>
                        </div>
                    </div>
                </div>
                <ul class="template-navigation__menu">
                    <li class="menu__item active--items">
                        <div class="item__button">
                            <i class="icon-icons-artist"></i>
                        </div>
                        <a href="/favorite-artists">{{$translates['favorite_artists']}}</a>
                    </li>
                    <li class="menu__item ">
                        <div class="item__button">
                            <i class="icon-icons-art"></i>
                        </div>
                        <a href="/favorite-works"> {{$translates['favorite_works']}}</a>
                    </li>
                    <li class="menu__item ">
                        <div class="item__button">
                            <i class="icon-icons-meeting"></i>
                        </div>
                        <a href="/meetings">{{$translates['appointments']}} <span class="circle"><i class="icon-bell"></i></span></a>
                    </li>
                    <li class="menu__item ">
                        <div class="item__button">
                            <i class="icon-icons-sketsh"></i>
                        </div>
                        <a href="/sketches">{{$translates['submitted_sketches']}}</a>
                    </li>
                    <li class="menu__item ">
                        <div class="item__button">
                            <i class="icon-icons-settings"></i>
                        </div>
                        <a href="/account">{{$translates['my_details']}}</a>
                    </li>
                </ul>
                <div class="template-navigation__text">
                    <p>© 2020 Deep Convos</p>
                </div>
            </div>
        </div>
        <script src="{{asset('js/server.js')}}"></script>
        <script src="{{asset('js/header.js')}}"></script>

        <!--End NavBar-->
    </header>

@endsection

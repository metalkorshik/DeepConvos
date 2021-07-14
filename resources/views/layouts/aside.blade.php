@section('title', 'Deep Convos')

@section('aside')

    <article class="template-navigation">
        <div class="template-navigation__inner">
            <div class="template-navigation__logo">
                <a href="/">  <img src="{{asset('img/logo-black.svg')}}" alt=""></a>
            </div>
            <ul class="template-navigation__menu">
                <li class="menu__item {{ isset($current_page) && $current_page == 'favorite_artists' ? 'active--item' : '' }}">
                    <div class="item__button">
                        <i class="icon-icons-artist"></i>
                    </div>
                    <a href="/favorite-artists">{{$translates['favorite_artists']}}</a>
                </li>
                <li class="menu__item {{ isset($current_page) && $current_page == 'favorite_works' ? 'active--item' : '' }}">
                    <div class="item__button">
                        <i class="icon-icons-art"></i>
                    </div>
                    <a href="/favorite-works"> {{$translates['favorite_works']}}</a>
                </li>
                <li class="menu__item {{ isset($current_page) && $current_page == 'meetings' ? 'active--item' : '' }}">
                    <div class="item__button">
                        <i class="icon-icons-meeting"></i>
                    </div>
                    <a href="/meetings">{{$translates['appointments']}} <span class="circle"><i class="icon-bell"></i></span></a>
                </li>
                <li class="menu__item {{ isset($current_page) && ($current_page == 'sketch' || $current_page == 'sketches') ? 'active--item' : '' }}">
                    <div class="item__button">
                        <i class="icon-icons-sketsh"></i>
                    </div>
                    <a href="/sketches">{{$translates['submitted_sketches']}}</a>
                </li>
                <li class="menu__item {{ isset($current_page) && $current_page == 'account' ? 'active--item' : '' }}">
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
    </article>

@endsection

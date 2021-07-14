@extends('layouts.app')

@section('footer')

    <footer class="footer" id="footer">
        <div class="footer__inner">
            <div class="footer__top--line">
                <ul class="footer__navigation--list">
                    <li class="footer__navigation--item">
                        <ul>
                            <li class="uppercase">{{$translates['for_customer']}}</li>
                            <li><a href="/login">{{$translates['sign_up']}}</a></li>
                            <li><a href="/artists">{{$translates['find_artist']}}</a></li>
                            <li><a href="/artists">{{$translates['show_portfolio']}}</a></li>
                            <li><a href="/">{{$translates['how_to_order']}}</a></li>
                            <li><a href="/collections">{{$translates['make_collection_pre_order']}}</a></li>
                            <li><a href="/artists">{{$translates['send_review']}}</a></li>
                        </ul>
                    </li>
                    <li class="footer__navigation--item">
                        <ul>
                            <li>{{$translates['for_artist']}}</li>
                            <li><a href="/main">{{$translates['how_become_artist']}}</a></li>
                            <li><a href="/terms">{{$translates['artist_requirements']}}</a></li>
                            <li><a href="/login">{{$translates['make_apply']}}</a></li>
                            <li><a href="/policy">{{$translates['site_terms']}}</a></li>
                            <li><a href="/collections">{{$translates['best_collections']}}</a></li>
                        </ul>
                    </li>
                    <li class="footer__navigation--item">
                        <ul>
                            <li>{{$translates['collections']}}</li>
                            <li><a href="#">Male Tracksuit</a></li>
                            <li><a href="#">Fermale Tracksuit</a></li>
                            <li><a href="#">Etc.</a></li>
                        </ul>
                    </li>
                    <li class="footer__navigation--item">
                        <ul>
                            <li>
                                <div class="footer__social-networks">
                                    <div class="social-networks__pit">
                                        <img data-src="{{asset('img/main/footer-oval.svg')}}" alt="">
                                    </div>
                                    <div class="social-networks__decoration">
                                        <img data-src="{{asset('img/main/footer-decoration1.svg')}}" alt="">
                                    </div>
                                    <div class="social-networks__links">
                                        <div class="links__item"><a href="#"><img data-src="{{asset('img/facebook-colored.svg')}}" alt=""></a></div>
                                        <div class="links__item"><a href="#"><img data-src="{{asset('img/instagram-colored.svg')}}" alt=""></a></div>
                                        <div class="links__item"><a href="#"><img data-src="{{asset('img/vk-colored.svg')}}" alt=""></a></div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="payments">
                                    <div class="payments__system"><img data-src="{{asset('img/main/paypal.svg')}}" alt=""></div>
                                    <div class="payments__system"><img data-src="{{asset('img/main/stripe.svg')}}" alt=""></div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="footer__middle--line">
                <div class="middle__item">
                    <a href="/terms"><p>{{$translates['banking_guarantee']}}</p></a>
                </div>
                <div class="middle__item">
                    <a href="/terms"><p>{{$translates['legal_information']}}</p></a>
                </div>
                <div class="middle__item">
                    <a href="/terms"><p>{{$translates['terms']}}</p></a>
                </div>
                <div class="middle__item">
                    <form class="input__wrapper" method="POST" action="/subscribe-to-news">
                        @csrf
                        <input type="email" name="email" pattern=".+@.+" required placeholder="{{$translates['subscribe_news']}}">
                        <button class="input--btn"><a>{{$translates['subscribe']}}</a></button>
                    </form>
                </div>
            </div>
            <div class="footer__bottom--line">
                <div class="bottom__item">
                    <div class="item__image">
                        <a href="/"><img data-src="{{asset('img/logo-black.svg')}}" alt=""></a>
                    </div>
                    <div class="item__text">
                        © 2020 Deep Convos
                    </div>
                </div>
                {{-- <div class="bottom__item"> --}}
                    {{-- <div class="item__text">{{$translates['site_developed']}}</div> --}}
                    {{-- <div class="item__image"><a href="#"><img data-src="{{asset('img/company.svg')}}" alt=""></a></div> --}}
                {{-- </div> --}}
            </div>
        </div>

    </footer>

@endsection

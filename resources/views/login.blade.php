@extends('layouts.app')

@section('title', 'Deep Convos')

@section('content')
    <section class="user-registration">
        <div class="logo"><img src="{{asset('img/logo-black.svg')}}" alt=""></div>
        <div class="user-form">
            <div class="user-form__link-back">
                <a href="{{url('/')}}"><i class="icon-arrow-slide-left"></i>{{$translates['back']}}</a>
            </div>
            <div class="user-form__inner">
                <div class="form-top">
                    <div class="top__actions">
                        <div class="tabs tab--enter {{ $active_tab == 1 ? 'active-tab' : '' }} tab-links"><img src="{{asset('img/lk-images/tab-bg-2.svg')}}" alt=""><span> {{$translates['login']}}</span></div>
                        <div class="tabs tab--registration {{ $active_tab == 2 ? 'active-tab' : '' }} tab-links"><img src="{{asset('img/lk-images/tab-bg-1.svg')}}" alt=""><span>{{$translates['sign_up']}}</span></div>
                    </div>
                </div>
                <form action="/login" method="POST" class="form-enter tab-content {{ $active_tab == 1 ? 'active--block' : '' }}">
                    @csrf
                    <p class="form-enter__description error {{ isset($errors) && count($errors->all()) ? '' : 'hidden' }}">{{ isset($errors) && count($errors->all()) ? $errors->all()[0] : '' }}</p>
                    <p class="form-enter__description">{{$translates['please_log_in']}}</p>
                    <div class="input-wrapper">
                        <div class="input-wrapper__description">
                            E-mail<span>*</span>
                        </div>
                        <input type="text" placeholder="Madeinearth@gmailcom" type="email" name="email" :value="old('email')" required autofocus>
                    </div>
                    <div class="input-wrapper">
                        <div class="input-wrapper__description">
                            {{$translates['password']}}<span>*</span>
                        </div>
                        <input class="psw" type="password" name="password" required autocomplete="current-password">
                        <div class="input-wrapper__vision">
                            <div class="vision--vision"><img src="{{asset('img/lk-images/vision.svg')}}" alt=""></div>
                            <div class="vision--hide"><img src="{{asset('img/lk-images/hide.svg')}}" alt=""></div>
                        </div>
                    </div>
                    <div class="button-wrapper">
                        <button  type="submit">{{$translates['login']}}</button>
                    </div>
                    <a href="/forgot-password" class="lost-password">{{$translates['forget_password']}}</a>
                </form>

                <div class="form-wrapper tab-content {{ $active_tab == 2 ? 'active--block' : '' }}">
                <div class="form-register form-register-general">
                    <p class="form-register__description">
                        {{$translates['choose_who_register_as']}}
                    </p>
                    <ul>
                        <li>
                            <label class="container">{{$translates['women']}}
                                <input type="radio" data-gender="0" checked="checked" name="gender-radio">
                                <span class="checkmark"></span>
                            </label>
                        </li>
                        <li>
                            <label class="container">{{$translates['men']}}
                                <input type="radio" data-gender="1" name="gender-radio">
                                <span class="checkmark"></span>
                            </label>
                        </li>
                    </ul>
                    <div class="button-wrapper">
                        <button type="submit">{{$translates['next']}}</button>
                    </div>
                </div>
                <div class="form-register-client-type form-register-general">
                    <p class="form-register__description">
                        {{$translates['choose_who_register_as']}}
                    </p>
                    <ul>
                        <li>
                            <label class="container">{{$translates['customer']}}
                                <input type="radio" checked="checked" name="user-type-radio" data-type="customer">
                                <span class="checkmark"></span>
                            </label>
                        </li>
                        <li>
                            <label class="container">{{$translates['artist']}}
                                <input type="radio" name="user-type-radio" data-type="artist">
                                <span class="checkmark"></span>
                            </label>
                        </li> 
                    </ul>
                    <div class="button-wrapper">
                        <button type="submit">{{$translates['next']}}</button>
                    </div>
                </div>
                <form class="form-register-inner" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="register-customer-action" value="{{$register_customer_action}}"/>
                    <input type="hidden" id="register-artist-action" value="{{$register_artist_action}}"/>
                    <input type="hidden" name="is_artist" value="0"/>
                    <input type="hidden" id="is-male-stamp" name="is_male" value="0"/>
                    <input type="hidden" id="is-subscriber" name="is_subscriber" value="0"/>
                    <div class="form-register-inner__description">
                        <span class="customer-register-title">{{$translates['sign_up_as_customer']}}</span>
                        <span class="artist-register-title hidden">{{$translates['sign_up_as_artist']}}</span>
                    </div>
                    <div class="form-register-inner__content">
                        <div class="input-wrapper">
                            <div class="input-wrapper__description">
                               {{$translates['name']}}<span>*</span>
                            </div>
                            <input name="name" required type="text" placeholder="" value="">
                        </div>
                        <div class="input-wrapper">
                            <div class="input-wrapper__description">
                                {{$translates['surname']}}<span>*</span>
                            </div>
                            <input name="surname" required type="text" placeholder="" value="">
                        </div>
                        <div class="input-wrapper">
                            <div class="input-wrapper__description">
                                E-mail<span>*</span>
                            </div>
                            <input name="email" required type="text" placeholder="Madeinearth@gmailcom" value="">
                        </div>
                        <div class="input-wrapper">
                            <div class="input-wrapper__description">
                                Password<span>*</span>
                            </div>
                            <input name="password" required type="password" value="" minlength="8">
                        </div>
                        <div class="input-wrapper">
                            <div class="input-wrapper__description top-s">
                                {{$translates['phone']}}<span>*</span>
                            </div>
                            <input name="phone" required type="text" value="">
                        </div>
                        <div class="input-wrapper">
                            <div class="input-wrapper__description top-s">
                                {{$translates['country']}}<span>*</span>
                            </div>
                            <input name="country" required type="text" value="">
                        </div>
                        <div class="input-wrapper">
                            <div class="input-wrapper__description top-s">
                                {{$translates['city']}}<span>*</span>
                            </div>
                            <input name="city" required type="text" value="">
                        </div>
                        <div class="input-wrapper artist-details">
                            <div class="input-wrapper__description top-s">
                                {{$translates['birthdate']}}<span>*</span>
                            </div>
                            <input name="birthdate" required type="text" value="">
                        </div>
                        <div class="input-wrapper artist-details">
                            <div class="input-wrapper__description">
                               {{$translates['card_number']}}<span>*</span>
                            </div>
                            <input name="card_number" required type="text" placeholder="0000 0000 0000 0000" value="">
                        </div>
                        <div class="input-wrapper artist-details">
                            <div class="input-wrapper__description">
                               {{$translates['card_owner']}}<span>*</span>
                            </div>
                            <input name="card_owner" required type="text" placeholder="{{$translates['surname_and_name']}}" value="">
                        </div>
                        <div class="input-wrapper artist-details">
                            <div class="input-wrapper__description">
                               {{$translates['validity']}}<span>*</span>
                            </div>
                            <input name="card_validity" pattern="[0-9]{2}/[0-9]{2}" required type="text" placeholder="{{$translates['month_year_placeholder']}}" value="">
                        </div>
                        <br>
                        <div class="input-wrapper artist-details">
                            <div class="input-wrapper__description">
                               {{$translates['portfolio']}}<span>*</span>
                            </div>
                            <div class="loaded">
                                <label for="file-upload">
                                    <div class="load-item"><img src="{{asset('img/lk-images/icons-clip.svg')}}" alt=""></div>
                                </label>
                                <input class="file-upload" name="portfolio" type="file">
                            </div>
                        </div>
                    </div>
                    <div class="checkbox-wrapper">
                        <div class="checkbox__inner">
                            <div class="checkbox">
                                <input class="cb" type="checkbox" id="checkbox_1" checked="checked">
                                <label for="checkbox_1">{{$translates['i_agree_terms']}} <a href="/terms">{{$translates['personal_details']}}</a></label>
                            </div>
                            <div class="checkbox">
                                <input class="cb" type="checkbox" id="is-subscriber-checkbox" >
                                <label for="is-subscriber-checkbox">{{$translates['subscribe_new_collections']}}</label>
                            </div>
                        </div>
                     </div>
                    <div class="button-wrapper">
                        <button type="submit">{{$translates['sign_up']}}</button>
                    </div>
                </form>
                </div>
            </div>
        </div>

    </section>


	<!-- Load CSS -->
	
    <link rel="stylesheet"  href="{{asset('css/normalize.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/fonts.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/lk-11.css')}}" />

	<!-- Load Scripts -->
    <script src="{{asset('libs/anime.min.js')}}"></script>
    <script src="{{asset('js/plugins-registration.js')}}"></script>
  <script>


  </script>
@endsection
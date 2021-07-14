@extends('layouts.app')

@section('title', 'Deep Convos')

@section('content')

    <section class="user-registration">
        <div class="logo"><img src="{{asset('img/logo-black.svg')}}" alt=""></div>
        <div class="user-form">
            <div class="user-form__link-back"><a><i class="icon-arrow-slide-left"></i>{{$translates['back']}}</a></div>
            <div class="user-form__inner">
                <div class="register-complete">
                    <div class="register-complete__title">{{$translates['thanks']}}</div>
                    <div class="register-complete__description">{{$translates['complete_registration']}} <span>{{$user_email}}</span></div>
                    <div class="register-complete__timer">{{$translates['resend_in']}} 00:26 ({{$translates['or_write_us_at']}} deepconvos.com)</div>
                    <div class="register-complete__image">
                        <img src="{{asset('img/lk-images/complete-form.svg')}}" alt="">
                    </div>
                </div>
            </div>
        </div>

    </section>


	<!-- Load CSS -->
	
    <link rel="stylesheet"  href="{{asset('css/normalize.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/fonts.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/lk-11.css')}}" />
  <script>




  </script>
@endsection
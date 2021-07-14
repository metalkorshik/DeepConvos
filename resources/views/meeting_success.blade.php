@include('layouts.header_account')

@section('content')

    @include('layouts.aside')
    @yield('aside')
	
  <section class="main-area">
      <div class="main-area__inner">
          <div class="customer-message">
              <div class="customer-message__link">
                  <a href="/meetings">
                      <i class="icon-arrow-slide-left"></i>
                      {{$translates['back_to_order']}}
                  </a>
              </div>
              <div class="customer-message__title">{{$translates['meeting_created']}}</div>
              <div class="customer-message__image"><img src="{{asset('img/lk-images/customer-message.svg')}}" alt=""></div>
              <div class="customer-message__description">
                  <p>{{$translates['check_email_after_pay']}}</p>
                  <span>{{$user_info['email']}}</span>
                  <p>{{$translates['go_appointments_section']}}</p>
              </div>
          </div>
      </div>
  </section>
	
	<!-- Load CSS -->
	
    <link rel="stylesheet"  href="{{asset('css/normalize.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/fonts.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/header-lk.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/lk-9.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/footer-lk.css')}}" />
	<!-- Load Scripts -->
    <script src="{{asset('libs/anime.min.js')}}"></script>
    <script src="{{asset('js/plugins-lk.js')}}"></script>
  <script>




  </script>
@endsection

@include('layouts.footer_account')

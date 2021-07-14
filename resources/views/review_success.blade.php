@include('layouts.header_account')

@section('content')

    @include('layouts.aside')
    @yield('aside')
	
  <section class="main-area">
      <div class="main-area__inner">
          <div class="customer-accept">
              <div class="customer-accept__link">
                  <a href="/sketches">
                      <i class="icon-arrow-slide-left"></i>
                      {{$translates['back_to_sketches']}}
                  </a>
              </div>
              <div class="customer-accept__title">{{$translates['review_sent']}}</div>
              <div class="customer-accept__description">Иван, {{$translates['thanks_for_feedback']}}</div>
              <div class="customer-accept__image"><img src="{{asset('img/lk-images/lk-accept-review.svg')}}" alt=""></div>
          </div>
      </div>
  </section>
	
	<!-- Load CSS -->
	
        <link rel="stylesheet"  href="{{asset('css/normalize.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/fonts.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/header-lk.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/lk-8.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/footer-lk.css')}}" />
	<!-- Load Scripts -->
    <script src="{{asset('libs/anime.min.js')}}"></script>
    <script src="{{asset('js/plugins-lk.js')}}"></script>
  <script>




  </script>
@endsection

@include('layouts.footer_account')
@include('layouts.header_account')

@section('content')

    @include('layouts.aside')
    @yield('aside')
	
  <section class="main-area">
      <div class="main-area__inner">
          <div class="accept-review">
              <div class="link-back-to-sketch">
                  <a href="/sketches">
                      <i class="icon-arrow-slide-left"></i>
                      {{$translates['back_to_sketches']}}
                  </a>
              </div>
              <div class="suggested-paid">
                {{$translates['order_successfully_paid']}}
              </div>
              <div class="order">{{$translates['order']}}: <span>Футболка принт</span></div>
              <div class="paid-price">{{$translates['paid']}} <span>200 €</span></div>
              <div class="paid-description">{{$translates['check_emailed_to_you']}}</div>
              <div class="review__content">
                  <div class="review__title">{{$translates['leave_artist_feedback']}}</div>
                  <div class="review__line">
                      <div class="review__rating">
                          <i class="icon-rating"></i>
                          <i class="icon-rating"></i>
                          <i class="icon-rating"></i>
                          <i class="icon-rating"></i>
                          <i class="icon-rating"></i>
                      </div>
                      <div class="review__artist">
                          <img src="{{asset('img/lk-images/artists-image.png')}}" alt="">
                          <span>Юлия Жукова</span>
                      </div>
                  </div>
                  <textarea required name="msg" cols="30" rows="4" placeholder="{{$translates['enter_your_text']}}"></textarea>
                  <button class="btn--send" type="submit"><a href="/sketches">{{$translates['send']}}</a></button>
              </div>

          </div>
      </div>
  </section>
	
	<!-- Load CSS -->
	
    <link rel="stylesheet"  href="{{asset('css/normalize.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/fonts.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/header-lk.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/lk-2.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/footer-lk.css')}}" />
	<!-- Load Scripts -->
    <script src="{{asset('libs/anime.min.js')}}"></script>
    <script src="{{asset('js/plugins-lk.js')}}"></script>
  <script>




  </script>
@endsection

@include('layouts.footer_account')
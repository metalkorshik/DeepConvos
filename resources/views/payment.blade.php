@include('layouts.header_account')

@section('content')

    @include('layouts.aside')
    @yield('aside')
	
  <section class="main-area">
      <div class="main-area__inner">
          <form class="customer-payment" method="POST" action="{{$action}}">
                @csrf
                <input type="hidden" name="meeting_details" value="{{$meeting_details ?? ''}}">
                <input type="hidden" name="amount" value="{{$amount}}">
                <input type="hidden" name="remove_meeting" value="{{$remove_meeting ?? ''}}">
              <div class="link-back-to-order">
                  <a href="/order"><i class="icon-arrow-slide-left"></i>{{$translates['back_to_order']}}</a>
              </div>
              <div class="customer-payment__description">
                {{$purpose == 'meeting' ? $translates['payment_for_meeting'] : ''}}
              </div>
              <div class="customer-payment__price">
                {{$translates['meeting_cost']}} <span>{{$amount}} {{$translates['euro']}}</span>.
              </div>
              <div class="customer-payment__card-selection">
                  <div class="card-selection__item">
                    <div class="item__name">Stripe</div>
                    <div class="item__image"><img src="{{asset('img/lk-images/stripe.png')}}" alt=""></div>
                </div>
              </div>
              <div class="customer-payment__payment-card">
                  <div class="payment-card__front">
                      <div class="front__card-number">
                          <div class="number__inner">
                              <div class="number__description">{{$translates['card_number']}}</div>
                              <input required type="text" placeholder="0000  0000  0000  0000">
                          </div>
                      </div>
                      <div class="front__bottom-line">
                          <div class="front__card-owner">
                              <div class="owner__description">{{$translates['card_owner']}}</div>
                              <input required type="text" placeholder="{{$translates['surname_and_name']}}">
                          </div>
                          <div class="front__card-term">
                              <div class="term__description">{{$translates['validity']}}</div>
                              <input required pattern="[0-9]{2}/[0-9]{2}" type="text" placeholder="{{$translates['month_year_placeholder']}}">
                          </div>
                      </div>
                  </div>
                  <div class="payment-card__back">
                      <div class="back__line"></div>
                      <div class="back__cvv">
                          <div class="cvv__inner">
                              <div class="inner__name">CVV</div>
                              <input required type="text" placeholder="000">
                          </div>
                      </div>
                  </div>
              </div>
              <button class="customer-payment--send" type="submit"><a>{{$translates['pay']}}</a></button>
            </form>
      </div>
  </section>
	
	<!-- Load CSS -->
	
    <link rel="stylesheet"  href="{{asset('css/normalize.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/fonts.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/header-lk.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/lk-4.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/footer-lk.css')}}" />
	<!-- Load Scripts -->
    <script src="{{asset('libs/anime.min.js')}}"></script>
    <script src="{{asset('js/plugins-lk.js')}}"></script>
  <script>




  </script>
@endsection

@include('layouts.footer_account')
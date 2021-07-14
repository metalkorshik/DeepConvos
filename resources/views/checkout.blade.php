@include('layouts.header_account')

@section('content')

    @include('layouts.aside')
    @yield('aside')
	
  <section class="main-area">
      <div class="main-area__inner">
          <form class="customer-payment" action="{{$action}}" method="POST">
              @csrf
                @if(isset($product_info))
                  <input type="hidden" name="product_id" value="{{$product_info['id']}}"/>
                @elseif(isset($sketch_details))
                    <input type="hidden" name="order_id" value="{{$sketch_details['order_id']}}"/>
                    <input type="hidden" name="amount" value="{{$amount}}"/>
                    <div class="link-back-to-sketch">
                        <a href="/sketches"><i class="icon-arrow-slide-left"></i>{{$translates['back_to_sketches']}}</a>
                    </div>
                @endif
              <div class="customer-payment__description">
                {{$translates['payment_and_delivery']}}
              </div>
              <div class="customer-payment__price">
                {{$translates['to_pay']}} <span>{{$amount}} €</span>
              </div>
              <div class="customer-payment__price-description">
                {{$translates['delivery_included_price']}}
              </div>
              <div class="customer-payment__delivery-address">
                  <div class="delivery-address__title">{{$translates['enter_delivery_address']}}</div>
                  <input type="text" required name="delivery_address" placeholder="Spain, Canarias island, Adeje, calle el">
              </div>
              <div class="customer-payment__choice-of-payment">
                {{$translates['select_payment_method']}}
              </div>
              <div class="customer-payment__card-selection">
                  <div class="card-selection__item">
                      <div class="item__name">{{$translates['card']}}</div>
                      <div class="item__image"><img src="{{asset('img/lk-images/visa.png')}}" alt=""></div>
                  </div>
                  <div class="card-selection__item">
                      <div class="item__name">PayPal</div>
                      <div class="item__image"><img src="{{asset('img/lk-images/paypal.png')}}" alt=""></div>
                  </div>
              </div>
              <div class="customer-payment__payment-card">
                  <div class="payment-card__front">
                      <div class="front__card-number">
                          <div class="number__inner">
                              <div class="number__description">{{$translates['card_number']}}</div>
                              <input type="text" required placeholder="0000 0000 0000 0000">
                          </div>
                      </div>
                      <div class="front__bottom-line">
                          <div class="front__card-owner">
                              <div class="owner__description">{{$translates['card_owner']}}</div>
                              <input type="text" required placeholder="{{$translates['surname_and_name']}}">
                          </div>
                          <div class="front__card-term">
                              <div class="term__description">{{$translates['validity']}}</div>
                              <input type="text" pattern="[0-9]{2}/[0-9]{2}" required placeholder="{{$translates['month_year_placeholder']}}">
                          </div>
                      </div>
                  </div>
                  <div class="payment-card__back">
                      <div class="back__line"></div>
                      <div class="back__cvv">
                          <div class="cvv__inner">
                              <div class="inner__name">CVV</div>
                              <input type="text" required placeholder="000">
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
	<link rel="stylesheet"  href="{{asset('css/lk-5.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/footer-lk.css')}}" />
	<!-- Load Scripts -->
    <script src="{{asset('libs/anime.min.js')}}"></script>
    <script src="{{asset('js/plugins-lk.js')}}"></script>
  <script>




  </script>
@endsection

@include('layouts.footer_account')
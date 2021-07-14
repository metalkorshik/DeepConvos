@include('layouts.header_account')

@section('content')

    @include('layouts.aside')
    @yield('aside')
	
    <section class="main-area">
        <div class="main-area__inner">
            <form class="accept-review" method="POST" action="{{$action}}">
                @csrf
                <input type="hidden" id="rating" name="rating" value="5">
                <input type="hidden" name="order_id" value="{{$order['id']}}">
                <div class="link-back-to-sketch">
                    <a href="/sketches">
                        <i class="icon-arrow-slide-left"></i>
                      {{$translates['back_to_sketches']}}
                    </a>
                </div>
                <div class="suggested-paid">
                    {{$translates['order_successfully_paid']}}
                </div>
                <div class="order">{{$translates['order']}}: <span>{{$order['title']}}</span></div>
                <div class="paid-price">{{$translates['paid']}} <span>{{$order['amount']}} €</span></div>
                <div class="paid-description">{{$translates['check_emailed_to_you']}}</div>
                <div class="review__content">
                    <div class="review__title">{{$translates['leave_artist_feedback']}}</div>
                    <div class="review__line">
                        <div class="review__rating">
                            <i data-step="1" class="icon-rating active-rating"></i>
                            <i data-step="2" class="icon-rating active-rating"></i>
                            <i data-step="3" class="icon-rating active-rating"></i>
                            <i data-step="4" class="icon-rating active-rating"></i>
                            <i data-step="5" class="icon-rating active-rating"></i>
                        </div>
                        <div class="review__artist">
                            <img src="{{$order['artist']['image']}}" alt="">
                            <span>{{$order['artist']['full_name']}}</span>
                        </div>
                    </div>
                    <textarea name="comment" required cols="30" rows="4" placeholder="{{$translates['enter_your_text']}}"></textarea>
                    <button class="btn--send" type="submit"><a>{{$translates['send']}}</a></button>
                </div>
  
            </form>
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

    let rating = document.getElementById('rating');
    let stars = document.querySelectorAll('.icon-rating');

    for (let index = 0; index < stars.length; index++) {

        stars[index].addEventListener('click', function() {

           let step = this.dataset.step;
           rating.value = step;

            for (let index = 0; index < stars.length; index++) {

                let star = stars[index];
                star.classList.remove('active-rating');
                
                if((index + 1) <= step)
                    star.classList.add('active-rating');
            }

        });

    }


  </script>
@endsection

@include('layouts.footer_account')
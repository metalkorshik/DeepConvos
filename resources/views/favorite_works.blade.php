@include('layouts.header_account')

@section('content')

    @include('layouts.aside')
    @yield('aside')
	
  <section class="main-area">
      <div class="main-area__inner">
          <div class="selected-works">
              <div class="selected-works__wish-list-title">
                {{$translates['favorite_works']}}
              </div>
              <div class="selected-works__wish-list-description">
                {{$translates['count']}}:<span> 10 {{$translates['pieces']}}</span>
              </div>
              <div class="artist-works__gallery">

                @for ($i = 0; $i < 3; ++$i)
                    
                  <div class="gallery-card__body">
                      <div class="gallery-card__inner">
                          <div class="gallery-card__preview">
                              <div class="swiper-container">
                                  <div class="swiper-button-next">
                                      <i class="icon-arrow-slide-right"></i>
                                  </div>
                                  <div class="swiper-button-prev">
                                      <i class="icon-arrow-slide-left"></i>
                                  </div>
                                  <div class="swiper-wrapper">
                                      <div class="swiper-slide"><img src="{{asset('img/artist-portfolio/gallery/gallery-image.jpg')}}" alt=""></div>
                                      <div class="swiper-slide"><img src="{{asset('img/artist-portfolio/gallery/gallery-image-2.jpg')}}" alt=""></div>
                                      <div class="swiper-slide"><img src="{{asset('img/artist-portfolio/gallery/gallery-image-3.jpg')}}" alt=""></div>
                                      <div class="swiper-slide"><img src="{{asset('img/artist-portfolio/gallery/gallery-image-1.jpg')}}" alt=""></div>
                                  </div>
                              </div>
                          </div>
                          <div class="gallery-card__preview-container">
                              <div class="gallery-card__preview-all"><a href="/artist-works">{{$translates['show_all_works']}}</a></div>
                              <div class="gallery-card__wishlist"><img src="{{asset('img/new-collection/like.svg')}}" alt=""></div>
                          </div>
                          <div class="gallery-card__artist">
                              <div class="gallery-card__artist-name"><img src="{{asset('img/artist-portfolio/artist-photo.png')}}" alt="">Юлия Жукова</div>
                              <div class="gallery-card__residence-time">{{$translates['on_site']}} 3 {{$translates['months']}}</div>
                          </div>
                          <div class="gallery-card__artist-description">Создаю шедевры для понимающих людей</div>
                          <div class="gallery-card__rating-panel">
                              <div class="gallery-card__rating"><i class="icon-rating"></i>4 {{$translates['of']}} 5</div>
                              <div class="gallery-card__review"><div class="review__wrapper"><i class="icon-reviews"></i>+100</div></div>
                              <div class="gallery-card__style">

                                  <div class="custom-select" style="width: 130px">
                                      <div class="custom-select__arrow">
                                          <img src="{{asset('img/artist-portfolio/arrow-rounding.svg')}}" alt="">
                                      </div>
                                      <select>
                                          <option value="0"> Стили: 3</option>
                                          <option value="1">Сюрреализм </option>
                                          <option value="2">Абстракция</option>
                                          <option value="3">Классицизм</option>
                                          <option value="4">Реализм</option>
                                      </select>
                                  </div>
                              </div>
                          </div>
                          <div class="gallery-card__contact">
                              <a href="/artist"><p>{{$translates['contact_artist']}}</p></a>
                          </div>
                      </div>
                  </div>
                 
                @endfor

              </div>

          </div>
      </div>
  </section>

	<!-- Load CSS -->
	
    <link rel="stylesheet"  href="{{asset('css/normalize.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/fonts.css')}}" />
    <link rel="stylesheet"  href="{{asset('css/swiper.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/header-lk.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/lk-3.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/footer-lk.css')}}" />
	<!-- Load Scripts -->
    <script src="{{asset('libs/anime.min.js')}}"></script>
    <script src="{{asset('js/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('js/plugins-lk.js')}}"></script>
  <script>


  </script>
@endsection

@include('layouts.footer_account')

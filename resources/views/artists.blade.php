@include('layouts.header_main')

@section('content')
	
 <div class="artist-portfolio">
     <div class="artist__decoration-1">
         <img src="{{asset('img/artist-portfolio/artist-decor.png')}}" alt="">
     </div>
     <div class="artist__decoration-2">
         <img src="{{asset('img/artist-portfolio/artist-decor.png')}}" alt="">
     </div>
     <div class="artist-portfolio__container">
         <div class="artist-portfolio__content">
             <div class="content__image"><img src="{{asset('img/artist-portfolio/artist-portfolio.svg')}}" alt=""></div>
             <div class="content__text">
                 <h2>{{$translates['find_your_artist']}}</h2>
                 <p>{{$translates['created_unique_platform']}}</p>
                 <p>{{$translates['contact_artist_create']}}</p>
             </div>
         </div>
     </div>
 </div>

  <section class="artist-works">
      <form class="artist-works__container" id="artists-sort-form" method="POST" action="/filter-artists">
        <input type="hidden" id="artists-offset" name="offset" value="{{$current_page_number - 1}}">
          <div class="artist-works__title">
              <h2>{{$translates['works_of_artists']}}</h2>
          </div>
          <div class="artist-works__filter">
              <div class="filter__inner">
                    @csrf
                  <div class="filter__style">
                      <div class="custom-select__arrow">
                          <img src="{{asset('img/artist-portfolio/arrow-rounding.svg')}}" alt="">
                      </div>
                      <div class="filter__select-description">
                        {{$translates['styles']}}:
                      </div>
                      <div class="custom-select artist-filter-select" style="width: 256px">
                          <select class="artists-sort-dropdown" name="style_sort" value="{{$current_style_id ?? key($styles)}}" selectedIndex="{{$current_style_index ?? 0}}">
                              @foreach ($styles as $id => $style)
                                  <option value="{{$id}}" {{isset($current_style_id) && $current_style_id == $id ? 'selected' : ''}}>{{$style}}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>

                  <div class="filter__age">
                      <div class="custom-select__arrow">
                          <img src="{{asset('img/artist-portfolio/arrow-rounding.svg')}}" alt="">
                      </div>
                      <div class="filter__select-description">
                        {{$translates['sort']}}:
                      </div>
                      <div class="custom-select artist-filter-select" style="width: 256px">
                          <select class="artists-sort-dropdown" name="artist_sort">
                              <option value="0">{{$translates['by_rating']}}</option>
                              <option value="1">{{$translates['by_age']}}</option>
                          </select>
                      </div>
                  </div>
                </div>
          </div>
          <div class="artist-works__gallery">

            @foreach ($artists as $artist)
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
                                @foreach ($artist['portfolios'] as $portfolio)
                                  <a href="/artist/{{$artist['id']}}" class="swiper-slide"><img src="{{$portfolio['file']}}" alt=""></a>
                                @endforeach
                              </div>
                          </div>
                      </div>
                      <div class="gallery-card__preview-container">
                            <div class="gallery-card__preview-all"><a href="/artist/{{$artist['id']}}">{{$translates['show_all_works']}}</a></div>
                            @if(Auth::check())
                              <div class="gallery-card__wishlist wishlist-artist pointer" data-favorite="{{(int)$artist['is_favorite']}}" data-id="{{$artist['id']}}">
                                <img src="{{ $artist['is_favorite'] ? asset('img/new-collection/like_red.svg') : asset('img/new-collection/like.svg') }}" data-toggledsrc="{{ $artist['is_favorite'] ? asset('img/new-collection/like.svg') : asset('img/new-collection/like_red.svg') }}" alt="">
                            </div>
                            @endif
                      </div>
                      <div class="gallery-card__artist">
                          <div class="gallery-card__artist-name"><img src="{{$artist['image']}}" alt="">{{$artist['name']}} {{$artist['surname']}}</div>
                          <div class="gallery-card__residence-time">{{$translates['on_site']}} {{$artist['duration']}}</div>
                      </div>
                      <div class="gallery-card__artist-description">{{$artist['slogan']}}</div>
                      <div class="gallery-card__rating-panel">
                          <div class="gallery-card__rating"><i class="icon-rating"></i>{{$artist['rating']}} {{$translates['of']}} 5</div>
                          <div class="gallery-card__review"><div class="review__wrapper"><i class="icon-reviews"></i>+{{$artist['comments_count']}}</div></div>
                          <div class="gallery-card__style">

                              <div class="custom-select" style="width: 120px">
                                  <div class="custom-select__arrow">
                                      <img src="{{asset('img/artist-portfolio/arrow-rounding.svg')}}" alt="">
                                  </div>
                                  <select>
                                    <option value="0"> {{$translates['styles']}}: {{count($artist['styles'])}}</option>

                                      @foreach ($artist['styles'] as $id => $style)
                                        <option value="{{$id}}">{{$style}}</option>
                                        @endforeach
                                  </select>
                              </div>
                          </div>
                      </div>
                      <div class="gallery-card__contact">
                          <a href="/artist/{{$artist['id']}}"><p>{{$translates['contact_artist']}}</p></a>
                      </div>
                  </div>
              </div>
            @endforeach

          </div>
          <div class="pagination__block">
              <ul class="pagination">
                  <li class="pagination__item--left"><a href="#"><i class="icon-arrow-slide-left"></i></a></li>

                  @for ($i = 0; $i < $pages_count; $i++)
                      <li class="pagination__item pointer {{ $current_page_number == ($i + 1) ? 'pagination--active' : ''}}" data-offset="{{$i}}"><a>{{$i + 1}}</a></li>
                  @endfor

                  <li class="pagination__item--right"><a href="#"><i class="icon-arrow-slide-right"></i> </a></li>
              </ul>
          </div>
      </form>
  </section>
  <section class="order-progress">
      <div class="order-progress__middle-decoration">
          <img src="{{asset('img/main/middle-deco-2.png')}}" alt="">
      </div>
      <div class="order-progress__middle-decoration-1">
                    <img data-src="{{asset('img/main/middle-deco-1.svg')}}" alt="">
      </div>
      <div class="order-progress__middle-decoration-2">
          <a>
              <p>{{$translates['make_order']}}</p>
              <img data-src="{{asset('img/main/middle-decoration-sun.svg')}}" alt="">

          </a>
      </div>
      <div class="container">
          <div class="order-progress__content">

              <div class="content__title">
                  <h2>{{$translates['how_make_order']}}</h2>
              </div>

              <div class="content__process-select">

                  <div class="select__item">
                      <div class="item__line first-line">
                          <div class="line__decoration">
                              <img data-src="{{asset('img/main/line-decoration.svg')}}" alt="">
                          </div>
                      </div>
                      <div class="item__wrapper">
                          <div class="item__inner">
                              <div class="item__number">
                                  <p>01</p>
                              </div>
                              <div class="item__content ">
                                  <img data-src="{{asset('img/main/select-item/1.svg')}}" alt="">
                                  <p>{{$translates['click_contact_artist']}}</p>
                              </div>
                              <div class="item__button accordion">
                                  <i class="icon-arrow-procces-top "></i>
                              </div>
                          </div>
                          <div class="item-hidden">
                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                  incididunt
                                  ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                                  ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                          </div>
                      </div>
                  </div>

                  <div class="select__item">
                      <div class="item__line">
                          <div class="line__decoration">
                              <img data-src="{{asset('img/main/line-decoration.svg')}}" alt="">
                          </div>
                      </div>
                      <div class="item__wrapper">
                          <div class="item__inner">
                              <div class="item__number">
                                  <p>02</p>
                              </div>
                              <div class="item__content ">
                                  <img data-src="{{asset('img/main/select-item/7.svg')}}" alt="">
                                  <p>{{$translates['register_if_you_not']}}</p>
                              </div>
                              <div class="item__button accordion">
                                  <i class="icon-arrow-procces-top "></i>
                              </div>
                          </div>
                          <div class="item-hidden">
                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                  incididunt
                                  ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                                  ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                          </div>
                      </div>
                  </div>

                  <div class="select__item">
                      <div class="item__line">
                          <div class="line__decoration">
                              <img data-src="{{asset('img/main/line-decoration.svg')}}" alt="">
                          </div>
                      </div>
                      <div class="item__wrapper">
                          <div class="item__inner">
                              <div class="item__number">
                                  <p>03</p>
                              </div>
                              <div class="item__content ">
                                  <img data-src="{{asset('img/main/select-item/3.svg')}}" alt="">
                                  <p>{{$translates['you_will_receive_email']}}</p>
                              </div>
                              <div class="item__button accordion">
                                  <i class="icon-arrow-procces-top "></i>
                              </div>
                          </div>
                          <div class="item-hidden">
                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                  incididunt
                                  ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                                  ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                          </div>
                      </div>
                  </div>

                  <div class="select__item">
                      <div class="item__line">
                          <div class="line__decoration">
                              <img data-src="{{asset('img/main/line-decoration.svg')}}" alt="">
                          </div>
                      </div>
                      <div class="item__wrapper">
                          <div class="item__inner">
                              <div class="item__number">
                                  <p>04</p>
                              </div>
                              <div class="item__content ">
                                  <img data-src="{{asset('img/main/select-item/4.svg')}}" alt="">
                                  <p>{{$translates['receive_sketches_48_hours']}}</p>
                              </div>
                              <div class="item__button accordion">
                                  <i class="icon-arrow-procces-top "></i>
                              </div>
                          </div>
                          <div class="item-hidden">
                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                  incididunt
                                  ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                                  ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                          </div>
                      </div>
                  </div>

                  <div class="select__item">
                      <div class="item__line">
                          <div class="line__decoration">
                              <img data-src="{{asset('img/main/line-decoration.svg')}}" alt="">
                          </div>
                      </div>
                      <div class="item__wrapper">
                          <div class="item__inner">
                              <div class="item__number">
                                  <p>05</p>
                              </div>
                              <div class="item__content ">
                                  <img data-src="{{asset('img/main/select-item/5.svg')}}" alt="">
                                  <p>{{$translates['pay_for_order']}}</p>
                              </div>
                              <div class="item__button accordion">
                                  <i class="icon-arrow-procces-top "></i>
                              </div>
                          </div>
                          <div class="item-hidden">
                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                  incididunt
                                  ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                                  ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                          </div>
                      </div>
                  </div>

                  <div class="select__item">
                      <div class="item__line">
                          <div class="line__decoration">
                              <img data-src="{{asset('img/main/line-decoration.svg')}}" alt="">
                          </div>
                      </div>
                      <div class="item__wrapper">
                          <div class="item__inner">
                              <div class="item__number">
                                  <p>06</p>
                              </div>
                              <div class="item__content ">
                                  <img data-src="{{asset('img/main/select-item/6.svg')}}" alt="">
                                  <p>{{$translates['receive_order']}}</p>
                              </div>
                              <div class="item__button accordion">
                                  <i class="icon-arrow-procces-top "></i>
                              </div>
                          </div>
                          <div class="item-hidden">
                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                  incididunt
                                  ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                                  ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>

	<!-- Load CSS -->
	
    <link rel="stylesheet"  href="{{asset('css/normalize.css')}}" />
     <link rel="stylesheet"  href="{{asset('css/swiper.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/fonts.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/header2.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/main2.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/footer.css')}}" />

	<!-- Load Scripts -->
	 <script src="{{asset('libs/jquery-3.3.1/smothscroll.js')}}"></script>
     <script src="{{asset('libs/jquery-3.3.1/rellax.min.js')}}"></script>
      <script src="{{asset('libs/anime.min.js')}}"></script>
     <script src="{{asset('js/swiper-bundle.min.js')}}"></script>
     <script src="{{asset('js/plugins1.js')}}"></script>
     <script src="{{ asset('js/server.js') }}"></script>
     <script src="{{ asset('js/common.js') }}"></script>

    <script>

        let filters = document.getElementsByClassName('artist-filter-select');

        for (let index = 0; index < filters.length; index++) 
        {
            filters[index].addEventListener('change', e => {
                document.getElementById('artists-sort-form').submit();
            });
        }

    </script>

@endsection

@include('layouts.footer_main')
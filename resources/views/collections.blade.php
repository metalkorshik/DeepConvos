@include('layouts.header_main')

@section('content')
	
   <section class="collection">
       <div class="collection__container">
           <div class="collection__wrapper">
               <div class="collection__title">
                   <h1>{{$translates['trend_collections_2021']}}</h1>
               </div>
               <div class="collection__text">
                   <p>{{$translates['hurry_up_pre_order']}}
                    {{$translates['deadrile_apply_remains']}}</p>
               </div>
               <div class="collection__timer">
                   
                   <div class="timer__item">
                       <div class="timer__number">{{$features['release_date']['days']}}</div>
                       <div class="timer__description">{{$translates['days']}}</div>
                   </div>
                   <div class="timer__item">
                       <div class="timer__number">{{$features['release_date']['hours']}}</div>
                       <div class="timer__description">{{$translates['hours']}}</div>
                   </div>
                   <div class="timer__item">
                       <div class="timer__number">{{$features['release_date']['minutes']}}</div>
                       <div class="timer__description">{{$translates['minutes']}}</div>
                   </div>
               </div>
               <div class="btn--watch-collection hidden">
                   <a href="/collections">{{$translates['show_collections']}}</a>
               </div>
           </div>
       </div>
   </section>

   <section class="for-people">
       <div class="for-people__container">
           <div class="for-people__decoration">
               <img src="{{asset('img/collection/for-people-decoration.png')}}" alt="">
           </div>
           <div class="for-people__title"><h2>{{$translates['collections_unique_people']}}</h2> </div>
           <div class="for-people__content">
               <div class="content__text">
                  <div class="text__inner">
                      <p><span>{{$translates['each_collection_concept']}}</span></p>
                      <p>{{$translates['lices_consist_pijamas']}}</p>
                      <p>
                          {{$translates['wear_each_model']}}</p>
                  </div>
               </div>
               <div class="content__image">
                   <img src="{{asset('img/collection/for-people-image.svg')}}" alt="">
               </div>
           </div>
       </div>
   </section>

   <section class="catalogue">
       <div class="catalogue__decoration">
           <img src="{{asset('img/collection/primary-decoration.png')}}" alt="">
       </div>
       <div class="catalogue__container">

        @foreach ($collections as $collection)
            
           <div class="catalogue__content">
               <div class="content__primary">
                   <h2>{{$collection['name']}}</h2>
                   <p>{{$collection['description']}}</p>
               </div>
           </div>
           <div class="catalogue__product" id="category_products_catalogue_{{$collection['id']}}">

            @foreach ($collection['products'] as $product)
                
               <div class="product-card__body">
                   <div class="product-card__preview">
                       <img src="{{$product['image']}}" alt="">
                   </div>
                   <div class="product-card__description">{{$product['name']}}</div>
                   <div class="product-card__price">
                    {{$product['price']}} €
                   </div>
                   <div class="product-card__to-order">
                       <div class="btn--pre-order">
                           <a href="/checkout/{{$product['id']}}">{{$translates['pre_order']}}</a>
                       </div>
                       <div class="btn--details">
                           <a href="/checkout/{{$product['id']}}"><p>{{$translates['detailed']}} <i class="icon-arrow-slide-right"></i></p></a>
                       </div>
                   </div>
               </div>

            @endforeach

           </div>

           @if ($collection['pages_count'] > 1)

            <div class="pagination__block">
                    <ul class="pagination">
                        <li class="pagination__item--left"><a href="#"><i class="icon-arrow-slide-left"></i></a></li>

                            
                        @for ($i = 0; $i < $collection['pages_count']; $i++)
                            <li class="pagination__item {{ $i == 0 ? 'pagination--active' : ''}}" data-offset="{{$i}}" data-id="{{$collection['id']}}"><a href="#">{{$i + 1}}</a></li>
                        @endfor

                        <li class="pagination__item--right"><a href="#"><i class="icon-arrow-slide-right"></i> </a></li>
                    </ul>
                </div>

            @endif
           
        @endforeach

       </div>
   </section>

  <section class="video-slider">
      <div class="video-slider__title">
          <h2>{{$translates['fashion_show_videos']}}</h2>
      </div>
      <div class="video-slider__container">

          <div class="swiper-container">
              <div class="swiper-wrapper">

                @foreach ($videos as $video)
                    <div class="swiper-slide">
                        <div class="slide-inner">
                            <iframe  src="{{$video}}" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                @endforeach

              </div>
          </div>
          <div class="slider-panel">
              <div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-851773d0783f1a67" aria-disabled="false"><i class="icon-arrow-slide-right"></i></div>
              <div class="swiper-button-prev" tabindex="0" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-851773d0783f1a67" aria-disabled="false"><i class="icon-arrow-slide-left"></i></div>
          </div>
      </div>

  </section>

	<!-- Load CSS -->
	
    <link rel="stylesheet"  href="{{asset('css/normalize.css')}}" />
    <link rel="stylesheet"  href="{{asset('css/swiper.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/fonts.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/header2.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/main5.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/footer.css')}}" />

	<!-- Load Scripts -->
	 <script src="{{asset('libs/jquery-3.3.1/smothscroll.js')}}"></script>
     <script src="{{asset('libs/jquery-3.3.1/rellax.min.js')}}"></script>
      <script src="{{asset('libs/anime.min.js')}}"></script>
     <script src="{{asset('js/swiper-bundle.min.js')}}"></script>
     <script src="{{asset('js/server.js')}}"></script>

<!--     <script src="js/plugins1.js"></script>-->
  <script>

       let swiperVideo = new Swiper('.video-slider .swiper-container', {
            speed: 700,
            pagination: {
                 el: '.swiper-pagination',
                 type: 'bullets',
                 clickable: true,
            },
            navigation: {
                 nextEl: '.video-slider .swiper-button-next',
                 prevEl: '.video-slider .swiper-button-prev',
            },
            breakpoints: {
                 300: {
                      slidesPerView: 1,
                      spaceBetween: 100,
                 },

                 1366: {
                      slidesPerView: 3,
                      spaceBetween: 10,
                 },
            }
       });

       function loadImg() {
            let images = document.getElementsByTagName('img');
            for (let i = 0; i < images.length; i++) {
                 let src = images[i].dataset.src;
                 if (src) {
                      images[i].src = src;
                 }
            }
       }
       window.addEventListener("load", loadImg);

       function mobileOpen() {

            let burger = document.querySelector('.menu-icon-wrapper');
            let mobileMenu = document.querySelector('.mobile-navigation');
            let k = 0;
            burger.addEventListener('click', function () {
                 k++;
                 if (k === 1) {
                      mobileMenu.style.display = 'block';
                      setTimeout(function () {
                           anime({
                                targets: mobileMenu,
                                translateY:  ['-100%','0'],
                                duration: 500,
                                easing: 'easeInQuad'
                           });
                      },150)


                 } else if (k === 2) {
                      setTimeout(function () {
                           anime({
                                targets: mobileMenu,
                                translateY:  ['0','-100%'],
                                duration: 500,
                                easing: 'easeInQuad',
                                complete:function () {
                                     mobileMenu.style.display = 'none';
                                }
                           });
                      },50);
                      k=0;
                 }
            });

       }
       mobileOpen();

       {
            document.querySelector('.menu-icon-wrapper').onclick = function(){
                 document.querySelector('.menu-icon').classList.toggle('menu-icon-active');
            };
       }
       (function () {
            // const btns = document.getElementsByClassName("pagination__item");
            let wrapper = document.querySelectorAll('.pagination');
            let btn = document.querySelectorAll('.pagination__item');

            for (let i = 0; i <wrapper.length ; i++) {
                for (let i = 0; i < btn.length; i++) {

                     btn[i].addEventListener("click", function(ev) {
                          ev.preventDefault();
                          let current = document.getElementsByClassName("pagination--active");
                          if (current.length > 0) {
                               current[0].className = current[0].className.replace("pagination--active", "");
                          }

                          this.className += " pagination--active";

                          server.request('/get-collection-products', { 'collection_id' : this.dataset.id, 'offset': this.dataset.offset })
                          .then(data => {

                            console.log(data);
                            let catalogue = document.getElementById('category_products_catalogue_' + this.dataset.id);

                            let productsCatalogue = '';
                            let translates = [];

                            for(let i = 0; i < data.length; ++i)
                            {
                                product = data[i];

                                let productCard = `
                                    <div class="product-card__body">
                                        <div class="product-card__preview">
                                            <img src="${product['image']}" alt="">
                                        </div>
                                        <div class="product-card__description">${product['name']}</div>
                                        <div class="product-card__price">
                                            ${product['price']} €
                                        </div>
                                        <div class="product-card__to-order">
                                            <div class="btn--pre-order">
                                                <a href="/checkout/${product['id']}">{{$translates['pre_order']}}</a>
                                            </div>
                                            <div class="btn--details">
                                                <a href="/checkout/${product['id']}"><p>{{$translates['detailed']}} <i class="icon-arrow-slide-right"></i></p></a>
                                            </div>
                                        </div>
                                    </div>`;

                                productsCatalogue += productCard;
                            }

                            catalogue.innerHTML = productsCatalogue;
                              
                          });
                     });
                }
            }
       })();

       let lazyLoader = document.querySelectorAll('.lazy');

       function loadBgImg () {
            for (let i = 0; i <lazyLoader.length ; i++) {
                 setTimeout(function () {
                      lazyLoader[i].classList.remove('lazy');
                 },600)
            }
       }
       window.addEventListener("load", loadBgImg);
  </script>
@endsection

@include('layouts.footer_main')
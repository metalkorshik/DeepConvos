@include('layouts.header_main')

@section('content')
	
   <section class="artists-inner">
      <div class="artists-inner__container">
          <div class="artists-inner__content">
              <ul class="breadcrumbs">
                  <li><a href="/">{{$translates['main']}}</a></li>
                  <li><a href="/artists">{{$translates['artists']}} </a></li>
                  <li><a href="/artist">Дарья Шинкина</a></li>
              </ul>
          </div>
      </div>
   </section>

  <section class="artists-primary">
      <div class="artists-primary__container">
          <div class="artists-primary__content">
              <div class="content__artist-description">
                  <div class="artist-description__inner">
                      <div class="artist-description__to-wish-list"><img src="{{asset('img/new-collection/like.svg')}}" alt=""></div>
                      <div class="artist-description__photo">
                          <div class="photo__item"><img src="{{asset('img/artist-inner/artist.png')}}" alt=""></div>
                      </div>
                      <div class="artist-description__name">Дарья шинкина</div>
                      <div class="artist-description__date-registration">{{$translates['on_site']}}: <span>7 {{$translates['months']}}</span></div>
                      <div class="artist-description__age">{{$translates['age']}}: <span>32 {{$translates['years']}}</span></div>
                      <div class="artist-description__education">{{$translates['education']}}: <span>МХПИ, граф. дизайнер</span></div>
                      <div class="artist-description__education-additionally">{{$translates['additional_education']}}: <span> Курсы нетология 3 месяца</span></div>
                      <div class="artist-description__images">
                          <img src="{{asset('img/artist-inner/img.png')}}" alt="">
                          <img src="{{asset('img/artist-inner/img.png')}}" alt="">
                          <img src="{{asset('img/artist-inner/img.png')}}" alt="">
                      </div>
                      <div class="artist-description__contests">{{$translates['participation']}}: <span> Конкурс лучшие дизайнеры России 2020, 3 место</span></div>
                      <div class="artist-description__style">{{$translates['style']}}: <span>Реализм, Сюрреализм, Абстракция</span></div>
                      <div class="artist-description__style-description">В данных стилях работаю уже более 10 лет.
                          Акцент на цвете и форме и на реалистичности изображения, имеет первостепенное значение в моем творчестве.</div>
                      <div class="artist-description__technique">{{$translates['technique']}}: <span>Роспись</span></div>
                      <div class="artist-description__about">{{$translates['about_me']}}: <span> Быстрые сроки работы, пунктуальность, креативность.</span></div>
                      <div class="artist-description__rating">
                          <div class="rating__inner">
                              <i class="icon-rating"></i>
                              {{$translates['rating']}}
                          </div>
                           <span>4 {{$translates['of']}} 5</span>
                      </div>
                      <div class="artist-description__deal">
                          <div class="deal__inner">
                              <i class="icon-ckecked"></i>
                              {{$translates['completed_transactions']}}
                          </div>
                         <span>3</span>
                      </div>
                      <div class="artist-description__executor">
                          <div class="executor__inner">
                              <i class="icon-competition"></i>
                              {{$translates['selected_by_performer']}}
                          </div>
                          <span>3</span>
                      </div>
                      <div class="artist-description__reviews">
                          <div class="reviews__inner">
                              <i class="icon-reviews"></i>
                              {{$translates['reviews']}}
                          </div>
                          <span>3</span>

                      </div>
                      <div class="artist-description__order">
                          <div class="btn--order"><a href="/order">{{$translates['propose_order']}}</a></div>
                      </div>
                  </div>
              </div>
              <div class="content__artist-works">
                  <div class="artist-works__title">
                      <h2>Футболка шелк</h2>
                  </div>
                  <div class="artist-works__link">
                      <a href="/artist-works"><i class="icon-arrow-slide-left"></i>{{$translates['back_to_work']}}</a>
                  </div>
                  <div class="artist-works__technique">
                      <p>{{$translates['technique']}}:<span> Роспись</span> </p>
                  </div>
                  <div class="artist-works__description">
                      Рисовать на ткани решаются те, кто любит тонкую работу и творчество с множеством деталей, цветовых акцентов и демонстрацией далеко не примитивных навыков. Роспись по шелку – это настоящее искусство, техника с множеством принципов и правил, но при этом благодарное занятие. Продукт творчества может стать изюминкой вашего гардероба, а успехи в росписи нередко делают из скромного новичка настоящего художника
                  </div>
                  <div class="artist-works__text">
                    {{$translates['back_to_work']}}:
                  </div>
                  <div class="artist-works__works">
                      <img src="{{asset('img/artist-inner/gallery-image.jpg')}}" alt="">
                      <img src="{{asset('img/artist-inner/gallery-image.jpg')}}" alt="">
                      <img src="{{asset('img/artist-inner/gallery-image.jpg')}}" alt="">
                      <img src="{{asset('img/artist-inner/gallery-image.jpg')}}" alt="">
                  </div>
                  <div class="artist-works__reviews">
                      <div class="reviews__title">{{$translates['customer_feedback']}}</div>
                      <div class="reviews__description">
                          <div class="description__top-line">
                              <div class="name">Алексей П.</div>
                              <div class="date">13.12.2020</div>
                          </div>
                          <div class="description__bottom-line">
                              Рисовать на ткани решаются те, кто любит тонкую работу и творчество с множеством деталей, цветовых акцентов и демонстрацией далеко не примитивных навыков. Роспись по шелку – это настоящее искусство, техника с множеством принципов и правил, но при этом благодарное занятие. Продукт творчества может стать изюминкой вашего гардероба, а успехи в росписи нередко делают из скромного новичка настоящего художника.
                              Спасибо!
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
	<link rel="stylesheet"  href="{{asset('css/main3.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/footer.css')}}" />

	<!-- Load Scripts -->
	 <script src="{{asset('libs/jquery-3.3.1/smothscroll.js')}}"></script>
     <script src="{{asset('libs/jquery-3.3.1/rellax.min.js')}}"></script>
      <script src="{{asset('libs/anime.min.js')}}"></script>
     <script src="{{asset('js/swiper-bundle.min.js')}}"></script>
<!--     <script src="js/plugins1.js"></script>-->
  <script>
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
  </script>
@endsection

@include('layouts.footer_main')
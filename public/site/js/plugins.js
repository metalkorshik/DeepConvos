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

(function () {
     let circle = document.querySelectorAll('.item-hidden');
     let buttons = document.querySelectorAll('.accordion');
     let items = document.querySelectorAll('.select__item');
     let arrow = document.querySelectorAll('.accordion i');

     for (let i = 0; i < buttons.length; i++){
          for (let i = 0; i < circle.length; i++) {
               for (let j = 0; j < items.length ; j++) {
                    for (let ir = 0; ir <arrow.length ; ir++) {
                         let panel = circle[i];
                         let k = 0;
                         buttons[i].addEventListener('click', function (e) {
                              k++;
                              if (k === 1) {
                                   arrow[i].classList.add('active-rotate');
                                   items[i].classList.add('active-border');

                                   panel.style.maxHeight = panel.scrollHeight + "px";
                              } else if (k === 2) {
                                   items[i].classList.remove('active-border');
                                   arrow[i].classList.remove('active-rotate');
                                   panel.style.maxHeight = null;
                                   k=0;
                              }
                         });
                    }
               }

          }
     }

})();

const rellax = new Rellax('.rellax');


function randomStarsOpacity() {
     let anim_els = [];
     let els = document.querySelectorAll('.start-item');
     for ( let i = 0; i < anime.random(20, 25); i++ ) {
          let  index = anime.random(0,els.length - 1);
          anim_els.push(els[index]);
     }
     anime({
          targets:anim_els,
          duration:3500,
          delay: anime.stagger(80),
          opacity:[
               { value: 0.8, duration: 700,delay:0,  },
               { value: 0, duration: 1500,delay:2700 , },
               { value: 0.8, duration: 2700,delay:1000 }
          ],
          easing:'linear',
          complete: randomStarsOpacity
     });
}
randomStarsOpacity();


function randomStarsScale() {
     let anim_els = [];
     let els = document.querySelectorAll('.start-item');
     for ( let i = 0; i < anime.random(2, 5); i++ ) {
          let  index = anime.random(0,els.length - 1);
          anim_els.push(els[index]);
     }
     anime({
          targets:anim_els,
          duration:5400,
          delay: anime.stagger(80),
          r:[
               { value: 1.5, duration: 10,delay:700,  },
               { value: 2.5, duration: 2700,delay:700 , },
               { value: 1.5, duration: 2700,delay:700 }
          ],
          easing:'linear',
          complete: randomStarsScale
     });
}
randomStarsScale();

let clocks =   document.querySelector('.clock-arrow');
function clockAnimation() {
     let prevBtn = document.querySelector('.slider-panel .swiper-button-prev');
     let nextBtn = document.querySelector('.slider-panel .swiper-button-next');

     nextBtn.addEventListener('click', function () {
          anime({
               targets: '.clock-arrow',
               rotate:[-46,5,-46],
               duration:2500,
               easing:'linear',
          });
     })
     prevBtn.addEventListener('click', function () {
          anime({
               targets: '.clock-arrow',
               rotate:[-46,5,-46],
               duration:2500,
               easing:'linear',
          });
     })
}
if (clocks) {
     clockAnimation();
}




function lineMorph () {
     let polyN = anime.timeline({
          easing: "linear",
          duration: 500,

     });

     polyN
          .add({
               targets: '.poly-line',
               d: [
                    { value: [
                              'M0.2,0.6c0,0,695,0,695.2,0.1c55.6-0.4,41.9-0.2,90-0.2c48,0,30-0.5,93.9,0.2\n' +
                              '\tC879.6,0.5,2560,0.5,2560,0.5',
                              'M0.2,0.6c0,0,695,0,695.2,0.1c55.6-0.4,39.9,55.2,87.9,55.2c48,0,32.1-55.9,96-55.2\n' +
                              '\tC879.6,0.5,2560,0.5,2560,0.5'
                         ] },
               ],
          });

}

function lineMorphEnd () {
     let polyN = anime.timeline({
          easing: "linear",
          duration: 500,
     });

     polyN
          .add({
               targets: '.poly-line',
               d: [
                    { value: [
                              'M0.2,0.6c0,0,695,0,695.2,0.1c55.6-0.4,39.9,55.2,87.9,55.2c48,0,32.1-55.9,96-55.2\n' +
                              '\tC879.6,0.5,2560,0.5,2560,0.5',
                              'M0.2,0.6c0,0,695,0,695.2,0.1c55.6-0.4,41.9-0.2,90-0.2c48,0,30-0.5,93.9,0.2\n' +
                              '\tC879.6,0.5,2560,0.5,2560,0.5',
                         ] },
               ],
          });

}


function lineMorphHd () {
     let polyN = anime.timeline({
          easing: "linear",
          duration: 500,

     });

     polyN
          .add({
               targets: '.poly-line-1',
               d: [
                    { value: [
                              'M0.5,11.5c0,0,370.3,0.2,370.5,0.3c55.6-0.4,46.5-0.3,94.5-0.3s33.5-0.4,97.4,0.3\n' +
                              '\tc0.3-0.2,1357.6-0.3,1357.6-0.3',
                              'M0.5,11.5c0,0,370.3,0.2,370.5,0.3c55.6-0.4,39.9,55.2,87.9,55.2s40.1-55.9,104-55.2\n' +
                              '\tc0.3-0.2,1357.6-0.3,1357.6-0.3'
                         ] },
               ],
          });

}

function lineMorphHdEnd () {
     let polyN = anime.timeline({
          easing: "linear",
          duration: 500,
     });

     polyN
          .add({
               targets: '.poly-line-1',
               d: [
                    { value: [
                              'M0.5,11.5c0,0,370.3,0.2,370.5,0.3c55.6-0.4,39.9,55.2,87.9,55.2s40.1-55.9,104-55.2\n' +
                              '\tc0.3-0.2,1357.6-0.3,1357.6-0.3',
                              'M0.5,11.5c0,0,370.3,0.2,370.5,0.3c55.6-0.4,46.5-0.3,94.5-0.3s33.5-0.4,97.4,0.3\n' +
                              '\tc0.3-0.2,1357.6-0.3,1357.6-0.3',
                         ] },
               ],
          });

}



     const circle = document.querySelector('.circle--animation');
     if (circle) {
          circle.addEventListener('mouseenter', function () {
               lineMorph();

          });
     }
     if (circle) {
          circle.addEventListener('mouseleave', function () {
               lineMorphEnd();
          });
     }

     if (circle){
          if (window.innerWidth >= 1900) {
               const circle = document.querySelector('.circle--animation');
               circle.addEventListener('mouseenter', function () {
                    lineMorphHd();

               });
               circle.addEventListener('mouseleave', function () {
                    lineMorphHdEnd();
               });
          }
     }








function orbitDotsAnimation() {
     anime({
          targets: '.orbit-dots',
          opacity: [
               { value: 0, duration: 10,  },
               { value: 1, duration: 1200,delay:1700, },
               { value: 0, duration: 1000,delay:1700 }
          ],
          duration:5000,
          delay: anime.stagger(600),
          easing:'linear',
          complete: orbitDotsAnimation
     });
}
orbitDotsAnimation();


if (window.innerWidth >= 769) {
     {
          // var easings = ['linear', 'easeInCubic', 'easeOutCubic', 'easeInOutCubic'];
          const path = anime.path('.saturn-path');

          anime({
               targets: '.planets--saturn',
               translateX: path('x'),
               translateY: path('y'),
               direction: 'alternate',
               easing: 'linear',
               duration: 7000,
               // delay:500,
               loop: true
          });

     }
     {
          const path = anime.path('.uranus-path');

          anime({
               targets: '.planets--uranus',
               translateX: path('x'),
               translateY: path('y'),
               direction: 'alternate',
               easing: 'linear',
               duration: 7000,
               // delay:500,
               loop: true
          });

     }
}



function mobileOpen() {

     let burger = document.querySelector('.menu-icon-wrapper');
     let mobileMenu = document.querySelector('.mobile-navigation');
     let k = 0;
     burger.addEventListener('click', function () {
          k++;
          if (k === 1) {
               mobileMenu.style.display = 'block'
               setTimeout(function () {
                    anime({
                         targets: mobileMenu,
                         translateY:  ['-100%','0'],
                         duration: 500,
                         easing: 'easeInQuad'
                    });
               },50)


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


function openCollection() {
   let btnOpen = document.querySelector('.planets--uranus');
   let btnClose = document.querySelector('.new-collection__close')
   let collection = document.querySelector('.new-collection');
   let containerCollection = document.querySelector('.new-collection__container');
   let decorationCollection = document.querySelector('.new-collection__decoration img');
   btnOpen.addEventListener('click', function () {
        collection.style.display = 'block';
        let swiper2 = new Swiper('.new-collection .swiper-container', {
             allowTouchMove:false,
             pagination: {
                  el: '.swiper-pagination',
                  type: 'bullets',
                  clickable: true,
             },
             navigation: {
                  nextEl: '.new-collection .swiper-button-next',
                  prevEl: '.new-collection .swiper-button-prev',
             },

             breakpoints: {
                  460: {
                       slidesPerView: 2,
                       spaceBetween: 10,
                  },

                  600: {
                       slidesPerView: 3,
                       spaceBetween: 10,
                  },
                  1366: {
                       slidesPerView: 4,
                       spaceBetween: 0,
                  },
             }
        });
        if (window.innerWidth >= 2500) {
             anime({
                  targets: decorationCollection,
                  delay:100,
                  width:[0+'%',100+'%'],
                  duration: 700,
                  easing: 'easeInQuad',
                  complete:function () {
                       anime({
                            targets: containerCollection,
                            delay:300,
                            opacity:[0,1],
                            duration: 800,
                            easing: 'easeInQuad',
                       });
                  }
             });
        }
        if (window.innerWidth >= 1900) {
             anime({
                  targets: decorationCollection,
                  delay:100,
                  width:[0+'%',115+'%'],
                  duration: 700,
                  easing: 'easeInQuad',
                  complete:function () {
                       anime({
                            targets: containerCollection,
                            delay:300,
                            opacity:[0,1],
                            duration: 800,
                            easing: 'easeInQuad',
                       });
                  }
             });
        }
        if (window.innerWidth >= 1590) {
             anime({
                  targets: decorationCollection,
                  delay:100,
                  width:[0+'%',130+'%'],
                  duration: 700,
                  easing: 'easeInQuad',
                  complete:function () {
                       anime({
                            targets: containerCollection,
                            delay:300,
                            opacity:[0,1],
                            duration: 800,
                            easing: 'easeInQuad',
                       });
                  }
             });
        }
        if (window.innerWidth >= 1300) {
             anime({
                  targets: decorationCollection,
                  delay:100,
                  width:[0+'%',130+'%'],
                  duration: 700,
                  easing: 'easeInQuad',
                  complete:function () {
                       anime({
                            targets: containerCollection,
                            delay:300,
                            opacity:[0,1],
                            duration: 800,
                            easing: 'easeInQuad',
                       });
                  }
             });
        }
        if (window.innerWidth >= 300) {
             anime({
                  targets: decorationCollection,
                  delay:100,
                  width:[0+'%',130+'%'],
                  duration: 700,
                  easing: 'easeInQuad',
                  complete:function () {
                       anime({
                            targets: containerCollection,
                            delay:300,
                            opacity:[0,1],
                            duration: 800,
                            easing: 'easeInQuad',
                       });
                  }
             });
        }


   })
     btnClose.addEventListener('click', function () {

          anime({
               targets:containerCollection,
               delay:100,
               opacity:0,
               duration: 700,
               easing: 'easeInQuad',
               complete:function () {
                    anime({
                         targets: decorationCollection ,
                         delay:300,
                         width:0,
                         duration: 600,
                         easing: 'easeInQuad',
                         complete:function () {
                              collection.style.display = 'none';
                         }
                    });
               }
          });

     });
}
openCollection();

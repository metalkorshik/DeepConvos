

menuAnimation = () => {
     let menuBtn = document.querySelector('.logged a');
     let menu = document.querySelector('.logged-menu');
     let arrow = document.querySelector('.arrows');
     let k = 0
     menuBtn.addEventListener('click',function () {
          k++;
          if (k === 1) {
               arrow.classList.add('active-arrow');
               menu.style.display = 'block';
               anime({
                    targets:'.logged-menu',
                    skewX:[-40,0],
                    translateY: [90,0],
                    opacity:[{ value: 1, duration: 800 },],
                    duration:1500,
                    easing: 'easeOutExpo',
               })
               menuBtn.style.pointerEvents = 'none';
               setTimeout(function () {
                    menuBtn.style.pointerEvents = 'auto';
               },500)
          } else if (k === 2) {
               menuBtn.style.pointerEvents = 'none';
               arrow.classList.remove('active-arrow');
               anime({
                    targets:'.logged-menu',
                    skewX:[0,-40],
                    translateY: [0,90],
                    opacity:[1,0],
                    duration:1000,
                    easing: 'easeInOutExpo',
                    complete:function () {
                         menu.style.display = 'none';
                         setTimeout(function () {
                              menuBtn.style.pointerEvents = 'auto';
                         },500);
                    }
               })
               k=0;
          }

     });
}
menuAnimation();

(function () {
     const wrapper = document.querySelector('.template-navigation');
     const btns = wrapper.getElementsByClassName("menu__item");

     for (let i = 0; i < btns.length; i++) {

          btns[i].addEventListener("click", function(ev) {
               ev.preventDefault();
               let current = document.getElementsByClassName("active--item");
               if (current.length > 0) {
                    current[0].className = current[0].className.replace("active--item", "");
               }
               this.className += " active--item";
          });
     }
})();

(function () {
     const wrapper = document.querySelector('.template-navigation__menu');
     const btns = wrapper.getElementsByClassName("menu__item");

     for (let i = 0; i < btns.length; i++) {

          btns[i].addEventListener("click", function(ev) {
               ev.preventDefault();
               let current = document.getElementsByClassName("active--items");
               if (current.length > 0) {
                    current[0].className = current[0].className.replace("active--items", "");
               }
               this.className += " active--items";
          });
     }
})();

{
     document.querySelector('.burger-menu').onclick = function(){
          document.querySelector('.menu-icon').classList.toggle('menu-icon-active');
     };
}

function mobileOpen() {

     let burger = document.querySelector('.burger-menu');
     let mobileMenu = document.querySelector('.mobile-navigation');
     let k = 0;
     burger.addEventListener('click', function () {
          k++;
          if (k === 1) {
               mobileMenu.style.display = 'block'
               setTimeout(function () {
                    anime({
                         targets: mobileMenu,
                         translateX:  ['-100%','0'],
                         duration: 750,
                         easing: 'cubicBezier(.5, .05, .1, .3)'
                    });
               },50)


          } else if (k === 2) {
               setTimeout(function () {
                    anime({
                         targets: mobileMenu,
                         translateX:  ['0','-100%'],
                         duration: 500,
                         easing: 'cubicBezier(0.700, 0.245, 0.165, 0.900)',
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
LanguageMenu = () => {
     let btnLanguage = document.querySelector('.language');
     let LanguageBlock = document.querySelector('.language a');
     let k = 0;
     btnLanguage.addEventListener('click', function () {
          k++;
          if (k === 1) {
              LanguageBlock.innerHTML = 'EN';
          } else if (k === 2) {
               LanguageBlock.innerHTML = 'RU';
               k=0;

          }
     });
}
LanguageMenu();

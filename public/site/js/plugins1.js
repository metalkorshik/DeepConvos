{
     document.querySelector('.menu-icon-wrapper').onclick = function(){
          document.querySelector('.menu-icon').classList.toggle('menu-icon-active');
     };
}
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


(function () {
     const btns = document.getElementsByClassName("pagination__item");

     for (let i = 0; i < btns.length; i++) {

          btns[i].addEventListener("click", function(ev) {
               ev.preventDefault();
               let current = document.getElementsByClassName("pagination--active");
               if (current.length > 0) {
                    current[0].className = current[0].className.replace("pagination--active", "");
               }
               this.className += " pagination--active";
          });
     }
})();
let swiperPreview = new Swiper('.gallery-card__preview .swiper-container', {
     pagination: {
          el: '.swiper-pagination',
          type: 'bullets',
          clickable: true,
     },
     navigation: {
          nextEl: '.gallery-card__preview .swiper-button-next',
          prevEl: '.gallery-card__preview .swiper-button-prev',
     },
});


var x, i, j, l, ll, selElmnt, a, b, c;
/*look for any elements with the class "custom-select":*/
x = document.getElementsByClassName("custom-select");
l = x.length;
for (i = 0; i < l; i++) {
     selElmnt = x[i].getElementsByTagName("select")[0];
     ll = selElmnt.length;
     /*for each element, create a new DIV that will act as the selected item:*/
     a = document.createElement("DIV");
     a.setAttribute("class", "select-selected");
     a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
     x[i].appendChild(a);
     /*for each element, create a new DIV that will contain the option list:*/
     b = document.createElement("DIV");
     b.setAttribute("class", "select-items select-hide");
     for (j = 1; j < ll; j++) {
          /*for each option in the original select element,
          create a new DIV that will act as an option item:*/
          c = document.createElement("DIV");
          c.innerHTML = selElmnt.options[j].innerHTML;
          c.addEventListener("click", function(e) {
               /*when an item is clicked, update the original select box,
               and the selected item:*/
               var y, i, k, s, h, sl, yl;
               s = this.parentNode.parentNode.getElementsByTagName("select")[0];
               sl = s.length;
               h = this.parentNode.previousSibling;
               for (i = 0; i < sl; i++) {
                    if (s.options[i].innerHTML == this.innerHTML) {
                         s.selectedIndex = i;
                         h.innerHTML = this.innerHTML;
                         y = this.parentNode.getElementsByClassName("same-as-selected");
                         yl = y.length;
                         for (k = 0; k < yl; k++) {
                              y[k].removeAttribute("class");
                         }
                         this.setAttribute("class", "same-as-selected");
                         break;
                    }
               }
               h.click();
          });
          b.appendChild(c);
     }
     x[i].appendChild(b);
     a.addEventListener("click", function(e) {
          /*when the select box is clicked, close any other select boxes,
          and open/close the current select box:*/
          e.stopPropagation();
          closeAllSelect(this);
          this.nextSibling.classList.toggle("select-hide");
          this.classList.toggle("select-arrow-active");
     });
}
function closeAllSelect(elmnt) {
     /*a function that will close all select boxes in the document,
     except the current select box:*/
     var x, y, i, xl, yl, arrNo = [];
     x = document.getElementsByClassName("select-items");
     y = document.getElementsByClassName("select-selected");
     xl = x.length;
     yl = y.length;
     for (i = 0; i < yl; i++) {
          if (elmnt == y[i]) {
               arrNo.push(i)
          } else {
               y[i].classList.remove("select-arrow-active");
          }
     }
     for (i = 0; i < xl; i++) {
          if (arrNo.indexOf(i)) {
               x[i].classList.add("select-hide");
          }
     }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);


let select = document.querySelectorAll('.select-selected');
let icons = document.querySelectorAll('.custom-select__arrow');
for (let i = 0; i <select.length ; i++) {
     for (let j = 0; j <icons.length ; j++) {
          let k = 0;
          select[i].addEventListener('click', function () {
               k++;
               if (k === 1) {
                    icons[i].classList.add('active-icon');
               } else if (k === 2) {
                    icons[i].classList.remove('active-icon');
                    k=0;
               }
          })
     }
}

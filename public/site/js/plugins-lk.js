

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


//template plugins end

function customSelect() {
   let main = document.querySelector('.wish-list-painters');
   if (main){
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
   }
}
customSelect();

{
     let main = document.querySelector('.selected-works');
     if (main){
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

     }
}




{
     let modalSection = document.querySelector('.modal-section');
     if (modalSection){

     function modal() {
          let sections = document.querySelector('.modal-section');
          let overlay = document.querySelector('.modal-overlay');

          return {
               open () {
                    overlay.style.display = 'grid';
                    sections.style.display = 'grid';
                    anime({
                         targets: '.modal-overlay',
                         opacity:[0,1],
                         duration:400,
                         easing:'linear',
                         loop:false,
                         complete:function () {
                         }

                    });

               },
               close () {
                    anime({
                         targets: '.modal-overlay',
                         opacity:[1,0],
                         duration:900,
                         easing:'linear',
                         complete: function(anim) {

                              setTimeout(function () {
                                   overlay.style.display = 'none';
                                   sections.style.display = 'none';
                              },500);
                         },
                    });
               }
          }
     }

     function form(arg){
          let forms = document.querySelector(arg);
          return {
               open () {
                    forms.style.display = 'grid';
                    anime({
                         targets:arg,
                         scale:[0.7,1],
                         opacity:[0,1],
                         duration:400,
                         easing:'linear'
                    });
               },
               close () {
                    anime({
                         targets: arg,
                         scale:[1,0.7],
                         opacity:[1,0],
                         duration:500,
                         easing:'linear',
                         complete: function(anim) {
                              setTimeout(function () {
                                   forms.style.display = 'none';
                                   let end =  document.querySelectorAll('.form-popup');
                                   for (let i = 0; i <end.length ; i++) {
                                        end[i].style.display = 'none';
                                   }
                              },500);

                         }
                    });
               }
          }
     }

     let btnOpen = document.querySelector('.btn-1');
     let btnOpen1 = document.querySelector('.btn-2');
     let btnOpen2 = document.querySelector('.btn-3');
     let btnOpen3 = document.querySelector('.btn-4');
     let closeForm = document.querySelectorAll('.close-form i');
     btnOpen.addEventListener('click', function (ev) {
          modal().open();
          form( '.sketch-form').open();
     })
     btnOpen1.addEventListener('click', function (ev) {
          modal().open();
          form( '.sketch-canceling-form').open();
          console.log("123");
     })
     btnOpen2.addEventListener('click', function (ev) {
          modal().open();
          form( '.sketch-submit-form').open();
     })
     btnOpen3.addEventListener('click', function (ev) {
          modal().open();
          form( '.sketch-cause').open();
     })

     for (let i = 0; i < closeForm.length ; i++) {
          closeForm[i].addEventListener('click', function () {
               modal().close();
               form('.form-popup').close();

          })

     }



     }

}


{
     let main = document.querySelector('.customer-data');
     if (main){
          let inputs = document.querySelectorAll('.change');
          let btnSave = document.querySelectorAll('.main-area__inner .customer-data .customer-data__line .input-wrapper .input-save');
          let btnChange = document.querySelectorAll('.main-area__inner .customer-data .customer-data__line .line__button');

          for (let i = 0; i <btnChange.length ; i++) {
               for (let j = 0; j <inputs.length ; j++) {
                    for (let k = 0; k <btnSave.length ; k++) {
                         btnChange[i].addEventListener('click',function () {
                              inputs[i].removeAttribute("readonly");
                              inputs[i].style.backgroundColor = '#ffffff';
                              inputs[i].style.border = 'solid 1px #7e8ccc';
                              btnSave[i].style.display = 'block';
                         });
                         btnSave[i].addEventListener('click', function () {
                              inputs[i].style.backgroundColor = '#f4f4fc';
                              inputs[i].style.border = 'none';
                              btnSave[i].style.display = 'none';
                         })
                    }

               }

          }

     }
}




{
     let main = document.querySelector('.customer-sketches-received');
     if (main){
          let card = document.querySelectorAll('.gallery-card__middle .swiper-container');

          for (let i = 0; i < card.length ; i++) {
               let prevButton = card[i].parentElement.parentElement.querySelector('.swiper-button-prev');
               let nextButton = card[i].parentElement.parentElement.querySelector('.swiper-button-next');
               card[i].classList.add('s'+i);
               nextButton.classList.add('s'+i);
               prevButton.classList.add('s'+i);
          }

          for (let i = 0; i < card.length ; i++) {

               let swiperCard = new Swiper('.swiper-container.s'+i, {
                    slidesPerView: 1,
                    spaceBetween: 10,
                    allowTouchMove:false,
                    navigation: {
                         nextEl: '.swiper-button-next.s'+i,
                         prevEl: '.swiper-button-prev.s'+i,
                    },
                    breakpoints: {
                         640: {
                              slidesPerView: 1,
                              spaceBetween: 0,
                         },
                         650: {
                              slidesPerView: 2,
                              spaceBetween: 20,
                         },
                    }
               });
          }

     }
}

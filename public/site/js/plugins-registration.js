(function () {
     const btns = document.getElementsByClassName("tabs");

     for (let i = 0; i < btns.length; i++) {

          btns[i].addEventListener("click", function() {
               let current = document.getElementsByClassName("active-tab");
               if (current.length > 0) {
                    current[0].className = current[0].className.replace("active-tab", "");
               }
               this.className += " active-tab";
          });
     }
})();


{
     let visionWrapper = document.querySelector('.input-wrapper__vision');
     let vision = document.querySelector('.vision--vision');
     let hide = document.querySelector('.vision--hide');
     let inputPsw = document.querySelector('.psw');

     let k = 0;
     visionWrapper.addEventListener('click', function () {
          k++;
          if (k === 1) {
               vision.style.display = 'none';
               hide.style.display = 'block';
               inputPsw.setAttribute('type', 'text');
          } else if (k === 2) {
               vision.style.display = 'block';
               hide.style.display = 'none';
               inputPsw.setAttribute('type', 'password');
               k=0;
          }
     });
}

{
     (function () {

          const btn = document.getElementsByClassName("tab-links");
          for (let i = 0; i < btn.length; i++) {
               btn[i].addEventListener("click", function(idx) {
                    let arr2  = document.querySelectorAll('.tab-content');
                    // animation(idx);
                    let current = document.getElementsByClassName("active--block");
                    if (current.length > 0) {
                         current[0].className = current[0].className.replace(" active--block", "");
                    }
                    arr2[idx].className += " active--block";

               }.bind(null,i));
          }

     })();
}
{
    let btnNext = document.querySelector('.form-register .button-wrapper button');
    let formInner = document.querySelector('.form-register-inner');
    let formRegister = document.querySelector('.form-register');
    let tabEnter = document.querySelector('.tab--enter');
    let linkBack = document.querySelector('.user-form__link-back a');
    let wrapperFrom = document.querySelector('.form-wrapper');
    let registerProcess = document.querySelector('.form-register-inner .button-wrapper button');
    let registerComplete = document.querySelector('.register-complete');
    let topMenu = document.querySelector('.form-top');
    let mainForm = document.querySelector('.user-registration .user-form .user-form__inner');


    btnNext.addEventListener('click', function () {
         formRegister.style.display = 'none';
         formInner.style.display = 'block';
    });

    linkBack.addEventListener('click', function (ev) {
       if (wrapperFrom.classList.contains('active--block')){
            formRegister.style.display = 'block';
            formInner.style.display = 'none';
       }
       else {
            ev.preventDefault();
       }
    });

    registerProcess.addEventListener('click', function (ev) {
         wrapperFrom.classList.remove('active--block');
         ev.preventDefault();
         formInner.style.display = 'none';
         topMenu.style.display = 'none';
         registerComplete.style.display = 'block';
         linkBack.style.display = 'none';
         mainForm.style.padding = '16px 16px 0px 16px';
    })

}

window.addEventListener("load", function(event) {
    document.querySelector('.language-switch').addEventListener('click', function(e) {
        server.request('/change-locale', { 'locale' : this.dataset.lang })
        .then(data => {
            location.reload();
        });
    });
});
window.addEventListener("load", function(event) {
    let artistWishlistBtns = document.querySelectorAll('.wishlist-artist');

    for (let index = 0; index < artistWishlistBtns.length; index++) {
        
        artistWishlistBtns[index].addEventListener('click', function (e) {
            
            let id = this.dataset.id;
            let img = this.children[0];
            let url = this.dataset.favorite == 1 ? '/wishlist-artist-remove' : '/wishlist-artist-add';

            server.request(url, { 'id' : id })
            .then(data => {
                this.dataset.favorite = this.dataset.favorite == 1 ? 0 : 1;
                let currentSrc = img.src;
                img.src = img.dataset.toggledsrc;
                img.dataset.toggledsrc = currentSrc;
            });

        });

    }

});
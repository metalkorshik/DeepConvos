var server =
    {
        host: '//' + window.location.hostname,

        test: function () {
            console.dir('1');
        },

        request: function ( api, data = {}, host = 'http://localhost/' )
        {
            let request = '';

            if ( typeof data == 'string' ) {
                request = data;
            }
            else {

                let keys = Object.keys(data);

                for (let index = 0; index < keys.length; index++) {
                    let param = keys[index];
                    if (data[ param ] != null)
                        request += param + '=' + data[ param ] + '&';
                }

                request = request.substring(0, request.length - 1);
            }

            return fetch( api,
                {
                    method: 'POST',
                    headers:
                        {
                            'Content-type': 'application/x-www-form-urlencoded; charset=UTF-8',
                            'X-CSRF-Token' : document.querySelector('meta[name=csrf-token]').content,
                        },
                    body: request
                } )
                .then( response =>
                    {
                        return response.json();
                    }
                );
        },

        upload: ( api, data ) =>
        {
            return fetch( host + api,
                {
                    method: 'POST',
                    body: data
                } )
                .then( response =>
                    {
                        return response.json();
                    }
                );
        }
    };


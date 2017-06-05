var proxy = require('http-proxy-middleware');
module.exports = function (app) {

    var optionsApi = {
        target: 'http://api.tp.com', // target host
        changeOrigin: true,               // needed for virtual hosted sites
        ws: true,                         // proxy websockets
        pathRewrite: {
            '^/api/getCartsGoods.php': 'api.php/Index/getCartsGoods',
            '^/api/postParams.php': 'api.php/Index/postParams',
            '^/api/getParams.php': 'api.php/Index/getParams'
        },
        router: {
            // when request.headers.host == 'dev.localhost:3000',
            // override target 'http://www.example.org' to 'http://localhost:8000'
            'localhost:3000': 'http://api.tp.com'
        }
    };

    var optionsApiMatch = {
        target: 'http://api.tp.com', // target host
        changeOrigin: true,               // needed for virtual hosted sites
        ws: true,                         // proxy websockets
        pathRewrite: function (path, req) {
            /**
             * 正则替换
             *
             api/getCartsGoods.php  to  api.php/Index/getCartsGoods
             api/postParams.php?bbb=1&aaa=2 to  api.php/postParams.php?bbb=1&aaa=2
             */
            return path.replace(/^(\/api)\/(\w+).php/, '$1.php/Index/$2')
        },
        router: {
            // when request.headers.host == 'dev.localhost:3000',
            // override target 'http://www.example.org' to 'http://localhost:8000'
            'localhost:3000': 'http://api.tp.com'
        }
    };

    var optionsYw = {
        target: 'http://api.tp.com', // target host
        changeOrigin: true,               // needed for virtual hosted sites
        ws: true,                         // proxy websockets
        pathRewrite: {
            '^/api/chargeOrder.php': 'index.php/Index/getCartsGoods'     // rewrite path
        },
        router: {
            // when request.headers.host == 'dev.localhost:3000',
            // override target 'http://www.example.org' to 'http://localhost:8000'
            'localhost:3000': 'http://api.tp.com'
        }
    };
    //var exampleProxyApi = proxy(optionsApi);
    //app.use('/api', exampleProxyApi);

    var optionsApiMatch=proxy(optionsApiMatch)
    app.use('/api', optionsApiMatch);

    var exampleProxyYw = proxy(optionsYw);
    app.use('/yw', optionsApiMatch);
}
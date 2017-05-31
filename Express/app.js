const express = require('express');
const ejs  = require('ejs');
const routers= require('./routes/routes.js');
const proxy = require('./routes/proxy.js');
const requests = require('./routes/request.js');
const ace = require('./routes/ace.js');


const app = express();
 



/*设置模板引擎*/
app.engine('html', ejs.__express);
app.set('view engine', 'html');

/*设置代理*/
proxy(app);

/*设置路由*/
routers(app);

/*设置ajax分发*/
requests(app);

/*ace配置信息*/
ace(app);


// app.use(bodyParser({ uploadDir: "./public/upload" }));

/*启动服务*/
var server = app.listen(3000, function () {
  var host = server.address().address;
  var port = server.address().port;
  console.log('Example app listening at http://%s:%s', host, port);
});
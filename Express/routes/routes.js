var upload = require('./upload.js');
module.exports = function (app) {
    app.all('/', function (req, res) {
        // res.send('Hello World!');
        res.render("index/index.html")
    });
    app.all('/user', function (req, res) {
        // res.send('Hello World!');
        res.render("user/index.html")
    });
    app.post('/upload', upload.upload);
}

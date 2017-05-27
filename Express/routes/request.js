/**
 * Created by Administrator on 2017/5/25.
 */
const request = require('request');
const bodyParser = require('body-parser')
const domain='http://api.tp.com/';
const suffix=".php";
module.exports = function (app) {
    app.use(bodyParser.urlencoded({ extended: false }));

    app.all('/toget' + suffix, function(req, res) {
        var url = domain + "api.php/Index/getParams";
        var data = req.query;
        request.post({url:url, form: data}, function (error, response, body) {
            if (!error && response.statusCode == 200) {
                res.send(body)
            }else{
                res.send(response)
            }
        })
    });
    app.all('/topost' + suffix, function(req, res) {
        var url = domain + "api.php/Index/postParams";
        var data = req.body;
        request.post({url:url, form: data}, function (error, response, body) {
            if (!error && response.statusCode == 200) {
                res.send(body)
            }else{
                res.send(response)
            }
        })
    });
}
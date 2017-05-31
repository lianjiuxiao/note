/**
 * Created by Administrator on 2017/5/31.
 */
const express = require('express');
module.exports = function (app) {
    // app.use(express.static('views'));
    app .use('/html/',express.static('views'));

    app.all('/html/login.html', function (req, res) {
        // res.send('Hello World!');
        res.render('ace/login.html')
    });
    app.all('/html/index.html', function (req, res) {
        // res.send('Hello World!');
        res.render('ace/index.html')
    });
}
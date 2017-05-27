/**
 * Created by Administrator on 2017/5/25.
 */
exports.upload = function (req, res) {
    console.log(req.files);
    var patharray = req.files.file.path.split("\\");
    res.send(patharray[patharray.length-1]);
}  
var parent;
function doTests(p){
  parent = p;
  createTests('1701191002741');
}
function createTests(code){
  var testbox = document.createElement("div");
  testbox.className = "testbox";

  var format = (typeof options !== "undefined" && options.format) || "auto";

  testbox.innerHTML = '<img class="barcode"/>';
  try{
    JsBarcode(testbox.querySelector('.barcode'), code, {format: "EAN13", width: 2, fontSize: 16});
  }
  catch(e){
    testbox.className = "errorbox";
    testbox.onclick = function(){
      throw e;
    }
  }
  parent.appendChild(testbox);
}


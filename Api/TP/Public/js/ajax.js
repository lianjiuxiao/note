//目的:兼容性,方便,快捷

	//创建兼容性的XHR对象的函数
	function createXHR(){
		//非IE
		if(window.XMLHttpRequest){
			return new XMLHttpRequest();
		}else if(window.ActiveXObject){//IE
			//版本数组
			var vison=['Microsoft.XMLHTTP', 'MSXML.XMLHTTP', 'Microsoft.XMLHTTP', 'Msxml2.XMLHTTP.7.0', 'Msxml2.XMLHTTP.6.0', 'Msxml2.XMLHTTP.5.0', 'Msxml2.XMLHTTP.4.0', 'MSXML2.XMLHTTP.3.0', 'MSXML2.XMLHTTP'];
			//循环尝试创建对象
			for(var i=0;i<vison.length;i++){
				var xhrObj=new ActiveXObject(vison[i]);
				if(typeof xhrObj=='object'){
					return xhrObj;
				}
			}
		}else{//其他
			return false;
		}

	}
	
	//创建一个XHR对象
	var XHR=createXHR();
	
	//创建一个ajax的工具对象
	var ajax={
		get:function(url,callback){
			//打开ajax链接
			XHR.open('get',url);
			//发送请求
			XHR.send(null);
			//注册事件 判断  取回结果等操作
			//调用自身的方法处理返回数据
			this.getResult(callback);
		},
		post:function(url,data,callback){
			//打开ajax链接
			XHR.open('post',url);
			//发送header头信息
			XHR.setRequestHeader('content-type','application/x-www-form-urlencoded');
			//发送请求
			XHR.send(data);
			//调用自身的方法处理返回数据
			this.getResult(callback);
			
		},
		getResult:function(callback){
			//注册事件 判断  取回结果等操作
			XHR.onreadystatechange=function(){
				//判断是否发送成功
				if(XHR.readyState==4){
					//判断服务器是否返回成功
					if(XHR.status==200){
						callback(XHR.responseText);
					}
				}
			}
		}
		
	}
	
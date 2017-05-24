(function($){
	//鼠标点击事件
   $(document).click(function(event){
	   $(".singleSelect-content").hide();
   });
   $.fn.singleSelect= function(settings){     
    //默认参数
    var defaultSettings = {
    	id:'',
    	width:'90%',
		valItem:'',
		txtItem:'',
		selectItem:'',
		render:null,
		changeFunction:null
    };
           
    /* 合并默认参数和用户自定义参数 */
    settings = $.extend(defaultSettings,settings);
           
    return this.each(function(){
    	//代码
		var selObject = $(this);//获取当前对象
		var selId = selObject.attr("id");//得到select id属性
		var valArray = new Array();//保存value
		var txtArray = new Array();//保存text
		var firstOption = selObject.find("option").eq(0);
		var flag = false;
		if(firstOption.val()=="tellhow"){
			flag = true;
		}
		//遍历取出里面的所有value和Text
		selObject.find("option").each(function(index){
			if(flag){
				if(index>0){
					//从第二项开始 
					valArray[index-1] = $.trim($(this).val());
					txtArray[index-1] = $.trim($(this).text());
					if($(this).attr("selected")){
						settings.selectItem = $.trim($(this).val()); 		
					}
				}				
			}else{
				valArray[index] = $.trim($(this).val());
				txtArray[index] = $.trim($(this).text());
				if($(this).attr("selected")){
					settings.selectItem = $.trim($(this).val()); 		
				}
			}
		}); 
		var selParent = selObject.parent();
		selObject.remove();//移除select
		settings.id = selId;
		settings.valItem = valArray;
		settings.txtItem = txtArray;
		settings.render = selParent;
		//初始化下拉列表
		$.initSingleSelect(settings);
    });	
  };  
  //得到选中的下拉列表值
  $.fn.getsingleSelectValue = function(){
	var $cId = this.attr("id");
	var $id = "#"+$cId+"_singleSelect_content";	
	var $selectDiv = $($id).find(".singleSelectCheckDiv_select");
	var $selectVel = $selectDiv.find(".singleSelectCheckValue");
	return $.trim($selectVel.html());	  
 };
  //得到选中的下拉列表内容
  $.fn.getsingleSelectText = function(){
    var $cId = this.attr("id");
	var $id = "#"+$cId+"_singleSelect_input";
	return $.trim($($id).val());	  
 };
 //得到所有下拉列表的值
 $.fn.getAllSingleSelectValue = function(){
	var $cId = this.attr("id");
	var valarray = new Array();
	$("#"+$cId+"_singleSelect_content .singleSelectCheckValue").each(function(index){
		valarray[index] = $.trim($(this).html());
	});
	return valarray;
 };
 //得到所有下拉列表的内容
 $.fn.getAllSingleSelectText = function(){
	var $cId = this.attr("id");
	var valarray = new Array();
	$("#"+$cId+"_singleSelect_content .singleSelectCheckSpan").each(function(index){
		valarray[index] = $.trim($(this).html());
	});
	return valarray;	 
 };
 //动态修改单选下拉列表的值
 $.fn.changeSingleSelectContent = function(settings){
	  //默认参数
    var defaultSettings = {
    	valItem:'',
		txtItem:'',
		selectItem:'',
		changeFunction:null
    };
           
    /* 合并默认参数和用户自定义参数 */
    settings = $.extend(defaultSettings,settings);
	var $cId = this.attr("id");
	//清空输入框内的值
	var selInput = $("#"+$cId+"_singleSelect_input");
	selInput.val("");
	//清空列表中的内容
	var $content = $("#"+$cId+"_singleSelect_content");
	$content.children().remove();
	//设置高度
	if(settings.valItem.length>8){
		$content.css("height",8*27);//设置高		
	}else{
		$content.css("height",settings.valItem.length*27);//设置高		
	}
	if(settings.selectItem!=null&&settings.selectItem!=""){
		settings.selectItem = $.trim(settings.selectItem);		
	}	
	if(settings.changeFunction==null||settings.changeFunction==""){
		var strFunc = $.trim($("#"+$cId).attr("title"));
		settings.changeFunction = strFunc;
	}
	var len = settings.valItem.length;
	var htmlArray = [];
	$.each(settings.valItem,function(i){
		var selectStr = "";
		var itemv = settings.valItem[i];
		var itemt = settings.txtItem[i];
		if(settings.selectItem!=""&&settings.selectItem!=null){
			if(itemv==settings.selectItem){
				selInput.val(itemt);
				selectStr = " singleSelectCheckDiv_select";
			}
		}
		htmlArray[i]= '<div class="singleSelectCheckDiv'+selectStr+'" onmouseenter="singleSelectItemMouseEnter(\''+$cId+'\',this,event)" onclick="singleSelectClickItem(\''+$cId+'\',this,\''+settings.changeFunction+'\')"><span class="singleSelectCheckValue" style="display:none;">'+itemv+'</span><span style="float:left;margin-left:5px;margin-top:9px;" class="singleSelectCheckSpan">'+itemt+'</span></div>';				
	});
	$content.append(htmlArray.join(""));
	//关闭缓冲
	$("#"+$cId).singleSelectLoaddingOff();
 };
  //动态创建多选下拉列表
  $.fn.createSingleSelect = function(settings){
    //默认参数
    var defaultSettings = {
		id:'',
    	width:'90%',
		valItem:'',
		txtItem:'',
		selectItem:'',
		render:null,
		changeFunction:null
    };       
    /* 合并默认参数和用户自定义参数 */
    settings = $.extend(defaultSettings,settings);	
	if(settings.render==null){
		settings.render = this;		
	}	
	//初始化下拉列表
    $.initSingleSelect(settings);
  };
  //初始化下拉列表
  $.initSingleSelect = function(settings){	
	 if(settings.id==''||settings.render==null){return;}
	 settings.selectItem = $.trim(settings.selectItem);
	 var strFunc = "";
	 if(settings.changeFunction!=null&&settings.changeFunction!=""){
		strFunc = settings.changeFunction;
	 }
 	 var selHtml = '<div style="display:none;" id="'+settings.id+'" title="'+strFunc+'"></div><div style="margin-left:2px;"><div class="singleSelect-loader" id="'+settings.id+'_singleSelect_loader">数据加载中...</div><input type="text" class="singleSelect-input" style="width:'+settings.width+'" id="'+settings.id+'_singleSelect_input" onkeyup="singleSelectInputKeyUp(\''+settings.id+'\',this,event)"/><div class="singleSelect-img" id="'+settings.id+'_singleSelect_img" onclick="singleSelectContentShow(\''+settings.id+'\',event)"/></div>';	
	 settings.render.append(selHtml);//替换新的
	 var selHeight = 0;
	 if(settings.valItem.length>8){
	 	selHeight = 8*27;		
	 }else{
		selHeight = settings.valItem.length*27;	
	 }
	 var selInput = $("#"+settings.id+"_singleSelect_input");
	 var cWidth = selInput.width()+24;//下拉列表的宽
	 var htmlArray = [];
	 htmlArray[0] = '<div class="singleSelect-content" id="'+ settings.id+'_singleSelect_content" style="height:'+selHeight+'px;width:'+cWidth+'px;">';
	 var len = settings.valItem.length;
	 $.each(settings.valItem,function(i){
		 var selectStr = "";
			var itemv = settings.valItem[i];
			var itemt = settings.txtItem[i];
			if(settings.selectItem!=""&&settings.selectItem!=null){
				if(itemv==settings.selectItem){
					selInput.val(itemt);
					selectStr = " singleSelectCheckDiv_select";
				}
			}
			htmlArray[i+1] = '<div class="singleSelectCheckDiv'+selectStr+'" onmouseenter="singleSelectItemMouseEnter(\''+settings.id+'\',this,event)" onclick="singleSelectClickItem(\''+settings.id+'\',this,\''+settings.changeFunction+'\')"><span class="singleSelectCheckValue" style="display:none;">'+itemv+'</span><span style="float:left;margin-left:5px;margin-top:9px;" class="singleSelectCheckSpan">'+itemt+'</span></div>';
	 });
	htmlArray[len+2] = "</div>";
	$("body").append(htmlArray.join(""));//展示内容
  };
  //缓冲打开
  $.fn.singleSelectLoaddingOn = function(){
	var $cId = this.attr("id");
	var $load = $("#"+$cId+"_singleSelect_loader");//缓冲div	
	if($load.is(":hidden")){
		var $parent = $load.parent();
		$load.css("left",$parent.offset().left);
		$load.css("top",$parent.offset().top);
		$load.css("width",$parent.width()-2);
		$load.show();	
	}
  };
   //缓冲关闭
  $.fn.singleSelectLoaddingOff = function(){
	var $cId = this.attr("id");
	var $load = $("#"+$cId+"_singleSelect_loader");//缓冲div
	if(!$load.is(":hidden")){
		$load.hide();	
	}
  };
  //清空下拉列表的值
  $.fn.singleSelectInputClear = function(){
	var $cId = this.attr("id");
	$("#"+$cId+"_singleSelect_input").val("");
	$("#"+$cId+" .singleSelectCheckDiv").removeClass("singleSelectCheckDiv_select");
  };
  //更改下拉列表框的内容
  $.fn.singleSelectInputSetText = function(txt){
	  var $cId = this.attr("id");
	  var flag = false;
	  $("#"+$cId+"_singleSelect_content .singleSelectCheckDiv").removeClass("singleSelectCheckDiv_select");	
	  $("#"+$cId+"_singleSelect_content .singleSelectCheckSpan").each(function(){
		if($.trim($(this).html())==txt){
			$(this).parent().addClass("singleSelectCheckDiv_select");	
			$("#"+$cId+"_singleSelect_input").val(txt);
			flag = true;
		}													   
	  });
	  if(!flag){
			$("#"+$cId+"_singleSelect_input").val(txt);
	  }
  };
  //下拉列表聚焦
  $.fn.singleSelectInputFocus = function(){
	  var $cId = this.attr("id");
	  $("#"+$cId+"_singleSelect_input").focus();
  };
})(jQuery);
 //点击按钮展示下拉列表
 function singleSelectContentShow(cId,eve){
	var contentList = $("#"+cId+"_singleSelect_content");	
	if(contentList.is(":hidden")){
	 $(".singleSelect-content").hide();
	 //显示
	 contentList.show();
	 var cInput = $("#"+cId+"_singleSelect_input");
	 var cLeft = cInput.offset().left;//局左
	 var cTop = cInput.offset().top+cInput.outerHeight();//局上
	 var cWidth = cInput.width()+24;//下拉列表的宽
	 contentList.css("left",cLeft);
	 contentList.css("top",cTop);
	 contentList.css("width",cWidth);
	 cInput.focus();
	}else{
	 //隐藏	
	 contentList.hide();
	}
	var  eve = eve || window.event;
    if(eve.stopPropagation) { //W3C阻止冒泡方法
       eve.stopPropagation();
    } else {
       eve.cancelBubble = true; //IE阻止冒泡方法
    }
 }
 //鼠标移入某项
 function singleSelectItemMouseEnter(id,obj,eve){
	 $("#"+id+"_singleSelect_content .singleSelectCheckDiv").removeClass("singleSelectCheckDiv_hover");										   
	 $(obj).addClass("singleSelectCheckDiv_hover");
	 var  eve = eve || window.event;
     if(eve.stopPropagation) { //W3C阻止冒泡方法
        eve.stopPropagation();
     } else {
        eve.cancelBubble = true; //IE阻止冒泡方法
     }
 }
  //点击下拉列表某项
  function singleSelectClickItem(cId,obj,func){
	  var cInput = $("#"+cId+"_singleSelect_input");
	  var cTxt = $.trim($(obj).find(".singleSelectCheckSpan").html());
   	  cInput.val(cTxt);
	  $("#"+cId+"_singleSelect_content .singleSelectCheckDiv").removeClass("singleSelectCheckDiv_select");
	  $(obj).addClass("singleSelectCheckDiv_select");
	  //外部onchange事件
	  if(func!=null&&func!=""){
		eval(func);	
	  }	
  }
	//文本框输入内容
  function singleSelectInputKeyUp(cId,obj,eve){
	    cId +="_singleSelect_content";
		var val = $.trim($(obj).val());		
		if(eve.keyCode==8){
		//删除	
			if(val==""){
				$("#"+cId+" .singleSelectCheckDiv_select").removeClass("singleSelectCheckDiv_select");
			}
		}else if(eve.keyCode==37||eve.keyCode==39){
		//左右			
			return;
		}else if(eve.keyCode==38){
		//向上
			var $index = 0;
			var $allshowdiv = $("#"+cId+" > .singleSelectCheckDiv:visible");
			var $focusDiv = $("#"+cId).find(".singleSelectCheckDiv_hover");//当前聚焦的div
			if($focusDiv.html()==undefined){
				var $selectDiv = $("#"+cId).find(".singleSelectCheckDiv_select");//当前选中的div
				if($selectDiv.html()!=undefined){
					$index = $allshowdiv.index($selectDiv)-1;	
				}					
			}else{
				$index = $allshowdiv.index($focusDiv)-1;
			}				
			var $count = $allshowdiv.size();
			if($index<$count&&$index>-1){
				$focusDiv.removeClass("singleSelectCheckDiv_hover");
				var zz = parseInt($index/8);
				$("#"+cId).scrollTop(zz*8*27);						
				$allshowdiv.eq($index).addClass("singleSelectCheckDiv_hover");
			}
			return;
		}else if(eve.keyCode==40){
		//向下
			var $index = 0;
			var $allshowdiv = $("#"+cId+" > .singleSelectCheckDiv:visible");
			var $focusDiv = $("#"+cId).find(".singleSelectCheckDiv_hover");//当前聚焦的div
			if($focusDiv.html()==undefined){
				var $selectDiv = $("#"+cId).find(".singleSelectCheckDiv_select");//当前选中的div
				if($selectDiv.html()!=undefined){
					$index = $allshowdiv.index($selectDiv)+1;	
				}					
			}else{
				$index = $allshowdiv.index($focusDiv)+1;
			}				
			var $count = $allshowdiv.size();
			if($index<$count&&$index>-1){
				$focusDiv.removeClass("singleSelectCheckDiv_hover");
				var zz = parseInt($index/8);
				$("#"+cId).scrollTop(zz*8*27);						
				$allshowdiv.eq($index).addClass("singleSelectCheckDiv_hover");
			}
			return;
		}else if(eve.keyCode==13){
		//回车
			var $focusDiv = $("#"+cId).find(".singleSelectCheckDiv_hover");//当前聚焦的div
			if($focusDiv.html()!=undefined){
				$focusDiv.click();
			}
			return;
		}			
		//展示内容
		var count = 0;
		var cObj = null;
		var txt = "";
		var qp = "";
		var jp = "";
		$("#"+cId+" .singleSelectCheckSpan").each(function(){
			cObj = $(this).parent();			
			txt = $(this).html().toLowerCase();
			qp = ConvertPinyin(txt);//全拼
			jp = makePy(txt).toString().toLowerCase();//取汉字首字母
			if(txt.indexOf(val)!=-1||qp.indexOf(val)!=-1||jp.indexOf(val)!=-1){
				cObj.show();
				count +=1;
			}else{
				cObj.hide();
			}
		 });
		//下拉框高度
		if(count>8){
			$("#"+cId).css("height",8*27);//设置高		
		}else{
			$("#"+cId).css("height",count*27);//设置高		
		}
		var cContent = $("#"+cId);
		if(cContent.is(":hidden")){//没显示时显示下拉框
			 var cLeft = $(obj).offset().left;//局左
			 var cTop = $(obj).offset().top+$(obj).outerHeight();//局上
			 var cWidth = $(obj).width()+24;//下拉列表的宽
			 cContent.css("left",cLeft);
	 		 cContent.css("top",cTop);
	 		 cContent.css("width",cWidth);
			 cContent.show();		
		}
	};
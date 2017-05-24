// JavaScript Document 多选插件
(function($){
	//鼠标点击事件
	$(document).click(function(event){
		$(".multiselect-content").hide();
	});	
   $.fn.multiseSelect= function(settings){     
    //默认参数
    var defaultSettings = {
    	id:'',
    	width:'90%',
		valItem:'',
		txtItem:'',
		selectItem:'',
		disableCheck:false,
		flagStr:'',
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
		var multiseArrayCheck = [];
		var m = 0;
		//遍历取出里面的所有value和Text
		selObject.find("option").each(function(index){
			valArray[index] = $.trim($(this).val());
			txtArray[index] = $.trim($(this).text());
			if($(this).attr("selected")){
				multiseArrayCheck[m] = $.trim($(this).val());	
				m +=1;
			}			
		}); 
		var selParent = selObject.parent();
		selObject.remove();//移除select
		settings.id = selId;
		settings.valItem = valArray;
		settings.txtItem = txtArray;
		settings.render = selParent;	
		settings.selectItem = multiseArrayCheck;
		//初始化下拉列表
		$.initMultiseSelect(settings);
	});
   };
  //动态创建多选下拉列表
  $.fn.createMultiseSelect = function(settings){
	//默认参数
    var defaultSettings = {
		id:'',
    	width:'90%',
		valItem:'',
		txtItem:'',
		selectItem:'',
		disableCheck:false,
		flagStr:'',
		render:null,
		changeFunction:null
    };       
    /* 合并默认参数和用户自定义参数 */
    settings = $.extend(defaultSettings,settings);	
	if(settings.render==null){
		settings.render = this;		
	}	
	//初始化下拉列表
    $.initMultiseSelect(settings);  
  };
  //动态修改多选下拉列表的值
  $.fn.changeMultiseSelectContent = function(settings){
	//默认参数
    var defaultSettings = {
		valItem:'',
		txtItem:'',
		selectItem:'',
		disableCheck:false,
		flagStr:'',
		changeFunction:null
    };       
    /* 合并默认参数和用户自定义参数 */
    settings = $.extend(defaultSettings,settings);	
	var $cId = this.attr("id");
	//清空列表中的内容
	var $content = $("#"+$cId+"_multiselect_content");
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
	var htmlArray = [];
	var $choseItems = "";	
	var $disableCheck = "";
	 //下拉列表不能选择
	 if(settings.disableCheck){
		$disableCheck = 'disabled="disabled"';
	 }
	 $.each(settings.valItem,function(i){
		var contentdiv = "";
		var selectFlag = "";
		var checkFlag = "";
		if(settings.selectItem!=null&&settings.selectItem!=""){
			$.each(settings.selectItem,function(m){
				if(settings.valItem[i]==settings.selectItem[m]){
					$choseItems = $choseItems + settings.txtItem[i]+",";
					selectFlag = ' multiseSelectCheckDiv_select';
					checkFlag = ' checked="checked"';
				}	
			});
		}
		htmlArray[i] = '<div class="multiselectCheckDiv '+selectFlag+'" onmouseenter="multiseSelectMouseEnter(\''+$cId+'\',this,event)" onclick="multiseSelectCheckDivClick(\''+$cId+'\',this,event,\''+settings.changeFunction+'\','+settings.disableCheck+')" ><span style="float:left;margin-left:2px;margin-top:8px;color:red">'+settings.flagStr+'</span><input type="checkbox" value="'+settings.valItem[i]+'" style="float:left;margin:3px;" class="multiselectCheckBox"'+checkFlag+$disableCheck+' onclick="multiseSelectCheckBoxClick(\''+$cId+'\',this,\''+settings.changeFunction+'\',event)"/><div style="float:left;margin-left:2px;margin-top:8px;" class="multiselectCheckSpan">'+ settings.txtItem[i]+'</div></div>';	
	 });
	 $content.append(htmlArray.join(""));//展示内容
	if($choseItems!=""){
		$choseItems = $choseItems.substring(0,$choseItems.length-1);	
	}
	$("#"+$cId+"_multiselect_input").val($choseItems);
	//关闭缓冲
	$("#"+$cId).multiseSelectLoaddingOff();
  };
  //初始化下拉列表
  $.initMultiseSelect = function(settings){
	if(settings.id==''||settings.render==null){return;} 
	var strFunc = "";
	if(settings.changeFunction!=null&&settings.changeFunction!=""){
		strFunc = settings.changeFunction;
	}
	 var selHtml = '<div style="display:none;" id="'+settings.id+'" title="'+strFunc+'"></div><div style="margin-left:2px;"><div class="multiseSelect-loader" id="'+settings.id+'_multiseSelect_loader">数据加载中...</div><input type="text" class="multiselect-input" style="width:'+settings.width+'" id="'+settings.id+'_multiselect_input" onfocus="multiseSelectInputFocus(this)" onkeyup="multiseSelectInputKeyUp(\''+settings.id+'\',this,event)"/><div class="multiselect-img" id="'+settings.id+'_multiselect_img" onclick="multiseSelectContentShow(\''+settings.id+'\',event)"/></div>';	
	 settings.render.append(selHtml);//替换新的
	 var selHeight = 0;
	 if(settings.valItem.length>8){
	 	selHeight = 8*27;		
	 }else{
		selHeight = settings.valItem.length*27;	
	 }
	 var selInput = $("#"+settings.id+"_multiselect_input");
	 var cWidth = selInput.width()+24;//下拉列表的宽
	 var htmlArray = [];
	 htmlArray[0] = '<div class="multiselect-content" id="'+ settings.id+'_multiselect_content" style="height:'+selHeight+'px;width:'+cWidth+'px;">';
	 var $choseItems = "";
	 var $disableCheck = "";
	 //下拉列表不能选择
	 if(settings.disableCheck){
		$disableCheck = 'disabled="disabled"';
	 }	 
	 var len = settings.valItem.length;
	 var selectFlag = '';
	 var checkFlag = '';
	 $.each(settings.valItem,function(i){		
		if(settings.selectItem!=null&&settings.selectItem!=""){
			$.each(settings.selectItem,function(m){
				if(settings.valItem[i]==settings.selectItem[m]){
					$choseItems = $choseItems + settings.txtItem[i]+",";
					selectFlag = ' multiseSelectCheckDiv_select';
					checkFlag = ' checked="checked"';
				}	
			});			
		}
		htmlArray[i+1] = '<div class="multiselectCheckDiv '+selectFlag+'" onmouseenter="multiseSelectMouseEnter(\''+settings.id+'\',this,event)" onclick="multiseSelectCheckDivClick(\''+settings.id+'\',this,event,\''+settings.changeFunction+'\','+settings.disableCheck+')"><span style="float:left;margin-left:2px;margin-top:8px;color:red">'+settings.flagStr+'</span><input type="checkbox" value="'+settings.valItem[i]+'" style="float:left;margin:3px;" class="multiselectCheckBox"'+checkFlag+$disableCheck+' onclick="multiseSelectCheckBoxClick(\''+settings.id+'\',this,\''+settings.changeFunction+'\',event)"/><div style="float:left;margin-left:2px;margin-top:8px;" class="multiselectCheckSpan">'+ settings.txtItem[i]+'</div></div>';	
		selectFlag = '';
		checkFlag = '';
	 });
	 htmlArray[len+2] = "</div>";
	$("body").append(htmlArray.join(""));//展示内容
	if($choseItems!=""){
		$choseItems = $choseItems.substring(0,$choseItems.length-1);	
	}
	selInput.val($choseItems);
  };
  //得到选中的value
  $.fn.getMultiseSelectCheckValue = function(){
	 var $cId = this.attr("id");
	 var $id = $cId+"_multiselect_content";	
	 var val = "";
	 $("#"+$id+" input[type='checkbox']").each(function(){
		if($(this).is(":checked")){
			val = val + $(this).val()+",";
		}											   
	 });
	 if(val!=""){
		val = val.substring(0,val.length-1);	
	 }
	return val;
  };
  //得到选中的text
  $.fn.getMultiseSelectCheckText = function(){
	  var $cId = this.attr("id");
	  var $id = $cId+"_multiselect_content";	
	  var val = "";
	  $("#"+$id+" input[type='checkbox']").each(function(){
		  if($(this).is(":checked")){
			val = val + $.trim($(this).parent().find(".multiselectCheckSpan").eq(0).html())+",";
		  }											   
	   });
	   if(val!=""){
	   	 val = val.substring(0,val.length-1);	
	   }
	  return val;
	};
	//得到未选中的value
	$.fn.getMultiseUnselectCheckValue = function(){
		var $cId = this.attr("id");
		var $id = $cId+"_multiselect_content";	
		var val = "";
		$("#"+$id+" input[type='checkbox']").each(function(){
			if(!$(this).is(":checked")){
				val = val + $(this).val()+",";
			}											   
		});
		if(val!=""){
			val = val.substring(0,val.length-1);	
		}
		return val;
	};
	//得到未选中的text
	$.fn.getMultiseUnselectCheckText = function(){
		var $cId = this.attr("id");
		var $id = $cId+"_multiselect_content";	
		var val = "";
		$("#"+$id+" input[type='checkbox']").each(function(){
			if(!$(this).is(":checked")){
				val = val + $.trim($(this).parent().find(".multiselectCheckSpan").eq(0).html())+",";
			}											   
		});
		if(val!=""){
			val = val.substring(0,val.length-1);	
		}
		return val;
	};
	//得到所有的value
	$.fn.getMultiseSelectAllValue = function(){
		var $cId = this.attr("id");
		var $id = $cId+"_multiselect_content";	
		var val = "";
		$("#"+$id+" input[type='checkbox']").each(function(){
			val = val + $(this).val()+",";										   
		});
		if(val!=""){
			val = val.substring(0,val.length-1);	
		}
		return val;
	};
	//得到所有的text
	$.fn.getMultiseSelectAllText = function(){
		var $cId = this.attr("id");
		var $id = $cId+"_multiselect_content";	
		var val = "";
		$("#"+$id+" input[type='checkbox']").each(function(){
			val = val + $.trim($(this).parent().find(".multiselectCheckSpan").eq(0).html())+",";										   
		});
		if(val!=""){
			val = val.substring(0,val.length-1);	
		}
		return val;
	};
   //缓冲打开
  $.fn.multiseSelectLoaddingOn = function(){
	var $cId = this.attr("id");
	var $load = $("#"+$cId+"_multiseSelect_loader");//缓冲div	
	if($load.is(":hidden")){
		var $parent = $load.parent();
		$load.css("left",$parent.offset().left);
		$load.css("top",$parent.offset().top);
		$load.css("width",$parent.width()-2);
		$load.show();	
	}
  };
   //缓冲关闭
  $.fn.multiseSelectLoaddingOff = function(){
	var $cId = this.attr("id");
	var $load = $("#"+$cId+"_multiseSelect_loader");//缓冲div
	if(!$load.is(":hidden")){
		$load.hide();	
	}
  };
  //清空下拉列表的值
  $.fn.multiseSelectInputClear = function(){
	var $cId = this.attr("id");
	$("#"+$cId+"_multiselect_input").val("");
	$("#"+$cId+"_multiselect_content .multiselectCheckDiv").removeClass("multiseSelectCheckDiv_select");
	$("#"+$cId+"_multiselect_content .multiselectCheckBox").removeAttr("checked");
  };
  //更改下拉列表框的内容
  $.fn.multiseSelectInputSetText = function(valArray){
	  if(valArray!=null&&valArray!=null){
		var txt = "";
	  	var $cId = this.attr("id");
	  	var cObj = null;
		$("#"+$cId+"_multiselect_content .multiselectCheckDiv").removeClass("multiseSelectCheckDiv_select");
		$("#"+$cId+"_multiselect_content .multiselectCheckDiv").each(function(){
			cObj = $(this);
			var lineCk = cObj.find(".multiselectCheckBox");
			lineCk.removeAttr("checked"); 
			var lineVal = $.trim(lineCk.val());	
			$.each(valArray,function(i){
				if(valArray[i]!=""&&valArray[i]==lineVal){
					cObj.addClass("multiseSelectCheckDiv_select");
					txt +=$.trim(cObj.find(".multiselectCheckSpan").html())+",";	
					lineCk.attr("checked","checked");
				}
			});
		});	
		if(txt!=""){
			txt = txt.substring(0,txt.length-1);	
		}
		$("#"+$cId+"_multiselect_input").val(txt);
	  }
  };
 //移除选中的项
  $.fn.multiseSelectClearSelect = function(valArray){
 	if(valArray!=null&&valArray!=""){
		var $cId = this.attr("id");
		var $input = $("#"+$cId+"_multiselect_input");
		var $val = "";
		var cObj = null;
		$("#"+$cId+"_multiselect_content .multiselectCheckDiv").each(function(){
			cObj = $(this);
			var lineCk = cObj.find(".multiselectCheckBox");			
			var lineVal = $.trim(lineCk.val());
			$.each(valArray,function(i){
				if(valArray[i]==lineVal){	
					if(lineCk.is(":checked")){
						lineCk.removeAttr("checked");
						cObj.removeClass("multiseSelectCheckDiv_select");
					}
				}
			});
			if(lineCk.is(":checked")){
				$val = $val + $.trim(cObj.find(".multiselectCheckSpan").html())+",";
			}
		});	
		if($val!=""){
			$val = $val.substring(0,$val.length-1);
		}
		$input.val($val);
	}
  };
  //下拉多列表聚焦
  $.fn.multiseSelectInputFocus = function(){
	  var $cId = this.attr("id");
	  $("#"+$cId+"_multiselect_input").focus();
  };
 })(jQuery);
 //点击按钮展示下拉列表
 function multiseSelectContentShow(cId,eve){
	var contentList = $("#"+cId+"_multiselect_content");
	var cInput = $("#"+cId+"_multiselect_input");
	if(contentList.is(":hidden")){
		$(".multiselect-content").hide();
		//显示
		var cLeft = cInput.offset().left;//局左
		var cTop = cInput.offset().top+cInput.outerHeight();//局上
		var cWidth = cInput.width()+24;//下拉列表的宽
		contentList.css("left",cLeft);
		contentList.css("top",cTop);
		contentList.css("width",cWidth);
		contentList.show();
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
 };
   //鼠标移入
  function multiseSelectMouseEnter(id,obj,eve){	
	  $("#"+id+"_multiselect_content .multiselectCheckDiv").removeClass("multiseSelectCheckDiv_hover");										   
	  $(obj).addClass("multiseSelectCheckDiv_hover");
	  var  eve = eve || window.event;
      if(eve.stopPropagation) { //W3C阻止冒泡方法
        eve.stopPropagation();
      } else {
        eve.cancelBubble = true; //IE阻止冒泡方法
      }
  };
  //输入框失焦
  function multiseSelectInputBlur(id){
	var cText = $("#"+id).getMultiseSelectCheckText();
	var cInput = $("#"+id+"_multiselect_input");
	if(cText!=""){
		cInput.val(cText);
	}else{
		cInput.val("请选择");
	}	
  };
	//输入框聚焦
  function multiseSelectInputFocus(obj){
		var val = $(obj).val();
		if($.trim(val.substring(0,3))=='请选择'){
			$(obj).val("");	
		}
	};
//下拉列表checkbox是否选中
  function multiseSelectCheckBoxClick(cId,obj,func,eve){
	if($(obj).is(":checked")){
		$(obj).parent().removeClass("multiseSelectCheckDiv_select");	
	}else{
		$(obj).parent().addClass("multiseSelectCheckDiv_select");	
	}
	multiseSelectInputBlur(cId);
	$("#"+cId+"_multiselect_input").focus();
	//外部onchange事件
	if(func!=null&&func!=""){
		eval(func);		
	}	
	var  eve = eve || window.event;
    if(eve.stopPropagation) { //W3C阻止冒泡方法
       eve.stopPropagation();
    } else {
       eve.cancelBubble = true; //IE阻止冒泡方法
    }
  };
 function multiseSelectCheckDivClick(id,obj,eve,func,flag){
	if(!flag){
		//除点击checkbox外	
		var cCheckBox = $(obj).find(".multiselectCheckBox");
		if(cCheckBox.is(":checked")){
			cCheckBox.removeAttr("checked");
			cCheckBox.parent().removeClass("multiseSelectCheckDiv_select");						
		}else{
			cCheckBox.attr("checked","checked");
			cCheckBox.parent().addClass("multiseSelectCheckDiv_select");
		}
		var selInput = $("#"+id+"_multiselect_input");
		multiseSelectInputBlur(id);
		selInput.focus();		
	}	
	//外部onchange事件
	if(func!=null&&func!=""){
		eval(func);		
	}
	var  eve = eve || window.event;
    if(eve.stopPropagation) { //W3C阻止冒泡方法
       eve.stopPropagation();
    } else {
       eve.cancelBubble = true; //IE阻止冒泡方法
    }
 }
  //文本框输入内容
 function multiseSelectInputKeyUp(cId,obj,eve){
		var val = $.trim($(obj).val());	
		cId +="_multiselect_content";
		if(eve.keyCode==8){
		//删除					
		}else if(eve.keyCode==37||eve.keyCode==39){
		//左右				
		}else if(eve.keyCode==38){
		//向上
			var $index = 0;
			var $allshowdiv = $("#"+cId+" > .multiselectCheckDiv:visible");
			var $focusDiv = $("#"+cId).find(".multiseSelectCheckDiv_hover");//当前聚焦的div
			if($focusDiv.html()==undefined){
				var $selectDiv = $("#"+cId).find(".multiseSelectCheckDiv_select");//当前选中的div
				if($selectDiv.html()!=undefined){
					$index = $allshowdiv.index($selectDiv)-1;	
				}					
			}else{
				$index = $allshowdiv.index($focusDiv)-1;
			}				
			var $count = $allshowdiv.size();
			if($index<$count&&$index>-1){
				$focusDiv.removeClass("multiseSelectCheckDiv_hover");
				var zz = parseInt($index/8);
				$("#"+cId).scrollTop(zz*8*27);						
				$allshowdiv.eq($index).addClass("multiseSelectCheckDiv_hover");
			}
			return;
		}else if(eve.keyCode==40){
		//向下
			var $index = 0;
			var $allshowdiv = $("#"+cId+" > .multiselectCheckDiv:visible");
			var $focusDiv = $("#"+cId).find(".multiseSelectCheckDiv_hover");//当前聚焦的div
			if($focusDiv.html()==undefined){
				var $selectDiv = $("#"+cId).find(".multiseSelectCheckDiv_select");//当前选中的div
				if($selectDiv.html()!=undefined){
					$index = $allshowdiv.index($selectDiv)+1;	
				}					
			}else{
				$index = $allshowdiv.index($focusDiv)+1;
			}				
			var $count = $allshowdiv.size();
			if($index<$count&&$index>-1){
				$focusDiv.removeClass("multiseSelectCheckDiv_hover");
				var zz = parseInt($index/8);
				$("#"+cId).scrollTop(zz*8*27);						
				$allshowdiv.eq($index).addClass("multiseSelectCheckDiv_hover");
			}
			return;
		}else if(eve.keyCode==13){
		//回车
			var $focusDiv = $("#"+cId).find(".multiseSelectCheckDiv_hover");//当前聚焦的div
			if($focusDiv.html()!=undefined){
				var cCheckBox = $focusDiv.find(".multiselectCheckBox");
				if(cCheckBox.is(":checked")){
					cCheckBox.removeAttr("checked");
					cCheckBox.parent().removeClass("multiseSelectCheckDiv_select");						
				}else{
					cCheckBox.attr("checked","checked");
					cCheckBox.parent().addClass("multiseSelectCheckDiv_select");
				}
				$("#"+cId.replace("content","input")).focus();
			}
			return;
		}			
		//展示内容
		var count = 0;
		var cObj = null;
		var txt = "";
		var qp = "";
		var jp = "";
		$("#"+cId+" .multiselectCheckSpan").each(function(){
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
			cContent.show();
			var cLeft = $(obj).offset().left;//局左
			var cTop = $(obj).offset().top+$(obj).outerHeight();//局上
			var cWidth = $(obj).width()+24;//下拉列表的宽
			cContent.css("left",cLeft);
			cContent.css("top",cTop);
			cContent.css("width",cWidth);
		}
 }
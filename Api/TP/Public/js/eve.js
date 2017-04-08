//设置事件添加的对象
event={
	add:function(node,click,func){
		if(node.addevEntListener){//W3C  的DOM2
			node.addevEntListener(click,func,false);
		}else if(node.attachEvent){//IE 里的 DOM2
			node.attachEvent('on'+click,func)
		}else{
			node['on'+click]=func
		}
	}
}

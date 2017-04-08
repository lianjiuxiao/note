<?php
	class PublicAction extends Action{
		Public function verify(){
			import('ORG.Util.Image');
			Image::buildImageVerify(1,5,png,90,30,'verify');
		}
	}
?>
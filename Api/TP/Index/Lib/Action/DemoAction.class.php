<?php
	class DemoAction extends Action {
		public function index() {

		}

		Public function verify(){
		    import('ORG.Util.Image');
		    Image::buildImageVerify();
		}

	}
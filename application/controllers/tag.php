<?php
// 将marks和mark放在一起
// 针对某个关键字
class Tag extends MY_Controller {

	public function view($page = 'home'){

		if ( ! file_exists(APPPATH.'/views/pages/'.$page.'.php')){
		// 页面不存在
			show_404();
		}
  
		$data['title'] = ucfirst($page); // 将title中的第一个字符大写
  
		$this->load->view('templates/header', $data);
		$this->load->view('pages/'.$page, $data);
		$this->load->view('templates/footer', $data);
	}
}
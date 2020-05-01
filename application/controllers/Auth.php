<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	
	public function index()
	{
		$this->load->view('adminlte2/login');
	}

	public function process()
	{
		$post = $this->input->post(null, TRUE);
		if(isset($post['logi'])){
			$this->load->model('user_m');
			$query = $this->user_m->login($post);
			if($query->num_rows()>0){
				$row = $query->row();
				$params = array(
					'userid' => $row->user_id,
					'level' => $row->level
				);
				$this->session->set_userdata($params);
				echo "<script>alert('Selamat, Login Berhasil');</script>";
			}else{
				echo "<script>
					alert ('Login Gagal, Uusername / password salah');
					window.location='".base_url('auth/')."';
					</script>";
			
			}
		}
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas extends CI_Controller {

	public function index(){
		$this->load->view('Login');
	}

	// public function Proses_Login(){
	// 	$username = $this->input->post('username', true);
	// 	$password = $this->input->post('password', true);
	// 	$cek = $this->M_Petugas->Proses_Login($username, $password);
	// 	$hasil = count($cek);

	// 	if($hasil<1){
	// 		redirect('Petugas');
	// 	}else{
	// 		if($cek->level == 'admin'){
	// 			$data_session = array(
	// 						'id_petugas' => $cek->id_petugas,
	// 						'username'	 => $cek->username,
	// 						'nama_petugas'=>$cek->nama_petugas,
	// 						'level'		 => $cek->level,
	// 			);

	// 			$this->session->set_userdata($data_session);
	// 			redirect('Pembayaran/Dashboard');
	// 		}else{
	// 			$data_session = array(
	// 						'id_petugas' => $cek->id_petugas,
	// 						'username'	 => $cek->username,
	// 						'nama_petugas'=>$cek->nama_petugas,
	// 						'level'		 => $cek->level,
	// 			);

	// 			$this->session->set_userdata($data_session);
	// 			redirect('Pembayaran/Dashboard');
	// 		}
	// 	}
	// }

	public function Proses_Login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('petugas', ['username' => $username])->row_array();

        // jika usernya ada
        if ($user) {
            // cek password
            if (password_verify($password, $user['password'])) {
                $data = [
                    'id_petugas' => $user['id_petugas'],
					'username' => $user['username'],
					'nama_petugas' => $user['nama_petugas'],
					'level' => $user['level']
                ];
                $this->session->set_userdata($data);
                redirect('Pembayaran/Dashboard');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
                redirect('Petugas/index');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username is not registered!</div>');
            redirect('Petugas/index');
        }
    }

	public function Logout(){
		$this->session->sess_destroy();
		redirect('Siswa');
	}

	public function Profile(){
		$this->load->view('Profile/Profile_petugas');
	}
}

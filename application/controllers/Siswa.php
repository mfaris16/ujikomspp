<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('M_Siswa');
	}

	public function index(){
		$this->load->view('Home_Spp');
	}

	public function Login_siswa(){
		$this->load->view('Siswa/Account/Login.php');
	}

	public function hash(){
		echo password_hash('admin', PASSWORD_DEFAULT);
	}

	public function Proses_Login()
    {
        $nis = $this->input->post('nis');
        $password = $this->input->post('password');

        $user = $this->db->get_where('siswa', ['nis' => $nis])->row_array();

        // jika usernya ada
        if ($user) {
            // cek password
            if (password_verify($password, $user['password'])) {
                $data = [
                    'nisn' => $user['nisn'],
					'nis' => $user['nis'],
					'nama' => $user['nama']
                ];
                $this->session->set_userdata($data);
                redirect('Siswa/Home');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
                redirect('Siswa/Login_siswa');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">NIS is not registered!</div>');
            redirect('Siswa/Login_siswa');
        }
    }

	public function Home(){
		if(empty($this->session->userdata('nis'))){
			redirect('Siswa');
		}else{
			$nisn = $this->session->userdata('nisn');

			$this->load->view('Siswa/Layout/Navbar');
			$this->load->view('Siswa/Home');
			$this->load->view('Siswa/Layout/Footer');
		}
	}

	public function Data_Pembayaran(){
		if(empty($this->session->userdata('nis'))){
			redirect('Siswa');
		}else{
			$nisn = $this->session->userdata('nisn');
			$data_siswa = $this->M_Siswa->Profile($this->session->userdata('nis'));

			$data['ambil_spp'] = $this->M_Siswa->Ambil_SPP($nisn);

			for ($i=1; $i < 13; $i++) { 
				if($data_siswa->status_siswa == 'siswa pindahan ke kelas X'){
					$data['spp_tahun1'][]	= $this->M_Siswa->Data_Pembayaran_SPP_TN($nisn, $bulan = $i, $tahun = 1, $status = 'siswa pindahan ke kelas X');
					$data['spp_tahun2'][]	= $this->M_Siswa->Data_Pembayaran_SPP_TN($nisn, $bulan = $i, $tahun = 2, $status = 'siswa pindahan ke kelas X');
					$data['spp_tahun3'][]	= $this->M_Siswa->Data_Pembayaran_SPP_TN($nisn, $bulan = $i, $tahun = 3, $status = 'siswa pindahan ke kelas X');
				}else if($data_siswa->status_siswa == 'siswa pindahan ke kelas XI'){
					$data['spp_tahun1'][]	= $this->M_Siswa->Data_Pembayaran_SPP_TN($nisn, $bulan = $i, $tahun = 1, $status = 'siswa pindahan ke kelas XI');
					$data['spp_tahun2'][]	= $this->M_Siswa->Data_Pembayaran_SPP_TN($nisn, $bulan = $i, $tahun = 2, $status = 'siswa pindahan ke kelas XI');
					$data['spp_tahun3'][]	= $this->M_Siswa->Data_Pembayaran_SPP_TN($nisn, $bulan = $i, $tahun = 3, $status = 'siswa pindahan ke kelas XI');
				}else if($data_siswa->status_siswa == 'siswa pindahan ke kelas XII'){
					$data['spp_tahun1'][]	= $this->M_Siswa->Data_Pembayaran_SPP_TN($nisn, $bulan = $i, $tahun = 1, $status = 'siswa pindahan ke kelas XII');
					$data['spp_tahun2'][]	= $this->M_Siswa->Data_Pembayaran_SPP_TN($nisn, $bulan = $i, $tahun = 2, $status = 'siswa pindahan ke kelas XII');
					$data['spp_tahun3'][]	= $this->M_Siswa->Data_Pembayaran_SPP_TN($nisn, $bulan = $i, $tahun = 3, $status = 'siswa pindahan ke kelas XII');
				}else{
					$data['spp_tahun1'][]	= $this->M_Siswa->Data_Pembayaran_SPP_TN($nisn, $bulan = $i, $tahun = 1, $status = '');
					$data['spp_tahun2'][]	= $this->M_Siswa->Data_Pembayaran_SPP_TN($nisn, $bulan = $i, $tahun = 2, $status = '');
					$data['spp_tahun3'][]	= $this->M_Siswa->Data_Pembayaran_SPP_TN($nisn, $bulan = $i, $tahun = 3, $status = '');
				}

				$data['spp_TN2'][] = $this->M_Siswa->Data_Pembayaran_SPP_TN($nisn, $bulan = $i, $tahun = 1, $status = 'tidak naik ke kelas XI');
				$data['spp_TN3'][] = $this->M_Siswa->Data_Pembayaran_SPP_TN($nisn, $bulan = $i, $tahun = 2, $status = 'tidak naik ke kelas XII');
			}

			$ambil_TN1 = $this->M_Pembayaran->data_pembayaran_status($bulan = 1, $tahun = 1, $nisn, $status = 'tidak naik ke kelas XI');

			if($data_siswa->status_siswa == 'tidak naik ke kelas XI'){
				$data['ket_TN'] = array('status' => 'tidak naik ke kelas XI');
			}else if($data_siswa->status_siswa == 'tidak naik ke kelas XII'){
				$cek = count($ambil_TN1);
				if($cek > 0){
					$data['ket_TN'] = array('status' => 'tidak naik dua kali');
				}else{
					$data['ket_TN'] = array('status' => 'tidak naik ke kelas XII');
				}
			}else{
				$data['ket_TN'] = array('status' => 'kosong');
			}

			$this->load->view('Siswa/Layout/Navbar');
			$this->load->view('Siswa/Pembayaran/Data_Pembayaran', $data);
			$this->load->view('Siswa/Layout/Footer');
		}
	}

	public function Tahun_SPP($id_spp){
		$nisn = $this->session->userdata('nisn');
		if(empty($nisn)){
			redirect('Siswa');
		}else{
			$data['data']		  = $this->M_Siswa->Tahun_SPP($nisn, $id_spp);

			$this->load->view('Siswa/Layout/Navbar');
			$this->load->view('Siswa/Home', $data);
			$this->load->view('Siswa/Layout/Footer');
		}
	}

	public function Profile(){
		$nis = $this->session->userdata('nis');
		if(empty($nis)){
			redirect('Siswa');
		}else{
			$data['profile'] = $this->M_Siswa->Profile($nis);

			$this->load->view('Siswa/Layout/Navbar');
			$this->load->view('Siswa/Account/Profile', $data);
			$this->load->view('Siswa/Layout/Footer');
		}
	}

	public function Ubah_Password(){
		$nis = $this->session->userdata('nis');
		if(empty($nis)){
			redirect('Siswa');
		}else{
			$this->load->view('Siswa/Layout/Navbar');
			$this->load->view('Siswa/Account/Ubah_Password');
			$this->load->view('Siswa/Layout/Footer');
		}
	}

	public function Proses_ubah_Password(){
		$nis 		= $this->session->userdata('nis');

		$pass_lama  = $this->input->post('pass_lama', true);
		$pass_baru  = $this->input->post('pass_baru', true);
		$pass_baru2 = $this->input->post('pass_baru2', true);

		$ambil = $this->db->get_where('siswa', array('nis' => $nis, 'password' => $pass_lama))->row();
		$cek   = count($ambil);
		if($cek > 0){
			if($pass_baru == $pass_baru2){
				$data = array('password' => $pass_baru);
				$update = $this->M_Siswa->Proses_ubah_Password($nis, $data);
				if($update){
					redirect('Siswa/Profile');
				}else{
					echo "Gagal Update Password!";
				}
			}else{
				echo "Masukan kedua Password baru dengan benar!";
			}
		}else{
			echo "Password lama anda tidak sesuai!";
		}
	}

	public function Logout(){
		$this->session->sess_destroy();
		redirect('Siswa');
	}
}

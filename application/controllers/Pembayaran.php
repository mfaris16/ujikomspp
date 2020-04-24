<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller {

	public function Dashboard(){

		$data['title'] = 'Dashboard';
		$data['siswa_bayar'] 		= $this->M_Pembayaran->siswa_bayar(); //mengambil data siswa yang sudah bayar
		$data['siswa_belum_bayar'] 	= $this->M_Pembayaran->siswa_belum_bayar(); //mengambil data siswa belum bayar
		$data['seluruh_pembayaran'] = $this->db->get('pembayaran')->result_array(); //mengambil seluruh pembayaran
		$this->load->view('Layout_admin/Header', $data); //menampilkan navbar untuk admin
		$this->load->view('Pembayaran_SPP/Dashboard', $data); //menampilkan view dashboard dan memasukan data kedalam view agar dapat digunakan
		$this->load->view('Layout_admin/Footer');

	}

	public function Data_Pembayaran_SPP(){
		$nis 	= $this->input->post('nis', true);	//mengambil data dari form input nis dan dimasukan kedalam variabe nis
		$nama 	= $this->input->post('nama', true);	//mengambil data dari form input nama dan dimasukan kedalam variabel nama
		$kelas 	= $this->input->post('kelas', true);//mengambil data dari form input kelas dan dimasukan kedalam variabel kelas
		$tb 	= $this->input->post('tb', true);	//mengambil data dari form input tb(tahun bayar) dan dimasukan kedalam variabel tb(tahun bayar)
		$tgl 	= $this->input->post('tgl', true);	//mengambil data dari form input tgl(tgl bayar) dan dimasukan kedalam variabel tgl(tgl bayar)

		// data filter atau cari
		$data_cari = array(
							'siswa.nis'					=> $nis,  //'siswa.nis' adalah table siswa dan kolom nis diisi dengan variable nis
							'siswa.nama'				=> $nama, //'siswa.nama' adalah table siswa dan kolom nama diisi dengan variable nama
							'siswa.id_kelas'			=> $kelas,//'siswa.id_kelas' adalah table siswa dan kolom id_kelas diisi dengan variable kelas
							'pembayaran.tahun_dibayar'	=> $tb,	  //'pembayaran.tahun dibayar' adalah table pembayaran dan kolom tahun dibayar diisi dengan variable tb (tahun bayar)
							'pembayaran.tgl_bayar'		=> $tgl,);//'pembayaran.tgl_bayar' adalah table pembayaran dan kolom tgl_bayar diisi dengan variable tgl
		// *(ditulis 'siswa.nis' karena saat mengambil data menggunakan join)*

		// data untuk excel (header atau judul)
		$data['ket2'] = array('nis'			=> $nis,  
							'nama'			=> $nama,
							'id_kelas'		=> $kelas,
							'tahun_dibayar'	=> $tb,
							'tgl_bayar'		=> $tgl,);

			$data['title'] = 'Data Pembayaran SPP';
			$data['data_kelas'] = $this->db->get('kelas')->result_array(); // mengambil data kelas
			$data['data'] 		= $this->M_Pembayaran->Data_Pembayaran_SPP($data_cari); // mengambil data pembayaran

			$this->load->view('Layout_admin/Header', $data); //menampilkan navbar untuk petugas
			$this->load->view('Pembayaran_SPP/Data_Pembayaran_SPP', $data); //menampilkan view data pembayaran dan memasukan data kedalam view agar dapat digunakan
			$this->load->view('Layout_admin/Footer');
	}

	public function Pencarian_Data_Siswa(){
		$data ['title'] = 'Cari Data';
		$this->load->view('Layout_admin/Header', $data); //menampilkan navbar untuk admin
		$this->load->view('Pembayaran_SPP/Pencarian_Data_Siswa'); //menampilkan view pencarian siswa
	}

	public function Cari_NIS_Pembayaran(){
		$nis = $this->input->post('nis', true); //mengambil data dari form input nis dan dimasukan kedalam variabe nis
		redirect('Pembayaran/Bayar_SPP/'.$nis); //dialihkan ke controller Pembayaran funtion Bayar_Spp() dengan membawa nis
	}

	public function SPP_PDF() {
		$data['data_kelas'] = $this->db->get('kelas')->result_array(); // mengambil data kelas
		$data['data'] = $this->M_Pembayaran->Data_PDF_SPP(); // mengambil data pembayaran
	
		$this->load->library('pdf');
	
		$this->pdf->setPaper('A4', 'potrait');
		$this->pdf->filename = "laporan-petanikode.pdf";
		$this->pdf->load_view('laporan_pdf', $data);
	}

	public function Bayar_SPP($nis){ 
		$data['data_siswa']  = $this->M_Pembayaran->Proses_Pencarian_Data_Siswa($nis); 
		//mengambil data siswa berdasarkan nis ke database dengan mengakses model

		$status_siswa = $data['data_siswa']->status_siswa; 
		//membuat variable status_siswa dengan isi status_siswa dari  database yang diambil dari variable data_siswa

		$cek = count((array)$data['data_siswa']); //membuat variable cek isinya menghitung data dari data siswa

		if($cek > 0){ //filter jika data yang diambil ada atau berisi

			for ($i=1; $i < 13; $i++) { //perulangan dari 1 sampai 12 (jumlah bulan dalam 1 tahun)

				if($status_siswa == 'siswa pindahan ke kelas X'){ //jika status siswa pindahan

					$data['ambil1'][] = $this->M_Pembayaran->data_pembayaran_status($i, $tahun = 1, $data['data_siswa']->nisn, $status_siswa); 
					//membuat variable ambil1 (array) dan mengambil data ke database berdasarkan bulan 1 sampai 12, tahun ke 1, berdasarkan status siswa

					$data['ambil2'][] = $this->M_Pembayaran->data_pembayaran_status($i, $tahun = 2, $data['data_siswa']->nisn, $status_siswa);
					//membuat variable ambil2 (array) dan mengambi data ke database berdasarkan bulan 1 sampai 12, tahun ke 2, berdasarkan status siswa

					$data['ambil3'][] = $this->M_Pembayaran->data_pembayaran_status($i, $tahun = 3, $data['data_siswa']->nisn, $status_siswa);
					//membuat variable ambil3 (array) dan mengambil data ke database berdasarkan bulan 1 sampai 12, tahun ke 3, berdasarkan status siswa
				}else{
					$data['ambil1'][] = $this->M_Pembayaran->data_pembayaran($i, $tahun = 1, $data['data_siswa']->nisn);
					//membuat variable ambil1 (array) dan mengambil data ke database berdasarkan bulan 1 sampai 12, tahun ke 1, tanpa status siswa

					$data['ambil2'][] = $this->M_Pembayaran->data_pembayaran($i, $tahun = 2, $data['data_siswa']->nisn);
					//membuat variable ambil2 (array) dan mengambil data ke database berdasarkan bulan 1 sampai 12, tahun ke 2, tanpa status siswa

					$data['ambil3'][] = $this->M_Pembayaran->data_pembayaran($i, $tahun = 3, $data['data_siswa']->nisn);
					//membuat variable ambil3 (array) dan mengambil data ke database berdasarkan bulan 1 sampai 12, tahun ke 3, tanpa status siswa

				}

				$data['TN2'][] = $this->M_Pembayaran->data_pembayaran_status($i, $tahun = 1, $data['data_siswa']->nisn, $status = 'tidak naik ke kelas XI');
				//membuat variable TN2 atau tidak naik ke kelas XI (array) dan mengambil data ke database berdasarkan bulan 1 sampai 12, tahun ke 1, berdasarkan status siswa

				$data['TN3'][] = $this->M_Pembayaran->data_pembayaran_status($i, $tahun = 2, $data['data_siswa']->nisn, $status = 'tidak naik ke kelas XII');
				//membuat variable TN3 atau tidak naik ke kelas XII (array) dan mengambil data ke database berdasarkan bulan 1 sampai 12, tahun ke 2, berdasarkan status siswa
			}

			$ambil_TN1 = $this->M_Pembayaran->data_pembayaran_status(1, 1, $data['data_siswa']->nisn, 'tidak naik ke kelas XI'); //mengambil data pembayaran berdasarkan bulan 1, tahun ke 1, nis dan status 

			if(empty($status_siswa) || $status_siswa == 'siswa pindahan ke kelas X' || $status_siswa == 'siswa pindahan ke kelas XI' || $status_siswa == 'siswa pindahan ke kelas XII'){
			//jika status siswa kosong atau pindahan ke kelas X, XI atau XII

				$data['ket_TN'] = array('status' => 'kosong'); //membuat variable ket_TN dengan status kosong
				//untuk kebutuhan view bayar spp, ketika siswa tidak naik pembayaran bertambah

			}else if($status_siswa == 'tidak naik ke kelas XI'){ 
			//jika status siswa tidak naik ke kelas XI

				$data['ket_TN'] = array('status' => 'tidak naik ke kelas XI'); 
				//membuat variable ket_TN dengan status tidak naik ke kelas XI

			}else if($status_siswa == 'tidak naik ke kelas XII'){
			//jika status siswa tidak naik ke kelas XI

				$cek_TN1 = count((array)$ambil_TN1); 
				//membuat variable cek_TN1 untuk menghitung variable ambil_TN1 
				//atau apakah siswa dengan nis tsb pernah tidak naik kelas ke kelas XI yang artinya tidak naik 2 kali

				if($cek_TN1 > 0){ //jika tidak naik 2 kali

					$data['ket_TN'] = array('status' => 'tidak naik 2 kali'); 
					//membuat variable ket_TN dengan status tidak naik 2 kali
				}else{ //jika tidak pernah tidak naik ke kelas XI

					$data['ket_TN'] = array('status' => 'tidak naik ke kelas XII');
					//membuat variable ket_TN dengan status tidak naik ke kelas XII saja
				}
			}

			$data['numrows_1'] = $this->M_Pembayaran->hitung_pembayaran($data['data_siswa']->nisn, $id_spp = 1);
			$data['numrows_2'] = $this->M_Pembayaran->hitung_pembayaran($data['data_siswa']->nisn, $id_spp = 2);
			$data['numrows_3'] = $this->M_Pembayaran->hitung_pembayaran($data['data_siswa']->nisn, $id_spp = 3);
			$data['title'] = 'Bayar SPP';
			$this->load->view('Layout_admin/Header', $data); //menampilkan navbar untuk admin
			$this->load->view('Pembayaran_SPP/Bayar_SPP', $data); //menampilkan view bayar spp dan memasukan data kedalam view agar dapat digunakan
			$this->load->view('Layout_admin/Footer');
		}else{ //jika data dengan nis tsb tidak ada
			echo 'NIS yang anda masukan tidak ditemukan!';
		}
	}

	public function Proses_Bayar_SPP(){
		$id_petugas = $this->session->userdata('id_petugas');
		$nisn   	= $this->input->post('nisn');
		$nis   		= $this->input->post('nis');
		$bulan  	= $this->input->post('bulan');
		$id_spp 	= $this->input->post('id_spp');
		$status_siswa = $this->input->post('status_siswa');

		//Menghitung nominal perbulan spp
		//ambil dan hitung jumlah row atau baris bulan yang sudah dibayar berdasarkan nisn dan id spp
		$max_bulan_bayar 	= $this->M_Pembayaran->hitung_pembayaran($nisn, $id_spp); 
		//mengambil berdasarkan id_spp sesuai input

		$ambil_total_bayar 	= $this->db->get_where('spp', array('id_spp' => $id_spp))->row(); 
		//mengambil data dari tabel spp sesuai id spp dari input

		$harga_perbulan		= $ambil_total_bayar->nominal/12; //harga perbulan dari nominal spp dibagi 12 bulan 

		//Status Siswa
		if(empty($status_siswa)){
			$status_siswa = ' ';
		}

		if($id_spp == 1){

			//filter ketika membayar tidak sesuai urutan
			if($max_bulan_bayar+1 == $bulan){ //jika bayar sesuai urutan
				$data = array('id_petugas' 	=> $id_petugas,
							'nisn'			=> $nisn,
							'tgl_bayar' 	=> date('y-m-d'),
							'bulan_dibayar'	=> $bulan,
							'tahun_dibayar'	=> $id_spp,
							'id_spp'		=> $id_spp,
							'jumlah_bayar'	=> $harga_perbulan,
							'status_pembayaran_siswa'=> $status_siswa);

				$data_update  = array('id_spp' => '1');
				$update_siswa = $this->M_Pembayaran->Update_Siswa($nisn, $data_update);

				$bayar = $this->db->insert('pembayaran', $data);
				if($bayar){
					$this->session->set_flashdata('flash', 'Sukses Melakukan Pembayaran');
					redirect('Pembayaran/Bayar_SPP/'.$nis);
				}else{
					echo('Gagal melakukan Pembayaran!');
				}
			}else{
				echo "Pembayaran SPP tidak boleh acak!"; //jika bayar tidak berurutan
			}
		}else if($id_spp == 2){

			if($max_bulan_bayar+1 == $bulan){ 
				$data = array('id_petugas' 	=> $id_petugas,
							'nisn'			=> $nisn,
							'tgl_bayar' 	=> date('y-m-d'),
							'bulan_dibayar'	=> $bulan,
							'tahun_dibayar'	=> $id_spp,
							'id_spp'		=> $id_spp,
							'jumlah_bayar'	=> $harga_perbulan,
							'status_pembayaran_siswa'=> $status_siswa);

				$data_update  = array('id_spp' => '2');
				$update_siswa = $this->M_Pembayaran->Update_Siswa($nisn, $data_update);

				$bayar = $this->db->insert('pembayaran', $data);
				if($bayar){
					$this->session->set_flashdata('flash', 'Sukses Melakukan Pembayaran');
					redirect('Pembayaran/Bayar_SPP/'.$nis);
				}else{
					echo('Gagal melakukan Pembayaran!');
				}
			}else{
				echo "Pembayaran SPP tidak boleh acak!"; 
			}
		}else if($id_spp == 3){

			if($max_bulan_bayar+1 == $bulan){ 
				$data = array('id_petugas' 	=> $id_petugas,
							'nisn'			=> $nisn,
							'tgl_bayar' 	=> date('y-m-d'),
							'bulan_dibayar'	=> $bulan,
							'tahun_dibayar'	=> $id_spp,
							'id_spp'		=> $id_spp,
							'jumlah_bayar'	=> $harga_perbulan,
							'status_pembayaran_siswa'=> $status_siswa);

				$data_update  = array('id_spp' => '3');
				$update_siswa = $this->M_Pembayaran->Update_Siswa($nisn, $data_update);

				$bayar = $this->db->insert('pembayaran', $data);
				if($bayar){
					$this->session->set_flashdata('flash', 'Sukses Melakukan Pembayaran');
					redirect('Pembayaran/Bayar_SPP/'.$nis);
				}else{
					echo('Gagal melakukan Pembayaran!');
				}
			}else{
				echo "Pembayaran SPP tidak boleh acak!"; 
			}
		}
	}

	public function Proses_Bayar_SPP_TN(){
		$id_petugas = $this->session->userdata('id_petugas');
		$nisn   	= $this->input->post('nisn');
		$nis   		= $this->input->post('nis');
		$bulan  	= $this->input->post('bulan');
		$id_spp 	= $this->input->post('id_spp');
		$status_siswa = $this->input->post('status_siswa');

		$max_bulan_bayar 	= $this->M_Pembayaran->hitung_pembayaran_TN($nisn, $id_spp, $status_siswa);
		$ambil_total_bayar 	= $this->db->get_where('spp', array('id_spp' => $id_spp))->row();
		$harga_perbulan		= $ambil_total_bayar->nominal/12; 

		if($max_bulan_bayar+1 == $bulan){ 
			$data = array('id_petugas' 	=> $id_petugas,
						'nisn'			=> $nisn,
						'tgl_bayar' 	=> date('y-m-d'),
						'bulan_dibayar'	=> $bulan,
						'tahun_dibayar'	=> $id_spp,
						'id_spp'		=> $id_spp,
						'jumlah_bayar'	=> $harga_perbulan,
						'status_pembayaran_siswa'=> $status_siswa);

			$data_update  = array('id_spp' => $id_spp);
			$update_siswa = $this->M_Pembayaran->Update_Siswa($nisn, $data_update);

			$bayar = $this->db->insert('pembayaran', $data);
			if($bayar){
				$this->session->set_flashdata('flash', 'Sukses Melakukan Pembayaran');
				redirect('Pembayaran/Bayar_SPP/'.$nis);
			}else{
				echo('Gagal melakukan Pembayaran!');
			}
		}else{
			echo "Pembayaran SPP tidak boleh acak!"; 
		}
	}

	

	public function Pembayaran_SPP($nisn){
		$bulan 		= $this->input->post('bulan', true);
		$tahun 		= $this->input->post('tahun', true);
		$id_spp 	= $this->input->post('id_spp', true);
		$status_siswa= $this->input->post('status_siswa', true);

		$id_petugas = $this->session->userdata('id_petugas');

		//JUMLAH BAYAR & STATUS SISWA
		if(empty($status_siswa)){
			$status_siswa = ' ';
			if($id_spp == '1' || $id_spp == '4'){
				$id_spp2 = '1';
				$spp = $this->db->get_where('spp', array('id_spp' => $id_spp2))->row();
				
				$total_spp = $spp->nominal;
				$spp_per_bulan = $total_spp/12;

				$jumlah_bayar = $bulan*$spp_per_bulan;
			}else if($id_spp == '2'){
				$spp = $this->db->get_where('spp', array('id_spp' => $id_spp))->row();
				
				$total_spp = $spp->nominal;
				$spp_per_bulan = $total_spp/12;

				$jumlah_bayar = $bulan*$spp_per_bulan;
			}else{
				$spp = $this->db->get_where('spp', array('id_spp' => $id_spp))->row();
				
				$total_spp = $spp->nominal;
				$spp_per_bulan = $total_spp/12;

				$jumlah_bayar = $bulan*$spp_per_bulan;
			}
		}else{
			$jumlah_bayar = 0;
		}

		//HITUNG BULAN DIBAYAR
		$ambil = $this->db->get_where('pembayaran', array('nisn'=> $nisn))->result_array();
		foreach ($ambil as $a) {
			$hitung2 += $a['bulan_dibayar'];
		}
		$cek = $hitung2+$bulan;
		
		//INSERT PEMBAYARAN
		if($cek > 36){
			if($hitung2 >= 36){
				redirect('Pembayaran/SPP_Selesai');
			}else{
				$bulan2 = 36-$hitung2;

				$data = array(
						'id_petugas'	=> $id_petugas,
						'nisn'			=> $nisn,
						'tgl_bayar'		=> date('Y-m-d'),
						'bulan_dibayar'	=> $bulan2,
						'tahun_dibayar'	=> '3',
						'id_spp'		=> '3',
						'jumlah_bayar'	=> $jumlah_bayar,
						'status_siswa'	=> $status_siswa,
					);

				$tambah = $this->db->insert('pembayaran', $data);

				if($tambah){
					$this->session->set_flashdata('flash', 'Sukses Melakukan Pembayaran');
					redirect('Pembayaran/Data_Pembayaran_SPP');
				}else{
					echo 'Gagal Insert Data!';
				}
			}
		}else{
			if($cek <13){
				if(empty($hitung2)){
					$data = array(
						'id_petugas'	=> $id_petugas,
						'nisn'			=> $nisn,
						'tgl_bayar'		=> date('Y-m-d'),
						'bulan_dibayar'	=> $bulan,
						'tahun_dibayar'	=> '1',
						'id_spp'		=> '1',
						'jumlah_bayar'	=> $jumlah_bayar,
						'status_siswa'	=> $status_siswa,
					);

					$tambah = $this->db->insert('pembayaran', $data);
					$data_update = array('id_spp' => '1');
					$update_tb = $this->M_Pembayaran->Update_ID_SPP($nisn, $data_update);
				}else{
					$data = array(
						'id_petugas'	=> $id_petugas,
						'nisn'			=> $nisn,
						'tgl_bayar'		=> date('Y-m-d'),
						'bulan_dibayar'	=> $bulan,
						'tahun_dibayar'	=> '1',
						'id_spp'		=> '1',
						'jumlah_bayar'	=> $jumlah_bayar,
						'status_siswa'	=> $status_siswa,
					);

					$tambah = $this->db->insert('pembayaran', $data);
				}
			}else if($cek >12 && $cek <25){
				$data = array(
						'id_petugas'	=> $id_petugas,
						'nisn'			=> $nisn,
						'tgl_bayar'		=> date('Y-m-d'),
						'bulan_dibayar'	=> $bulan,
						'tahun_dibayar'	=> '2',
						'id_spp'		=> '2',
						'jumlah_bayar'	=> $jumlah_bayar,
						'status_siswa'	=> $status_siswa,
					);

				$data_update = array('id_spp' => '2');
				$update_tb = $this->M_Pembayaran->Update_ID_SPP($nisn, $data_update);
				if(!$update_tb){
					echo 'Gagal Update Data Siswa (ID_SPP)';
				}
				$tambah = $this->db->insert('pembayaran', $data);
			}else if($cek >24 && $cek <37){
				$data = array(
						'id_petugas'	=> $id_petugas,
						'nisn'			=> $nisn,
						'tgl_bayar'		=> date('Y-m-d'),
						'bulan_dibayar'	=> $bulan,
						'tahun_dibayar'	=> '3',
						'id_spp'		=> '3',
						'jumlah_bayar'	=> $jumlah_bayar,
						'status_siswa'	=> $status_siswa,
					);

				$data_update = array('id_spp' => '3');
				$update_tb = $this->M_Pembayaran->Update_ID_SPP($nisn, $data_update);
				if(!$update_tb){
					echo 'Gagal Update Data Siswa (ID_SPP)';
				}
				$tambah = $this->db->insert('pembayaran', $data);
			}
			
			if($tambah){
				$this->session->set_flashdata('flash', 'Sukses Melakukan Pembayaran');
				redirect('Pembayaran/Data_Pembayaran_SPP');
			}else{
				echo 'Gagal Insert Data!';
			}
		}
	}

	public function SPP_Selesai(){
		if($this->session->userdata('level') == 'admin'){
			$this->load->view('Layout_admin/Navbar');
			$this->load->view('Pembayaran_SPP/SPP_Selesai');
		}else if($this->session->userdata('level') == 'petugas'){
			$this->load->view('Layout_admin/Navbar_Petugas');
			$this->load->view('Pembayaran_SPP/SPP_Selesai');
		}else{
			redirect('Petugas');
		}
	}

	public function Ubah_Nominal_SPP(){
		if($this->session->userdata('level') == 'petugas'){
			redirect('Petugas');
		}else if($this->session->userdata('level') == 'admin'){
			$this->load->view('Layout_admin/Navbar');
			$data['data'] = $this->db->get('spp')->result_array();
			$this->load->view('Pembayaran_SPP/Ubah_Nominal_SPP', $data);
		}else{
			redirect('Petugas');
		}
	}

	public function Proses_Ubah_Nominal_SPP(){
		$tahun 		= $this->input->post('tahun', true);
		$nominal 	= $this->input->post('nominal', true);

		$hasil_nominal = $nominal*12;

		$data_tahun 	= array('tahun' => $tahun);
		$data_nominal 	= array('nominal' => $hasil_nominal);
		$update = $this->M_Pembayaran->Proses_Ubah_Nominal_SPP($data_nominal, $data_tahun);

		if($update){
			redirect('Admin/Data_Spp');
		}else{
			echo 'Gagal Update Data!';
		}
	}

}

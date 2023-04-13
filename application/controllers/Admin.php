<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_admin');
		$this->load->library('upload');
	}

	public function index()
	{
		if ($this->session->userdata('status') == 'login' && $this->session->userdata('role') == 0) {
			$data['stokBarangMasuk'] = $this->M_admin->numrows('tb_unit_masuk');
			$data['stokBarangKeluar'] = $this->M_admin->numrows('tb_unit_keluar');
			$data['dataUser'] = $this->M_admin->numrows('tb_user');
			$data['dataPelanggan'] = $this->M_admin->numrows('tb_pelanggan');
			$data['dataOperator'] = $this->M_admin->numrows('tb_operator');
			$data['count'] = $this->M_admin->notif_stok('tb_sparepart');
			$data['num'] = $this->M_admin->notif_stok_jml('tb_sparepart');
			$data['avatar'] = $this->M_admin->get_data_avatar(' tb_avatar', $this->session->userdata('name'));
			$data['title'] = 'Home';
			$this->load->view('admin/index', $data);
		} else {
			$this->load->view('login/login');
		}
	}
	public function signout()
	{
		session_destroy();
		redirect('login');
	}

	public function token_generate()
	{
		return $tokens = md5(uniqid(rand(), true));
	}

	private function hash_password($password)
	{
		return password_hash($password, PASSWORD_DEFAULT);
	}

	/*public function nav()
	{
		$data['count'] = $this->M_admin->notif_stok('tb_sparepart');
		$this->load->view('template/nav', $data);
	}*/

	####################################
	//* Users
	####################################
	public function users()
	{
		$data['avatar'] = $this->M_admin->get_data_avatar(' tb_avatar', $this->session->userdata('name'));
		$data['user'] = $this->M_admin->get_data();
		$data['title'] = 'Users';
		$this->load->view('admin/form_users/users', $data);
	}

	public function tambah_users()
	{
		$data['avatar'] = $this->M_admin->get_data_avatar(' tb_avatar', $this->session->userdata('name'));
		$data['title'] = 'Tambah User';
		$this->load->view('admin/form_users/tambahuser', $data);
	}

	public function proses_tambahuser()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

		if ($this->form_validation->run() == true) {

			$nama 	= $this->input->post('nama', true);
			$username 	= $this->input->post('username', true);
			$password 	= $this->input->post('password', true);
			$role 		= $this->input->post('role', true);

			$data = array(
				'nama'	=> $nama,
				'username'	=> $username,
				'password' 	=> $this->hash_password($password),
				'role' 		=> $role,
			);

			$dataUpload = array(
				'id' => '',
				'username_user' => $username,
				'nama_file' => 'nopic.png'
			);

			$this->M_admin->insert('tb_user', $data);
			$this->M_admin->insert('tb_avatar', $dataUpload);

			$this->session->set_flashdata('msg_sukses', 'User Berhasil Ditambahkan');
			redirect(base_url('admin/users'));
		} else {
			$data['avatar'] = $this->M_admin->get_data_avatar(' tb_avatar', $this->session->userdata('name'));
			$header['title'] = 'Tambah User';
			$this->load->view('admin/form_users/tambahuser', $header);
		}

		// $data['title'] = 'Tambah User';
		// $this->load->view('admin/form_users/tambahuser', $data);
	}

	public function proses_deleteuser()
	{
		$id = $this->uri->segment(3);
		$where = array('id' => $id);
		$this->M_admin->delete('tb_user', $where);
		$this->session->set_flashdata('msg_sukses', 'User Berhasil Di Hapus');
		redirect(base_url('admin/users'));
	}

	public function edit_user()
	{
		$data['avatar'] = $this->M_admin->get_data_avatar(' tb_avatar', $this->session->userdata('name'));
		$id = $this->uri->segment(3);
		$where = array('id' => $id);
		$data['list_data'] = $this->M_admin->get_data_tb('tb_user', $where);
		$data['title'] = 'Edit User';
		$this->load->view('admin/form_users/edituser', $data);
	}

	public function proses_edituser()
	{
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('nama', 'Nama', 'required');

		if ($this->form_validation->run() == true) {
			$id	= $this->input->post('id', true);
			$username	= $this->input->post('username', true);
			$nama	= $this->input->post('nama', true);
			$role = $this->input->post('role', true);

			$where = array('id' => $id);
			$data = array(
				'username' => $username,
				'nama' => $nama,
				'role' => $role,
			);
			$this->M_admin->update('tb_user', $data, $where);
			$this->session->set_flashdata('msg_sukses', 'Data User Berhasil Diubah');
			redirect(base_url('admin/users'));
		} else {
			$data['avatar'] = $this->M_admin->get_data_avatar(' tb_avatar', $this->session->userdata('name'));
			$data['title'] = 'Edit User';
			$this->load->view('admin/form_users/edituser', $data);
		}
	}
	####################################
	//* End Users
	####################################

	####################################
	//* Profile
	####################################
	public function profile()
	{
		$data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
		$data['title'] = 'Profile';
		$this->load->view('admin/form_users/profile', $data);
		// $this->load->view('admin/profile', $data);
	}

	public function proses_newpassword()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('new_password', 'Password Baru', 'required');
		$this->form_validation->set_rules('confirm_new_password', 'Konfirmasi Password Baru', 'required|matches[new_password]');

		if ($this->form_validation->run() == true) {

			$username = $this->input->post('username');
			$nama = $this->input->post('nama');
			$new_password = $this->input->post('new_password');

			$data = array(
				'nama' => $nama,
				'password' => $this->hash_password($new_password)
			);
			$where = array(
				'id' => $this->session->userdata('id')
			);
			$this->M_admin->update_password('tb_user', $where, $data);
			$this->session->set_flashdata('msg_sukses', 'Password Berhasil Diganti, Silahkan Logout dan Login Kembali');
			redirect(base_url('admin/profile'));
		} else {
			$data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
			$data['title'] = 'Profile';
			$this->load->view('admin/form_users/profile', $data);
		}
	}

	public function proses_gambarupload()
	{
		$config = array(
			'upload_path' => "./assets/upload/user/",
			'allowed_types' => "jpg|png|jpeg",
			'ecrypt_name'	=> false,
			'overwrite'	=> true,
			// 'file_name'	=> uniqid(),
			'max_size' => "5000",
			'max_height' => "1024",
			'max_width' => "1024"
		);
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('userpicture')) {
			$this->session->set_flashdata('msg_gambar_error', $this->upload->display_errors());
			$data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
			$data['title'] = 'Profile';
			$this->load->view('admin/form_users/profile', $data);
		} else {
			$data_upload = array('upload_data' => $this->upload->data());
			$nama_file = $data_upload['upload_data']['file_name'];

			$where = array(
				'username_user' => $this->session->userdata('name')
			);
			$data = array(
				'nama_file' => $nama_file
			);

			$this->M_admin->update_avatar($where, $data);
			$this->session->set_flashdata('msg_gambar_sukses', 'Gambar Berhasil Di Upload');
			redirect(base_url('admin/profile'));
		}
	}

	####################################
	//* End Profile
	####################################

	####################################
	//* Data Genset
	####################################

	public function tabel_genset()
	{
		$data['list_data'] = $this->M_admin->select('tb_genset');
		$data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
		$data['title'] = 'Data Genset';
		$this->load->view('admin/form_genset/tabel_genset', $data);
	}

	public function tambah_genset()
	{
		$data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
		$data['title'] = 'Tambah Genset';
		$this->load->view('admin/form_genset/tambahgenset', $data);
	}

	public function proses_tambahgenset()
	{
		$this->form_validation->set_rules('kode_genset', 'Kode Genset', 'trim|required');
		$this->form_validation->set_rules('nama_genset', 'Nama Genset', 'trim|required');
		$this->form_validation->set_rules('daya', 'Daya', 'trim|required');
		$this->form_validation->set_rules('harga', 'Harga', 'trim|required');
		$this->form_validation->set_rules('stok_gd', 'Stok GUdang', 'trim|required');
		$this->form_validation->set_rules('stok_pj', 'Stok Pinjam', 'trim|required');

		if ($this->form_validation->run() == true) {
			$gambar_genset = $this->upload_gambargenset();

			$kode_genset = $this->input->post('kode_genset', true);
			$nama_genset = $this->input->post('nama_genset', true);
			$daya = $this->input->post('daya', true);
			$harga = $this->input->post('harga', true);
			$stok_gd = $this->input->post('stok_gd', true);
			$stok_pj = $this->input->post('stok_pj', true);

			$data = array(
				'kode_genset' => $kode_genset,
				'nama_genset' => $nama_genset,
				'daya' => $daya,
				'harga' => $harga,
				'stok_gd' => $stok_gd,
				'stok_pj' => $stok_pj,
				'gambar_genset' => $gambar_genset
			);

			$this->M_admin->insert('tb_genset', $data);
			$this->session->set_flashdata('msg_sukses', 'Data Genset Berhasil Disimpan');
			redirect(base_url('admin/tabel_genset'));
		} else {
			$data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
			$data['title'] = 'Tambah Genset';
			$this->load->view('admin/form_genset/tambahgenset', $data);
		}
	}

	public function upload_gambargenset()
	{
		$config = array(
			'upload_path' => './assets/upload/genset/',
			'allowed_types' => 'gif|jpg|png',
			'ecrypt_name'	=> false,
			'overwrite'	=> true,
			// 'file_name'	=> uniqid(),
			'max_size' => 2048,
			'max_height' => 1920,
			'max_width' => 1080
		);
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('gambar_genset')) {
			$error = $this->upload->display_errors();
			return $error;
			// die('gagal diupload');
		} else {
			$data_upload = array('upload_data' => $this->upload->data());
			$userfile = $data_upload['upload_data']['file_name'];

			return $userfile;
		}
	}

	public function update_genset()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_genset' => $uri);
		$data['data_genset'] = $this->M_admin->get_data_tb('tb_genset', $where);
		$data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
		$data['title'] = 'Update Genset';
		$this->load->view('admin/form_genset/updategenset', $data);
	}

	public function proses_updategenset()
	{
		$this->form_validation->set_rules('kode_genset', 'Kode Genset', 'trim|required');
		$this->form_validation->set_rules('nama_genset', 'Nama Genset', 'trim|required');
		$this->form_validation->set_rules('daya', 'Daya', 'trim|required');
		$this->form_validation->set_rules('harga', 'Harga', 'trim|required');
		$this->form_validation->set_rules('stok_gd', 'Stok GUdang', 'trim|required');
		$this->form_validation->set_rules('stok_pj', 'Stok Pinjam', 'trim|required');

		if ($this->form_validation->run() == true) {

			$id = $this->input->post('id_genset', true);
			$kode_genset = $this->input->post('kode_genset', true);
			$nama_genset = $this->input->post('nama_genset', true);
			$daya = $this->input->post('daya', true);
			$harga = $this->input->post('harga', true);
			$stok_gd = $this->input->post('stok_gd', true);
			$stok_pj = $this->input->post('stok_pj', true);
			$gambar_genset_old = $this->input->post('gambar_genset_old', true);

			$gambar_genset = $this->upload_gambargenset();

			if ($gambar_genset == '<p>You did not select a file to upload.</p>') {
				$gambar_genset_new = $gambar_genset_old;
			} else {
				$gambar_genset_new = $gambar_genset;
			}

			$where = array('id_genset' => $id);
			$data = array(
				'kode_genset' => $kode_genset,
				'nama_genset' => $nama_genset,
				'daya' => $daya,
				'harga' => $harga,
				'stok_gd' => $stok_gd,
				'stok_pj' => $stok_pj,
				'gambar_genset' => $gambar_genset_new
			);
			$this->M_admin->update('tb_genset', $data, $where);

			$this->session->set_flashdata('msg_sukses', 'Data Genset Berhasil Di Update');
			redirect(base_url('admin/tabel_genset'));
		} else {
			$data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
			$data['title'] = 'Update Genset';
			$this->load->view('admin/form_genset/updategenset', $data);
		}
	}

	public function hapus_data()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_genset' => $uri);
		// $data['gambar_genset'] = $this->M_admin->get_data_tb('tb_genset', $where);
		// unlink('assets/upload/genset/' . $where['gambar_genset']);
		$this->M_admin->delete('tb_genset', $where);
		redirect(base_url('admin/tabel_genset'));
	}
	####################################
	//* End Data Genset 
	####################################

	####################################
	//* Data Perbaikan Genset 
	####################################

	public function tabel_service_genset()
	{
		$data['list_data'] = $this->M_admin->get_data_service('tb_serv_genset');
		$data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
		$data['title'] = 'Data Perbaikan Genset';
		$this->load->view('admin/form_service_genset/tabel_service_genset', $data);
	}

	public function tambah_service_genset()
	{
		$data['list_genset'] = $this->M_admin->select('tb_genset');
		$data['list_sparepart'] = $this->M_admin->select('tb_sparepart');
		$data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
		$data['title'] = 'Tambah Perbaikan Genset';
		$this->load->view('admin/form_service_genset/tambah_service_genset', $data);
	}

	public function proses_tambah_service_genset()
	{
		$this->form_validation->set_rules('id_genset', 'Kode Genset', 'trim|required');
		// $this->form_validation->set_rules('nama_genset', 'Nama Genset', 'trim|required');
		$this->form_validation->set_rules('jenis_perbaikan', 'Jenis Perbaikan', 'trim|required');
		$this->form_validation->set_rules('tgl_perbaikan', 'Tanggal Perbaikan', 'trim|required');
		$this->form_validation->set_rules('ket_perbaikan', 'Keterangan Perbaikan', 'trim|required');
		$this->form_validation->set_rules('biaya_perbaikan', 'Biaya Perbaikan', 'trim|required');

		if ($this->form_validation->run() == true) {
			$stok = $this->input->post('stok', true);

			$kode_genset = $this->input->post('id_genset', true);
			// $nama_genset = $this->input->post('nama_genset', true);
			$jenis_perbaikan = $this->input->post('jenis_perbaikan', true);
			$spare_part = $this->input->post('id_sparepart', true);
			$tgl_perbaikan = $this->input->post('tgl_perbaikan', true);
			$ket_perbaikan = $this->input->post('ket_perbaikan', true);
			$biaya_perbaikan = $this->input->post('biaya_perbaikan', true);

			$data = array(
				'id_genset' => $kode_genset,
				// 'nama_genset' => $nama_genset,
				'jenis_perbaikan' => $jenis_perbaikan,
				'id_sparepart' => $spare_part,
				'tgl_perbaikan' => $tgl_perbaikan,
				'ket_perbaikan' => $ket_perbaikan,
				'biaya_perbaikan' => $biaya_perbaikan
			);
			$stok_new = --$stok;

			$this->M_admin->mengurangi_stok('tb_sparepart', $spare_part, $stok_new);
			$this->M_admin->insert('tb_serv_genset', $data);
			$this->session->set_flashdata('msg_sukses', 'Data Berhasil Di Tambah');
			redirect(base_url('admin/tabel_service_genset'));
		} else {
			$data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
			$data['title'] = 'Tambah Perbaikan Genset';
			$this->load->view('admin/form_service_genset/tambah_service_genset', $data);
		}
	}

	public function update_data_service_genset()
	{
		$data['list_genset'] = $this->M_admin->select('tb_genset');
		$data['list_sparepart'] = $this->M_admin->select('tb_sparepart');
		$uri = $this->uri->segment(3);
		$where = array('id_perbaikan_gst' => $uri);
		$data['list_data'] = $this->M_admin->get_data_tb('tb_serv_genset', $where);
		$data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
		$data['title'] = 'Update Perbaikan Genset';
		$this->load->view('admin/form_service_genset/update_service_genset', $data);
	}

	public function proses_update_service_genset()
	{
		// $this->form_validation->set_rules('id_genset', 'Kode Genset', 'trim|required');
		// $this->form_validation->set_rules('nama_genset', 'Nama Genset', 'trim|required');
		$this->form_validation->set_rules('jenis_perbaikan', 'Jenis Perbaikan', 'trim|required');
		$this->form_validation->set_rules('tgl_perbaikan', 'Tanggal Perbaikan', 'trim|required');
		$this->form_validation->set_rules('ket_perbaikan', 'Keterangan Perbaikan', 'trim|required');
		$this->form_validation->set_rules('biaya_perbaikan', 'Biaya Perbaikan', 'trim|required');

		if ($this->form_validation->run() === TRUE) {
			$stok = $this->input->post('stok', true);

			$id = $this->input->post('id_perbaikan_gst', TRUE);
			$kode_genset = $this->input->post('id_genset', TRUE);
			// $nama_genset = $this->input->post('nama_genset', TRUE);
			$jenis_perbaikan = $this->input->post('jenis_perbaikan', TRUE);
			$spare_part = $this->input->post('id_sparepart', TRUE);
			$tgl_perbaikan = $this->input->post('tgl_perbaikan', TRUE);
			$ket_perbaikan = $this->input->post('ket_perbaikan', TRUE);
			$biaya_perbaikan = $this->input->post('biaya_perbaikan', TRUE);

			$where = array('id_perbaikan_gst' => $id);
			$data = array(
				'id_genset' => $kode_genset,
				// 'nama_genset' => $nama_genset,
				'jenis_perbaikan' => $jenis_perbaikan,
				'id_sparepart' => $spare_part,
				'tgl_perbaikan' => $tgl_perbaikan,
				'ket_perbaikan' => $ket_perbaikan,
				'biaya_perbaikan' => $biaya_perbaikan,
			);
			$stok_new = --$stok;

			$this->M_admin->mengurangi_stok('tb_sparepart', $spare_part, $stok_new);
			$this->M_admin->update('tb_serv_genset', $data, $where);
			$this->session->set_flashdata('msg_sukses', 'Data Berhasil Di Update');
			redirect(base_url('admin/tabel_service_genset'));
		} else {
			$data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
			$data['title'] = 'Update Perbaikan Genset';
			$this->load->view('admin/form_service_genset/update_service_genset', $data);
		}
	}

	public function hapus_service_genset()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_perbaikan_gst' => $uri);
		$this->M_admin->delete('tb_serv_genset', $where);
		$this->session->set_flashdata('msg_sukses', 'Data Berhasil Dihapus');
		redirect(base_url('admin/tabel_service_genset'));
	}

	####################################
	//* End Data Perbaikan Genset 
	####################################

	####################################
	//* Data Sparepart 
	####################################

	public function tabel_sparepart()
	{
		// $where = array('stok');
		$data['count'] = $this->M_admin->notif_stok('tb_sparepart');
		$data['num'] = $this->M_admin->notif_stok_jml('tb_sparepart');

		$data['list_sparepart'] = $this->M_admin->select('tb_sparepart');
		$data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
		$data['title'] = 'Data Sparepart';
		$this->load->view('admin/form_sparepart/tabel_sparepart', $data);
	}

	public function tambah_data_sparepart()
	{
		$data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
		$data['title'] = 'Tambah Stok Sparepart';
		$this->load->view('admin/form_sparepart/tambah_sparepart', $data);
	}

	public function proses_tambah_sparepart()
	{
		$this->form_validation->set_rules('nama_sparepart', 'Nama Sparepart', 'trim|required');
		$this->form_validation->set_rules('tanggal_beli', 'Tanggal Beli', 'trim|required');
		$this->form_validation->set_rules('tempat_beli', 'Tempat Beli', 'trim|required');
		$this->form_validation->set_rules('stok', 'Stok', 'trim|required');

		if ($this->form_validation->run() === true) {

			$nama_sparepart = $this->input->post('nama_sparepart', true);
			$tanggal_beli = $this->input->post('tanggal_beli', true);
			$tempat_beli = $this->input->post('tempat_beli', true);
			$stok = $this->input->post('stok', true);

			// $tanggal_beli = date('Y-m-d', strtotime($tanggal_beli));
			$data = array(
				'nama_sparepart' => $nama_sparepart,
				'tanggal_beli' => $tanggal_beli,
				'tempat_beli' => $tempat_beli,
				'stok' => $stok
			);
			$this->M_admin->insert('tb_sparepart', $data);
			$this->session->set_flashdata('msg_sukses', 'Data Sparepart Berhasil Ditambah');
			redirect(base_url('admin/tabel_sparepart'));
		} else {
			$data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
			$data['title'] = 'Tambah Stok Sparepart';
			$this->load->view('admin/form_sparepart/tambah_sparepart', $data);
		}
	}

	public function update_sparepart()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_sparepart' => $uri);
		$data['data_sparepart'] = $this->M_admin->get_data_tb('tb_sparepart', $where);
		$data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
		$data['title'] = 'Edit Stok Sparepart';
		$this->load->view('admin/form_sparepart/update_sparepart', $data);
	}

	public function proses_update_sparepart()
	{
		$this->form_validation->set_rules('nama_sparepart', 'Nama Sparepart', 'trim|required');
		$this->form_validation->set_rules('tanggal_beli', 'Tanggal Beli', 'trim|required');
		$this->form_validation->set_rules('tempat_beli', 'Tempat Beli', 'trim|required');
		$this->form_validation->set_rules('stok', 'Stok', 'trim|required');
		if ($this->form_validation->run() === true) {

			$id = $this->input->post('id', true);
			$nama_sparepart = $this->input->post('nama_sparepart', true);
			$tanggal_beli = $this->input->post('tanggal_beli', true);
			$tempat_beli = $this->input->post('tempat_beli', true);
			$stok = $this->input->post('stok', true);

			// $tanggal_beli = date('Y-m-d', strtotime($tanggal_beli));
			$where = array('id_sparepart' => $id);
			$data = array(
				'nama_sparepart' => $nama_sparepart,
				'tanggal_beli' => $tanggal_beli,
				'tempat_beli' => $tempat_beli,
				'stok' => $stok
			);
			$this->M_admin->update('tb_sparepart', $data, $where);
			$this->session->set_flashdata('msg_sukses', 'Data Sparepart Berhasil Diupdate');
			redirect(base_url('admin/tabel_sparepart'));
		} else {
			$data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
			$data['title'] = 'Edit Stok Sparepart';
			$this->load->view('admin/form_sparepart/update_sparepart', $data);
		}
	}

	public function hapus_sparepart()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_sparepart' => $uri);
		$this->M_admin->delete('tb_sparepart', $where);
		$this->session->set_flashdata('msg_sukses', 'Data Berhasil Dihapus');
		redirect(base_url('admin/tabel_sparepart'));
	}

	####################################
	//* End Data Sparepart 
	####################################

	####################################
	//* Data Mobil 
	####################################

	public function tabel_mobil()
	{
		$data['list_data'] = $this->M_admin->select('tb_mobil');
		$data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
		$data['title'] = 'Data Mobil';
		$this->load->view('admin/form_mobil/tabel_mobil', $data);
	}

	public function tambah_data_mobil()
	{
		$data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
		$data['title'] = 'Tambah Data Mobil';
		$this->load->view('admin/form_mobil/tambah_mobil', $data);
	}

	public function update_data_mobil()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_mobil' => $uri);
		$data['list_data'] = $this->M_admin->get_data_tb('tb_mobil', $where);
		// $data['list_data_bbm'] = $this->M_admin->get_data_tb('tb_mobil', $where);
		$data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
		$data['title'] = 'Edit Data Mobil';
		$this->load->view('admin/form_mobil/update_mobil', $data);
	}

	public function hapus_mobil()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_mobil' => $uri);
		$this->M_admin->delete('tb_mobil', $where);
		$this->session->set_flashdata('msg_sukses', 'Data Berhasil Dihapus');
		redirect(base_url('admin/tabel_mobil'));
	}

	public function upload_gambar_mobil()
	{
		$config = array(
			'upload_path' => './assets/upload/mobil/',
			'allowed_types' => 'gif|jpg|png|jpeg',
			'ecrypt_name'	=> false,
			'overwrite'	=> true,
			// 'file_name'	=> uniqid(),
			'max_size' => 2048,
			'max_height' => 1920,
			'max_width' => 1080
		);
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('gambar_mobil')) {
			$error = $this->upload->display_errors();
			return $error;
			// die('gagal diupload');
		} else {
			$data_upload = array('upload_data' => $this->upload->data());
			$userfile = $data_upload['upload_data']['file_name'];

			return $userfile;
		}
	}

	public function proses_tambah_mobil()
	{
		$this->form_validation->set_rules('merek', 'Merek', 'trim|required');
		$this->form_validation->set_rules('tipe', 'Tipe', 'trim|required');
		$this->form_validation->set_rules('tahun', 'Tahun', 'trim|required');
		$this->form_validation->set_rules('nopol', 'Nopol', 'trim|required');
		$this->form_validation->set_rules('jenis_bbm', 'Jenis_BBM', 'trim|required');
		$this->form_validation->set_rules('pajak', 'Pajak', 'trim|required');
		$this->form_validation->set_rules('stnk', 'Stnk', 'trim|required');

		if ($this->form_validation->run() === TRUE) {

			$gambar_mobil = $this->upload_gambar_mobil();

			$merek = $this->input->post('merek', TRUE);
			$tipe = $this->input->post('tipe', TRUE);
			$tahun = $this->input->post('tahun', TRUE);
			$nopol = $this->input->post('nopol', TRUE);
			$jenis_bbm = $this->input->post('jenis_bbm', TRUE);
			$pajak = $this->input->post('pajak', TRUE);
			$stnk = $this->input->post('stnk', TRUE);

			$data = array(
				'merek' => $merek,
				'tipe' => $tipe,
				'tahun' => $tahun,
				'nopol' => $nopol,
				'jenis_bbm' => $jenis_bbm,
				'pajak' => $pajak,
				'stnk' => $stnk,
				'gambar_mobil' => $gambar_mobil
			);
			$this->M_admin->insert('tb_mobil', $data);
			$this->session->set_flashdata('msg_sukses', 'Data Berhasil Di Tambahkan');
			redirect(base_url('admin/tabel_mobil'));
		} else {
			$data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
			$data['title'] = 'Tambah Data Mobil';
			$this->load->view('admin/form_mobil/tambah_mobil', $data);
		}
	}

	public function proses_update_mobil()
	{
		$this->form_validation->set_rules('merek', 'Merek', 'trim|required');
		$this->form_validation->set_rules('tipe', 'Tipe', 'trim|required');
		$this->form_validation->set_rules('tahun', 'Tahun', 'trim|required');
		$this->form_validation->set_rules('nopol', 'Nopol', 'trim|required');
		$this->form_validation->set_rules('jenis_bbm', 'Jenis_BBM', 'trim|required');
		$this->form_validation->set_rules('pajak', 'Pajak', 'trim|required');
		$this->form_validation->set_rules('stnk', 'Stnk', 'trim|required');

		if ($this->form_validation->run() === TRUE) {

			$gambar_mobil = $this->upload_gambar_mobil();

			$id = $this->input->post('id', TRUE);
			$merek = $this->input->post('merek', TRUE);
			$tipe = $this->input->post('tipe', TRUE);
			$tahun = $this->input->post('tahun', TRUE);
			$nopol = $this->input->post('nopol', TRUE);
			$jenis_bbm = $this->input->post('jenis_bbm', TRUE);
			$pajak = $this->input->post('pajak', TRUE);
			$stnk = $this->input->post('stnk', TRUE);
			$gambar_mobil_old = $this->input->post('gambar_mobil_old', TRUE);

			if ($gambar_mobil == '<p>You did not select a file to upload.</p>') {
				$gambar_mobil_new = $gambar_mobil_old;
			} else {
				$gambar_mobil_new = $gambar_mobil;
			}

			$where = array('id_mobil' => $id);
			$data = array(
				'merek' => $merek,
				'tipe' => $tipe,
				'tahun' => $tahun,
				'nopol' => $nopol,
				'jenis_bbm' => $jenis_bbm,
				'pajak' => $pajak,
				'stnk' => $stnk,
				'gambar_mobil' => $gambar_mobil_new
			);
			$this->M_admin->update('tb_mobil', $data, $where);
			$this->session->set_flashdata('msg_sukses', 'Data Berhasil Di Update');
			redirect(base_url('admin/tabel_mobil'));
		} else {
			$data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
			$data['title'] = 'Edit Data Mobil';
			$this->load->view('admin/form_mobil/update_mobil', $data);
		}
	}

	####################################
	// End Data Mobil 
	####################################

	####################################
	//* Data Operator 
	####################################

	public function tabel_operator()
	{
		$data['list_operator'] = $this->M_admin->select('tb_operator');
		$data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
		$data['title'] = 'Data Operator';
		$this->load->view('admin/form_operator/tabel_operator', $data);
	}

	public function tambah_data_operator()
	{
		$data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
		$data['title'] = 'Tambah Data Operator';
		$this->load->view('admin/form_operator/tambah_operator', $data);
	}

	public function update_data_operator()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_operator' => $uri);
		$data['list_data'] = $this->M_admin->get_data_tb('tb_operator', $where);
		$data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
		$data['title'] = 'Update Data Operator';
		$this->load->view('admin/form_operator/update_operator', $data);
	}

	public function proses_tambah_operator()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('no_hp', 'No Hp', 'trim|required');

		if ($this->form_validation->run() === TRUE) {
			$nama = $this->input->post('nama', TRUE);
			$alamat = $this->input->post('alamat', TRUE);
			$no_hp = $this->input->post('no_hp', TRUE);
			$status           = 1;

			$data = array(
				'nama' => $nama,
				'alamat' => $alamat,
				'no_hp' => $no_hp,
				'status_op' => $status
			);
			$this->M_admin->insert('tb_operator', $data);
			$this->session->set_flashdata('msg_sukses', 'Data Berhasil Di Tambahkan');
			redirect(base_url('admin/tabel_operator'));
		} else {
			$data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
			$data['title'] = 'Tambah Data Operator';
			$this->load->view('admin/form_operator/tambah_operator');
		}
	}

	public function proses_update_operator()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('no_hp', 'No Hp', 'trim|required');

		if ($this->form_validation->run() === TRUE) {
			$id = $this->input->post('id', TRUE);
			$nama = $this->input->post('nama', TRUE);
			$alamat = $this->input->post('alamat', TRUE);
			$no_hp = $this->input->post('no_hp', TRUE);

			$where = array('id_operator' => $id);
			$data = array(
				'nama' => $nama,
				'alamat' => $alamat,
				'no_hp' => $no_hp
			);
			$this->M_admin->update('tb_operator', $data, $where);
			$this->session->set_flashdata('msg_sukses', 'Data Berhasil Di Update');
			redirect(base_url('admin/tabel_operator'));
		} else {
			$data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
			$data['title'] = 'Update Data Operator';
			$this->load->view('admin/form_operator/update_operator');
		}
	}

	public function hapus_operator()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_operator' => $uri);
		$this->M_admin->delete('tb_operator', $where);
		$this->session->set_flashdata('msg_sukses', 'Data Berhasil Di Hapus');
		redirect(base_url('admin/tabel_operator'));
	}

	####################################
	// End Data Operator 
	####################################

	####################################
	//* Data Pelanggan 
	####################################

	public function tabel_pelanggan()
	{
		$data['list_pelanggan'] = $this->M_admin->select('tb_pelanggan');
		$data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
		$data['title'] = 'Data Pelanggan';
		$this->load->view('admin/form_pelanggan/tabel_pelanggan', $data);
	}

	public function tambah_data_pelanggan()
	{
		$data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
		$data['title'] = 'Tambah Data Pelanggan';
		$this->load->view('admin/form_pelanggan/tambah_pelanggan', $data);
	}

	public function update_data_pelanggan()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_pelanggan' => $uri);
		$data['list_data'] = $this->M_admin->get_data_tb('tb_pelanggan', $where);
		$data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
		$data['title'] = 'Update Data Pelanggan';
		$this->load->view('admin/form_pelanggan/update_pelanggan', $data);
	}

	public function hapus_pelanggan()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_pelanggan' => $uri);
		$this->M_admin->delete('tb_pelanggan', $where);
		$this->session->set_flashdata('msg_sukses', 'Data Berhasil Di Hapus');
		redirect(base_url('admin/tabel_pelanggan'));
	}

	public function proses_tambah_pelanggan()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('no_hp', 'No Hp', 'trim|required');
		$this->form_validation->set_rules('nama_perusahaan', 'Nama Perusahaan', 'trim|required');
		$this->form_validation->set_rules('tanggal_update', 'Tanggal Update', 'trim|required');

		if ($this->form_validation->run() === TRUE) {
			$nama = $this->input->post('nama', TRUE);
			$alamat = $this->input->post('alamat', TRUE);
			$no_hp = $this->input->post('no_hp', TRUE);
			$jenis_kelamin = $this->input->post('jenis_kelamin', TRUE);
			$nama_perusahaan = $this->input->post('nama_perusahaan', TRUE);
			$tgl_update = $this->input->post('tanggal_update', TRUE);
			$status           = 1;

			$data = array(
				'nama' => $nama,
				'alamat' => $alamat,
				'no_hp' => $no_hp,
				'jenis_kelamin' => $jenis_kelamin,
				'nama_perusahaan' => $nama_perusahaan,
				'tanggal_update' => $tgl_update,
				'ket_plg' => $status,
			);
			$this->M_admin->insert('tb_pelanggan', $data);
			$this->session->set_flashdata('msg_sukses', 'Data Berhasil Di Tambahkan');
			redirect(base_url('admin/tabel_pelanggan'));
		} else {
			$data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
			$data['title'] = 'Tambah Data Pelanggan';
			$this->load->view('admin/form_pelanggan/tambah_pelanggan');
		}
	}

	public function proses_update_pelanggan()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('no_hp', 'No Hp', 'trim|required');
		$this->form_validation->set_rules('nama_perusahaan', 'Nama Perusahaan', 'trim|required');
		$this->form_validation->set_rules('tanggal_update', 'Tanggal Update', 'trim|required');

		if ($this->form_validation->run() === TRUE) {
			$id = $this->input->post('id', TRUE);
			$nama = $this->input->post('nama', TRUE);
			$alamat = $this->input->post('alamat', TRUE);
			$no_hp = $this->input->post('no_hp', TRUE);
			$jenis_kelamin = $this->input->post('jenis_kelamin', TRUE);
			$nama_perusahaan = $this->input->post('nama_perusahaan', TRUE);
			$tgl_update = $this->input->post('tanggal_update', TRUE);

			$where = array('id_pelanggan' => $id);
			$data = array(
				'nama' => $nama,
				'alamat' => $alamat,
				'no_hp' => $no_hp,
				'jenis_kelamin' => $jenis_kelamin,
				'nama_perusahaan' => $nama_perusahaan,
				'tanggal_update' => $tgl_update

			);
			$this->M_admin->update('tb_pelanggan', $data, $where);
			$this->session->set_flashdata('msg_sukses', 'Data Berhasil Di Update');
			redirect(base_url('admin/tabel_pelanggan'));
		} else {
			$data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
			$data['title'] = 'Update Data Pelanggan';
			$this->load->view('admin/form_pelanggan/update_pelanggan');
		}
	}

	public function tabel_pelanggan_blacklist()
	{
		$data['list_pelanggan_blacklist'] = $this->M_admin->select('tb_pelanggan_blacklist');
		$data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
		$data['title'] = 'Data Pelanggan Blacklist';
		$this->load->view('admin/form_pelanggan/tabel_pelanggan_blacklist', $data);
	}

	public function pindah_data_pelanggan()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_pelanggan' => $uri);
		$data['list_plg'] = $this->M_admin->get_data_tb('tb_pelanggan', $where);
		$data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
		$data['title'] = 'Pindah Data Pelanggan';
		$this->load->view('admin/form_pelanggan/pindah_pelanggan_blacklist', $data);
	}

	public function proses_blacklist_pelanggan()
	{
		$id = $this->input->post('id', TRUE);
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('no_hp', 'No Hp', 'trim|required');
		$this->form_validation->set_rules('nama_perusahaan', 'Nama Perusahaan', 'trim|required');
		$this->form_validation->set_rules('tanggal_update', 'Tanggal Update', 'trim|required');
		if ($this->form_validation->run() === TRUE) {
			$nama = $this->input->post('nama', TRUE);
			$alamat = $this->input->post('alamat', TRUE);
			$no_hp = $this->input->post('no_hp', TRUE);
			$jenis_kelamin = $this->input->post('jenis_kelamin', TRUE);
			$nama_perusahaan = $this->input->post('nama_perusahaan', TRUE);
			$tgl_update = $this->input->post('tanggal_update', TRUE);

			$where = array('id_pelanggan' => $id);
			$data = array(
				'nama' => $nama,
				'alamat' => $alamat,
				'no_hp' => $no_hp,
				'jenis_kelamin' => $jenis_kelamin,
				'nama_perusahaan' => $nama_perusahaan,
				'tanggal_update' => $tgl_update
			);
			$this->M_admin->insert('tb_pelanggan_blacklist', $data);
			$this->session->set_flashdata('msg_sukses', 'Data Berhasil Di Pindah');
			$this->M_admin->delete('tb_pelanggan', $where);
			redirect(base_url('admin/tabel_pelanggan_blacklist'));
		} else {
			$data['avatar'] = $this->M_admin->get_data_avatar('tb_avatar', $this->session->userdata('name'));
			$data['title'] = 'Pindah Data Pelanggan';
			$this->load->view('admin/form_pelanggan/pindah_pelanggan_blacklist');
		}
	}

	public function hapus_pelanggan_blacklist()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_plg_blacklist' => $uri);
		$this->M_admin->delete('tb_pelanggan_blacklist', $where);
		$this->session->set_flashdata('msg_sukses', 'Data Berhasil Di Hapus');
		redirect(base_url('admin/tabel_pelanggan_blacklist'));
	}

	####################################
	// End Data Pelanggan 
	####################################

	####################################
	//* Data Barang Keluar 
	####################################

	public function tabel_barang_keluar()
	{
		$data['list_data'] = $this->M_admin->select('tb_barang_keluar');
		$data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
		$data['title'] = 'Data Genset Keluar';
		$this->load->view('admin/form_barang_keluar/tabel_barang_keluar', $data);
	}
	public function detail_barang_keluar($id_transaksi)
	{
		$where = array('id_transaksi' => $id_transaksi);
		$data['list_data'] = $this->M_admin->get_data_tb('tb_barang_keluar', $where);
		$data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
		$data['title'] = 'Detail Genset Keluar';
		$this->load->view('admin/form_barang_keluar/detail_keluar', $data);
	}

	public function tambah_genset_keluar()
	{
		$data['list_mobil'] = $this->M_admin->select('tb_mobil');
		$data['list_genset'] = $this->M_admin->select('tb_genset');
		$data['list_pelanggan'] = $this->M_admin->select('tb_pelanggan');
		$data['list_operator'] = $this->M_admin->select('tb_operator');
		$data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
		$data['title'] = 'Tambah Genset Keluar';
		$this->load->view('admin/form_barang_keluar/tambah_barang_keluar', $data);
	}

	public function proses_tambah_genset_keluar()
	{
		$this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
		$this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'required');
		$this->form_validation->set_rules('kode_genset', 'Kode Genset', 'required');

		if ($this->form_validation->run() == TRUE) {
			$stok_gd           = $this->input->post('stok_gd', TRUE);
			$stok_pj           = $this->input->post('stok_pj', TRUE);

			$id_transaksi     = $this->input->post('id_transaksi', TRUE);
			$tanggal_keluar          = $this->input->post('tanggal_keluar', TRUE);
			$lokasi           = $this->input->post('lokasi', TRUE);
			$nama_operator    = $this->input->post('nama_operator', TRUE);
			$nama_pelanggan   = $this->input->post('nama_pelanggan', TRUE);
			$kode_genset      = $this->input->post('kode_genset', TRUE);
			$nama_genset      = $this->input->post('nama_genset', TRUE);
			$daya             = $this->input->post('daya', TRUE);
			$harga            = $this->input->post('harga', TRUE);
			$nopol            = $this->input->post('nopol', TRUE);
			$mobil            = $this->input->post('tipe', TRUE);
			$tambahan         = $this->input->post('tambahan', TRUE);
			$jumlah_hari      = $this->input->post('jumlah_hari', TRUE);
			$total            = $this->input->post('total', TRUE);
			$status           = 1;

			$tanggal_masuk    = date('d-m-Y', strtotime($tanggal_keluar . "+" . $jumlah_hari . " days"));

			$data = array(
				'id_transaksi'     => $id_transaksi,
				'tanggal_keluar'          => $tanggal_keluar,
				'lokasi'           => $lokasi,
				'tanggal_masuk'    => $tanggal_masuk,
				'nama_operator'    => $nama_operator,
				'nama_pelanggan'   => $nama_pelanggan,
				'kode_genset'      => $kode_genset,
				'nama_genset'      => $nama_genset,
				'daya'             => $daya,
				'harga'            => $harga,
				'nopol'            => $nopol,
				'mobil'            => $mobil,
				'tambahan'         => $tambahan,
				'jumlah_hari'      => $jumlah_hari,
				'total'            => $total,
				'status'           => $status
			);
			$stok_gd_new = (int)$stok_gd - 1;
			$stok_pj_new = (int)$stok_pj + 1;

			$this->M_admin->mengurangi('tb_genset', $kode_genset, $stok_gd_new);
			$this->M_admin->menambah('tb_genset', $kode_genset, $stok_pj_new);
			$this->M_admin->insert('tb_barang_keluar', $data);
			$this->session->set_flashdata('msg_sukses', 'Data Barang Berhasil Ditambahkan');

			redirect(base_url('admin/tabel_barang_keluar'));
		} else {
			$data['list_genset'] = $this->M_admin->select('tb_genset');
			$data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
			$this->load->view('admin/form_barang_keluar/tambah_barang_keluar', $data);
		}
	}

	public function update_keluar($id_transaksi)
	{
		$where = array('id_transaksi' => $id_transaksi);
		$data['data_barang_update'] = $this->M_admin->get_data_tb('tb_barang_keluar', $where);
		$data['list_mobil'] = $this->M_admin->select('tb_mobil');
		$data['list_genset'] = $this->M_admin->select('tb_genset');
		$data['list_pelanggan'] = $this->M_admin->select('tb_pelanggan');
		$data['list_operator'] = $this->M_admin->select('tb_operator');
		$data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
		$data['title'] = 'Edit Genset Keluar';
		$this->load->view('admin/form_barang_keluar/update_barang_keluar', $data);
	}

	public function proses_update_genset_keluar()
	{
		$this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
		$this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'required');
		$this->form_validation->set_rules('kode_genset', 'Kode Genset', 'required');

		if ($this->form_validation->run() == TRUE) {

			$id_transaksi     = $this->input->post('id_transaksi', TRUE);
			$tanggal_keluar          = $this->input->post('tanggal_keluar', TRUE);
			$lokasi           = $this->input->post('lokasi', TRUE);
			$nama_operator    = $this->input->post('nama_operator', TRUE);
			$nama_pelanggan   = $this->input->post('nama_pelanggan', TRUE);
			$kode_genset      = $this->input->post('kode_genset', TRUE);
			$nama_genset      = $this->input->post('nama_genset', TRUE);
			$daya             = $this->input->post('daya', TRUE);
			$harga            = $this->input->post('harga', TRUE);
			$nopol            = $this->input->post('nopol', TRUE);
			$mobil            = $this->input->post('tipe', TRUE);
			$tambahan         = $this->input->post('tambahan', TRUE);
			$jumlah_hari      = $this->input->post('jumlah_hari', TRUE);
			$total            = $this->input->post('total', TRUE);

			$where = array('id_transaksi' => $id_transaksi);
			$data = array(
				'id_transaksi'     => $id_transaksi,
				'tanggal_keluar'          => $tanggal_keluar,
				'lokasi'           => $lokasi,
				'nama_operator'    => $nama_operator,
				'nama_pelanggan'   => $nama_pelanggan,
				'kode_genset'      => $kode_genset,
				'nama_genset'      => $nama_genset,
				'daya'             => $daya,
				'harga'            => $harga,
				'nopol'            => $nopol,
				'mobil'            => $mobil,
				'tambahan'         => $tambahan,
				'jumlah_hari'      => $jumlah_hari,
				'total'            => $total
			);

			$this->M_admin->update('tb_barang_keluar', $data, $where);
			$this->session->set_flashdata('msg_sukses', 'Data Berhasil Diupdate');
			redirect(base_url('admin/tabel_barang_keluar'));
		} else {
			$data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
			$this->load->view('admin/form_barang_keluar/tambah_barang_keluar', $data);
		}
	}

	public function update_baru($id_transaksi)
	{
		$where = array('id_transaksi' => $id_transaksi);
		$data['data_barang_update'] = $this->M_admin->get_data_tb('tb_barang_keluar', $where);
		$data['list_mobil'] = $this->M_admin->select('tb_mobil');
		$data['list_genset'] = $this->M_admin->select('tb_genset');
		$data['list_pelanggan'] = $this->M_admin->select('tb_pelanggan');
		$data['list_operator'] = $this->M_admin->select('tb_operator');
		$data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
		$data['title'] = 'Edit Genset Keluar';
		$this->load->view('admin/form_barang_keluar/update_barang_baru', $data);
	}

	public function proses_update_baru()
	{
		$this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
		$this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'required');
		$this->form_validation->set_rules('kode_genset', 'Kode Genset', 'required');

		if ($this->form_validation->run() == TRUE) {

			$id_transaksi     = $this->input->post('id_transaksi', TRUE);
			$tanggal_keluar          = $this->input->post('tanggal_keluar', TRUE);
			$lokasi           = $this->input->post('lokasi', TRUE);
			$nama_operator    = $this->input->post('nama_operator', TRUE);
			$nama_pelanggan   = $this->input->post('nama_pelanggan', TRUE);
			$kode_genset      = $this->input->post('kode_genset', TRUE);
			$nama_genset      = $this->input->post('nama_genset', TRUE);
			$daya             = $this->input->post('daya', TRUE);
			$harga            = $this->input->post('harga', TRUE);
			$nopol            = $this->input->post('nopol', TRUE);
			$mobil            = $this->input->post('tipe', TRUE);
			$tambahan         = $this->input->post('tambahan', TRUE);
			$jumlah_hari      = $this->input->post('jumlah_hari', TRUE);
			$total            = $this->input->post('total', TRUE);
			$status_a = NULL;

			$where = array('id_transaksi' => $id_transaksi);
			$data = array(
				'id_transaksi'     => $id_transaksi,
				'tanggal_keluar'          => $tanggal_keluar,
				'lokasi'           => $lokasi,
				'nama_operator'    => $nama_operator,
				'nama_pelanggan'   => $nama_pelanggan,
				'kode_genset'      => $kode_genset,
				'nama_genset'      => $nama_genset,
				'daya'             => $daya,
				'harga'            => $harga,
				'nopol'            => $nopol,
				'mobil'            => $mobil,
				'tambahan'         => $tambahan,
				'jumlah_hari'      => $jumlah_hari,
				'total'            => $total,
				'status_ajuan'	=> $status_a
			);
			$status_a = 0;
			$this->M_admin->update_status_aju('tb_barang_keluar', $id_transaksi, $status_a);
			$this->M_admin->update('tb_barang_keluar', $data, $where);
			$this->session->set_flashdata('msg_sukses', 'Data Berhasil Diupdate');
			redirect(base_url('admin/tabel_barang_keluar'));
		} else {
			$data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
			$this->load->view('admin/form_barang_keluar/update_barang_baru', $data);
		}
	}

	public function hapus_data_keluar()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_transaksi' => $uri);
		$this->M_admin->delete('tb_barang_keluar', $where);
		$this->session->set_flashdata('msg_sukses', 'Data Berhasil Dihapus');
		redirect(base_url('admin/tabel_barang_keluar'));
	}

	####################################
	// End Data Barang Keluar
	####################################

	####################################
	// Data Barang Masuk
	####################################

	public function tabel_barang_masuk()
	{
		$data = array(
			// 'list_mobil' => $this->M_admin->select('tb_mobil'),
			'list_data' => $this->M_admin->select('tb_barang_masuk'),
			'avatar'    => $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'))
		);
		$data['title'] = 'Tabel Genset Masuk';
		$this->load->view('admin/form_barang_masuk/tabel_barang_masuk', $data);
	}

	public function detail_barang_masuk($id_transaksi)
	{
		$where = array('id_transaksi' => $id_transaksi);
		$data['list_data'] = $this->M_admin->get_data_tb('tb_barang_masuk', $where);
		$data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
		$data['title'] = 'Detail Genset Masuk';
		$this->load->view('admin/form_barang_masuk/detail_masuk', $data);
	}

	public function barang_keluar()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_transaksi' => $uri);
		$data['data_barang_update'] = $this->M_admin->get_data_tb('tb_barang_keluar', $where);
		$data['list_genset'] = $this->M_admin->select('tb_genset');
		$data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
		$data['title'] = 'Update Genset Masuk';
		$this->load->view('admin/form_barang_masuk/update_barang_masuk', $data);
	}

	public function proses_data_masuk()
	{
		$this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'trim|required');

		$id_transaksi       = $this->input->post('id_transaksi', TRUE);

		if ($this->form_validation->run() === TRUE) {
			$stok_gd           = $this->input->post('stok_gd', TRUE);
			$stok_pj           = $this->input->post('stok_pj', TRUE);

			$tanggal_keluar          = $this->input->post('tanggal_keluar', TRUE);
			$tanggal_masuk    = $this->input->post('tanggal_masuk', TRUE);
			$lokasi           = $this->input->post('lokasi', TRUE);
			$nama_operator    = $this->input->post('nama_operator', TRUE);
			$nama_pelanggan   = $this->input->post('nama_pelanggan', TRUE);
			$kode_genset      = $this->input->post('kode_genset', TRUE);
			$nama_genset      = $this->input->post('nama_genset', TRUE);
			$daya             = $this->input->post('daya', TRUE);
			$harga            = $this->input->post('harga', TRUE);
			$nopol            = $this->input->post('nopol', TRUE);
			$mobil            = $this->input->post('tipe', TRUE);
			$tambahan         = $this->input->post('tambahan', TRUE);
			$jumlah_hari      = $this->input->post('jumlah_hari', TRUE);
			$jumlah_hari_lama = $this->input->post('jumlah_hari_lama', TRUE);
			$total            = $this->input->post('total', TRUE);

			$status_b = NULL;

			// if($jumlah_hari_lama == $jumlah_hari){
			//   $status = 1;
			// }else{
			//   $status = 0;
			// }

			$where = array('id_transaksi' => $id_transaksi);
			$data = array(
				'id_transaksi'    => $id_transaksi,
				'tanggal_keluar'          => $tanggal_keluar,
				'tanggal_masuk'   => $tanggal_masuk,
				'lokasi'           => $lokasi,
				'nama_operator'    => $nama_operator,
				'nama_pelanggan'   => $nama_pelanggan,
				'kode_genset'      => $kode_genset,
				'nama_genset'      => $nama_genset,
				'daya'             => $daya,
				'harga'            => $harga,
				'nopol'            => $nopol,
				'mobil'            => $mobil,
				'tambahan'         => $tambahan,
				'jumlah_hari'      => $jumlah_hari,
				'total'            => $total,
				'status'           => $status_b
			);
			$stok_gd_new = (int)$stok_gd + 1;
			$stok_pj_new = (int)$stok_pj - 1;
			$status = 0;

			$this->M_admin->update_status('tb_barang_keluar', $id_transaksi, $status);
			$this->M_admin->menambah_kembali('tb_genset', $kode_genset, $stok_gd_new);
			$this->M_admin->mengurangi_kembali('tb_genset', $kode_genset, $stok_pj_new);
			$this->M_admin->insert('tb_barang_masuk', $data);
			$this->session->set_flashdata('msg_sukses', 'Data Masuk Berhasil');
			// $this->M_admin->delete('tb_barang_masuk',$where);
			redirect(base_url('admin/tabel_barang_masuk'));
		} else {
			// $data['title'] = 'Update Genset Masuk';
			$this->load->view('form_barang_masuk/update_barang_masuk/' . $id_transaksi);
		}
	}
	public function barang_masuk_update()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_transaksi' => $uri);
		$data['data_barang_update'] = $this->M_admin->get_data_tb('tb_barang_masuk', $where);
		$data['list_genset'] = $this->M_admin->select('tb_genset');
		$data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
		$data['title'] = 'Perpanjang Pemakaian Genset';
		$this->load->view('admin/form_barang_masuk/perpanjang_masuk', $data);
	}

	public function proses_perpanjangan()
	{
		$this->form_validation->set_rules('jumlah_hari', 'Jumlah Hari', 'trim|required');
		$id_transaksi       = $this->input->post('id_transaksi', TRUE);

		if ($this->form_validation->run() === TRUE) {
			$stok_gd           = $this->input->post('stok_gd', TRUE);
			$stok_pj           = $this->input->post('stok_pj', TRUE);

			$tanggal_keluar          = $this->input->post('tanggal_keluar', TRUE);
			$tanggal_masuk    = $this->input->post('tanggal_masuk', TRUE);
			$lokasi           = $this->input->post('lokasi', TRUE);
			$nama_operator    = $this->input->post('nama_operator', TRUE);
			$nama_pelanggan   = $this->input->post('nama_pelanggan', TRUE);
			$kode_genset      = $this->input->post('kode_genset', TRUE);
			$nama_genset      = $this->input->post('nama_genset', TRUE);
			$daya             = $this->input->post('daya', TRUE);
			$harga            = $this->input->post('harga', TRUE);
			$nopol            = $this->input->post('nopol', TRUE);
			$mobil            = $this->input->post('tipe', TRUE);
			$tambahan         = $this->input->post('tambahan', TRUE);
			$jumlah_hari      = $this->input->post('jumlah_hari', TRUE);
			$jumlah_hari_lama = $this->input->post('jumlah_hari_lama', TRUE);
			$total            = $this->input->post('total', TRUE);

			$status = 1;

			$tanggal_masuk_new    = date('d-m-Y', strtotime($tanggal_keluar . "+" . $jumlah_hari . " days"));
			$total = $harga  * $jumlah_hari;
			if ($tanggal_masuk == $tanggal_masuk_new) {
				$tanggal_masuk_up = $tanggal_masuk;
			} else {
				$tanggal_masuk_up = $tanggal_masuk_new;
			}

			// if($jumlah_hari_lama == $jumlah_hari){
			//   $status = 1;
			// }else{
			//   $status = 0;
			// }

			$where = array('id_transaksi' => $id_transaksi);
			$data = array(
				'id_transaksi'    => $id_transaksi,
				'tanggal_keluar'          => $tanggal_keluar,
				'tanggal_masuk'   => $tanggal_masuk_up,
				'lokasi'           => $lokasi,
				'nama_operator'    => $nama_operator,
				'nama_pelanggan'   => $nama_pelanggan,
				'kode_genset'      => $kode_genset,
				'nama_genset'      => $nama_genset,
				'daya'             => $daya,
				'harga'            => $harga,
				'nopol'            => $nopol,
				'mobil'            => $mobil,
				'tambahan'         => $tambahan,
				'jumlah_hari'      => $jumlah_hari,
				'total'            => $total,
				'status'           => $status
			);

			$this->M_admin->update('tb_barang_masuk', $data, $where);
			$this->session->set_flashdata('msg_sukses', 'Data Berhasil Diupdate');
			// $this->M_admin->delete('tb_barang_masuk',$where);
			redirect(base_url('admin/tabel_barang_masuk'));
		} else {
			$this->load->view('form_barang_masuk/perpanjang_masuk/' . $id_transaksi);
		}
	}

	public function barang_masuk_kembali()
	{
		$uri = $this->uri->segment(3);
		$data['list_genset'] = $this->M_admin->select('tb_genset');
		$where = array('id_transaksi' => $uri);
		$status = 0;

		$data = array(
			'status' => $status
		);

		$this->M_admin->update('tb_barang_masuk', $data, $where);
		redirect(base_url('admin/tabel_barang_masuk'));
	}

	public function hapus_data_masuk()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_transaksi' => $uri);
		$this->M_admin->delete('tb_barang_masuk', $where);
		$this->session->set_flashdata('msg_sukses', 'Data Berhasil Dihapus');
		redirect(base_url('admin/tabel_barang_masuk'));
	}

	####################################
	// End Data Barang Masuk
	####################################

	####################################
	// Laporan
	####################################

	public function laporan()
	{
		$data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
		$data['title'] = 'Laporan';
		$this->load->view('admin/laporan/laporan', $data);
	}

	####################################
	// End Laporan
	####################################
}

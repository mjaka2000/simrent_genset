<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_data');
		$this->load->library('upload');
		$this->load->library('mailer');
		if ($this->session->userdata('role') != '0') {
			redirect(site_url("login"));
		}
	}

	public function index()
	{
		// $bulan = $this->input->get('bulan');
		// $tahun = $this->input->get('tahun');
		$tgl = date('Y-m-d');
		$bulan = date('m');
		$tahun = date('Y');
		$label = 'Bulan ' . $bulan . ' Tahun ' .  $tahun;
		$data['pendapatan'] = $this->M_data->sum_pendapatanMasuk('tb_pendapatan', $bulan, $tahun);
		// $data['pendapatanChart'] = $this->M_data->chart_pendapatanMasuk('tb_pendapatan');
		$data['notifOut'] = $this->M_data->notif_u_keluar('tb_unit_penyewaan', $tgl);
		$data['numOut'] = $this->M_data->notif_u_keluarJml('tb_unit_penyewaan', $tgl);
		$data['UnitKeluar'] = $this->M_data->numrows_where_uKeluar('tb_unit_penyewaan');
		$data['stokBarangKeluar'] = $this->M_data->numrows_where_uMasuk('tb_unit_penyewaan');
		$data['jdwGst'] = $this->M_data->numrows('tb_jadwal_genset');
		$data['notifJdw'] = $this->M_data->notif_jdwGst('tb_jadwal_genset', $tgl);
		$data['numJdw'] = $this->M_data->notif_jdwGst_Jml('tb_jadwal_genset', $tgl);

		$data['dataUser'] = $this->M_data->numrows('tb_user');
		$data['dataPelanggan'] = $this->M_data->numrows('tb_pelanggan');
		$data['dataOperator'] = $this->M_data->numrows('tb_operator');
		$data['dataServGenset'] = $this->M_data->numrows('tb_serv_genset');
		$data['dataStokSparepart'] = $this->M_data->numrows('tb_sparepart');
		$data['dataPengeluaran'] = $this->M_data->numrows('tb_pengeluaran');
		// $data['count'] = $this->M_data->notif_stok('tb_sparepart');
		// $data['num'] = $this->M_data->notif_stok_jml('tb_sparepart');
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Home';
		$data['label'] = $label;
		$this->load->view('admin/index', $data);
	}
	public function logout()
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
		$data['count'] = $this->M_data->notif_stok('tb_sparepart');
		$this->load->view('template/nav', $data);
	}*/

	public function backup_db()
	{
		$this->load->dbutil();
		$db_name = $this->db->database . '.sql';
		$prefs = array(
			'format' => 'txt',
			'filename' => $db_name,
			// 'add_insert' => true,
			// 'foreign_key_checks' => false
		);

		$backup = $this->dbutil->backup($prefs);
		$save = '.assets/backup_db/' . $db_name;

		$this->load->helper('file');
		write_file($save, $backup);

		$this->load->helper('download');
		force_download($db_name, $backup);
	}

	####################################
	//* Users
	####################################
	public function users()
	{
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['user'] = $this->M_data->select('tb_user');
		$data['title'] = 'Users';
		$this->load->view('admin/users/users', $data);
	}

	public function tambah_users()
	{
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Tambah User';
		$this->load->view('admin/users/tambahuser', $data);
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
				'nama_file' => 'nopic.png'

			);
			$this->M_data->insert('tb_user', $data);
			$this->session->set_flashdata('msg_sukses', 'User Berhasil Ditambahkan');
			redirect(site_url('admin/users'));
		} else {
			$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
			$data['title'] = 'Tambah User';
			// $this->load->view('admin/users/tambahuser', $data);
			$this->load->view('admin/users/users', $data);
		}
	}

	public function proses_deleteuser()
	{
		$id_user = $this->uri->segment(3);
		$where = array('id_user' => $id_user);
		$this->M_data->delete('tb_user', $where);
		$this->session->set_flashdata('msg_sukses', 'User Berhasil Dihapus');
		redirect(site_url('admin/users'));
	}

	public function edit_user()
	{
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$id_user = $this->uri->segment(3);
		$where = array('id_user' => $id_user);
		$data['list_data'] = $this->M_data->get_data('tb_user', $where);
		$data['title'] = 'Edit User';
		$this->load->view('admin/users/edituser', $data);
	}

	public function proses_edituser()
	{
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('nama', 'Nama', 'required');

		if ($this->form_validation->run() == true) {
			$id_user	= $this->input->post('id_user', true);
			$username	= $this->input->post('username', true);
			$nama	= $this->input->post('nama', true);
			$role = $this->input->post('role', true);

			$where = array('id_user' => $id_user);
			$data = array(
				'username' => $username,
				'nama' => $nama,
				'role' => $role,
			);
			$this->M_data->update('tb_user', $data, $where);
			$this->session->set_flashdata('msg_sukses', 'Data User Berhasil Diubah');
			redirect(site_url('admin/users'));
		} else {
			$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
			$data['title'] = 'Edit User';
			// $this->load->view('admin/users/edituser', $data);
			$this->load->view('admin/users/users', $data);
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
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Profile';
		$this->load->view('admin/users/profile', $data);
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
				'id_user' => $this->session->userdata('id_user')
			);
			$this->M_data->update_password('tb_user', $where, $data);
			$this->session->set_flashdata('msg_sukses', 'Password Berhasil Diganti, Silahkan Logout dan Login Kembali');
			redirect(site_url('admin/profile'));
		} else {
			$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
			$data['title'] = 'Profile';
			$this->load->view('admin/users/profile', $data);
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
			'max_size' => "1024",
			'max_height' => "1024",
			'max_width' => "1024"
		);
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('userpicture')) {
			$this->session->set_flashdata('msg_gambar_error', $this->upload->display_errors());
			$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
			$data['title'] = 'Profile';
			$this->load->view('admin/users/profile', $data);
		} else {
			$data_upload = array('upload_data' => $this->upload->data());
			$nama_file = $data_upload['upload_data']['file_name'];

			$where = array(
				'username' => $this->session->userdata('name')
			);
			$data = array(
				'nama_file' => $nama_file
			);

			$this->M_data->update_avatar($where, $data);
			$this->session->set_flashdata('msg_gambar_sukses', 'Gambar Berhasil Di Upload');
			redirect(site_url('admin/profile'));
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
		$data['list_data'] = $this->M_data->select('tb_genset');
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Data Genset';
		$this->load->view('admin/genset/tabel_genset', $data);
	}

	public function tambah_genset()
	{
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Tambah Genset';
		$this->load->view('admin/genset/tambahgenset', $data);
	}

	public function proses_tambahgenset()
	{
		$this->form_validation->set_rules('kode_genset', 'Kode Genset', 'trim|required');
		$this->form_validation->set_rules('nama_genset', 'Nama Genset', 'trim|required');
		$this->form_validation->set_rules('daya', 'Daya', 'trim|required');
		$this->form_validation->set_rules('harga', 'Harga', 'trim|required');
		// $this->form_validation->set_rules('ket_genset', 'Ket. Genset', 'trim|required');
		// $this->form_validation->set_rules('stok_gd', 'Stok GUdang', 'trim|required');
		// $this->form_validation->set_rules('stok_pj', 'Stok Pinjam', 'trim|required');

		if ($this->form_validation->run() == true) {
			$gambar_genset = $this->upload_gambargenset();

			$kode_genset = $this->input->post('kode_genset', true);
			$nama_genset = $this->input->post('nama_genset', true);
			$daya = $this->input->post('daya', true);
			$harga = $this->input->post('harga', true);
			// $ket_genset = $this->input->post('ket_genset', true);
			// $stok_gd = $this->input->post('stok_gd', true);
			// $stok_pj = $this->input->post('stok_pj', true);

			$data = array(
				'kode_genset' => $kode_genset,
				'nama_genset' => $nama_genset,
				'daya' => $daya,
				'harga' => $harga,
				// 'ket_genset' => $ket_genset,
				// 'stok_gd' => $stok_gd,
				// 'stok_pj' => $stok_pj,
				'gambar_genset' => $gambar_genset
			);

			$this->M_data->insert('tb_genset', $data);
			$this->session->set_flashdata('msg_sukses', 'Data Berhasil Disimpan');
			redirect(site_url('admin/tabel_genset'));
		} else {
			$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
			$data['title'] = 'Tambah Genset';
			// $this->load->view('admin/genset/tambahgenset', $data);
			$this->load->view('admin/genset/tabel_genset', $data);
		}
	}

	public function upload_gambargenset()
	{
		$config = array(
			'upload_path' => './assets/upload/genset/',
			'allowed_types' => 'jpg|png|jpeg',
			'ecrypt_name'	=> false,
			'overwrite'	=> true,
			// 'file_name'	=> uniqid(),
			'max_size' => 2048,
			'max_height' => 1080,
			'max_width' => 1920
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
		$data['data_genset'] = $this->M_data->get_data('tb_genset', $where);
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Update Genset';
		$this->load->view('admin/genset/updategenset', $data);
	}

	public function proses_updategenset()
	{
		$this->form_validation->set_rules('kode_genset', 'Kode Genset', 'trim|required');
		$this->form_validation->set_rules('nama_genset', 'Nama Genset', 'trim|required');
		$this->form_validation->set_rules('daya', 'Daya', 'trim|required');
		$this->form_validation->set_rules('harga', 'Harga', 'trim|required');
		$this->form_validation->set_rules('ket_genset', 'Ket. Genset', 'trim|required');
		// $this->form_validation->set_rules('stok_gd', 'Stok GUdang', 'trim|required');
		// $this->form_validation->set_rules('stok_pj', 'Stok Pinjam', 'trim|required');

		if ($this->form_validation->run() == true) {

			$id = $this->input->post('id_genset', true);
			$kode_genset = $this->input->post('kode_genset', true);
			$nama_genset = $this->input->post('nama_genset', true);
			$daya = $this->input->post('daya', true);
			$harga = $this->input->post('harga', true);
			$ket_genset = $this->input->post('ket_genset', true);
			// $stok_gd = $this->input->post('stok_gd', true);
			// $stok_pj = $this->input->post('stok_pj', true);
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
				'ket_genset' => $ket_genset,
				// 'stok_gd' => $stok_gd,
				// 'stok_pj' => $stok_pj,
				'gambar_genset' => $gambar_genset_new
			);
			$this->M_data->update('tb_genset', $data, $where);

			$this->session->set_flashdata('msg_sukses', 'Data Berhasil Diubah');
			redirect(site_url('admin/tabel_genset'));
		} else {
			$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
			$data['title'] = 'Update Genset';
			// $this->load->view('admin/genset/updategenset', $data);
			$this->load->view('admin/genset/tabel_genset', $data);
		}
	}

	public function hapus_data_genset()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_genset' => $uri);
		// $data['gambar_genset'] = $this->M_data->get_data('tb_genset', $where);
		// unlink('assets/upload/genset/' . $where['gambar_genset']);
		$this->M_data->delete('tb_genset', $where);
		$this->session->set_flashdata('msg_sukses', 'Data Berhasil Dihapus');
		redirect(site_url('admin/tabel_genset'));
	}
	####################################
	//* End Data Genset 
	####################################
	####################################
	//* Data Perbaikan Genset 
	####################################

	public function tabel_service_genset()
	{
		$data['list_genset'] = $this->M_data->select('tb_genset');
		$data['list_sparepart'] = $this->M_data->select('tb_sparepart');
		$data['list_data'] = $this->M_data->get_data_service('tb_serv_genset');
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Data Perbaikan Genset';
		$this->load->view('admin/service_genset/tabel_service_genset', $data);
	}

	/*
	public function ajax_list_serv()
	{
		header('Content-Type: application/json');
		$list_data = $this->M_data->get_datatables_serv();
		$data = array();
		$no = $this->input->post('start');
		//looping data mahasiswa
		foreach ($list_data as $d) {
			$no++;
			$row = array();
			//row pertama akan kita gunakan untuk btn edit dan delete
			$row[] = $no;
			$row[] = $d->kode_genset;
			$row[] = $d->nama_genset;
			$row[] = $d->jenis_perbaikan;
			$row[] = $d->nama_sparepart;
			$row[] = date('d-m-Y', strtotime($d->tgl_perbaikan));
			$row[] = $d->ket_perbaikan;
			$row[] = 'Rp&nbsp;' . number_format($d->biaya_perbaikan);
			$row[] = '<a href="' . site_url('admin/update_data_service_genset/' . $d->id_perbaikan_gst) . '" id="id_pemakai" type="button" class="btn btn-sm btn-info" name="btn_edit"><i class="fa fa-edit"></i></a>
            <a href="' . site_url('admin/hapus_service_genset/' . $d->id_perbaikan_gst) . '" type="button" class="btn btn-sm btn-danger btn-delete" name="btn_delete"><i class="fa fa-trash"></i></a>
            <a href="' . site_url('admin/detail_service_genset/' . $d->id_perbaikan_gst) . '" type="button" class="btn btn-sm btn-warning" name="btn_detail"><i class="fa fa-info-circle"></i></a>';
			$data[] = $row;
		}
		$output = array(
			"draw" => $this->input->post('draw'),
			"recordsTotal" => $this->M_data->count_all_serv(),
			"recordsFiltered" => $this->M_data->count_filtered_serv(),
			"data" => $data,
		);
		//output to json format
		$this->output->set_output(json_encode($output));
	}
*/

	public function tambah_service_genset()
	{
		$data['list_genset'] = $this->M_data->select('tb_genset');
		$data['list_sparepart'] = $this->M_data->select('tb_sparepart');
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Tambah Perbaikan Genset';
		$this->load->view('admin/service_genset/tambah_service_genset', $data);
	}

	public function proses_tambah_service_genset()
	{
		$this->form_validation->set_rules('id_genset', 'Kode Genset', 'trim|required');
		// $this->form_validation->set_rules('nama_genset', 'Nama Genset', 'trim|required');
		$this->form_validation->set_rules('jenis_perbaikan', 'Jenis Perbaikan', 'trim|required');
		$this->form_validation->set_rules('id_sparepart', 'Nama Sparepart', 'trim|required');
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

			$this->M_data->mengurangi_stok('tb_sparepart', $spare_part, $stok_new);
			$this->M_data->insert('tb_serv_genset', $data);
			$this->session->set_flashdata('msg_sukses', 'Data Berhasil Disimpan');
			redirect(site_url('admin/tabel_service_genset'));
		} else {
			$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
			$data['title'] = 'Tambah Perbaikan Genset';
			// $this->load->view('admin/service_genset/tambah_service_genset', $data);
			$this->load->view('admin/service_genset/tabel_service_genset', $data);
		}
	}

	public function update_data_service_genset()
	{
		$data['list_genset'] = $this->M_data->select('tb_genset');
		$data['list_sparepart'] = $this->M_data->select('tb_sparepart');
		$uri = $this->uri->segment(3);
		$where = array('id_perbaikan_gst' => $uri);
		$data['list_data'] = $this->M_data->get_data('tb_serv_genset', $where);
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Update Perbaikan Genset';
		$this->load->view('admin/service_genset/update_service_genset', $data);
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
			// $stok_new = --$stok;

			// $this->M_data->mengurangi_stok('tb_sparepart', $spare_part, $stok_new);
			$this->M_data->update('tb_serv_genset', $data, $where);
			$this->session->set_flashdata('msg_sukses', 'Data Berhasil Diubah');
			redirect(site_url('admin/tabel_service_genset'));
		} else {
			$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
			$data['title'] = 'Update Perbaikan Genset';
			// $this->load->view('admin/service_genset/update_service_genset', $data);
			$this->load->view('admin/service_genset/tabel_service_genset', $data);
		}
	}

	public function hapus_service_genset()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_perbaikan_gst' => $uri);
		$this->M_data->delete('tb_serv_genset', $where);
		$this->session->set_flashdata('msg_sukses', 'Data Berhasil Dihapus');
		redirect(site_url('admin/tabel_service_genset'));
	}

	public function detail_service_genset()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_perbaikan_gst' => $uri);
		$data['list_data'] = $this->M_data->get_detail_perbaikan('tb_serv_genset', $where);
		$data['detail_perbaikan'] = $this->M_data->detail_perbaikan('tb_detail_serv', $where);
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Update Perbaikan Genset';
		$this->load->view('admin/service_genset/detail_service_genset', $data);
	}

	public function tambah_service_detail()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_perbaikan_gst' => $uri);
		$data['list_data'] = $this->M_data->get_detail_perbaikan('tb_serv_genset', $where);
		$data['detail_perbaikan'] = $this->M_data->detail_perbaikan('tb_detail_serv', $where);
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Tambah Detail Perbaikan';
		$this->load->view('admin/service_genset/tambah_detailservice_genset', $data);
	}

	public function proses_tambah_service_detail()
	{
		$this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'trim|required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
		$this->form_validation->set_rules('kendala', 'Kendala', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');

		if ($this->form_validation->run() === true) {

			$id_perbaikan_gst = $this->input->post('id_perbaikan_gst', true);
			$pekerjaan = $this->input->post('pekerjaan', true);
			$tanggal = $this->input->post('tanggal', true);
			$kendala = $this->input->post('kendala', true);
			$status = $this->input->post('status', true);

			// $tanggal_beli = date('Y-m-d', strtotime($tanggal_beli));
			$data = array(
				'id_perbaikan_gst' => $id_perbaikan_gst,
				'pekerjaan' => $pekerjaan,
				'tanggal' => $tanggal,
				'kendala' => $kendala,
				'status' => $status
			);
			$this->M_data->insert('tb_detail_serv', $data);
			$this->session->set_flashdata('msg_sukses', 'Data Detail Berhasil Disimpan');
			redirect(site_url('admin/tabel_service_genset'));
		} else {
			$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
			$data['title'] = 'Tambah Detail Perbaikan';
			$this->load->view('admin/service_genset/tabel_service_genset', $data);
		}
	}

	public function hapus_detail()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_detail_serv' => $uri);
		$this->M_data->delete('tb_detail_serv', $where);
		$this->session->set_flashdata('msg_sukses', 'Data Berhasil Dihapus');
		redirect(site_url('admin/detail_service_genset'));
	}

	public function proses_update_ket_service()
	{

		$this->form_validation->set_rules('ket_perbaikan', 'Keterangan Perbaikan', 'trim|required');

		if ($this->form_validation->run() === TRUE) {

			$id = $this->input->post('id_perbaikan_gst', TRUE);
			$ket_perbaikan = $this->input->post('ket_perbaikan', TRUE);

			$where = array('id_perbaikan_gst' => $id);
			$data = array(
				'ket_perbaikan' => $ket_perbaikan,
			);
			$this->M_data->update('tb_serv_genset', $data, $where);
			$this->session->set_flashdata('msg_sukses', 'Data Berhasil Diubah');
			redirect(site_url('admin/tabel_service_genset'));
		} else {
			$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
			$data['title'] = 'Update Perbaikan Genset';
			$this->load->view('admin/service_genset/detail_service_genset', $data);
		}
	}
	####################################
	//* End Data Perbaikan Genset 
	####################################
	####################################
	//* Data Perbaikan Genset Acc
	####################################

	public function service_genset_acc()
	{
		$data['list_data'] = $this->M_data->select_ServGstAcc('tb_serv_gst_acc');
		$data['list_perbaikan'] = $this->M_data->get_Serv('tb_serv_genset');
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Perbaikan Genset Disetujui';
		$this->load->view('admin/service_gensetAcc/tabel_service_gensetAcc', $data);
	}

	public function tambah_service_genset_acc()
	{
		$data['list_perbaikan'] = $this->M_data->get_Serv('tb_serv_genset');
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Tambah Perbaikan Genset Disetujui';
		$this->load->view('admin/service_gensetAcc/tambah_service_gensetAcc', $data);
	}

	public function proses_tambah_ServGstAcc()
	{
		$this->form_validation->set_rules('id_perbaikan_gst', 'Perbaikan Genset Selesai', 'trim|required|is_unique[tb_serv_gst_acc.id_perbaikan_gst]');
		$this->form_validation->set_rules('tgl_setujui', 'Tanggal', 'trim|required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
		$this->form_validation->set_rules('status_ajuan', 'Status', 'trim|required');

		if ($this->form_validation->run() === true) {

			$id_perbaikan_gst = $this->input->post('id_perbaikan_gst', true);
			$tgl_setujui = $this->input->post('tgl_setujui', true);
			$keterangan = $this->input->post('keterangan', true);
			$status_ajuan = $this->input->post('status_ajuan', true);

			$data = array(
				'id_perbaikan_gst' => $id_perbaikan_gst,
				'tgl_setujui' => $tgl_setujui,
				'keterangan' => $keterangan,
				'status_ajuan' => $status_ajuan,
			);
			$this->M_data->insert('tb_serv_gst_acc', $data);
			$this->session->set_flashdata('msg_sukses', 'Data Berhasil Disimpan');
			redirect(site_url('admin/service_genset_acc'));
		} else {
			$data['list_perbaikan'] = $this->M_data->get_Serv('tb_serv_genset');
			$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
			$data['title'] = 'Tambah Perbaikan Genset Disetujui';
			$this->load->view('admin/service_gensetAcc/tambah_service_gensetAcc', $data);
		}
	}

	public function update_service_genset_acc()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_serv_gst_acc' => $uri);
		$data['list_data'] = $this->M_data->get_ServGstAcc('tb_serv_gst_acc', $where);
		$data['list_perbaikan'] = $this->M_data->get_Serv('tb_serv_genset');
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Ubah Perbaikan Genset Disetujui';
		$this->load->view('admin/service_gensetAcc/ubah_service_gensetAcc', $data);
	}

	public function proses_ubah_ServGstAcc()
	{
		$this->form_validation->set_rules('id_perbaikan_gst', 'Perbaikan Genset Selesai', 'trim|required');
		$this->form_validation->set_rules('tgl_setujui', 'Tanggal', 'trim|required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
		$this->form_validation->set_rules('status_ajuan', 'Status', 'trim|required');

		if ($this->form_validation->run() === true) {

			$id_serv_gst_acc = $this->input->post('id_serv_gst_acc', true);
			$id_perbaikan_gst = $this->input->post('id_perbaikan_gst', true);
			$tgl_setujui = $this->input->post('tgl_setujui', true);
			$keterangan = $this->input->post('keterangan', true);
			$status_ajuan = $this->input->post('status_ajuan', true);

			$where = array('id_serv_gst_acc' => $id_serv_gst_acc);
			$data = array(
				'id_perbaikan_gst' => $id_perbaikan_gst,
				'tgl_setujui' => $tgl_setujui,
				'keterangan' => $keterangan,
				'status_ajuan' => $status_ajuan,
			);
			$this->M_data->update('tb_serv_gst_acc', $data, $where);
			$this->session->set_flashdata('msg_sukses', 'Data Berhasil Diubah');
			redirect(site_url('admin/service_genset_acc'));
		} else {
			$data['list_perbaikan'] = $this->M_data->get_Serv('tb_serv_genset');
			$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
			$data['title'] = 'Ubah Perbaikan Genset Disetujui';
			$this->load->view('admin/service_gensetAcc/ubah_service_gensetAcc', $data);
		}
	}

	public function hapus_service_genset_acc()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_serv_gst_acc' => $uri);
		$this->M_data->delete('tb_serv_gst_acc', $where);
		$this->session->set_flashdata('msg_sukses', 'Data Berhasil Dihapus');
		redirect(site_url('admin/service_genset_acc'));
	}
	####################################
	//* End Data Perbaikan Genset Acc
	####################################
	####################################
	//* Data Sparepart 
	####################################

	public function tabel_sparepart()
	{
		// $where = array('stok');
		$data['count'] = $this->M_data->notif_stok('tb_sparepart');
		$data['num'] = $this->M_data->notif_stok_jml('tb_sparepart');

		$data['list_sparepart'] = $this->M_data->select('tb_sparepart');
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Data Sparepart';
		$this->load->view('admin/sparepart/tabel_sparepart', $data);
	}

	public function tambah_data_sparepart()
	{
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Tambah Stok Sparepart';
		$this->load->view('admin/sparepart/tambah_sparepart', $data);
	}

	public function proses_tambah_sparepart()
	{
		$this->form_validation->set_rules('nama_sparepart', 'Nama Sparepart', 'trim|required');
		$this->form_validation->set_rules('tanggal_beli', 'Tanggal Beli', 'trim|required');
		$this->form_validation->set_rules('tempat_beli', 'Tempat Beli', 'trim|required');
		$this->form_validation->set_rules('stok', 'Stok', 'trim|required');
		$this->form_validation->set_rules('harga_sparepart', 'Harga Sparepart', 'trim|required');

		if ($this->form_validation->run() === true) {

			$nama_sparepart = $this->input->post('nama_sparepart', true);
			$tanggal_beli = $this->input->post('tanggal_beli', true);
			$tempat_beli = $this->input->post('tempat_beli', true);
			$stok = $this->input->post('stok', true);
			$harga_sparepart = $this->input->post('harga_sparepart', true);

			// $tanggal_beli = date('Y-m-d', strtotime($tanggal_beli));
			$data = array(
				'nama_sparepart' => $nama_sparepart,
				'tanggal_beli' => $tanggal_beli,
				'tempat_beli' => $tempat_beli,
				'stok' => $stok,
				'harga_sparepart' => $harga_sparepart
			);
			$this->M_data->insert('tb_sparepart', $data);
			$this->session->set_flashdata('msg_sukses', 'Data Berhasil Disimpan');
			redirect(site_url('admin/tabel_sparepart'));
		} else {
			$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
			$data['title'] = 'Tambah Stok Sparepart';
			$data['list_sparepart'] = $this->M_data->select('tb_sparepart');
			$this->load->view('admin/sparepart/tabel_sparepart', $data);
		}
	}

	public function update_sparepart()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_sparepart' => $uri);
		$data['data_sparepart'] = $this->M_data->get_data('tb_sparepart', $where);
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Edit Stok Sparepart';
		$this->load->view('admin/sparepart/update_sparepart', $data);
	}

	public function proses_update_sparepart()
	{
		$this->form_validation->set_rules('nama_sparepart', 'Nama Sparepart', 'trim|required');
		$this->form_validation->set_rules('tanggal_beli', 'Tanggal Beli', 'trim|required');
		$this->form_validation->set_rules('tempat_beli', 'Tempat Beli', 'trim|required');
		$this->form_validation->set_rules('stok', 'Stok', 'trim|required');
		$this->form_validation->set_rules('harga_sparepart', 'Harga Sparepart', 'trim|required');
		if ($this->form_validation->run() === true) {

			$id = $this->input->post('id', true);
			$nama_sparepart = $this->input->post('nama_sparepart', true);
			$tanggal_beli = $this->input->post('tanggal_beli', true);
			$tempat_beli = $this->input->post('tempat_beli', true);
			$stok = $this->input->post('stok', true);
			$harga_sparepart = $this->input->post('harga_sparepart', true);

			// $tanggal_beli = date('Y-m-d', strtotime($tanggal_beli));
			$where = array('id_sparepart' => $id);
			$data = array(
				'nama_sparepart' => $nama_sparepart,
				'tanggal_beli' => $tanggal_beli,
				'tempat_beli' => $tempat_beli,
				'stok' => $stok,
				'harga_sparepart' => $harga_sparepart
			);
			$this->M_data->update('tb_sparepart', $data, $where);
			$this->session->set_flashdata('msg_sukses', 'Data Berhasil Diubah');
			redirect(site_url('admin/tabel_sparepart'));
		} else {
			$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
			$data['title'] = 'Edit Stok Sparepart';
			$data['list_sparepart'] = $this->M_data->select('tb_sparepart');
			$this->load->view('admin/sparepart/tabel_sparepart', $data);
		}
	}

	public function hapus_sparepart()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_sparepart' => $uri);
		$this->M_data->delete('tb_sparepart', $where);
		$this->session->set_flashdata('msg_sukses', 'Data Berhasil Dihapus');
		redirect(site_url('admin/tabel_sparepart'));
	}

	####################################
	//* End Data Sparepart 
	####################################
	####################################
	//* Data Mobil 
	####################################

	public function tabel_mobil()
	{
		$data['list_data'] = $this->M_data->select('tb_mobil');
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Data Mobil';
		$this->load->view('admin/mobil/tabel_mobil', $data);
	}

	public function tambah_data_mobil()
	{
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Tambah Data Mobil';
		$this->load->view('admin/mobil/tambah_mobil', $data);
	}

	public function update_data_mobil()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_mobil' => $uri);
		$data['list_data'] = $this->M_data->get_data('tb_mobil', $where);
		// $data['list_data_bbm'] = $this->M_data->get_data('tb_mobil', $where);
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Edit Data Mobil';
		$this->load->view('admin/mobil/update_mobil', $data);
	}

	public function hapus_mobil()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_mobil' => $uri);
		$this->M_data->delete('tb_mobil', $where);
		$this->session->set_flashdata('msg_sukses', 'Data Berhasil Dihapus');
		redirect(site_url('admin/tabel_mobil'));
	}

	public function upload_gambar_mobil()
	{
		$config = array(
			'upload_path' => './assets/upload/mobil/',
			'allowed_types' => 'jpg|png|jpeg',
			'ecrypt_name'	=> false,
			'overwrite'	=> true,
			// 'file_name'	=> uniqid(),
			'max_size' => 2048,
			'max_height' => 1080,
			'max_width' => 1920
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
			$this->M_data->insert('tb_mobil', $data);
			$this->session->set_flashdata('msg_sukses', 'Data Berhasil Disimpan');
			redirect(site_url('admin/tabel_mobil'));
		} else {
			$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
			$data['title'] = 'Tambah Data Mobil';
			// $this->load->view('admin/mobil/tambah_mobil', $data);
			$this->load->view('admin/mobil/tabel_mobil', $data);
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
			$this->M_data->update('tb_mobil', $data, $where);
			$this->session->set_flashdata('msg_sukses', 'Data Berhasil Diubah');
			redirect(site_url('admin/tabel_mobil'));
		} else {
			$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
			$data['title'] = 'Edit Data Mobil';
			// $this->load->view('admin/mobil/update_mobil', $data);
			$this->load->view('admin/mobil/tabel_mobil', $data);
		}
	}

	####################################
	//* End Data Mobil 
	####################################
	####################################
	//* Data Operator 
	####################################

	public function tabel_operator()
	{
		$data['list_operator'] = $this->M_data->select('tb_operator');
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Data Operator';
		$this->load->view('admin/operator/tabel_operator', $data);
	}

	public function tambah_data_operator()
	{
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Tambah Data Operator';
		$this->load->view('admin/operator/tambah_operator', $data);
	}

	public function update_data_operator()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_operator' => $uri);
		$data['list_data'] = $this->M_data->get_data('tb_operator', $where);
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Ubah Data Operator';
		$this->load->view('admin/operator/update_operator', $data);
	}

	public function proses_tambah_operator()
	{
		$this->form_validation->set_rules('nama_op', 'Nama', 'trim|required');
		$this->form_validation->set_rules('alamat_op', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('nohp_op', 'No Hp', 'trim|required');
		$this->form_validation->set_rules('noktp_op', 'No KTP', 'trim|required|is_unique[tb_operator.nama_op]');

		if ($this->form_validation->run() === TRUE) {
			$nama_op = $this->input->post('nama_op', TRUE);
			$alamat_op = $this->input->post('alamat_op', TRUE);
			$nohp_op = $this->input->post('nohp_op', TRUE);
			$noktp_op = $this->input->post('noktp_op', TRUE);
			$status           = 0;

			$data = array(
				'nama_op' => $nama_op,
				'alamat_op' => $alamat_op,
				'nohp_op' => $nohp_op,
				'noktp_op' => $noktp_op,
				'status_op' => $status
			);
			$this->M_data->insert('tb_operator', $data);
			$this->session->set_flashdata('msg_sukses', 'Data Berhasil Disimpan');
			redirect(site_url('admin/tabel_operator'));
		} else {
			$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
			$data['title'] = 'Tambah Data Operator';
			// $this->load->view('admin/operator/tambah_operator');
			$this->load->view('admin/operator/tabel_operator');
		}
	}

	public function proses_update_operator()
	{
		$this->form_validation->set_rules('nama_op', 'Nama', 'trim|required');
		$this->form_validation->set_rules('alamat_op', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('nohp_op', 'No Hp', 'trim|required');
		$this->form_validation->set_rules('noktp_op', 'No KTP', 'trim|required');
		$this->form_validation->set_rules('status_op', 'Status', 'trim|required');

		if ($this->form_validation->run() === TRUE) {
			$id = $this->input->post('id_operator', TRUE);
			$nama = $this->input->post('nama_op', TRUE);
			$alamat = $this->input->post('alamat_op', TRUE);
			$no_hp = $this->input->post('nohp_op', TRUE);
			$noktp_op = $this->input->post('noktp_op', TRUE);
			$status_op = $this->input->post('status_op', TRUE);

			$where = array('id_operator' => $id);
			$data = array(
				'nama_op' => $nama,
				'alamat_op' => $alamat,
				'nohp_op' => $no_hp,
				'noktp_op' => $noktp_op,
				'status_op' => $status_op
			);
			$this->M_data->update('tb_operator', $data, $where);
			$this->session->set_flashdata('msg_sukses', 'Data Berhasil Diubah');
			redirect(site_url('admin/tabel_operator'));
		} else {
			$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
			$data['title'] = 'Ubah Data Operator';
			// $this->load->view('admin/operator/update_operator');
			$this->load->view('admin/operator/tabel_operator');
		}
	}

	public function hapus_operator()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_operator' => $uri);
		$this->M_data->delete('tb_operator', $where);
		$this->session->set_flashdata('msg_sukses', 'Data Berhasil Dihapus');
		redirect(site_url('admin/tabel_operator'));
	}

	####################################
	//* End Data Operator 
	####################################
	####################################
	//* Data Pelanggan 
	####################################

	public function tabel_pelanggan()
	{
		$data['list_pelanggan'] = $this->M_data->get_Plg('tb_pelanggan');
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Data Pelanggan';
		$this->load->view('admin/pelanggan/tabel_pelanggan', $data);
	}

	public function tambah_data_pelanggan()
	{
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Tambah Data Pelanggan';
		$this->load->view('admin/pelanggan/tambah_pelanggan', $data);
	}

	public function update_data_pelanggan()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_pelanggan' => $uri);
		$data['list_data'] = $this->M_data->get_data('tb_pelanggan', $where);
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Ubah Data Pelanggan';
		$this->load->view('admin/pelanggan/update_pelanggan', $data);
	}

	public function hapus_pelanggan()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_pelanggan' => $uri);
		$this->M_data->delete('tb_pelanggan', $where);
		$this->session->set_flashdata('msg_sukses', 'Data Berhasil Dihapus');
		redirect(site_url('admin/tabel_pelanggan'));
	}

	public function proses_tambah_pelanggan()
	{
		$this->form_validation->set_rules('nama_plg', 'Nama', 'trim|required');
		$this->form_validation->set_rules('alamat_plg', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('nohp_plg', 'No Hp', 'trim|required');
		$this->form_validation->set_rules('jk_plg', 'Jenis Kelamin', 'trim|required');
		$this->form_validation->set_rules('namaperusahaan_plg', 'Nama Perusahaan', 'trim|required');
		$this->form_validation->set_rules('tglupdate_plg', 'Tanggal Update', 'trim|required');

		if ($this->form_validation->run() === TRUE) {
			$nama = $this->input->post('nama_plg', TRUE);
			$alamat = $this->input->post('alamat_plg', TRUE);
			$no_hp = $this->input->post('nohp_plg', TRUE);
			$jenis_kelamin = $this->input->post('jk_plg', TRUE);
			$nama_perusahaan = $this->input->post('namaperusahaan_plg', TRUE);
			$tgl_update = $this->input->post('tglupdate_plg', TRUE);
			// $status           = 1;

			$data = array(
				'nama_plg' => $nama,
				'alamat_plg' => $alamat,
				'nohp_plg' => $no_hp,
				'jk_plg' => $jenis_kelamin,
				'namaperusahaan_plg' => $nama_perusahaan,
				'tglupdate_plg' => $tgl_update,
				// 'ket_plg' => $status,
			);
			$this->M_data->insert('tb_pelanggan', $data);
			$this->session->set_flashdata('msg_sukses', 'Data Berhasil Disimpan');
			redirect(site_url('admin/tabel_pelanggan'));
		} else {
			$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
			$data['title'] = 'Tambah Data Pelanggan';
			$this->load->view('admin/pelanggan/tabel_pelanggan');
		}
	}

	public function proses_update_pelanggan()
	{
		$this->form_validation->set_rules('nama_plg', 'Nama', 'trim|required');
		$this->form_validation->set_rules('alamat_plg', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('nohp_plg', 'No Hp', 'trim|required');
		$this->form_validation->set_rules('jk_plg', 'Jenis Kelamin', 'trim|required');
		$this->form_validation->set_rules('namaperusahaan_plg', 'Nama Perusahaan', 'trim|required');
		$this->form_validation->set_rules('tglupdate_plg', 'Tanggal Update', 'trim|required');
		$this->form_validation->set_rules('status_plg', 'Status', 'trim|required');

		if ($this->form_validation->run() === TRUE) {
			$id = $this->input->post('id_pelanggan', TRUE);
			$nama = $this->input->post('nama_plg', TRUE);
			$alamat = $this->input->post('alamat_plg', TRUE);
			$no_hp = $this->input->post('nohp_plg', TRUE);
			$jenis_kelamin = $this->input->post('jk_plg', TRUE);
			$nama_perusahaan = $this->input->post('namaperusahaan_plg', TRUE);
			$tgl_update = $this->input->post('tglupdate_plg', TRUE);
			$status_plg = $this->input->post('status_plg', TRUE);

			$where = array('id_pelanggan' => $id);
			$data = array(
				'nama_plg' => $nama,
				'alamat_plg' => $alamat,
				'nohp_plg' => $no_hp,
				'jk_plg' => $jenis_kelamin,
				'namaperusahaan_plg' => $nama_perusahaan,
				'tglupdate_plg' => $tgl_update,
				'status_plg' => $status_plg

			);
			$this->M_data->update('tb_pelanggan', $data, $where);
			$this->session->set_flashdata('msg_sukses', 'Data Berhasil Diubah');
			redirect(site_url('admin/tabel_pelanggan'));
		} else {
			$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
			$data['title'] = 'Ubah Data Pelanggan';
			$this->load->view('admin/pelanggan/tabel_pelanggan');
		}
	}

	public function tabel_pelanggan_blacklist()
	{
		$data['list_pelanggan_blacklist'] = $this->M_data->get_Plg_Blc('tb_pelanggan');
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Data Pelanggan Blacklist';
		$this->load->view('admin/pelanggan/tabel_pelanggan_blacklist', $data);
	}

	public function pindah_data_pelanggan()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_pelanggan' => $uri);
		$ket_plg = 1;
		$data = array(
			'ket_plg' => $ket_plg
		);
		$this->M_data->update('tb_pelanggan', $data, $where);
		$this->session->set_flashdata('msg_sukses', 'Data Berhasil Dipindah');

		redirect(site_url('admin/tabel_pelanggan_blacklist'));
	}

	public function kembalikan_pelanggan()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_pelanggan' => $uri);
		$ket_plg = 0;
		$data = array(
			'ket_plg' => $ket_plg
		);
		$this->M_data->update('tb_pelanggan', $data, $where);
		$this->session->set_flashdata('msg_sukses', 'Data Berhasil Dipindah');

		redirect(site_url('admin/tabel_pelanggan'));
	}
	// public function pindah_data_pelanggan()
	// {
	// 	$uri = $this->uri->segment(3);
	// 	$where = array('id_pelanggan' => $uri);
	// 	$data['list_plg'] = $this->M_data->get_data('tb_pelanggan', $where);
	// 	$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
	// 	$data['title'] = 'Pindah Data Pelanggan';
	// 	$this->load->view('admin/pelanggan/pindah_pelanggan_blacklist', $data);
	// }

	// public function proses_blacklist_pelanggan()
	// {
	// 	$id = $this->input->post('id_pelanggan', TRUE);
	// 	$this->form_validation->set_rules('nama_plg_blk', 'Nama', 'trim|required');
	// 	$this->form_validation->set_rules('alamat_plg_blk', 'Alamat', 'trim|required');
	// 	$this->form_validation->set_rules('nohp_plg_blk', 'No Hp', 'trim|required');
	// 	$this->form_validation->set_rules('jk_plg_blk', 'Jenis Kelamin', 'trim|required');
	// 	$this->form_validation->set_rules('namaperusahaan_plg_blk', 'Nama Perusahaan', 'trim|required');
	// 	$this->form_validation->set_rules('tglupdate_plg_blk', 'Tanggal Update', 'trim|required');
	// 	if ($this->form_validation->run() === TRUE) {
	// 		$nama = $this->input->post('nama_plg_blk', TRUE);
	// 		$alamat = $this->input->post('alamat_plg_blk', TRUE);
	// 		$no_hp = $this->input->post('nohp_plg_blk', TRUE);
	// 		$jenis_kelamin = $this->input->post('jk_plg_blk', TRUE);
	// 		$nama_perusahaan = $this->input->post('namaperusahaan_plg_blk', TRUE);
	// 		$tgl_update = $this->input->post('tglupdate_plg_blk', TRUE);

	// 		$where = array('id_pelanggan' => $id);
	// 		$data = array(
	// 			'nama_plg_blk' => $nama,
	// 			'alamat_plg_blk' => $alamat,
	// 			'nohp_plg_blk' => $no_hp,
	// 			'jk_plg_blk' => $jenis_kelamin,
	// 			'namaperusahaan_plg_blk' => $nama_perusahaan,
	// 			'tglupdate_plg_blk' => $tgl_update
	// 		);
	// 		$this->M_data->insert('tb_pelanggan_blacklist', $data);
	// 		$this->session->set_flashdata('msg_sukses', 'Data Berhasil Dipindah');
	// 		$this->M_data->delete('tb_pelanggan', $where);
	// 		redirect(site_url('admin/tabel_pelanggan_blacklist'));
	// 	} else {
	// 		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
	// 		$data['title'] = 'Pindah Data Pelanggan';
	// 		$this->load->view('admin/pelanggan/pindah_pelanggan_blacklist');
	// 	}
	// }

	// public function hapus_pelanggan_blacklist()
	// {
	// 	$uri = $this->uri->segment(3);
	// 	$where = array('id_plg_blacklist' => $uri);
	// 	$this->M_data->delete('tb_pelanggan_blacklist', $where);
	// 	$this->session->set_flashdata('msg_sukses', 'Data Berhasil Dihapus');
	// 	redirect(site_url('admin/tabel_pelanggan_blacklist'));
	// }

	####################################
	//* End Data Pelanggan 
	####################################
	####################################
	//* Data Unit Keluar 
	####################################

	public function tabel_unit_keluar()
	{
		$data['list_mobil'] = $this->M_data->select('tb_mobil');
		$data['list_genset'] = $this->M_data->select_gst('tb_genset');
		$data['list_pelanggan'] = $this->M_data->get_Plg('tb_pelanggan');
		$data['list_operator'] = $this->M_data->select_op('tb_operator');
		$data['list_data'] = $this->M_data->get_data_u_keluar('tb_unit_penyewaan');
		// $data['total_data'] = $this->M_data->sum_pendapatan('tb_unit_penyewaan');
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Data Unit Sewa';
		$this->load->view('admin/unit_keluar/tabel_unit_keluar', $data);
	}

	public function detail_unit_keluar($id_transaksi)
	{
		$uri = $this->uri->segment(3);
		$where = array('id_u_sewa' => $uri);
		$data['list_data'] = $this->M_data->select_data_u_keluar('tb_unit_penyewaan', $where);
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Detail Data Unit Sewa';
		$this->load->view('admin/unit_keluar/detail_keluar', $data);
	}

	public function email_unit_keluar()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_u_sewa' => $uri);
		$tgl = date('Y-m-d');

		// $data['list_email'] = $this->M_admin->select('tb_user');
		$data['notifOut'] = $this->M_data->notif_u_keluar1('tb_unit_penyewaan', $tgl, $where);
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'email';
		$this->load->view('admin/unit_keluar/email_unit_keluar', $data);
	}

	public function kirim_unit_keluar()
	{
		$email_penerima = $this->input->post('email_penerima');
		$subjek = $this->input->post('subjek');
		$pesan = $this->input->post('pesan');
		// $attachment = $_FILES['attachment'];
		$content = $this->load->view('admin/email/content', array('pesan' => $pesan), true); // Ambil isi file content.php dan masukan ke variabel $content
		$sendmail = array(
			'email_penerima' => $email_penerima,
			'subjek' => $subjek,
			'content' => $content,
			// 'attachment' => $attachment
		);
		if (empty($attachment['name'])) {
			$send = $this->mailer->send($sendmail);
		} else {
			$send = $this->mailer->send_with_attachment($sendmail);
		}

		echo "<b>" . $send['status'] . "</b><br />";
		echo $send['message'];
		echo "<br /><a href='" . base_url("admin/tabel_unit_keluar") . "'>Kembali ke Form</a>";
	}

	public function tambah_unit_keluar()
	{
		/*	$kode_id = $this->M_data->get_auto_id('tb_unit_penyewaan');
		foreach ($kode_id as $kd) {
			// if ($kd) {
			$nilai     = substr($kd->id_transaksi[0], 6);
			$kode     = (int) $nilai;
			//tambahkan sebanyak + 1
			$kode     = $kode + 1;
			$auto_kode = "GE-" . date('M') . str_pad($kode, 4, "0",  STR_PAD_LEFT);
			// }
		}
		$data['kode_auto'] = $auto_kode; */

		$data['list_mobil'] = $this->M_data->select('tb_mobil');
		$data['list_genset'] = $this->M_data->select_gst('tb_genset');
		$data['list_pelanggan'] = $this->M_data->get_Plg('tb_pelanggan');
		$data['list_operator'] = $this->M_data->select_op('tb_operator');
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Tambah Unit Sewa';
		$this->load->view('admin/unit_keluar/tambah_unit_keluar', $data);
	}

	public function proses_tambah_unit_keluar()
	{
		$this->form_validation->set_rules('id_transaksi', 'ID Data', 'required');
		$this->form_validation->set_rules('tanggal_keluar', 'Tanggal Keluar', 'required');
		$this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
		$this->form_validation->set_rules('id_operator', 'Nama Operator', 'required');
		$this->form_validation->set_rules('id_pelanggan', 'Nama Pelanggan', 'required');
		$this->form_validation->set_rules('id_genset', 'Kode Genset', 'required');

		if ($this->form_validation->run() == TRUE) {
			// $stok_gd           = $this->input->post('stok_gd', TRUE);
			// $stok_pj           = $this->input->post('stok_pj', TRUE);

			$id_transaksi     = $this->input->post('id_transaksi', TRUE);
			$tanggal_keluar          = $this->input->post('tanggal_keluar', TRUE);
			$lokasi           = $this->input->post('lokasi', TRUE);
			$id_operator    = $this->input->post('id_operator', TRUE);
			$id_pelanggan   = $this->input->post('id_pelanggan', TRUE);
			$id_genset      = $this->input->post('id_genset', TRUE);
			$id_mobil            = $this->input->post('id_mobil', TRUE);
			$tambahan         = $this->input->post('tambahan', TRUE);
			$jumlah_hari      = $this->input->post('jumlah_hari', TRUE);
			$total            = $this->input->post('total', TRUE);
			$status           = 2;

			$tanggal_masuk    = date('Y-m-d', strtotime($tanggal_keluar . "+" . $jumlah_hari . " days"));

			$data = array(
				'id_transaksi'     => $id_transaksi,
				'tanggal_keluar'          => $tanggal_keluar,
				'lokasi'           => $lokasi,
				'tanggal_masuk'    => $tanggal_masuk,
				'id_operator'    => $id_operator,
				'id_pelanggan'   => $id_pelanggan,
				'id_genset'      => $id_genset,
				'id_mobil'            => $id_mobil,
				'tambahan'         => $tambahan,
				'jumlah_hari'      => $jumlah_hari,
				'total'            => $total,
				'status'           => $status
			);
			$status_gst = 1;
			$status_op = 1;
			$status_plg = 1;
			// $stok_gd_new = ++$stok_gd;
			// $stok_pj_new = --$stok_pj;

			// $this->M_data->mengurangi('tb_genset', $id_genset, $stok_gd_new);
			// $this->M_data->menambah('tb_genset', $id_genset, $stok_pj_new);
			$this->M_data->update_status_gst('tb_genset', $id_genset, $status_gst);
			$this->M_data->update_status_op('tb_operator', $id_operator, $status_op);
			$this->M_data->update_status_plg('tb_pelanggan', $id_pelanggan, $status_plg);
			$this->M_data->insert('tb_unit_penyewaan', $data);
			$this->session->set_flashdata('msg_sukses', 'Data Berhasil Disimpan');

			redirect(site_url('admin/tabel_unit_keluar'));
		} else {
			$data['list_mobil'] = $this->M_data->select('tb_mobil');
			$data['list_genset'] = $this->M_data->select('tb_genset');
			$data['list_pelanggan'] = $this->M_data->select('tb_pelanggan');
			$data['list_operator'] = $this->M_data->select('tb_operator');
			$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
			$data['title'] = 'Tambah Unit Sewa';
			// $this->load->view('admin/unit_keluar/tambah_unit_keluar', $data);
			$this->load->view('admin/unit_keluar/tabel_unit_keluar', $data);
		}
	}

	public function hapus_unit_keluar()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_u_sewa' => $uri);
		// $id_operator    = $this->input->post('id_operator', TRUE);
		// $id_pelanggan   = $this->input->post('id_pelanggan', TRUE);
		// $id_genset      = $this->input->post('id_genset', TRUE);
		// $data = array(
		// 	'id_operator'    => $id_operator,
		// 	'id_pelanggan'   => $id_pelanggan,
		// 	'id_genset'      => $id_genset
		// );
		// $status_gst = 0;
		// $status_op = 0;
		// $status_plg = 0;

		// $this->M_data->update_status_gst('tb_genset', $id_genset, $status_gst);
		// $this->M_data->update_status_op('tb_operator', $id_operator, $status_op);
		// $this->M_data->update_status_plg('tb_pelanggan', $id_pelanggan, $status_plg);
		$this->M_data->delete('tb_unit_penyewaan', $where);
		$this->session->set_flashdata('msg_sukses', 'Data Berhasil Dihapus');
		redirect(site_url('admin/tabel_unit_keluar'));
	}

	public function unit_new_update()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_u_sewa' => $uri);
		$data['data_unit_update'] = $this->M_data->get_data('tb_unit_penyewaan', $where);
		$data['list_mobil'] = $this->M_data->select('tb_mobil');
		$data['list_genset'] = $this->M_data->select('tb_genset');
		$data['list_pelanggan'] = $this->M_data->select('tb_pelanggan');
		$data['list_operator'] = $this->M_data->select('tb_operator');
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Konfirmasi Pemakaian Genset';
		$this->load->view('admin/unit_keluar/update_unit_new', $data);
	}

	public function proses_data_new()
	{
		$this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'trim|required');

		$id_u_sewa       = $this->input->post('id_u_sewa', TRUE);

		if ($this->form_validation->run() === TRUE) {
			// $stok_gd           = $this->input->post('stok_gd', TRUE);
			// $stok_pj           = $this->input->post('stok_pj', TRUE);
			$id_transaksi     = $this->input->post('id_transaksi', TRUE);

			$tanggal_keluar          = $this->input->post('tanggal_keluar', TRUE);
			$tanggal_masuk    = $this->input->post('tanggal_masuk', TRUE);
			$lokasi           = $this->input->post('lokasi', TRUE);
			$id_operator    = $this->input->post('id_operator', TRUE);
			$id_pelanggan   = $this->input->post('id_pelanggan', TRUE);
			$id_genset      = $this->input->post('id_genset', TRUE);
			$id_mobil            = $this->input->post('id_mobil', TRUE);
			$tambahan         = $this->input->post('tambahan', TRUE);
			$jumlah_hari      = $this->input->post('jumlah_hari', TRUE);
			$jumlah_hari_lama = $this->input->post('jumlah_hari_lama', TRUE);
			$total            = $this->input->post('total', TRUE);

			$status_b = 2;

			// if($jumlah_hari_lama == $jumlah_hari){
			//   $status = 1;
			// }else{
			//   $status = 0;
			// }

			$where = array('id_u_sewa' => $id_u_sewa);
			$data = array(
				'id_transaksi'    => $id_transaksi,
				'tanggal_keluar'          => $tanggal_keluar,
				'tanggal_masuk'   => $tanggal_masuk,
				'lokasi'           => $lokasi,
				'id_operator'    => $id_operator,
				'id_pelanggan'   => $id_pelanggan,
				'id_genset'      => $id_genset,
				'id_mobil'            => $id_mobil,
				'tambahan'         => $tambahan,
				'jumlah_hari'      => $jumlah_hari,
				'total'            => $total,
				'status'           => $status_b
			);
			// $stok_gd_new = ++$stok_gd;
			// $stok_pj_new = --$stok_pj;
			// $status_gst = 0;
			// $status_op = 0;
			// $status_plg = 0;
			// $status = 2;

			// $this->M_data->update_status('tb_unit_penyewaan', $where, $status_b);
			// $this->M_data->update_status_gst('tb_genset', $id_genset, $status_gst);
			// $this->M_data->update_status_op('tb_operator', $id_operator, $status_op);
			// $this->M_data->update_status_plg('tb_pelanggan', $id_pelanggan, $status_plg);
			// $this->M_data->menambah_kembali('tb_genset', $id_genset, $stok_gd_new);
			// $this->M_data->mengurangi_kembali('tb_genset', $id_genset, $stok_pj_new);
			// $this->M_data->insert('tb_unit_masuk', $data);
			$this->M_data->update('tb_unit_penyewaan', $data, $where);
			$this->session->set_flashdata('msg_sukses', 'Data Status diubah');
			// $this->M_data->delete('tb_barang_masuk',$where);
			redirect(site_url('admin/tabel_unit_keluar'));
		} else {
			// $data['title'] = 'Update Genset Masuk';
			$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
			$data['title'] = 'Konfirmasi Genset Masuk';
			$this->load->view('admin/unit_keluar/update_unit_masuk', $data);
		}
	}

	public function unit_keluar_update()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_u_sewa' => $uri);
		$data['data_unit_update'] = $this->M_data->get_data('tb_unit_penyewaan', $where);
		$data['list_mobil'] = $this->M_data->select('tb_mobil');
		$data['list_genset'] = $this->M_data->select('tb_genset');
		$data['list_pelanggan'] = $this->M_data->select('tb_pelanggan');
		$data['list_operator'] = $this->M_data->select('tb_operator');
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Perpanjang Pemakaian Genset';
		$this->load->view('admin/unit_keluar/perpanjang_unit', $data);
	}

	public function proses_perpanjangan()
	{
		$this->form_validation->set_rules('jumlah_hari', 'Jumlah Hari', 'trim|required');
		$id_u_sewa       = $this->input->post('id_u_sewa', TRUE);

		if ($this->form_validation->run() === TRUE) {
			// $stok_gd           = $this->input->post('stok_gd', TRUE);
			// $stok_pj           = $this->input->post('stok_pj', TRUE);

			$tanggal_keluar          = $this->input->post('tanggal_keluar', TRUE);
			$tanggal_masuk    = $this->input->post('tanggal_masuk', TRUE);
			$lokasi           = $this->input->post('lokasi', TRUE);
			$id_operator    = $this->input->post('id_operator', TRUE);
			$id_pelanggan   = $this->input->post('id_pelanggan', TRUE);
			$id_genset      = $this->input->post('id_genset', TRUE);
			$id_mobil            = $this->input->post('id_mobil', TRUE);
			$tambahan         = $this->input->post('tambahan', TRUE);
			$jumlah_hari      = $this->input->post('jumlah_hari', TRUE);
			$jumlah_hari_lama = $this->input->post('jumlah_hari_lama', TRUE);
			$total            = $this->input->post('total', TRUE);

			// $status = 1;

			$tanggal_masuk_new    = date('Y-m-d', strtotime($tanggal_keluar . "+" . $jumlah_hari . " days"));
			// $total = $harga  * $jumlah_hari;
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

			$where = array('id_u_sewa' => $id_u_sewa);
			$data = array(
				'id_u_sewa'    => $id_u_sewa,
				'tanggal_keluar'          => $tanggal_keluar,
				'tanggal_masuk'   => $tanggal_masuk_up,
				'lokasi'           => $lokasi,
				'id_operator'    => $id_operator,
				'id_pelanggan'   => $id_pelanggan,
				'id_genset'      => $id_genset,
				'id_mobil'            => $id_mobil,
				'tambahan'         => $tambahan,
				'jumlah_hari'      => $jumlah_hari,
				'total'            => $total,
				// 'status'           => $status
			);

			$this->M_data->update('tb_unit_penyewaan', $data, $where);
			$this->session->set_flashdata('msg_sukses', 'Tanggal Berhasil Diperpanjang');
			// $this->M_data->delete('tb_barang_masuk',$where);
			redirect(site_url('admin/tabel_unit_keluar'));
		} else {
			$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
			$data['title'] = 'Perpanjang Pemakaian Genset';
			$this->load->view('admin/unit_keluar/perpanjang_unit', $data);
		}
	}

	public function unit_masuk()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_u_sewa' => $uri);
		$data['data_unit_update'] = $this->M_data->get_data('tb_unit_penyewaan', $where);
		$data['list_mobil'] = $this->M_data->select('tb_mobil');
		$data['list_genset'] = $this->M_data->select('tb_genset');
		$data['list_pelanggan'] = $this->M_data->select('tb_pelanggan');
		$data['list_operator'] = $this->M_data->select('tb_operator');
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Konfirmasi Genset Masuk';
		$this->load->view('admin/unit_keluar/update_unit_masuk', $data);
	}

	public function proses_data_masuk()
	{
		$this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'trim|required');

		$id_u_sewa       = $this->input->post('id_u_sewa', TRUE);

		if ($this->form_validation->run() === TRUE) {
			// $stok_gd           = $this->input->post('stok_gd', TRUE);
			// $stok_pj           = $this->input->post('stok_pj', TRUE);
			$id_transaksi     = $this->input->post('id_transaksi', TRUE);

			$tanggal_keluar          = $this->input->post('tanggal_keluar', TRUE);
			$tanggal_masuk    = $this->input->post('tanggal_masuk', TRUE);
			$lokasi           = $this->input->post('lokasi', TRUE);
			$id_operator    = $this->input->post('id_operator', TRUE);
			$id_pelanggan   = $this->input->post('id_pelanggan', TRUE);
			$id_genset      = $this->input->post('id_genset', TRUE);
			$id_mobil            = $this->input->post('id_mobil', TRUE);
			$tambahan         = $this->input->post('tambahan', TRUE);
			$jumlah_hari      = $this->input->post('jumlah_hari', TRUE);
			$jumlah_hari_lama = $this->input->post('jumlah_hari_lama', TRUE);
			$total            = $this->input->post('total', TRUE);

			$status_b = 0;

			// if($jumlah_hari_lama == $jumlah_hari){
			//   $status = 1;
			// }else{
			//   $status = 0;
			// }

			$where = array('id_u_sewa' => $id_u_sewa);
			$data = array(
				'id_transaksi'    => $id_transaksi,
				'tanggal_keluar'          => $tanggal_keluar,
				'tanggal_masuk'   => $tanggal_masuk,
				'lokasi'           => $lokasi,
				'id_operator'    => $id_operator,
				'id_pelanggan'   => $id_pelanggan,
				'id_genset'      => $id_genset,
				'id_mobil'            => $id_mobil,
				'tambahan'         => $tambahan,
				'jumlah_hari'      => $jumlah_hari,
				'total'            => $total,
				'status'           => $status_b
			);
			// $stok_gd_new = ++$stok_gd;
			// $stok_pj_new = --$stok_pj;
			$status_gst = 0;
			$status_op = 0;
			$status_plg = 0;
			$status = 0;

			$this->M_data->update_status('tb_unit_penyewaan', $where, $status);
			$this->M_data->update_status_gst('tb_genset', $id_genset, $status_gst);
			$this->M_data->update_status_op('tb_operator', $id_operator, $status_op);
			$this->M_data->update_status_plg('tb_pelanggan', $id_pelanggan, $status_plg);
			// $this->M_data->menambah_kembali('tb_genset', $id_genset, $stok_gd_new);
			// $this->M_data->mengurangi_kembali('tb_genset', $id_genset, $stok_pj_new);
			// $this->M_data->insert('tb_unit_masuk', $data);
			$this->session->set_flashdata('msg_sukses', 'Data Status diubah menjadi Masuk (Kembali)');
			// $this->M_data->delete('tb_barang_masuk',$where);
			redirect(site_url('admin/tabel_unit_masuk'));
		} else {
			// $data['title'] = 'Update Genset Masuk';
			$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
			$data['title'] = 'Konfirmasi Genset Masuk';
			$this->load->view('admin/unit_keluar/update_unit_masuk', $data);
		}
	}
	####################################
	//* End Data Unit Keluar
	####################################
	####################################
	//* Data Unit Masuk
	####################################

	public function tabel_unit_masuk()
	{
		$bulan = date('m');
		$tahun = date('Y');
		$label = 'Bulan ' . $bulan . ' Tahun ' .  $tahun;
		$data['pendapatan'] = $this->M_data->sum_pendapatan('tb_unit_penyewaan', $bulan, $tahun);
		$data['list_data'] = $this->M_data->get_data_u_masuk('tb_unit_penyewaan');
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['label'] = $label;
		// $data['total_data'] = $this->M_data->sum_pendapatan('tb_unit_penyewaan');
		$data['title'] = 'Data Unit Masuk/Kembali';
		$this->load->view('admin/unit_masuk/tabel_unit_masuk', $data);
	}

	public function detail_unit_masuk($id_transaksi)
	{
		$uri = $this->uri->segment(3);
		$where = array('id_u_sewa' => $uri);
		$data['list_data'] = $this->M_data->select_data_u_masuk('tb_unit_penyewaan', $where);
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Detail Data Unit Kembali';
		$this->load->view('admin/unit_masuk/detail_masuk', $data);
	}

	public function hapus_unit_masuk()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_u_sewa' => $uri);
		$this->M_data->delete('tb_unit_penyewaan', $where);
		$this->session->set_flashdata('msg_sukses', 'Data Berhasil Dihapus');
		redirect(site_url('admin/tabel_unit_masuk'));
	}

	####################################
	//* End Data Unit Masuk
	####################################
	####################################
	//* Data Pengeluaran
	####################################
	public function tabel_pengeluaran()
	{
		$bulan = $this->input->get('bulan');
		$tahun = $this->input->get('tahun');
		if (empty($bulan) or empty($tahun)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :            
			$data['list_data'] = $this->M_data->select('tb_pengeluaran');
			$data['total_data'] = $this->M_data->sum_pengeluaran('tb_pengeluaran');
			$label = 'Bulan ke ...' . ' Tahun ...';
		} else {
			$data['list_data'] = $this->M_data->pengeluaran_periode('tb_pengeluaran', $bulan, $tahun);
			$data['total_data'] = $this->M_data->sum_penngeluaranPeriode('tb_pengeluaran', $bulan, $tahun);
			$label = 'Bulan ke ' . $bulan . ' Tahun ' .  $tahun;
		}
		$data['label'] = $label;

		// $data['list_data'] = $this->M_data->select('tb_pengeluaran');
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Data Pengeluaran';
		$this->load->view('admin/pengeluaran/tabel_pengeluaran', $data);
	}

	public function tambah_data_pengeluaran()
	{
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Tambah Data Pengeluaran';
		$this->load->view('admin/pengeluaran/tambah_pengeluaran', $data);
	}

	public function proses_tambah_pengeluaran()
	{
		$this->form_validation->set_rules('tgl_pengeluaran', 'Tanggal', 'trim|required');
		$this->form_validation->set_rules('pengeluaran', 'Keterangan Pengeluaran', 'trim|required');
		$this->form_validation->set_rules('biaya_pengeluaran', 'Biaya Pengeluaran', 'trim|required');

		if ($this->form_validation->run() === TRUE) {
			$tgl_pengeluaran = $this->input->post('tgl_pengeluaran', TRUE);
			$pengeluaran = $this->input->post('pengeluaran', TRUE);
			$biaya_pengeluaran = $this->input->post('biaya_pengeluaran', TRUE);

			$data = array(
				'tgl_pengeluaran' => $tgl_pengeluaran,
				'pengeluaran' => $pengeluaran,
				'biaya_pengeluaran' => $biaya_pengeluaran
			);
			$this->M_data->insert('tb_pengeluaran', $data);
			$this->session->set_flashdata('msg_sukses', 'Data Berhasil Disimpan');
			redirect(site_url('admin/tabel_pengeluaran'));
		} else {
			$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
			$data['title'] = 'Tambah Data Pengeluaran';
			// $this->load->view('admin/pengeluaran/tambah_pengeluaran', $data);
			$this->load->view('admin/pengeluaran/tabel_pengeluaran', $data);
		}
	}

	public function update_data_pengeluaran()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_pengeluaran' => $uri);
		$data['list_data'] = $this->M_data->get_data('tb_pengeluaran', $where);
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Ubah Data Pengeluaran';
		$this->load->view('admin/pengeluaran/update_pengeluaran', $data);
	}

	public function proses_edit_pengeluaran()
	{
		$this->form_validation->set_rules('tgl_pengeluaran', 'Tanggal', 'trim|required');
		$this->form_validation->set_rules('pengeluaran', 'Keterangan Pengeluaran', 'trim|required');
		$this->form_validation->set_rules('biaya_pengeluaran', 'Biaya Pengeluaran', 'trim|required');

		if ($this->form_validation->run() === TRUE) {

			$id_pengeluaran = $this->input->post('id_pengeluaran', TRUE);
			$tgl_pengeluaran = $this->input->post('tgl_pengeluaran', TRUE);
			$pengeluaran = $this->input->post('pengeluaran', TRUE);
			$biaya_pengeluaran = $this->input->post('biaya_pengeluaran', TRUE);

			$where = array('id_pengeluaran' => $id_pengeluaran);
			$data = array(
				'tgl_pengeluaran' => $tgl_pengeluaran,
				'pengeluaran' => $pengeluaran,
				'biaya_pengeluaran' => $biaya_pengeluaran
			);
			$this->M_data->update('tb_pengeluaran', $data, $where);
			$this->session->set_flashdata('msg_sukses', 'Data Berhasil Diubah');
			redirect(site_url('admin/tabel_pengeluaran'));
		} else {
			$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
			$data['title'] = 'Ubah Data Pengeluaran';
			// $this->load->view('admin/pengeluaran/update_pengeluaran', $data);
			$this->load->view('admin/pengeluaran/tabel_pengeluaran', $data);
		}
	}

	public function hapus_pengeluaran()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_pengeluaran' => $uri);
		$this->M_data->delete('tb_pengeluaran', $where);
		$this->session->set_flashdata('msg_sukses', 'Data Berhasil Dihapus');
		redirect(site_url('admin/tabel_pemasukan'));
	}
	####################################
	//* End Data Pengeluaran
	####################################
	####################################
	//* Data Jadwal Penyewaan Genset
	####################################
	public function tabel_jdw_genset()
	{
		$data['list_mobil'] = $this->M_data->select('tb_mobil');
		$data['list_genset'] = $this->M_data->select_gst('tb_genset');
		$data['list_operator'] = $this->M_data->select_op('tb_operator');
		$data['list_data'] = $this->M_data->select_jdw_gst('tb_jadwal_genset');
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Jadwal Penyewaan Genset';
		$this->load->view('admin/jdw_genset/tabel_jdw_genset', $data);
	}

	public function tambah_jdw_genset()
	{
		$data['list_mobil'] = $this->M_data->select('tb_mobil');
		$data['list_genset'] = $this->M_data->select_gst('tb_genset');
		$data['list_operator'] = $this->M_data->select_op('tb_operator');
		// $data['list_data'] = $this->M_data->ambil_data_u_keluar('tb_unit_penyewaan');
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Tambah Data Jadwal Penyewaan Genset';
		$this->load->view('admin/jdw_genset/tambah_jdw_genset', $data);
	}

	public function proses_tambah_jdw_genset()
	{
		$this->form_validation->set_rules('id_operator', 'Nama Operator', 'required');
		$this->form_validation->set_rules('id_genset', 'Genset', 'required');
		$this->form_validation->set_rules('id_mobil', 'Mobil', 'required');
		$this->form_validation->set_rules('tgl_keluar', 'Tanggal Keluar', 'required');
		// $this->form_validation->set_rules('id_u_sewa', 'ID Transaksi', 'trim|required|is_unique[tb_jadwal_genset.id_u_sewa]');
		$this->form_validation->set_rules('lokasi', 'Lokasi', 'trim|required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');

		if ($this->form_validation->run() === TRUE) {
			// $id_u_sewa = $this->input->post('id_u_sewa', TRUE);
			$id_operator    = $this->input->post('id_operator', TRUE);
			$id_genset      = $this->input->post('id_genset', TRUE);
			$id_mobil            = $this->input->post('id_mobil', TRUE);
			$tgl_keluar          = $this->input->post('tgl_keluar', TRUE);
			$jumlah_hari      = $this->input->post('jumlah_hari', TRUE);
			$lokasi      = $this->input->post('lokasi', TRUE);
			$keterangan = $this->input->post('keterangan', TRUE);
			$status           = 1;

			$tgl_masuk    = date('Y-m-d', strtotime($tgl_keluar . "+" . $jumlah_hari . " days"));

			$data = array(
				// 'id_u_sewa' => $id_u_sewa,
				'id_operator'    => $id_operator,
				'id_genset'      => $id_genset,
				'id_mobil'            => $id_mobil,
				'tgl_keluar'          => $tgl_keluar,
				'tgl_masuk'          => $tgl_masuk,
				'jumlah_hari'      => $jumlah_hari,
				'lokasi'      => $lokasi,
				'keterangan' => $keterangan,
				'status_jdw'           => $status

			);
			$status_gst = 2;
			$this->M_data->update_status_gst('tb_genset', $id_genset, $status_gst);
			$this->M_data->insert('tb_jadwal_genset', $data);
			$this->session->set_flashdata('msg_sukses', 'Data Berhasil Disimpan');
			redirect(site_url('admin/tabel_jdw_genset'));
		} else {
			$data['list_data'] = $this->M_data->ambil_data_u_keluar('tb_unit_penyewaan');
			$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
			$data['title'] = 'Tambah Data Jadwal Penyewaan Genset';
			// $this->load->view('admin/jdw_genset/tambah_jdw_genset', $data);
			$this->load->view('admin/jdw_genset/tabel_jdw_genset', $data);
		}
	}
	/*
	public function proses_tambah_jdw_genset()
	{

		$this->form_validation->set_rules('id_u_sewa', 'ID Transaksi', 'trim|required|is_unique[tb_jadwal_genset.id_u_sewa]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');

		if ($this->form_validation->run() === TRUE) {
			$id_u_sewa = $this->input->post('id_u_sewa', TRUE);
			$keterangan = $this->input->post('keterangan', TRUE);

			$data = array(
				'id_u_sewa' => $id_u_sewa,
				'keterangan' => $keterangan
			);
			$this->M_data->insert('tb_jadwal_genset', $data);
			$this->session->set_flashdata('msg_sukses', 'Data Berhasil Disimpan');
			redirect(site_url('admin/tabel_jdw_genset'));
		} else {
			$data['list_data'] = $this->M_data->ambil_data_u_keluar('tb_unit_penyewaan');
			$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
			$data['title'] = 'Tambah Data Jadwal Penyewaan Genset';
			$this->load->view('admin/jdw_genset/tambah_jdw_genset', $data);
		}
	}
	*/
	public function detail_jdw_genset()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_jadwal_genset' => $uri);
		$data['list_data'] = $this->M_data->get_jdw_gst('tb_jadwal_genset', $where);

		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Ubah Data Jadwal Penyewaan Genset';
		$this->load->view('admin/jdw_genset/detail_jdw_genset', $data);
	}

	public function update_jdw_genset()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_jadwal_genset' => $uri);
		$data['list_data'] = $this->M_data->get_data('tb_jadwal_genset', $where);
		$data['list_mobil'] = $this->M_data->select('tb_mobil');
		$data['list_genset'] = $this->M_data->select_gst('tb_genset');
		$data['list_operator'] = $this->M_data->select_op('tb_operator');
		// $data['list_data'] = $this->M_data->ambil_data_u_keluar('tb_unit_penyewaan');
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Ubah Data Jadwal Penyewaan Genset';
		$this->load->view('admin/jdw_genset/update_jdw_genset', $data);
	}

	public function email_jdw_genset()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_jadwal_genset' => $uri);
		$tgl = date('Y-m-d');

		// $data['list_email'] = $this->M_admin->select('tb_user');
		$data['notifJdw'] = $this->M_data->notif_jdwGst1('tb_jadwal_genset', $tgl, $where);
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'email';
		$this->load->view('admin/jdw_genset/email_jdw_genset', $data);
	}

	public function kirim_jdw_genset()
	{
		$email_penerima = $this->input->post('email_penerima');
		$subjek = $this->input->post('subjek');
		$pesan = $this->input->post('pesan');
		// $attachment = $_FILES['attachment'];
		$content = $this->load->view('admin/email/content', array('pesan' => $pesan), true); // Ambil isi file content.php dan masukan ke variabel $content
		$sendmail = array(
			'email_penerima' => $email_penerima,
			'subjek' => $subjek,
			'content' => $content,
			// 'attachment' => $attachment
		);
		if (empty($attachment['name'])) {
			$send = $this->mailer->send($sendmail);
		} else {
			$send = $this->mailer->send_with_attachment($sendmail);
		}

		echo "<b>" . $send['status'] . "</b><br />";
		echo $send['message'];
		echo "<br /><a href='" . base_url("admin/tabel_jdw_genset") . "'>Kembali ke Form</a>";
	}

	public function proses_ubah_jdw_genset()
	{
		$this->form_validation->set_rules('id_operator', 'Nama Operator', 'required');
		$this->form_validation->set_rules('id_genset', 'Genset', 'required');
		$this->form_validation->set_rules('id_mobil', 'Mobil', 'required');
		$this->form_validation->set_rules('tgl_keluar', 'Tanggal Keluar', 'required');
		// $this->form_validation->set_rules('id_u_sewa', 'ID Transaksi', 'trim|required|is_unique[tb_jadwal_genset.id_u_sewa]');
		$this->form_validation->set_rules('lokasi', 'Lokasi', 'trim|required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');

		if ($this->form_validation->run() === TRUE) {
			$id_jadwal_genset = $this->input->post('id_jadwal_genset', TRUE);
			$id_operator    = $this->input->post('id_operator', TRUE);
			$id_genset      = $this->input->post('id_genset', TRUE);
			$id_mobil            = $this->input->post('id_mobil', TRUE);
			$tgl_keluar          = $this->input->post('tgl_keluar', TRUE);
			$tgl_masuk          = $this->input->post('tgl_masuk', TRUE);
			$jumlah_hari      = $this->input->post('jumlah_hari', TRUE);
			$lokasi      = $this->input->post('lokasi', TRUE);
			$keterangan = $this->input->post('keterangan', TRUE);
			$status_jdw = $this->input->post('status_jdw', TRUE);

			$tgl_masuk_new    = date('Y-m-d', strtotime($tgl_keluar . "+" . $jumlah_hari . " days"));
			if ($tgl_masuk == $tgl_masuk_new) {
				$tgl_masuk_up = $tgl_masuk;
			} else {
				$tgl_masuk_up = $tgl_masuk_new;
			}

			$where = array('id_jadwal_genset' => $id_jadwal_genset);
			$data = array(
				// 'id_u_sewa' => $id_u_sewa,
				'id_operator'    => $id_operator,
				'id_genset'      => $id_genset,
				'id_mobil'            => $id_mobil,
				'tgl_keluar'          => $tgl_keluar,
				'tgl_masuk'          => $tgl_masuk_up,
				'jumlah_hari'      => $jumlah_hari,
				'lokasi'      => $lokasi,
				'keterangan' => $keterangan,
				'status_jdw' => $status_jdw
			);
			// $status_gst = 2;
			// $this->M_data->update_status_gst('tb_genset', $id_genset, $status_gst);
			$this->M_data->update('tb_jadwal_genset', $data, $where);
			$this->session->set_flashdata('msg_sukses', 'Data Berhasil Diubah');
			redirect(site_url('admin/tabel_jdw_genset'));
		} else {
			$data['list_data'] = $this->M_data->ambil_data_u_keluar('tb_unit_penyewaan');
			$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
			$data['title'] = 'Tambah Data Jadwal Penyewaan Genset';
			// $this->load->view('admin/jdw_genset/tambah_jdw_genset', $data);
			$this->load->view('admin/jdw_genset/tabel_jdw_genset', $data);
		}
	}

	public function hapus_jdw_genset()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_jadwal_genset' => $uri);
		$this->M_data->delete('tb_jadwal_genset', $where);
		$this->session->set_flashdata('msg_sukses', 'Data Berhasil Dihapus');
		redirect(site_url('admin/tabel_jdw_genset'));
	}
	####################################
	//* End Data Jadwal Penyewaan Genset
	####################################
	####################################
	//* Pemasukan
	####################################
	public function tabel_pemasukan()
	{
		$bulan = $this->input->get('bulan');
		$tahun = $this->input->get('tahun');
		// $bulan = date('m');
		// $tahun = date('Y');
		if (empty($bulan) or empty($tahun)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :            
			$data['get_data'] = $this->M_data->get_data_u_masuk('tb_unit_penyewaan');
			$data['list_data'] = $this->M_data->get_data_pemasukan('tb_pendapatan');
			$data['total_data'] = $this->M_data->sum_pemasukan('tb_pendapatan');
			$label = 'Bulan ke ...' . ' Tahun ...';
		} else {
			$data['get_data'] = $this->M_data->get_data_u_masuk('tb_unit_penyewaan');
			$data['list_data'] = $this->M_data->pemasukan_periode('tb_pendapatan', $bulan, $tahun);
			$data['total_data'] = $this->M_data->sum_pendapatanMasuk('tb_pendapatan', $bulan, $tahun);
			$label = 'Bulan ke ' . $bulan . ' Tahun ' .  $tahun;
		}
		// $data['list_data'] = $this->M_data->get_data_u_keluar('tb_unit_penyewaan');
		// $data['list_data'] = $this->M_data->pemasukan_periode('tb_unit_penyewaan', $bulan, $tahun);

		// $data['total_data'] = $this->M_data->sum_pendapatan('tb_unit_penyewaan');
		$data['label'] = $label;
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Data Pendapatan';
		$this->load->view('admin/pemasukan/tabel_pemasukan', $data);
	}

	public function tambah_pemasukan()
	{
		$data['get_data'] = $this->M_data->get_data_u_masuk('tb_unit_penyewaan');
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Tambah Data Pendapatan';
		$this->load->view('admin/pemasukan/tambah_pemasukan', $data);
	}

	public function proses_tambah_pemasukan()
	{

		$this->form_validation->set_rules('id_u_sewa', 'ID Transaksi', 'trim|required|is_unique[tb_pendapatan.id_u_sewa]');
		$this->form_validation->set_rules('tgl_update', 'Tanggal Update', 'trim|required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');

		if ($this->form_validation->run() === TRUE) {
			$id_u_sewa = $this->input->post('id_u_sewa', TRUE);
			$tgl_update = $this->input->post('tgl_update', TRUE);
			$keterangan = $this->input->post('keterangan', TRUE);

			$data = array(
				'id_u_sewa' => $id_u_sewa,
				'tgl_update' => $tgl_update,
				'keterangan' => $keterangan
			);
			$this->M_data->insert('tb_pendapatan', $data);
			$this->session->set_flashdata('msg_sukses', 'Data Berhasil Disimpan');
			redirect(site_url('admin/tabel_pemasukan'));
		} else {
			$data['list_data'] = $this->M_data->get_data_u_masuk('tb_unit_penyewaan');
			$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
			$data['title'] = 'Tambah Data Pendapatan';
			// $this->load->view('admin/pemasukan/tambah_pemasukan', $data);
			$this->load->view('admin/pemasukan/tabel_pemasukan', $data);
		}
	}

	public function edit_pemasukan()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_pendapatan' => $uri);
		$data['edit_data'] = $this->M_data->get_data('tb_pendapatan', $where);
		$data['list_data'] = $this->M_data->get_data_u_masuk('tb_unit_penyewaan');
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Ubah Data Pendapatan';
		$this->load->view('admin/pemasukan/edit_pemasukan', $data);
	}

	public function proses_edit_pemasukan()
	{

		$this->form_validation->set_rules('id_u_sewa', 'ID Transaksi', 'trim|required');
		$this->form_validation->set_rules('tgl_update', 'Tanggal Update', 'trim|required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');

		if ($this->form_validation->run() === TRUE) {
			$id_pendapatan = $this->input->post('id_pendapatan', TRUE);
			$id_u_sewa = $this->input->post('id_u_sewa', TRUE);
			$tgl_update = $this->input->post('tgl_update', TRUE);
			$keterangan = $this->input->post('keterangan', TRUE);

			$where = array('id_pendapatan' => $id_pendapatan);
			$data = array(
				'id_u_sewa' => $id_u_sewa,
				'tgl_update' => $tgl_update,
				'keterangan' => $keterangan
			);
			$this->M_data->update('tb_pendapatan', $data, $where);
			$this->session->set_flashdata('msg_sukses', 'Data Berhasil Diubah');
			redirect(site_url('admin/tabel_pemasukan'));
		} else {
			$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
			$data['title'] = 'Ubah Data Pendapatan';
			// $this->load->view('admin/pemasukan/edit_pemasukan', $data);
			$this->load->view('admin/pemasukan/tabel_pemasukan', $data);
		}
	}

	public function hapus_pemasukan()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_pendapatan' => $uri);
		$this->M_data->delete('tb_pendapatan', $where);
		$this->session->set_flashdata('msg_sukses', 'Data Berhasil Dihapus');
		redirect(site_url('admin/tabel_pemasukan'));
	}

	####################################
	//* End Pemasukan
	####################################
	####################################
	//* Laporan
	####################################

	public function laporan()
	{
		$data['list_sewa'] = $this->M_data->get_data_u_masuk('tb_unit_penyewaan');
		$data['list_perbaikan'] = $this->M_data->get_data_service('tb_serv_genset');

		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'Laporan';
		$this->load->view('admin/report/laporan', $data);
	}

	####################################
	//* End Laporan
	####################################
	####################################
	//* test email 
	####################################

	public function email()
	{
		// $data['list_email'] = $this->M_admin->select('tb_user');
		$data['avatar'] = $this->M_data->get_avatar('tb_user', $this->session->userdata('name'));
		$data['title'] = 'email';
		$this->load->view('admin/email/v_email', $data);
	}

	public function kirim()
	{
		$email_penerima = $this->input->post('email_penerima');
		$subjek = $this->input->post('subjek');
		$pesan = $this->input->post('pesan');
		$attachment = $_FILES['attachment'];
		$content = $this->load->view('admin/email/content', array('pesan' => $pesan), true); // Ambil isi file content.php dan masukan ke variabel $content
		$sendmail = array(
			'email_penerima' => $email_penerima,
			'subjek' => $subjek,
			'content' => $content,
			'attachment' => $attachment
		);
		if (empty($attachment['name'])) {
			$send = $this->mailer->send($sendmail);
		} else {
			$send = $this->mailer->send_with_attachment($sendmail);
		}

		echo "<b>" . $send['status'] . "</b><br />";
		echo $send['message'];
		echo "<br /><a href='" . base_url("admin/email") . "'>Kembali ke Form</a>";
	}

	####################################
	//* end test email 
	####################################
}

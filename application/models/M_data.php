<?php

class M_data extends CI_Model
{

  ####################################
  //* CRUD
  ####################################

  public function insert($tabel, $data)
  {
    $this->db->insert($tabel, $data);
  }

  public function select($tabel)
  {
    $query = $this->db->get($tabel);
    return $query->result();
  }

  public function update($tabel, $data, $where)
  {
    $this->db->where($where);
    $this->db->update($tabel, $data);
  }

  public function delete($tabel, $where)
  {
    $this->db->where($where);
    $this->db->delete($tabel);
  }

  ####################################
  //! Batas Query User (Jangan diubah)
  ####################################

  public function get_avatar($tabel, $username) // Query get avatar User
  {
    $query = $this->db->select()
      ->from($tabel)
      ->where('username', $username)
      ->get();
    return $query->result();
  }

  public function update_avatar($where, $data) // Query update Avatar User
  {
    $this->db->set($data);
    $this->db->where($where);
    $this->db->update('tb_user');
  }

  public function update_password($tabel, $where, $data) // Update password user
  {
    $this->db->where($where);
    $this->db->update($tabel, $data);
  }

  ####################################
  //! End Batas Query User (Jangan diubah)
  ####################################
  ####################################
  //! Old query but still use
  ####################################

  public function get_data($tabel, $where)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->where($where)
      ->get();
    return $query->result();
  }

  public function get_data_genset($id_genset) // Ambil baris id data genset
  {
    $this->db->select()
      // ->from('tb_genset')
      ->where('id_genset', $id_genset);
    return $this->db->get('tb_genset');
  }

  public function update_data_genset($id_genset, $data) // Untuk proses update data genset
  {
    $this->db->select()
      // ->from('tb_genset')
      ->where('id_genset', $id_genset);
    return $this->db->update('tb_genset', $data);
  }

  public function del_data_genset($id_genset) // Untuk hapus data genset
  {
    $this->db->select()
      // ->from('tb_genset')
      ->where('id_genset', $id_genset);
    return $this->db->delete('tb_genset');
  }

  public function get_data_mobil($id_mobil) // Ambil baris id data mobil
  {
    $this->db->select()
      // ->from('tb_mobil')
      ->where('id_mobil', $id_mobil);
    return $this->db->get('tb_mobil');
  }

  public function update_data_mobil($id_mobil, $data) // Untuk proses update data mobil
  {
    $this->db->select()
      // ->from('tb_mobil')
      ->where('id_mobil', $id_mobil);
    return $this->db->update('tb_mobil', $data);
  }

  public function del_data_mobil($id_mobil) // Untuk hapus data mobil
  {
    $this->db->select()
      // ->from('tb_mobil')
      ->where('id_mobil', $id_mobil);
    return $this->db->delete('tb_mobil');
  }
  // public function mengurangi($tabel, $id_genset, $stok_gd_new)
  // {
  //   $this->db->set("stok_gd", $stok_gd_new);
  //   $this->db->where('id_genset', $id_genset);
  //   $this->db->update($tabel);
  // }

  // public function mengurangi_kembali($tabel, $id_genset, $stok_pj_new)
  // {
  //   $this->db->set("stok_pj", $stok_pj_new);
  //   $this->db->where('id_genset', $id_genset);
  //   $this->db->update($tabel);
  // }

  // public function menambah($tabel, $id_genset, $stok_pj_new)
  // {
  //   $this->db->set("stok_pj", $stok_pj_new);
  //   $this->db->where('id_genset', $id_genset);
  //   $this->db->update($tabel);
  // }

  // public function menambah_kembali($tabel, $id_genset, $stok_gd_new)
  // {
  //   $this->db->set("stok_gd", $stok_gd_new);
  //   $this->db->where('id_genset', $id_genset);
  //   $this->db->update($tabel);
  // }

  public function update_status($tabel, $where, $status) // Untuk update status Unit Masuk
  {
    $this->db->set("status", $status);
    $this->db->where($where);
    $this->db->update($tabel);
  }

  public function update_status_aju($tabel, $where, $status_a)
  {
    $this->db->set("status_ajuan", $status_a);
    $this->db->where($where);
    $this->db->update($tabel);
  }

  public function numrows($tabel)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->get();
    return $query->num_rows();
  }

  ####################################
  //* New Query
  ####################################

  public function get_Plg($tabel) // Menampilkan isi data pelanggan
  {
    $query = $this->db->select()
      ->from($tabel)
      ->where('ket_plg =', 0)
      ->get();
    return $query->result();
  }

  public function filter_Pelanggan($tabel, $pelanggan)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->where_in('nama_plg', $pelanggan)
      ->where('ket_plg =', 0)
      ->get();
    return $query->result();
  }

  public function get_Plg_Blc($tabel) // Menampilkan isi data pelanggan Blacklist
  {
    $query = $this->db->select()
      ->from($tabel)
      ->where('ket_plg =', 1)
      ->get();
    return $query->result();
  }

  public function cetak_PelangganBlacklistFilter($tabel, $pelangganBlacklist)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->where_in('nama_plg', $pelangganBlacklist)
      ->where('ket_plg =', 1)
      ->get();
    return $query->result();
  }

  public function notif_stok($tabel) // Pemberitahuan stok
  {
    $query = $this->db->select()
      ->from($tabel)
      ->where('stok <', 2)
      ->get();
    return $query->result();
  }
  public function notif_stok_jml($tabel) // Pemberitahuan jumlah stok
  {
    $query = $this->db->select()
      ->from($tabel)
      ->where('stok <', 2)
      ->get();
    return $query->num_rows();
  }

  public function update_status_gst($tabel, $where, $status_gst) // Untuk ubah status genset
  {
    $this->db->set("ket_genset", $status_gst);
    $this->db->where("id_genset", $where);
    $this->db->update($tabel);
  }

  public function update_sts_op($tabel, $where, $status_op) // Untuk ubah status operator
  {
    $this->db->set("status_op", $status_op);
    $this->db->where("id_operator", $where);

    $this->db->update($tabel);
  }

  public function update_status_op($tabel, $where, $status_op) // Untuk ubah status operator
  {
    $this->db->set("status_op", $status_op);
    $this->db->where("id_operator", $where);
    $this->db->update($tabel);
  }

  public function update_status_plg($tabel, $where, $status_plg) // Untuk ubah status pelanggan
  {
    $this->db->set("status_plg", $status_plg);
    $this->db->where("id_pelanggan", $where);
    $this->db->update($tabel);
  }
  ####################################
  //* Data Perbaikan Genset 
  ####################################

  public function notif_ServGenset($tabel, $tgl)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_genset', 'tb_genset.id_genset = ' . $tabel . '.id_genset')
      ->join('tb_sparepart', 'tb_sparepart.id_sparepart = ' . $tabel . '.id_sparepart')
      ->where('ket_perbaikan =', 0)
      ->where('DATEDIFF(DATE_SUB(tgl_perbaikan, INTERVAL 1 DAY), "' . $tgl . '") <', 1)

      ->get();
    return $query->result();
  }

  public function notif_ServGenset1($tabel, $tgl, $where)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_genset', 'tb_genset.id_genset = ' . $tabel . '.id_genset')
      ->join('tb_sparepart', 'tb_sparepart.id_sparepart = ' . $tabel . '.id_sparepart')
      ->where('ket_perbaikan =', 0)
      ->where('DATEDIFF(DATE_SUB(tgl_perbaikan, INTERVAL 1 DAY), "' . $tgl . '") <', 1)
      ->where($where)

      ->get();
    return $query->result();
  }

  public function notif_ServGenset_Jml($tabel, $tgl)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_genset', 'tb_genset.id_genset = ' . $tabel . '.id_genset')
      ->join('tb_sparepart', 'tb_sparepart.id_sparepart = ' . $tabel . '.id_sparepart')
      ->where('ket_perbaikan =', 0)
      ->where('DATEDIFF(DATE_SUB(tgl_perbaikan, INTERVAL 1 DAY), "' . $tgl . '") <', 1)

      ->get();
    return $query->num_rows();
  }

  public function filter_data_service($tabel, $genset, $bulan, $tahun)
  {
    $bulan = $this->db->escape($bulan);
    $tahun = $this->db->escape($tahun);
    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_genset', 'tb_genset.id_genset = ' . $tabel . '.id_genset')
      ->join('tb_sparepart', 'tb_sparepart.id_sparepart = ' . $tabel . '.id_sparepart')
      ->where('MONTH (' . $tabel . '.tgl_perbaikan) =' . $bulan . ' AND YEAR (' . $tabel . '.tgl_perbaikan) =' . $tahun)
      ->where_in('tb_genset.nama_genset', $genset)
      // ->or_like('tb_genset.nama_genset', 'match', $genset)
      ->order_by('tgl_perbaikan', 'asc')
      ->get();
    return $query->result();
  }

  public function filter_data_serviceAccUnit($tabel, $genset, $bulan, $tahun)
  {
    $bulan = $this->db->escape($bulan);
    $tahun = $this->db->escape($tahun);
    $query = $this->db->select()
      ->from($tabel)
      // ->join('tb_genset', 'tb_genset.id_genset = ' . $tabel . '.id_genset')
      ->join('tb_serv_genset', 'tb_serv_genset.id_perbaikan_gst = ' . $tabel . '.id_perbaikan_gst')
      ->join('tb_genset', 'tb_genset.id_genset = tb_serv_genset.id_genset')
      ->where('MONTH (' . $tabel . '.tgl_setujui) =' . $bulan . ' AND YEAR (' . $tabel . '.tgl_setujui) =' . $tahun)
      ->where_in('tb_genset.nama_genset', $genset)
      // ->or_like('tb_genset.nama_genset', 'match', $genset)
      ->order_by('tgl_setujui', 'asc')
      ->get();
    return $query->result();
  }

  public function get_data_service($tabel) // Tampilkan isi tabel Perbaikan Genset
  {
    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_genset', 'tb_genset.id_genset = ' . $tabel . '.id_genset')
      ->join('tb_sparepart', 'tb_sparepart.id_sparepart = ' . $tabel . '.id_sparepart', 'left')
      ->order_by('id_perbaikan_gst', 'asc')
      ->get();
    return $query->result();
  }

  public function get_data_pakaiGst($tabel) // Tampilkan isi tabel lama pemakaian Genset
  {
    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_unit_penyewaan', 'tb_unit_penyewaan.id_u_sewa = ' . $tabel . '.id_u_sewa')
      ->join('tb_genset', 'tb_genset.id_genset = tb_unit_penyewaan.id_genset')

      // ->order_by('id_perbaikan_gst', 'asc')
      ->get();
    return $query->result();
  }

  public function sum_pakaiGst($tabel) // Tampilkan isi tabel lama pemakaian Genset
  {
    $query = $this->db->select_sum('jumlah_hari')
      ->from($tabel)
      // ->join('tb_genset', 'tb_genset.id_genset = tb_unit_penyewaan.id_genset')
      ->join('tb_unit_penyewaan', 'tb_unit_penyewaan.id_u_sewa = ' . $tabel . '.id_u_sewa')

      // ->order_by('id_perbaikan_gst', 'asc')
      ->get();
    return $query->result();
  }

  public function mengurangi_stok($tabel, $spare_part, $stok_new) // Mengurangi isi stok sparepart
  {
    $this->db->set("stok", $stok_new);
    $this->db->where('id_sparepart', $spare_part);
    $this->db->update($tabel);
  }

  public function get_Serv($tabel) // Tampilkan isi tabel Perbaikan Genset yang selesai
  {
    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_genset', 'tb_genset.id_genset = tb_serv_genset.id_genset')
      ->where('ket_perbaikan =', 1)
      ->get();
    return $query->result();
  }

  public function select_ServGstAcc($tabel) // Tampilkan isi tabel Perbaikan Genset Disetujui
  {
    $query = $this->db->select('*')
      ->from($tabel)
      ->join('tb_serv_genset', 'tb_serv_genset.id_perbaikan_gst = ' . $tabel . '.id_perbaikan_gst')
      ->join('tb_genset', 'tb_genset.id_genset = tb_serv_genset.id_genset')
      // ->where('ket_perbaikan =', 1)
      ->get();
    return $query->result();
  }

  public function get_ServGstAcc($tabel, $where)
  {
    $query = $this->db->select('*')
      ->from($tabel)
      ->join('tb_serv_genset', 'tb_serv_genset.id_perbaikan_gst = ' . $tabel . '.id_perbaikan_gst')
      ->join('tb_genset', 'tb_genset.id_genset = tb_serv_genset.id_genset')
      ->where($where)
      ->get();
    return $query->result();
  }

  ####################################
  //* AJAX Data Perbaikan Genset 
  ####################################
  //set nama tabel yang akan kita tampilkan datanya
  var $tableserv = 'tb_serv_genset';
  //set kolom order, kolom pertama saya null untuk kolom edit dan hapus
  var $column_order_serv = array('kode_genset', 'nama_genset', 'jenis_perbaikan', 'nama_sparepart', 'tgl_perbaikan', 'ket_perbaikan', 'biaya_perbaikan', null);

  var $column_search_serv = array('kode_genset', 'nama_genset', 'jenis_perbaikan', 'nama_sparepart');
  // default order 
  var $order_serv = array('id_perbaikan_gst' => 'asc');

  private function _get_datatables_query_serv()
  {
    $this->db->from($this->tableserv)
      ->join('tb_genset', 'tb_genset.id_genset = tb_serv_genset.id_genset')
      ->join('tb_sparepart', 'tb_sparepart.id_sparepart = tb_serv_genset.id_sparepart');

    $i = 0;
    foreach ($this->column_search_serv as $item) // loop kolom 
    {
      if ($this->input->post('search')['value']) // jika datatable mengirim POST untuk search
      {
        if ($i === 0) // looping pertama
        {
          $this->db->group_start();
          $this->db->like($item, $this->input->post('search')['value']);
        } else {
          $this->db->or_like($item, $this->input->post('search')['value']);
        }
        if (count($this->column_search_serv) - 1 == $i) //looping terakhir
          $this->db->group_end();
      }
      $i++;
    }

    // jika datatable mengirim POST untuk order
    if ($this->input->post('order')) {
      $this->db->order_by($this->column_order_serv[$this->input->post('order')['0']['column']], $this->input->post('order')['0']['dir']);
    } else if (isset($this->order_serv)) {
      $orderserv = $this->order_serv;
      $this->db->order_by(key($orderserv), $orderserv[key($orderserv)]);
    }
  }

  function get_datatables_serv()
  {
    $this->_get_datatables_query_serv();
    if ($this->input->post('length') != -1)
      $this->db->limit($this->input->post('length'), $this->input->post('start'));
    $query = $this->db->get();
    return $query->result();
  }

  function count_filtered_serv()
  {
    $this->_get_datatables_query_serv();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function count_all_serv()
  {
    $this->db->from($this->tableserv);
    return $this->db->count_all_results();
  }

  ####################################
  //* End AJAX Data Perbaikan Genset 
  ####################################
  public function get_detail_perbaikan($tabel, $where) // Menampilkan isi detail Perbaikan Genset
  {
    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_genset', 'tb_genset.id_genset = ' . $tabel . '.id_genset')
      ->join('tb_sparepart', 'tb_sparepart.id_sparepart = ' . $tabel . '.id_sparepart')
      ->where('tb_serv_genset.id_perbaikan_gst', $where)
      ->get();
    return $query->result();
  }

  public function detail_perbaikan($tabel, $where) // Menampilkan progress detail Perbaikan Genset
  {
    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_serv_genset', 'tb_serv_genset.id_perbaikan_gst = ' . $tabel . '.id_perbaikan_gst ')
      ->where('tb_serv_genset.id_perbaikan_gst', $where)
      ->get();
    return $query->result();
  }

  public function select_sparepart($tabel)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->where('stok >', 0)
      ->get();
    return $query->result();
  }

  public function select_sparepartFilter($tabel, $stok)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->where('stok < ', $stok)
      // ->where_not_in('stok >', 5)
      // ->where('stok >', 0)
      ->get();
    return $query->result();
  }
  ####################################
  //* End Data Perbaikan Genset 
  ####################################

  ####################################
  //* Data Unit Keluar 
  ####################################

  public function get_auto_id($tabel)
  {
    $query = $this->db->select_max('id_transaksi')
      ->from($tabel)
      ->get();
    return $query->result();
  }

  public function notif_u_keluar1($tabel, $tgl, $where) // Pemberitahuan pengambilan unit keluar
  {
    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_genset', 'tb_genset.id_genset = ' . $tabel . '.id_genset')
      ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = ' . $tabel . '.id_pelanggan')
      ->where('status =', 2)
      ->where('DATEDIFF(DATE_SUB(tanggal_masuk, INTERVAL 1 DAY), "' . $tgl . '") <', 1)
      ->where($where)

      ->get();
    return $query->result();
  }

  public function notif_u_keluar($tabel, $tgl)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_genset', 'tb_genset.id_genset = ' . $tabel . '.id_genset')
      ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = ' . $tabel . '.id_pelanggan')
      ->where('status =', 2)
      ->where('DATEDIFF(DATE_SUB(tanggal_masuk, INTERVAL 1 DAY), "' . $tgl . '") <', 1)

      ->get();
    return $query->result();
  }

  public function notif_u_keluarJml($tabel, $tgl)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_genset', 'tb_genset.id_genset = ' . $tabel . '.id_genset')
      ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = ' . $tabel . '.id_pelanggan')
      ->where('status =', 2)
      ->where('DATEDIFF(DATE_SUB(tanggal_masuk, INTERVAL 1 DAY), "' . $tgl . '") <', 1)

      ->get();
    return $query->num_rows();
  }

  public function select_op($tabel)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->where('status_op =', 0)
      ->get();
    return $query->result();
  }

  public function select_gst($tabel) // Menampilkan isi genset yg masih ada atau dijadwalkan
  {
    $query = $this->db->select()
      ->from($tabel)
      ->where('ket_genset =', 0)
      ->or_where('ket_genset =', 2)
      ->get();
    return $query->result();
  }

  public function get_data_valid_penyewaan($tabel) // Menampilkan isi tabel Data Unit keluar atau sewa
  {
    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_operator', 'tb_operator.id_operator = ' . $tabel . '.id_operator')
      ->join('tb_mobil', 'tb_mobil.id_mobil = ' . $tabel . '.id_mobil')
      ->join('tb_unit_penyewaan', 'tb_unit_penyewaan.id_u_sewa = ' . $tabel . '.id_u_sewa', 'right')
      ->join('tb_genset', 'tb_genset.id_genset = tb_unit_penyewaan.id_genset', 'right')
      ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_unit_penyewaan.id_pelanggan', 'right')
      ->where('status =', 1)
      ->or_where('status =', 2)
      ->order_by('tanggal_keluar', 'asc')
      ->get();
    return $query->result();
  }

  public function ambil_data_valid_penyewaan($tabel, $where) // Ambil data penyewaan
  {
    $query = $this->db->select()
      ->from($tabel)
      ->where('tb_unit_penyewaan.id_u_sewa', $where)
      ->join('tb_operator', 'tb_operator.id_operator = ' . $tabel . '.id_operator')
      ->join('tb_mobil', 'tb_mobil.id_mobil = ' . $tabel . '.id_mobil')
      ->join('tb_unit_penyewaan', 'tb_unit_penyewaan.id_u_sewa = ' . $tabel . '.id_u_sewa', 'right')
      ->join('tb_genset', 'tb_genset.id_genset = tb_unit_penyewaan.id_genset', 'right')
      ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_unit_penyewaan.id_pelanggan', 'right')
      // 
      ->get();
    return $query->result();
  }



  public function get_data_u_keluar($tabel)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_genset', 'tb_genset.id_genset = ' . $tabel . '.id_genset')
      ->join('tb_operator', 'tb_operator.id_operator = ' . $tabel . '.id_operator')
      ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = ' . $tabel . '.id_pelanggan')
      ->join('tb_mobil', 'tb_mobil.id_mobil = ' . $tabel . '.id_mobil')
      ->where('status =', 1)
      ->or_where('status =', 2)
      ->order_by('tanggal_keluar', 'asc')
      ->get();
    return $query->result();
  }

  public function ambil_data_u_keluar($tabel)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_genset', 'tb_genset.id_genset = ' . $tabel . '.id_genset')
      ->join('tb_operator', 'tb_operator.id_operator = ' . $tabel . '.id_operator')
      ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = ' . $tabel . '.id_pelanggan')
      ->join('tb_mobil', 'tb_mobil.id_mobil = ' . $tabel . '.id_mobil')
      // ->where('status =', 1)
      // ->order_by('id_transaksi', 'asc')
      ->get();
    return $query->result();
  }

  public function select_data_u_keluar($tabel, $where) // Ambil data unit penyewaan
  {
    $query = $this->db->select()
      ->from($tabel)
      ->where('tb_unit_penyewaan.id_u_sewa', $where)
      ->join('tb_genset', 'tb_genset.id_genset = ' . $tabel . '.id_genset')
      // ->join('tb_operator', 'tb_operator.id_operator = ' . $tabel . '.id_operator')
      ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = ' . $tabel . '.id_pelanggan')
      // ->join('tb_mobil', 'tb_mobil.id_mobil = ' . $tabel . '.id_mobil')
      ->get();
    return $query->result();
  }

  public function select_jdw_gst($tabel) // Tampilkan isi tabel Jadwal Penyewaan Genset
  {
    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_operator', 'tb_operator.id_operator = ' . $tabel . '.id_operator')
      ->join('tb_genset', 'tb_genset.id_genset = ' . $tabel . '.id_genset')
      ->join('tb_mobil', 'tb_mobil.id_mobil = ' . $tabel . '.id_mobil')

      ->get();
    return $query->result();
  }

  public function filter_JadwalGenset($tabel, $genset, $operator) // Tampilkan filter isi tabel Jadwal Penyewaan Genset
  {
    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_operator', 'tb_operator.id_operator = ' . $tabel . '.id_operator')
      ->join('tb_genset', 'tb_genset.id_genset = ' . $tabel . '.id_genset')
      ->join('tb_mobil', 'tb_mobil.id_mobil = ' . $tabel . '.id_mobil')
      ->where_in('tb_genset.nama_genset', $genset)
      ->or_where_in('tb_operator.nama_op', $operator)
      ->order_by('tgl_keluar', 'asc')

      ->get();
    return $query->result();
  }

  public function notif_jdwGst($tabel, $tgl) // Pemeberitahuan Jadwal Penyewaan Genset
  {
    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_genset', 'tb_genset.id_genset = ' . $tabel . '.id_genset')
      ->join('tb_operator', 'tb_operator.id_operator = ' . $tabel . '.id_operator')
      ->join('tb_mobil', 'tb_mobil.id_mobil = ' . $tabel . '.id_mobil')
      ->where('status_jdw =', 1)
      ->where('DATEDIFF(DATE_SUB(tgl_keluar, INTERVAL 1 DAY), "' . $tgl . '") <', 1)

      ->get();
    return $query->result();
  }

  public function notif_jdwGst1($tabel, $tgl, $where) // Pemeberitahuan Jadwal Penyewaan Genset
  {
    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_genset', 'tb_genset.id_genset = ' . $tabel . '.id_genset')
      ->join('tb_operator', 'tb_operator.id_operator = ' . $tabel . '.id_operator')
      ->join('tb_mobil', 'tb_mobil.id_mobil = ' . $tabel . '.id_mobil')
      ->where('status_jdw =', 1)
      ->where('DATEDIFF(DATE_SUB(tgl_keluar, INTERVAL 1 DAY), "' . $tgl . '") <', 1)
      ->where($where)

      ->get();
    return $query->result();
  }

  public function notif_jdwGst_Jml($tabel, $tgl) // Pemeberitahuan jumlah Jadwal Penyewaan Genset
  {
    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_genset', 'tb_genset.id_genset = ' . $tabel . '.id_genset')
      ->join('tb_operator', 'tb_operator.id_operator = ' . $tabel . '.id_operator')
      ->join('tb_mobil', 'tb_mobil.id_mobil = ' . $tabel . '.id_mobil')
      ->where('status_jdw =', 1)
      ->where('DATEDIFF(DATE_SUB(tgl_keluar, INTERVAL 1 DAY), "' . $tgl . '") <', 1)

      ->get();
    return $query->num_rows();
  }

  public function get_jdw_gst($tabel, $where) // Tampilkan isi detail Jadwal Penyewaan Genset
  {
    $query = $this->db->select()
      ->from($tabel)
      ->where($where)
      ->join('tb_operator', 'tb_operator.id_operator = ' . $tabel . '.id_operator')
      ->join('tb_genset', 'tb_genset.id_genset = ' . $tabel . '.id_genset')
      ->join('tb_mobil', 'tb_mobil.id_mobil = ' . $tabel . '.id_mobil')

      ->get();
    return $query->result();
  }

  public function numrows_where_uKeluar($tabel)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->where('status =', 1)
      ->or_where('status =', 2)
      ->get();
    return $query->num_rows();
  }
  ####################################
  //* End Data Unit Keluar 
  ####################################
  ####################################
  //* Data Unit Masuk 
  ####################################

  public function numrows_where_uMasuk($tabel)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->where('status =', 0)
      ->get();
    return $query->num_rows();
  }

  public function get_data_det_genset($tabel, $where)
  {
    // $query = $this->db->select(' . $tabel . '.*,'kode_genset, nama_genset, daya')
    // $query = $this->db->select('sum(' . $tabel . '.jumlah_hari)')
    $query = $this->db->select_sum($tabel . '.jumlah_hari')
      ->select('tb_genset.kode_genset, tb_genset.nama_genset, tb_genset.daya,tb_genset.harga,tb_genset.gambar_genset,tb_genset.id_genset')
      ->from($tabel)
      ->join('tb_genset', 'tb_genset.id_genset = ' . $tabel . '.id_genset')
      // ->join('tb_genset', 'tb_genset.id_genset = ' . $tabel . '.id_genset', 'right')
      // ->join('tb_operator', 'tb_operator.id_operator = ' . $tabel . '.id_operator')
      // ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = ' . $tabel . '.id_pelanggan')
      // ->join('tb_mobil', 'tb_mobil.id_mobil = ' . $tabel . '.id_mobil')
      ->order_by('tanggal_masuk', 'asc')
      ->where('tb_genset.id_genset', $where)
      // ->where_in('tb_genset.kode_genset, tb_genset.nama_genset, tb_genset.daya')
      ->where('status =', 0)
      ->get();
    return $query->result();
  }

  public function det_genset_periode($tabel, $where, $bulan, $tahun)
  {
    $bulan = $this->db->escape($bulan);
    $tahun = $this->db->escape($tahun);
    // $query = $this->db->select(' . $tabel . '.*,'kode_genset, nama_genset, daya')
    // $query = $this->db->select('sum(' . $tabel . '.jumlah_hari)')
    $query = $this->db->select_sum($tabel . '.jumlah_hari')
      ->select('tb_genset.kode_genset, tb_genset.nama_genset, tb_genset.daya,tb_genset.harga,tb_genset.gambar_genset,tb_genset.id_genset')
      ->from($tabel)
      ->join('tb_genset', 'tb_genset.id_genset = ' . $tabel . '.id_genset')
      // ->join('tb_genset', 'tb_genset.id_genset = ' . $tabel . '.id_genset', 'right')
      // ->join('tb_operator', 'tb_operator.id_operator = ' . $tabel . '.id_operator')
      // ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = ' . $tabel . '.id_pelanggan')
      // ->join('tb_mobil', 'tb_mobil.id_mobil = ' . $tabel . '.id_mobil')
      ->order_by('tanggal_masuk', 'asc')
      ->where('tb_genset.id_genset', $where)
      ->where('MONTH (tanggal_masuk) =' . $bulan . ' AND YEAR (tanggal_masuk) =' . $tahun)
      // ->where_in('tb_genset.kode_genset, tb_genset.nama_genset, tb_genset.daya')
      ->where('status =', 0)
      ->get();
    return $query->result();
  }

  // public function get_jumlah_hari_genset($tabel, $where)
  // {
  //   $query = $this->db->select_sum($tabel . '.jumlah_hari')
  //     ->from($tabel)
  //     ->join('tb_genset', 'tb_genset.id_genset = ' . $tabel . '.id_genset')
  // ->join('tb_operator', 'tb_operator.id_operator = ' . $tabel . '.id_operator')
  // ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = ' . $tabel . '.id_pelanggan')
  // ->join('tb_mobil', 'tb_mobil.id_mobil = ' . $tabel . '.id_mobil')
  //     ->order_by('tanggal_masuk', 'asc')
  //     ->where('tb_genset.id_genset', $where)
  //     ->where('status =', 0)
  //     ->get();
  //   return $query->result();
  // }

  public function get_data_u_masuk($tabel)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_genset', 'tb_genset.id_genset = ' . $tabel . '.id_genset')
      // ->join('tb_operator', 'tb_operator.id_operator = ' . $tabel . '.id_operator')
      ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = ' . $tabel . '.id_pelanggan')
      // ->join('tb_mobil', 'tb_mobil.id_mobil = ' . $tabel . '.id_mobil')
      ->order_by('tanggal_masuk', 'asc')
      ->where('status =', 0)
      ->get();
    return $query->result();
  }

  public function get_data_valid_penyewaanMasuk($tabel) // Tampilkan isi tabel Data Unit Masuk/Kembali
  {
    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_operator', 'tb_operator.id_operator = ' . $tabel . '.id_operator')
      ->join('tb_mobil', 'tb_mobil.id_mobil = ' . $tabel . '.id_mobil')
      ->join('tb_unit_penyewaan', 'tb_unit_penyewaan.id_u_sewa = ' . $tabel . '.id_u_sewa', 'right')
      ->join('tb_genset', 'tb_genset.id_genset = tb_unit_penyewaan.id_genset', 'right')
      ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_unit_penyewaan.id_pelanggan', 'right')
      ->where('status =', 0)
      ->order_by('tanggal_keluar', 'asc')
      ->get();
    return $query->result();
  }

  public function det_data_valid_penyewaanMasuk($tabel, $where)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_operator', 'tb_operator.id_operator = ' . $tabel . '.id_operator')
      ->join('tb_mobil', 'tb_mobil.id_mobil = ' . $tabel . '.id_mobil')
      ->join('tb_unit_penyewaan', 'tb_unit_penyewaan.id_u_sewa = ' . $tabel . '.id_u_sewa', 'right')
      ->join('tb_genset', 'tb_genset.id_genset = tb_unit_penyewaan.id_genset', 'right')
      ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_unit_penyewaan.id_pelanggan', 'right')
      ->where('tb_unit_penyewaan.id_u_sewa', $where)
      ->where('status =', 0)
      ->order_by('tanggal_keluar', 'asc')
      ->get();
    return $query->result();
  }

  public function select_data_u_masuk($tabel, $where)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->where($where)
      ->join('tb_genset', 'tb_genset.id_genset = ' . $tabel . '.id_genset')
      ->join('tb_operator', 'tb_operator.id_operator = ' . $tabel . '.id_operator')
      ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = ' . $tabel . '.id_pelanggan')
      ->join('tb_mobil', 'tb_mobil.id_mobil = ' . $tabel . '.id_mobil')
      ->get();
    return $query->result();
  }

  public function gsel_data_u_keluar($tabel) //! Untuk report cetak_penyewaan all
  {
    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_operator', 'tb_operator.id_operator = ' . $tabel . '.id_operator')
      ->join('tb_mobil', 'tb_mobil.id_mobil = ' . $tabel . '.id_mobil')
      ->join('tb_unit_penyewaan', 'tb_unit_penyewaan.id_u_sewa = ' . $tabel . '.id_u_sewa', 'right')
      ->join('tb_genset', 'tb_genset.id_genset = tb_unit_penyewaan.id_genset', 'right')
      ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_unit_penyewaan.id_pelanggan', 'right')
      // ->join('tb_genset', 'tb_genset.id_genset = ' . $tabel . '.id_genset')
      // ->join('tb_operator', 'tb_operator.id_operator = ' . $tabel . '.id_operator')
      // ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = ' . $tabel . '.id_pelanggan')
      // ->join('tb_mobil', 'tb_mobil.id_mobil = ' . $tabel . '.id_mobil')
      ->where('tb_unit_penyewaan.status =', 0)
      ->order_by('tanggal_masuk', 'asc')

      ->get();
    return $query->result();
  }

  public function grep_data_u_keluar($tabel, $bulan, $tahun) //! Untuk report cetak_penyewaan periode
  {
    $bulan = $this->db->escape($bulan);
    $tahun = $this->db->escape($tahun);

    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_operator', 'tb_operator.id_operator = ' . $tabel . '.id_operator')
      ->join('tb_mobil', 'tb_mobil.id_mobil = ' . $tabel . '.id_mobil')
      ->join('tb_unit_penyewaan', 'tb_unit_penyewaan.id_u_sewa = ' . $tabel . '.id_u_sewa', 'right')
      ->join('tb_genset', 'tb_genset.id_genset = tb_unit_penyewaan.id_genset', 'right')
      ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_unit_penyewaan.id_pelanggan', 'right')
      // ->join('tb_genset', 'tb_genset.id_genset = ' . $tabel . '.id_genset')
      // ->join('tb_operator', 'tb_operator.id_operator = ' . $tabel . '.id_operator')
      // ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = ' . $tabel . '.id_pelanggan')
      // ->join('tb_mobil', 'tb_mobil.id_mobil = ' . $tabel . '.id_mobil')
      ->where('MONTH (tanggal_masuk) =' . $bulan . ' AND YEAR (tanggal_masuk) =' . $tahun)
      ->where('status =', 0)
      ->order_by('tanggal_masuk', 'asc')
      ->get();
    return $query->result();
  }

  public function sum_pendapatan($tabel, $bulan, $tahun) // Jumlahkan total pendapatan Data Unit Masuk/Kembali
  {
    $bulan = $this->db->escape($bulan);
    $tahun = $this->db->escape($tahun);
    $query = $this->db->select_sum('total')
      ->from($tabel)
      ->join('tb_valid_penyewaan', 'tb_valid_penyewaan.id_u_sewa = ' . $tabel . '.id_u_sewa')
      ->where('status =', 0)
      ->where('MONTH (tanggal_masuk) =' . $bulan . ' AND YEAR (tanggal_masuk) =' . $tahun)
      ->get();
    return $query->result();
  }
  ####################################
  //* End Data Unit Masuk 
  ####################################
  ####################################
  //* Pemasukan 
  ####################################
  public function get_data_pemasukan($tabel) // Tampilkan isi tabel Data Pendapatan
  {
    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_unit_penyewaan', 'tb_unit_penyewaan.id_u_sewa = ' . $tabel . '.id_u_sewa')
      ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_unit_penyewaan.id_pelanggan')
      ->order_by('tanggal_masuk', 'asc')
      ->get();
    return $query->result();
  }

  public function sum_pemasukan($tabel) // Jumlahkan total pendapatan Data Unit Masuk/Kembali
  {
    $query = $this->db->select_sum('total')
      ->from($tabel)
      ->join('tb_unit_penyewaan', 'tb_unit_penyewaan.id_u_sewa = ' . $tabel . '.id_u_sewa')
      // ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_unit_penyewaan.id_pelanggan')
      ->get();
    return $query->result();
  }

  public function pemasukan_periode($tabel, $bulan, $tahun) // Tampilkan isi tabel Data Pendapatan dalam periode
  {
    $bulan = $this->db->escape($bulan);
    $tahun = $this->db->escape($tahun);

    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_unit_penyewaan', 'tb_unit_penyewaan.id_u_sewa = ' . $tabel . '.id_u_sewa')
      ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_unit_penyewaan.id_pelanggan')
      ->where('MONTH (tanggal_masuk) =' . $bulan . ' AND YEAR (tanggal_masuk) =' . $tahun)
      // ->where('YEAR (tanggal_masuk)' . $tahun)
      // ->order_by('tanggal_masuk', 'asc')
      ->get();
    return $query->result();
  }

  public function bulan_lbl($tabel, $bulan)
  {
    $bulan = $this->db->escape($bulan);
    $query = $this->db->select_max('MONTH (tanggal_masuk)')
      ->from($tabel)
      ->get();
    return $query->result();
  }

  public function sum_pendapatanMasuk($tabel, $bulan, $tahun) // Jumlahkan total pendapatan Data Unit Masuk/Kembali dalam periode 
  {
    $bulan = $this->db->escape($bulan);
    $tahun = $this->db->escape($tahun);
    $query = $this->db->select_sum('total')
      ->from($tabel)
      ->join('tb_unit_penyewaan', 'tb_unit_penyewaan.id_u_sewa = ' . $tabel . '.id_u_sewa')
      ->where('MONTH (tanggal_masuk) =' . $bulan . ' AND YEAR (tanggal_masuk) =' . $tahun)
      ->get();
    return $query->result();
  }

  public function chart_pendapatanMasuk($tabel, $bulan, $tahun) // Tampilkan isi tabel Data Pendapatan dalam grafik dalam 1 bulan
  {
    $bulan = $this->db->escape($bulan);
    $tahun = $this->db->escape($tahun);
    $query = $this->db->select('tanggal_masuk, total')
      ->from($tabel)
      ->join('tb_unit_penyewaan', 'tb_unit_penyewaan.id_u_sewa = tb_pendapatan.id_u_sewa')
      ->where('MONTH (tanggal_masuk) =' . $bulan)
      ->order_by('tanggal_masuk,total', 'asc')
      // ->order_by('tanggal_masuk', 'asc')
      ->get();
    return $query->result();
  }

  public function chart_pendapatanMasukAll($tabel) // Tampilkan isi tabel Data Pendapatan dalam grafik
  {
    // $bulan = $this->db->escape($bulan);
    // $tahun = $this->db->escape($tahun);
    $query = $this->db->select('tanggal_masuk, total')
      ->from($tabel)
      ->join('tb_unit_penyewaan', 'tb_unit_penyewaan.id_u_sewa = tb_pendapatan.id_u_sewa')
      // ->where('MONTH (tanggal_masuk) =' . $bulan)
      ->order_by('tanggal_masuk,total', 'asc')
      // ->order_by('tanggal_masuk', 'asc')
      ->get();
    return $query->result();
  }
  ####################################
  //* End Pemasukan 
  ####################################
  ####################################
  //* Pengeluaran 
  ####################################
  public function pengeluaran_periode($tabel, $bulan, $tahun) // Tampilkan isi tabel Pengeluaran dalam periode
  {
    $bulan = $this->db->escape($bulan);
    $tahun = $this->db->escape($tahun);

    $query = $this->db->select()
      ->from($tabel)
      ->where('MONTH (tgl_pengeluaran) =' . $bulan . ' AND YEAR (tgl_pengeluaran) =' . $tahun)
      // ->where('YEAR (tanggal_masuk)' . $tahun)
      // ->order_by('tanggal_masuk', 'asc')
      ->get();
    return $query->result();
  }

  public function sum_penngeluaranPeriode($tabel, $bulan, $tahun) // Jumlahkan biaya_pengeluaran pengeluaran dalam periode
  {
    $bulan = $this->db->escape($bulan);
    $tahun = $this->db->escape($tahun);
    $query = $this->db->select_sum('biaya_pengeluaran')
      ->from($tabel)
      ->where('MONTH (tgl_pengeluaran) =' . $bulan . ' AND YEAR (tgl_pengeluaran) =' . $tahun)
      ->get();
    return $query->result();
  }

  public function sum_pengeluaran($tabel) // Jumlahkan biaya_pengeluaran pengeluaran
  {
    $query = $this->db->select_sum('biaya_pengeluaran')
      ->from($tabel)
      ->get();
    return $query->result();
  }
  ####################################
  //* End Pengeluaran 
  ####################################
  ####################################
  //! Model Khusus User Penyewa 
  ####################################

  public function get_data_plg($tabel)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_user', 'tb_user.id_user = tb_pelanggan.id_user')
      ->where('tb_pelanggan.id_user =', $this->session->userdata('id_user'))
      ->get();
    return $query->result();
  }

  public function sel_data_valid_penyewa($tabel)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_operator', 'tb_operator.id_operator = ' . $tabel . '.id_operator')
      ->join('tb_mobil', 'tb_mobil.id_mobil = ' . $tabel . '.id_mobil')
      ->join('tb_unit_penyewaan', 'tb_unit_penyewaan.id_u_sewa = ' . $tabel . '.id_u_sewa', 'right')
      ->join('tb_genset', 'tb_genset.id_genset = tb_unit_penyewaan.id_genset', 'right')
      ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_unit_penyewaan.id_pelanggan', 'right')
      ->where('tb_pelanggan.id_user =', $this->session->userdata('id_user'))
      ->where('status =', 1)
      ->or_where('status =', 2)
      ->order_by('tanggal_keluar', 'asc')
      ->get();
    return $query->result();
  }

  public function get_data_valid_penyewa($tabel, $where) // Menampilkan detail Data Unit Sewa
  {
    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_operator', 'tb_operator.id_operator = ' . $tabel . '.id_operator')
      ->join('tb_mobil', 'tb_mobil.id_mobil = ' . $tabel . '.id_mobil')
      ->join('tb_unit_penyewaan', 'tb_unit_penyewaan.id_u_sewa = ' . $tabel . '.id_u_sewa', 'right')
      ->join('tb_genset', 'tb_genset.id_genset = tb_unit_penyewaan.id_genset', 'right')
      ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_unit_penyewaan.id_pelanggan', 'right')
      ->where($where)

      ->get();
    return $query->result();
  }
  // public function sel_data_u_keluar($tabel)
  // {
  //   $query = $this->db->select()
  //     ->from($tabel)
  //     ->join('tb_genset', 'tb_genset.id_genset = ' . $tabel . '.id_genset')
  //     ->join('tb_operator', 'tb_operator.id_operator = ' . $tabel . '.id_operator')
  //     ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = ' . $tabel . '.id_pelanggan')
  //     ->join('tb_mobil', 'tb_mobil.id_mobil = ' . $tabel . '.id_mobil')
  //     ->join('tb_user', 'tb_user.id_user = tb_pelanggan.id_user')
  //     ->where('tb_pelanggan.id_user =', $this->session->userdata('id_user'))
  //     ->where('status =', 1)
  //     ->or_where('status =', 2)

  //     ->get();
  //   return $query->result();
  // }

  // public function get_data_Ukeluar($tabel, $where)
  // {
  //   $query = $this->db->select()
  //     ->from($tabel)
  //     ->join('tb_genset', 'tb_genset.id_genset = ' . $tabel . '.id_genset')
  //     ->join('tb_operator', 'tb_operator.id_operator = ' . $tabel . '.id_operator')
  //     ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = ' . $tabel . '.id_pelanggan')
  //     ->join('tb_mobil', 'tb_mobil.id_mobil = ' . $tabel . '.id_mobil')
  //     ->where($where)
  //     // ->where('tb_pelanggan.id_user =', $this->session->userdata('id_user'))
  //     ->get();
  //   return $query->result();
  // }

  public function sel_data_u_masuk($tabel)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_genset', 'tb_genset.id_genset = ' . $tabel . '.id_genset')
      ->join('tb_operator', 'tb_operator.id_operator = ' . $tabel . '.id_operator')
      ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = ' . $tabel . '.id_pelanggan')
      ->join('tb_mobil', 'tb_mobil.id_mobil = ' . $tabel . '.id_mobil')
      ->join('tb_user', 'tb_user.id_user = tb_pelanggan.id_user')
      ->where('tb_pelanggan.id_user =', $this->session->userdata('id_user'))
      ->where('status =', 0)

      ->get();
    return $query->result();
  }

  public function sel_data_valid_penyewaMasuk($tabel)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_operator', 'tb_operator.id_operator = ' . $tabel . '.id_operator')
      ->join('tb_mobil', 'tb_mobil.id_mobil = ' . $tabel . '.id_mobil')
      ->join('tb_unit_penyewaan', 'tb_unit_penyewaan.id_u_sewa = ' . $tabel . '.id_u_sewa', 'right')
      ->join('tb_genset', 'tb_genset.id_genset = tb_unit_penyewaan.id_genset', 'right')
      ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_unit_penyewaan.id_pelanggan', 'right')
      ->where('tb_pelanggan.id_user =', $this->session->userdata('id_user'))
      ->where('status =', 0)

      ->order_by('tanggal_keluar', 'asc')
      ->get();
    return $query->result();
  }
  public function get_data_Umasuk($tabel, $where)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_genset', 'tb_genset.id_genset = ' . $tabel . '.id_genset')
      ->join('tb_operator', 'tb_operator.id_operator = ' . $tabel . '.id_operator')
      ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = ' . $tabel . '.id_pelanggan')
      ->join('tb_mobil', 'tb_mobil.id_mobil = ' . $tabel . '.id_mobil')
      ->where($where)
      // ->where('tb_pelanggan.id_user =', $this->session->userdata('id_user'))
      ->get();
    return $query->result();
  }
  ####################################
  //! End Model Khusus User Penyewa
  ####################################

}

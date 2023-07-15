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

  public function get_avatar($tabel, $username) //* Query get avatar User
  {
    $query = $this->db->select()
      ->from($tabel)
      ->where('username', $username)
      ->get();
    return $query->result();
  }

  public function update_avatar($where, $data) //* Query update Avatar User
  {
    $this->db->set($data);
    $this->db->where($where);
    $this->db->update('tb_user');
  }

  public function update_password($tabel, $where, $data) //* Update password
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

  public function update_status($tabel, $where, $status)
  {
    $this->db->set("status", $status);
    $this->db->where("id_u_sewa", $where);
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

  public function numrows_where($tabel, $where)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->where($where)
      ->get();
    return $query->num_rows();
  }


  ####################################
  //* New Query
  ####################################

  public function get_Plg($tabel)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->where('ket_plg =', 0)
      ->get();
    return $query->result();
  }

  public function get_Plg_Blc($tabel)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->where('ket_plg =', 1)
      ->get();
    return $query->result();
  }

  public function notif_stok($tabel)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->where('stok <', 2)
      ->get();
    return $query->result();
  }
  public function notif_stok_jml($tabel)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->where('stok <', 2)
      ->get();
    return $query->num_rows();
  }

  public function update_status_gst($tabel, $where, $status_gst)
  {
    $this->db->set("ket_genset", $status_gst);
    $this->db->where("id_genset", $where);
    $this->db->update($tabel);
  }

  public function update_status_op($tabel, $where, $status_op)
  {
    $this->db->set("status_op", $status_op);
    $this->db->where("id_operator", $where);
    $this->db->update($tabel);
  }

  public function update_status_plg($tabel, $where, $status_plg)
  {
    $this->db->set("status_plg", $status_plg);
    $this->db->where("id_pelanggan", $where);
    $this->db->update($tabel);
  }
  ####################################
  //* Data Perbaikan Genset 
  ####################################

  public function get_data_service($tabel)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_genset', 'tb_genset.id_genset = ' . $tabel . '.id_genset')
      ->join('tb_sparepart', 'tb_sparepart.id_sparepart = ' . $tabel . '.id_sparepart')
      ->order_by('id_perbaikan_gst', 'asc')
      ->get();
    return $query->result();
  }

  public function mengurangi_stok($tabel, $spare_part, $stok_new)
  {
    $this->db->set("stok", $stok_new);
    $this->db->where('id_sparepart', $spare_part);
    $this->db->update($tabel);
  }

  public function get_Serv($tabel)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_genset', 'tb_genset.id_genset = tb_serv_genset.id_genset')
      ->where('ket_perbaikan =', 1)
      ->get();
    return $query->result();
  }

  public function select_ServGstAcc($tabel)
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
  public function get_detail_perbaikan($tabel, $where)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_genset', 'tb_genset.id_genset = ' . $tabel . '.id_genset')
      ->join('tb_sparepart', 'tb_sparepart.id_sparepart = ' . $tabel . '.id_sparepart')
      ->where($where)
      ->get();
    return $query->result();
  }

  public function detail_perbaikan($tabel, $where)
  {
    $query = $this->db->select()
      ->from($tabel)
      // ->join('tb_serv_genset', 'tb_serv_genset.where = tb_detail_serv.id_perbaikan_gst ')
      ->where($where)
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

  public function notif_u_keluar($tabel, $tgl)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_genset', 'tb_genset.id_genset = ' . $tabel . '.id_genset')
      ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = ' . $tabel . '.id_pelanggan')
      ->where('status =', 1)
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
      ->where('status =', 1)
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

  public function select_gst($tabel)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->where('ket_genset =', 0)
      // ->or_where('ket_genset =', 2)
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

  public function select_data_u_keluar($tabel, $where)
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

  public function select_jdw_gst($tabel)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_operator', 'tb_operator.id_operator = ' . $tabel . '.id_operator')
      ->join('tb_genset', 'tb_genset.id_genset = ' . $tabel . '.id_genset')
      ->join('tb_mobil', 'tb_mobil.id_mobil = ' . $tabel . '.id_mobil')

      ->get();
    return $query->result();
  }
  // public function select_jdw_gst($tabel)
  // {
  //   $query = $this->db->select()
  //     ->from($tabel)
  //     ->join('tb_unit_penyewaan', 'tb_unit_penyewaan.id_u_sewa = ' . $tabel . '.id_u_sewa')
  //     ->join('tb_genset', 'tb_genset.id_genset = tb_unit_penyewaan.id_genset')
  //     ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_unit_penyewaan.id_pelanggan')

  //     ->get();
  //   return $query->result();
  // }

  public function get_jdw_gst($tabel, $where)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->where($where)
      ->join('tb_unit_penyewaan', 'tb_unit_penyewaan.id_u_sewa = ' . $tabel . '.id_u_sewa')
      ->join('tb_genset', 'tb_genset.id_genset = tb_unit_penyewaan.id_genset')
      ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_unit_penyewaan.id_pelanggan')

      ->get();
    return $query->result();
  }
  ####################################
  //* End Data Unit Keluar 
  ####################################
  ####################################
  //* Data Unit Masuk 
  ####################################
  public function get_data_u_masuk($tabel)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_genset', 'tb_genset.id_genset = ' . $tabel . '.id_genset')
      ->join('tb_operator', 'tb_operator.id_operator = ' . $tabel . '.id_operator')
      ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = ' . $tabel . '.id_pelanggan')
      ->join('tb_mobil', 'tb_mobil.id_mobil = ' . $tabel . '.id_mobil')
      // ->order_by('id_transaksi', 'asc')
      ->where('status =', 0)
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
      ->join('tb_genset', 'tb_genset.id_genset = ' . $tabel . '.id_genset')
      ->join('tb_operator', 'tb_operator.id_operator = ' . $tabel . '.id_operator')
      ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = ' . $tabel . '.id_pelanggan')
      ->join('tb_mobil', 'tb_mobil.id_mobil = ' . $tabel . '.id_mobil')
      ->where('status =', 0)
      // ->order_by('tanggal_masuk', 'asc')

      ->get();
    return $query->result();
  }

  public function grep_data_u_keluar($tabel, $bulan, $tahun) //! Untuk report cetak_penyewaan periode
  {
    $bulan = $this->db->escape($bulan);
    $tahun = $this->db->escape($tahun);

    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_genset', 'tb_genset.id_genset = ' . $tabel . '.id_genset')
      ->join('tb_operator', 'tb_operator.id_operator = ' . $tabel . '.id_operator')
      ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = ' . $tabel . '.id_pelanggan')
      ->join('tb_mobil', 'tb_mobil.id_mobil = ' . $tabel . '.id_mobil')
      ->where('MONTH (tanggal_masuk) =' . $bulan . ' AND YEAR (tanggal_masuk) =' . $tahun)
      ->where('status =', 0)
      // ->order_by('tanggal_masuk', 'asc')
      ->get();
    return $query->result();
  }

  public function sum_pendapatan($tabel)
  {
    $query = $this->db->select_sum('total')
      ->from($tabel)
      ->get();
    return $query->result();
  }
  ####################################
  //* End Data Unit Masuk 
  ####################################
  ####################################
  //* Pemasukan 
  ####################################
  public function get_data_pemasukan($tabel)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_unit_penyewaan', 'tb_unit_penyewaan.id_u_sewa = ' . $tabel . '.id_u_sewa')
      ->get();
    return $query->result();
  }

  public function sum_pemasukan($tabel)
  {
    $query = $this->db->select_sum('total')
      ->from($tabel)
      ->join('tb_unit_penyewaan', 'tb_unit_penyewaan.id_u_sewa = ' . $tabel . '.id_u_sewa')
      ->get();
    return $query->result();
  }

  public function pemasukan_periode($tabel, $bulan, $tahun)
  {
    $bulan = $this->db->escape($bulan);
    $tahun = $this->db->escape($tahun);

    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_unit_penyewaan', 'tb_unit_penyewaan.id_u_sewa = ' . $tabel . '.id_u_sewa')
      ->where('MONTH (tanggal_masuk) =' . $bulan . ' AND YEAR (tanggal_masuk) =' . $tahun)
      // ->where('YEAR (tanggal_masuk)' . $tahun)
      // ->order_by('tanggal_masuk', 'asc')
      ->get();
    return $query->result();
  }

  public function sum_pendapatanMasuk($tabel, $bulan, $tahun)
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
  public function chart_pendapatanMasuk($tabel)
  {
    // $bulan = $this->db->escape($bulan);
    // $tahun = $this->db->escape($tahun);
    $query = $this->db->select('MONTH (tanggal_masuk),total')
      ->from($tabel)
      ->join('tb_unit_penyewaan', 'tb_unit_penyewaan.id_u_sewa = tb_pendapatan.id_u_sewa')
      // ->where('MONTH (tanggal_masuk) =' . $bln . ' AND YEAR (tanggal_masuk) =' . $thn)
      ->order_by('total', 'asc')
      ->get();
    return $query->result();
  }
  ####################################
  //* End Pemasukan 
  ####################################
  ####################################
  //* Pengeluaran 
  ####################################
  public function pengeluaran_periode($tabel, $bulan, $tahun)
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

  public function sum_penngeluaranPeriode($tabel, $bulan, $tahun)
  {
    $bulan = $this->db->escape($bulan);
    $tahun = $this->db->escape($tahun);
    $query = $this->db->select_sum('biaya_pengeluaran')
      ->from($tabel)
      ->where('MONTH (tgl_pengeluaran) =' . $bulan . ' AND YEAR (tgl_pengeluaran) =' . $tahun)
      ->get();
    return $query->result();
  }

  public function sum_pengeluaran($tabel)
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

  public function sel_data_u_keluar($tabel)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_genset', 'tb_genset.id_genset = ' . $tabel . '.id_genset')
      ->join('tb_operator', 'tb_operator.id_operator = ' . $tabel . '.id_operator')
      ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = ' . $tabel . '.id_pelanggan')
      ->join('tb_mobil', 'tb_mobil.id_mobil = ' . $tabel . '.id_mobil')
      ->join('tb_user', 'tb_user.id_user = tb_pelanggan.id_user')
      ->where('tb_pelanggan.id_user =', $this->session->userdata('id_user'))
      ->where('status =', 1)

      ->get();
    return $query->result();
  }

  public function get_data_Ukeluar($tabel, $where)
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

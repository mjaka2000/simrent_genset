<?php
class M_pimpinan extends CI_Model
{

  ####################################
  //* CRUD
  ####################################

  // public function insert($tabel, $data)
  // {
  //   $this->db->insert($tabel, $data);
  // }

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

  // public function delete($tabel, $where)
  // {
  //   $this->db->where($where);
  //   $this->db->delete($tabel);
  // }


  ####################################
  //! Old Query 
  ####################################

  public function update_password($tabel, $where, $data)
  {
    $this->db->where($where);
    $this->db->update($tabel, $data);
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

  public function get_data($tabel, $id_transaksi)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->where($id_transaksi)
      ->get();
    return $query->result();
  }

  ####################################
  //* New Query
  ####################################

  //! Batas Query User

  public function get_avatar($tabel, $username) //*Query User
  {
    $query = $this->db->select()
      ->from($tabel)
      ->where('username', $username)
      ->get();
    return $query->result();
  }

  public function update_avatar($where, $data) //*Query Avatar User
  {
    $this->db->set($data);
    $this->db->where($where);
    $this->db->update('tb_user');
  }

  //! Batas Query User
  // public function notif_stok($tabel)
  // {
  //   $query = $this->db->select()
  //     ->from($tabel)
  //     ->where('stok <', 2)
  //     ->get();
  //   return $query->result();
  // }

  // public function notif_stok_jml($tabel)
  // {
  //   $query = $this->db->select()
  //     ->from($tabel)
  //     ->where('stok <', 2)
  //     ->get();
  //   return $query->num_rows();
  // }

  public function get_data_service($tabel)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_genset', 'tb_genset.id_genset = tb_serv_genset.id_genset')
      ->join('tb_sparepart', 'tb_sparepart.id_sparepart = tb_serv_genset.id_sparepart')
      ->get();
    return $query->result();
  }

  public function get_detail_perbaikan($tabel, $id_perbaikan_gst)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_genset', 'tb_genset.id_genset = tb_serv_genset.id_genset')
      ->join('tb_sparepart', 'tb_sparepart.id_sparepart = tb_serv_genset.id_sparepart')
      ->where($id_perbaikan_gst)
      ->get();
    return $query->result();
  }

  public function detail_perbaikan($tabel, $id_perbaikan_gst)
  {
    $query = $this->db->select()
      ->from($tabel)
      // ->join('tb_serv_genset', 'tb_serv_genset.id_perbaikan_gst = tb_detail_serv.id_perbaikan_gst ')
      ->where($id_perbaikan_gst)
      ->get();
    return $query->result();
  }

  public function get_data_u_keluar($tabel)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_genset', 'tb_genset.id_genset = tb_unit_keluar.id_genset')
      ->join('tb_operator', 'tb_operator.id_operator = tb_unit_keluar.id_operator')
      ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_unit_keluar.id_pelanggan')
      ->join('tb_mobil', 'tb_mobil.id_mobil = tb_unit_keluar.id_mobil')
      ->get();
    return $query->result();
  }

  public function select_data_u_keluar($tabel, $where)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->where($where)
      ->join('tb_genset', 'tb_genset.id_genset = tb_unit_keluar.id_genset')
      ->join('tb_operator', 'tb_operator.id_operator = tb_unit_keluar.id_operator')
      ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_unit_keluar.id_pelanggan')
      ->join('tb_mobil', 'tb_mobil.id_mobil = tb_unit_keluar.id_mobil')
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
  //* Pemasukan 
  ####################################
  public function get_data_pemasukan($tabel)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_unit_keluar', 'tb_unit_keluar.id_u_keluar = tb_pendapatan.id_u_keluar')
      ->get();
    return $query->result();
  }

  public function sum_pemasukan($tabel)
  {
    $query = $this->db->select_sum('total')
      ->from($tabel)
      ->join('tb_unit_keluar', 'tb_unit_keluar.id_u_keluar = tb_pendapatan.id_u_keluar')
      ->get();
    return $query->result();
  }

  public function pemasukan_periode($tabel, $bulan, $tahun)
  {
    $bulan = $this->db->escape($bulan);
    $tahun = $this->db->escape($tahun);

    $query = $this->db->select()
      ->from($tabel)
      ->join('tb_unit_keluar', 'tb_unit_keluar.id_u_keluar = tb_pendapatan.id_u_keluar')
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
      ->join('tb_unit_keluar', 'tb_unit_keluar.id_u_keluar = tb_pendapatan.id_u_keluar')
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
      ->join('tb_unit_keluar', 'tb_unit_keluar.id_u_keluar = tb_pendapatan.id_u_keluar')
      // ->where('MONTH (tanggal_masuk) =' . $bln . ' AND YEAR (tanggal_masuk) =' . $thn)
      ->order_by('total', 'asc')
      ->get();
    return $query->result();
  }
  ####################################
  //* End Pemasukan 
  ####################################
}

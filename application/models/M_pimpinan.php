<?php
class M_pimpinan extends CI_Model
{

  public function update_password($tabel, $where, $data)
  {
    $this->db->where($where);
    $this->db->update($tabel, $data);
  }

  public function select($tabel)
  {
    return $this->db->select()
      ->from($tabel)
      ->get()->result();
  }

  public function get_data_gambar($tabel, $username)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->where('username_user', $username)
      ->get();
    return $query->result();
  }

  public function mengurangi($tabel, $kode_genset, $stok_gd_new)
  {
    $this->db->set("stok_gd", $stok_gd_new);
    $this->db->where('kode_genset', $kode_genset);
    $this->db->update($tabel);
  }

  public function menambah($tabel, $kode_genset, $stok_pj_new)
  {
    $this->db->set("stok_pj", $stok_pj_new);
    $this->db->where('kode_genset', $kode_genset);
    $this->db->update($tabel);
  }

  public function insert($tabel, $data)
  {
    $this->db->insert($tabel, $data);
  }

  public function get_data_tb($tabel, $id_transaksi)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->where($id_transaksi)
      ->get();
    return $query->result();
  }
}

<?php
class M_pimpinan extends CI_Model
{

  ####################################
  // CRUD
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
}

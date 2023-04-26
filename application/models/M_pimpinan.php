<?php
class M_pimpinan extends CI_Model
{

  ####################################
  // CRUD
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
  //! Old Query 
  ####################################

  public function get_data_array($tabel, $id_transaksi)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->where($id_transaksi)
      ->get();
    return $query->result_array();
  }

  public function get_data($tabel, $id_transaksi)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->where($id_transaksi)
      ->get();
    return $query->result();
  }

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



  ####################################
  //* New Query
  ####################################


  public function get_avatar($tabel, $username)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->where('username_user', $username)
      ->get();
    return $query->result();
  }

  public function update_avatar($where, $data)
  {
    $this->db->set($data);
    $this->db->where($where);
    $this->db->update('tb_avatar');
  }


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
}

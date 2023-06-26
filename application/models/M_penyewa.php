<?php

class M_penyewa extends CI_Model
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

    ####################################
    //* New Query
    ####################################

    //! Batas Query User

    public function get_avatar($tabel, $username) //* Query User
    {
        $query = $this->db->select()
            ->from($tabel)
            ->where('username', $username)
            ->get();
        return $query->result();
    }

    public function update_avatar($where, $data) //* Query Avatar User
    {
        $this->db->set($data);
        $this->db->where($where);
        $this->db->update('tb_user');
    }

    public function get_user($tabel)
    {
        $query = $this->db->select()
            ->from($tabel)
            // ->where('nama', $nama)
            ->join('tb_pelanggan', 'tb_pelanggan.id_user = tb_user.id_user')
            ->where('id_user', $this->session->userdata('id_user'))
            ->get();
        return $query->result();
    }

    public function get_data_plg($tabel)
    {
        $query = $this->db->select()
            ->from($tabel)
            ->join('tb_user', 'tb_user.id_user = tb_pelanggan.id_user')
            ->where('tb_pelanggan.id_user =', $this->session->userdata('id_user'))
            ->get();
        return $query->result();
    }

    //! Batas Query User
}

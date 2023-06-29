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
    ####################################
    //* New Query
    ####################################
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
    //* Data Unit Keluar 
    ####################################

    public function get_auto_id($tabel)
    {
        $query = $this->db->select_max('id_transaksi')
            ->from($tabel)
            ->get();
        return $query->result();
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
            ->get();
        return $query->result();
    }


    public function sel_data_u_keluar($tabel)
    {
        $query = $this->db->select()
            ->from($tabel)
            ->join('tb_genset', 'tb_genset.id_genset = tb_unit_keluar.id_genset')
            ->join('tb_operator', 'tb_operator.id_operator = tb_unit_keluar.id_operator')
            ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_unit_keluar.id_pelanggan')
            ->join('tb_mobil', 'tb_mobil.id_mobil = tb_unit_keluar.id_mobil')
            ->join('tb_user', 'tb_user.id_user = tb_pelanggan.id_user')
            ->where('tb_pelanggan.id_user =', $this->session->userdata('id_user'))
            ->where('status =', 1)

            ->get();
        return $query->result();
    }

    public function get_data_u_keluar($tabel, $where)
    {
        $query = $this->db->select()
            ->from($tabel)
            ->join('tb_genset', 'tb_genset.id_genset = tb_unit_keluar.id_genset')
            ->join('tb_operator', 'tb_operator.id_operator = tb_unit_keluar.id_operator')
            ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_unit_keluar.id_pelanggan')
            ->join('tb_mobil', 'tb_mobil.id_mobil = tb_unit_keluar.id_mobil')
            ->where($where)
            // ->where('tb_pelanggan.id_user =', $this->session->userdata('id_user'))
            ->get();
        return $query->result();
    }

    ####################################
    //* End Data Unit Keluar 
    ####################################
    ####################################
    //* Data Unit Masuk 
    ####################################
    public function sel_data_u_masuk($tabel)
    {
        $query = $this->db->select()
            ->from($tabel)
            ->join('tb_genset', 'tb_genset.id_genset = tb_unit_masuk.id_genset')
            ->join('tb_operator', 'tb_operator.id_operator = tb_unit_masuk.id_operator')
            ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_unit_masuk.id_pelanggan')
            ->join('tb_mobil', 'tb_mobil.id_mobil = tb_unit_masuk.id_mobil')
            ->join('tb_user', 'tb_user.id_user = tb_pelanggan.id_user')
            ->where('tb_pelanggan.id_user =', $this->session->userdata('id_user'))
            // ->where('status =', )

            ->get();
        return $query->result();
    }

    public function get_data_u_masuk($tabel, $where)
    {
        $query = $this->db->select()
            ->from($tabel)
            ->join('tb_genset', 'tb_genset.id_genset = tb_unit_masuk.id_genset')
            ->join('tb_operator', 'tb_operator.id_operator = tb_unit_masuk.id_operator')
            ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_unit_masuk.id_pelanggan')
            ->join('tb_mobil', 'tb_mobil.id_mobil = tb_unit_masuk.id_mobil')
            ->where($where)
            // ->where('tb_pelanggan.id_user =', $this->session->userdata('id_user'))
            ->get();
        return $query->result();
    }
    ####################################
    //* End Data Unit Masuk 
    ####################################
}

<?php

class M_login extends CI_Model
{
    public function insert($tabel, $data)
    {
        $this->db->insert($tabel, $data);
    }

    public function cek_username($tabel, $username)
    {
        return $this->db->select('username')
            ->from($tabel)
            ->where('username', $username)
            ->get()->result();
    }

    public function cek_user($tabel, $username)
    {
        return  $this->db->select('*')
            ->from($tabel)
            ->where('username', $username)
            ->get();
    }

    public function idgambar($username)
    {
        $query = $this->db->select()
            ->from('tb_user')
            ->where('username', $username)
            ->get()->row();
        return $query->id;
    }

    function edit_user($where, $data)
    {
        $this->db->where($where);
        return $this->db->update('tb_user', $data);
    }

    function cek_login($table, $where)
    {
        return $this->db->get_where($table, $where);
    }
    function cek_uname($table, $where)
    {
        return $this->db->where($table, $where);
    }

    // function role_user($role)
    // {
    //     return $this->db->query("SELECT * FROM tb_user WHERE role='$role'")->row();
    // }

    ####################################
    //* New Query
    ####################################



}

<?php

class M_teknisi extends CI_Model
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


    ####################################
    //* Data Perbaikan Genset 
    ####################################

    public function get_data_service($tabel)
    {
        $query = $this->db->select()
            ->from($tabel)
            ->join('tb_genset', 'tb_genset.id_genset = tb_serv_genset.id_genset')
            ->join('tb_sparepart', 'tb_sparepart.id_sparepart = tb_serv_genset.id_sparepart')
            ->get();
        return $query->result();
    }


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
    //* End Data Perbaikan Genset 
    ####################################
}

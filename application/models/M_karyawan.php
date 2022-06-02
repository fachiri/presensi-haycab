<?php 


class M_karyawan extends CI_Model
{
    public  function data_jabatan($id,$table)
    {
        $query = $this->db->get_where("jabatan",['id_jabatan' => $id]);
        if($query->num_rows() > 0)
        {
            $data = $query->row_array();
            return $data["{$table}"];
        }else{
            return '';
        }
    }
}



?>
<?php
class Unidade_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all() {
        $query = $this->db->order_by('nome_unidade','ASC')->get('unidades');
            return $query->result();
    }

    public function get_by_id($id) {
        return $this->db->get_where('unidades', array('id_unidade' => $id))->row();
    }

    public function insert($data) {
        $this->db->insert('unidades', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $this->db->where('id_unidade', $id);
        $this->db->update('unidades', $data);
    }

    public function delete($id) {
        $this->db->where('id_unidade',$id);
        $count = $this->db->count_all_result('desbravadores');
            if($count > 0){
                return false;
            }
                $this->db->where('id_unidade',$id);
                    return $this->db->delete('unidades');
    }
    
}
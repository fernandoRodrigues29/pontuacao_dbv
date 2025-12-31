<?php
class Pontuacao_model extends CI_Model {
    public function get_by_desbravador($id_desbravador) {
        $this->db->where('id_desbravador', $id_desbravador);
        $this->db->order_by('data_reuniao', 'DESC');
        $query = $this->db->get('pontuacao_diaria');
        foreach ($query->result() as $row) {
            $row->total_dia = $row->pontualidade + $row->uniforme + $row->espiritual + $row->classe + $row->comportamento + $row->tesouraria + $row->bonus;
        }
        return $query->result();
    }

    public function insert($data) {
        $data['total_dia'] = $data['pontualidade'] + $data['uniforme'] + $data['espiritual'] + $data['classe'] + $data['comportamento'] + $data['tesouraria'] + $data['bonus'];
        $this->db->insert('pontuacao_diaria', $data);
    }


    public function get_by_id($id)
    {
        $this->db->select('d.*, u.nome_unidade');
        $this->db->from('desbravadores d');
        $this->db->join('unidades u', 'u.id_unidade = d.id_unidade', 'left');
        $this->db->where('d.id_desbravador', $id);
        return $this->db->get()->row();
    }

    // update e delete semelhantes
}
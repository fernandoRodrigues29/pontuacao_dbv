<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pontuacao extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Unidade_model');
        $this->load->model('Desbravador_model');
        $this->load->model('Pontuacao_model');
        $this->load->helper('date');

        $this->load->helper('url');
        $this->load->helper('form');
    }

    /**
     * Tela principal: Selecionar unidade e lançar pontos do dia
     */
    public function lancar()
    {
        $data['unidades'] = $this->Unidade_model->get_all();

        $id_unidade = $this->input->get('id_unidade');

            if ($id_unidade) {
                $data['unidade_selecionada'] = $this->Unidade_model->get_by_id($id_unidade);

                    if (!$data['unidade_selecionada']) {
                        show_error('Unidade não encontrada.', 404);
                    }

                        // Busca todos os desbravadores da unidade
                        $this->db->where('id_unidade', $id_unidade);
                        $this->db->order_by('nome_completo', 'ASC');
                        
                        $data['desbravadores'] = $this->db->get('desbravadores')->result();
                            $arr = [];    
                           
                            foreach ($data['desbravadores'] as $key=>$value) {
                                $resultado = $this->Pontuacao_model->get_by_desbravador($value->id_desbravador);
                                            if(!empty($resultado)){
                                                $arr[] = $resultado[0];
                                            }else{
                                                $arr[] = [
                                                    "id_ponto"=>0,
                                                    "data_reuniao"=>"0000-00-00",
                                                    "pontualidade"=>0,
                                                    "uniforme"=>0,
                                                    "espiritual"=>0,
                                                    "classe"=>0,
                                                    "comportamento"=>0,
                                                    "tesouraria"=>0,
                                                    "bonus"=>0,
                                                    "total_dia"=>0
                                                ];
                                            }
                            }
                          
                            $data['registro_desbravadores'] = array_map(
                                fn($a, $b)=>(object) array_merge((array) $a, (array)$b),
                               $data['desbravadores'],$arr);
                    }

                $data['title'] = 'Cantinho da Unidade - Lançar Pontos';
                $this->load->view('pontuacao/lancar', $data);
    }

    /**
     * Salva os pontos lançados (pode ser vários desbravadores de uma vez)
     */
    public function salvar()
    {
        if ($this->input->method() !== 'post') {
            redirect('pontuacao/lancar');
        }

        $desbravadores = $this->input->post('desbravadores');
        $data_reuniao = $this->input->post('data_reuniao');
        $id_unidade   = $this->input->post('id_unidade');

        if (empty($desbravadores) || empty($data_reuniao)) {
            $this->session->set_flashdata('erro', 'Dados inválidos.');
            redirect('pontuacao/lancar?id_unidade=' . $id_unidade);
        }

        $salvos = 0;
        foreach ($desbravadores as $id_desbravador => $pontos) {
            // Verifica se já existe pontuação para este desbravador nesta data
            $existe = $this->db->get_where('pontuacao_diaria', [
                'id_desbravador' => $id_desbravador,
                'data_reuniao'   => $data_reuniao
            ])->row();

            // Calcula o total do dia
            $total = (int)$pontos['pontualidade'] +
                     (int)$pontos['uniforme'] +
                     (int)$pontos['espiritual'] +
                     (int)$pontos['classe'] +
                     (int)$pontos['comportamento'] +
                     (int)$pontos['tesouraria'] +
                     (int)$pontos['bonus'];

            $dados = [
                'id_desbravador' => $id_desbravador,
                'data_reuniao'   => $data_reuniao,
                'pontualidade'   => $pontos['pontualidade'],
                'uniforme'       => $pontos['uniforme'],
                'espiritual'     => $pontos['espiritual'],
                'classe'         => $pontos['classe'],
                'comportamento'  => $pontos['comportamento'],
                'tesouraria'     => $pontos['tesouraria'],
                'bonus'          => $pontos['bonus'],
                'total_dia'      => $total
            ];

            if ($existe) {
                // Atualiza se já existir
                $this->db->where('id_ponto', $existe->id_ponto);
                $this->db->update('pontuacao_diaria', $dados);
            } else {
                // Insere novo
                $this->db->insert('pontuacao_diaria', $dados);
            }

            $salvos++;
        }
        
        $this->session->set_flashdata('sucesso', "$salvos pontuações salvas com sucesso para $data_reuniao!");
        redirect('pontuacao/lancar?id_unidade=' . $id_unidade);
    }

    /**
     * Histórico individual de um desbravador
     */
    public function historico($id_desbravador = null)
    {
        if (!$id_desbravador) {
            show_404();
        }

        $desbravador = $this->Desbravador_model->get_by_id($id_desbravador);
        if (!$desbravador) {
            show_error('Desbravador não encontrado.', 404);
        }

        // Busca todas as pontuações ordenadas por data
        $this->db->where('id_desbravador', $id_desbravador);
        $this->db->order_by('data_reuniao', 'DESC');
        $pontuacoes = $this->db->get('pontuacao_diaria')->result();

        // Calcula total acumulado
        $total_acumulado = 0;
        foreach ($pontuacoes as $p) {
            $total_acumulado += $p->total_dia;
        }

        $data['desbravador']      = $desbravador;
        $data['pontuacoes']       = $pontuacoes;
        $data['total_acumulado']  = $total_acumulado;
        $data['title']            = 'Histórico - ' . $desbravador->nome_completo;

        $this->load->view('pontuacao/historico', $data);
    }

    /**
     * Ranking geral por unidade (bônus útil!)
     */
    public function ranking()
    {
        $this->db->select('u.nome_unidade, d.nome_completo, d.cargo, SUM(p.total_dia) as total_pontos');
        $this->db->from('pontuacao_diaria p');
        $this->db->join('desbravadores d', 'd.id_desbravador = p.id_desbravador');
        $this->db->join('unidades u', 'u.id_unidade = d.id_unidade');
        $this->db->group_by('p.id_desbravador');
        $this->db->order_by('total_pontos', 'DESC');
        $data['ranking'] = $this->db->get()->result();

        $data['title'] = 'Ranking Geral - Cantinho da Unidade';
        $this->load->view('pontuacao/ranking', $data);
    }
}
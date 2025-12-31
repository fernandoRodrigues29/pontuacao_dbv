<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Desbravadores extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Desbravador_model');
        $this->load->model('Unidade_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['desbravadores'] = $this->Desbravador_model->get_all();
        $data['title'] = 'Gerenciar Desbravadores';

        $this->load->view('desbravadores/index', $data);
    }

    public function adicionar()
    {
        $data['unidades'] = $this->Unidade_model->get_all();
        $data['title'] = 'Adicionar Desbravador';
        $this->load->view('desbravadores/form', $data);
    }

    public function editar($id = null)
    {
        if (!$id || !$desbravador = $this->Desbravador_model->get_by_id($id)) {
            show_404();
        }

        $data['desbravador'] = $desbravador;
        $data['unidades'] = $this->Unidade_model->get_all();
        $data['title'] = 'Editar Desbravador';
        $this->load->view('desbravadores/form', $data);
    }

    public function salvar()
    {
        $this->form_validation->set_rules('nome_completo', 'Nome Completo', 'required|trim|min_length[5]');
        $this->form_validation->set_rules('id_unidade', 'Unidade', 'required');

        if ($this->form_validation->run() === FALSE) {
            $id = $this->input->post('id_desbravador');
            if ($id) {
                $this->editar($id);
            } else {
                $this->adicionar();
            }
        } else {
            $id = $this->input->post('id_desbravador');

            $data = array(
                'nome_completo' => $this->input->post('nome_completo'),
                'id_unidade'    => $this->input->post('id_unidade'),
                'cargo'         => $this->input->post('cargo') ?: 'Membro'
            );

            if ($id) {
                $this->Desbravador_model->update($id, $data);
                $this->session->set_flashdata('sucesso', 'Desbravador atualizado com sucesso!');
            } else {
                $this->Desbravador_model->insert($data);
                $this->session->set_flashdata('sucesso', 'Desbravador cadastrado com sucesso!');
            }

            redirect('desbravadores');
        }
    }

    public function deletar($id = null)
    {
        if (!$id || !$this->Desbravador_model->get_by_id($id)) {
            show_404();
        }

        if ($this->Desbravador_model->delete($id)) {
            $this->session->set_flashdata('sucesso', 'Desbravador excluído com sucesso!');
        } else {
            $this->session->set_flashdata('erro', 'Não é possível excluir: este desbravador já tem pontuação lançada.');
        }

        redirect('desbravadores');
    }
}
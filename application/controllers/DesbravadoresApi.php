<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DesbravadoresApi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Desbravador_model');
        $this->load->model('Unidade_model');
        $this->load->library('form_validation');
        header('Content-Type: application/json'); // Para APIs
    }

    // View principal que carrega o Vue (substitui index.php view)
    public function app() {
        $this->load->view('vue_app'); // View que inclui o bundle Vue
    }

    // API: Listar todos
    public function index() {
        echo json_encode($this->Desbravador_model->get_all());
    }

    // API: Buscar um
    public function get($id) {
        $data = $this->Desbravador_model->get_by_id($id);
        if (!$data) show_404();
        echo json_encode($data);
    }

    // API: Salvar (POST para insert, PUT para update)
    public function save($id = null) {
        $this->form_validation->set_rules('nome_completo', 'Nome Completo', 'required|trim|min_length[5]');
        $this->form_validation->set_rules('id_unidade', 'Unidade', 'required');

        if ($this->form_validation->run() === FALSE) {
            http_response_code(400);
            echo json_encode(['errors' => $this->form_validation->error_array()]);
            return;
        }

        $data = [
            'nome_completo' => $this->input->post('nome_completo'),
            'id_unidade'    => $this->input->post('id_unidade'),
            'cargo'         => $this->input->post('cargo') ?: 'Membro'
        ];

        if ($id) {
            $this->Desbravador_model->update($id, $data);
        } else {
            $this->Desbravador_model->insert($data);
        }

        echo json_encode(['sucesso' => true]);
    }

    // API: Deletar
    public function delete($id) {
        if (!$this->Desbravador_model->get_by_id($id)) show_404();

        if ($this->Desbravador_model->delete($id)) {
            echo json_encode(['sucesso' => true]);
        } else {
            http_response_code(400);
            echo json_encode(['erro' => 'Não é possível excluir: este desbravador já tem pontuação lançada.']);
        }
    }
}
<?php
class Unidades extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Unidade_model');
        $this->load->library('form_validation');
    }

    // public function index() {
    //     $data['unidades'] = $this->Unidade_model->get_all();
    //     $this->load->view('unidades/lista', $data);
    // }

    public function index() {
            $data['unidades'] = $this->Unidade_model->get_all();
            $data['title'] = 'Gerenciar Unidades';
                $this->load->view('unidades/index', $data);
    }
    
    public function adicionar(){
        $data['title'] = 'Adicionar Unidade';
        $this->load->view('unidades/form',$data);
    }

    public function editar($id = null){
        if(!$id || !$unidade = $this->Unidade_model->get_by_id($id)){
            show_404();
        }

        $data['unidade']=$unidade;
        $data['title']='Editar Unidade';
            $this->load->view('unidades/form',$data);

    }
    public function salvar(){
        $this->form_validation->set_rules('nome_unidade','Nome da Unidade','required|trim|min_length[3]');
        if($this->form_validation->run() === FALSE){
           $id = $this->input->post('id_unidade');
            if($id){
                $this->editar($id);
            } else {
                $this->adicionar();
            }
        }else{
            $id = $this->input->post('id_unidade');
                $data = array(
                    'nome_unidade'=>$this->input->post('nome_unidade'),
                    'classe_base'=>$this->input->post('classe_base') ?: 'Amigo/Companhaeiro'
                );

                    if($id){
                        $this->Unidade_model->update($id, $data);
                        $this->session->set_flashdata('sucesso', 'Unidade atualizada com sucesso!');
                    }else{
                        $this->Unidade_model->insert($data);
                        $this->session->set_flashdata('sucesso', 'Unidade criada com sucesso!');
                    }
                        redirect('unidades');
        }
    }

    public function deletar($id = null){
        if(!$id || !$unidade = $this->Unidade_model->get_by_id($id)){
            show_404();
        }

        if($this->Unidade_model->delete($id)){
             $this->session->set_flashdata('sucesso', 'Unidade excluida com sucesso!');
        }else{
            $this->session->set_flashdata('erro', 'Não é possível excluir: há desbravadores nesta unidade.');
        }
    }

}
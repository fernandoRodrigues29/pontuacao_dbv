<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setup extends CI_Controller {
    public function index() {
        $this->load->dbforge();

        // 1. Tabela unidades
        $fields = array(
            'id_unidade' => array(
                'type'           => 'INTEGER',
                'auto_increment' => TRUE
            ),
            'nome_unidade' => array(
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => FALSE
            ),
            'classe_base' => array(
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'default'    => 'Amigo/Companheiro'
            )
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id_unidade', TRUE);
        $this->dbforge->create_table('unidades', TRUE);

        // 2. Tabela desbravadores (com FK diretamente no CREATE)
        $fields = array(
            'id_desbravador' => array(
                'type'           => 'INTEGER',
                'auto_increment' => TRUE
            ),
            'nome_completo' => array(
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => FALSE
            ),
            'id_unidade' => array(
                'type'       => 'INTEGER',
                'null'       => TRUE  // permite NULL se quiser desbravador sem unidade
            ),
            'cargo' => array(
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'default'    => 'Membro'
            ),
            // Definindo a Foreign Key diretamente aqui
            'CONSTRAINT fk_unidade FOREIGN KEY (id_unidade) REFERENCES unidades(id_unidade) ON DELETE SET NULL ON UPDATE CASCADE'
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id_desbravador', TRUE);
        $this->dbforge->create_table('desbravadores', TRUE);

        // 3. Tabela pontuacao_diaria (com FK diretamente)
        $fields = array(
            'id_ponto' => array(
                'type'           => 'INTEGER',
                'auto_increment' => TRUE
            ),
            'id_desbravador' => array(
                'type' => 'INTEGER'
            ),
            'data_reuniao' => array(
                'type' => 'DATE',
                'null' => FALSE
            ),
            'pontualidade' => array('type' => 'INTEGER', 'default' => 0),
            'uniforme'     => array('type' => 'INTEGER', 'default' => 0),
            'espiritual'   => array('type' => 'INTEGER', 'default' => 0),
            'classe'       => array('type' => 'INTEGER', 'default' => 0),
            'comportamento'=> array('type' => 'INTEGER', 'default' => 0),
            'tesouraria'   => array('type' => 'INTEGER', 'default' => 0),
            'bonus'        => array('type' => 'INTEGER', 'default' => 0),
            'total_dia'    => array('type' => 'INTEGER', 'default' => 0),
            // Foreign Key para desbravador
            'CONSTRAINT fk_desbravador FOREIGN KEY (id_desbravador) REFERENCES desbravadores(id_desbravador) ON DELETE CASCADE ON UPDATE CASCADE'
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id_ponto', TRUE);
        $this->dbforge->create_table('pontuacao_diaria', TRUE);

        // ATIVAR FOREIGN KEYS NO SQLITE
        $this->db->query('PRAGMA foreign_keys = ON;');

        // Dados de exemplo
        $this->db->insert('unidades', array('nome_unidade' => 'Unidade Águia'));

        $this->db->insert('desbravadores', array(
            'nome_completo' => 'João Silva',
            'id_unidade'    => 1,
            'cargo'         => 'Membro'
        ));

        $this->db->insert('pontuacao_diaria', array(
            'id_desbravador' => 1,
            'data_reuniao'   => '2025-12-21',
            'pontualidade'   => 10,
            'uniforme'       => 15,
            'espiritual'     => 20,
            'classe'         => 20,
            'comportamento'  => 15,
            'tesouraria'     => 10,
            'bonus'          => 0,
            'total_dia'      => 90
        ));

        echo "<h2>Banco de dados criado com sucesso!</h2>";
        echo "<p>Tabelas: unidades, desbravadores, pontuacao_diaria</p>";
        echo "<p>Foreign Keys ativadas e definidas corretamente.</p>";
        echo "<p><strong>Agora delete este controller (Setup.php) por segurança.</strong></p>";
    }
}
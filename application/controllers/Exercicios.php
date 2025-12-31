<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exercicios extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        echo "Ok está funcionando";
        // $arr=['alfa'=>'123','bravo'=>'456','charlie'=>'789','delta'=>'101112'];
        // $arr2=['a'=>'paris','b'=>'roma','c'=>'londres'];
        // $teste = array_merge($arr,$arr2);
        // echo "<pre>";
        // var_dump($teste);
    
        // $arr3=[0=>['alf'=>'1','brav'=>'2','charlie'=>'3'],1=>['delta'=>'4','echo'=>'5','fox'=>'6']];
        // $arr4=[0=>['a'=>'paris','b'=>'roma','c'=>'londres'],1=>['d'=>'damasco','e'=>'israel','f'=>'madri']];
        
        // $test2 = array_replace_recursive($arr3,$arr4);
        // echo "<pre>";
        // var_dump($test2);

    $arr_objs = [
        0 => (object) [
            "id_desbravador" => 2,
            "nome_completo" => "joão L silva",
            "id_unidade" => 2,
            "cargo" => "memb 2"
        ],
        1 => (object) [
            "id_desbravador" => 3,
            "nome_completo" => "joão X silva",
            "id_unidade" => 2,
            "cargo" => "memb 8"
        ],
        2 => (object) [
            "id_desbravador" => 4,
            "nome_completo" => "andre X silva",
            "id_unidade" => 2,
            "cargo" => "memb 1"
        ]
    ];

    $arr=[
        0=>[
            'alf'=>'1',
            'brav'=>'2',
            'charlie'=>'3'
        ],
        1=>[
            'delta'=>'4',
            'echo'=>'5',
            'fox'=>'6'
        ],
        2=>[
            'delta'=>'7',
            'echo'=>'8',
            'fox'=>'9'
        ],
        ];

    $arr_convert = array_map(function($item) {
        return (array) $item;
    }, $arr_objs);

    $teste = array_replace_recursive($arr_convert,$arr);
    echo "<pre>";
    var_dump($teste);

}

}
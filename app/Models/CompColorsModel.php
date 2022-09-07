<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;

class CompColorsModel
{
    protected $db;    
    public function __construct(ConnectionInterface &$db)
    {
        $this->db =& $db; 
    }

    function find_whr($compkey)
    {
        $builder = $this->db->table('compcolors');
        $records = $builder
                    ->where(['compKey' => $compkey])
                    ->get()->getResult();
                    
        return $records;    
    }

    function set_default(){
        $colors =  array(   
            'header'    => '#ffffff',
            'footer'    => '#ffffff',
            'font1'     =>'#454545',
            'font2'     =>'#454545',
            'buttons'   => '#a5c422'
        );
            $this->update_record('1', $colors);
        
    }

    function insert_record($part, $color)
    {

        $data = array(
            'part' => $part,
            'hex_color' => $color
        );
        
        $builder = $this->db->table('compcolors');
        $builder->insert($data); 
    }

    function update_record($colorsId, $colors)
    {
        
        $builder = $this->db->table('compcolors');
        $builder
        ->where('colorsId', $colorsId)
        ->update($colors);
    }

     
}
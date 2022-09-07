<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;

class ComDprtmntModel
{
    protected $db;    
    public function __construct(ConnectionInterface &$db)
    {
        $this->db =& $db; 
    }

    function find_whr($compkey)
    {
        #print("from acc model check user");
        
        $builder = $this->db->table('compdep');
          
        $records = $builder
                    ->where(['compKey' => $compkey])
                    ->get()->getResult();
                    
        
        return $records;

                
    }

    function insert_record($aCompKey, $aDepName)
    {
        $data = array(
            'compKey' => $aCompKey,
            'DepName' => $aDepName,
        );
        
        $builder = $this->db->table('compdep');
        $builder->insert($data); 
    }

    function update_record($aDepName, $aDepID)
    {
        $data = array(
            'DepName' => $aDepName,
        );
        
        $builder = $this->db->table('compdep');
        //$builder->where('id', $id);
        $builder
        ->where('DepID', $aDepID)
        ->update($data); 
    }

    function delete_record($aDepID)
    {
        $builder = $this->db->table('compdep');
        $builder
        ->where('DepID', $aDepID)
        ->delete(); 
    }

     
}
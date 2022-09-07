<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;

class ComBranchModel
{
    protected $db;    
    public function __construct(ConnectionInterface &$db)
    {
        $this->db =& $db; 
    }

    function find_whr($compkey, $abranchID=0)
    {
        $builder = $this->db->table('compbranch');  
        $records = $builder
                    ->where(['compKey' => $compkey])
                    #->where('branchID', $abranchID)
                    ->get()->getResult();

        return $records;        
    }

    function insert_record($aCompKey, $aBranchName)
    {
        $data = array(
            'compKey' => $aCompKey,
            'BranchName' => $aBranchName,
        );
        
        $builder = $this->db->table('compbranch');
        $builder->insert($data); 
    }

    function update_record($aBranchName, $abranchID)
    {
        $data = array(
            'BranchName' => $aBranchName,
        );
        
        $builder = $this->db->table('compbranch');
        //$builder->where('id', $id);
        $builder
        ->where('branchID', $abranchID)
        ->update($data); 
    }

    function delete_record($adId)
    {
        $builder = $this->db->table('compbranch');
        $builder
        ->where('branchID', $adId)
        ->delete(); 
    }

     
}
<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;

class ComAttchModel
{
    protected $db;    
    public function __construct(ConnectionInterface &$db)
    {
        $this->db =& $db; 
    }

    function find_whr($acompCustResKey)
    {
        #print("from acc model check user");
       
        $builder = $this->db->table('compattachment');
          
        $records = $builder
                    ->where(['compCustResKey' => $acompCustResKey])
                    ->get()->getResult();
                    
        
        return $records;

                
    }

    function insert_record($aCompKey, $acompCustResKey, $aattchName, $aattchSize, $aattchSntStat, $aattchSmary)
    {
         
        $data = array(
            'compKey'           => $aCompKey,
            'compCustResKey'    => $acompCustResKey,
            'attchName'         => $aattchName,
            'attchSize'         => $aattchSize,
            'attchSntStat'      => $aattchSntStat,
            'attchSmary'        => $aattchSmary,
        );
        
        $builder = $this->db->table('compattachment');
        $builder->insert($data); 
    }

    function update_record($adUrl, $aattchName, $aattchSize, $aattchSntStat, $aattchSmary, $aattchId)
    {
        #`attchId`, `compCustResKey`, `attchName`, `attchSize`, `attchSntStat`, `attchSmary`
        $data = array(
            'attchName' => $aattchName,
            'attchSize' => $aattchSize,
            'attchSntStat' => $aattchSntStat,
            'attchSmary' => $aattchSmary,
        );
        
        $builder = $this->db->table('compattachment');
        //$builder->where('id', $id);
        $builder
        ->where('attchId', $aattchId)
        ->update($data); 
    }

    function delete_record($aattchId)
    {
        $builder = $this->db->table('compattachment');
        $builder
        ->where('attchId', $aattchId)
        ->delete(); 
    }

     
}
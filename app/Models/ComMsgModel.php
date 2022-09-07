<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;

class ComMsgModel
{
    protected $db;    
    public function __construct(ConnectionInterface &$db)
    {
        $this->db =& $db; 
    }

    function find_whr($compkey)
    {
        #print("from acc model check user");
        
        $builder = $this->db->table('compmsgs');
          
        $records = $builder
                    ->where(['compKey' => $compkey])
                    ->get()->getResult();
                    
        
        return $records;

                
    }

    function insert_record($aCompKey, $amsgBalance, $amsgChrgDt, $amsgLstUsdDt, $amsgSmry)
    {
        #`msgId`, `compKey`, `msgBalance`, `msgChrgDt`, `msgLstUsdDt`, `msgSmry`
        $data = array(
            'compKey' => $aCompKey,
            'msgBalance' => $amsgBalance,
            'msgChrgDt' => $amsgChrgDt,
            'msgLstUsdDt' => $amsgLstUsdDt,
            'msgSmry' => $amsgSmry,
        );
        
        $builder = $this->db->table('compmsgs');
        $builder->insert($data); 
    }

    function update_record($amsgBalance, $amsgChrgDt, $amsgLstUsdDt, $amsgSmry, $amsgId)
    {
        $data = array(
            'msgBalance' => $amsgBalance,
            'msgChrgDt' => $amsgChrgDt,
            'msgLstUsdDt' => $amsgLstUsdDt,
            'msgSmry' => $amsgSmry,
        );
        
        $builder = $this->db->table('compmsgs');
        //$builder->where('id', $id);
        $builder
        ->where('msgId', $amsgId)
        ->update($data); 
    }

    function delete_record($amsgId)
    {
        $builder = $this->db->table('compmsgs');
        $builder
        ->where('msgId', $amsgId)
        ->delete(); 
    }

     
}
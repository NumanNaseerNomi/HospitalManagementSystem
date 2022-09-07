<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;

class ComAdsModel
{
    protected $db;    
    public function __construct(ConnectionInterface &$db)
    {
        $this->db =& $db; 
    }

    function find_whr($compkey)
    {
        #print("from acc model check user");
        
        $builder = $this->db->table('compad');
          
        $records = $builder
                    ->where(['compKey' => $compkey])
                    ->get()->getResult();
                    
        
        return $records;

                
    }

    function insert_record($aCompKey, $adPhotoName, $adUrl)
    {
        $data = array(
            'compKey' => $aCompKey,
            'adPhotoName' => $adPhotoName,
            'adUrl' => $adUrl,
        );
        
        $builder = $this->db->table('compad');
        $builder->insert($data); 
    }

    function update_record($adUrl, $adId)
    {
        $data = array(
            'adUrl' => $adUrl,
        );
        
        $builder = $this->db->table('compad');
        //$builder->where('id', $id);
        $builder
        ->where('adId', $adId)
        ->update($data); 
    }

    function delete_record($adId)
    {
        $builder = $this->db->table('compad');
        $builder
        ->where('adId', $adId)
        ->delete(); 
    }

     
}
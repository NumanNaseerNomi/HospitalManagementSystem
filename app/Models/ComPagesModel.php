<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;

class ComPagesModel
{
    protected $db;
    public function __construct(ConnectionInterface &$db)
    {
        $this->db =& $db; 
    }

    function find_whr($compkey)
    {
        #print("from acc model check user");
        $builder = $this->db->table('compages');
          
        $records = $builder
                    ->where(['compKey' => $compkey])
                    ->get()->getResult();
                    
        
        return $records;

                
    }

    function insert_record($aCompKey, $aPageName, $aPagePhoto, $aPageTxt)
    {
        $data = array(
            'compKey' => $aCompKey,
            'pageName' => $aPageName,
            'pagePhoto' => $aPagePhoto,
            'pageTxt' => $aPageTxt
        );
        
        $builder = $this->db->table('compages');
        $builder->insert($data); 
    }

    function update_record($aPageName, $aPageTxt, $pageID)
    {
        $data = array(
            'pageName' => $aPageName,
            'pageTxt' => $aPageTxt
        );

        
        $builder = $this->db->table('compages');
        $builder
        ->where('pageId', $pageID)
        ->update($data); 
    }

    function delete_record($pageID)
    {
        $builder = $this->db->table('compages');
        $builder
        ->where('pageId', $pageID)
        ->delete(); 
    }

     
}
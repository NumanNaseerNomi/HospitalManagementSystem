<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;

class CompAccModel
{
    protected $db;

    public function __construct(ConnectionInterface &$db)
    {
        $this->db =& $db; 
    }

    function checkUser($phoneNumb, $pass)
    {
        #print("from acc model check user");
        $builder = $this->db->table('compacc');
        
                
        $logedin_user = $builder
                    ->where(['AccNumb' => $phoneNumb])
                    ->where(['AccPassword' => $pass])
                    #->first();
                    ->get()->getResult();
                    
        
        return $logedin_user;

                
    }

    function find_whr($compKey)
    {
        $builder = $this->db->table('compacc');
        $records = $builder
                    ->where(['compKey' => $compKey])
                    ->where(['compAccTypeKey < ' => '3'])
                    ->get()->getResult();
        return $records;      
    }

    function find_by_phone($aAccNumb)
    {
        $builder = $this->db->table('compacc');
        $records = $builder
                    ->where(['AccNumb' => $aAccNumb])
                    ->get()->getResult();
        return $records;      
    }

    function find_by_accId($aAccId)
    {
        $builder = $this->db->table('compacc');
        $records = $builder
                    ->where(['accId' => $aAccId])
                    ->get()->getResult();
        return $records;      
    }

    function insert_record($aCompKey, $acompAccTypeKey, $aAccName, $aAccNumb, $aAccEmail, $aAccPassword, $aAccPrefLang)
    {
        
        $data = array(
            'compKey'           => $aCompKey,
            'compAccTypeKey'    => $acompAccTypeKey,
            'AccName'           => $aAccName,
            'AccNumb'           => $aAccNumb,
            'AccEmail'          => $aAccEmail,
            'AccPassword'       => $aAccPassword,
            'AccPrefLang'       => $aAccPrefLang,
        );
        
        $builder = $this->db->table('compacc');
        $builder->insert($data); 
    }

    function update_record($acompAccTypeKey, $aAccName, $aAccNumb, $aAccEmail, $aAccPassword, $aAccPrefLang, $accId)
    {
        $data = array(
            'compAccTypeKey'    => $acompAccTypeKey,
            'AccName'           => $aAccName,
            'AccNumb'           => $aAccNumb,
            'AccEmail'          => $aAccEmail,
            'AccPassword'       => $aAccPassword,
            'AccPrefLang'       => $aAccPrefLang,
        );
        
        $builder = $this->db->table('compacc');
        $builder
        ->where('accId', $accId)
        ->update($data); 
    }

    function delete_record($accId)
    {
        $builder = $this->db->table('compacc');
        $builder
        ->where('accId', $accId)
        ->delete(); 
    }


     
}
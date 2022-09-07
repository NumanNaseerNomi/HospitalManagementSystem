<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;

class ComRsrvModel
{
    protected $db;    
    public function __construct(ConnectionInterface &$db)
    {
        $this->db =& $db; 
    }

    function find_whr($acompSrvKey)
    {
        $builder = $this->db->table('compcustres');
        $records = $builder
                    ->where(['compSrvKey' => $acompSrvKey])
                    ->get()->getResult();
                    
        return $records;    
    }

    function find_cust($acompAccKey)
    {
        $builder = $this->db->table('compcustres');
        $records = $builder
                    ->where(['compAccKey' => $acompAccKey])
		    ->where(['custResAttended > ' => '-1'])

                    ->get()->getResult();
                    
        return $records;    
    }

    

    

    function find_srv_dt($acompSrvKey, $acustResDt)
    {
        $tDate = date("Y-m-d");
        $builder = $this->db->table('compcustres');
        $records = $builder
                    ->where(['compSrvKey' => $acompSrvKey])
                    #->where(['custResDt >= ' => $tDate])
                    ->where(['custResDt < ' => $acustResDt])
                    ->get()->getResult();
                    
        return $records;    
    }

    function find_srv_sdt($acompSrvKey, $y_day, $t_day)
    {
        
        $builder = $this->db->table('compcustres');
        $records = $builder
                    ->where(['compSrvKey' => $acompSrvKey])
                    ->where(['custResDt > ' => $y_day])
                    ->where(['custResDt < ' => $t_day])
                    ->get()->getResult();
                    
        return $records;    
    }

    function find_whr_comp($acompKey)
    {
        $builder = $this->db->table('compcustres');
        $records = $builder
                    ->where(['compKey' => $acompKey])
		    ->where(['custResEval >' => '0'])

                    ->get()->getResult();
                    
        return $records;    
    }


    function insert_record($aCompKey, $aCompAccKey, $avstrNam, $aCompSrvKey, $aCustResDt, $aCustResAttended)
    {
        #`vstrNam``compDepKey
        $data = array(
            'compKey'           => $aCompKey,
            'compAccKey'        => $aCompAccKey,
            'vstrNam'           => $avstrNam,
            'compSrvKey'        => $aCompSrvKey,
            'custResDt'         => $aCustResDt,
            'custResAttended'   => $aCustResAttended,
        );
        
        $builder = $this->db->table('compcustres');
        $builder->insert($data); 
    }

    function update_record($avstrNam, $aCustResAttended, $aCustResID)
    {

        $data = array(
            'vstrNam'           => $avstrNam,
            'custResAttended'   => $aCustResAttended,
        );
        
        $builder = $this->db->table('compcustres');
        //$builder->where('id', $id);
        $builder
        ->where('custResID', $aCustResID)
        ->update($data); 
    }

    function update_rating($aCustResEval, $aCustResCmnt, $aCustResID)
    {

        $data = array(
            'custResEval'            => $aCustResEval ,
	    'custResCmnt'	     => $aCustResCmnt ,
        );
        
        $builder = $this->db->table('compcustres');
        $builder
        ->where('custResID', $aCustResID)
        ->update($data); 
    }


    function delete_record($aCustResID)
    {
        $builder = $this->db->table('compcustres');
        $builder
        ->where('custResID', $aCustResID)
        ->delete(); 
    }

     
}
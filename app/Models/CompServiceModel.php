<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;

class CompServiceModel
{
    protected $db;

    public function __construct(ConnectionInterface &$db)
    {
        $this->db =& $db; 
    }

    function find_all_servs($aCompKey)
    {
        $builder = $this->db->table('compservice');
        $records = $builder
                    ->where('compKey', $aCompKey)
                    ->get()->getResult();
                    
        return $records;       
    }

    function find_whr($srvId)
    {
        $builder = $this->db->table('compservice');
        $records = $builder
                    ->where('srvId', $srvId)
                    ->get()->getResult();
                    
        return $records;       
    }

    function find_whr_brnch($acmpSrvBrnch)
    {
        $builder = $this->db->table('compservice');
        $records = $builder
                    ->where('cmpSrvBrnch', $acmpSrvBrnch)
		    ->where('srvArc', 0)
                    ->get()->getResult();
                    
        return $records;       
    }

    function find_whr_brnch_nDep($acmpSrvBrnch, $acmpSrvDep)
    {
        $builder = $this->db->table('compservice');
        $records = $builder
                    ->where('cmpSrvBrnch', $acmpSrvBrnch)
		    ->where('depKey', $acmpSrvDep)
		    ->where('srvArc', 0)
                    ->get()->getResult();
                    
        return $records;       
    }


    function insert_record($aCompKey, $acmpSrvBrnch, $adepKey, $asrvName, $asrvPrice, $asrvPyUrl, $asrvBio, $asrvLstResDt)
    {
        
        $data = array( 
            'compKey'               => $aCompKey,
            'cmpSrvBrnch'           => $acmpSrvBrnch,
            'depKey'                => $adepKey,
            'srvName'               => $asrvName,
            'srvPrice'              => $asrvPrice,
            'srvPyUrl'              => $asrvPyUrl,
            'srvBio'                => $asrvBio,
            'srvLstResDt'           => $asrvLstResDt,
        );
        
        $builder = $this->db->table('compservice');
        $builder->insert($data); 
    }

    function update_nxt_wk( $asrvLstResDt, $srvId)
    {
        $data = array( 
            'srvLstResDt'           => $asrvLstResDt,
        );
        
        $builder = $this->db->table('compservice');
        $builder
        ->where('srvId', $srvId)
        ->update($data); 
    }

    function update_record($acmpSrvBrnch, $adepKey, $asrvName, $asrvPrice, $asrvPyUrl, $asrvBio, $asrvLstResDt, $srvId)
    {
        $data = array( 
            'cmpSrvBrnch'           => $acmpSrvBrnch,
            'depKey'                => $adepKey,
            'srvName'               => $asrvName,
            'srvPrice'              => $asrvPrice,
            'srvPyUrl'              => $asrvPyUrl,
            'srvBio'                => $asrvBio,
            'srvLstResDt'           => $asrvLstResDt,
        );
        
        $builder = $this->db->table('compservice');
        $builder
        ->where('srvId', $srvId)
        ->update($data); 
    }

    function update_archived($aSrvArc, $srvId)
    {
        $data = array( 
            'srvArc'           => $aSrvArc,
        );
        
        $builder = $this->db->table('compservice');
        $builder
        ->where('srvId', $srvId)
        ->update($data); 
    }

    function delete_record($srvId)
    {
        $builder = $this->db->table('compservice');
        $builder
        ->where('srvId', $srvId)
        ->delete(); 
    }

    function join_records($compkey)
    {
        $builder = $this->db->table('compservice');
        $builder
        ->join('compbranch', 'compbranch.branchID = compservice.cmpSrvBrnch')
        ->join('compdep', 'compdep.DepID = compservice.depKey');
        $query = $builder->get()->getResult();
        return $query;
    }
}
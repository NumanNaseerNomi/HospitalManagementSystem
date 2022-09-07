<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;

class CompWklySrvDdtModel
{
    protected $db;

    public function __construct(ConnectionInterface &$db)
    {
        $this->db =& $db; 
    }

    function find_whr($compSrvKey)
    {
        $builder = $this->db->table('compwklysrvdt');
          
        $records = $builder
                    ->where(['compSrvKey' => $compSrvKey])
                    ->get()->getResult();
        return $records;          
    }
    
    function find_whr_sdc($compSrvKey, $awklyDtCrd)
    {
        $builder = $this->db->table('compwklysrvdt');
          
        $records = $builder
                    ->where(['compSrvKey' => $compSrvKey])
		    ->where(['wklyDtCrd' => $awklyDtCrd])
		    
                    ->get()->getResult();
        return $records;          
    }

    function find_dst_sdc($compSrvKey)
    {
        
	
	$builder = $this->db->table('compwklysrvdt');

        $records = $builder
		    ->select(array('wklyDtCrd'))
		    ->where(['compSrvKey' => $compSrvKey])
	            ->groupBy('wklyDtCrd')
                    ->get()->getResult();
        return $records;          
    }

    function find_upcmng_wks($compSrvKey, $tDate)
    {
	$builder = $this->db->table('compwklysrvdt');
        $records = $builder
		    ->select(array('wklyDtCrd'))
		    ->where(['compSrvKey' => $compSrvKey])
		    ->where(['wklyDtCrd>= ' => $tDate])
		    ->groupBy('wklyDtCrd')
                    ->get()->getResult();
        return $records;          
    }




    function insert_record($awklyDtCrd, $aCompKey, $acompSrvKey, $asrvDtDay, 
                            $asrvDtPeriod, $asrvDtFrom, $asrvDtTo, 
                            $asrvDtDur, $asrvDtCloseBf, $asrvDtSmartView, 
                            $asrvDtIsActive)
    {
        $data = array( 
	    'wklyDtCrd'			=> $awklyDtCrd,
            'compKey'                   => $aCompKey,
            'compSrvKey'                => $acompSrvKey,
            'srvDtDay'                  => $asrvDtDay,
            'srvDtPeriod'               => $asrvDtPeriod,
            'srvDtFrom'                 => $asrvDtFrom,
            'srvDtTo'                   => $asrvDtTo,
            'srvDtDur'                  => $asrvDtDur,
            'srvDtCloseBf'              => $asrvDtCloseBf,
            'srvDtSmartView'            => $asrvDtSmartView,
            'srvDtIsActive'             => $asrvDtIsActive,
        );
        
        $builder = $this->db->table('compwklysrvdt');
        $builder->insert($data); 

    }

    function update_record( $asrvDtFrom, $asrvDtTo, 
                            $asrvDtDur, $asrvDtCloseBf, $asrvDtSmartView, 
                            $asrvDtIsActive, $aWklySrvDtId)
    {
        $data = array( 
            'srvDtFrom'                 => $asrvDtFrom,
            'srvDtTo'                   => $asrvDtTo,
            'srvDtDur'                  => $asrvDtDur,
            'srvDtCloseBf'              => $asrvDtCloseBf,
            'srvDtSmartView'            => $asrvDtSmartView,
            'srvDtIsActive'             => $asrvDtIsActive,
        );
        
        $builder = $this->db->table('compwklysrvdt');
        $builder
        ->where('wklySrvDtId', $aWklySrvDtId)
        ->update($data); 
    }

    function delete_record($aCompSrvKey)
    {
        $builder = $this->db->table('compwklysrvdt');
        $builder
        ->where('compSrvKey', $aCompSrvKey)
        ->delete(); 
    }

    
}
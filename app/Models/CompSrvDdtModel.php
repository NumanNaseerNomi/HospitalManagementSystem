<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;

class CompSrvDdtModel
{
    protected $db;

    public function __construct(ConnectionInterface &$db)
    {
        $this->db =& $db; 
    }

    function find_whr($compSrvKey)
    {
        #print("from acc model check user");
        //`dfdtId`, `compKey`, `dfdtday`, `dfdtperiod`, `dfdtfrom`, `dfdtto`, `dfdtduration`, `dfdtclosebefore`, `dfdtsmartview` 
        $builder = $this->db->table('compsrvdt');
          
        $records = $builder
                    #->where(['compKey' => $compkey])
                    ->where(['compSrvKey' => $compSrvKey])
                    ->get()->getResult();
                    
        
        return $records;

                
    }

    function insert_record($aCompKey, $acompSrvKey, $asrvDtDay, 
                            $asrvDtPeriod, $asrvDtFrom, $asrvDtTo, 
                            $asrvDtDur, $asrvDtCloseBf, $asrvDtSmartView, 
                            $asrvDtIsActive)
    {
        $data = array( 
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
        
        $builder = $this->db->table('compsrvdt');
        $builder->insert($data); 

    }

    function update_record( $asrvDtFrom, $asrvDtTo, 
                            $asrvDtDur, $asrvDtCloseBf, $asrvDtSmartView, 
                            $asrvDtIsActive, $aSrvDtId)
    {
        $data = array( 
            'srvDtFrom'                 => $asrvDtFrom,
            'srvDtTo'                   => $asrvDtTo,
            'srvDtDur'                  => $asrvDtDur,
            'srvDtCloseBf'              => $asrvDtCloseBf,
            'srvDtSmartView'            => $asrvDtSmartView,
            'srvDtIsActive'             => $asrvDtIsActive,
        );
        
        $builder = $this->db->table('compsrvdt');
        $builder
        ->where('SrvDtId', $aSrvDtId)
        ->update($data); 
    }

    function delete_record($aCompSrvKey)
    {
        $builder = $this->db->table('compsrvdt');
        $builder
        ->where('compSrvKey', $aCompSrvKey)
        ->delete(); 
    }

    
}
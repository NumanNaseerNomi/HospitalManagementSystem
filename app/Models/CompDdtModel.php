<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;

class CompDdtModel
{
    protected $db;

    public function __construct(ConnectionInterface &$db)
    {
        $this->db =& $db; 
    }

    function find_whr($compkey)
    {
        #print("from acc model check user");
        //`dfdtId`, `compKey`, `dfdtday`, `dfdtperiod`, `dfdtfrom`, `dfdtto`, `dfdtduration`, `dfdtclosebefore`, `dfdtsmartview` 
        $builder = $this->db->table('comdfdt');
          
        $records = $builder
                    ->where(['compKey' => $compkey])
                    ->get()->getResult();
                    
        
        return $records;

                
    }

    function insert_record($aCompKey, $adfdtday, $adfdtperiod, $adfdtfrom, $adfdtto, $adfdtduration, $adfdtclosebefore, $adfdtsmartview, $aisActive)
    {
        $data = array( 
            'compKey'               => $aCompKey,
            'dfdtday'               => $adfdtday,
            'dfdtperiod'            => $adfdtperiod,
            'dfdtfrom'              => $adfdtfrom,
            'dfdtto'                => $adfdtto,
            'dfdtduration'          => $adfdtduration,
            'dfdtclosebefore'       => $adfdtclosebefore,
            'dfdtsmartview'         => $adfdtsmartview,
            'isActive'              => $aisActive,
        );
        
        $builder = $this->db->table('comdfdt');
        $builder->insert($data); 
    }

    function update_record($adfdtday, $adfdtperiod, $adfdtfrom, $adfdtto, $adfdtduration, $adfdtclosebefore, $adfdtsmartview, $aisActive, $adfdtId)
    {
        $data = array( 
            'dfdtday'               => $adfdtday,
            'dfdtperiod'            => $adfdtperiod,
            'dfdtfrom'              => $adfdtfrom,
            'dfdtto'                => $adfdtto,
            'dfdtduration'          => $adfdtduration,
            'dfdtclosebefore'       => $adfdtclosebefore,
            'dfdtsmartview'         => $adfdtsmartview,
            'isActive'              => $aisActive,
        );
        
        $builder = $this->db->table('comdfdt');
        $builder
        ->where('dfdtId', $adfdtId)
        ->update($data); 
    }

    function delete_record($adfdtId)
    {
        $builder = $this->db->table('comdfdt');
        $builder
        ->where('dfdtId', $adfdtId)
        ->delete(); 
    }
}
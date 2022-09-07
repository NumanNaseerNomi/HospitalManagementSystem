<?php

namespace App\Models;

use CodeIgniter\Model;

class GenInfoModel extends Model
{
    protected $table      = 'compgeninfo';
    protected $primaryKey = 'compid';

    //protected $useAutoIncrement = true;

    //protected $returnType     = 'array';
    //protected $useSoftDeletes = true;

    protected $allowedFields = [ 'compPublicName',
     'compUrlShortName', 'compWhoRwe', 'compWorkingHrs',
      'compLocation', 'compPhoNumb', 'compWtzNumb',
       'compEmail', 'compSocialAcc', 'compLogo'];

    //protected $useTimestamps = false;
    //protected $createdField  = 'created_at';
    //protected $updatedField  = 'updated_at';
    //protected $deletedField  = 'deleted_at';

    //protected $validationRules    = [];
    //protected $validationMessages = [];
    //protected $skipValidation     = false;
}
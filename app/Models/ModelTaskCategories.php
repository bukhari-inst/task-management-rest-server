<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTaskCategories extends Model
{
    protected $table = 'task_categories';
    protected $primaryKey = 'id';

    // protected $useTimestamps = true;
    // protected $useSoftDeletes = true;
    // protected $returnType = 'object';

    protected $allowedFields = [
        'name'
    ];
}
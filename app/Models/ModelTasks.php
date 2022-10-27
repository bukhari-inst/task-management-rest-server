<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTasks extends Model
{
    protected $table = 'tasks';
    protected $primaryKey = 'id';

    // protected $useTimestamps = true;
    // protected $useSoftDeletes = true;
    // protected $returnType = 'object';

    protected $allowedFields = [
        'category_id', 'title', 'description', 'start_date', 'finish_date', 'status'
    ];
}
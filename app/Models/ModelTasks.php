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

    protected $validationRules = [
        'category_id' => 'required|integer',
        'title' => 'required|string',
        'description' => 'required|string',
        'start_date' => 'required|valid_date[Y-m-d]',
        'finish_date' => 'required|valid_date[Y-m-d]',
        'status' => 'required|in_list[New,On Progress, Finish]',
    ];

    protected $validationMessages = [
        'category_id' => [
            'required' => 'category_id harus disisi',
            'integer' => 'category_id harus berupa angka',
        ],
        'title' => [
            'required' => 'title harus disisi',
            'string' => 'title harus berupa huruf',
        ],
        'description' => [
            'required' => 'description harus disisi',
            'string' => 'description harus berupa huruf',
        ],
        'start_date' => [
            'required' => 'start_date harus disisi',
            'valid_date' => 'start_date tidak sesuai format: Y-m-d',
        ],
        'finish_date' => [
            'required' => 'finish_date harus disisi',
            'valid_date' => 'finish_date tidak sesuai format: Y-m-d',
        ],
        'status' => [
            'required' => 'status harus disisi',
            'in_list' => 'status tidak sesuai, hanya boleh disisi dengan: New,On Progress, Finish',
        ]
    ];
}
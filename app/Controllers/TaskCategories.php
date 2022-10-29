<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ModelTaskCategories;

class TaskCategories extends ResourceController
{
    use ResponseTrait;
    public function __construct()
    {
        $this->ModelTaskCategories = new ModelTaskCategories();
    }

    public function index()
    {
        $data = $this->ModelTaskCategories->orderBy('name', 'ASC')->findAll();
        return $this->respond($data, 200);
    }

    public function show($id = false)
    {
        $data = $this->ModelTaskCategories->find($id);
        if ($data) {
            return $this->respond($data, 200);
        } else {
            return $this->failNotFound("Data not found for id $id");
        }
    }

    public function create()
    {
        $data = [
            'name' => $this->request->getVar('name')
        ];
        // $data = $this->request->getJSON();
        if (!$this->ModelTaskCategories->save($data)) {
            return $this->fail($this->ModelTaskCategories->errors());
        }
        $response = [
            'status' => '201',
            'error' => 'null',
            'messages' => [
                'success' => 'Berhasil input data task categories'
            ]
        ];
        return $this->respond($response);
    }

    public function update($id = false)
    {
        $data = [
            'id' => $id,
            'name' => $this->request->getVar('name')
        ];

        $isDataExists = $this->ModelTaskCategories->find($id);
        if (!$isDataExists) {
            return $this->failNotFound("Data not found for id $id");
        }

        if (!$this->ModelTaskCategories->save($data)) {
            return $this->fail($this->ModelTaskCategories->errors());
        }
        $response = [
            'status' => '200',
            'error' => 'null',
            'messages' => [
                'success' => "Berhasil update data dengan id $id task categories"
            ]
        ];
        return $this->respond($response);
    }

    public function delete($id = false)
    {
        $isDataExists = $this->ModelTaskCategories->find($id);
        if (!$isDataExists) {
            return $this->failNotFound("Data not found for id $id");
        }
        $this->ModelTaskCategories->delete($id);
        $response = [
            'status' => '200',
            'error' => 'null',
            'messages' => [
                'success' => "Berhasil delete data dengan id $id task categories"
            ]
        ];
        return $this->respondDeleted($response);
    }
}
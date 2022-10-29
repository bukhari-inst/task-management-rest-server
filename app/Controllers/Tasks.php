<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ModelTasks;
use App\Models\ModelTaskCategories;

class Tasks extends ResourceController
{
    use ResponseTrait;
    public function __construct()
    {
        $this->ModelTasks = new ModelTasks();
        $this->ModelTaskCategories = new ModelTaskCategories();
    }

    public function index()
    {
        $data = $this->ModelTasks->orderBy('title', 'ASC')->findAll();
        return $this->respond($data, 200);
    }

    public function show($id = false)
    {
        $data = $this->ModelTasks->find($id);
        if ($data) {
            return $this->respond($data, 200);
        } else {
            return $this->failNotFound("Data tidak ditemukan untuk id $id");
        }
    }

    public function create()
    {
        $categoryId = $this->request->getVar('category_id');
        $isDataExists = $this->ModelTaskCategories->find($categoryId);
        if (!$isDataExists) {
            return $this->failNotFound("Data category_id $categoryId tidak ditemukan");
        }
        $data = [
            'category_id' => $categoryId,
            'title' => $this->request->getVar('title'),
            'description' => $this->request->getVar('description'),
            'start_date' => $this->request->getVar('start_date'),
            'finish_date' => $this->request->getVar('finish_date'),
            'status' => $this->request->getVar('status'),
        ];
        // $data = $this->request->getJSON();
        if (!$this->ModelTasks->save($data)) {
            return $this->fail($this->ModelTasks->errors());
        }
        $response = [
            'status' => '200',
            'error' => 'null',
            'messages' => [
                'success' => 'Berhasil input data tasks'
            ]
        ];
        return $this->respond($response);
    }

    public function update($id = false)
    {
        $isDataExists = $this->ModelTasks->find($id);
        if (!$isDataExists) {
            return $this->failNotFound("Data tidak ditemukan untuk id $id");
        }
        $categoryId = $this->request->getVar('category_id');
        $isDataExists = $this->ModelTaskCategories->find($categoryId);
        if (!$isDataExists) {
            return $this->failNotFound("Data category_id $categoryId tidak ditemukan");
        }

        $data = [
            'id' => $id,
            'category_id' => $categoryId,
            'title' => $this->request->getVar('title'),
            'description' => $this->request->getVar('description'),
            'start_date' => $this->request->getVar('start_date'),
            'finish_date' => $this->request->getVar('finish_date'),
            'status' => $this->request->getVar('status'),
        ];

        if (!$this->ModelTasks->save($data)) {
            return $this->fail($this->ModelTasks->errors());
        }
        $response = [
            'status' => '200',
            'error' => 'null',
            'messages' => [
                'success' => "Berhasil update data dengan id task $id"
            ]
        ];
        return $this->respond($response);
    }

    public function delete($id = false)
    {
        $isDataExists = $this->ModelTasks->find($id);
        if (!$isDataExists) {
            return $this->failNotFound("Data tidak ditemukan untuk id $id");
        }
        $this->ModelTasks->delete($id);
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
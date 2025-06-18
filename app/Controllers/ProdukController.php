<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class ProdukController extends ResourceController
{
    protected $modelName = 'App\Models\ProdukModel';
    protected $format    = 'json';

    public function index()
    {
        $data = $this->model->findAll();
        return $this->respond([
            'message' => 'success',
            'data' => $data
        ], 200);
    }
    public function show($id = null)
    {
        $produk = $this->model->find($id);
        if (!$produk) {
            return $this->failNotFound('Data Produk tidak ditemukan');
        }

        return $this->respond([
            'message' => 'success',
            'data' => $produk
        ], 200);
    }
    public function create()
    {
        $rules = [
            'kode_produk'  => 'required|string',
            'nama_produk' => 'required|string',
            'harga' => 'required|integer'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = $this->request->getJSON(true);
        $this->model->insert($data);

        return $this->respondCreated([
            'status' => 'success',
            'message' => 'Data Produk berhasil ditambahkan',
            'data' => $data
        ]);
    }
    public function update($id = null)
    {
        $produk = $this->model->find($id);
        if (!$produk) {
            return $this->failNotFound('Data Produk tidak ditemukan');
        }
        $data = $this->request->getJSON(true);
        $rules = [
            'kode_produk'  => 'required|string',
            'nama_produk' => 'required|string',
            'harga' => 'required|integer'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $this->model->update($id, $data);

        return $this->respond([
            'message' => 'Data Produk berhasil diupdate',
            'data' => $data
        ]);
    }
    public function delete($id = null)
    {
        $produk = $this->model->find($id);
        if (!$produk) {
            return $this->failNotFound('Data Produk tidak ditemukan');
        }

        $this->model->delete($id);
        return $this->respondDeleted([
            'message' => 'Data Produk berhasil dihapus'
        ]);
    }
}

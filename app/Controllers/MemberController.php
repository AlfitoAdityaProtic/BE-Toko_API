<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class MemberController extends ResourceController
{
    protected $modelName = 'App\Models\MemberModel';
    protected $format    = 'json';

    public function index()
    {
        $data = $this->model->findAll();
        return $this->respond([
            'status' => 'success',
            'message' => 'Selamat, Anda Berhasil Registrasi!!!',
            'data' => $data
        ], 200);
    }
    public function show($id = null)
    {
        $member = $this->model->find($id);
        if (!$member) {
            return $this->failNotFound('Data Member tidak ditemukan');
        }

        return $this->respond([
            'message' => 'success',
            'data' => $member
        ], 200);
    }
    public function create()
    {
        $rules = [
            'nama'  => 'required|string',
            'email' => 'required|valid_email',
            'password' => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = [
            'nama'     => $this->request->getVar('nama'),
            'email'    => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
        ];
        $this->model->insert($data);

        return $this->respond([
            'code' => 200,
            'status' => true,
            'message' => 'Selamat, Anda Berhasil Registrasi',
            'data' => $data
        ],200);
    }
    public function update($id = null)
    {
        $member = $this->model->find($id);
        if (!$member) {
            return $this->failNotFound('Data Member tidak ditemukan');
        }

        $rules = [
            'nama'  => 'required|string',
            'email' => 'required|valid_email',
            'password' => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = [
            'nama'     => $this->request->getVar('nama'),
            'email'    => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
        ];
        $this->model->update($id, $data);

        return $this->respond([
            'message' => 'Data Login berhasil diupdate',
            'data' => $data
        ]);
    }
    public function delete($id = null)
    {
        $member = $this->model->find($id);
        if (!$member) {
            return $this->failNotFound('Data member tidak ditemukan');
        }

        $this->model->delete($id);
        return $this->respondDeleted([
            'message' => 'Data member berhasil dihapus'
        ]);
    }
}

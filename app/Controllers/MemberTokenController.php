<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class MemberTokenController extends ResourceController
{
    protected $modelName = 'App\Models\MemberTokenModel';
    protected $format    = 'json';
    public function index()
    {
        $data = $this->model
            ->select('member_token.*, member.nama as nama_member')
            ->join('member', 'member_token.member_id = member.id')
            ->findAll();
        return $this->respond([
            'message' => 'success',
            'data' => $data
        ], 200);
    }
    public function show($id = null)
    {
        $memberToken = $this->model
            ->select('member_token.*, member.nama as nama_member')
            ->join('member', 'member_token.member_id = member.id')
            ->where('member_token.id', $id)
            ->first();
        if (!$memberToken) {
            return $this->failNotFound('Data Member Token tidak ditemukan');
        }

        return $this->respond([
            'message' => 'success',
            'data' => $memberToken
        ], 200);
    }
    public function create()
    {
        $rules = [
            'member_id'  => 'required',
            'auth_key' => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = [
            'member_id'     => $this->request->getVar('member_id'),
            'auth_key'    => $this->request->getVar('auth_key')
        ];
        $this->model->insert($data);

        return $this->respondCreated([
            'message' => 'Data Member Token berhasil ditambahkan',
            'data' => $data
        ]);
    }
    public function update($id = null)
    {
        $memberToken = $this->model->find($id);
        if (!$memberToken) {
            return $this->failNotFound('Data Member Token tidak ditemukan');
        }

        $rules = [
            'member_id'  => 'required',
            'auth_key' => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = [
            'member_id'     => $this->request->getVar('member_id'),
            'auth_key'    => $this->request->getVar('auth_key')
        ];
        $this->model->update($id, $data);

        return $this->respond([
            'message' => 'Data Member Token berhasil diupdate',
            'data' => $data
        ]);
    }
    public function delete($id = null)
    {
        $memberToken = $this->model->find($id);
        if (!$memberToken) {
            return $this->failNotFound('Data member tidak ditemukan');
        }

        $this->model->delete($id);
        return $this->respondDeleted([
            'message' => 'Data member berhasil dihapus'
        ]);
    }
}

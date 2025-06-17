<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class MemberTokenController extends ResourceController
{
    protected $modelName = 'App\Models\MemberTokenModel';
    protected $format    = 'json';
    public function login()
    {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $memberModel = new \App\Models\MemberModel();
        $member = $memberModel->where('email', $email)->first();

        if (!$member) {
            return $this->fail('Email tidak ditemukan', 400);
        }

        if (!password_verify($password, $member['password'])) {
            return $this->fail('Password salah', 400);
        }

        $auth_key = bin2hex(random_bytes(32));
        $this->model->insert([
            'member_id' => $member['id'],
            'auth_key' => $auth_key
        ]);

        return $this->respond([
            'status' => 'success',
            'status_code' => 200,
            'message' => 'Login berhasil',
            'token' => $auth_key,
            'data' => [
                'id' => $member['id'],
                'nama'=> $member['nama'],
                'email' => $member['email']
            ]
        ],200);
    }
}

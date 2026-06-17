<?php

require_once __DIR__ . '/../models/UserModel.php';

class AdminAccountController
{
    private $userModel;

    public function __construct($pdo)
    {
        $this->userModel = new UserModel($pdo);
    }

    // ================= LIST =================
    public function index()
    {
        $adminAccounts = $this->userModel->getAll();
        require __DIR__ . '/../Views/admin/accounts.php';
    }

    // ================= STORE =================
    public function store()
    {
        $this->userModel->insert($_POST);

        header("Location: ?pages=admin&section=accounts");
        exit;
    }

    // ================= UPDATE =================
    public function update($id)
    {
        $this->userModel->update($id, $_POST);

        header("Location: ?pages=admin&section=accounts");
        exit;
    }

    // ================= DELETE =================
    public function delete($id)
    {
        $this->userModel->delete($id);

        header("Location: ?pages=admin&section=accounts");
        exit;
    }

    // ================= LOCK / UNLOCK =================
    public function lock($id)
    {
        $this->userModel->toggleLock($id);

        header("Location: ?pages=admin&section=accounts");
        exit;
    }
}
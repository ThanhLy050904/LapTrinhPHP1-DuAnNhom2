<?php



class AdminAccountController
{
    private $userModel;

    public function __construct($pdo)
    {
        $this->userModel = new UserModel($pdo);
    }

    public function index()
    {
        $adminAccounts = $this->userModel->getAll();
        require __DIR__ . '/../Views/admin/accounts.php';
    }

    public function store()
    {
        $this->userModel->insert($_POST);

        header("Location: ?pages=admin&section=accounts");
        exit;
    }

    public function update($id)
    {
        $this->userModel->update($id, $_POST);

        header("Location: ?pages=admin&section=accounts");
        exit;
    }

    public function delete($id)
    {
        $this->userModel->delete($id);

        header("Location: ?pages=admin&section=accounts");
        exit;
    }


public function lock($id)
{
    $reasonText = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['custom_note']) && trim($_POST['custom_note']) !== '') {
        $reasonText = trim($_POST['custom_note']);
    } 
    elseif (isset($_GET['reason'])) {
        $reasonCode = $_GET['reason'];
        if ($reasonCode == '1') $reasonText = "Vi phạm điều khoản cộng đồng.";
        if ($reasonCode == '2') $reasonText = "Spam hoặc phát tán nội dung độc hại.";
        if ($reasonCode == '3') $reasonText = "Tài khoản có dấu hiệu bị xâm nhập trái phép.";
    }

    if (empty($reasonText)) {
        $reasonText = "Vi phạm chính sách bảo mật hoặc điều khoản hệ thống.";
    }

    $this->userModel->lockUser($id, $reasonText);

    header("Location: ?pages=admin&section=accounts");
    exit;
}

public function unlock($id)
{
    $this->userModel->unlockUser($id);

    header("Location: ?pages=admin&section=accounts");
    exit;
}
}
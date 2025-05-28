<?php

use models\User;

header('Content-Type: application/json; charset=UTF-8');
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/models/User.php';

try {
    $userModel = new User();
    $users = $userModel->getUsers(); // 메소드명 오타 수정
    echo json_encode(['users' => $users], JSON_UNESCAPED_UNICODE); // 한글 옵션 추가
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()], JSON_UNESCAPED_UNICODE);
} finally {
    if (isset($userModel)) $userModel->close();
}
?>

<?php

namespace models;

use src\config\database;

require_once __DIR__ . '/../config/database.php';

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new database();
    }

    public function getUsers()
    {
        return $this->db->executeMultiple("SELECT name FROM member");
    }

    public function insertUser() {
        // 1. JSON 데이터 받기
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);


        // 3. 데이터 가공
        $user = [];
        foreach ($data as $key => $value) {
            $$key = $value; // 변수 변수 사용

            // password 키일 경우 비밀번호 해시 처리 (bcrypt)
            if ($key === 'password') {
                $user[$key] = password_hash($value, PASSWORD_DEFAULT);
            } else {
                $user[$key] = $value;
            }
        }

        // 4. INSERT 쿼리 실행
        return $this->db->executeSingle(
            "INSERT INTO member (user_id, password, name, nickname, birthday, email, profile_img, provider, provider_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)",
            $user,
            "issssssss"
        );
    }


    public function close()
    {
        $this->db->close();
    }
}

?>

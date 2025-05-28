<?php
echo <<<HTML
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>자동 생성 파일</title>
    <style>
        body {
            background: #f7fafd;
            font-family: 'Pretendard', 'Noto Sans KR', Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .box {
            background: #fff;
            padding: 2.5rem 2.5rem 2rem 2.5rem;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.07);
            text-align: center;
            max-width: 400px;
        }
        h2 {
            color: #38a3f1;
            margin-bottom: 1.2rem;
        }
        p {
            color: #222;
            font-size: 1.15rem;
        }
        .filename {
            color: #666;
            font-size: 1rem;
            margin-top: 1.5rem;
            word-break: break-all;
        }
        .btn-group {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 2.2rem;
        }
        .btn-home, .btn-main {
            background: #38a3f1;
            color: #fff;
            border: none;
            padding: 0.9rem 2.5rem;
            border-radius: 8px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-home:hover, .btn-main:hover {
            background: #1d7fc2;
        }
        .btn-main {
            background: #bbb;
            color: #222;
        }
        .btn-main:hover {
            background: #888;
        }
    </style>
</head>
<body>
    <div class="box">
        <h2>자동으로 페이지가 생성되었습니다.</h2>
        <p>현재 페이지는 요청에 의해 새로 만들어졌습니다.</p>
        <div class="filename">파일명: <b>{$id}.php</b></div>
        <div class="btn-group">
            <button class="btn-home" onclick="window.location.replace('/content/{$id}')">해당페이지로 이동</button>
            <button class="btn-main" onclick="window.location.replace('/')">메인으로 가기</button>
        </div>
    </div>
</body>
</html>
HTML;
?>

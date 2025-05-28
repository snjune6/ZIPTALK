<?php
// template.php
$id = isset($template_id) ? $template_id : '';
?>
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
        .card {
            background: #fff;
            padding: 2.5rem 2.5rem 2rem 2.5rem;
            border-radius: 18px;
            box-shadow: 0 4px 32px rgba(56,163,241,0.12), 0 1.5px 6px rgba(0,0,0,0.05);
            text-align: center;
            max-width: 420px;
        }
        h2 {
            color: #38a3f1;
            margin-bottom: 1.2rem;
            letter-spacing: -1px;
            font-size: 1.7rem;
        }
        p {
            color: #222;
            font-size: 1.13rem;
            margin: 0.7rem 0;
        }
        .filename {
            color: #666;
            font-size: 1.07rem;
            margin-top: 1.5rem;
            word-break: break-all;
            background: #f0f6fa;
            padding: 0.7rem 1rem;
            border-radius: 7px;
            display: inline-block;
        }
        .created {
            color: #888;
            font-size: 0.98rem;
            margin-top: 1.3rem;
            letter-spacing: 0.5px;
        }
        .icon {
            font-size: 2.7rem;
            margin-bottom: 0.8rem;
            color: #38a3f1;
            display: block;
        }
    </style>
</head>
<body>
<div class="card">
    <span class="icon">🚀</span>
    <h2>자동으로 페이지가 생성되었습니다!</h2>
    <p>요청하신 페이지가 새롭게 만들어졌습니다.</p>
    <div class="filename">파일명: <b><?= htmlspecialchars($id) ?>.php</b></div>
    <div class="created">생성 일시: <?= date('Y-m-d H:i:s') ?></div>
</div>
</body>
</html>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>파일 없음</title>
    <style>
        body {
            background: #f7f7f7;
            font-family: 'Pretendard', 'Noto Sans KR', Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: #fff;
            padding: 2.5rem 2rem 2rem 2rem;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.07);
            text-align: center;
            max-width: 350px;
        }
        h2 {
            color: #222;
            margin-bottom: 1rem;
        }
        p {
            color: #666;
            margin-bottom: 2rem;
        }
        .btn-group {
            display: flex;
            justify-content: center;
            gap: 1rem;
        }
        button {
            background: #38a3f1;
            color: #fff;
            border: none;
            padding: 0.8rem 2.2rem;
            border-radius: 8px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background 0.2s;
        }
        button.cancel {
            background: #ddd;
            color: #333;
        }
        button.cancel:hover {
            background: #bbb;
        }
        button:hover:not(.cancel) {
            background: #1d7fc2;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>해당 콘텐츠가 존재하지 않습니다.</h2>
    <div class="btn-group">
        <button class="cancel" onclick="window.location.replace('/')">확인</button>
    </div>
</div>
</body>
</html>

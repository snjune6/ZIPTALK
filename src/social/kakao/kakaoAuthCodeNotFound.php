<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>인가 코드가 없습니다</title>
    <style>
        body {
            background: #f6fafd;
            margin: 0;
            font-family: 'Noto Sans KR', Arial, sans-serif;
        }
        .center-box {
            max-width: 400px;
            margin: 100px auto;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 24px rgba(30, 60, 90, 0.07);
            padding: 40px 28px 32px 28px;
            text-align: center;
        }
        .icon {
            font-size: 48px;
            margin-bottom: 18px;
            display: inline-block;
        }
        .main-msg {
            font-size: 1.3em;
            font-weight: 700;
            color: #2196f3;
            margin-bottom: 12px;
        }
        .desc {
            color: #444;
            font-size: 1.08em;
            margin-bottom: 22px;
        }
        .error-detail {
            background: #f3f6f9;
            border-radius: 7px;
            display: inline-block;
            padding: 10px 16px;
            margin-bottom: 18px;
            color: #b71c1c;
            font-size: 0.98em;
            word-break: break-all;
        }
        .btn {
            background: #fae100;
            color: #181600;
            border: none;
            border-radius: 5px;
            padding: 12px 30px;
            font-size: 1em;
            font-weight: bold;
            margin-top: 18px;
            cursor: pointer;
            transition: background 0.18s;
            box-shadow: 0 1px 3px rgba(30, 60, 90, 0.05);
        }
        .btn:hover {
            background: #ffe033;
        }
        .info {
            margin-top: 18px;
            color: #888;
            font-size: 0.97em;
        }
        @media (max-width: 500px) {
            .center-box {
                margin: 40px 8px;
                padding: 28px 6vw 20px 6vw;
            }
        }
    </style>
</head>
<body>
<div class="center-box">
    <div class="icon">🚀</div>
    <div class="main-msg">인가 코드가 없습니다!</div>
    <div class="desc">
        카카오 인증 과정에서 인가 코드가 전달되지 않았습니다.<br>
        다시 시도해 주세요.
    </div>
    <div class="error-detail">
        오류 코드: <strong>KOE320</strong><br>
        오류 설명: authorization code not found
    </div>
    <button class="btn" onclick="goHome()">홈으로 돌아가기</button>
    <div class="info">
        발생 일시: 2025-05-15 00:27:00
    </div>
</div>
<script>
    function goHome() {
        location.replace('/');
    }
</script>
</body>
</html>

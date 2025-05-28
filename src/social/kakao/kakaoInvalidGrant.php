<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>액세스 토큰 발급 실패</title>
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
            font-size: 1.35em;
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
            background: #f5f7fa;
            border-radius: 7px;
            display: inline-block;
            padding: 12px 16px;
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
    <div class="main-msg">액세스 토큰 발급에 실패했습니다</div>
    <div class="desc">
        카카오 인증 과정에서 문제가 발생했습니다.<br>
        아래의 오류 내용을 확인해주세요.
    </div>
    <div class="error-detail">
        <strong>오류 코드:</strong> KOE320<br>
        <strong>오류 설명:</strong> authorization code not found<br>
        <strong>에러:</strong> invalid_grant
    </div>
    <button class="btn" onclick="goHome()">홈으로 돌아가기</button>
</div>
<script>
    function goHome() {
        location.replace('/');
    }
</script>
</body>
</html>

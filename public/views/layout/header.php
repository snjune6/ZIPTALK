<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="HandheldFriendly" content="true">
    <meta name="MobileOptimized" content="320">
    <meta http-equiv="cleartype" content="on">
    <title><?php if (isset($siteData)) echo $siteData['site_title']; ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- bxSlider CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.17/jquery.bxslider.min.css" rel="stylesheet" />
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <style>
        /* ... (기존 스타일 그대로) ... */
        html, body { margin: 0; padding: 0; overflow-x: hidden; }
        body { padding-top: 56px; }
        .navbar.transparent-navbar { background: rgba(33,37,41,0.7) !important; transition: background 0.3s, transform 0.3s; }
        .navbar .nav-link, .navbar .navbar-brand { color: #fff !important; text-shadow: 0 1px 2px rgba(0,0,0,0.15); transition: color 0.2s; margin: 0 20px; }
        .navbar .nav-link.active { font-weight: bold; text-decoration: underline; }
        .navbar.hide-navbar { transform: translateY(-100%); }
        .container-fluid, .bx-wrapper, .bx-viewport, .bxslider, .bxslider li { padding: 0 !important; margin: 0 !important; }
        .bxslider img { width: 100%; height: 400px; object-fit: cover; border-radius: 0; display: block; }
        .bx-wrapper { box-shadow: none !important; border: none !important; background: none !important; }
        .card { border: none; border-radius: 12px; }
        .card-title { color: #0d6efd; }
        footer { margin-top: 60px; }
        .fullwidth-section { width: 100%; background: #f8f9fa; padding-left: 0; padding-right: 0; }
        .scroll-to-top { position: fixed; bottom: 32px; right: 32px; width: 52px; height: 52px; background: linear-gradient(135deg, #343a40 60%, #495057 100%); color: #fff; border: none; border-radius: 10%; cursor: pointer; opacity: 0; transform: translateY(25px) scale(0.8); transition: all 0.35s cubic-bezier(.4,2,.3,1); z-index: 1000; display: flex; align-items: center; justify-content: center; font-size: 28px; box-shadow: 0 4px 20px rgba(0,0,0,0.18); pointer-events: none; }
        .scroll-to-top.show { opacity: 1; transform: translateY(0) scale(1); pointer-events: auto; }
        .scroll-to-top.transparent { opacity: 0.4; pointer-events: none; }
        .scroll-to-top:hover { background: linear-gradient(135deg, #212529 70%, #343a40 100%); color: #ffe066; box-shadow: 0 8px 32px rgba(0,0,0,0.28); }
        .scroll-to-top .fa-arrow-up { animation: bounceUp 1.2s infinite alternate; }
        @keyframes bounceUp { from { transform: translateY(2px);} to   { transform: translateY(-8px);} }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <div id="app">{{ message }}</div>
    <!-- 상단 네비게이션 바 -->
    <nav class="navbar navbar-expand-lg fixed-top transparent-navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="/"><?php if (isset($siteData)) echo $siteData['site_name']; ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="네비게이션 열기">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <?php

                // 메뉴 출력
                echo '<ul class="navbar-nav ms-auto">';
                if (isset($siteData)) {
                    foreach ($siteData['menu'] as $item) {
                        $activeClass = isset($item['class']) ? ' ' . $item['class'] : '';
                        $ariaCurrent = isset($item['aria-current']) ? ' aria-current="' . $item['aria-current'] . '"' : '';
                        $idAttr = isset($item['id']) ? ' id="' . $item['id'] . '"' : '';

                        echo '<li class="nav-item">';
                        echo '<a class="nav-link' . $activeClass . '"' . $ariaCurrent . ' href="' . $item['url'] . '"' . $idAttr . '>' . $item['title'] . '</a>';
                        echo '</li>';
                    }
                }
                echo '</ul>';

                ?>
            </div>
        </div>
    </nav>

    <!-- 로그인 레이어 팝업 (Bootstrap Modal) -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">로그인</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="닫기"></button>
                </div>
                <div class="modal-body">
                    <!-- 카카오 로그인 버튼 -->
                    <button id="kakao-login-btn" class="btn btn-warning w-100" style="background:#fee500; border:none;">
                        <img src="//k.kakaocdn.net/14/dn/btroDszwNrM/I6efHub1SN5KCJqLm1Ovx1/o.jpg" alt="카카오 로그인" style="height:32px;vertical-align:middle;">
                        <span style="vertical-align:middle;font-weight:bold;color:#3c1e1e;">카카오로 로그인</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
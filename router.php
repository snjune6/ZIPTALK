<?php

use src\classes\Layout;

define("SITE_ADMIN", "USER");

// 정적 파일 처리 (JS, CSS, 이미지)
if (preg_match('/\.(?:js|css|png|jpg|jpeg|gif)$/', $_SERVER["REQUEST_URI"])) {
    $file = __DIR__ . '/public' . $_SERVER["REQUEST_URI"];
    if (file_exists($file)) {
        return readfile($file);
    }
    http_response_code(404);
    echo "404 Not Found";
    return;
}

require 'vendor/autoload.php'; // Composer 오토로더

$router = new AltoRouter();

// (필요시) 베이스 경로 설정. 서브디렉토리라면 '/JIBTALK/public' 등으로 지정
$router->setBasePath('');

$siteData = [
    'site_name' => 'JIBTALK', // 홈페이지명
    'site_title' => 'Welcome to JIBTALK', // 사이트 타이틀명
    'menu' => [
        [
            'title' => 'content/about',
            'url' => '/content/about',
            'class' => 'active',
            'aria-current' => 'page'
        ],
        [
            'title' => 'about',
            'url' => '/about',
            'class' => '',
            'aria-current' => 'page'
        ],
        [
            'title' => 'contact',
            'class' => '',
            'url' => '/contact'
        ],
        [
            'title' => 'user',
            'class' => '',
            'url' => '/user/1'
        ],
        [
            'title' => '로그인',
            'url' => '#',
            'class' => '',
            'id' => 'loginBtn'
        ]
    ]
];

// 프론트엔드 라우트
$router->map('GET', '/', function() use ($siteData) {

    $layout = new Layout();
    $layout->setHeader(__DIR__ . '/public/views/layout/header.php');
    $layout->setFooter(__DIR__ . '/public/views/layout/footer.php');
    $layout->setSiteData($siteData);

    $layout->render(__DIR__ . '/public/index.php');
});

$router->map('GET', '/about', function() use ($siteData) {

    $layout = new Layout();
    $layout->setHeader(__DIR__ . '/public/views/layout/header.php');
    $layout->setFooter(__DIR__ . '/public/views/layout/footer.php');
    $layout->setSiteData($siteData);

    $layout->render(__DIR__ . '/public/views/about.php');

});

$router->map('GET', '/contact', function() use ($siteData) {

    $layout = new Layout();
    $layout->setHeader(__DIR__ . '/public/views/layout/header.php');
    $layout->setFooter(__DIR__ . '/public/views/layout/footer.php');
    $layout->setSiteData($siteData);

    $layout->render(__DIR__ . '/public/views/contact.php');
});

// 동적 파라미터 예시: /user/숫자
$router->map('GET', '/user/[i:id]', function($id) use ($siteData) {

    $layout = new Layout();
    $layout->setHeader(__DIR__ . '/public/views/layout/header.php');
    $layout->setFooter(__DIR__ . '/public/views/layout/footer.php');
    $layout->setSiteData($siteData);

    $layout->render(__DIR__ . '/public/views/user.php');
});

// setting 하위 콘텐츠
$router->map('GET', '/content/setting/[*:id]', function($id) {
    $file = __DIR__ . '/public/views/content/' . $id . '.php';

    if (file_exists($file)) {
        // 파일이 존재하면 /content/$id로 리다이렉트
        header('Location: /content/' . urlencode($id));
        exit;
    } else {
        if (SITE_ADMIN == 'ADMIN') {
            $template_path = __DIR__ . '/public/views/content/new_file_template.php'; // 템플릿 파일 경로

            if (!file_exists($template_path)) {
                die("템플릿 파일이 존재하지 않습니다.");
            }

            // 1. 출력 버퍼링 시작
            ob_start();

            // 2. 템플릿에 변수 전달 (템플릿에서 $id 사용 가능)
            $template_id = $id;
            include $template_path;

            // 3. 버퍼 내용 가져오기
            $content = ob_get_clean();

            // 4. 파일 생성
            // 파일이 존재하지 않으면 새 파일 생성
            $handle = fopen($file, 'w');
            if ($handle) {
                fwrite($handle, $content);
                fclose($handle);
                // 생성 후 /content/$id로 리다이렉트
                require __DIR__ . '/public/views/content/new_file.php';
                //header('Location: /content/' . urlencode($id));
                exit;
            } else {
                // 파일 생성 실패 시 에러 처리
                echo "파일을 생성할 수 없습니다.";
            }
        } else {
            echo '관리자만 접근 가능합니다.';
            exit;
        }
    }
});

// 컨텐츠 페이지
$router->map('GET', '/content/[*:id]', function($id) {

    $file = __DIR__ . '/public/views/content/' . $id . '.php';

    if (file_exists($file)) {
        require $file;
    } else {
        // 관리자 체크 후 관리자라면 파일 생성 페이지로 이동
        // 관리자가 아니면 404페이지
        if (SITE_ADMIN == 'ADMIN') {
            require __DIR__ . '/public/views/content/404_admin.php';
        } else {
            require __DIR__ . '/public/views/content/404_user.php';
        }
    }
});

// API 라우트 (src/api/ 내부 파일 연결)
$router->map('GET', '/oauth/[*:social]', function($social) {
    switch ($social) {
        case 'kakao':
            require __DIR__ . '/src/social/kakao/kakaoCallback.php';
            break;
        // 다른 소셜 로그인 케이스 추가 가능
        // case 'facebook':
        //     require __DIR__ . '/src/social/facebookCallback.php';
        //     break;
        // case 'github':
        //     require __DIR__ . '/src/social/githubCallback.php';
        //     break;
        default:
            // 지원하지 않는 소셜 로그인 요청에 대한 처리
            http_response_code(400);
            echo '지원하지 않는 소셜 로그인입니다.';
            break;
    }
});

// API 라우트 (src/api/ 내부 파일 연결)
$router->map('GET', '/api/[*:endpoint]', function($endpoint) {
    $apiFile = __DIR__ . '/src/api/get/' . $endpoint . '.php';
    if (file_exists($apiFile)) {
        require $apiFile;
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'API endpoint not found']);
    }
});

$router->map('POST', '/api/[*:endpoint]', function($endpoint) {
    $apiFile = __DIR__ . '/src/api/post/' . $endpoint . '.php';
    if (file_exists($apiFile)) {
        require $apiFile;
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'API endpoint not found']);
    }
});

// 요청 매칭 및 실행
$match = $router->match();

if ($match && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    // 404 에러 처리
    header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    require __DIR__ . '/public/views/content/404_user.php';
}

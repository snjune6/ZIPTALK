 <?php

 use models\User;

// 1. 인가 코드 받기
if (isset($_GET['code'])) {
    $provider = 'kakao';

    $code = $_GET['code'];
    $rest_api_key = '747a92b061c4a51356d489744dc927d5';
    $redirect_uri = 'http://snjune6.dothome.co.kr/oauth/kakao';

    // 2. 액세스 토큰 요청
    $url = "https://kauth.kakao.com/oauth/token";
    $post_data = [
        'grant_type' => 'authorization_code',
        'client_id' => $rest_api_key,
        'redirect_uri' => $redirect_uri,
        'code' => $code
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

    $response = curl_exec($ch);
    if ($response === false) {
        echo 'cURL Error: ' . curl_error($ch);
        exit;
    }
    curl_close($ch);

    $token = json_decode($response, true);

    // 3. 사용자 정보 요청
    if(isset($token['access_token'])) {
        $access_token = $token['access_token'];
        $user_url = "https://kapi.kakao.com/v2/user/me";

        $user_ch = curl_init();
        curl_setopt($user_ch, CURLOPT_URL, $user_url);
        curl_setopt($user_ch, CURLOPT_HTTPGET, true);
        curl_setopt($user_ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer " . $access_token,
            "Content-Type: application/x-www-form-urlencoded;charset=utf-8"
        ]);
        curl_setopt($user_ch, CURLOPT_RETURNTRANSFER, true);

        $user_response = curl_exec($user_ch);
        if($user_response === false) {
            echo '사용자 정보 요청 실패: ' . curl_error($user_ch);
            exit;
        }
        curl_close($user_ch);

        $user_info = json_decode($user_response, true);

        // id갑이 있는지 확인하고
        if ( $user_info['id']  > 0) {
            echo "1";
        } else {
            echo "0";
        }

        require_once __DIR__ . '/../../models/User.php';
        // 데이터베이스에서 가입된 id가 존재하는지 확인하고
        $userModel = new models\User();
        $users = $userModel->getUsers();
        var_dump($users);
        // 있으면 로그인처리

        // 없으면 가입처리

        
        //가입되지 않았다면 회원가입 폼으로
        include $_SERVER['DOCUMENT_ROOT'] . '/public/views/account/join.php';
    } else {
        include  __DIR__ . '/kakaoInvalidGrant.php';
    }
} else {
    include  __DIR__ . '/kakaoAuthCodeNotFound.php';
}
?>

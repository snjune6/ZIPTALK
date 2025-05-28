<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="HandheldFriendly" content="true">
    <meta name="MobileOptimized" content="320">
    <meta http-equiv="cleartype" content="on">
    <title>회원가입</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            /*height: 100vh;*/
        }
        .signup-container {
            background: #fff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            /*width: 350px;*/
        }
        .signup-container h2 {
            text-align: center;
            margin-bottom: 24px;
        }
        .profile-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }
        .profile-section img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #eee;
            margin-bottom: 10px;
        }
        .profile-section .nickname {
            font-weight: bold;
            font-size: 1.1em;
            margin-bottom: 5px;
        }
        .signup-container label {
            display: block;
            margin-bottom: 8px;
            margin-top: 16px;
        }
        .signup-container input[type="text"],
        .signup-container input[type="email"],
        .signup-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 4px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        /*.signup-container button {
            width: 100%;
            padding: 12px;
            background: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            margin-top: 24px;
            font-size: 16px;
            cursor: pointer;
        }*/
        /*.signup-container button:hover {
            background: #43a047;
        }*/
        #alert-area .alert {
            width: 100%;
            margin: 0 0 16px 0;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <h2>회원가입</h2>
        <form id="join_form">
            <div id="alert-area"></div>
            <div class="profile-section">
                <img src="<?php echo htmlspecialchars($user_info['properties']['profile_image']); ?>"
                     alt="프로필 이미지">
                <div class="nickname">
                    <?php echo htmlspecialchars($user_info['properties']['nickname']); ?>
                </div>
            </div>

            <input type="hidden" name="provider" :value="provider">
            <input type="hidden" name="provider_id" :value="provider_id">
            <input type="hidden" name="profile_img" :value="profile_img">

            <label for="user_id">아이디</label>
            <input type="text" id="user_id" name="user_id" v-model="user_id" readonly required>

            <label for="name">이름</label>
            <input type="text" id="name" name="name" v-model="name" @change="handleChange" required>

            <label for="nickname">닉네임</label>
            <input type="text" id="nickname" name="nickname" v-model="nickname" required>

            <label for="birthday">생년월일</label>
            <input type="text" id="birthday" name="birthday" v-model="birthday" required>

            <label for="email">이메일</label>
            <input type="email" id="email" name="email" v-model="email" required>

            <label for="password">비밀번호</label>
            <input type="password" id="password" name="password" v-model="password" required>

            <label for="confirm-password">비밀번호 확인</label>
            <input type="password" id="confirm_password" name="confirm_password" v-model="confirm_password" required>


            <button type="submit" class="btn btn-primary mt-3">회원가입</button>
        </form>

    </div>

    <script type="module">
        import { createApp, ref, watch } from 'https://unpkg.com/vue@3/dist/vue.esm-browser.js'

        createApp({
            setup() {
                // PHP에서 JS로 값 전달 (예시, 실제로는 서버에서 렌더링 시 스크립트로 값 할당)
                const profile_img = ref("<?php echo htmlspecialchars($user_info['properties']['profile_image']); ?>");
                const provider = ref("<?php echo $provider; ?>");
                const provider_id = ref("<?php echo htmlspecialchars($user_info['id']); ?>");
                const user_id = ref("<?php echo htmlspecialchars($user_info['id']); ?>");
                const name = ref("");
                const nickname = ref("<?php echo htmlspecialchars($user_info['properties']['nickname']); ?>");
                const birthday = ref("");
                const email = ref("");
                const password = ref("");
                const confirm_password = ref("");

                const prevName = ref('');

                const form = {
                    profile_img,
                    provider,
                    provider_id,
                    user_id,
                    name,
                    nickname,
                    birthday,
                    email,
                    password,
                    confirm_password,
                };

                function handleChange(event) {
                    // event.target.value: 변경된 값
                    // prevName.value: 이전 값
                    console.log('이전값:', prevName.value);
                    console.log('변경값:', event.target.value);
                    prevName.value = event.target.value; // 이전값 갱신
                }

                // name이 변경될 때마다 실행
                watch(name, (newValue, oldValue) => {
                    console.log('이전값:', oldValue);
                    console.log('변경값:', newValue);
                });

                return {
                    name, handleChange,
                    ...form
                }
            }
        }).mount('#join_form')
    </script>
    <!-- user 테이블 인덱스 조회 예시 함수 -->
    <script>
        function showBootstrapAlert(message, type = 'danger') {
            const alertArea = document.getElementById('alert-area');
            alertArea.innerHTML = `
                <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
        }


        document.querySelector('form').addEventListener('submit', async function(event) {
            event.preventDefault(); // 폼의 기본 제출(새로고침) 방지

            // 폼 데이터 수집
            const form = event.target;

            const user_id = form.user_id.value;
            const name = form.name.value;
            const nickname = form.nickname.value;
            const birthday = form.birthday.value;
            const email = form.email.value;
            const profile_img = form.profile_img.value;
            const password = form.password.value;
            const confirmPassword = form.confirm_password.value;
            const provider = form.provider.value;
            const provider_id = form.provider_id.value;

            // 비밀번호 확인 검사
            if (password !== confirmPassword) {
                showBootstrapAlert('비밀번호와 비밀번호 확인이 일치하지 않습니다.');
                return;
            }

            // 서버로 보낼 데이터 객체 생성
            const userData = {
                user_id,
                password,
                name,
                nickname,
                birthday,
                email,
                profile_img,
                provider,
                provider_id
            };

            try {
                const response = await fetch('http://snjune6.dothome.co.kr/api/users', { // 실제 API 주소로 변경
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(userData)
                });

                if (!response.ok) {
                    throw new Error(`서버 응답 오류: ${response.status}`);
                }

                const result = await response.json();
                alert('회원가입이 완료되었습니다!');
                // window.location.href = '/login'; // 필요시 이동
            } catch (error) {
                console.error('회원가입 중 오류:', error);
                alert('회원가입 중 오류가 발생했습니다. 다시 시도해주세요.');
            }
        });
    </script>

</body>
</html>

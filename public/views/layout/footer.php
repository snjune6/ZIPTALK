

<!-- 푸터 -->
<footer class="bg-dark text-white text-center py-4 mt-5 fullwidth-section" style="background:#212529 !important;">
    <div class="container">
        <p class="mb-1">&copy; 2025 JIBTALK. All rights reserved.</p>
        <small>Contact: info@jibtalk.com</small>
    </div>
</footer>

<!-- 스크롤 업 버튼 -->
<button id="scrollToTopBtn" class="scroll-to-top transparent" aria-label="최상단으로">
    <i class="fa-solid fa-arrow-up"></i>
</button>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- bxSlider JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.17/jquery.bxslider.min.js"></script>

<script type="module">
    import { createApp, ref } from 'https://unpkg.com/vue@3/dist/vue.esm-browser.js'

    createApp({
        setup() {
            const message = ref('Hello vue!')
            return {
                message
            }
        }
    }).mount('#app')
</script>

<!-- bxSlider 초기화 -->
<script>
    $(document).ready(function(){
        $('.bxslider').bxSlider({
            mode: 'fade',
            auto: true,
            pause: 4000,
            controls: true,
            pager: true,
            responsive: true
        });
    });
</script>

<!-- 네비게이션 스크롤 숨김/표시 -->
<script>
    (function() {
        var lastScroll = 0;
        var $navbar = $('.navbar');
        $(window).on('scroll', function() {
            var st = $(this).scrollTop();
            if (st > 10 && st > lastScroll) {
                $navbar.addClass('hide-navbar');
            } else if (st <= 10) {
                $navbar.removeClass('hide-navbar');
            } else if (st < lastScroll) {
                $navbar.removeClass('hide-navbar');
            }
            lastScroll = st;
        });
    })();
</script>

<!-- 스크롤 업 버튼 기능 -->
<script>
    const scrollToTopBtn = document.getElementById('scrollToTopBtn');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 20) {
            scrollToTopBtn.classList.add('show');
            if(window.scrollY > 100) {
                scrollToTopBtn.classList.remove('transparent');
            } else {
                scrollToTopBtn.classList.add('transparent');
            }
        } else {
            scrollToTopBtn.classList.remove('show');
            scrollToTopBtn.classList.add('transparent');
        }
    });
    scrollToTopBtn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
</script>

<!-- user 테이블 인덱스 조회 예시 함수 -->
<script>
    async function getuUsers() {
        const url = "http://snjune6.dothome.co.kr/api/users";
        try {
            const response = await fetch(url);
            if (!response.ok) {
                throw new Error(`Network response was not ok (status: ${response.status})`);
            }
            const data = await response.json();
            return data;
        } catch (error) {
            console.error("Error fetching users:", error);
            return null;
        }
    }
</script>

<script>

    // 로그인 버튼 클릭 시 모달 열기
    document.getElementById('loginBtn').addEventListener('click', function(e) {
        e.preventDefault();
        var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
        loginModal.show();
    });

    // 카카오 로그인 버튼 클릭 시
    document.getElementById('kakao-login-btn').addEventListener('click', function() {
        // 카카오 인증 URL로 페이지 이동
        window.location.href = 'https://kauth.kakao.com/oauth/authorize?response_type=code&client_id=747a92b061c4a51356d489744dc927d5&redirect_uri=http://snjune6.dothome.co.kr/oauth/kakao';
    });
</script>
</body>
</html>
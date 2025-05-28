function fetchUsers() {
    fetch('/api/users.php')
        .then(response => response.json())
        .then(data => {
            const resultDiv = document.getElementById('result');

            // 에러 처리
            if (data.error) {
                resultDiv.innerHTML = `<b style="color:red;">${data.error}</b>`;
                return;
            }

            // 표 생성 시작
            let html = `
                <table>
                    <tr>
                        <th>ID</th>
                        <th>이름</th>
                        <th>이메일</th>
                        <!-- 필요시 추가 컬럼 -->
                    </tr>
            `;

            // 데이터 행 추가
            data.users.forEach(user => {
                html += `
                    <tr>
                        <td>${user.id}</td>
                        <td>${user.name}</td>
                        <td>${user.email}</td>
                    </tr>
                `;
            });

            html += `</table>`;
            resultDiv.innerHTML = html;
        })
        .catch(err => {
            document.getElementById('result').innerHTML =
                `<b style="color:red;">AJAX 오류: ${err}</b>`;
        });
}

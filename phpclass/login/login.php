<div class="login__popup">
    <div class="login__inner">
        <div class="login__header">
            <h3>로그인</h3>
        </div>
        
        <div class="login__contents">
            <form action="../login/loginSave.php" method="post" name="login">
                <fieldset>
                    <legend>로그인 입력 폼</legend>
                    <div>
                        <label for="youEmail">이메일</label>
                        <input type="email" name="youEmail" id="youEmail" placeholder="이메일" class="input__style" required>
                    </div>
                    <div>
                        <label for="youPass">비밀번호</label>
                        <input type="password" name="youPass" id="youPass" placeholder="비밀번호" class="input__style" required>
                    </div>
                    <button type="submit" class="input__button">로그인</button>
                </fieldset>
            </form>
        </div>
        
        <div class="login__footer">
            <div class="btn">
                <a href="#">회원가입</a>
                <a href="#">아이디 찾기</a>
                <a href="#">비밀번호 찾기</a>
            </div>

            <ul class="desc">
                <li>* 타 사이트와 비밀번호를 동일하게 사용할 경우 도용의 위험이 있으므로, 정기적인 비밀번호 변경을 해주시길 바랍니다.</li>
                <li>* 스타벅스 코리아의 공식 홈페이지는 Internet Explorer 9.0 이상, Chrome, Firefox, Safari 브라우저에 최적화 되어있습니다.</li>
            </ul>
            <button type="button" class="btn-close"><span>닫기</span></button>
        </div>
    </div>
</div>
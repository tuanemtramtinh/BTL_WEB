<div class="auth">
  <div class="container">
    <div class="auth__wrapper">
      <form action="auth/loginPost" class="auth__form" method="post">
        <div class="auth__nav">
          <a href="auth/login" class="active">Sign in</a>
          <a href="auth/register" class="">Sign up</a>
        </div>
        <input type="text" name="email" id="email" placeholder="E-mail">
        <input type="password" name="password" id="password" placeholder="Password">
        <div class="auth__remember">
          <input type="checkbox" name="remember" id="remember">
          <label for="remember">Remember Me</label>
        </div>
        <button type="submit">Sign in</button>
      </form>
    </div>
  </div>
</div>
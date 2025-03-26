<div class="auth">
  <div class="container">
    <div class="auth__wrapper">
      <form action="auth/registerPost" class="auth__form" method="post">
        <div class="auth__nav">
          <a href="auth/login" class="">Sign in</a>
          <a href="auth/register" class="active">Sign up</a>
        </div>
        <input required type="text" name="firstname" id="firstname" placeholder="First name">
        <input required type="text" name="lastname" id="lastname" placeholder="Last name">
        <input required type="email" name="email" id="email" placeholder="E-mail">
        <input required type="password" name="password" id="password" placeholder="Password">
        <button type="submit">Sign up</button>
      </form>
    </div>
  </div>
</div>
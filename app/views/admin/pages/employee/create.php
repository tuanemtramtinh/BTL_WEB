<section id="basic-vertical-layouts">
  <div class="card">
    <div class="card-header">
      <h4 class="card-title">Create Employee</h4>
    </div>
    <div class="card-content">
      <div class="card-body">
        <form action="admin/employee/createPost" method="post" class="form form-vertical">
          <div class="form-body">
            <div class="row">
              <div class="col-12">
                <div class="form-group has-icon-left">
                  <label for="social-number-name-icon">Social Number</label>
                  <div class="position-relative">
                    <input type="text" class="form-control"
                      placeholder="Social Number"
                      id="social-number-name-icon" name="socialnum">
                    <div class="form-control-icon">
                      <i class="bi bi-person-vcard-fill"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group has-icon-left">
                  <label for="first-name-icon">First Name</label>
                  <div class="position-relative">
                    <input type="text" class="form-control"
                      placeholder="Firstname"
                      id="first-name-icon" name="firstname">
                    <div class="form-control-icon">
                      <i class="bi bi-person"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group has-icon-left">
                  <label for="last-name-icon">Last Name</label>
                  <div class="position-relative">
                    <input type="text" class="form-control"
                      placeholder="Lastname"
                      id="last-name-icon" name="lastname">
                    <div class="form-control-icon">
                      <i class="bi bi-person"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group has-icon-left">
                  <label for="mobile-id-icon">Mobile</label>
                  <div class="position-relative">
                    <input type="text" class="form-control"
                      placeholder="Mobile" id="mobile-id-icon" name="phone">
                    <div class="form-control-icon">
                      <i class="bi bi-phone"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group has-icon-left">
                  <label for="address-id-icon">Address</label>
                  <div class="position-relative">
                    <input type="text" class="form-control"
                      placeholder="Address" id="address-id-icon" name="address">
                    <div class="form-control-icon">
                      <i class="bi bi-house"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group has-icon-left">
                  <label for="username-id-icon">Username</label>
                  <div class="position-relative">
                    <input type="text" class="form-control"
                      placeholder="Username" id="username-id-icon" name="username">
                    <div class="form-control-icon">
                      <i class="bi bi-people"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group has-icon-left">
                  <label for="email-id-icon">Email</label>
                  <div class="position-relative">
                    <input type="email" class="form-control"
                      placeholder="Email" id="email-id-icon" name="email">
                    <div class="form-control-icon">
                      <i class="bi bi-envelope"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group has-icon-left">
                  <label for="password-id-icon">Password</label>
                  <div class="position-relative">
                    <input type="password" class="form-control"
                      placeholder="Password" id="password-id-icon" name="password">
                    <div class="form-control-icon">
                      <i class="bi bi-lock"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class='form-check'>
                  <div class="checkbox mt-2">
                    <input type="checkbox" id="remember-me-v"
                      class='form-check-input' checked>
                    <label for="remember-me-v">Remember Me</label>
                  </div>
                </div>
              </div>
              <div class="col-12 d-flex justify-content-end">
                <button type="submit"
                  class="btn btn-primary me-1 mb-1">Submit</button>
                <button type="reset"
                  class="btn btn-light-secondary me-1 mb-1">Reset</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
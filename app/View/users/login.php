<?php require_once (APPROOT . '/View/base/header.php'); ?>
    
    <?php require_once (APPROOT . "/View/base/nav.php"); ?>

    <!-- Login Screen -->
    <div class="card login-card">
        <div class="card-header"><h3 class="card-title"><i class="fas fa-lock"></i>ورود به حساب کاربری</h3></div>
        <form novalidate action="<?php echo URLROOT; ?>users/login" method="post">
            <div class="form-group">
            <label for="loginEmail" class="form-label">آدرس ایمیل سازمانی</label>
            <input name="email" type="email" class="form-control <?php echo (!empty($data['email_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>" id="loginEmail" placeholder="email@company.com">
            <div class="invalid-feedback"> <?php echo $data['email_error']; ?> </div>
        </div>

            <div class="form-group">
            <label for="loginPassword" class="form-label">رمز عبور</label>
            <input name="password" type="password" class="form-control <?php echo (!empty($data['password_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>" id="loginPassword" placeholder="••••••••">
            <div class="invalid-feedback"> <?php echo $data['password_error']; ?> </div>
        </div>

            <button type="submit" class="btn btn-primary w-100 mt-4"><i class="fas fa-sign-in-alt"></i>ورود</button>

            <div class="text-center mt-4"> 
            <small><a href="#">بازیابی رمز عبور</a></small> 
        </div>
        </form>
    </div>

    <?php require_once (APPROOT . '/View/base/footer.php'); ?>
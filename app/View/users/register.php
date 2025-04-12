<?php require_once (APPROOT . '/View/base/header.php'); ?>
    
    <?php require_once (APPROOT . "/View/base/nav.php"); ?>

    <div class="container">
        <div class="card register-card">    
            <div class="card-header"><h3 class="card-title">
                <i class="fas fa-user-plus"></i>ثبت‌نام / درخواست حساب</h3>
            </div>
            <form novalidate action="<?php echo URLROOT; ?>users/register" method="post">
                <div class="form-group">
                    <label for="registerName" class="form-label">نام و نام خانوادگی</label>
                    <input name="name" type="text" class="form-control <?php echo (!empty($data['name_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>" id="registerName" placeholder="نام کامل">
                    <div class="invalid-feedback"> <?php echo $data['name_error']; ?> </div>
                </div>
                <div class="form-group">
                    <label for="registerName" class="form-label">نام مستعار</label>
                    <input name="nickname" type="text" class="form-control <?php echo (!empty($data['nickname_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['nickname']; ?>" id="registerName" placeholder="نام مستعار">
                    <div class="invalid-feedback"> <?php echo $data['nickname_error']; ?> </div>
                </div>
                <div class="form-group">
                    <label for="registerEmail" class="form-label">آدرس ایمیل سازمانی</label>
                    <input name="email" type="email" class="form-control <?php echo (!empty($data['email_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>" id="registerEmail" placeholder="email@company.com">
                    <div class="invalid-feedback"> <?php echo $data['email_error']; ?> </div>
                </div>
                <div class="form-group">
                    <label for="registerEmail" class="form-label">نقش سازمانی</label>
                    <input name="role" type="email" class="form-control <?php echo (!empty($data['role_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['role']; ?>" id="registerEmail" placeholder="نقش سازمانی: توسعه دهنده">
                    <div class="invalid-feedback"> <?php echo $data['role_error']; ?> </div>
                </div>
                <div class="form-group">
                    <label for="registerEmail" class="form-label">واحد</label>
                    <input name="unit" type="email" class="form-control <?php echo (!empty($data['unit_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['unit']; ?>" id="registerEmail" placeholder="واحد سازمانی">
                    <div class="invalid-feedback"> <?php echo $data['unit_error']; ?> </div>
                </div>
                <div class="form-group">
                    <label for="registerPassword" class="form-label">رمز عبور پیشنهادی</label>
                    <input name="password" type="password" class="form-control <?php echo (!empty($data['password_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>" id="registerPassword" placeholder="حداقل 6 کاراکتر">
                    <div class="invalid-feedback"> <?php echo $data['password_error']; ?> </div>
                </div>
                <div class="form-group">
                    <label for="registerConfirmPassword" class="form-label">تکرار رمز عبور</label>
                    <input name="confirm_password" type="password" class="form-control <?php echo (!empty($data['confirm_password_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['confirm_password']; ?>" id="registerConfirmPassword">
                    <div class="invalid-feedback"> <?php echo $data['confirm_password_error']; ?> </div>
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-4"><i class="fas fa-check-circle"></i>ثبت درخواست</button>
            </form>
        </div>
    </div>

    <pre>
        <?php var_dump($data); ?>
    </pre>
    <?php require_once (APPROOT . '/View/base/footer.php'); ?>
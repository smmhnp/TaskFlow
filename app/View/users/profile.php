<?php require_once (APPROOT . '/View/base/header.php'); ?>
    
    <?php require_once (APPROOT . "/View/base/nav.php"); ?>

        <div class="container">
            <?php flash('password_update'); ?>
            
            <h2><i class="fas fa-user-cog"></i>پروفایل و تنظیمات</h2>
            <div class="card profile-card" style="max-width: 600px;">

                <div class="text-center mb-5">
                    <div class="user-avatar" style="width: 100px; height: 100px; font-size: 2.5rem; margin: 0 auto 20px auto; border: 3px solid var(--border-color-light);">
                        <?php echo substr($data['user'] -> name, 0, 3); ?>
                    </div>
                </div>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px 30px;" class="mb-5">
                    <div class="form-group mb-0">
                        <label for="profileNickname" class="form-label">نام مستعار</label>
                        <input type="text" class="form-control" id="profileNickname" value="<?php echo $data['user'] -> name; ?>" disabled readonly>
                    </div>
                    <div class="form-group mb-0">
                        <label for="profileEmail" class="form-label">آدرس ایمیل</label>
                        <input type="email" class="form-control" id="profileEmail" value="<?php echo $data['user'] -> email; ?>" disabled readonly>
                    </div>
                    <div class="form-group mb-0">
                        <label for="profileRole" class="form-label">نقش سازمانی</label>
                        <input type="text" class="form-control" id="profileRole" value="<?php Role($data['user'] -> role); ?>" disabled readonly>
                    </div>
                    <div class="form-group mb-0">
                        <label for="profileDepartment" class="form-label">واحد</label>
                        <input type="text" class="form-control" id="profileDepartment" value="<?php echo $data['user'] -> unit; ?>" disabled readonly>
                    </div>
                </div>
                
                <hr class="my-5" style="border-top: 1px solid var(--border-color-light);">
                
                <form action="<?php echo URLROOT; ?>users/profile" method="post">
                    <h4 style="margin-bottom: 1.5rem;">تغییر رمز عبور</h4>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 20px 30px;" class="mb-5">
                        <div class="form-group mb-0">
                            <label for="currentPassword" class="form-label">رمز عبور فعلی</label>
                            <input name="current_password" type="password" class="form-control <?php echo (!empty($data['current_password_error'])) ? 'is-invalid' : ''; ?>" id="currentPassword">
                            <div class="invalid-feedback"> <?php echo $data['current_password_error']; ?> </div>
                        </div>
                        <div class="form-group mb-0">
                            <label for="newPassword" class="form-label">رمز عبور جدید</label>
                            <input name="new_password" type="password" class="form-control <?php echo (!empty($data['new_password_error'])) ? 'is-invalid' : ''; ?>" id="newPassword">
                            <div class="invalid-feedback"> <?php echo $data['new_password_error']; ?> </div>
                        </div>
                        <div class="form-group mb-0">
                            <label for="confirmNewPassword" class="form-label">تکرار رمز جدید</label>
                            <input name="confirm_new_password" type="password" class="form-control <?php echo (!empty($data['confirm_new_password_error'])) ? 'is-invalid' : ''; ?>" id="confirmNewPassword">
                            <div class="invalid-feedback"> <?php echo $data['confirm_new_password_error']; ?> </div>
                        </div>
                    </div>

                    <div class="mt-5 d-flex">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>ذخیره تغییرات</button>
                    </div>
                </form>
            </div>
        </div>

    <?php require_once (APPROOT . '/View/base/footer.php'); ?>
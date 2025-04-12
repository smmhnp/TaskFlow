<?php require_once (APPROOT . '/View/base/header.php'); ?>
    
    <?php require_once (APPROOT . "/View/base/nav.php"); ?>

    <div class="container">
    
        <?php flash('register_success'); ?>

        <h2><i class="fas fa-users-cog"></i>مدیریت کاربران (ادمین)</h2>
        <div class="card">
            <div class="section-header">
                <h3 style="margin-bottom: 0;">لیست کاربران سیستم</h3>
                <a href="<?php echo URLROOT; ?>users/register" class="btn btn-info btn-sm"><i class="fas fa-user-plus"></i>عضویت کاربر جدید</a>
            </div>
            <div class="table-container">
                <table class="table">
                    <thead> <tr> <th>نام و نام خانوادگی</th> <th>نام مستعار</th> <th>ایمیل</th> <th>نقش</th> <th>وضعیت</th> <th>تاریخ عضویت</th> <th>عملیات</th> </tr> </thead>
                    <tbody>
                        <?php foreach ($data['users'] as $user): ?>
                            <tr> 
                                <td><?php echo $user -> name; ?></td> 
                                <td><?php echo $user -> nickname; ?></td> 
                                <td><?php echo $user -> email; ?></td> 
                                <td><?php Role($user -> role); ?></td> 
                                <td>
                                    <span class="badge badge-status-active">فعال</span>
                                </td> 
                                <td><?php echo $user -> CreateDate; ?></td> 
                                <td>
                                    <div class="button-group">
                                        <button class="btn btn-sm btn-secondary" title="ویرایش"><i class="fas fa-user-edit"></i></button> 
                                        <button class="btn btn-sm btn-danger" title="غیرفعال کردن"><i class="fas fa-user-slash"></i></button>
                                    </div>
                                </td> 
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php require_once (APPROOT . '/View/base/footer.php'); ?>
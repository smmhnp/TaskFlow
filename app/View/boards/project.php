<?php require_once (APPROOT . '/View/base/header.php'); ?>
    
    <?php require_once (APPROOT . "/View/base/nav.php"); ?>
    
        <div class="container">
            <h2><i class="fas fa-folder-open"></i>مدیریت پروژه‌ها</h2>
            <div class="card">
                <div class="section-header">
                    <h3 style="margin-bottom: 0;">لیست پروژه‌ها</h3>
                    <?php if ($_SESSION['user_role'] == 'admin' or $_SESSION['user_role'] == 'developre'): ?>
                        <a href="<?php echo URLROOT; ?>tasks/add" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i>پروژه جدید</a>
                    <?php endif; ?>
                </div>
                <div class="table-container">
                    <table class="table">
                        <thead> 
                            <tr> 
                                <th>نام پروژه</th> 
                                <th>تعداد وظایف (فعال / کل)</th> 
                                <th>مدیر پروژه (نام مستعار)</th> 
                                <th>تاریخ ایجاد</th> 
                                <th>عملیات</th> 
                            </tr> 
                        </thead>
                        <tbody>
                            <?php foreach ($data['task'] as $task): ?>
                                <tr> 
                                    <td>
                                        <strong><?php echo $task -> title; ?></strong>
                                    </td> 
                                    <td>3 / 4</td> 
                                    <td><?php echo $task -> undertaking; ?></td> 
                                    <td><?php echo $task -> deadline; ?></td> 
                                    <td>
                                        <div class="button-group">
                                            <a href="#" class="btn btn-sm btn-secondary" title="ویرایش"><i class="fas fa-eye"></i></a> 
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
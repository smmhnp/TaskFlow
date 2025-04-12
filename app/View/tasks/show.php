<?php require_once (APPROOT . '/View/base/header.php'); ?>
    
    <?php require_once (APPROOT . "/View/base/nav.php"); ?>

    <div class="container">
        <h2><i class="fas fa-clipboard-list"></i>جزئیات وظیفه</h2>
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title" style="margin-bottom: 0;"><?php echo $data['task'] -> title; ?></h3>
                <span class="badge badge-status-<?php color_status_style($data['task'] -> status); ?>"><?php echo $data['task'] -> status; ?></span>
            </div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 25px 35px; margin-bottom: 40px; padding-top: 25px;">
                <div> 
                    <h4><i class="fas fa-info-circle"></i> شرح وظیفه</h4> 
                    <p>
                        <?php echo $data['task'] -> content; ?>
                    </p> 
                </div>
                <div> 
                    <h4><i class="fas fa-flag"></i> اولویت</h4> 
                    <p>
                        <span class="badge badge-priority-<?php color_preference_style($data['task'] -> preference); ?>"><?php echo $data['task'] -> preference; ?></span>
                    </p> 
                </div>
                <div> 
                    <h4><i class="fas fa-user-tie"></i> مسئول</h4> 
                    <p><?php echo $data['task'] -> undertaking; ?></p> 
                </div>
                <div> 
                    <h4><i class="far fa-calendar-alt"></i> مهلت</h4> 
                    <p><?php echo $data['task'] -> deadline; ?></p> 
                </div>
                <div> 
                    <h4><i class="fas fa-project-diagram"></i> پروژه</h4> 
                    <p><?php echo $data['task'] -> project_name; ?></p> 
                </div>
                <div> 
                    <h4><i class="far fa-clock"></i> زمان ثبت</h4> 
                    <p><?php echo $data['task'] -> create_date; ?></p> 
                </div>
            </div>

            <div class="comments-section">
                <h4><i class="fas fa-comments"></i>بحث و گفتگو (1)</h4>
                <div class="comment">
                    <div class="comment-avatar" style="background-color: var(--success-color);">Nass</div>
                    <div class="comment-body">
                        <div class="comment-meta"><span class="comment-author">Nass</span> <span class="comment-date">چند دقیقه پیش</span></div>
                        <p class="comment-text">سلام، لینک طرح‌های اولیه در Figma آپدیت شد. لطفاً بررسی بفرمایید و بازخوردتون رو اعلام کنید.</p>
                    </div>
                </div>
                <form class="comment-form mt-4">
                    <div class="form-group mb-2">
                        <label for="newComment" class="form-label">افزودن نظر جدید:</label>
                        <textarea class="form-control" id="newComment" rows="3" placeholder="نظر یا سوال خود را بنویسید..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-paper-plane"></i>ارسال</button>
                </form>
            </div>

            <div class="mt-5 d-flex gap-3" style="border-top: 1px solid var(--border-color-light); padding-top: 30px;">

                <?php if ($_SESSION['user_role'] == 'admin'): ?>
                    <a href="<?php echo URLROOT; ?>tasks/edit/<?php echo $data['task'] -> id; ?>" class="btn btn-secondary"><i class="fas fa-edit"></i>ویرایش</a>
                    <form action="<?php echo URLROOT; ?>tasks/delete/<?php echo $data['task'] -> id; ?>" method="post">
                        <a type="submit" class="btn btn-secondary" title="حذف"><i class="fas fa-trash-alt"></i>حذف</a>
                    </form> 
                <?php elseif ( $_SESSION['user_role'] == 'developre'): ?>
                    <a href="<?php echo URLROOT; ?>tasks/edit/<?php echo $data['task'] -> id; ?>" class="btn btn-secondary"><i class="fas fa-edit"></i>ویرایش</a>
                <?php endif; ?>

                <button class="btn btn-success"><i class="fas fa-check-circle"></i>علامت زدن به عنوان انجام شده</button>
                <button class="btn btn-secondary" onclick="window.location.href='<?php echo URLROOT; ?>tasks/index'"><i class="fas fa-arrow-left"></i>بازگشت</button>
            </div>
        </div>
    </div>
          
<?php require_once (APPROOT . '/View/base/footer.php'); ?>
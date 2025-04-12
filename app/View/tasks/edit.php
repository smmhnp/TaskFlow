<?php require_once (APPROOT . '/View/base/header.php'); ?>

    
    <?php require_once (APPROOT . "/View/base/nav.php"); ?>

    <div class="container">
        <h2><i class="fas fa-edit"></i>ایجاد / ویرایش وظیفه</h2>
        <div class="card">
            <form novalidate action="<?php echo URLROOT; ?>tasks/edit/<?php echo $data['id'] ?>" method="post">
                <div class="form-group">
                    <label for="taskTitle" class="form-label">عنوان</label>
                    <input name="title" type="text" class="form-control  <?php echo (!empty($data['title_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>" id="taskTitle">
                    <div class="invalid-feedback"> <?php echo $data['title_error']; ?> </div>
                </div>

                <div class="form-group">
                    <label for="taskDescription" class="form-label">شرح کامل</label>
                    <textarea name="content" class="form-control <?php echo (!empty($data['content_error'])) ? 'is-invalid' : ''; ?>" id="taskDescription" rows="5"> <?php echo $data['content']; ?> </textarea>
                    <div class="invalid-feedback"> <?php echo $data['content_error']; ?> </div>
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 25px 35px;">

                    <div class="form-group">
                        <label for="taskTitle" class="form-label">پروژه مرتبط</label>
                        <input name="project_name" type="text" class="form-control  <?php echo (!empty($data['project_name_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['project_name']; ?>" id="taskTitle">
                        <div class="invalid-feedback"> <?php echo $data['project_name_error']; ?> </div>
                    </div>

                    <div class="form-group">
                        <label for="taskPriority" class="form-label">اولویت</label>
                        <select name="preference" class="form-control <?php echo (!empty($data['preference_error'])) ? 'is-invalid' : ''; ?>" id="taskPriority">

                            <?php if (isset($_POST['preference'])): ?>
                                <option><?php echo $data['preference']; ?></option>
                            <?php endif; ?>
                            
                            <option>متوسط</option>
                            <option>بالا</option>
                            <option>پایین</option>
                        </select>
                        <div class="invalid-feedback"> <?php echo $data['preference_error']; ?> </div>
                    </div>

                    <div class="form-group">
                        <label for="taskStatus" class="form-label">وضعیت</label>
                        <select name="status" class="form-control <?php echo (!empty($data['preference_error'])) ? 'is-invalid' : ''; ?>" id="taskStatus">

                            <?php if (isset($_POST['status'])): ?>
                                <option><?php echo $data['status']; ?></option>
                            <?php endif; ?>

                            <option>برای انجام</option>
                            <option>در حال انجام</option>
                            <option>بازبینی</option>
                            <option>انجام شده</option>
                        </select>
                        <div class="invalid-feedback"> <?php echo $data['status_error']; ?> </div>
                    </div>

                    <div class="form-group">
                        <label for="taskDueDate" class="form-label">مهلت انجام</label>
                        <input name="deadline" type="date" class="form-control <?php echo (!empty($data['deadline_error'])) ? 'is-invalid' : ''; ?>" id="taskDueDate" value="<?php echo $data['deadline']; ?>">
                        <div class="invalid-feedback"> <?php echo $data['deadline_error']; ?> </div>
                    </div>

                    <div class="form-group"><label for="taskAssignee" class="form-label">مسئول</label>
                        <select name="undertaking" class="form-control <?php echo (!empty($data['undertaking_error'])) ? 'is-invalid' : ''; ?>" id="taskAssignee">

                            <?php if (isset($_POST['undertaking'])): ?>
                                <option><?php echo $data['undertaking']; ?></option>
                            <?php endif; ?>

                            <option>Lead</option>
                            <option>DevLead</option>
                            <option>Nass</option>
                            <option>Zara</option>
                            <option>Fati</option>
                            <option>Rey</option>
                        </select>
                        <div class="invalid-feedback"> <?php echo $data['undertaking_error']; ?> </div>
                    </div>
                </div>

                <div class="mt-5 d-flex gap-3">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>ذخیره وظیفه</button>
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='<?php echo URLROOT; ?>tasks/index'"><i class="fas fa-times"></i>لغو</button>
                </div>
            </form>
        </div>
    </div>

    <?php require_once (APPROOT . '/View/base/footer.php'); ?>
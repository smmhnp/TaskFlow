
<header class="main-header">
        <button class="mobile-menu-toggle" id="toggleMobileMenu">
            <i class="fas fa-bars"></i>
        </button>
        <div class="logo">Task Flow</div>
        <nav class="main-nav">
            <a href="<?php echo URLROOT; ?>tasks/index" class="nav-link"><i class="fas fa-list-ul fa-fw"></i> داشبورد</a>
            <a href="<?php echo URLROOT; ?>boards/index" class="nav-link"><i class="fas fa-stream fa-fw"></i> تابلوی جریان کار</a>
            <a href="<?php echo URLROOT; ?>boards/project" class="nav-link"><i class="fas fa-folder fa-fw"></i> پروژه‌ها</a>
            <a href="<?php echo URLROOT; ?>users/profile" class="nav-link"><i class="fas fa-user-cog fa-fw"></i> پروفایل</a>

            <?php if (isset($_SESSION['user_role']) and $_SESSION['user_role'] == 'admin'): ?>
                <a href="<?php echo URLROOT; ?>users/admin" class="nav-link"><i class="fas fa-users-cog fa-fw"></i> مدیریت کاربران</a>
            <?php endif; ?>
        </nav>
        <div class="header-actions">
            <a href="<?php echo URLROOT; ?>tasks/add" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> وظیفه جدید</a>

            <?php if (is_user_logged_in()): ?>
                <div class="user-menu">
                    <div class="user-avatar"><?php echo isset($_SESSION['user_name']) ? substr($_SESSION['user_name'], 0, 3) : ''; ?></div>
                    <div class="user-info">
                        <span class="user-nickname"><?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Lead'; ?></span>
                        <span class="user-role"><?php echo isset($_SESSION['user_role']) ? $_SESSION['user_role'] : ''; ?></span>
                    </div>
                </div>
            <?php else: ?>
                <a href="<?php echo URLROOT; ?>users/login" class="icon-link" title="login"><i class="fas fa-sign-in-alt"></i></a>
            <?php endif; ?>

            <?php if (is_user_logged_in()): ?>
                <a href="<?php echo URLROOT; ?>users/logout" class="icon-link" title="logout"><i class="fas fa-sign-out-alt"></i></a>
            <?php endif; ?>
        </div>
    </header>

    <div class="mobile-menu-drawer">
        <a href="<?php echo URLROOT; ?>tasks/index" class="mobile-nav-link"><i class="fas fa-list-ul fa-fw"></i> داشبورد</a>
        <a href="<?php echo URLROOT; ?>boards/index" class="mobile-nav-link"><i class="fas fa-stream fa-fw"></i> تابلوی جریان کار</a>
        <a href="<?php echo URLROOT; ?>boards/project" class="mobile-nav-link"><i class="fas fa-folder fa-fw"></i> پروژه‌ها</a>
        <a href="<?php echo URLROOT; ?>tasks/add" class="mobile-nav-link"><i class="fas fa-plus-circle fa-fw"></i> وظیفه جدید</a>
        <a href="<?php echo URLROOT; ?>users/profile" class="mobile-nav-link"><i class="fas fa-user-cog fa-fw"></i> پروفایل</a>

        <?php if (isset($_SESSION['user_role']) and $_SESSION['user_role'] == 'admin'): ?>
            <a href="<?php echo URLROOT; ?>users/admin" class="nav-link"><i class="fas fa-users-cog fa-fw"></i> مدیریت کاربران</a>
        <?php endif; ?>

        <?php if (is_user_logged_in()): ?>
            <a href="<?php echo URLROOT; ?>users/logout" class="icon-link" title="logout"><i class="fas fa-sign-out-alt"></i></a>
        <?php else: ?>
            <a href="<?php echo URLROOT; ?>users/login" class="icon-link" title="login"><i class="fas fa-sign-out-alt"></i></a>
        <?php endif; ?>
    </div>
<?php require_once (APPROOT . '/View/base/header.php'); ?>
    
    <?php require_once (APPROOT . "/View/base/nav.php"); ?>
    
    <div class="container">

        <?php flash('task_message'); ?>

        <h2><i class="fas fa-list-ul"></i>داشبورد وظایف</h2>

        <div class="card">

            <div class="dashboard-filters">
                <div class="search-filter input-group input-group-sm">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="search" class="form-control form-control-sm" placeholder="جستجو در وظایف..." id="dashboard-search">
                </div>
                
                <!-- وضعیت Filter -->
                <div class="filter-item">
                    <button class="btn btn-sm btn-outline-secondary btn-filter" data-filter="status" id="statusFilterBtn">
                        وضعیت: همه <i class="fas fa-chevron-down"></i>
                        <span class="filtered-indicator"></span>
                    </button>
                    <div class="filter-dropdown" id="statusFilterDropdown">
                        <div class="filter-dropdown-header">
                            <span class="filter-dropdown-title">فیلتر بر اساس وضعیت</span>
                            <button class="filter-dropdown-close" title="بستن"><i class="fas fa-times"></i></button>
                        </div>
                        <div class="filter-dropdown-body">
                            <div class="filter-dropdown-item active" data-value="all">همه</div>
                            <div class="filter-dropdown-item" data-value="todo">برای انجام</div>
                            <div class="filter-dropdown-item" data-value="inprogress">در حال انجام</div>
                            <div class="filter-dropdown-item" data-value="review">بازبینی</div>
                            <div class="filter-dropdown-item" data-value="done">انجام شده</div>
                        </div>
                    </div>
                </div>
                
                <!-- اولویت Filter -->
                <div class="filter-item">
                    <button class="btn btn-sm btn-outline-secondary btn-filter" data-filter="priority" id="priorityFilterBtn">
                        اولویت: همه <i class="fas fa-chevron-down"></i>
                        <span class="filtered-indicator"></span>
                    </button>
                    <div class="filter-dropdown" id="priorityFilterDropdown">
                        <div class="filter-dropdown-header">
                            <span class="filter-dropdown-title">فیلتر بر اساس اولویت</span>
                            <button class="filter-dropdown-close" title="بستن"><i class="fas fa-times"></i></button>
                        </div>
                        <div class="filter-dropdown-body">
                            <div class="filter-dropdown-item active" data-value="all">همه</div>
                            <div class="filter-dropdown-item" data-value="high">بالا</div>
                            <div class="filter-dropdown-item" data-value="medium">متوسط</div>
                            <div class="filter-dropdown-item" data-value="low">پایین</div>
                        </div>
                    </div>
                </div>
                
                <!-- پروژه Filter -->
                <div class="filter-item">
                    <button class="btn btn-sm btn-outline-secondary btn-filter" data-filter="project" id="projectFilterBtn">
                        پروژه: همه <i class="fas fa-chevron-down"></i>
                        <span class="filtered-indicator"></span>
                    </button>
                    <div class="filter-dropdown" id="projectFilterDropdown">
                        <div class="filter-dropdown-header">
                            <span class="filter-dropdown-title">فیلتر بر اساس پروژه</span>
                            <button class="filter-dropdown-close" title="بستن"><i class="fas fa-times"></i></button>
                        </div>
                        <div class="filter-dropdown-body">
                            <div class="filter-dropdown-item active" data-value="all">همه</div>
                            <div class="filter-dropdown-item" data-value="alpha">پروژه آلفا</div>
                            <div class="filter-dropdown-item" data-value="beta">پروژه بتا</div>
                        </div>
                    </div>
                </div>
                
                <!-- مسئول Filter -->
                <div class="filter-item">
                    <button class="btn btn-sm btn-outline-secondary btn-filter" data-filter="assignee" id="assigneeFilterBtn">
                        مسئول: همه <i class="fas fa-chevron-down"></i>
                        <span class="filtered-indicator"></span>
                    </button>
                    <div class="filter-dropdown" id="assigneeFilterDropdown">
                        <div class="filter-dropdown-header">
                            <span class="filter-dropdown-title">فیلتر بر اساس مسئول</span>
                            <button class="filter-dropdown-close" title="بستن"><i class="fas fa-times"></i></button>
                        </div>
                        <div class="filter-dropdown-body">
                            <div class="filter-dropdown-item active" data-value="all">همه</div>
                            <div class="filter-dropdown-item" data-value="Lead">Lead</div>
                            <div class="filter-dropdown-item" data-value="DevLead">DevLead</div>
                            <div class="filter-dropdown-item" data-value="Nass">Nass</div>
                            <div class="filter-dropdown-item" data-value="Zara">Zara</div>
                        </div>
                    </div>
                </div>
                
                <div class="ms-auto"> 
                    <?php if ($_SESSION['user_role'] == 'admin' or $_SESSION['user_role'] == 'developre'): ?>
                        <a href="<?php echo URLROOT; ?>tasks/add" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> وظیفه جدید</a> 
                    <?php endif; ?>
                </div>
            </div>

            <div class="table-container">
                <table class="table">
                    <thead> 
                        <tr> 
                            <th>عنوان وظیفه</th> 
                            <th>پروژه</th> 
                            <th>مسئول (نام مستعار)</th> 
                            <th>اولویت</th> 
                            <th>مهلت</th> 
                            <th>وضعیت</th> 
                            <th>نمایش</th> 
                        </tr> 
                    </thead>

                    <tbody id="tasks-table-body">
                        <?php foreach ($data['task'] as $task) : ?>

                            <tr data-status="inprogress" data-priority="high" data-project="alpha" data-assignee="Lead"> 
                                <td><?php echo $task -> title; ?></td> 
                                <td><a href="#task-detail-screen"><?php echo $task -> project_name; ?></a></td> 
                                <td class="user-nickname-cell"><?php echo $task -> undertaking; ?></td> 
                                <td><span class="badge badge-priority-<?php color_preference_style($task -> preference); ?>"><?php echo $task -> preference; ?></span></td> 
                                <td><?php echo $task -> deadline; ?></td> 
                                <td><span class="badge badge-status-<?php color_status_style($task -> status); ?>"><?php echo $task -> status; ?></span></td> 
                                <td>
                                    <div class="button-group"> 
                                        <a href="<?php echo URLROOT; ?>tasks/show/<?php echo $task -> id; ?>" class="btn btn-sm btn-secondary" title="مشاهده"><i class="fas fa-eye"></i></a>
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
<?php require_once (APPROOT . '/View/base/header.php'); ?>
    
    <?php require_once (APPROOT . "/View/base/nav.php"); ?>
    
        <div class="container">

            <h2><i class="fas fa-stream"></i>تابلوی جریان کار</h2>
            <div class="card">
                <div class="dashboard-filters">
                    <div class="search-filter input-group input-group-sm">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="search" class="form-control form-control-sm" placeholder="جستجو در وظایف..." id="workflow-search">
                    </div>
                    
                    <!-- اولویت Filter -->
                    <div class="filter-item">
                    <button class="btn btn-sm btn-outline-secondary btn-filter" data-filter="priority" id="workflowPriorityFilterBtn">
                        اولویت: همه <i class="fas fa-chevron-down"></i>
                        <span class="filtered-indicator"></span>
                    </button>
                    <div class="filter-dropdown" id="workflowPriorityFilterDropdown">
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
                    <button class="btn btn-sm btn-outline-secondary btn-filter" data-filter="project" id="workflowProjectFilterBtn">
                        پروژه: همه <i class="fas fa-chevron-down"></i>
                        <span class="filtered-indicator"></span>
                    </button>
                    <div class="filter-dropdown" id="workflowProjectFilterDropdown">
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
                    <button class="btn btn-sm btn-outline-secondary btn-filter" data-filter="assignee" id="workflowAssigneeFilterBtn">
                        مسئول: همه <i class="fas fa-chevron-down"></i>
                        <span class="filtered-indicator"></span>
                    </button>
                    <div class="filter-dropdown" id="workflowAssigneeFilterDropdown">
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
                </div>

                <?php
                    $to_do = 0;
                    $progress = 0;
                    $review = 0;
                    $done = 0;
                    
                    foreach ($data['task'] as $task){
                        $status = $task -> status;
                        switch ($status) :
                            case 'برای انجام' :
                                $to_do ++;
                                break;
                            case 'در حال انجام' :
                                $progress ++;
                                break;
                            case 'بازبینی' :
                                $review ++;
                                break;
                            case 'انجام شده' :
                                $done ++;
                                break;
                        endswitch;
                    }
                ?>

                <div class="workflow-board-container">
                    <!-- Stage: To Do -->
                    <?php if ($to_do != 0): ?>
                        <div class="workflow-stage">
                            <h3 class="stage-title"><i class="fas fa-inbox"></i> برای انجام <span class="task-count">(<?php echo $to_do; ?>)</span></h3>
                            
                            <div class="stage-tasks" id="todo-tasks">
                                <?php foreach ($data['task'] as $task): ?>
                                    <?php if ($task -> status == 'برای انجام'): ?>
                                        <div class="task-card-horizontal" data-priority="high" data-project="alpha" data-assignee="DevLead">
                                            <a href="<?php echo URLROOT; ?>tasks/show/<?php echo $task -> id ?>" class="task-card-title"><?php echo $task -> project_name; ?></a>
                                            <div class="task-card-meta">
                                                <span class="badge badge-priority-<?php color_preference_style($task -> preference); ?>"><?php echo $task -> preference; ?></span>
                                                <div class="task-card-assignee">
                                                    <div class="task-card-avatar" style="background-color: var(--danger-color);">
                                                        <?php echo substr($task -> undertaking, 0, 1) ?>
                                                    </div>
                                                    <span><?php echo $task -> undertaking; ?></span>
                                                </div>
                                                <div class="task-card-due-date"><i class="far fa-calendar-alt"></i><span><?php echo $task -> deadline; ?></span></div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div> 
                        </div>
                    <?php endif; ?>

                    <!-- Stage: In Progress -->
                    <?php if ($progress != 0): ?>
                        <div class="workflow-stage">
                            <h3 class="stage-title"><i class="fas fa-tasks"></i> در حال انجام <span class="task-count">(<?php echo $progress; ?>)</span></h3>

                            <div class="stage-tasks" id="todo-tasks">
                                <?php foreach ($data['task'] as $task): ?>
                                    <?php if ($task -> status == 'در حال انجام'): ?>
                                        <div class="task-card-horizontal" data-priority="high" data-project="alpha" data-assignee="DevLead">
                                            <a href="<?php echo URLROOT; ?>tasks/show/<?php echo $task -> id ?>" class="task-card-title"><?php echo $task -> project_name; ?></a>
                                            <div class="task-card-meta">
                                                <span class="badge badge-priority-<?php color_preference_style($task -> preference); ?>"><?php echo $task -> preference; ?></span>
                                                <div class="task-card-assignee">
                                                    <div class="task-card-avatar" style="background-color: var(--danger-color);">
                                                        <?php echo substr($task -> undertaking, 0, 1) ?>
                                                    </div>
                                                    <span><?php echo $task -> undertaking; ?></span>
                                                </div>
                                                <div class="task-card-due-date"><i class="far fa-calendar-alt"></i><span><?php echo $task -> deadline; ?></span></div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Stage: Review -->
                    <?php if ($review != 0): ?>
                        <div class="workflow-stage">
                            <h3 class="stage-title"><i class="fas fa-search"></i> بازبینی <span class="task-count">(<?php echo $review; ?>)</span></h3>

                            <div class="stage-tasks" id="todo-tasks">
                                <?php foreach ($data['task'] as $task): ?>
                                    <?php if ($task -> status == 'بازبینی'): ?>
                                        <div class="task-card-horizontal" data-priority="high" data-project="alpha" data-assignee="DevLead">
                                            <a href="<?php echo URLROOT; ?>tasks/show/<?php echo $task -> id ?>" class="task-card-title"><?php echo $task -> project_name; ?></a>
                                            <div class="task-card-meta">
                                                <span class="badge badge-priority-<?php color_preference_style($task -> preference); ?>"><?php echo $task -> preference; ?></span>
                                                <div class="task-card-assignee">
                                                    <div class="task-card-avatar" style="background-color: var(--danger-color);">
                                                        <?php echo substr($task -> undertaking, 0, 1) ?>
                                                    </div>
                                                    <span><?php echo $task -> undertaking; ?></span>
                                                </div>
                                                <div class="task-card-due-date"><i class="far fa-calendar-alt"></i><span><?php echo $task -> deadline; ?></span></div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Stage: Done -->
                        <?php if ($done != 0): ?>
                        <div class="workflow-stage">
                            <h3 class="stage-title"><i class="fas fa-check-double"></i> انجام شده <span class="task-count">(<?php echo $done; ?>)</span></h3>

                            <div class="stage-tasks" id="todo-tasks">
                                <?php foreach ($data['task'] as $task): ?>
                                    <?php if ($task -> status == 'انجام شده'): ?>
                                        <div class="task-card-horizontal" data-priority="high" data-project="alpha" data-assignee="DevLead">
                                            <a href="<?php echo URLROOT; ?>tasks/show/<?php echo $task -> id ?>" class="task-card-title"><?php echo $task -> project_name; ?></a>
                                            <div class="task-card-meta">
                                                <span class="badge badge-priority-<?php color_preference_style($task -> preference); ?>"><?php echo $task -> preference; ?></span>
                                                <div class="task-card-assignee">
                                                    <div class="task-card-avatar" style="background-color: var(--danger-color);">
                                                        <?php echo substr($task -> undertaking, 0, 1) ?>
                                                    </div>
                                                    <span><?php echo $task -> undertaking; ?></span>
                                                </div>
                                                <div class="task-card-due-date"><i class="far fa-calendar-alt"></i><span><?php echo $task -> deadline; ?></span></div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    <?php require_once (APPROOT . '/View/base/footer.php'); ?>
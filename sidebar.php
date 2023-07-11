  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="dropdown">
      <a href="./" class="brand-link">
        <?php if ($_SESSION['login_type'] == 2) : ?>
          <h5 class="short-form" style="text-align: center"><?php echo $_SESSION['system']['short_form'] ?>-Admin</h5>
        <?php elseif ($_SESSION['login_type'] == 1) : ?>
          <h5 class="short-form" style="text-align: center"><?php echo $_SESSION['system']['short_form'] ?>-Supervisor</h5>
        <?php else : ?>
          <h5 class="short-form" style="text-align: center"><?php echo $_SESSION['system']['short_form'] ?>-Staff</h5>
        <?php endif; ?>
      </a>
    </div>
    <div class="sidebar pb-4 mb-4">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item dropdown">
            <a href="./" class="nav-link nav-home">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a href="./index.php?page=task_list" class="nav-link nav-task_list">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                Tasks
              </p>
            </a>
          </li>
          <?php if ($_SESSION['login_type'] != 0) : ?>
            <li class="nav-item dropdown">
              <a href="./index.php?page=evaluation" class="nav-link nav-evaluation">
                <i class="nav-icon far fa-edit"></i>
                <p>
                  Appraisal
                </p>
              </a>
            </li>
          <?php endif; ?>
          <?php //if ($_SESSION['login_type'] != 0) : 
          ?>
          <li class="nav-item dropdown">
            <a href="./index.php?page=department" class="nav-link nav-department">
              <i class="nav-icon fas fa-th-list"></i>
              <p>
                Departments
              </p>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a href="./index.php?page=job_description" class="nav-link nav-designation">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Job Description
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_performance_appraisal">
              <i class="nav-icon fas fa-thumbs-up"></i>
              <p>
                Performance Appraisal
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=annual_performance_appraisal" class="nav-link nav-annual_performance_appraisal">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Explore</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=target_rating_results" class="nav-link nav-target_rating_results tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Total Rating</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=performance_competence" class="nav-link nav-performance_competence tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Performance Competence</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_employee">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Individual Work Plan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=new_work_plan" class="nav-link nav-new_work_plan tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=individual_work_plan" class="nav-link nav-work_plan_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_employee">
              <i class="nav-icon fas fa-user-friends"></i>
              <p>
                Employees
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if ($_SESSION['login_type'] == 2) : ?>
                <li class="nav-item">
                  <a href="./index.php?page=new_employee" class="nav-link nav-new_employee tree-item">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Add New</p>
                  </a>
                </li>
              <?php endif;
              ?>
              <li class="nav-item">
                <a href="./index.php?page=employee_list" class="nav-link nav-employee_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_supervisor">
              <i class="nav-icon fas fa-user-secret"></i>
              <p>
                Supervisor
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if ($_SESSION['login_type'] == 2) : ?>
                <li class="nav-item">
                  <a href="./index.php?page=new_supervisor" class="nav-link nav-new_supervisor tree-item">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Add New</p>
                  </a>
                </li>
              <?php endif;
              ?>
              <li class="nav-item">
                <a href="./index.php?page=supervisor_list" class="nav-link nav-supervisor_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_user">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if ($_SESSION['login_type'] == 2) : ?>
                <li class="nav-item">
                  <a href="./index.php?page=new_user" class="nav-link nav-new_user tree-item">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Add New</p>
                  </a>
                </li>
              <?php endif;
              ?>
              <li class="nav-item">
                <a href="./index.php?page=user_list" class="nav-link nav-user_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li>
          <?php if ($_SESSION['login_type'] == 2) : ?>
            <li class="nav-item">
              <a href="#" class="nav-link nav-edit_document">
                <i class="nav-icon fa fa-folder-open"></i>
                <p>
                  Documents
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="./index.php?page=new_document" class="nav-link nav-new_document tree-item">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Upload</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./index.php?page=document_list" class="nav-link nav-document_list tree-item">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>List</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a href="./index.php?page=system_information" class="nav-link nav-system_information">
                <i class="nav-icon fas fa-tools"></i>
                <p>
                  System Information
                </p>
              </a>
            </li>
          <?php endif;
          ?>
          <li class="nav-item dropdown">
            <a href="./index.php?page=job_title" class="nav-link nav-job_title">
              <i class="nav-icon fas fa-work"></i>
              <p>
                Job Title
              </p>
            </a>
          </li>
          <?php //endif; 
          ?>
        </ul>
      </nav>
    </div>
  </aside>
  <script>
    $(document).ready(function() {
      var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
      var s = '<?php echo isset($_GET['s']) ? $_GET['s'] : '' ?>';
      if (s != '')
        page = page + '_' + s;
      if ($('.nav-link.nav-' + page).length > 0) {
        $('.nav-link.nav-' + page).addClass('active')
        if ($('.nav-link.nav-' + page).hasClass('tree-item') == true) {
          $('.nav-link.nav-' + page).closest('.nav-treeview').siblings('a').addClass('active')
          $('.nav-link.nav-' + page).closest('.nav-treeview').parent().addClass('menu-open')
        }
        if ($('.nav-link.nav-' + page).hasClass('nav-is-tree') == true) {
          $('.nav-link.nav-' + page).parent().addClass('menu-open')
        }

      }

    })
  </script>
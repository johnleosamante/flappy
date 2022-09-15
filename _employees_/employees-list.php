<?php
# _employees_/employees-list.php
?>

<div class="card border-left-primary shadow mb-4">
  <div class="card-header py-3">
    <?php AddContentTitle('Employee List', true,  $_SERVER['HTTP_REFERER']); ?>
  </div><!-- .card-header -->

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-striped table-hover table-bordered mb-0" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr class="text-center align-middle">
            <th>#</th>
            <th>Employee Name</th>
            <th>Sex</th>
            <th>Station</th>
            <th>Position</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody><?php
          include_once('_functions_/database/db_employee.php');
          include_once('_functions_/strings.php');

          switch ($url) {
            case 'non-user-employees-list':
              $query = RetrieveNonUserEmployees();
              break;
            default:
              $query = RetrieveEmployees();
              break;
          }
          
          $no = 0;
          while ($row = DatabaseFetchArray($query)) { 
            $no++; ?>
          <tr>
            <td class="text-center"><?php echo $no; ?></td>
            <td class="text-capitalize"><?php echo ToName($row['lastname'], $row['firstname'], $row['middlename'], ); ?></td>
            <td class="text-center text-capitalize"><?php echo $row['sex'] ? 'female' : 'male'; ?></td> 
            <td class="text-center text-capitalize"><?php echo $row['station'] == '' ? GetDivisionOffice() : $row['station']; ?></td>
            <td class="text-center text-capitalize"><?php echo $row['position']; ?></td>
            <td>
              <?php if ($url == 'non-user-employees-list') : ?>
                <a class="text-xs btn btn-success d-block" href="<?php echo CreateCustomGetURL('new-user', $row['id']); ?>" title="Add as user"><i class="fas fa-user-plus"></i></a>
              <?php else : ?>

              <?php endif; ?>
            </td>
          </tr>
          <?php } ?>
        </tbody>

        <tfoot>
          <tr class="text-center align-middle">
            <th>#</th>
            <th>Employee Name</th>
            <th>Sex</th>
            <th>Station</th>
            <th>Position</th>
            <th>Action</th>
          </tr>
        </tfoot>
      </table>
    </div><!-- .table-responsive -->
  </div><!-- .card-body -->
</div><!-- .card -->
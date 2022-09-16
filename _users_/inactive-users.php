<?php
# _users_/inactive-users.php
?>

<div class="card border-left-primary shadow mb-4">
  <div class="card-header py-3">
    <?php AddContentTitle('Inactive Users', true, CreateCustomURL('users')); ?>
  </div><!-- .card-header -->

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-striped table-hover table-bordered mb-0" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr class="text-center align-middle">
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Added on</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody><?php
          include_once('_functions_/database/db_user.php');
          include_once('_functions_/database/db_personal.php');
          include_once('_functions_/database/db_school.php');
          include_once('_functions_/strings.php');
          $query = RetrieveInactiveUsers();
          $no = 0;
          while ($row = DatabaseFetchArray($query)) {
            $no++; ?>
            <tr>
              <td class="text-center"><?php echo $no; ?></td>
              <td class="text-capitalize">
                <?php
                $person = RetrieveName($row['id']);
                if (DatabaseNumRows($person) == 1) {
                  $name = DatabaseFetchArray($person);
                  echo ToName($name['lastname'], $name['firstname'], $name['middlename'], $name['extension']);
                } else {
                  echo DatabaseFetchArray(RetrieveSchool($row['id']))['school'];
                }
                ?>
              </td>
              <td class="text-center"><?php echo $row['username']; ?></td>
              <td class="text-center"><?php echo $row['created']; ?></td>
              <td></td>
            </tr>
          <?php
          } ?>
        </tbody>

        <tfoot>
          <tr class="text-center align-middle">
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Added on</th>
            <th>Action</th>
          </tr>
        </tfoot>
      </table>
    </div><!-- .table-responsive -->
  </div><!-- .card-body -->
</div><!-- .card -->
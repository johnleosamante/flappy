<?
# schools/schools-list.php
?>

<div class="card border-left-primary shadow mb-4">
  <div class="card-header py-3"><?php
    if ($url == 'non-user-schools-list') {
      $backlink = CreateCustomURL('school-users');
    } else {
      $backlink = $_SERVER['HTTP_REFERER'];
    }
    AddContentTitle('School List', true, $backlink); ?>
  </div><!-- .card-header -->

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-striped table-hover table-bordered mb-0" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr class="text-center align-middle">
            <th>School ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>District</th>
            <th>Cluster</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody><?php
          include_once('functions/strings.php');
          $query = RetrieveNonUserSchools();

          while ($row = DatabaseFetchArray($query)) { ?>
          <tr>
            <td class="text-center"><?php echo $row['schoolid']; ?></td>
            <td><?php echo $row['school']; ?></td>
            <td><?php echo ToAddress($row['lot'], $row['street'], $row['subdivision'], $row['barangay'], $row['city']); ?></td>
            <td class="text-center text-capitalize"><?php echo $row['district']; ?></td>
            <td class="text-center text-capitalize"><?php echo $row['cluster']; ?></td>
            <td><?php
              if ($url == 'non-user-schools-list') : ?>
              <a class="text-xs btn btn-success d-block" href="<?php echo CreateCustomGetURL('new-school-user', $row['schoolid']); ?>" title="Add a user"><i class="fas fa-user-plus"></i></a>
              <?php else : ?>

              <?php endif; ?>
            </td>
          </tr>
          <?php } ?>  
        </tbody>

        <tfoot>
          <tr class="text-center align-middle">
            <th>School ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>District</th>
            <th>Cluster</th>
            <th>Action</th>
          </tr>
        </tfoot>
      </table><!-- table -->
    </div><!-- .table-responsive -->
  </div><!-- .card-body -->
</div><!-- .card -->
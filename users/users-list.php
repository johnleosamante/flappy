<?php
# users/user-list.php

$portal = str_replace('-users', '', $url);
$school = false;

if ($portal == 'school') {
  $title = 'Division Schools';
  $school = true;
} else {
  $title = DatabaseFetchArray(RetrieveSection($portal))[0];
  $school = false;
}
?>

<div class="card border-left-primary shadow mb-4">
  <div class="card-header py-3">
    <?php AddContentTitle($title, true, CreateCustomURL('users')); ?>
  </div>

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-striped table-hover table-bordered mb-0" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr class="text-center align-middle">
          <?php if ($school) : ?>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Last Login</th>
            <th>Action</th>
          <?php else : ?>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Position</th>
            <th>Last Login</th>
            <th>Action</th>
          <?php endif; ?>
          </tr>
        </thead>
                                    
        <tbody>
        <?php
        include_once('functions/database/user.php');
        
        if ($school) {
          $query = RetrieveSchoolUsers();
          while ($row = DatabaseFetchArray($query)) : ?>
          <tr>
            <td class="text-center"><?php echo $row['id']; ?></td>
            <td><?php echo $row['school']; ?></td>
            <td class="text-center"><?php echo $row['username']; ?></td>
            <td class="text-center"><?php echo $row['lastlogin']; ?></td>
            <td>
              <a class="text-xs btn btn-success d-block" href="<?php echo CreateCustomGetURL('view-user', $row['id']); ?>" title="View User"><i class="fas fa-eye"></i></a>
            </td>
          </tr>
          <?php endwhile;
        } else {
          include_once('functions/strings.php');
          $query = RetrieveUsersInformation($portal);
          $no = 0;
          while ($row = DatabaseFetchArray($query)) { 
            $no++;  
          ?>
          <tr>
            <td class="text-center"><?php echo $no; ?></td>
            <td class="text-uppercase"><?php echo ToName($row['lastname'], $row['firstname'], $row['middlename'], $row['extension']); ?></td>
            <td class="text-center"><?php echo $row['username']; ?></td>
            <td class="text-center"><?php echo $row['position']; ?></td>
            <td class="text-center"><?php echo $row['lastlogin']; ?></td>
            <td>
              <a class="text-xs btn btn-success d-block" href="<?php echo CreateCustomGetURL('view-user', $row['id']); ?>" title="View User"><i class="fas fa-eye"></i></a>
            </td>
          </tr>
          <?php }
        } ?>
        </tbody>

        <thead>
          <tr class="text-center align-middle">
          <?php if ($school) : ?>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Last Login</th>
            <th>Action</th>
          <?php else : ?>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Position</th>
            <th>Last Login</th>
            <th>Action</th>
          <?php endif; ?>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>
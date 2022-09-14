<?php
# layout/error.php

include_once('../functions/functions.php');

$code = http_response_code();
$error = '';

switch ($code) {
  case '400':
    $error = 'Bad Request';
    break;
  case '401':
    $error = 'Unauthorized Access';
    break;
  case '403':
    $error = 'Forbidden Access';
    break;
  case '404':
    $error = 'Page Not Found';
    break;
  case '408':
    $error = 'Request Timed Out';
    break;
  case '500':
    $error = 'Internal Server Error';
    break;
  default:
    $error = 'Ooops!';
}

$page = $error;
include_once('../layout/header.php');
?>
</head>

<body>
  <div id="layoutAuthentication" class="container min-vh-100">
    <div id="layoutAuthentication_content" class="d-flex justify-content-center align-items-center">
      <div class="row">
        <div class="text-center">
          <h1 class="error mx-auto" data-text="<?php echo $code; ?>"><?php echo $code; ?></h1>
          <p class="lead text-gray-800 mb-4"><?php echo $error; ?></p>
          <p class="text-gray-500 mb-0 px-3">An error has been encountered.</p>
          <p class="text-gray-500 mb-3 px-3">Please go back to the home page instead.</p>
          <a class="btn btn-secondary rounded" href="<?php echo GetURL(); ?>" title="Go to DepEd Dipolog City Data Management System Home Page">Home</a>
        </div>
      </div>
    </div>

    <div id="layoutAuthentication_footer">
      <?php include_once('../layout/footer.php'); ?>
    </div>
  </div>

  <?php include_once('../layout/javascripts.php'); ?>
</body>
</html>
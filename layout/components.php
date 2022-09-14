<?php
# layout/elements.php

function AddCard($title, $link, $icon, $color='primary', $counter=false, $number=0) {
  echo '<div class="col-xl-3 col-md-6 mb-4">';
    echo '<div class="card border-left-' . $color . ' shadow h-100">';
      echo '<div class="card-body">';
        echo '<div class="row no-gutters align-items-center">';
          echo '<div class="col mr-2">';
            echo '<div class="font-weight-bold text-' . $color . ' text-uppercase mb-1">' . $title . '</div>';
            if ($counter) {
            echo '<div class="h3 mb-0 font-weight-bold text-gray-800">' . $number . '</div>';
            }
          echo '</div>';

          echo '<div class="col-auto">';
            echo '<i class="fas ' . $icon . ' fa-3x text-' . $color . '" aria="hidden"></i>';
          echo '</div>';
        echo '</div>';
      echo '</div>';

      echo '<div class="card-footer py-1 text-right">';
        echo '<a class="small" href="' . $link . '">View Details</a>';
      echo '</div>';
    echo '</div>';
  echo '</div>';
}

function AddContentTitle($title, $withbutton=false, $link='', $text='Back', $icon='fa-arrow-circle-left') {
  echo '<div class="d-sm-flex align-items-center justify-content-between">';
    echo '<h3 class="h3 mb-0 text-gray-800">' . $title . '</h3>';
    if ($withbutton) {
    echo '<a href="' . $link . '" class="btn btn-primary btn-icon-split btn-sm">';
      echo '<span class="icon text-white-50">';
        echo '<i class="fas ' . $icon . '"></i>';
      echo '</span>';
      echo '<span class="text">' . $text . '</span>';
    echo '</a>';
    }
  echo '</div>';
}

function AddNavigationItem($condition, $link, $title, $icon='') {
  $class = $condition ? ' active' : '';
  echo '<li class="nav-item' . $class . '">';
    echo '<a class="nav-link" href="' . $link . '">';
      echo '<i class="fas fa-fw ' . $icon . '"></i>';
      echo '<span>' . $title . '</span>';
    echo '</a>';
  echo '</li>';
}
?>
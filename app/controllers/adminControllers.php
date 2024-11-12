<?php
// app/controllers/AdminController.php

class AdminController {
  public function dashboard() {
      require '../app/views/admin/adminDashboard.php';
  }

  public function analytics() {
      require '../app/views/admin/adminAnalytics.php';
  }

  public function jobs() {
      require '../app/views/admin/adminJobs.php';
  }

  public function jobSeekers() {
      require '../app/views/admin/adminJobSeekers.php';
  }

  public function application() {
      require '../app/views/admin/adminApplication.php';
  }
}

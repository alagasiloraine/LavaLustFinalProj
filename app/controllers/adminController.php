<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class adminController extends Controller{
  public function dashboard() {
       $this->call->view('admin/adminDashboard');
  }

  public function analytics() {
    $this->call->view('admin/adminAnalytics');
  }

  public function jobs() {
    $this->call->view('admin/adminJobs');
  }

  public function jobSeekers() {
    $this->call->view('admin/adminJobSeekers');
  }

  public function application() {
    $this->call->view('admin/adminApplication');
  }

  public function addJobs(){
    try {

        $data = array(
            'employer_id' => 1, // Assuming you are using a fixed ID here
            'title' => $this->io->post['job_title'],
            'description' => $this->io->post['job_description'],
            'requirements' => $this->io->post['expertise'],
            'location' => $this->io->post['location'],
            'job_type' => $this->io->post['job_type'],
            'salary' => $this->io->post['salary'],
            'experience' => $this->io->post['experience'],
            'posted_at' => date('Y-m-d H:i:s'),
            'status' => 'active',
        );

    } catch (\Exception $e) {

    }
  }
}

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
     // Retrieve jobs with employer details
     $jobs = $this->db->table('jobs as j')
     ->join('employers as e', 'j.employer_id = e.employer_id') // Join with employers table
     ->join('users as u', 'e.user_id = u.id') // Join with users table (optional if needed)
     ->select(
         'j.job_id, j.title, j.description, j.requirements, j.location, 
         j.job_type, j.salary, j.posted_at, j.status, 
         e.company_name, e.contact_info, e.company_address, e.profile_picture, 
         u.email as employer_email' // Include fields from the employer and user
     )
     ->get_all();

    //  var_dump($jobs);
    //  die();

    $this->call->view('admin/adminJobs', ['jobs' => $jobs]);
  }

  public function jobSeekers() {
    $this->call->view('admin/adminJobSeekers');
  }

  public function application() {
    $this->call->view('admin/adminApplication');
  }

}

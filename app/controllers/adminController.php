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
         j.job_type, j.salary, j.posted_at, j.status, j.inactive_timestamp, 
         e.company_name, e.contact_info, e.company_address, e.profile_picture, 
         u.email as employer_email' // Include fields from the employer and user
     )
     ->get_all();

    $this->call->view('admin/adminJobs', ['jobs' => $jobs]);
  }

  public function jobSeekers() {
    $this->call->view('admin/adminJobSeekers');
  }

  public function application() {
    $this->call->view('admin/adminApplication');
  }

  public function deleteJob($job_id) {
    if (!isset($_SESSION['user_id'])) {
        redirect('auth/login'); // Redirect to login if user is not authenticated
    }

    if (!$job_id || !is_numeric($job_id)) {
        die('Invalid Job ID.');
    }

    // Check if job exists
    $job = $this->db->table('jobs')->where('job_id', $job_id)->get();
    if (!$job) {
        die('Job not found.');
    }

    // Check if there are any applications for this job
    $applications = $this->db->table('job_applications')->where('job_id', $job_id)->get();
    if ($applications) {
        $_SESSION['error'] = 'This job post cannot be deleted because there are existing applications.';
        redirect('admin/jobs'); // Redirect to the job posts page
        return; // Exit function if there are applications
    }

    // Proceed with deletion if no applications are found
    $result = $this->db->table('jobs')->where('job_id', $job_id)->delete();

    if ($result) {
        $_SESSION['success'] = 'Job post deleted successfully!';
        redirect('admin/jobs'); // Redirect to the job posts page
    } else {
        $_SESSION['error'] = 'Failed to delete the job post. Please try again.';
        redirect('admin/jobs'); // Redirect to the job posts page
    }
  }

}

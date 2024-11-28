<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class adminController extends Controller{
  public function dashboard() {
       $this->call->view('admin/adminDashboard');
  }

  public function employer() {
    $employers = $this->db->table('users as u')
        ->left_join('employers as e', 'u.id = e.user_id') // Join users with employers
        ->left_join('jobs as jp', 'e.employer_id = jp.employer_id') // Join with jobs where the employer has posted jobs
        ->where('u.role', 'employer') // Only show employers
        ->select('u.id as user_id, u.email as user_email, u.status, u.username as user_name, 
                  e.employer_id, e.company_name, e.contact_info, e.company_address, e.profile_picture, 
                  jp.job_id as posted_job_id, jp.title as posted_job_title, jp.description as posted_job_description, jp.requirements,jp.location,jp.job_type,
                  jp.salary')
        ->get_all();

    $employersGrouped = [];
    foreach ($employers as $employer) {
        $userId = $employer['user_id'];

        if (!isset($employersGrouped[$userId])) {
            $employersGrouped[$userId] = [
                'user_id' => $employer['user_id'],
                'user_email' => $employer['user_email'],
                'status' => $employer['status'],
                'user_name' => $employer['user_name'],
                'employer_id' => $employer['employer_id'],
                'company_name' => $employer['company_name'],
                'contact_info' => $employer['contact_info'],
                'company_address' => $employer['company_address'],
                'profile_picture' => $employer['profile_picture'],
                'posted_jobs' => [] // Initialize an empty array for posted jobs
            ];
        }

        if (!empty($employer['posted_job_id'])) {
            $employersGrouped[$userId]['posted_jobs'][] = [
                'job_id' => $employer['posted_job_id'],
                'title' => $employer['posted_job_title'],
                'description' => $employer['posted_job_description'],
                'requirements' => $employer['requirements'],
                'location' => $employer['location'],
                'job_type' => $employer['job_type'],
                'salary' => $employer['salary'],
            ];
        }
      }

    $this->call->view('admin/adminEmployer', [
        'employers' => $employersGrouped
    ]);
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
    $jobSeekers = $this->db->table('users as u')
                ->left_join('job_seekers as js', 'u.id = js.user_id') // Join users with job_seekers
                ->left_join('job_applications as ja', 'js.seeker_id = ja.jobseeker_id AND ja.status = "Hired"') // Join with job_applications where hired
                ->left_join('jobs as j', 'ja.job_id = j.job_id') // Join with jobs
                ->where('u.role', 'jobseeker') // Only show job seekers
                ->select('u.id as user_id, u.email as user_email, u.status, u.username as user_name, js.seeker_id, js.full_name, js.skills, js.resume, js.education, js.experience, js.location, js.availability, js.profile_picture, js.phone, j.title as hired_job_title, j.description as hired_job_description')
                ->get_all();


    $this->call->view('admin/adminJobSeekers', [
        'jobSeekers' => $jobSeekers
    ]);
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

    $job = $this->db->table('jobs')->where('job_id', $job_id)->get();
    if (!$job) {
        die('Job not found.');
    }

    $applications = $this->db->table('job_applications')->where('job_id', $job_id)->get();
    if ($applications) {
        $_SESSION['error'] = 'This job post cannot be deleted because there are existing applications.';
        redirect('admin/jobs'); // Redirect to the job posts page
        return; // Exit function if there are applications
    }

    $result = $this->db->table('jobs')->where('job_id', $job_id)->delete();

    if ($result) {
        $_SESSION['success'] = 'Job post deleted successfully!';
        redirect('admin/jobs'); // Redirect to the job posts page
    } else {
        $_SESSION['error'] = 'Failed to delete the job post. Please try again.';
        redirect('admin/jobs'); // Redirect to the job posts page
    }
  }

  public function downloadResume($resume) {
        $path = "uploads/resumes/" . $resume;

        if (file_exists($path)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($path) . '"');
            header('Content-Length: ' . filesize($path));
            header('Pragma: public');
            flush(); // Flush system output buffer
            readfile($path);
            redirect('admin/jobseekers');
        } else {
            echo 'Resume file not found';
            exit;
        }
    
  }

  public function deactivateUser($user_id) {
    $currentStatus = $this->db->table('users')
                    ->select('status')
                    ->where('id', $user_id)
                    ->get(); // Get the 'status' value directly


    if ($currentStatus['status'] == 'active'){
      $result = $this->db->table('users')
                ->where('id', $user_id)
                ->update(['status' => 'inactive']);
    } else {
      $result = $this->db->table('users')
                ->where('id', $user_id)
                ->update(['status' => 'active']);
    }

    if ($result) {
        $_SESSION['success'] = "User status updated successfully!";
    } else {
        $_SESSION['error'] = 'Failed to update user status. Please try again.';
    }

    redirect('admin/jobseekers');
}

}

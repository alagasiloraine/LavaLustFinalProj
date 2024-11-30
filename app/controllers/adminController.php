<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class adminController extends Controller{
  public function dashboard() {
    $currentWeek = [
      'employers' => $this->db->table('employers')->select('employer_id, created_at')->get_all(),
      'users' => $this->db->table('users')->select('id, created_at')->get_all(),
      'jobSeekers' => $this->db->table('job_seekers')->select('seeker_id, created_at')->get_all(),
      'appliedApplications' => $this->db->table('job_applications')->where('status', 'Applied')->select('id, applied_at')->get_all(),
      'hiredApplications' => $this->db->table('job_applications')->where('status', 'Hired')->select('id, updated_at')->get_all(),
      'jobs' => $this->db->table('jobs')->where('status', 'active')->select('job_id, posted_at')->get_all(),
      'inactiveJobs' => $this->db->table('jobs')->where('status', 'inactive')->select('job_id, posted_at')->get_all(),
    ];

    $previousWeek = [
      'jobSeekers' => $this->db->table('job_seekers')->where('created_at', '>=', date('Y-m-d', strtotime('-1 week')))->get(),
      'employers' => $this->db->table('employers')->where('created_at', '>=', date('Y-m-d', strtotime('-1 week')))->get(),
      'users' => $this->db->table('users')->where('created_at', '>=', date('Y-m-d', strtotime('-1 week')))->get(),
      'appliedApplications' => $this->db->table('job_applications')->where('applied_at', '>=', date('Y-m-d', strtotime('-1 week')))->get(),
      'hiredApplications' => $this->db->table('job_applications')->where('updated_at', '>=', date('Y-m-d', strtotime('-1 week')))->get(),
      'jobs' => $this->db->table('jobs')->where('posted_at', '>=', date('Y-m-d', strtotime('-1 week')))->get(),
      'inactiveJobs' => $this->db->table('jobs')->where('posted_at', '>=', date('Y-m-d', strtotime('-1 week')))->get(),
    ];

    $currentWeekCounts = [
        'jobSeekers' => count($currentWeek['jobSeekers']),
        'employers' => count($currentWeek['employers']),
        'users' => count($currentWeek['users']),
        'jobs' => count($currentWeek['jobs']),
        'appliedApplications' => count($currentWeek['appliedApplications']),
        'hiredApplications' => count($currentWeek['hiredApplications']),
        'inactiveJobs' => count($currentWeek['inactiveJobs']),
    ];

    $previousWeekCounts = [
        'jobSeekers' => count($previousWeek['jobSeekers']),
        'employers' => count($previousWeek['employers']),
        'users' => count($previousWeek['users']),
        'jobs' => count($previousWeek['jobs']),
        'appliedApplications' => count($previousWeek['appliedApplications']),
        'hiredApplications' => count($previousWeek['hiredApplications']),
        'inactiveJobs' => count($previousWeek['inactiveJobs']),
    ];

    function calculateRate($current, $previous) {
        if ($previous == 0) {
            return 0;  // To avoid division by zero
        }
        return (($current - $previous) / $previous) * 100;
    }

    $rates = [
        'jobSeekersRate' => calculateRate($currentWeekCounts['jobSeekers'], $previousWeekCounts['jobSeekers']),
        'jobsRate' => calculateRate($currentWeekCounts['jobs'], $previousWeekCounts['jobs']),
        'employersRate' => calculateRate($currentWeekCounts['employers'], $previousWeekCounts['employers']),
        'usersRate' => calculateRate($currentWeekCounts['users'], $previousWeekCounts['users']),
        'appliedRate' => calculateRate($currentWeekCounts['appliedApplications'], $previousWeekCounts['appliedApplications']),
        'hiredRate' => calculateRate($currentWeekCounts['hiredApplications'], $previousWeekCounts['hiredApplications']),
        'inactiveJobsRate' => calculateRate($currentWeekCounts['inactiveJobs'], $previousWeekCounts['inactiveJobs']),
    ];

      $startDate = date('Y-m-d', strtotime('-7 days'));
      $endDate = date('Y-m-d');
  
      $applications = $this->db->table('job_applications')
                    ->select('DATE(job_applications.applied_at) AS application_date, COUNT(job_applications.id) AS application_count')
                    ->where('job_applications.status', 'Applied')
                    ->where('DATE(job_applications.applied_at)', '>=', $startDate) // Ensures only the date part is used
                    ->where('DATE(job_applications.applied_at)', '<=', $endDate)  // Ensures only the date part is used
                    ->group_by('application_date')
                    ->order_by('application_date', 'ASC')
                    ->get_all();

  
      if (is_object($applications)) {
          $applications = $applications->getResultArray(); // Convert result to an array
      }

      $applicationsByCategory = $this->db->table('jobs')
                            ->select('jobs.category AS job_category, COUNT(job_applications.id) AS applications')
                            ->left_join('job_applications', 'job_applications.job_id = jobs.job_id AND job_applications.status = "Applied"')  // LEFT JOIN ensures categories without applications are included
                            ->group_by('jobs.category')
                            ->get_all();

    $this->call->view('admin/adminDashboard', [
        'currentWeek' => $currentWeekCounts, 
        'previousWeek' => $previousWeekCounts,
        'applications' => $applications,
        'applicationsByCategory' => $applicationsByCategory,
        'rates' => $rates
    ]);

  }

  public function test()
  {

    $applicationsByCategory = $this->db->table('jobs')
                      ->select('jobs.category AS job_category, COUNT(job_applications.id) AS application_count')
                      ->left_join('job_applications', 'job_applications.job_id = jobs.job_id AND job_applications.status = "Applied"')  // LEFT JOIN ensures categories without applications are included
                      ->group_by('jobs.category')
                      ->get_all();


  
      $this->call->view('admin/test', [
          'applicationsByCategory' => $applicationsByCategory,
      ]);
  }
  
  

  public function employer() {
    $employers = $this->db->table('users as u')
        ->left_join('employers as e', 'u.id = e.user_id') 
        ->left_join('jobs as jp', 'e.employer_id = jp.employer_id')
        ->where('u.role', 'employer')
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
                'posted_jobs' => []
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
    $currentWeek = [
      'appliedApplications' => $this->db->table('job_applications')->where('status', 'Applied')->select('id, applied_at')->get_all(),
      'hiredApplications' => $this->db->table('job_applications')->where('status', 'Hired')->select('id, updated_at')->get_all(),
      'jobs' => $this->db->table('jobs')->where('status', 'active')->select('job_id, posted_at')->get_all(),
      'inactiveJobs' => $this->db->table('jobs')->where('status', 'inactive')->select('job_id, posted_at')->get_all(),
    ];

    $previousWeek = [
      'appliedApplications' => $this->db->table('job_applications')->where('applied_at', '>=', date('Y-m-d', strtotime('-1 week')))->get(),
      'hiredApplications' => $this->db->table('job_applications')->where('updated_at', '>=', date('Y-m-d', strtotime('-1 week')))->get(),
      'jobs' => $this->db->table('jobs')->where('posted_at', '>=', date('Y-m-d', strtotime('-1 week')))->get(),
      'inactiveJobs' => $this->db->table('jobs')->where('posted_at', '>=', date('Y-m-d', strtotime('-1 week')))->get(),
    ];

    $currentWeekCounts = [
        'jobs' => count($currentWeek['jobs']),
        'appliedApplications' => count($currentWeek['appliedApplications']),
        'hiredApplications' => count($currentWeek['hiredApplications']),
        'inactiveJobs' => count($currentWeek['inactiveJobs']),
    ];

    $previousWeekCounts = [
        'jobs' => count($previousWeek['jobs']),
        'appliedApplications' => count($previousWeek['appliedApplications']),
        'hiredApplications' => count($previousWeek['hiredApplications']),
        'inactiveJobs' => count($previousWeek['inactiveJobs']),
    ];

    function calculateRates($current, $previous) {
        if ($previous == 0) {
            return 0;  // To avoid division by zero
        }
        return (($current - $previous) / $previous) * 100;
    }

    $rates = [
        'jobsRate' => calculateRates($currentWeekCounts['jobs'], $previousWeekCounts['jobs']),
        'appliedRate' => calculateRates($currentWeekCounts['appliedApplications'], $previousWeekCounts['appliedApplications']),
        'hiredRate' => calculateRates($currentWeekCounts['hiredApplications'], $previousWeekCounts['hiredApplications']),
        'inactiveJobsRate' => calculateRates($currentWeekCounts['inactiveJobs'], $previousWeekCounts['inactiveJobs']),
    ];

    $applicationsByStatus = $this->db->table('job_applications')
            ->select('job_applications.status, COUNT(job_applications.id) AS application_count')
            ->where('job_applications.status = ? OR job_applications.status = ? OR job_applications.status = ? OR job_applications.status = ?', ['Hired', 'Applied', 'Scheduled', 'Rejected'])  // Using the where_in method with an array of statuses
            ->group_by('job_applications.status')
            ->get_all();

    $applicationsByCategoryAndDate = $this->db->table('job_applications')
            ->select('jobs.category AS job_category, DATE(job_applications.applied_at) AS application_date, COUNT(job_applications.id) AS application_count')
            ->join('jobs', 'job_applications.job_id = jobs.job_id')  // Join the job table to get the category
            ->group_by(['jobs.category', 'DATE(job_applications.applied_at)'])  // Group by category and date
            ->order_by('application_date', 'ASC')  // Order by date
            ->get_all();

    $jobsByType = $this->db->table('jobs')
            ->select('job_type, COUNT(job_id) AS job_count')
            ->group_by('job_type')
            ->get_all();


    $this->call->view('admin/adminAnalytics', [
        'currentWeek' => $currentWeekCounts, 
        'previousWeek' => $previousWeekCounts,
        'applicationsByStatus' => $applicationsByStatus,
        'applicationsByCategoryAndDate' => $applicationsByCategoryAndDate,
        'jobsByType' => $jobsByType,
        'rates' => $rates
    ]);
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

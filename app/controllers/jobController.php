<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');


class JobController extends Controller {

    public function jobPost() {
        if (!isset($_SESSION['user_id'])) {
            redirect('auth/login');  
        }
    
        $user_id = $_SESSION['user_id'];

        // var_dump($user_id);
        // die();
    
        $employer = $this->db->table('employers')
            ->select('employer_id')
            ->where('user_id', $user_id)
            ->get();
    
        if (!$employer) {
            $_SESSION['toastr'] = ['type' => 'error', 'message' => 'Set up your profile First.'];
            redirect('home');
        }

        // var_dump($employer);
        // die();
    
        $data = [
            'title' => $this->io->post('title'),
            'description' => $this->io->post('description'),
            'requirements' => $this->io->post('requirements'),
            'location' => $this->io->post('location'),
            'job_type' => $this->io->post('job_type'),
            'posted_at' => date('Y-m-d H:i:s'),
            'salary' => $this->io->post('salary'),
            'category' => $this->io->post('category'),
            'status' => $this->io->post('status'),
            'employer_id' => $employer['employer_id'], 
        ];
    
    
        if ($this->db->table('jobs')->insert($data)) {
            $_SESSION['toastr'] = ['type' => 'success', 'message' => 'Job posted successfully!'];
        } else {
            $_SESSION['toastr'] = ['type' => 'error', 'message' => 'Failed to post job. Please try again.'];
        }
    
        redirect('/jobs');
    }
    
    public function getJob() {
        if (!isset($_SESSION['user_id'])) {
            redirect('auth/login');
        }
    
        $user_id = $_SESSION['user_id'];
    
        $user = $this->db->select('seeker_id')
                         ->table('job_seekers')
                         ->where('user_id', $user_id)
                         ->get();
    
        $jobs = $this->db->table('jobs as j')
                         ->join('employers as e', 'j.employer_id = e.employer_id')
                         ->join('users as u', 'u.id = e.user_id') 
                         ->select('j.job_id, j.title, j.description, j.requirements, j.location, j.job_type, j.salary, j.posted_at, j.category, j.status, e.company_name, e.contact_info, e.profile_picture')
                         ->get_all();

        $applications = $this->db->table('job_applications')
                         ->select('status')
                         ->where('jobseeker_id', $user['seeker_id']) 
                         ->get();

        $save = $this->db->table('saved_jobs')
                        ->where('jobseeker_id', $user['seeker_id'])
                        ->get();
                        
        $this->call->view('user/employer/jobLists', ['jobs' => $jobs, 'user' => $user, 'applications' => $applications]);
    }
    
    public function jobPosts()
    {
        if (!isset($_SESSION['user_id'])) {
            redirect('auth/login');
        }

        $user_id = $_SESSION['user_id'];

        $user_details = $this->db->select('*')
            ->table('users')
            ->where('id', $user_id)
            ->get();

        $jobs = $this->db->table('jobs as j')
            ->join('employers as e', 'j.employer_id = e.employer_id')
            ->join('users as u', 'u.id = e.user_id')
            ->where('u.id', $user_id)
            ->select('j.job_id, j.title, j.description, j.requirements, j.location, j.job_type, j.salary, j.posted_at, j.status')
            ->get_all();

        $count = $this->db->table('jobs as j')
                ->join('job_applications as ja', 'j.job_id = ja.job_id')
                ->join('employers as e', 'j.employer_id = e.employer_id')
                ->join('users as u', 'u.id = e.user_id')
                ->where('u.id', $user_id)
                ->select('j.job_id, count(ja.id) as application_count, ja.status')
                ->group_by('j.job_id, ja.status')
                ->get_all();

        $this->call->view('user/employer/jobPost', [
            'jobs' => $jobs,
            'user' => $user_details,
            'counts' => $count,
        ]);
    }

    public function updateJobPost($job_id)
    {
        if (!isset($_SESSION['user_id'])) {
            redirect('auth/login');
        }
    
        if (!$job_id || !is_numeric($job_id)) {
            die('Invalid Job ID.');
        }
    
        $current_job = $this->db->table('jobs')->where('job_id', $job_id)->get();
    
        if (!$current_job) {
            die('Job not found.');
        }
    
        $title = $this->io->post('title');
        $description = $this->io->post('description');
        $requirements = $this->io->post('requirements');
        $location = $this->io->post('location');
        $salary = $this->io->post('salary');
        $category = $this->io->post('category');
        $job_type = $this->io->post('job_type');
        $status = $this->io->post('status');
    
        // Prepare the update data
        $data = [
            'title' => !empty($title) ? $title : $current_job['title'],
            'description' => !empty($description) ? $description : $current_job['description'],
            'requirements' => !empty($requirements) ? $requirements : $current_job['requirements'],
            'location' => !empty($location) ? $location : $current_job['location'],
            'salary' => !empty($salary) ? $salary : $current_job['salary'],
            'category' => !empty($category) ? $category : $current_job['category'],
            'job_type' => !empty($job_type) ? $job_type : $current_job['job_type'],
            'status' => !empty($status) ? $status : $current_job['status'],
            'updated_at' => date('Y-m-d H:i:s') // Track when the job was updated
        ];
    
        // Check if the status is being updated to "inactive"
        if ($status === 'inactive' && $current_job['status'] !== 'inactive') {
            $data['inactive_timestamp'] = date('Y-m-d H:i:s');
        }
    
        $result = $this->db->table('jobs')->where('job_id', $job_id)->update($data);
    
        if ($result) {
            $_SESSION['success'] = 'Job post updated successfully!';
            redirect('user/employer/jobPosts');
        } else {
            $_SESSION['error'] = 'Failed to update job post. Please try again.';
            redirect('user/employer/jobPosts');
        }
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
            redirect('user/employer/jobPosts'); // Redirect to the job posts page
            return; // Exit function if there are applications
        }
    
        // Proceed with deletion if no applications are found
        $result = $this->db->table('jobs')->where('job_id', $job_id)->delete();
    
        if ($result) {
            $_SESSION['success'] = 'Job post deleted successfully!';
            redirect('user/employer/jobPosts'); // Redirect to the job posts page
        } else {
            $_SESSION['error'] = 'Failed to delete the job post. Please try again.';
            redirect('user/employer/jobPosts'); // Redirect to the job posts page
        }
    }
    
    public function saveJob() {
        
        if (!isset($_SESSION['user_id'])) {
            redirect('auth/login');  
        }
    
        $user_id = $_SESSION['user_id'];
    
        $user = $this->db->select('seeker_id')
                ->table('job_seekers')
                ->where('user_id', $user_id)
                ->get();

        $job = $this->io->post('job_id');

        if ($this->db->table('saved_jobs')->where('job_id', $job)->get()) {
            $this->db->table('saved_jobs')->where('job_id', $job)->delete();
        } else {
            $data = [
                'job_id' => $this->io->post('job_id'),
                'jobseeker_id' => $user['seeker_id'],
                'created_at' => date('Y-m-d H:i:s'),
            ];
    
            if ($this->db->table('saved_jobs')->insert($data)){
                $_SESSION['toastr'] = ['type' => 'success', 'message' => 'Job saved successfully!'];
                echo json_encode(['status' => 'success', 'message' => 'Job saved successfully.']);
                redirect('jobs');
            } else {
                $_SESSION['toastr'] = ['type' => 'error', 'message' => 'Failed to save job. Please try again.'];
                echo json_encode(['status' => 'error','message' => 'Failed to save job. Please try again.']);
                redirect('jobs');
            }
        }

        redirect('jobs');
    }

    public function savedJobs() {
        if (!isset($_SESSION['user_id'])) {
            redirect('auth/login');
        }

        $user_id = $_SESSION['user_id'];

        $user_details = $this->db->select('*')
                        ->table('users')
                        ->where('id', $user_id)
                        ->get();
    
        $user = $this->db->select('seeker_id')
                ->table('job_seekers')
                ->where('user_id', $user_id)
                ->get();

        $applications = $this->db->table('job_applications as j')
                ->join('job_seekers as s', 'j.jobseeker_id = s.seeker_id')
                ->join('users as u', 'u.id = s.user_id')
                ->select('j.id, j.job_id, j.employer_id, j.first_name, j.last_name, j.status, j.jobseeker_id')
                ->get_all();

                

        
        $savedJobs =  $this->db->table('jobs as j')
                    ->join('employers as e', 'j.employer_id = e.employer_id')
                    ->join('saved_jobs as s', 's.job_id = j.job_id')
                    // ->where('job_id', $result['job_id'])
                    ->select('j.job_id, j.title, j.description, j.requirements, j.location, j.job_type, j.salary, j.posted_at, j.status, e.company_name, e.contact_info')
                    ->get_all();


        $this->call->view('user/jobSeeker/savedJob', [
            'savedJobs' => $savedJobs,
            'user' => $user_details,
            'applications' => $applications
        ]);
    }
    
}
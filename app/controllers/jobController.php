<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');


class JobController extends Controller {

    public function jobs() {

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
                                ->select('j.job_id, j.title, j.description, j.requirements, j.location, j.job_type, j.salary, j.posted_at, j.status, e.company_name, e.contact_info')
                                ->get_all(); 

        $this->call->view('homepage',[
            'user' => $user_details,
            'jobs' => $jobs
        ]);
    }

    public function jobPost() {
        if (!isset($_SESSION['user_id'])) {
            redirect('auth/login');  
        }
    
        $user_id = $_SESSION['user_id'];
    
        $employer = $this->db->table('employers as e')
            ->join('users as u', 'u.id = e.user_id')
            ->select('e.employer_id')
            ->where('u.id', $user_id)
            ->get();
    
        if (!$employer) {
            die('Employer not found for this user');
        }
    
        $data = [
            'title' => $this->io->post('title'),
            'description' => $this->io->post('description'),
            'requirements' => $this->io->post('requirements'),
            'location' => $this->io->post('location'),
            'job_type' => $this->io->post('job_type'),
            'posted_at' => date('Y-m-d H:i:s'),
            'salary' => $this->io->post('salary'),
            'status' => $this->io->post('status'),
            'employer_id' => $employer['employer_id'], 
        ];
    
    
        if ($this->db->table('jobs')->insert($data)) {
            $_SESSION['toastr'] = ['type' => 'success', 'message' => 'Job posted successfully!'];
        } else {
            $_SESSION['toastr'] = ['type' => 'error', 'message' => 'Failed to post job. Please try again.'];
        }
    
        redirect('home');
    }
    
    public function getJob() {
        $jobs = $this->db->table('jobs as j')
            ->join('employers as e', 'j.employer_id = e.employer_id')
            ->join('users as u', 'u.id = e.user_id') 
            ->select('j.job_id, j.title, j.description, j.requirements, j.location, j.job_type, j.salary, j.posted_at, j.status, e.company_name, e.contact_info')
            ->get_all(); 

        $this->call->view('user/employer/jobLists', ['jobs' => $jobs]);
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

        $this->call->view('user/employer/jobPost', ['jobs' => $jobs, 'user' => $user_details]);
    }

    public function updateJobPost($job_id)
    {
        // Ensure the user is logged in
        if (!isset($_SESSION['user_id'])) {
            redirect('auth/login');
        }

        // Validate the job ID
        if (!$job_id || !is_numeric($job_id)) {
            die('Invalid Job ID.');
        }

        // Retrieve the current job details
        $current_job = $this->db->table('jobs')->where('job_id', $job_id)->get();

        if (!$current_job) {
            die('Job not found.');
        }

        // Retrieve POST data
        $title = $this->io->post('title');
        $description = $this->io->post('description');
        $requirements = $this->io->post('requirements');
        $location = $this->io->post('location');
        $salary = $this->io->post('salary');
        $job_type = $this->io->post('job_type');
        $status = $this->io->post('status');

        // Build data array dynamically, preserving existing values if a field is null
        $data = [
            'title' => !empty($title) ? $title : $current_job['title'],
            'description' => !empty($description) ? $description : $current_job['description'],
            'requirements' => !empty($requirements) ? $requirements : $current_job['requirements'],
            'location' => !empty($location) ? $location : $current_job['location'],
            'salary' => !empty($salary) ? $salary : $current_job['salary'],
            'job_type' => !empty($job_type) ? $job_type : $current_job['job_type'],
            'status' => !empty($status) ? $status : $current_job['status'],
            'updated_at' => date('Y-m-d H:i:s') // Track when the job was updated
        ];

        // Update the job post in the database
        $result = $this->db->table('jobs')->where('job_id', $job_id)->update($data);

        // Set session message based on the result of the update
        if ($result) {
            $_SESSION['success'] = 'Job post updated successfully!';
            redirect('user/employer/jobPosts');
        } else {
            $_SESSION['error'] = 'Failed to update job post. Please try again.';
            redirect('user/employer/jobPosts');
        }
    }

    public function deleteJob($job_id) {
        // Ensure the user is logged in
        if (!isset($_SESSION['user_id'])) {
            redirect('auth/login'); // Redirect to login if user is not authenticated
        }
    
        // Validate the job ID
        if (!$job_id || !is_numeric($job_id)) {
            die('Invalid Job ID.');
        }
    
        // Check if the job exists in the database
        $job = $this->db->table('jobs')->where('job_id', $job_id)->get();
        if (!$job) {
            die('Job not found.');
        }
    
        // Attempt to delete the job post
        $result = $this->db->table('jobs')->where('job_id', $job_id)->delete();
    
        // Handle success or failure
        if ($result) {
            // Set a success message in the session
            $_SESSION['success'] = 'Job post deleted successfully!';
            redirect('user/employer/jobPosts'); // Redirect to the job posts page
        } else {
            // Set an error message in the session
            $_SESSION['error'] = 'Failed to delete the job post. Please try again.';
            redirect('user/employer/jobPosts'); // Redirect to the job posts page
        }
    }
    

    
    
}
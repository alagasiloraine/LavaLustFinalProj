<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');


class JobController extends Controller {

    // public function jobPost() {
    //     if (!isset($_SESSION['user_id'])) {
    //         redirect('auth/login');
    //     }
    
    //     $user_id = $_SESSION['user_id'];
    
    //     // Fetch employer_id for the logged-in user
    //     $employer = $this->db->table('employers as e')
    //         ->join('users as u', 'u.id = e.user_id')
    //         ->select('e.employer_id')
    //         ->where('u.id', $user_id)
    //         ->get();
    
    //     if (!$employer) {
    //         // Handle the case where employer_id is not found for the user
    //         die('Employer not found for this user');
    //     }
    
    //     $employer_id = $employer['employer_id'];
    
    //     // Prepare job data
    //     $data = [
    //         'title' => $this->io->post('title'),
    //         'description' => $this->io->post('description'),
    //         'requirements' => $this->io->post('requirements'),
    //         'location' => $this->io->post('location'),
    //         'job_type' => $this->io->post('job_type'),
    //         'posted_at' => date('Y-m-d H:i:s'),
    //         'salary' => $this->io->post('salary'),
    //         'status' => $this->io->post('status'),
    //         'employer_id' => $employer_id, // Add employer_id
    //     ];
    
    //     // Check if the logged-in employer owns the job post
    //     $job_id = $this->io->post('job_id'); // Assuming job_id is sent for updates
    //     if ($job_id) {
    //         $job = $this->db->table('jobs as j')
    //             ->join('employers as e', 'j.employer_id = e.employer_id')
    //             ->select('j.job_id')
    //             ->where('j.job_id', $job_id)
    //             ->where('e.employer_id', $employer_id)
    //             ->get();
    
    //         if (!$job) {
    //             // If the job doesn't belong to the logged-in employer, deny access
    //             die('Unauthorized action');
    //         }
    
    //         // Update job post
    //         $this->db->table('jobs')
    //             ->where('job_id', $job_id)
    //             ->update($data);
    //     } else {
    //         // Insert new job post
    //         $this->db->table('jobs')->insert($data);
    //     }
    
    //     redirect('home');
    // }


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
    
    
        $this->db->table('jobs')->insert($data);
    
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

        // var_dump($data);
        // die();

        // Update the job post in the database
        $result = $this->db->table('jobs')->where('job_id', $job_id)->update($data);

        // Check the result of the update operation
        if ($result) {
            // Redirect back to the job posts page with a success message
        //     $_SESSION['success'] = 'Job post updated successfully!';
            // $this->call->view('user/employer/jobPost');
            redirect('user/employer/jobPosts');
        } else {
            // Redirect back with an error message
            // $_SESSION['error'] = 'Failed to update job post. Please try again.';
            // $this->call->view('user/employer/jobPost');
            redirect('user/employer/jobPosts');

        }
    }

    public function deleteJob($job_id) {
        
        
    }

    
    
}
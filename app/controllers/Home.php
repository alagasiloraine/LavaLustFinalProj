<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Home extends Controller {

    public function __construct() {
        parent::__construct();
        
        if(! logged_in()) {
            redirect('auth');
        }
    }

	public function index() {
        if (!isset($_SESSION['user_id'])) {
            redirect('auth/login');  
        }
    
        $user_id = $_SESSION['user_id'];
    
        $user_details = $this->db->select('*')
                                 ->table('users')
                                 ->where('id', $user_id)
                                 ->get();

        // if ($user_details['status'] === 'inactive') {
        //     $_SESSION['error'] = 'Failed to update user status. Please try again.';
        //     $this->call->view('auth/login');
        // }
    
        // if ($user_details === false || empty($user_details)) {
        //     redirect('auth/login');
        // }

        // $user = $this->db->select('seeker_id')
        //                  ->table('job_seekers')
        //                  ->where('user_id', $user_id)
        //                  ->get();
    
        // $seeker_id = $user !== false && !empty($user) ? $user['seeker_id'] : null;
    
        // $applications = [];
        // if ($seeker_id) {
        //     $applications = $this->db->table('job_applications')
        //                              ->where('jobseeker_id', $seeker_id)
        //                              ->get_all();
        // }
    
        // $application = $this->db->table('job_applications as j')
        //                         ->join('job_seekers as s', 'j.jobseeker_id = s.seeker_id')
        //                         ->join('users as u', 'u.id = s.user_id')
        //                         ->select('j.id, j.job_id, j.employer_id, j.first_name, j.last_name, j.status, j.jobseeker_id')
        //                         ->get_all();
    
        // if ($application === false) {
        //     $application = [];
        // }

        // $saved_jobs = $this->db->table('saved_jobs')
        //         ->where('jobseeker_id', $seeker_id)
        //         ->get();

        // $jobs = $this->db->table('jobs as j')
        //                  ->join('employers as e', 'j.employer_id = e.employer_id')
        //                  ->join('users as u', 'u.id = e.user_id') 
        //                  ->select('j.job_id, j.title, j.description, j.requirements, j.location, j.job_type, j.salary, j.posted_at, j.category, j.status, e.company_name, e.contact_info')
        //                  ->get_all();
    
        // if ($jobs === false) {
        //     $jobs = []; 
        // }

        
        

        if ($user_details['role'] === 'admin') {
            redirect('admin/dashboard');
        } elseif ($user_details['isVerified'] === '0') { 
            redirect('auth/login');
        } else {
            $this->call->view('user/jobSeeker/homePage', [
                'user' => $user_details,
                // 'jobs' => $jobs,
                // 'application' => $application,
                // 'applications' => $applications,
                // 'saved_jobs' => $saved_jobs,
            ]);
        }

    }

    public function jobs() {
        if (!isset($_SESSION['user_id'])) {
            redirect('auth/login');  
        }
    
        $user_id = $_SESSION['user_id'];
    
        $user_details = $this->db->select('*')
                                 ->table('users')
                                 ->where('id', $user_id)
                                 ->get();

        // if ($user_details['status'] === 'inactive') {
        //     $_SESSION['error'] = 'Failed to update user status. Please try again.';
        //     $this->call->view('auth/login');
        // }
    
        if ($user_details === false || empty($user_details)) {
            redirect('auth/login');
        }

        $user = $this->db->select('seeker_id')
                         ->table('job_seekers')
                         ->where('user_id', $user_id)
                         ->get();
    
        $seeker_id = $user !== false && !empty($user) ? $user['seeker_id'] : null;
    
        $applications = [];
        if ($seeker_id) {
            $applications = $this->db->table('job_applications')
                                     ->where('jobseeker_id', $seeker_id)
                                     ->get_all();
        }
    
        $application = $this->db->table('job_applications as j')
                                ->join('job_seekers as s', 'j.jobseeker_id = s.seeker_id')
                                ->join('users as u', 'u.id = s.user_id')
                                ->select('j.id, j.job_id, j.employer_id, j.first_name, j.last_name, j.status, j.jobseeker_id')
                                ->get_all();
    
        if ($application === false) {
            $application = [];
        }

        $saved_jobs = $this->db->table('saved_jobs')
                ->where('jobseeker_id', $seeker_id)
                ->get();

        $jobs = $this->db->table('jobs as j')
                ->join('employers as e', 'j.employer_id = e.employer_id')
                ->join('users as u', 'u.id = e.user_id')
                ->select('j.job_id, j.title, j.description, j.requirements, j.location, j.job_type, j.salary, j.posted_at, j.category, j.status, e.company_name, e.contact_info, e.profile_picture')
                ->order_by('j.posted_at', 'DESC') // Order by latest
                ->get_all();
    
        if ($jobs === false) {
            $jobs = []; 
        }

        if ($user_details['role'] === 'admin') {
            redirect('admin/dashboard');
        } elseif ($user_details['isVerified'] === '0') { 
            redirect('auth/login');
        } else {
            $this->call->view('homepage', [
                'user' => $user_details,
                'user_role' => $user_details['role'],
                'jobs' => $jobs,
                'application' => $application,
                'applications' => $applications,
                'saved_jobs' => $saved_jobs,
            ]);
        }
    }
}
?>

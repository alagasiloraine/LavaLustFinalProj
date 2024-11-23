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
            $application = []; // Default to empty if no applications found
        }
    
        $jobs = $this->db->table('jobs as j')
                         ->join('employers as e', 'j.employer_id = e.employer_id')
                         ->join('users as u', 'u.id = e.user_id') // Optional: Include user details if needed
                         ->select('j.job_id, j.title, j.description, j.requirements, j.location, j.job_type, j.salary, j.posted_at, j.status, e.company_name, e.contact_info')
                         ->get_all();
    
        if ($jobs === false) {
            $jobs = []; // Default to empty if no jobs found
        }
    
        $this->call->view('homepage', [
            'user' => $user_details,
            'jobs' => $jobs,
            'application' => $application,
            'applications' => $applications,
        ]);
    }
    
}
?>

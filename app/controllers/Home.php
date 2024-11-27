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

        $jobs = $this->db->table('jobs as j')
                                ->join('employers as e', 'j.employer_id = e.employer_id')
                                ->join('users as u', 'u.id = e.user_id') // Optional: Include user details if needed
                                ->select('j.job_id, j.title, j.description, j.requirements, j.location, j.job_type, j.salary, j.posted_at, j.status, e.company_name, e.contact_info')
                                ->get_all();

        $this->call->view('user/jobSeeker/homePage', [
            'user' => $user_details,
            'jobs' => $jobs
        ]);

    }
}
?>

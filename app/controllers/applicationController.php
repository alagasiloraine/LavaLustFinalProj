<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class applicationController extends Controller {

    public function jobApply()
    {
        if (!isset($_SESSION['user_id'])) {
            redirect('auth/login');  
        }

        $user_id = $_SESSION['user_id'];

        $job_id = $this->io->post('job_id');


        $seeker_id = $this->db->table('job_seekers')
                ->select('seeker_id')
                ->where('user_id', $user_id)
                ->get();

        $employer_id = $this->db->table('jobs')
                ->select('employer_id')
                ->where('job_id', $job_id)
                ->get();    
        
        $data = [   
            'job_id' => $this->io->post('job_id'),
            'jobseeker_id' => $seeker_id['seeker_id'],
            'employer_id' => $employer_id['employer_id'],
            'first_name' => $this->io->post('first_name'),
            'last_name' => $this->io->post('last_name'),
            'email' => $this->io->post('email'),
            'status' => 'Applied',
            'applied_at' => date('Y-m-d H:i:s'),
        ];

        if (isset($_FILES['resume']) && $_FILES['resume']['error'] == 0) {
            $this->call->library('upload', $_FILES["resume"]);
            $this->upload
                ->max_size(5 * 1024) // 5MB size limit
                ->set_dir('uploads/resumes') // Directory to store the file
                ->allowed_extensions(['pdf', 'doc', 'docx']) // Allowed file types
                ->allowed_mimes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                ->encrypt_name(); // Encrypt the filename
    
            if ($this->upload->do_upload()) {
                $data['resume'] = $this->upload->get_filename();
            } else {
                $data['errors'] = $this->upload->get_errors();
                $this->call->view('upload_form', $data);
                return;
            }
        }

        if ($this->db->table('job_applications')->insert($data)) {
            $_SESSION['toastr'] = ['type' => 'success', 'message' => 'Apply successfully!'];
        } else {
            $_SESSION['toastr'] = ['type' => 'error', 'message' => 'Failed to Apply!'];
        }
    
        redirect('home');

        
    }

    public function getApplications() {
        if (!isset($_SESSION['user_id'])) {
            redirect('auth/login');  
        }
    
        $user_id = $_SESSION['user_id']; // Store logged-in user's ID

        $user_details = $this->db->select('*')
                        ->table('users')
                        ->where('id', $user_id)
                        ->get();
    
        $applications = $this->db->table('job_applications as j')
                        ->join('job_seekers as s', 'j.jobseeker_id = s.seeker_id')
                        ->join('jobs as job', 'j.job_id = job.job_id') // Join the jobs table for job details
                        ->join('employers as e', 'e.employer_id = job.employer_id') // Join the employers table for employer details
                        ->join('users as u', 'u.id = s.user_id') // User details for the jobseeker
                        ->select('j.id as application_id, j.job_id, job.title as job_title, job.description as job_description, job.salary, job.location, job.status as job_status, e.company_name, e.contact_info, j.status as application_status, j.applied_at as application_date, j.first_name, j.last_name, j.email, j.resume')
                        ->where('s.user_id', $user_id) // Get applications for the logged-in user
                        ->get_all();

        $this->call->view('user/jobSeeker/jobApplication', [
            'applications' => $applications,
            'user' => $user_details
        ]);
    }

    public function updateApplication($application_id) {
        if (!isset($_SESSION['user_id'])) {
            redirect('auth/login');  
        }

        if (!$application_id || !is_numeric($application_id)) {
            die('Invalid Job ID.');
        }

        $data = [
            'first_name' => $this->io->post('first_name'),
            'last_name' => $this->io->post('last_name'),
            'email' => $this->io->post('email'),
        ];

        if (isset($_FILES['resume']) && $_FILES['resume']['error'] == 0) {
            $this->call->library('upload', $_FILES["resume"]);
            $this->upload
                ->max_size(5 * 1024) // 5MB size limit
                ->set_dir('uploads/resumes') // Directory to store the file
                ->allowed_extensions(['pdf', 'doc', 'docx']) // Allowed file types
                ->allowed_mimes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                ->encrypt_name(); // Encrypt the filename
    
            if ($this->upload->do_upload()) {
                $data['resume'] = $this->upload->get_filename();
            } else {
                $data['errors'] = $this->upload->get_errors();
                $this->call->view('upload_form', $data);
                return;
            }
        }

        $result = $this->db->table('job_applications')->where('id', $application_id)->update($data);

        if ($result) {
            $_SESSION['toastr'] = ['type' =>'success','message' => 'Update successfully!'];
        } else {
            $_SESSION['toastr'] = ['type' => 'error','message' => 'Failed to Update!'];
        }

        redirect('user/jobseeker/jobApplication');

    }

    public function cancelApplication($application_id) {
        if (!isset($_SESSION['user_id'])) {
            redirect('auth/login');  
        }

        if (!$application_id || !is_numeric($application_id)) {
            die('Invalid Job ID.');
        }

        $data = [
            'status' => 'Cancelled',
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $result = $this->db->table('job_applications')->where('id', $application_id)->update($data);

        
        if ($result) {
            $_SESSION['toastr'] = ['type' =>'success','message' => 'Canceled successfully!'];
        } else {
            $_SESSION['toastr'] = ['type' => 'error','message' => 'Failed to Cancel!'];
        }

        redirect('user/jobseeker/jobApplication');
    }

    public function viewApplications()
    {
        if (!isset($_SESSION['user_id'])) {
            redirect('auth/login');
        }

        $user_id = $_SESSION['user_id'];

        $job_id = $this->io->post('job_id');

        $user_details = $this->db->select('*')
                        ->table('users')
                        ->where('id', $user_id)
                        ->get();

        $jobs = $this->db->table('jobs')
            ->where('job_id', $job_id)
            ->get();

        $applications = $this->db->table('job_applications as j')
                        ->join('job_seekers as s', 'j.jobseeker_id = s.seeker_id')
                        ->join('jobs as job', 'j.job_id = job.job_id') 
                        ->join('employers as e', 'e.employer_id = job.employer_id') 
                        ->join('users as u', 'u.id = s.user_id')
                        ->select('u.id, j.id as application_id, job.job_id, j.job_id, j.applied_at, job.title as job_title, j.status as application_status, j.first_name, j.last_name, j.email, j.resume, s.full_name, s.skills, s.education, s.experience, s.location, s.seeker_id')
                        ->where('j.job_id', $jobs['job_id']) 
                        ->get_all();
        
        $this->call->view('user/employer/jobApplications', [
            'job' => $jobs,
            'applications' => $applications,
            'user' => $user_details
        ]);
    }

    public function updateApplicationStatus($applicationId){
        if (!isset($_SESSION['user_id'])) {
            redirect('auth/login');
        }

        $user_id = $_SESSION['user_id'];

        $user_details = $this->db->select('*')
                        ->table('users')
                        ->where('id', $user_id)
                        ->get();

        $job_id = $this->io->post('job_id');

        $jobs = $this->db->table('jobs')
                ->where('job_id', $job_id)
                ->get();

        $applications = $this->db->table('job_applications as j')
                        ->join('job_seekers as s', 'j.jobseeker_id = s.seeker_id')
                        ->join('jobs as job', 'j.job_id = job.job_id') 
                        ->join('employers as e', 'e.employer_id = job.employer_id') 
                        ->join('users as u', 'u.id = s.user_id')
                        ->select('u.id, j.id as application_id, job.job_id, j.job_id, j.applied_at, job.title as job_title, j.status as application_status, j.first_name, j.last_name, j.email, j.resume, s.full_name, s.skills, s.education, s.experience, s.location, s.seeker_id')
                        ->where('j.job_id', $jobs['job_id']) 
                        ->get_all();

        $data = [
            'status' => $this->io->post('status'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $result = $this->db->table('job_applications')->where('id', $applicationId)->update($data);

        if ($result) {
            $_SESSION['toastr'] = ['type' =>'success','message' => 'Update successfully!'];
        } else {
            $_SESSION['toastr'] = ['type' => 'error','message' => 'Failed to Update!'];
        }

        $this->call->view('user/employer/jobApplications',[
            'job' => $jobs,
            'applications' => $applications,
            'user' => $user_details
        ]);
        // redirect('user/employer/viewApplications', [
        //         'job' => $jobs,
        //         'applications' => $applications,
        //         'user' => $user_details
        //     ]);

        // header("Location: /user/employer/viewApplications");
        // exit();
    }

    public function scheduleInterview($applicationId){
        if (!isset($_SESSION['user_id'])) {
            redirect('auth/login');
        }

        $user_id = $_SESSION['user_id'];

        $user_details = $this->db->select('*')
                        ->table('users')
                        ->where('id', $user_id)
                        ->get();

        $job_id = $this->io->post('job_id');

        $jobs = $this->db->table('jobs')
                ->where('job_id', $job_id)
                ->get();

        $applications = $this->db->table('job_applications as j')
                        ->join('job_seekers as s', 'j.jobseeker_id = s.seeker_id')
                        ->join('jobs as job', 'j.job_id = job.job_id') 
                        ->join('employers as e', 'e.employer_id = job.employer_id') 
                        ->join('users as u', 'u.id = s.user_id')
                        ->select('u.id, j.id as application_id, job.job_id, j.job_id, j.applied_at, job.title as job_title, j.status as application_status, j.first_name, j.last_name, j.email, j.resume, s.full_name, s.skills, s.education, s.experience, s.location, s.seeker_id')
                        ->where('j.job_id', $jobs['job_id']) 
                        ->get_all();

        $data = [
            'status' => 'Scheduled',
            'interview_date' => $this->io->post('interview_date'),
            'interview_time' => $this->io->post('interview_time'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $result = $this->db->table('job_applications')->where('id', $applicationId)->update($data);

        if ($result) {
            $_SESSION['toastr'] = ['type' =>'success','message' => 'Interview scheduled successfully!'];
        } else {
            $_SESSION['toastr'] = ['type' => 'error','message' => 'Failed to schedule interview!'];
        }

        // redirect('user/employer/viewApplications/'. $jobs['job_id']);

        $this->call->view('user/employer/jobApplications',[
            'job' => $jobs,
            'applications' => $applications,
            'user' => $user_details
        ]);
    }
    
    

}
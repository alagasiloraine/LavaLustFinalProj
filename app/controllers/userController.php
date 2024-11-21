<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class userController extends Controller{


    public function jobSeekerProfile() {
        if (!isset($_SESSION['user_id'])) {
            redirect('auth/login');  
        }
    
        $user_id = $_SESSION['user_id'];
    
        $user_details = $this->db->select('*')
                                ->table('users')
                                ->where('id', $user_id)
                                ->get();
    
        $job_seeker = $this->db->select('*')
                                ->table('job_seekers')
                                ->where('user_id', $user_id)
                                ->get();
    
        $this->call->view('user/jobSeeker/userProfile', [
            'user' => $user_details,
            'job_seeker' => $job_seeker
        ]);
    }
    
    public function employerProfile(){
        if (!isset($_SESSION['user_id'])) {
            redirect('auth/login');  
        }
        
        $user_id = $_SESSION['user_id'];
        
        $user_details = $this->db->select('*')
                                ->table('users')
                                ->where('id', $user_id)
                                ->get();
        
        $employer = $this->db->select('*')
                            ->table('employers')
                            ->where('user_id', $user_id)
                            ->get();
        
        $this->call->view('user/employer/userProfile', [
            'user' => $user_details,
            'employer' => $employer
        ]);
    }

    public function editProfile() {
        if (!isset($_SESSION['user_id'])) {
            redirect('auth/login');  
        }
    
        $user_id = $_SESSION['user_id'];
    
        $data = [
            'full_name' => $this->io->post('full_name'),
            'location' => $this->io->post('location'),
            'bio' => $this->io->post('bio'),
            'skills' => $this->io->post('skills'),
            'education' => $this->io->post('education'),
            'experience' => $this->io->post('experience'),
            'availability' => $this->io->post('availability'),
        ];
    
        if (isset($_FILES['resume']) && $_FILES['resume']['error'] == 0) {
            $this->call->library('upload', $_FILES["resume"]);
            $this->upload
                ->max_size(5 * 1024) // 5MB size limit
                ->set_dir('public/resumes') // Directory to store the file
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
    
        $existing_profile = $this->db->table('job_seekers')->select('seeker_id')->where('user_id', $user_id)->get();
    
        if ($existing_profile) {
            $this->db->table('job_seekers')->where('user_id', $user_id)->update($data);
        } else {
            $data['user_id'] = $user_id;
            $this->db->table('job_seekers')->insert($data);
        }
    
        redirect('user/jobseeker/profile');  // Redirect to the profile view page
    }
    


}
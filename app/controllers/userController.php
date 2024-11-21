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
    
        // Handle Profile Picture Upload
        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
            $this->call->library('upload', $_FILES['profile_picture']);
            $this->upload
                ->max_size(2 * 1024) // 2MB size limit
                ->set_dir('uploads/profile_pictures') // Directory to store the file
                ->allowed_extensions(['jpg', 'jpeg', 'png', 'gif']) // Allowed file types
                ->allowed_mimes(['image/jpeg', 'image/png', 'image/gif'])
                ->encrypt_name(); // Encrypt the filename
    
            if ($this->upload->do_upload()) {
                // Delete old profile picture if it exists
                $existing_profile = $this->db->table('job_seekers')->select('profile_picture')->where('user_id', $user_id)->get();
                if (!empty($existing_profile['profile_picture']) && file_exists('uploads/profile_pictures/' . $existing_profile['profile_picture'])) {
                    unlink('uploads/profile_pictures/' . $existing_profile['profile_picture']);
                }
                $data['profile_picture'] = $this->upload->get_filename();
            } else {
                $data['errors'] = $this->upload->get_errors();
                $this->call->view('upload_form', $data);
                return;
            }
        }
    
        // Handle Resume Upload
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
    
        $existing_profile = $this->db->table('job_seekers')->select('seeker_id')->where('user_id', $user_id)->get();
    
        if ($existing_profile) {
            $result = $this->db->table('job_seekers')->where('user_id', $user_id)->update($data);

            if($result) {
                $_SESSION['success'] = 'Profile updated successfully!';  
            } else {
                $_SESSION['error'] = 'Failed to update the profile. Please try again.';
            }
        } else {
            $data['user_id'] = $user_id;
            $result = $this->db->table('job_seekers')->insert($data);
            if($result) {
                $_SESSION['success'] = 'Profile set up successfully!';  
            } else {
                $_SESSION['error'] = 'Failed to update the profile. Please try again.';
            }

        }
    
        redirect('user/jobseeker/profile');  // Redirect to the profile view page
    }
    
    public function editEmployerProfile() {
        if (!isset($_SESSION['user_id'])) {
            redirect('auth/login');  
        }
    
        $user_id = $_SESSION['user_id'];
    
        $data = [
            'company_name' => $this->io->post('company_name'),
            'company_address' => $this->io->post('company_address'),
            'contact_info' => $this->io->post('contact_info'),
        ];

        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
            $this->call->library('upload', $_FILES['profile_picture']);
            $this->upload
                ->max_size(2 * 1024) // 2MB size limit
                ->set_dir('uploads/profile_pictures') // Directory to store the file
                ->allowed_extensions(['jpg', 'jpeg', 'png', 'gif']) // Allowed file types
                ->allowed_mimes(['image/jpeg', 'image/png', 'image/gif'])
                ->encrypt_name(); // Encrypt the filename
    
            if ($this->upload->do_upload()) {
                // Delete old profile picture if it exists
                $existing_profile = $this->db->table('job_seekers')->select('profile_picture')->where('user_id', $user_id)->get();
                if (!empty($existing_profile['profile_picture']) && file_exists('uploads/profile_pictures/' . $existing_profile['profile_picture'])) {
                    unlink('uploads/profile_pictures/' . $existing_profile['profile_picture']);
                }
                $data['profile_picture'] = $this->upload->get_filename();
            } else {
                $data['errors'] = $this->upload->get_errors();
                $this->call->view('upload_form', $data);
                return;
            }
        }

        $existing_profile = $this->db->table('employers')->select('employer_id')->where('user_id', $user_id)->get();


        if ($existing_profile) {
           $result = $this->db->table('employers')->where('user_id', $user_id)->update($data);

           if($result) {
                $_SESSION['success'] = 'Profile updated successfully!';  
            } else {
                $_SESSION['error'] = 'Failed to update the profile. Please try again.';
            }
        } else {
            $data['user_id'] = $user_id;
            $result = $this->db->table('employers')->insert($data);
            if($result) {
                $_SESSION['success'] = 'Profile set up successfully!';  
            } else {
                $_SESSION['error'] = 'Failed to update the profile. Please try again.';
            }
        }
    
        redirect('user/employer/profile');
    }


}
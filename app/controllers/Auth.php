<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Auth extends Controller {

    public function __construct()
    {
        parent::__construct();
        if(segment(2) != 'logout') {
            if(logged_in()) {
                redirect('home');
            }
        }
        $this->call->library('email');
    }

    public function admin() {
        $this->call->view('admin/adminDashboard');
    }
	
    public function index() {
        $this->call->view('auth/login');
    }  

    public function login() {
        if($this->form_validation->submitted()) {
            $email = $this->io->post('email');
			$password = $this->io->post('password');
            $data = $this->lauth->login($email, $password);
            if(empty($data)) {
				$this->session->set_flashdata(['is_invalid' => 'is-invalid']);
                $this->session->set_flashdata(['err_message' => 'These credentials do not match our records.']);
			} else {

                $userStatus = $this->db->table('users')->select('isVerified')->where('email', $email)->get();

                if ($userStatus['isVerified'] === '0') {
                    $_SESSION['error'] = 'Failed to login due to unverified email.';
                    redirect('auth/login');
                } else {
                    $this->lauth->set_logged_in($data);
                }
			}
            redirect('auth/login');
        } else {
            $this->call->view('auth/login');
        }
        
    }

    public function register() {
        if ($this->form_validation->submitted()) {
            $username = $this->io->post('username');
            $email = $this->io->post('email');
            $verification_code = random_int(100000, 999999); // Generate a 6-digit random code
    
            $this->form_validation
                ->name('username')
                    ->required()
                    ->is_unique('users', 'username', $username, 'Username was already taken.')
                    ->min_length(5, 'Username must not be less than 5 characters.')
                    ->max_length(20, 'Username must not be more than 20 characters.')
                    ->alpha_numeric_dash('Special characters are not allowed in username.')
                ->name('password')
                    ->required()
                ->name('password_confirmation')
                    ->required()
                    ->matches('password', 'Passwords did not match.')
                ->name('email')
                    ->required()
                    ->is_unique('users', 'email', $email, 'Email was already taken.')
                ->name('role')
                    ->required();
    
            if ($this->form_validation->run()) {
                if ($this->lauth->register($username, $email, $this->io->post('password'), $verification_code, $this->io->post('role'))) {
                    // Send verification email with the generated code
                    $email_lib = new Email();  // Instantiate the Email class
                    if ($email_lib->send_verification_email($email, $username, $verification_code)) {
                        // Store the email in session for verification
                        $_SESSION['verification_email'] = $email; 
    
                        $_SESSION['success'] = 'Registration successful! Please check your email for the verification code.';
                        // set_flash_alert('success', 'Registration successful! Please check your email for the verification code.');
                        redirect('auth/verify_code'); // Redirect to the page where user can enter the code
                    } else {
                        $_SESSION['error'] = 'Failed to send verification email. Please try again.';
                        // set_flash_alert('danger', 'Failed to send verification email. Please try again.');
                        redirect('auth/register');
                    }
                } else {
                    set_flash_alert('danger', config_item('SQLError'));
                }
            } else {
                set_flash_alert('danger', $this->form_validation->errors());
                redirect('auth/register');
            }
        } else {
            $this->call->view('auth/register');
        }
    }

    public function verify_code() {
        if ($this->form_validation->submitted()) {
            $email = $_SESSION['verification_email'] ?? null;  // Retrieve the email from session
            $input_code = $this->io->post('verification_code');
    
            if (!$email) {
                set_flash_alert('danger', 'Session expired. Please register again.');
                redirect('auth/register');
            }
    
            $user = $this->db->table('users')->select('*')->where('email', $email)->get();
    
            if ($user && $user['email_token'] == $input_code) {

                $data = [
                    'isVerified' => 1,
                    'email_token' => null,
                    'email_verified_at' => date('Y-m-d H:i:s')
                ];
                $this->db->Table('users')->where('id', $user['id'])->update($data);
    
                unset($_SESSION['verification_email']); // Clear session after successful verification
                set_flash_alert('success', 'Email verified successfully! You can now log in.');
                redirect('auth/login');
            } else {
                set_flash_alert('danger', 'Invalid verification code. Please try again.');
            }
        }
    
        $this->call->view('auth/verify_code');
    }
    
    private function send_password_token_to_email($email, $token) {
        $template = file_get_contents(ROOT_DIR . PUBLIC_DIR . '/templates/reset_password_email.html');
        $search = ['{token}', '{base_url}'];
        $replace = [$token, base_url()];
        $emailContent = str_replace($search, $replace, $template);
    
        $mailer = new Email();
        $username = "User"; // Replace with dynamic username if available
        $subject = "LavaLust Reset Password"; // Subject for the email
    
        if ($mailer->send_verification_email($email, $username, $emailContent)) {
            return true;
        } else {
            error_log("Failed to send reset password email to $email");
            return false;
        }
    }

	public function password_reset() {
		if($this->form_validation->submitted()) {
			$email = $this->io->post('email');
			$this->form_validation
				->name('email')->required()->valid_email();
			if($this->form_validation->run()) {
				if($token = $this->lauth->reset_password($email)) {
					$this->send_password_token_to_email($email, $token);
                    $_SESSION['success'] = 'Password Reset Link Send. Check your email.';
                    redirect('auth/password-reset');
				} else {
					$this->session->set_flashdata(['alert' => 'is-invalid']);
                    $_SESSION['error'] = 'Failed to reset password. Please try again.';
                    redirect('auth/password-reset');
				}
			} else {
				set_flash_alert('danger', $this->form_validation->errors());
                redirect('auth/password-reset');
			}
            redirect('auth/password-reset');
		} else {
            $this->call->view('auth/password_reset');
        }
	}

    public function set_new_password() {
        if($this->form_validation->submitted()) {
            $token = $this->io->post('token');
			if(isset($token) && !empty($token)) {
				$password = $this->io->post('password');
				$this->form_validation
					->name('password')
						->required()
						->min_length(8, 'New password must be atleast 8 characters.')
					->name('re_password')
						->required()
						->min_length(8, 'Retype password must be atleast 8 characters.')
						->matches('password', 'Passwords did not matched.');
						if($this->form_validation->run()) {
							if($this->lauth->reset_password_now($token, $password)) {
                                $_SESSION['success'] = 'Password successfully Renewed. You can now proceed to login again.';
                                redirect('/auth/set-new-password');
							} else {
								set_flash_alert('danger', config_item('SQLError'));
                                $_SESSION['error'] = 'Failed to renew password. Please try again.';
                                redirect('/auth/set-new-password');
							}
						} else {
							set_flash_alert('danger', $this->form_validation->errors());
						}
			} else {
                $_SESSION['error'] = 'Reset token is missing.';
                redirect('auth/password-reset');
			}
            redirect('/auth/set-new-password');
        } else {
             $token = $_GET['token'] ?? '';
            if(! $this->lauth->get_reset_password_token($token) && (! empty($token) || ! isset($token))) {
                set_flash_alert('danger', 'Invalid password reset token.');
            }
            $this->call->view('auth/new_password');
        }
		
	}

    public function logout() {
        if($this->lauth->set_logged_out()) {
            redirect('auth/login');
        }
    }

}
?>

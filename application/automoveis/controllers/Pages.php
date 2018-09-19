<?php
class Pages extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('List_automoveis');
        
        }

        public function view($page = 'home')
        {
                if ( ! file_exists(APPPATH.'views/publico/'.$page.'.php'))
                {
                        // Whoops, we don't have a page for that!
                        show_404();
                }

                $config = array(
                'img_url' => base_url() . 'image_for_captcha/',
                'img_path' => 'image_for_captcha/',
                'img_height' => 45,
                'word_length' => 5,
                'img_width' => '75',
                'font_size' => 10
                );

                $captcha = create_captcha($config);
                $this->session->unset_userdata('valuecaptchaCode');
                $this->session->set_userdata('valuecaptchaCode', $captcha['word']);
                $data['captchaImg'] = $captcha['image'];

                $data['title'] = ucfirst($page); // Capitalize the first letter

                $this->load->view('templates/header', $data);
                $this->load->view('publico/'.$page, $data);
                $this->load->view('templates/footer', $data);
        }

        public function frota($page = 'pesquisa', $id=NULL){
                if ( ! file_exists(APPPATH.'views/frota/'.$page.'.php'))
                {
                    // Whoops, we don't have a page for that!
                    show_404();
                }    
                
                if($page=='adicionar' && !isset($this->session->userdata['logged_in']))
                        redirect('/pages/view/home');

                
                $config = array(
                'img_url' => base_url() . 'image_for_captcha/',
                'img_path' => 'image_for_captcha/',
                'img_height' => 45,
                'word_length' => 5,
                'img_width' => '75',
                'font_size' => 10
                );

                $captcha = create_captcha($config);
                $this->session->unset_userdata('valuecaptchaCode');
                $this->session->set_userdata('valuecaptchaCode', $captcha['word']);
                $data['captchaImg'] = $captcha['image'];
                
                
                
                $data['listauto'] = $this->List_automoveis->get_auto($id);
                $data['info'] = $this->List_automoveis->get_data();
                $data['title'] = ucfirst($page); // Capitalize the first letter

                $this->load->view('templates/header', $data);
                $this->load->view('frota/'.$page, $data);
                $this->load->view('templates/footer', $data);
        }

        public function create()
        {

                if($this->List_automoveis->set_auto()){
                        redirect('/pages/frota/adicionar');
                        
                        // $this->load->view('templates/header');
                        // $this->load->view('templates/success');
                        // $this->load->view('templates/footer');
                }            

        }

        public function actualizar()
        {
                
                
                $this->load->view('templates/header');
                if ($this->List_automoveis->update_auto()) $this->load->view('templates/success');

                $this->load->view('templates/footer');

        }

        public function delete($id){
                if($this->List_automoveis->delete_auto($id)){
                        redirect('/pages/frota');
                         
                        // $this->load->view('templates/header');
                        // $this->load->view('templates/success');
                        // $this->load->view('templates/footer');
                } 
        }

        public function set_admin(){
                $captcha_insert = $this->input->post('captcha');
                $contain_sess_captcha = $this->session->userdata('valuecaptchaCode');
                if ($captcha_insert === $contain_sess_captcha) {
                        $status=1;
                } else {
                        $status=0;
                }
                                
          
               
                $password=$this->input->post('password');
                $email=$this->input->post('email');

                $hash=password_hash("admin", PASSWORD_DEFAULT);

                if (password_verify($password, $hash) && $email=='admin@gmail.com' && $status==1) {
                        $sess_array = array(
                                'username' => $email,
                                'password' => $password
                        );
                        
                        $this->session->set_userdata('logged_in', $sess_array);
                        redirect('/pages/frota/pesquisa');
                } else {
                        redirect('/pages/view/home');
                }
        }
        
        public function refresh()
                {
                        $config = array(
                        'img_url' => base_url() . 'image_for_captcha/',
                        'img_path' => 'image_for_captcha/',
                        'img_height' => 45,
                        'word_length' => 5,
                        'img_width' => '75',
                        'font_size' => 10
                        );
                        $captcha = create_captcha($config);
                        $this->session->unset_userdata('valuecaptchaCode');
                        $this->session->set_userdata('valuecaptchaCode', $captcha['word']);
                        echo $captcha['image'];
                }

        public function logout() {

                // Removing session data
                $sess_array = array(
                'username' => ''
                );
                $this->session->unset_userdata('logged_in', $sess_array);
                redirect('/pages/view/home');
                

        }
            
}
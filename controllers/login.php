<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Log in to trustev's API
     */
    function index()
    {
        $this->load->library('trustev');

        $this->config->load('trustev');

        $username = $this->config->item('trustev_username');
        $password = $this->config->item('trustev_password');
        $secret = $this->config->item('trustev_secret');
        $api_url = $this->config->item('trustev_endpoint');

        $credentials = $this->trustev->get_token($username, $password, $secret, $api_url);

        if (is_array($credentials) && $credentials['Code'] == 200 && $credentials['Message'] == 'Success')
        {
            echo "Logged in Successfully<br />";

            print_r($credentials["Token"]);

            $profile_add = $this->trustev->profile_add($username, $credentials);

            print_r($profile_add);
        }
        else
        {
            echo "Failed to log in<br />";
            print_r($credentials);
        }
    }

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */
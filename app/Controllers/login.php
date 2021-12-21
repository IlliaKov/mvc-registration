<?php
class Login extends Controller
{
    public function index($name = '')
    {
        $user = $this->model('User');
        $user->name = $name;

        $this->view('login/index', ['name' => $user->name]);
    }
}
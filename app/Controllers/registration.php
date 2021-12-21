<?php
class Registration extends Controller
{
    public function index($name = '')
    {
        $user = $this->model('User');
        $user->name = $name;

        $this->view('registration/index', ['name' => $user->name]);
    }
}
<?php 

// application/controllers/admin/IndexController.class.php
class IndexController extends BaseController{

    public function mainAction(){
        
        include CURR_VIEW_PATH . "main.html";
        
        // Load Captcha class
        $this->loader->library("Captcha");
        $captcha = new Captcha;
        $captcha->hello();
        $userModel = new UserModel("user");
        $users = $userModel->getUsers();

    }

    public function indexAction(){

        $userModel = new UserModel("user");
        $users = $userModel->getUsers();
        
        //load View Template
        include CURR_VIEW_PATH . "menu.html";

    }

    public function menuAction(){

        include CURR_VIEW_PATH . "menu.html";

    }

    public function dragAction(){

        include CURR_VIEW_PATH . "drag.html";

    }

    public function topAction(){

        include CURR_VIEW_PATH . "top.html";

    }
}
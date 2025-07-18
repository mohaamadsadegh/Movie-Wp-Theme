<?php


namespace inc;

use metabox\actormeta;
use core\ajax;
use core\CommentHandler;
use core\Setup;
use core\UserData;
use metabox\seriesmeta;
use metabox\VideoInfo;
use posttype\Movie;
use user_panel\login_form;
use user_panel\user_dashboard;

class Theme
{
    public function __construct()
    {
//        startup theme
        new Setup();
//        post-type
        new Movie();
//        meta box
        new VideoInfo();
        new seriesmeta;
        new actormeta();
//         ajax
        new ajax();
//        user data
        new UserData();
//        comments
        new CommentHandler();
//        user dashboard
        new user_dashboard();
//        login
        add_action('after_setup_theme', function () {
            new login_form();
        });
//        config file
        new config_file();
    }

}


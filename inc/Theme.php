<?php


namespace inc;


use inc\Ajax\ajaxFilter;
use inc\Ajax\CommentHandler;
use inc\Ajax\AjaxGenreTabs;
use core\Setup;
use core\UserData;
use inc\metabox\actormeta;
use inc\metabox\seriesmeta;
use inc\metabox\VideoInfo;
use inc\posttype\Movie;
use inc\user_panel\login_form;
use inc\user_panel\user_dashboard;

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
        new ajaxFilter();
//        user data
        new UserData();
//        comments
        new CommentHandler;
//        user dashboard
        new user_dashboard();
//       ajax genre tabs
        new ajaxGenreTabs();
//        login
        add_action('after_setup_theme', function () {
            new login_form();
        });
//        config file
        new config_file();
    }

}


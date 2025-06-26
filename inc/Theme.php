<?php


namespace inc;

use core\ajax;
use core\CommentHandler;
use core\Setup;
use core\UserData;
use metabox\seriesmeta;
use metabox\VideoInfo;
use posttype\Movie;

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
//         ajax
        new ajax();
//        user data
        new UserData();
//        comments
        new CommentHandler();
    }

}


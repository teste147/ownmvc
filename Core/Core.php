<?php
/**
 * Created by PhpStorm.
 * User: mallmann
 * Date: 03/09/17
 * Time: 13:26
 */
namespace Core;

class Core
{

    public function run()
    {
        $url = '/';
        if (isset($_GET['url'])){
            $url .= $_GET['url'];
        }

        $params = array();

        if ($url != '/'){
            $url = explode('/', $url);
            array_shift($url);

            $currentController = $url[0].'Controller';
            array_shift($url);

            if (isset($url[0]) && !empty($url[0])){
                $currentAction = $url[0];
                array_shift($url);
            }else{
                $currentAction = 'index';
            }

            if (count($url) > 0){
                $params = $url;
            }

        }else{
            $currentController = 'homeController';
            $currentAction = 'index';
        }

        $currentController = '\Controllers\\'.ucfirst($currentController);
        $c = new $currentController();

        call_user_func_array(array($c, $currentAction.'Action'), $params);
    }

}
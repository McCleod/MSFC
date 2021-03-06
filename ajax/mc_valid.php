<?php
    /*
    * Project:     Clan Stat
    * License:     Creative Commons - Attribution-Noncommercial-Share Alike 3.0 Unported
    * Link:        http://creativecommons.org/licenses/by-nc-sa/3.0/
    * -----------------------------------------------------------------------
    * Began:       2011
    * Date:        $Date: 2011-10-24 11:54:02 +0200 $
    * -----------------------------------------------------------------------
    * @author      $Author: Edd, Exinaus, Shw  $
    * @copyright   2011-2012 Edd - Aleksandr Ustinov
    * @link        http://wot-news.com
    * @package     Clan Stat
    * @version     $Rev: 2.2.0 $
    *
    */
?>
<?php
    error_reporting(E_ALL & ~E_STRICT);
    ini_set("display_errors", 1);
    if (file_exists(dirname(__FILE__).'/func_ajax.php')) {
        define('LOCAL_DIR', dirname(__FILE__));
        include_once (LOCAL_DIR.'/func_ajax.php');

        define('ROOT_DIR', base_dir('ajax'));

    }else{
        define('LOCAL_DIR', '.');
        include_once (LOCAL_DIR.'/func_ajax.php');

        define('ROOT_DIR', '..');

    }
    include_once(ROOT_DIR.'/including/check.php');
    include_once(ROOT_DIR.'/function/auth.php');
    include_once(ROOT_DIR.'/function/mysql.php');
    include_once(ROOT_DIR.'/function/func.php');
    include_once(ROOT_DIR.'/function/func_get.php');
    include_once(ROOT_DIR.'/function/func_main.php');
    include_once(ROOT_DIR.'/function/config.php');
    include_once(ROOT_DIR.'/config/config_'.$config['server'].'.php');                      

    foreach(scandir(ROOT_DIR.'/translate/') as $files){
        if (preg_match ("/_".$config['lang'].".php/", $files)){
            include_once(ROOT_DIR.'/translate/'.$files);
        }
    } 

    /**Мультиклан проверка на ошибки **/
    if($_GET['multiadd'] == 1){
        if($_GET['id'] && $_GET['prefix'] && $_GET['sort']){
            if(is_numeric($_GET['id'])){
                if(preg_match('/^\d/', $_GET['prefix']) == 0 && strlen(preg_replace('/(.*)_/','$1',$_GET['prefix'])) <=5){
                    if(ctype_alnum(preg_replace('/(.*)_/','$1',$_GET['prefix']))){

                        $_GET['prefix'] = strtolower($_GET['prefix']);
                        if (preg_match("/_/", $_GET['prefix'])) {
                          $message['prefix'] = $lang['error_multi_4'];
                        }
                        if(!preg_match("/[a-zA-Z0-9]{1,5}_/i", $_GET['prefix'])){
                            $_GET['prefix'] = $_GET['prefix'].'_';
                        }

                        $sql = "SELECT COUNT(id) FROM multiclan WHERE id = '".$_GET['id']."';";
                        $q = $db->prepare($sql);
                        if ($q->execute() == TRUE) {
                            $status_clan = $q->fetchColumn();  
                        }else{
                            die(show_message($q->errorInfo(),__line__,__file__,$sql));
                        }

                        $sql = "SELECT COUNT(id) FROM multiclan WHERE prefix = '".$_GET['prefix']."';";
                        $q = $db->prepare($sql);
                        if ($q->execute() == TRUE) {
                            $status_prefix = $q->fetchColumn();  
                        }else{
                            die(show_message($q->errorInfo(),__line__,__file__,$sql));
                        }
                        $roster = get_api_roster($_GET['id'],$config);    
                        //print_r($roster);
                        if($roster['status'] == 'ok' && $roster['status_code'] == 'NO_ERROR'){
                            if($status_clan == 0 ){
                                if($status_prefix != 0){
                                    $message['prefix'] = $lang['error_multi_7'];
                                } 
                            }else{
                                $message['id'] = $lang['error_multi_6'];
                            }
                        }else{
                            $message['id'] = $lang['error_multi_5'];
                        }
                    }else{
                        $message['prefix'] = $lang['error_multi_4'];
                    }
                }else{
                    $message['prefix'] = $lang['error_multi_3'];
                }   
            }else{
                $message['id'] = $lang['error_multi_2'];
            }
        }else{
            if(!$_GET['id']){
                $message['id'] = $lang['error_multi_1'];
            }
            if(!$_GET['prefix']){
                $message['prefix'] = $lang['error_multi_1'];
            }
            if(!$_GET['sort']){
                $message['sort'] = $lang['error_multi_1'];
            }
        }
        if(!isset($message)){
            $message['id'] = 'true';  
        }                  
        header("Content-type: application/json; charset=utf-8");
        echo indent(json_encode($message)); 
    }
?>
<?php
//namespace App\Helper;
helper('download,file');
if (!function_exists('is_logged')) {

    function is_logged()
    {
        $data['user_data'] = session()->get('user_data');
        if ($data['user_data'] == null) {
            return false;
        } else {
            return true;
        }
    }

//    function refresh()
//    {
//        $forge = \Config\Database::forge();
//        $db = db_connect();
//        if ($forge->dropDatabase($db->database)) {
//            return true;
//        }
//    }

    /*function download()
    {
        $db = db_connect();
        $prefs = array(
            'format' => 'zip',
            'filename' => 'my_db_backup.sql'
        );

        $backup = $db->

        $db_name = 'backup-on-' . date("Y-m-d-H-i-s") . '.zip';
        $save = base_url('assets/uploads/') . $db_name;

        write_file($save, $backup);

        force_download($db_name, $backup);
    }*/
}



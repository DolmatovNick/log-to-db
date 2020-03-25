<?php

class PrepareStructures {

    public static function exec()
    {
        // DB::query("DROP TABLE IF EXISTS logs");
        // DB::query("DROP TABLE IF EXISTS users");
        // @file_put_contents('./logs_index/1.txt_last_line_number.', 0);
        // @file_put_contents('./logs_index/2.txt_last_line_number.', 0);
        $sql = file_get_contents('./import.sql');
        DB::exec($sql);
    }


}
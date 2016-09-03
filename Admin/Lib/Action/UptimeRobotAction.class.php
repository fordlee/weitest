<?php
// 本类由系统自动生成，仅供测试用途
class UptimeRobotAction extends Action {
    public function dbbak($token='') {
        if ($token === '98a8cbb2a66ddfca4db65a35eea43f65') {
            $hour = intval(date('H'));
            if ($hour > 3) {
                exit('2');
            }
            $user = 'thehotgames';
            $password = 'weekmovie2013';
            $host = 'mysql.adonads.com';
            $dbname = 'mytests_co';
            $filepath = str_replace('Runtime/Logs', 'dbbak', C('LOG_PATH'));
            $file = $dbname . '_' . date('Y_m_d_H_i_s') . '.sql';
            $sqlcmd = "mysqldump --user=$user --password=$password --host=$host $dbname > $filepath$file";
            exec($sqlcmd);
            exit('1');
        } else {
            exit('0');
        }
    }
}
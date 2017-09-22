<?php

class Blog_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function gets()
    {
        return $this->db->query("select * from dy_board order by reg_date desc limit 0,5")->result_array();
    }

    function update($id, $sub, $con)
    {
        return $this->db->query("update dy_board set subject='$sub', contents = '$con' where board_id = $id ");
    }

    function hits_update($id, $hits)
    {
        $name = $this->db->query("update dy_board set hits = $hits+1 where board_id = $id ");
        return $name;
    }

    function insert($id, $name, $subject, $contents)
    {
        return $this->db->query("insert into dy_board (user_id, user_name,subject, contents) values ('$id', '$name','$subject','$contents')");
    }

    function find($id)
    {
        return $this->db->query("select * from dy_board where board_id = $id")->result_array();
    }

    function delete($id)
    {
        return $this->db->query("delete from dy_board where board_id = $id");
    }

    function login($id, $pw)
    {
        return $this->db->query("select name from customer where id='$id' AND password = '$pw'")->result_array();

    }

    function page()
    {
        $a = $this->db->get('dy_board')->result_array();
        return count($a);
    }

    function page_change($num)
    {
        return $this->db->query("select * from dy_board order by reg_date desc limit $num,5")->result_array();
    }

    function find_kind($text, $a)
    {

        switch ($a) {
            case 1:
                return $this->db->query("select * from dy_board where user_name = '$text'")->result_array();
                break;
            case 2:
                return $this->db->query("select * from dy_board where subject like '%$text%'")->result_array();
                break;
            case 3:
                return $this->db->query("select * from dy_board where contents like '%$text%'")->result_array();
                break;
            case 4:
                return $this->db->query("select * from dy_board where user_name = '$text' or subject like '%$text%' or contents like '%$text%'")->result_array();

        }
    }

    function find_kind_su($text, $a)
    {

        switch ($a) {
            case 1:
                return $this->db->query("select * from dy_board where user_name = '$text'order by reg_date desc limit 0,5")->result_array();
                break;
            case 2:
                return $this->db->query("select * from dy_board where subject like '%$text%'order by reg_date desc limit 0,5")->result_array();
                break;
            case 3:
                return $this->db->query("select * from dy_board where contents like '%$text%'order by reg_date desc limit 0,5")->result_array();
                break;
            case 4:
                return $this->db->query("select * from dy_board where user_name = '$text' or subject like '%$text%' or contents like '%$text%'order by reg_date desc limit 0,5")->result_array();

        }
    }

    function find_result_look($text, $a, $page_num){
        $page_num = $page_num * 5 -5;
        switch ($a) {
            case 1:
                return $this->db->query("select * from dy_board where user_name = '$text'order by reg_date desc limit $page_num,5")->result_array();
                break;
            case 2:
                return $this->db->query("select * from dy_board where subject like '%$text%'order by reg_date desc limit $page_num,5")->result_array();
                break;
            case 3:
                return $this->db->query("select * from dy_board where contents like '%$text%'order by reg_date desc limit $page_num,5")->result_array();
                break;
            case 4:
                return $this->db->query("select * from dy_board where user_name = '$text' or subject like '%$text%' or contents like '%$text%' order by reg_date desc limit $page_num,5")->result_array();
        }

    }

    function comment($a, $contents)
    {
        $name = $_SESSION['name'];
        return $this->db->query("insert into blog_comment (board_pid, user_name, contents) values ('$a', '$name', '$contents')");
    }

    function look_comment($id)
    {
        return $this->db->query("select * from blog_comment where board_pid = $id")->result_array();

    }

    function comment_delete($id, $name, $date)
    {
        return $this->db->query("delete from blog_comment where board_pid = $id and user_name = '$name' and date = '$date'");

    }


}
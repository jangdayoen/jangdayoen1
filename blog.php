<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class blog extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('blog_model');
    }

    public function index()
    {
        $results = $this->blog_model->gets();
        $this->load->view('blog_head');
        $result = $this->blog_model->page();//게시글 수
        if ($result % 5 == 0) {
            $result = $result / 5;
        } else {
            $result = $result / 5;
            $result = floor($result) + 1;
        }
        if ($result > 5) {
            $page_count = 5;
        } else {
            $page_count = $result;
        }
        $_SESSION['pageNum'] = $result;
        $this->load->view('blog_list', array('result' => $results, 'page_count' => $page_count));
        $this->load->view('blog_footer');

    }


    function page_change($a)
    {
        $this->load->view('blog_head');
        $page_su = $a * 5 - 5;
        $result = $this->blog_model->page_change($page_su);
        $nowUrl = $basename = basename($_SERVER["PHP_SELF"]);
        if (isset($_SESSION['pageNum'])) {
        } else {
            $_SESSION['pageNum'] = 1;
        }
        //총 페이지 수가 5거나 작을 때
        if ($_SESSION['pageNum'] <= 5) {
            $first = 1;
            $last = $_SESSION['pageNum'];
        } else {
            //총 페이지 수가 5보다 클 때
            if ($a > 3) { //1) 선택한 페이지가 3보다 클 때
                $first = $a - 2;
                $last = $a + 2;
                if ($last > $_SESSION['pageNum']) {
                    $first = $_SESSION['pageNum'] - 4;
                    $last = $_SESSION['pageNum'];
                }
            } elseif ($a <= 3) {//2) 선택한 페이지가 3보다 작을 때
                $first = 1;
                $last = 5;
            }
        }

        $this->load->view('blog_page_change', array('first' => $first, 'last' => $last, 'write_list' => $result, 'nowPage' => $nowUrl));
        $this->load->view('blog_footer');
    }

    public function write()
    {
        $this->load->view('blog_head');
        $this->load->view('blog_view');
        $this->load->view('blog_footer');

    }

    function write_insert()
    {

        if ($_POST['subject'] != null) {
            $result = $this->blog_model->insert($_SESSION['id'], $_SESSION['name'], $_POST['subject'], $_POST['contents']);
            if ($result) {
                $this->index();
            }
        } else { ?>
            <script>
                history.back();
                alert('제목을 입력하세요');
            </script>
        <?php }
    }

    function look($id)
    {
        $look_date = $this->blog_model->find($id);
        foreach ($look_date as $list) {
            $hits = $list['hits'];
        }
        $this->blog_model->hits_update($id, $hits);
        $this->load->view('blog_head');
        $look_date = $this->blog_model->find($id);
        $this->load->view('blog_look', array('result' => $look_date));
        $comment = $this->blog_model->look_comment($id);
        $this->load->view('blog_comment', array('result' => $comment));
        $this->load->view('blog_footer');
    }


    function update($id)
    {
        $look_date = $this->blog_model->find($id);
        foreach ($look_date as $list) {
            $id = $list['board_id'];
            $subject = $list['subject'];
            $contents = $list['contents'];
        }
        $this->load->view('blog_head');
        $this->load->view('blog_update', array('id' => $id, 'subject' => $subject, 'contents' => $contents));
        $this->load->view('blog_footer');
    }

    function list_update($id)
    {
        $this->blog_model->update($id, $_POST['subject'], $_POST['contents']);
        $this->look($id);
    }

    function delete($id)
    {
        $this->blog_model->delete($id);
        $this->index();
    }

    function login()
    {
        $result = $this->blog_model->login($_POST['id'], $_POST['pw']);
        if ($result) {
            $_SESSION['id'] = $_POST['id'];
            foreach ($result as $list) {
                $_SESSION['name'] = $list['name'];
            }
        } else {
            ?>
            <script>alert("잘못된 id 또는 pw 입니다.");</script>
            <?php
        }
        ?>
        <script>
            window.history.back();
        </script>
        <?php
    }

    function log_out()
    {
        session_destroy(); ?>

        <script>
            window.history.back();
        </script>
        <?php
    }

    function search()
    {
        $_SESSION['select'] = $_POST['select'];
        $select = $_SESSION['select'];
        $_SESSION['find'] = $_POST['find'];
        $find = $_SESSION['find'];

        $this->load->view('blog_head');
        switch ($select) {
            case '1':
                $result = $this->blog_model->find_kind($find, 1);
                $result_su = $this->blog_model->find_kind_su($find, 1);
                break;
            case '2':
                $result = $this->blog_model->find_kind($find, 2);
                $result_su = $this->blog_model->find_kind_su($find, 2);
                break;
            case '3':
                $result = $this->blog_model->find_kind($find, 3);
                $result_su = $this->blog_model->find_kind_su($find, 3);
                break;
            case '4':
                $result = $this->blog_model->find_kind($find, 4);
                $result_su = $this->blog_model->find_kind_su($find, 4);
        }
        $_SESSION['result_su'] = count($result);

        if ($_SESSION['result_su'] % 5 == 0) {
            $page = $_SESSION['result_su'] / 5;
        } else {
            $page = $_SESSION['result_su'] / 5;
            $page = floor($page) + 1;
        }
        if ($page < 5) {
            $first = 1;
            $last = $page;
        } else {
            $first = 1;
            $last = 5;
        }

        $this->load->view('blog_find', array('result' => $result_su, 'first' => $first, 'last' => $last, 'nowPage' => 1));
        $this->load->view('blog_footer');
    }

    function search_page($a)
    {

        $select = $_SESSION['select'];
        $find = $_SESSION['find'];

        $this->load->view('blog_head');
        switch ($select) {
            case '1':
                $find_result_look = $this->blog_model->find_result_look($find, 1, $a);
                break;
            case '2':
                $find_result_look = $this->blog_model->find_result_look($find, 2, $a);
                break;
            case '3':
                $find_result_look = $this->blog_model->find_result_look($find, 3, $a);
                break;
            case '4':
                $find_result_look = $this->blog_model->find_result_look($find, 4, $a);
        }
        //검색 계총 페이지 수 산 $result
        if ($_SESSION['result_su'] % 5 == 0) {
            $result = $_SESSION['result_su'] / 5;
        } else {
            $result = $_SESSION['result_su'] / 5;
            $result = floor($result) + 1;
        }
        //총 페이지 수가 5이하
        if ($result <= 5) {
            $first = 1;
            $last = $result;
            //총 페이지 수가 5초과
        } else {
            //선택한 페이지가 3이하
            if ($a <= 3) {
                $first = 1;
                $last = 5;
                //선택한 페이지가 3이상
            } elseif ($a > 3) {
                $first = $a - 2;
                $last = $a + 2;
                //선택한 페이지가 마지막페이지-2 이상
                if ($last > $_SESSION['result_su']) {
                    $last = $_SESSION['result_su'];
                }
            }
        }
        $nowUrl = $basename = basename($_SERVER["PHP_SELF"]);
        $this->load->view('blog_find', array('result' => $find_result_look, 'first' => $first, 'last' => $last, 'nowPage' => $nowUrl));
        $this->load->view('blog_footer');

    }

    function comment($a)
    {
        $this->blog_model->comment($a, $_POST['comment']);
        $this->look($a);
    }

    function comment_delete($a)
    {
        $this->blog_model->comment_delete($a, $_SESSION['name'], $_SESSION['comment_date']);
        $this->look($a);
    }

}

?>
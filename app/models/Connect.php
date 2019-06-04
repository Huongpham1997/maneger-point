<?php
//
class Connect extends Controller
{

    private $_conn;
    private $_limit;
    private $_page;
    private $_query;
    private $_total;

    const MAX_SIZE = 100; // chỉ cho phép tối đa là 100 record nếu truyền vào lớn hơn thì gán bằng giá trị này

    public function getConnect($sql, $getid = false)
    {
        if ($sql) {
            if ($result = $this->_conn->query($sql)) {
                if ($getid) {
                    $last_id = $this->_conn->insert_id;
                    return $last_id;
                }
                return $result;
            } else {
                echo "Error: " . $sql . "<br>" . $this->_conn->error;
                die();
            }
        }
        return null;
    }

    public function __construct()
    {
        $this->_conn = new mysqli("45.32.112.173", "root", "vps@123", 'quanlidiem');
        $this->_conn->set_charset("utf8");
    }

    public function getData($sql, $limit = 10, $page = 1)
    {
        // validate limit
        if($limit > $this::MAX_SIZE){
            $limit = $this::MAX_SIZE;
        }

        $this->_query = $sql;
        $this->_limit = $limit;
        $this->_page = $page;

        if ($this->_limit == 'all') {
            $query = $this->_query;
        } else {
            $query = $this->_query . " LIMIT " . (($this->_page - 1) * $this->_limit) . ", $this->_limit";
        }
        $rs = $this->_conn->query($query);
        $this->_total = $this->_conn->query($this->_query)->num_rows;

        $result = new stdClass();
        $result->page = $this->_page;
        $result->limit = $this->_limit;
        $result->htmlPages = $this->createLinks($this->_total, "pagination");
        $result->data = $rs;

        return $result;
    }

    public function createLinks($links, $list_class)
    {
        if ($this->_limit == 'all') {
            return '';
        }

        $last = ceil($this->_total / $this->_limit);

        $start = (($this->_page - $links) > 0) ? $this->_page - $links : 1;
        $end = (($this->_page + $links) < $last) ? $this->_page + $links : $last;

        $html = '<ul class="' . $list_class . '">';
        $class = ($this->_page == 1) ? "disabled" : "";
        $html .= '<li class="' . $class . '"><a href="/?url=' . $this->parseUrl()[0] . '?limit=' . $this->_limit . '&page=' . ($this->_page - 1) . '">&laquo;</a></li>';

        if ($start > 1) {
            $html .= '<li><a href="/?url=' . $this->parseUrl()[0] . '?limit=' . $this->_limit . '&page=1">1</a></li>';
            $html .= '<li class="disabled"><span>...</span></li>';
        }

        for ($i = $start; $i <= $end; $i++) {
            $class = ($this->_page == $i) ? "active" : "";
            $html .= '<li class="' . $class . '"><a href="/?url=' . $this->parseUrl()[0] . '?limit=' . $this->_limit . '&page=' . $i . '">' . $i . '</a></li>';
        }

        if ($end < $last) {
            $html .= '<li class="disabled"><span>...</span></li>';
            $html .= '<li><a href="/?url=' . $this->parseUrl()[0] . '?limit=' . $this->_limit . '&page=' . $last . '">' . $last . '</a></li>';
        }

        $class = ($this->_page == $last) ? "disabled" : "";
        $html .= '<li class="' . $class . '"><a href="/?url=' . $this->parseUrl()[0] . '?limit=' . $this->_limit . '&page=' . ($this->_page + 1) . '">&raquo;</a></li>';
        $html .= '</ul>';

        return $html;
    }

    public function parseUrl()
    {
        // var_dump($_GET['url']);die();
        if (isset($_GET['url'])) {// lay ddc url loc filter
            $url = explode('?', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
            return $url;
        }

    }
}
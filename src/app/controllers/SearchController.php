<?php

declare(strict_types=1);

use Phalcon\Mvc\Controller;

class SearchController extends Controller
{

    public function indexAction()
    {
    }
    public function searchAction()
    {
        if (isset($_REQUEST['btn'])) {
            $book = $_REQUEST['book'];
            $arr = explode(" ", $book);
            $str = implode("+", $arr);
            $response = $this->api->getSearchBook($str);
            $this->session->set('details', $response['docs']);
        }
        $this->view->array = $this->session->get('details');
    }
    public function detailAction()
    {
        $str = $this->request->get('id');
        $i = $this->request->get('i');
        $cover = $this->request->get('cover');
        $gi = $this->request->get('gi');
        // echo $str; die;
        $names = $this->session->get('details');
        $response = $this->api->getSingleBook($str);
        $this->view->place = $names[$i]['publish_place'];
        $this->view->author = $names[$i]['author_name'];
        $this->view->publish = $names[$i]['publish_date'][0];
        $this->view->language = $names[$i]['language'];
        $this->view->title = $response['ISBN:' . $str]['details']['title'];
        $this->view->img = $cover;
        $ti = $names[$i]['title'];
        $array = explode(" ", $ti);
        $string = implode("_", $array);
        $arr = explode("'", $string);
        $string = implode("_", $arr);
        $this->view->ti = $string;
        $this->view->gi = $gi;
    }
}

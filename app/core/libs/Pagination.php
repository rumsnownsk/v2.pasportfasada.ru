<?php

namespace app\core\libs;


class Pagination
{
    public $currentPage;
    public $perPage;        // По сколько Записей выводить на страницу
    public $total;          // Общее количество Записей
    public $countPages;     // Количество страниц
    public $uri;

    public function __construct($page, $perPage, $total)
    {
        $this->perPage = $perPage;
        $this->total = $total;
        $this->countPages = $this->getCountPages();
        $this->currentPage = $this->getCurrentPage($page);
        $this->uri = $this->getParams();
    }

    public function __toString()
    {
        return $this->getHtml();
    }

    public function getHtml()
    {
        $back = null; // Ссылка НАЗАД
        $forward = null; // Ссылка НАЗАД
        $startPage = null; // Ссылка НАЗАД
        $endPage = null; // Ссылка НАЗАД
        $page1left = null; // Ссылка НАЗАД
        $page2left = null; // Ссылка НАЗАД
        $page1right = null; // Ссылка НАЗАД
        $page2right = null; // Ссылка НАЗАД

        if ($this->currentPage > 1){
            $back = "<li><a class='nav-link' href='{$this->uri}page=" .($this->currentPage-1). "'>&lt;</a></li>";
        }

        if ($this->currentPage < $this->countPages){
            $forward = "<li><a class='nav-link' href='{$this->uri}page=" .($this->currentPage+1). "'>&gt;</a></li>";
        }

        if ($this->currentPage > 3){
            $startPage = "<li><a class='nav-link' href='{$this->uri}page=1" .($this->currentPage+1). "'>&laquo;</a></li>";
        }

        if ($this->currentPage < ($this->countPages - 2)){
            $endPage = "<li><a class='nav-link' href='{$this->uri}page={$this->countPages}'>&raquo;</a></li>";
        }

        if ($this->currentPage - 2 > 0){
            $page2left = "<li><a class='nav-link' href='{$this->uri}page=" .($this->currentPage-2). "'>".($this->currentPage - 2)."</a></li>";
        }

        if ($this->currentPage - 1 > 0){
            $page1left = "<li><a class='nav-link' href='{$this->uri}page=" .($this->currentPage-1). "'>".($this->currentPage - 1)."</a></li>";
        }

        if ($this->currentPage + 1 <= $this->countPages){
            $page1right = "<li><a class='nav-link' href='{$this->uri}page=" .($this->currentPage+1). "'>".($this->currentPage + 1)."</a></li>";
        }

        if ($this->currentPage + 2 <= $this->countPages){
            $page2right = "<li><a class='nav-link' href='{$this->uri}page=" .($this->currentPage+2). "'>".($this->currentPage + 2)."</a></li>";
        }

        return '<ul class="pagination">'. $startPage.$back.$page2left.$page1left.'<li class="active"><a>'.$this->currentPage.'</a></li>'.$page1right.$page2right.$forward.$endPage.'</ul>';
    }

    // Получаем количество страниц
    public function getCountPages(){
        return ceil($this->total / $this->perPage) ? : 1;
    }

    public function getCurrentPage($page)
    {
        if (!$page || $page<1){
            $page = 1;
        }
        if ($page > $this->countPages){
            $page = $this->countPages;
        }
        return $page;
    }

    public function getStart(){

        return ($this->currentPage - 1) * $this->perPage;
    }

    public function getParams(){
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('?', $url);
        $uri = $url[0] . '?';
        if (isset($url[1])  && $url[1] != ''){
            $params = explode('&', $url[1]);
            foreach ($params as $param) {
                if (!preg_match("#page=#", $param)){
                    $uri .= "{$param}&amp;";
                }
            }
        }
        return $uri;
    }


}
<?php

namespace app\controllers;

use app\core\App;
use app\core\base\Controller;
use app\core\libs\Mail;
use app\core\libs\Pagination;
use app\models\Category;
use app\models\Main;
use app\models\Thanks;
use app\models\Work;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;


class MainController extends Controller
{
    public function __construct($route)
    {
//        $currentTime = time();
//        dd(Work::all()->sortByDesc('finishDate')->slice(0, 2));
        $this->vars['categories'] = Category::all();
        $this->vars['recentWorks'] = Work::all()->sortByDesc('finishDate')->slice(0, 2);
        parent::__construct($route);
    }

    public function indexAction()
    {
        $title = 'Главная';
        $this->set(compact('title'));
    }

    public function worksAction()
    {
//        $categories = Category::all();

        if (isset($_GET['cat_id']) && array_key_exists($_GET['cat_id'], Category::all()->keyBy('id')->toArray())) {

            $category = Category::find($_GET['cat_id']);
            $title = $category->name;

            $total = Work::where('category_id', $_GET['cat_id'])->count();

            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $perPage = 5;
            $pagination = new Pagination($page, $perPage, $total);
            $start = $pagination->getStart();
            $works = Work::where('category_id', $_GET['cat_id'])->offset($start)->limit($perPage)->get();

            Work::checkPhoto($works);

            $this->set(compact('categories', 'title', 'works', 'pagination', 'total', 'category'));

        } else {

            $title = 'Объекты';
            $this->set(compact('categories', 'title'));
        };
    }

    public function contactAction()
    {

    }

    public function aboutAction()
    {

    }

    public function thanksAction()
    {
        $thanks = Thanks::all();
        $this->set(compact('thanks'));
    }

    public function mailAction()
    {
        if ($this->isAjax()){

            $data = [
                'subject' => 'Прозьба перезвонить',
//                'from' => '',
                'to' => 'stevennsk@ngs.ru',
                'body' => "Меня звать ".$_POST['name']
                    .". Мой номер: ".$_POST['phone']
                    .". Пожалуйста, перезвоните мне!",
            ];

            $mail = new Mail($data);
            $mail->run();

            exit;

        }
        echo 'not sent'; exit;
//        $recepient = "vashapochta@gmail.com"; /* почта получателя */
//        $sitename = "vashsaite.ru"; /* сайт с которого пришло письмо */
//
//        $name = trim($_POST["name"]);
//        $phone = trim($_POST["phone"]);
//        $date = trim($_POST["date"]);
//
//        $pagetitle = "Заявка с формы обратного звонка на сайте \"$sitename\"";
//        $message = "Имя: $name \nТелефон: $phone \nДата звонка: $date";
//        mail($recepient, $pagetitle, $message, "Content-type: text/plain; charset=\"utf-8\"\n From: $recepient");
//        dd('yap');
    }

    public function ajaxAction()
    {
//        $this->layout = false;

        if ($this->isAjax()) {
//            $model = new Main();
//            $data = [
//                'answer' => 'ответ с сервера',
//                'code' => 200
//            ];
//            echo json_encode($data);
//            $post = R::findOne('posts', "id = {$_POST['id']}");
//            $this->loadView('_test', compact('post'));
            exit;
        }
        echo '404';
    }


}
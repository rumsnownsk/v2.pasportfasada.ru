<?php

namespace app\controllers;

use app\core\App;
use app\core\base\Controller;
use app\core\libs\Mail;
use app\core\libs\Pagination;
use app\models\Category;
use app\models\Main;
use app\models\Thank;
use app\models\Work;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;


class MainController extends Controller
{
    public function __construct($route)
    {
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


    public function thanksAction()
    {
        $thanks = Thank::all();
        $this->set(compact('thanks'));
    }

    public function lawAction(){

    }

    public function contactAction()
    {

    }

    public function aboutAction()
    {

    }

    public function mapAction(){

    }

    public function captchaAction(){
        if ($this->isAjax()) {
            $captchaBuild = new PhraseBuilder(3, '0123456789');

            $captcha = new CaptchaBuilder(null, $captchaBuild);
            $captcha->setDistortion(false);
            $captcha->build(40, 40);

            $_SESSION['captcha'] = $captcha->getPhrase();

            $data = [
                'code' => 200,
                'image' => $captcha->inline()
            ];
            echo json_encode($data);
            exit;
        }

    }

    public function recallAction()
    {
        if ($this->isAjax()){
            if ($_SESSION['captcha'] !== $_POST['code']){
                echo json_encode([
                    'code' => 400  ,
                    'verify' => false
                ]);
                exit;
            }

            $data = [
                'subject' => 'Прозьба перезвонить',
                'to' => 'stevennsk@ngs.ru',
                'body' => "Меня звать ".$_POST['name']
                    .". Мой номер: ".$_POST['phone']
                    .". Пожалуйста, перезвоните мне!",
            ];

            $mail = new Mail($data);
            $mail->run();
            echo json_encode([
                'code' => 200,
                'verify' => true
            ]);
            exit;

        }
        redirect();
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
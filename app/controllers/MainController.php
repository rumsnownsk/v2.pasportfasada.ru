<?php

namespace app\controllers;

use app\core\base\Controller;
use app\core\libs\Mail;
use app\models\Category;
use app\models\Thank;
use app\models\Work;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use JasonGrimes\Paginator;
use League\Plates\Engine;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;
use Twig\Loader\FilesystemLoader;


class MainController extends Controller
{
    public function __construct(Engine $view)
    {
        $this->vars['categories'] = Category::all();

        $recentWorks = Work::all()->sortByDesc('finishDate')->slice(0, 2);

        $this->vars['recentWorks'] = $recentWorks->each(function ($r) {
            $r->timeCreate = $this->changeFormatDate($r->timeCreate);
            return $r;
        });

        parent::__construct($view);
    }

    public function indexAction()
    {
        $title = 'Главная';

        $this->render('main/index', [
            'title' => $title,
        ]);
    }

    public function worksAction($cat_id = null)
    {
        if ($cat_id && array_key_exists($cat_id, Category::all()->keyBy('id')->toArray())) {

            $categoryName = Category::find($cat_id)->title;

            $works = Work::where('category_id', $cat_id)->get();

            $totalItems = $works->count();
            $itemsPerPage = 4;
            $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $urlPattern = '/works/'.$cat_id.'?page=(:num)';

            $paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);

            $start = ($currentPage-1) * $itemsPerPage ;

            $works = $works->slice($start, $itemsPerPage);

            $this->render('main/works', [
                'title' => 'Объекты',
                'works' => $works,
                'paginator' => $paginator,
                'total' => $totalItems,
                'categoryName' => $categoryName
            ]);

        } else {

            $title = 'Объекты';
            $this->render('main/works', [
                'title' => $title,
            ]);
        };
    }


    public function thanksAction()
    {
        $title = 'Благодарности';
        $thanks = Thank::all();

        $this->render('main/thanks', [
            'title' => $title,
            'thanks' => $thanks
        ]);
    }

    public function lawAction()
    {
        $title = 'Закон';
        $this->render('main/law',[
        'title' => $title
        ]);
    }

    public function contactAction()
    {
        $title = 'Закон';

        $this->render('main/contact', [
            'title' => $title,
        ]);
    }

    public function aboutAction()
    {
        $title = 'О нас';

        $this->render('main/about', [
            'title' => $title,
        ]);
    }

    public function mapAction()
    {
        $title = 'Карта';

        $this->render('main/map', [
            'title' => $title,
        ]);
    }

    public function captchaAction()
    {
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
        if ($this->isAjax()) {
            if ($_SESSION['captcha'] !== $_POST['code']) {
                echo json_encode([
                    'code' => 400,
                    'verify' => false
                ]);
                exit;
            }

            $data = [
                'subject' => 'Прозьба перезвонить',
                'to' => 'stevennsk@ngs.ru',
                'body' => "Меня звать " . $_POST['name']
                    . ". Мой номер: " . $_POST['phone']
                    . ". Пожалуйста, перезвоните мне!",
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
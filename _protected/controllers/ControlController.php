<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Images;
use app\models\News;

class ControlController extends Controller
{
    /**
     * Метод выводит формы для заполнения
     * Сохраняет данные (таб. News и табл. Images) в БД (при успешной валидации)
     * для введенного URL для News определяет title страницы (по данному URL)
     */
    public function actionIndex()
    {
        $news = new News();
        $images = new Images();
        // если модель заполнена данными из POST и сохранение данных (вместе с валидацией)
        // достаточно заполнение любой из форм (поле title для news заполнять не обязательно)
        if ( 
             (
               $news->load(Yii::$app->request->post()) &&
               $news->calculateUrlTitle() && // метод определения имени ссылки (по значению url)
               $news->save()
             ) ||
             ($images->load(Yii::$app->request->post()) && $images->save())
            ) {
            return $this->redirect(['/control/index']); // перенапривить сюда же (вывести заполнить форму)
        }
        else {
            return $this->render('create', [
                'news' => $news,
                'images' => $images
            ]);
        }
    }

    /**
     * Метод очищает все записи в таблице News
     * Перенаправляет на заполнение формы
     */
    public function actionClearNews()
    {
        News::deleteAll();
        return $this->redirect(['/control/index']);
    }

    /**
     * Метод очищает все записи в таблице Img
     * Перенаправляет на заполнение формы
     */
    public function actionClearImages()
    {
        Images::deleteAll();
        return $this->redirect(['/control/index']);
    }
}
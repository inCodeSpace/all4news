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
     * Метод сохраняет данные (таб. News и табл. Images) в БД (при успешной валидации)
     */
    public function actionIndex()
    {
        $news = new News();
        $images = new Images();
        // если модель заполнена данными из POST и сохранение данных (вместе с валидацией)
        // достаточно полное заполнение либо одной либо 2-й формы
        if ( ($news->load(Yii::$app->request->post()) && $news->save()) ||
             ($images->load(Yii::$app->request->post()) && $images->save())
            ) {
            return $this->redirect(['/control/index']); // вывести заполнить форму
        } else {
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
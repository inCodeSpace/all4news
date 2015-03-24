<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;

class DropController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index', ['model' => 'Для сброса таблицы, вызовите: <b>drop/news</b> либо <b>drop/images</b>']);
    }

    /**
     * Метод вызова сброса таблицы News
     */
    public function actionNews()
    {
        return $this->Drop('news');
    }

    /**
     * Метод вызова сброса таблицы Images
     */
    public function actionImages()
    {
        return $this->Drop('images');
    }

    /**
     * Метод реализующий сброс таблицы, по переданному имени
     */
    private function Drop($tableName)
    {
        if (Yii::$app->db->schema->getTableSchema($tableName, true) === null) { // если таблицы еще нет
            return $this->render('index', ['model' => 'Таблица <b>' . $tableName .'</b> пока не существует',]);
        } else { // если таблица есть - выведем удалим и выведем сообщение.
            Yii::$app->db->createCommand()->dropTable($tableName)->execute(); // Удалим таблицу с помощью DAO:
            return $this->render('index', ['model' => 'Таблица <b>' . $tableName . '</b> удалена',]);
        }
    }
}
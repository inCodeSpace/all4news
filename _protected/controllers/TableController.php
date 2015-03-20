<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Images;
use app\models\News;
use yii\helpers\Html;

/**
 * Использовать только для создания структуры БД.
 * Использовать только перед созданием рабочего проекта.
 * Удалить данный файл из рабочего проекта.
 */
class TableController extends Controller
{
    /**
     * Метод создает таблицу Imges и News
     * Перед созданием проверяет если уже такие таблицы.
     */
    public function actionAdd()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB'; // параметры таблиц
        // Создание табл. Images
        // Проверим - можно ли получить информацию о таблице, если нет - создадим таблицу.
        if (Yii::$app->db->schema->getTableSchema('images', true) === null) {
            // Создание таблицы Images с помощью DAO:
            Yii::$app->db->createCommand()->createTable('images', [
                'images_id' => 'SMALLINT(6) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
                'url' => 'VARCHAR(5000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL',
            ], $tableOptions)->execute();
            $model = 'Таблица Images создана. ';
        } else { // если она уже создана
            $model = 'Таблица Images не создана, т.к. уже существует. ';
        }
        // Создание табл. News
        if (Yii::$app->db->schema->getTableSchema('news', true) === null) {
            // Создание таблицы News с помощью DAO:
            Yii::$app->db->createCommand()->createTable('news', [
                'news_id' => 'SMALLINT(6) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
                'title' => 'VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL',
                'url' => 'VARCHAR(5000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL',
            ], $tableOptions)->execute();
            $model .= 'Таблица News создана.';
        } else { // если она уже создана
            $model .= 'Таблица News не создана, т.к. уже существует.';
        }
        return $model; // Вывод сообщения результата выполнения.
    }
}
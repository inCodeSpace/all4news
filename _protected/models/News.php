<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property integer $news_id
 * @property string $title
 * @property string $url
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url'], 'required'],
            [['title'], 'string', 'max' => 120],
            [['url'], 'string', 'max' => 5000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'news_id' => 'News ID',
            'title' => 'Новость:',
            'url' => 'Url:',
        ];
    }

    /**
     * Метод реализовывающий нахождение имя (title страницы) ссылки (по значению ссылки)
     * title берется из ссылки сайта новости
     * передает ошибку в обработку формы, в том случае если не удается получить title по URL
     * если не удается определить название, title устанавливается значение сайт
     * ограничивает(обрезает) полученное значение title по кол-ву макс. доп. символов (учит. кириллицу)
     */
    public function calculateUrlTitle()
    {
        if ($this->title === '') { // Если название не устанавливалось (при заполн. формы)
            // взять title сходив по данному url
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $this->url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $grab = curl_exec($curl);
            curl_close($curl);
            if (!$grab) { // если не может обработать ссылку
                // битая ссылка, ошибка соединения либо не может определить title
                $this->addError('title', '(!) Не удается сформировать заголовок для данной ссылки');
                return false;
            }
            // Подстановка рег. выражения (все что внутри тегов 2-х типов и s - если таблуция внутри title)
            $pattern = '#(<title>(.*)</title>)|(<TITLE>(.*)</TITLE>)#s';
            preg_match($pattern, $grab, $matches);
            $new_title = trim($matches[2] . $matches[4]); // подставится 1-о из значений (результат для <title> или <TITLE>)
            if ($new_title === '') { // если title не удалось извлечь
                $new_title = 'сайт'; // присвоить произвольное значение
            }
            // Обрезка вычисленного title (если превышен диапазон поля)
            if (iconv_strlen($new_title, 'UTF-8') > 120) { // если больше поля в таблице БД
                //удалить пробелы в строке, обрезать и добавить многоточие в конец строки
                $new_title = iconv_substr(trim($new_title), 0, 118, 'UTF-8') . "..";
            }
            $this->title = $new_title;
        }
        return true;
    }
}
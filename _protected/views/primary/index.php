<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
?>

<ul id="urlBox">
    <?php
    foreach ($news as $arr) {
        if ($arr['title'] === '') { // если пустое значение новости.
            $arr['title'] = 'сайт';
        }
        echo '<li>' . Html::a($arr['title'], $arr['url'], ['target' => '_blank']) . "</li>";
    } ?>
</ul>

<?php
if (!empty($images)) { // если есть картинки, вывести панель
    echo '
        <div id="imgText">Картинки:</div>
        <a id="panel_title" href="javascript:changePanel()">Развернуть</a>
        <div id="panel">
    ';
    foreach ($images as $arr) {
        echo '<img src=" ' . $arr['url'] . ' "><br>';
    }
    echo '
        </div>
        <a id="panel_title2" href="javascript:changePanel()">Свернуть</a>
    ';
    $this->registerJsFile(Yii::$app->homeUrl . 'js/jsPanel.js'); // с адрессом от корня
}
?>

<!-- Очистка News и Images -->
<?php
if ( !empty($news) || !empty($images) ) { // если есть новости либо картинки, вывести кнопку очистки
    echo '<br>' . Html::a('Просмотренно', ['/primary/clear-all'], ['id' => 'clearButtC']);
}
?>
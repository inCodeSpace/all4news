<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\AppAssetAdm;

/* @var $this yii\web\View */
/* @var $model app\models\Books */
/* @var $form yii\widgets\ActiveForm */

AppAssetAdm::register($this);
?>
  <!-- Форма Добавление News -->
    <?php $form = ActiveForm::begin([
        // 'id' => 'my-form', // указать id-формы (по умолч. с bootstrap id=w0)
        'options' => ['class' => 'mForm form1'], // указать класс формы
        // 'action' => 'otheract', // действие для обработки данных из формы (по умолч. тот же контр. что и выводит форму)
        // 'enableAjaxValidation' => 'false', // отменить AJAX валидацию данных
        // 'enableClientValidation' => 'false', // отменить клиентскую валидацию данных
    ]) ?>
    <br>
    <span class="mFormText" style="color: green; letter-spacing: 4px;">Добавление News:</span><br><br>

    <?php $news->title = 'news'; ?> <!-- Для установки значение textarea по умолчанию -->
    <?= $form->field($news, 'title')->textarea([
        'rows' => 2, // Высота поля в строках текста
        'cols' => 45, // Ширина поля в символах (но по умолч. перекрывается bootstrap)
        'size' => 20, // Размер
        'class' => 'inputData',
    ])->label($news->title, ['class' => 'mFormText']); // с заданием класса для label?>

    <?= $form->field($news, 'url')->textarea([
        'rows' => 2, // Высота поля в строках текста
        'cols' => 45, // Ширина поля в символах (но по умолч. перекрывается bootstrap)
        'size' => 20, // Размер
        'class' => 'inputData',
    ])->label($news->url, ['class' => 'mFormText']); // с заданием класса для label ?>


    <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
    <br>
    <!-- Очистка News -->
    <?= Html::a('Очистить News', ['/control/clear-news'], ['class' => 'btn btn-danger clearButt']); ?>
    <?php ActiveForm::end(); ?>

  <!-- Форма Добавление Img -->
    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'mForm form2'],
    ]) ?>
    <br>
    <span class="mFormText" style="color: green; letter-spacing: 4px;">Добавление Img:</span><br><br>

    <?= $form->field($images, 'url')->textarea([
        'rows' => 2,
        'cols' => 45,
        'size' => 20,
        'class' => 'inputData',
    ])->label($images->url, ['class' => 'mFormText']); ?>

    <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
    <br>
    <!-- Очистка Img -->
    <?= Html::a('Очистить News', ['/control/clear-images'], ['class' => 'btn btn-danger clearButt']); ?>
    <?php ActiveForm::end(); ?>
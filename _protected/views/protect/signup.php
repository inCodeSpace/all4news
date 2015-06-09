<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\assets\AppAssetAdm;

AppAssetAdm::register($this);
$this->registerCss('
    .col-lg-5 { /* Выравнивание формы по центру */
        float: none;
        margin: auto;
    }
');

$this->title = 'Зарегистрироваться: ';
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <div class="form-group">
                    <?= Html::submitButton('Отправить данные', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

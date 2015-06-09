<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\LoginForm;
use app\models\SignupForm;

class ProtectController extends Controller
{

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) { // если пользователь уже залогинился
            return $this->redirect(['/control/index']); // на админ. страницу
        }
        $model = new LoginForm();
        // Если есть данные из заполн. формы - обработать их, либо отправить на заполнение
        // Заполнить модель данными из формы и попытаться залогинится (в соотв. с переданными параметрами)
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack(); // перенаправит на последнюю использ. страницу
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout(); // выйти пользователю из системы
        return $this->goHome(); // отправить его на главную (не админ. страницу)
    }

    public function actionSignup() // Закоментировать для заливки на сервер
    {
        $model = new SignupForm(); // Создается объект модели
        // Если форма уже заполнялась - обработать данные:
        // Заполнить модель данными из формы (Попробовать выполнить успешно)
        if ($model->load(Yii::$app->request->post())) {
            // Вызвать метод модели SignupForm::signup (Попробовать выполнить успешно)
            if ($user = $model->signup()) { // в случае успеха сюда
                // придет объект модели User с заполненными полями (который так же, будет implements IdentityInterface)
                // Залогинится используя Yii:
                    // - Вернуть пользовательский компонент и залогинить его передав
                    //  в него объект пользователя (Попробовать выполнить успешно)
                if (Yii::$app->getUser()->login($user)) {
                    return $this->redirect(['/control/index']); // на админ. страницу
                }
            }
        }
        // Заполнить форму
        return $this->render('signup', [
            'model' => $model,
        ]);
    }

}
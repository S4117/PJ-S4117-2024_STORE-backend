<?php

namespace app\controllers;

use yii\rest\ActiveController;
use app\models\User; // Import the User model class

class UserController extends ActiveController
{
    public $modelClass = 'app\models\User'; // Model class của bạn

    // Định nghĩa các actions của API
    public function actions()
    {
        $actions = parent::actions();
        // Tắt các actions mặc định không cần thiết
        unset($actions['index'], $actions['view'], $actions['create'], $actions['update'], $actions['delete']);
        return $actions;
    }

    // Action để lấy danh sách người dùng
    public function actionIndex()
    {
        $users = User::find()->all(); // Use the User model class directly
        return $users;
    }

    // Action để xem chi tiết một người dùng
    public function actionView($id)
    {
        $user = \app\models\User::findOne($id);
        return $user;
    }

    // Action để tạo mới một người dùng
    public function actionCreate()
    {
        $user = new \app\models\User();
        $user->load(\Yii::$app->request->getBodyParams(), '');
        if ($user->save()) {
            return $user;
        } else {
            return $user->errors;
        }
    }

    // Action để cập nhật thông tin người dùng
    public function actionUpdate($id)
    {
        $user = \app\models\User::findOne($id);
        $user->load(\Yii::$app->request->getBodyParams(), '');
        if ($user->save()) {
            return $user;
        } else {
            return $user->errors;
        }
    }

    // Action để xóa một người dùng
    public function actionDelete($id)
    {
        $user = \app\models\User::findOne($id);
        if ($user->delete()) {
            return true;
        } else {
            return false;
        }
    }
}

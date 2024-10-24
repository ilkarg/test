<?php

namespace app\controllers\api;

use Yii;
use yii\web\Controller; // Используем обычный контроллер
use yii\web\Response;
use app\models\Product;

class ProductController extends Controller
{
    // ... (остальной код контроллера)

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    // Действия REST API
    public function actionGetAll()
    {
        // $products = Product::find()->all();
        // return $this->asJson($products);
        return $this->asJson(['message' => 'hello, world']);
    }

    public function actionGetOne($id)
    {
        $product = Product::findOne($id);
        if ($product) {
            return $this->asJson($product);
        } else {
            return $this->asJson(['error' => 'Product not found'], 404);
        }
    }

    public function actionCreateOne()
    {
        $model = new Product();
        if ($model->load(Yii::$app->request->post(), '') && $model->save()) {
            return $this->asJson($model);
        } else {
            return $this->asJson($model->getErrors(), 422);
        }
    }

    public function actionUpdateOne($id)
    {
        $model = Product::findOne($id);
        if ($model && $model->load(Yii::$app->request->post(), '') && $model->save()) {
            return $this->asJson($model);
        } else {
            return $this->asJson(['error' => 'Product not found or failed to update'], 404);
        }
    }

    public function actionDeleteOne($id)
    {
        $model = Product::findOne($id);
        if ($model && $model->delete()) {
            return $this->asJson(['success' => true]);
        } else {
            return $this->asJson(['error' => 'Product not found or failed to delete'], 404);
        }
    }

    // Вспомогательные функции (можно вынести в отдельный класс)
    public function asJson($data, $statusCode = 200)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        Yii::$app->response->statusCode = $statusCode;
        return $data;
    }
}

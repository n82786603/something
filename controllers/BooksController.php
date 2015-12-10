<?php

namespace app\controllers;

use app\models\forms\BookCover;
use Yii;
use app\models\books\Model;
use app\models\books\Search;
use yii\filters\AccessControl;
use yii\filters\ContentNegotiator;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * BooksController implements the CRUD actions for Model model.
 */
class BooksController extends Controller
{

    CONST FILTERED_LINK_KEY = 'filtered_link_key';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['view', 'index', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }


    /**
     * Lists all Model models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        Url::remember(Url::to(''), static::FILTERED_LINK_KEY);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'authorsAssoc' => \app\models\authors\Model::getAllAsAssoc()
        ]);
    }

    /**
     * Displays a single Model model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->getRequest()->getIsAjax()) {
            return $this->renderJSON($this->findModel($id));
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Model model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Model();
        $cover = new BookCover();
        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->getRequest()->post('BookCover')) {
                $cover->cover = UploadedFile::getInstance($cover, 'cover');
                $cover->fill($model);
            }
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        } else {
            return $this->render('create', [
                'cover' => $cover,
                'model' => $model,
                'authorsAssoc' => \app\models\authors\Model::getAllAsAssoc()
            ]);
        }
    }

    /**
     * Updates an existing Model model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $cover = new BookCover();
        if ($model->load(Yii::$app->request->post())) {
            $bookCoverPost = Yii::$app->getRequest()->post('BookCover');
            $cover->cover = UploadedFile::getInstance($cover, 'cover');
            if ($bookCoverPost && $cover->cover) {
                $cover->fill($model);
            }
            var_dump($model->save(),$model->release_date);
            if ($model->save()) {
                var_dump(Url::previous(static::FILTERED_LINK_KEY));
                return $this->redirect(Url::previous(static::FILTERED_LINK_KEY));
            }
        } else {
            return $this->render('update', [
                'cover' => $cover,
                'model' => $model,
                'authorsAssoc' => \app\models\authors\Model::getAllAsAssoc()
            ]);
        }
    }

    /**
     * Deletes an existing Model model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        if (file_exists(\Yii::getAlias('@covers') . DIRECTORY_SEPARATOR . $model->preview_path_hash)) {
            unlink(\Yii::getAlias('@covers') . DIRECTORY_SEPARATOR . $model->preview_path_hash);
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Model model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Model the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Model::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    /**
     * @param Object|array $data
     * @return string
     */
    protected function renderJSON($data)
    {
        header('Content-type: application/json');
        return json_encode($data);
    }
}

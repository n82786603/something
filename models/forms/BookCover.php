<?php
/**
 * Created by PhpStorm.
 * User: cejixo3
 * Date: 10.12.15
 * Time: 22:41
 */

namespace app\models\forms;


use yii\base\Model;
use yii\web\UploadedFile;

class BookCover extends Model
{

    /**
     * @var UploadedFile
     */
    public $cover;

    public function rules()
    {
        return [
            [['cover'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif, bmp'],
        ];
    }


    /**
     * @param \app\models\books\Model $model
     * @return bool
     */
    public function fill(\app\models\books\Model $model)
    {
        $oldFileNameHash = $model->preview_path_hash;
        if (!$this->cover) {

            $model->setAttributes([
                'preview_path' => null,
                'preview_path_hash' => null
            ], false);

            return true;
        }

        $fileName = $this->cover->baseName . '.' . $this->cover->extension;
        $fileNameHash = sha1($this->cover->baseName . time()) . '.' . $this->cover->extension;
        $this->cleanOldFile($oldFileNameHash, $fileNameHash, $model);
        if ($this->validate()) {
            $model->setAttributes([
                'preview_path' => $fileName,
                'preview_path_hash' => $fileNameHash
            ], false);
            $this->cover->saveAs(\Yii::getAlias('@covers') . DIRECTORY_SEPARATOR . $fileNameHash);
            return true;
        } else {
            return false;
        }
    }


    /**
     * @param $filePath
     * @return void
     */
    protected function cleanOldFile($oldFilePath, $filePath, \app\models\books\Model $model)
    {
        if ($oldFilePath && ($oldFilePath !== $filePath)) {
            if (file_exists(\Yii::getAlias('@covers') . DIRECTORY_SEPARATOR . $oldFilePath)) {
                unlink(\Yii::getAlias('@covers') . DIRECTORY_SEPARATOR . $oldFilePath);
            }else{
                $model->preview_path_hash = null;
                $model->preview_path = null;
            }
        }
    }
}
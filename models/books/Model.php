<?php

namespace app\models\books;

use app\interfaces\enum\ITables;
use app\models\authors\Model as AuthorsModel;
use JsonSerializable;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "books".
 *
 * @property integer $id
 * @property string $name
 * @property string $author
 * @property integer $author_id
 * @property string $preview_path
 * @property string $preview_path_hash
 * @property string|null $coverWebPath
 * @property integer $release_date
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $release_date_end;
 * @property integer $release_date_start;
 * @property AuthorsModel $authorModel
 */
class Model extends \yii\db\ActiveRecord implements JsonSerializable
{
    public $author;
    public $release_date_end;
    public $release_date_start;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return ITables::BOOKS;
    }


    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'preview_path'], 'string'],
            [['name', 'author_id'], 'required'],
            [['author_id', 'created_at', 'release_date', 'updated_at'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Book Name'),
            'author_id' => Yii::t('app', 'Author'),
            'preview_path' => Yii::t('app', 'Preview Path'),
            'release_date' => Yii::t('app', 'Release Date'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }


    /**
     * @return \yii\db\ActiveQuery|AuthorsModel
     */
    public function getAuthorModel()
    {
        return $this->hasOne(AuthorsModel::className(), ['id' => 'author_id']);
    }


    /**
     * @inheritdoc
     * @return Query the active query used by this AR class.
     */
    public static function find()
    {
        return new Query(get_called_class());
    }


    /**
     * @return null|string
     */
    public function getCoverWebPath()
    {
        return $this->preview_path_hash ? '/covers/' . $this->preview_path_hash : null;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        return [
            'name' => $this->name,
            'author' => $this->authorModel->fullName,
            'cover_path' => $this->getCoverWebPath(),
            'cover_image_name' => $this->preview_path,
            'release_date' => date('M d, Y', $this->release_date),
            'created_at' => Yii::$app->getFormatter()->asDatetime($this->created_at),
            'updated_at' => Yii::$app->getFormatter()->asDatetime($this->updated_at),
        ];
    }
}

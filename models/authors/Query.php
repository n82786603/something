<?php


namespace app\models\authors;

/**
 * This is the ActiveQuery class for [[app\models\authors\Query]].
 *
 * @see Model
 */
class Query extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Model[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Model|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
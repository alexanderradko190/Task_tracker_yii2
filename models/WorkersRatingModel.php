<?php

namespace app\models;

/**
 * This is the model class for table "workers".
 *
 * @property int $id
 * @property string $fio
 * @property string $email
 * @property int|null $rate
 * @property string|null $phone
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class WorkersRatingModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'workers_rating';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['worker_id'], 'required'],
            [['worker_id', 'rating'], 'integer'],
            [['worker_id', 'rating'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'worker_id' => 'worker_id',
            'rating' => 'rating',

        ];
    }

    public function getWorker()
    {
        return $this->hasOne(WorkerModel::class, ['id' => 'worker_id']);
    }

}

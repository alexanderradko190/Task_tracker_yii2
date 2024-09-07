<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Workers rating
 *
 * @property int $id
 * @property string $fio
 * @property string $email
 * @property int|null $rate
 * @property string|null $phone
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class WorkersRatingModel extends ActiveRecord
{
    //**************** ActiveRecord ************************//

    public static function tableName()
    {
        return 'workers_rating';
    }

    public function rules()
    {
        return [
            [['worker_id'], 'required'],
            [['worker_id', 'rating'], 'integer'],
            [['worker_id', 'rating'], 'safe']
        ];
    }

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

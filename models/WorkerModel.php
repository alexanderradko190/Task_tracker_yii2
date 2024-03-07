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
class WorkerModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'workers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fio', 'email'], 'required'],
            [['rate'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['fio', 'email', 'phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'Fio',
            'email' => 'Email',
            'rate' => 'Rate',
            'phone' => 'Phone',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getTasks()
    {
        return $this->hasMany(TaskModel::class, ['id' => 'tasks_id'])->viaTable('tasks_workers', ['workers_id' => 'id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['workers_id' => 'id']);
    }

    public function getWorkerRating()
    {
        return $this->hasOne(WorkersRatingModel::class, ['worker_id' => 'id']);
    }

}

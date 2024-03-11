<?php

namespace app\models;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $name
 * @property string|null $date_end
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class TaskModel extends \yii\db\ActiveRecord
{
    const IS_NEW = 'Новая';
    const AT_WORK = 'В работе';
    const ON_REVIEW = 'На ревью';
    const IN_TEST = 'В тестировании';
    const READY_TO_RELEASE = 'Готова к релизу';
    const NEED_INFO = 'Требует информации';
    const IS_READY = 'Решена';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'date_end'], 'required'],
            [['name'], 'string', 'max' => 120],
            [['date_end', 'created_at', 'updated_at', 'user_id'], 'safe'],
            [['name', 'description', 'status', 'story_point'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Исполнитель',
            'name' => 'Название задачи',
            'description' => 'Описание задачи',
            'date_end' => 'Дедлайн',
            'status' => 'Статус',
            'story_point' => 'Story point',
            'created_at' => 'Создана',
            'updated_at' => 'Updated At',
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if ($this->status === self::IS_READY && $this->user_id) {
            $workerRating = WorkersRatingModel::findOne(['worker_id' => $this->user_id]);
            if (!$workerRating) {
                $workerRating = new WorkersRatingModel();
                $workerRating->worker_id = $this->user_id;
            }
            $workerRating->rating += $this->story_point;
            $workerRating->save();
        }
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getWorkerRating()
    {
        return $this->hasOne(WorkersRatingModel::class, ['worker_id' => 'user_id']);
    }

}

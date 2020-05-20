<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'News';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if(Yii::$app->user->identity): ?>
        <p>
            <?= Html::a('Create News', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            'descr:ntext',
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php: F d, Y'],
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => Yii::$app->user->identity
                    ? '{view} {update} {delete}'
                    : '{view}'
            ],
        ],
    ]); ?>


</div>

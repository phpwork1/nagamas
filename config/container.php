<?php

return [
    Yii::$container->set('yii\grid\GridView', [
        'tableOptions' => [
            'class' => 'table table-striped table-responsive table-hover table-vcenter text-nowrap',
        ],
        'layout'=>"<div class='box'><div class='box-header'>{summary}<div class='box-tools'>{pager}</div></div><div class=\"box-body table-responsive\">{items}</div></div>",
    ]),

    Yii::$container->set('yii\grid\ActionColumn', [
        'header' => 'Actions',
        'contentOptions' => ['class' => 'text-nowrap'],
        'template' => '{view} {update} {delete}',
        'buttons' => [
            'view' => function ($url, $model) {
                return yii\helpers\Html::a('<i class="glyphicon glyphicon-eye-open"></i>', $url, ['class' => 'btn-sm btn-info', 'title' => Yii::t('yii', 'Lihat Rincian Untuk item ini.'),]);
            },
            'update' => function ($url, $model) {
                return yii\helpers\Html::a('<i class="glyphicon glyphicon-pencil"></i>', $url, ['class' => 'btn-sm btn-warning', 'title' => Yii::t('yii', 'Ubah data item ini.'),]);
            },
            'delete' => function ($url, $model) {
                return yii\helpers\Html::a('<i class="glyphicon glyphicon-remove"></i>', $url, ['class' => 'btn-sm btn-danger', 'title' => Yii::t('yii', 'Hapus data item ini'), 'data' => ['method' => 'post', 'confirm' => 'Yakin ingin menghapus data ini?']]);
            },
        ],
    ]),

    Yii::$container->set('yii\widget\DetailView', [
        'template'=>"<div class='box'><div class='box-header'>{summary}<div class='box-tools'>{pager}</div></div><div class=\"box-body table-responsive\">{items}</div></div>",
    ]),

];
        
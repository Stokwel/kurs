<?php

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Все курсы', 'url' => ['site/courses']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <h1><?=$model->title?></h1>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <?=$model->description?>
    </div>
</div>


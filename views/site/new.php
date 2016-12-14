<?php

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['site/news']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-8">
        <?=$model->created_at?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h1><?=$model->title?></h1>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <?=$model->content?>
    </div>
</div>


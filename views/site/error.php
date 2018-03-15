<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<div class="site-error">

    <div class="jumbotron ">
        <h1><?= $name ?></h1>
        <h2><?= $message ?></h2>
        <p><?= $exception ?></p>
    </div>


</div>

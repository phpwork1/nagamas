<?php

use app\widgets\Alert;

//use common\widgets\Alert;
/* @var $content string */

?>
<div id="page-wrapper">

    <!-- Content Header (Page header) -->
    <section>
        <?php if (isset($this->title)){ ?>
            <h1 class="page-header title-header"> <?= $this->title ?> </h1>
        <?php } ?>
        <div class="pull-right">
            <?php if (isset($this->blocks['page-header'])) { ?>
                <h1><?= $this->blocks['page-header'] ?></h1>
            <?php } else { ?>
                <div class="btn-group">
                    <?php
                    if (isset($this->params['buttons'])):
                        foreach ($this->params['buttons'] as $button):
                            echo $button . '&nbsp;';
                        endforeach;
                    endif;
                    ?>
                </div>
                <div class="btn-group">
                    <?php
                    if (isset($this->params['export'])):
                        echo $this->params['export'];
                    endif;
                    ?>
                </div>
            <?php } ?>
        </div>
    </section>

    <section class="content">
        <div class="main-content">
            <div class="main-content-inner">
                <div class="page-content">
                    <div class="row">
                        <div class="col-lg-12 content-padding-top">
                            <?= Alert::widget(); ?>

                            <!-- PAGE CONTENT BEGINS -->
                            <?php echo $content; ?>
                            <!-- PAGE CONTENT ENDS -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.page-content -->
            </div>
        </div><!-- /.main-content -->
    </section>
</div>


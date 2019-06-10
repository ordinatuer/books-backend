<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <pre>
    <?php
        foreach( $data as $row) {
            print_r([
                $row->x,
                $row->y,
                $row->text,
            ]);
        }
    ?>
    </pre>
</div>

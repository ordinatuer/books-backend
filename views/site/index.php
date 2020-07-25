<?php
/* @var $this yii\web\View */
$name = 'leaflebooks';

$this->title = $name;
?>
<h1>INDEX</h1>
<pre>
<?php

foreach ($tags->teils as $teil) {
	print $teil->text . "\n";
}

?>
</pre>
<ul <?php if(isset($class)){ echo "class='".$class."'";} ?>>
<?php foreach($items as $item): ?>
<li><?= $item["content"]; ?></li>
<?php endforeach ?>
</ul>
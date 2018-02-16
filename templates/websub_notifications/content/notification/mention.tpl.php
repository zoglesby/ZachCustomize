<?php
$notification = $vars['notification'];
$annotation   = $notification->getObject();
$target       = $notification->getTarget();
?>

<strong><a href="<?=$annotation['owner_url']?>"><?=$annotation['owner_name']?></a></strong>
mentioned you on <a href="<?=$annotation['permalink'];?>"><?=$annotation['permalink'];?></a>

<?php
    unset($this->vars['notification']);
?>

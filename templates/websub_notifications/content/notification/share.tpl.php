<?php
$notification = $vars['notification'];
$annotation   = $notification->getObject();
$post         = $notification->getTarget();
?>

<strong><a href="<?=$annotation['owner_url']?>"><?=$annotation['owner_name']?></a></strong>
reshared the post <strong><a href="<?=$post->getDisplayURL();?>"><?=$post->getNotificationTitle()?></a></strong><br>
<br>
<br>
<a href="<?=$post->getDisplayURL()?>">View post</a>
<?php
    unset($this->vars['notification']);
?>

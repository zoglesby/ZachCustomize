<?php
$notification = $vars['notification'];
$annotation   = $notification->getObject();
$post         = $notification->getTarget();
?>

<strong><a href="<?=$annotation['owner_url']?>"><?=$annotation['owner_name']?></a></strong> replied to the post 
<strong><a href="<?=$post->getDisplayURL();?>"><?=$post->getNotificationTitle()?></a></strong>.
<br>
<br>
Here's what they said:<br>
<br>
<blockquote>
    <?=$annotation['content']?>
</blockquote>
<br>
<?php
    if (!empty($post)) {
?>
    <a href="<?=$post->getDisplayURL()?>">View post</a>
<?php

    }

?>
<?php
    unset($this->vars['notification']);
?>

<?php
$notification = $vars['notification'];
$annotation   = $notification->getObject();
$post         = $notification->getTarget();
?>

<strong><a href="<?=$annotation['owner_url']?>"><?=$annotation['owner_name']?></a></strong> RSVPed to the event 
<strong><a href="<?=$annotation['object']->getDisplayURL();?>"><?=$annotation['object']->getNotificationTitle()?></a></strong>.
<br>
<br>
Here's what they said:<br>
<br>
<blockquote>
    <?=$annotation['content']?>
</blockquote>
<br>
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

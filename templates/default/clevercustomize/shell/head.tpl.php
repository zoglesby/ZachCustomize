<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>

<link rel="microsub" href="https://aperture.p3k.io/microsub/307">

<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#333333">

<link href="<?=\Idno\Core\site()->config()->url;?>IdnoPlugins/CleverCustomize/fonts/raleway/stylesheet.css" rel="stylesheet" />
<link href="<?=\Idno\Core\site()->config()->url;?>IdnoPlugins/CleverCustomize/fonts/playfair-display/stylesheet.css" rel="stylesheet" />

<link rel="feed" type="application/json" 
      title="Zach: featured content"
      href="https://zach.oglesby.co/?_t=jsonfeed"/>
<link rel="feed" type="application/json"
      title="Zach: all content"
      href="https://zach.oglesby.co/content/all?_t=jsonfeed"/>
<link rel="feed" type="application/json"
      title="Zach: microblog content"
      href="https://zach.oglesby.co/content/all?_t=microblog"/>

<link rel="stylesheet" href="<?=\Idno\Core\site()->config()->url;?>IdnoPlugins/CleverCustomize/css/custom.css" type="text/css" media="screen" />

<?php
if (!isset($_COOKIE["theme"]) || $_COOKIE["theme"] == "default") {
?>
<style type="text/css">
@media (prefers-color-scheme: dark) {
<?php include dirname(__DIR__) . '/../../../css/dark.css'; ?>
}
</style>
<?php
} else if ($_COOKIE["theme"] == "dark") {
?>
<style type="text/css">
<?php include dirname(__DIR__) . '/../../../css/dark.css'; ?>
</style>
<?php
}
?>

<script src="<?=\Idno\Core\site()->config()->url;?>IdnoPlugins/CleverCustomize/js/custom.js"></script>

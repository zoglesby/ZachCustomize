<style type="text/css">
</style>


<div id="on-this-day-message" class="row">
  <a class="left" href="/onthisday/<?= date('m/d', strtotime(date('Y-m-d', $date) . ' -1 day')) ?>"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></a>
  <a class="right" href="/onthisday/<?= date('m/d', strtotime(date('Y-m-d', $date) . ' +1 day')) ?>"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>

  <h1><i class="fa fa-calendar"></i><?= date('F j', $date) ?></h1>
  <h3>Over the years...</h3>
</div>

<?php

    echo $this->draw('entity/feed');

?>

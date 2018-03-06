<style type="text/css">
  #archive-message {
    background-color: rgba(0, 0, 0, 0.7);
    color: white;
    border-radius: 10px;
    text-align: center;
    padding: 1em 2em;
    width: 85%;
    margin: 0 auto 2em auto;
  }
  #archive-message h3 {
    font-style: italic;
  }
  #archive-message h1, #history-message h3 {
    clear: both;
  }
  .pager {
     display: none;
  }
</style>


<div id="archive-message" class="row">

    <h1><i class="fa fa-calendar"></i><?= $description ?></h1>

</div>

<?php

    echo $this->draw('entity/feed');

?>

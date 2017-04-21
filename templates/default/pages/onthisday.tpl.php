<style type="text/css">
  #on-this-day-message {
    background-color: rgba(0, 0, 0, 0.7);
    color: white;
    border-radius: 10px;
    text-align: center;
    padding: 1em 2em;
    width: 85%;
    margin: 0 auto 2em auto;
  }
  #on-this-day-message h3 {
    font-style: italic;
  }
  #on-this-day-message h1, #on-this-day-message h3 {
    clear: both;
  }
  #on-this-day-message a {
    font-size: 4em;
    color: white;
    padding-top: 0.66em;
    margin-bottom: -2em; 
  }
  #on-this-day-message a:hover {
    color: #4c93cb;
  }
  #on-this-day-message a.left {
    float: left;
    margin-left: 3em;
  }
  #on-this-day-message a.right {
    float: right;
    margin-right: 3em;
  }
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

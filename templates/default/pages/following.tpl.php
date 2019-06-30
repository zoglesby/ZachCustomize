<style type="text/css">
    .following {
        background: white;
        padding: 1em 4em 4em 4em;
    }
    
    @media (min-width: 768px) {
        .channels {
            -webkit-column-count: 1;
            -moz-column-count: 1;
            column-count: 1;
        }
    }

    @media (min-width: 992px) {
        .channels {
            -webkit-column-count: 2;
            -moz-column-count: 2;
            column-count: 2;
        }
    }
    
    .channel {
        border-radius: 5px;
        background: #f6f6f6;
        margin: 1em 0;
        padding: 0.5em 1em 2em 2em;
        break-inside: avoid;
    }
    
    .channel ul {
        margin: 0;
        padding: 0;
    }
    .channel li {
        padding-left: 5px;
        list-style-position: inside;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
    }
</style>

<div>
  <div class="row following">
    <div class="col-md-20 col-md-offset-0">
      <div class="h-feed row">
        <h1 class="p-name"><i class="fa fa-rss"></i> Following</h1>
        <a class="u-url" href="/following" style="display:none">Following</a>
        <a class="u-author" href="https://cleverdevil.io"></a>
        
        <div class="channels">
        <?php
        foreach ($channels as $channel) {
        ?>
        <div class="channel">
          <h2 class="channel-name"><?= $channel['name'] ?></h2>
          <ul class="feeds">
          <?php
          foreach ($channel['feeds'] as $feed) {
            $name = empty($feed->name) ? $feed->url : $feed->name;
          ?>
            <li class="h-entry" id="<?= md5($feed->url) ?>">
              <div class="follow-of-meta" style="display: none">
                <a class="u-author" href="https://cleverdevil.io"></a>
                <span class="p-name">Following <?= $name ?></span>
                <a class="u-url" href="/following#<?= md5($feed->url) ?>"></a>
                <div class="e-content">
                  Following <a href="<?= $feed->url ?>"><?= $name ?></a> since 
                  <time class="dt-published" datetime="<?= date() ?>"></time>
                </div>
              </div>
                
              <a class="u-follow-of" href="<?= $feed->url ?>"><?= $name ?></a>
            </li>
          <?php
          }
          ?>
          </ul>
        </div>
        <?php
        }
        ?>
        </div>
      </div>
    </div>
  </div>
</div>

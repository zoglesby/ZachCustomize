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

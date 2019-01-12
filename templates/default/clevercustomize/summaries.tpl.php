<!-- SUMMARIES -->
<ul id="summaries">
    <?php
    $month = new DateTime();
    $interval = new DateInterval("P1M");
    for ($i = 0; $i < 12; $i++) {
    ?>
        <li><i class="fa fa-calendar"></i> <a href="/summary/<?= $month->format('Y/m') ?>"><?= $month->format('M, Y') ?></a></li>
    <?php  
        date_sub($month, $interval);
    }
    ?>
</ul>

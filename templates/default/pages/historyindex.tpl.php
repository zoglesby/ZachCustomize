<?php

sort($dates);

$years = [];
for ($i = 0; $i < count($dates); $i++) {
    $date = $dates[$i];
    list($year, $month, $day) = explode('-', $date);

    if (!array_key_exists($year, $years)) {
        $years[$year] = [];
    }
    if (!array_key_exists($month, $years[$year])) {
        $years[$year][$month] = [];
    }
    $years[$year][$month][] = $day;
}

?>

<style type="text/css">
    div.history-index a {
        color: #333;
    }
    div.history-index {
        background: white;
        padding: 3em 0 3em 0;
    }
    
    div.history-year {
        clear: both;
        overflow: hidden;
        margin-bottom: 1em;
    }

    div.history-year h2 {
        font-size: 2em !important;
        clear: both;
        margin-bottom: 1em;
    }

    ul.history-month {
        float: left;
        width: 80px;
        list-style-type: none;
        padding: 0;
        margin: 0;
        text-align: center;
    }
    ul.history-month li {
        margin: 1px 1px 0 0;
    }
    div.history-index li:hover {
        background: #357ebd;
    }
    li.history-month {
        background: #333;
    }
    li.history-month > a {
        color: #ccc;
    }
    li.history-day.day-1  { background: #c0c0c0; }
    li.history-day.day-2  { background: #c2c2c2; }
    li.history-day.day-3  { background: #c4c4c4; }
    li.history-day.day-4  { background: #c6c6c6; }
    li.history-day.day-5  { background: #c8c8c8; }
    li.history-day.day-6  { background: #cacaca; }
    li.history-day.day-7  { background: #cccccc; }
    li.history-day.day-8  { background: #cecece; }
    li.history-day.day-9  { background: #d0d0d0; }
    li.history-day.day-10 { background: #d2d2d2; }
    li.history-day.day-11 { background: #d4d4d4; }
    li.history-day.day-12 { background: #d6d6d6; }
    li.history-day.day-13 { background: #d8d8d8; }
    li.history-day.day-14 { background: #dadada; }
    li.history-day.day-15 { background: #dcdcdc; }
    li.history-day.day-16 { background: #dedede; }
    li.history-day.day-17 { background: #e0e0e0; }
    li.history-day.day-18 { background: #e2e2e2; }
    li.history-day.day-19 { background: #e4e4e4; }
    li.history-day.day-20 { background: #e6e6e6; }
    li.history-day.day-21 { background: #e8e8e8; }
    li.history-day.day-22 { background: #eaeaea; }
    li.history-day.day-23 { background: #ececec; }
    li.history-day.day-24 { background: #eeeeee; }
    li.history-day.day-25 { background: #f0f0f0; }
    li.history-day.day-26 { background: #f2f2f2; }
    li.history-day.day-27 { background: #f4f4f4; }
    li.history-day.day-28 { background: #f6f6f6; }
    li.history-day.day-29 { background: #f8f8f8; }
    li.history-day.day-30 { background: #fafafa; }
    li.history-day.day-31 { background: #fcfcfc; }
    
</style>

<div class="row history-index">
    <div class="col-md-10 col-md-offset-1">
        <div>
            <div class="row">
                <h1 class="p-name">History</h1>
                
                <?php
                    $years = array_reverse($years, true);
                    foreach ($years as $year => $months) {
                ?>
                        <div class="history-year">
                             <h2><?= $year ?></h2>
                             <?php
                                foreach ($months as $month => $days) {
                             ?>    
                                    <ul class="history-month">
                                        <li class="history-month">
                                            <a href="https://cleverdevil.io/history/<?=$year?>/<?=$month?>">
                                                <?= date('M', strtotime($year . '-' . $month . '-01')) ?>
                                            </a>
                                        </li>
           
                                    <?php
                                        foreach ($days as $i => $day) {
                                    ?>
                                            <li class="history-day day-<?=$i+1?>">
                                                <a href="https://cleverdevil.io/history/<?=$year?>/<?=$month?>/<?=$day?>">
                                                    <?=$day?>
                                                </a>
                                            </li>
                                    <?php
                                        }
                                    ?>
                                    </ul>
                            <?php
                                }
                            ?>
                        </div>
                    <?php
                            }
                    ?>
         
             </div>
        </div>
    </div>
</div>

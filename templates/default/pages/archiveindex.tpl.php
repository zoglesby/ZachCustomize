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
    h1 {
        margin-top: 1em;
    }
    div.archive-index a {
        color: #333;
    }
    div.archive-index {
        background: white;
        padding: 3em 0 3em 0;
    }
    
    div.archive-year {
        clear: both;
        overflow: hidden;
        margin-bottom: 1em;
    }

    div.archive-year h2 {
        font-size: 2em !important;
        clear: both;
        margin-bottom: 1em;
    }

    ul.archive-month {
        float: left;
        list-style-type: none;
        padding: 0;
        margin: 0;
        text-align: center;
    }
    ul.archive-month li {
        margin: 1px 1px 0 0;
    }
    div.archive-index li:hover {
        background: #357ebd;
    }
    li.archive-month {
        background: #333;
    }
    li.archive-month > a {
        color: #ccc;
    }
    li.archive-day a {
        display: inline-block;
    }
    
    li.archive-day a {
        width: 30px;
    }
    ul.archive-month {
        width: 30px;
    }
    div.archive-index {
        padding: 0 0 0 10px;
    } 
    @media (min-width: 768px) {
        li.archive-day a {
            width: 50px;
        }
        ul.archive-month {
            width: 50px;
        } 
        div.archive-index {
            padding: 0 0 0 40px;
        } 
    }
    @media (min-width: 992px) {
        li.archive-day a {
            width: 60px;
        }
        ul.archive-month {
            width: 60px;
        } 
    }
    @media (min-width: 1200px) {
        li.archive-day a {
            width: 75px;
        }
        ul.archive-month {
            width: 75px;
        }
    }



    li.archive-day.day-1  { background: #c0c0c0; }
    li.archive-day.day-2  { background: #c2c2c2; }
    li.archive-day.day-3  { background: #c4c4c4; }
    li.archive-day.day-4  { background: #c6c6c6; }
    li.archive-day.day-5  { background: #c8c8c8; }
    li.archive-day.day-6  { background: #cacaca; }
    li.archive-day.day-7  { background: #cccccc; }
    li.archive-day.day-8  { background: #cecece; }
    li.archive-day.day-9  { background: #d0d0d0; }
    li.archive-day.day-10 { background: #d2d2d2; }
    li.archive-day.day-11 { background: #d4d4d4; }
    li.archive-day.day-12 { background: #d6d6d6; }
    li.archive-day.day-13 { background: #d8d8d8; }
    li.archive-day.day-14 { background: #dadada; }
    li.archive-day.day-15 { background: #dcdcdc; }
    li.archive-day.day-16 { background: #dedede; }
    li.archive-day.day-17 { background: #e0e0e0; }
    li.archive-day.day-18 { background: #e2e2e2; }
    li.archive-day.day-19 { background: #e4e4e4; }
    li.archive-day.day-20 { background: #e6e6e6; }
    li.archive-day.day-21 { background: #e8e8e8; }
    li.archive-day.day-22 { background: #eaeaea; }
    li.archive-day.day-23 { background: #ececec; }
    li.archive-day.day-24 { background: #eeeeee; }
    li.archive-day.day-25 { background: #f0f0f0; }
    li.archive-day.day-26 { background: #f2f2f2; }
    li.archive-day.day-27 { background: #f4f4f4; }
    li.archive-day.day-28 { background: #f6f6f6; }
    li.archive-day.day-29 { background: #f8f8f8; }
    li.archive-day.day-30 { background: #fafafa; }
    li.archive-day.day-31 { background: #fcfcfc; }
    
</style>

<div class="row archive-index">
    <div class="col-md-10 col-md-offset-1">
        <div>
            <div class="row">
                <h1 class="p-name">Archive</h1>
                
                <?php
                    $years = array_reverse($years, true);
                    foreach ($years as $year => $months) {
                ?>
                        <div class="archive-year">
                             <h2><?= $year ?></h2>
                             <?php
                                foreach ($months as $month => $days) {
                             ?>    
                                    <ul class="archive-month">
                                        <li class="archive-month">
                                            <a href="https://cleverdevil.io/archive/<?=$year?>/<?=$month?>">
                                                <?= date('M', strtotime($year . '-' . $month . '-01')) ?>
                                            </a>
                                        </li>
           
                                    <?php
                                        foreach ($days as $i => $day) {
                                    ?>
                                            <li class="archive-day day-<?=$i+1?>">
                                                <a href="https://cleverdevil.io/archive/<?=$year?>/<?=$month?>/<?=$day?>">
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

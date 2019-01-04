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
                                            <a href="https://cleverdevil.io/summary/<?=$year?>/<?=$month?>">
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

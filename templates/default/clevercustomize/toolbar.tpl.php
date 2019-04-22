<script type="text/javascript">
  function setThemePreference(preference) {
    Cookies.set('theme', preference);
    window.location.reload(false);
  }
</script>

<div id="theme-switcher">
  <a href="#" onclick="setThemePreference('default'); return null;">
    <div><i class="fa fa-globe-americas <?= ($_COOKIE['theme'] == 'default' || $_COOKIE['theme'] == null) ? 'active' : '' ?>"></i></div>
  </a>
  <a href="#" onclick="setThemePreference('dark'); return null;">
    <div><i class="fa fa-moon <?= $_COOKIE['theme'] == 'dark' ? 'active' : '' ?>"></i></div>
  </a>
  <a href="#" onclick="setThemePreference('light'); return null;">
    <div><i class="fa fa-sun <?= $_COOKIE['theme'] == 'light' ? 'active' : '' ?>"></i></div>
  </a>
</div>

<?php
if ($_SERVER['REQUEST_URI'] != "/now") {
?>


<div id="current-status" onclick="window.location.href='/now'">
<?php
    $status_file = fopen("current.json", "r");
    $raw_json = fgets($status_file);
    $status = json_decode($raw_json, true);
    
    $battery_icon = "fa-battery-full";
    if ($status['battery_level'] <= 0.75) {
        $battery_icon = "fa-battery-three-quarters";
    }
    if ($status['battery_level'] <= 0.5) {
        $battery_icon = "fa-battery-half";
    }
    if ($status['battery_level'] <= 0.25) {
        $battery_icon = "fa-battery-quarter";
    }
    if ($status['battery_level'] <= 0.05) {
        $battery_icon = "fa-battery-empty";
    }

    $wifi_state = "wifi-disconnected";
    if (strlen($status['wifi']) > 0) {
        $wifi_state = "wifi-connected";
    }

    $motion_icon = "fa-couch"; // stationary
    foreach ($status['motion'] as $value) {
        if ($value == "driving") {
            $motion_icon = "fa-car";
        } else if ($value == "walking") {
            $motion_icon = "fa-shoe-prints";
        } else if ($value == "running") {
            $motion_icon = "fa-walking";
        } else if ($value == "cycling") {
            $motion_icon = "fa-bicycle";
        }
    }
?>
    <div id="battery"><i class="fa <?= $battery_icon ?> <?= $status['battery_state'] ?>"></i></div>
    <div id="wifi"><i class="fa fa-wifi <?= $wifi_state ?>"></i></div>
    <div id="motion"><i class="fa <?= $motion_icon ?>"></i></div>
    <div id="location"><i class="fa fa-map-marker"></i></div>
</div>

<?php
}
?>

<div class="🕸💍">
  <a href="https://🕸💍.ws/⛈🛍✈️/previous">👈🏼</a>
  <a href="https://🕸💍.ws/">🕸💍</a>
  <a href="https://🕸💍.ws/⛈🛍✈️/next">👉🏼</a>
</div>

<?php

    include("templates/default/shell/toolbar/main.tpl.php");

?>

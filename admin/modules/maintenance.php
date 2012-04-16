<?php
$user = 1;
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once('../../config.inc.php');
require_once(ROOT_DIR . 'classes/MaintenanceTables.inc.php');

$mTables = new MaintenanceTables();
if (!isset($_GET['t'])) {
    echo "<HEAD><meta http-equiv=\"REFRESH\" content=\"0;url=" . HOME ."admin/modules/list_tree.php\"></HEAD>";
}
$id = $_GET['t'];
?>
<h1>Maintenance for Tree: <a href ="edit_tree.php?t=<?php echo $id;?>"><?php echo $id;?></a></h1>
<a href="list_tree.php">Tree List</a><br>
<h2>Report Maintenance</h2>
<?php
$types = $mTables->getTypes(0);
foreach ($types as $type) {
    $tname = $type['ty'];
    $tyid = $type['tyid'];
    echo "<h3>{$tname}</h3>";
    if (isset($_POST[$tyid])) {
//      echo "Boom<br>";
        $comments = $_POST["comments{$tyid}"];
        $mTables->logEvent($id, $tyid, $comments, $user);
    }
    ?>
    <form name="maintenance" action="maintenance.php?t=<?php echo $id; ?>" method="POST">
    <input type="hidden" name="<?php echo $tyid;?>" value="true">
    <input type="submit" value="Log <?php echo $tname;?> Event">
    Comments: <input type="input" name="comments<?php echo $tyid;?>" value="NA">
    </form>
    <?php
    $events = $mTables->getHist($id, $tyid);
    $i = 0;
    while (isset($events[$i]) && $i < 5) {
        $event = $events[$i];
        echo "{$event['date']} : {$event['comments']}<br>";
        $i++;
    }
    echo "<br />";
}
?>
<h2>Report Damage</h2>
<?php
$types = $mTables->getTypes(1);
foreach ($types as $type) {
    $tname = $type['ty'];
    $tyid = $type['tyid'];
    echo "<h3>{$tname}</h3>";
    if (isset($_POST[$tyid])) {
//      echo "Boom<br>";
        $comments = $_POST["comments{$tyid}"];
        $mTables->logEvent($id, $tyid, $comments, $user);
    }
    ?>
    <form name="maintenance" action="maintenance.php?t=<?php echo $id; ?>" method="POST">
    <input type="hidden" name="<?php echo $tyid;?>" value="true">
    <input type="submit" value="Log <?php echo $tname;?> Event">
    Comments: <input type="input" name="comments<?php echo $tyid;?>" value="NA">
    </form>
    <?php
    $events = $mTables->getHist($id, $tyid);
    $i = 0;
    while (isset($events[$i]) && $i < 5) {
        $event = $events[$i];
        echo "{$event['date']} : {$event['comments']}<br>";
        $i++;
    }
    echo "<br />";
}
?>

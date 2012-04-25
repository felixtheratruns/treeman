<?php
$specid = $_GET['spedId'];

require_once("/var/www/config.inc.php");
require_once(ROOT_DIR . 'classes/species.inc.php');
require_once(ROOT_DIR . 'classes/GenusTable.inc.php');
require_once(ROOT_DIR . 'classes/genus.inc.php');
require_once(ROOT_DIR . 'classes/FlowerMonthsTable.inc.php');
require_once(ROOT_DIR . 'classes/SeedingMonthsTable.inc.php');

if (empty($specid) || !isset($specid) || $specid<1) {

?>
					<div class="post">
                                                <h2 class="title"><a href="#">Unknown Species</a></h2>
                                                <div class="entry">
							<p>You did not select a valid species. Please go back, and try again.</p>
                                                </div>
                                        </div>
                                        <div style="clear: both;">&nbsp;</div>
<?php
}

else {
$s = new species($specid);
$info = $s->getProperties();
$gTable = new GenusTable();
$genus = $gTable->GetAll();
?>
					<div class="post">
                                                <h2 class="title"><a href="#">Species Information</a></h2>
                                                <div class="entry">
							<?php /*<img src="images/unknowntree.gif" style="float: left;">*/ ?>
							<h3>Basic Information</h3>
							<p>Species Name: <?php $info['species']; ?><br />
							Common Name: <?php echo $info['commonname']; ?><br />
							Growth Factor: <?php echo $info['gf']; ?><br />
							Number of Trees: <?php echo $info['count']; ?></p>
							<h3>Regional Information</h3>
							<p>Native to N. America: <?php echo ($info['american'] ? "Yes" : "No"); ?><br />
							Native to Kentucky: <?php echo ($info['ky'] ? "Yes" : "No"); ?></p>
							<h3>Fruit Information</h3>
							<p>Fruit Type: <?php echo $info['fruittype']; ?><br />
							Fruit Edible: <?php echo ($info['edible'] ? "Yes*" : "<strong>No</strong>"); ?><br />
							<strong>*NOTE: Eat at your own risk</strong></p>
                                                </div>
                                        </div>
                                        <div style="clear: both;">&nbsp;</div>

<?php
}
?>

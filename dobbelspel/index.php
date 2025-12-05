<?php
require_once 'Game.php';
session_start();
 
if (!isset($_SESSION['game'])) {
    $_SESSION['game'] = new Game();
}
 
$game = $_SESSION['game'];
$message = "";
$values = null;
 
if (isset($_POST['throw'])) {
    $values = $game->play();
 
    if (is_array($values)) {
        if ($game->allEqual($values)) {
            $message = "<b style='color:green;'>🎉 YAHTZEE! Alle dobbelstenen gelijk!</b>";
        } elseif ($game->hasDoubles($values)) {
            $message = "<i style='color:blue;'>Je hebt ten minste een paar! Bonus!</i>";
        }
    } else {
        $message = $values;
    }
}
 
if (isset($_POST['reset'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dobbelen</title>
</head>
<body>
 
<h1>🎲 Dobbelen die handel ik zeg het je</h1>
 
<form method="POST">
    <button type="submit" name="throw">dobbelen</button>
    <button type="submit" name="reset">Reset spel</button>
</form>
 
<h3>worp: <?= $game->getThrowCount(); ?>/3</h3>
 
<?php if ($values && is_array($values)): ?>
 
    <div style="display:flex;">
 
        <?php
        $color = $game->allEqual($values) ? "lightgreen" : "white";
 
        foreach ($values as $v) {
            echo $game->getDiceSvg($v, $color);
        }
        ?>
 
    </div>
 
    <p><?= $message ?></p>
 
<?php endif; ?>
 
<hr>
 
<h2>High score</h2>
 
<?php foreach ($game->getLog() as $i => $throw): ?>
    Worp <?= $i + 1 ?>:
    <?= implode(", ", $throw) ?><br>
<?php endforeach; ?>
 
</body>
</html>

 

 

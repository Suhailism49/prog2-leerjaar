<?php
require_once __DIR__ . '/Rekenmachine.php';

$calc = new Rekenmachine();
$result = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $getal1 = floatval($_POST['getal1'] ?? 0);
        $getal2 = floatval($_POST['getal2'] ?? 0);
        $operatie = $_POST['operatie'] ?? '+';
        
        switch ($operatie) {
            case '+': $result = $calc->optellen($getal1, $getal2); break;
            case '-': $result = $calc->aftrekken($getal1, $getal2); break;
            case '*': $result = $calc->vermenigvuldigen($getal1, $getal2); break;
            case '/': $result = $calc->delen($getal1, $getal2); break;
            case '^': $result = $calc->macht($getal1, $getal2); break;
            case 'sqrt': $result = $calc->wortel($getal1); break;
            case '%': $result = $calc->percentage($getal1, $getal2); break;
            default: $error = "Ongeldige operatie!";
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Calculator</title>
    <style>
        body { font-family: Arial; max-width: 400px; margin: 50px auto; }
        form { background: #f0f0f0; padding: 20px; border-radius: 5px; }
        input, select { width: 100%; padding: 8px; margin: 5px 0 15px; box-sizing: border-box; }
        button { background: #667eea; color: white; padding: 10px; width: 100%; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: #764ba2; }
        .result { background: #e8f5e9; padding: 15px; margin-top: 20px; border-radius: 5px; }
        .error { background: #ffebee; padding: 15px; margin-top: 20px; border-radius: 5px; color: #c62828; }
    </style>
</head>
<body>
    <h1>🧮 Calculator</h1>
    <form method="POST">
        <label>Getal 1:</label>
        <input type="number" name="getal1" step="any" required value="<?php echo $_POST['getal1'] ?? ''; ?>">
        
        <label>Bewerking:</label>
        <select name="operatie" required>
            <option value="+">+ (Optellen)</option>
            <option value="-">- (Aftrekken)</option>
            <option value="*">× (Vermenigvuldigen)</option>
            <option value="/">÷ (Delen)</option>
            <option value="^">^ (Macht)</option>
            <option value="sqrt">√ (Wortel)</option>
            <option value="%">% (Percentage)</option>
        </select>
        
        <label>Getal 2:</label>
        <input type="number" name="getal2" step="any" value="<?php echo $_POST['getal2'] ?? ''; ?>">
        
        <button type="submit">Berekenen</button>
    </form>
    
    <?php if ($error): ?>
        <div class="error">Fout: <?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    
    <?php if ($result !== null && !$error): ?>
        <div class="result"><strong>Resultaat:</strong> <?php echo number_format($result, 4, ',', '.'); ?></div>
    <?php endif; ?>
</body>
</html>
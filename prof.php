<?php
// ==========================================
// BACKEND - PAJ PWOFEÈ A POU WÈ NÒT YO
// ==========================================

$host = "127.0.0.1";
$user = "root";
$password = "";
$dbname = "sistem_egzamen";

try {
    // 1. Konekte ak database la
    $connexion = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // 2. Mande database la pou l ba nou tout nòt yo, depi sou moun ki fè plis pwen desann (DESC)
    $requete = $connexion->prepare("SELECT * FROM rezilta ORDER BY not_pote DESC");
    $requete->execute();
    
    // 3. Pran tout done yo mete yo nan yon varyab ki rele $tout_not
    $tout_not = $requete->fetchAll(PDO::FETCH_ASSOC);

} catch(PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="ht">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espas Pwofesè - Nòt Egzamen</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f9;
            padding: 30px;
            display: flex;
            justify-content: center;
        }
        .admin-container {
            background: white;
            max-width: 800px;
            width: 100%;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        h1 { color: #2c3e50; text-align: center; margin-bottom: 20px; }
        
        /* Bèl tablo pou afiche nòt yo */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #2c3e50;
            color: white;
        }
        tr:hover { background-color: #f1f2f6; }
        
        /* Ti koulè pou nòt yo (Vèt si l pase, Wouj si l echwe) */
        .badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 14px;
        }
        .badge-pass { background-color: #d4edda; color: #155724; }
        .badge-fail { background-color: #f8d7da; color: #721c24; }
        
        .btn-refresh {
            display: inline-block;
            background: #2980b9;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .btn-refresh:hover { background: #3498db; }
    </style>
</head>
<body>

    <div class="admin-container">
        <h1>👨‍🏫 Tablo de Bò Pwofesè a</h1>
        <p style="text-align: center; color: #7f8c8d;">Gade lis elèv ki fè egzamen an ak nòt yo an tan reyèl.</p>
        
        <a href="pwofesè.php" class="btn-refresh">Yo rale nouvo nòt yo 🔄</a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Non Elèv la</th>
                    <th>Nòt (/100)</th>
                    <th>Estati</th>
                    <th>Dat li fè l</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Si gen done nan database la, n ap afiche yo yonn apre lòt ak yon bouk foreach
                if (count($tout_not) > 0) {
                    foreach($tout_not as $ligne) {
                        echo "<tr>";
                        echo "<td>" . $ligne['id'] . "</td>";
                        echo "<td><strong>" . htmlspecialchars($ligne['non_elev']) . "</strong></td>";
                        echo "<td>" . $ligne['not_pote'] . "</td>";
                        
                        // Ti lojik pou mete bèl koulè sou stati a
                        if ($ligne['not_pote'] >= 50) {
                            echo "<td><span class='badge badge-pass'>Pase</span></td>";
                        } else {
                            echo "<td><span class='badge badge-fail'>Echwe</span></td>";
                        }
                        
                        echo "<td>" . $ligne['dat_egzamen'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' style='text-align:center;'>Okenn elèv poko fè egzamen an.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>
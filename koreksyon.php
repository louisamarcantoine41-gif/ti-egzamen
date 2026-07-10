<?php
// ==========================================
// BACKEND - SISTÈM KOREKSYON OTOMATIK
// ==========================================

// 1. Nou pral verifye si done yo soti nan fòm lan tout bon vre
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 2. N ap resevwa repons elèv la te bay yo nan anvlòp $_POST la
    // "keksyon1" ak "keksyon2" se non nou te bay nan fòm HTML la (name="")
    $repons_elev_1 = $_POST['keksyon1'];
    $repons_elev_2 = $_POST['keksyon2'];
    
    // 3. N ap defini ki repons ki te bon yo (An reyalite, sa t ap soti nan yon database)
    $bon_repons_1 = "Port-au-Prince";
    $bon_repons_2 = "10";
    
    // 4. Nou kreye yon varyab pou n kalkile nòt la (Nou kòmanse nan 0)
    $not_total = 0;
    
    // 5. Verifikasyon Keksyon 1
    if ($repons_elev_1 == $bon_repons_1) {
        $not_total = $not_total + 50; // Chak keksyon vo 50 pwen
    }
    
    // 6. Verifikasyon Keksyon 2
    if ($repons_elev_2 == $bon_repons_2) {
        $not_total = $not_total + 50;
    }
    
    // 7. Afilchaj Rezilta a ak yon ti CSS rapid pou l bèl
  // =======================================================
    // KONEKSYON AK DATABASE POU SERE NÒT LA
    // =======================================================
    
    // 1. Resevwa non elèv la ki soti nan fòm lan
    $non_etudiant = $_POST['nom_etudiant'];
    
    // 2. Enfòmasyon pou konekte nan MySQL Termux
    $host = "127.0.0.1";
    $user = "root";
    $password = "";
    $dbname = "sistem_egzamen";
    
    try {
        // Kreye yon koneksyon sekirize ki rele PDO
        $connexion = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Prepare kòmandman SQL la pou n mete done yo nan tablo a
        $requete = $connexion->prepare("INSERT INTO rezilta (non_elev, not_pote) VALUES (:nom, :note)");
        
        // Konekte varyab PHP yo ak kolòn SQL yo
        $requete->bindParam(':nom', $non_etudiant);
        $requete->bindParam(':note', $not_total);
        
        // Executer kòmandman an! Done yo sere!
        $requete->execute();
        
    } catch(PDOException $e) {
        // Si gen yon pwoblèm koneksyon, n ap afiche l
        echo "Erreur Database: " . $e->getMessage();
    }
    // =======================================================
    ?>
    <!DOCTYPE html>
    <html lang="ht">
    <head>
        <meta charset="UTF-8">
        <title>Rezilta Egzamen</title>
        <style>
            body { font-family: sans-serif; background: #f0f2f5; display: flex; justify-content: center; padding: 40px; }
            .result-card { background: white; padding: 30px; border-radius: 12px; max-width: 500px; width: 100%; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
            h1 { color: #0a3d62; }
            .score { font-size: 48px; font-weight: bold; margin: 20px 0; }
            .pass { color: #27ae60; }
            .fail { color: #e74c3c; }
            .btn-back { display: inline-block; margin-top: 20px; padding: 10px 20px; background: #0a3d62; color: white; text-decoration: none; border-radius: 5px; }
        </style>
    </head>
    <body>
        <div class="result-card">
            <h1>📊 Rezilta Ou</h1>
            <p>Ou fè yon nòt de :</p>
            
            <div class="score <?php echo ($not_total >= 50) ? 'pass' : 'fail'; ?>">
                <?php echo $not_total; ?> / 100
            </div>
            
            <p>
                <?php
                // Ti lojik if/else nou te aprann nan zewo a pou n bay desizyon an
                if ($not_total >= 50) {
                    echo "Félicitations! Ou pase egzamen an! 🎉";
                } else {
                    echo "Désolé, ou pa pase. Fòk ou re-etidye, Bro! 📚";
                }
                ?>
            </p>
            
            <a href="index.php" class="btn-back">Refè Egzamen an 🔄</a>
        </div>
    </body>
    </html>
    <?php

} else {
    // Si yon moun ta ekri http://localhost:8000/koreksyon.php nan navigatè a dirèkteman san l pa pase nan fòm lan
    echo "Ou pa gen dwa antre isit la konsa, fòk ou fè egzamen an anvan! 🛑";
}
?>
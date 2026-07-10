<!DOCTYPE html>
<html lang="ht">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Egzamen Sou entènèt</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f0f2f5;
            color: #333;
            padding: 20px;
            display: flex;
            justify-content: center;
        }
        .quiz-container {
            background: white;
            max-width: 600px;
            width: 100%;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        h1 { text-align: center; color: #0a3d62; margin-bottom: 30px; }
        .question-box {
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        .question-text { font-size: 18px; font-weight: 600; color: #1e272e; margin-bottom: 10px; }
        .options label {
            display: block;
            background: #f8fafc;
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.2s;
        }
        .options label:hover { background: #e0e7ff; border-color: #3b82f6; }
        .options input { margin-right: 10px; }
        .btn-submit {
            background: #0a3d62;
            color: white;
            border: none;
            width: 100%;
            padding: 15px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 10px;
        }
        .btn-submit:hover { background: #1e5f8b; }
    </style>
</head>
<body>

    <div class="quiz-container">
        <h1>📝 Egzamen Kilti Jeneral</h1>
        
        <form action="koreksyon.php" method="POST">
    <div class="question-box" style="background: #e0e7ff; padding: 15px; border-radius: 8px;">
    <label style="font-weight: bold; color: #0a3d62;">Antre Non Ou Konplè :</label>
    <input type="text" name="nom_etudiant" placeholder="Egz: Kensley Jean" required style="margin-top: 10px; padding: 10px; width: 100%; border: 1px solid #ccc; border-radius: 5px;">
</div>
            
            <div class="question-box">
                <p class="question-text">1. Ki kapital peyi Ayiti?</p>
                <div class="options">
                    <label><input type="radio" name="keksyon1" value="Cap-Haitien" required> Kap-Ayisyen</label>
                    <label><input type="radio" name="keksyon1" value="Port-au-Prince"> Pòtoprens</label>
                    <label><input type="radio" name="keksyon1" value="Les Cayes"> Okay</label>
                </div>
            </div>

            <div class="question-box">
                <p class="question-text">2. Konbyen depatman ki gen nan peyi Ayiti?</p>
                <div class="options">
                    <label><input type="radio" name="keksyon2" value="5" required> 5 depatman</label>
                    <label><input type="radio" name="keksyon2" value="10"> 10 depatman</label>
                    <label><input type="radio" name="keksyon2" value="12"> 12 depatman</label>
                </div>
            </div>

            <button type="submit" class="btn-submit">Voye Repons Yo 🚀</button>
        </form>
    </div>

</body>
</html>
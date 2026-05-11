<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recommandation Diététique & Sportive</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&family=Lato:wght@300;400&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #fcfbf9;
            --text-main: #333333;
            --text-muted: #666666;
            --accent: #d4af37; /* Gold accent */
            --accent-hover: #b5952f;
            --card-bg: #ffffff;
            --border-color: #eaeaea;
        }
        body {
            background-color: var(--bg-color);
            color: var(--text-main);
            font-family: 'Lato', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
            color: var(--text-main);
        }
        .navbar {
            background-color: var(--card-bg);
            padding: 20px 50px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            color: var(--accent);
            text-decoration: none;
            letter-spacing: 1px;
        }
        .navbar-nav a {
            text-decoration: none;
            color: var(--text-main);
            margin-left: 30px;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 1px;
            transition: color 0.3s;
        }
        .navbar-nav a:hover {
            color: var(--accent);
        }
        .container {
            flex: 1;
            max-width: 900px;
            margin: 50px auto;
            padding: 0 20px;
            width: 100%;
        }
        .chic-card {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            border: 1px solid var(--border-color);
        }
        .form-group {
            margin-bottom: 25px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .form-control {
            width: 100%;
            padding: 15px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-family: 'Lato', sans-serif;
            font-size: 16px;
            background-color: #fafafa;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }
        .form-control:focus {
            outline: none;
            border-color: var(--accent);
            background-color: #fff;
        }
        select.form-control {
            appearance: none;
        }
        .btn-chic {
            background-color: var(--accent);
            color: white;
            border: none;
            padding: 15px 30px;
            font-family: 'Lato', sans-serif;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
            display: inline-block;
            text-decoration: none;
            text-align: center;
        }
        .btn-chic:hover {
            background-color: var(--accent-hover);
            transform: translateY(-2px);
        }
        .footer {
            text-align: center;
            padding: 30px;
            border-top: 1px solid var(--border-color);
            background-color: var(--card-bg);
            color: var(--text-muted);
            font-size: 13px;
            margin-top: auto;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="#" class="navbar-brand">Elegance Diet</a>
        <div class="navbar-nav">
            <a href="#">Régimes</a>
            <a href="#">Recommandation</a>
            <a href="#">Mon Profil</a>
        </div>
    </nav>
    <div class="container">
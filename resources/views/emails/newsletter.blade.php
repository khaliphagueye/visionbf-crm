<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Nouvelle inscription</title>
</head>
<body>

<h2>Nouvelle inscription à la Newsletter</h2>

<p>Une nouvelle personne vient de s'inscrire.</p>

<hr>

<p><strong>Email :</strong> {{ $newsletter->email }}</p>

<p><strong>Date :</strong> {{ $newsletter->created_at->format('d/m/Y à H:i') }}</p>

</body>
</html>
$uri = "http://127.0.0.1:8000/register"  # adapte si ton serveur tourne ailleurs

$body = @{
    nom = "Jean Dupont"
    email = "jean.dupont@example.com"
    password = "secret123"
    password_confirmation = "secret123"
    rue = "12 rue des Lilas"
    code_postal = "75001"
    ville = "Paris"
    pays = "France"
    telephone = "0601020304"
}

$response = Invoke-RestMethod -Uri $uri -Method Post -Body $body -ContentType "application/x-www-form-urlencoded"

$response
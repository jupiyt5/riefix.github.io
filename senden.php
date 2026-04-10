<?php
// 1. Prüfen, ob die Seite wirklich über den "Senden"-Button (POST) aufgerufen wurde
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 2. Daten aus dem Formular entgegennehmen und absichern
    $name = htmlspecialchars($_POST['benutzername']);
    $email = htmlspecialchars($_POST['benutzermail']);
    $nachricht = htmlspecialchars($_POST['nachricht_text']);

    // 3. E-Mail-Einstellungen definieren
    $empfaenger = "schlebachdigital@gmail.com"; // HIER DEINE EIGENE E-MAIL EINTRAGEN
    $betreff = "Neue Nachricht vom Kontaktformular";

    // 4. Den Text der E-Mail zusammenbauen
    $email_inhalt = "Du hast eine neue Nachricht erhalten:\n\n";
    $email_inhalt .= "Name: " . $name . "\n";
    $email_inhalt .= "E-Mail: " . $email . "\n\n";
    $email_inhalt .= "Nachricht:\n" . $nachricht . "\n";

    // 5. Header-Informationen setzen (Wer sendet? Wem kann geantwortet werden?)
    $headers = "From: noreply@deinewebseite.de\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // 6. Die E-Mail versenden mit der mail() Funktion
    if (mail($empfaenger, $betreff, $email_inhalt, $headers)) {
        // Wenn es geklappt hat:
        echo "<h1>Vielen Dank!</h1><p>Deine Nachricht wurde erfolgreich gesendet.</p>";
    } else {
        // Wenn der Server einen Fehler meldet:
        echo "<h1>Fehler</h1><p>Es gab ein Problem beim Senden der Nachricht.</p>";
    }

    } else {
        // Wenn jemand versucht, die Datei direkt im Browser aufzurufen (ohne Formular)
        echo "Bitte fülle zuerst das Kontaktformular aus.";
    }
}
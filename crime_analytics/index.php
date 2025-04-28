<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Crime Analytics System</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <h1>Crime Analytics System</h1>

    <div class="steps">
        <button class="btn" onclick="window.location.href='location.php'">Fill Location</button>
        <button class="btn" onclick="window.location.href='victim.php'">Fill Victim</button>
        <button class="btn" onclick="window.location.href='officer.php'">Fill Officer</button>
        <button class="btn" onclick="window.location.href='suspect.php'">Fill Suspect</button>
        <button class="btn" onclick="window.location.href='witness.php'">Fill Witness</button>
        <button class="btn" onclick="window.location.href='cases.php'">Fill Cases</button>
        <button class="btn" onclick="window.location.href='court_trial.php'">Fill Court Trial</button>
    </div>

    <div class="actions">
        <button class="btn add-crime" onclick="window.location.href='add_crime.php'">Add Crime</button>
    </div>

</div>

</body>
</html>
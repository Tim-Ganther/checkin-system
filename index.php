<?php

if (!isset($_GET['id'])) {
    die("You need to select a checkin ID (eg. ?id=1) first!");
} else {
    include_once 'includes/db.php';

    $checkin_id = $_GET['id'];
    $sql = "SELECT * FROM checkins WHERE id=$checkin_id";
    $checkin = $pdo->query($sql)->fetch();
    if (empty($checkin['status'])) {
        http_response_code(404);
        die();
    }

    if (isset($_POST['teamid'], $_POST['teamname'], $_POST['teamnumber'])) {
        $teamid = $_POST['teamid'];
        $teamname = $_POST['teamname'];
        $teamnumber = $_POST['teamnumber'];
        $username = $_POST['username'];
        $checkintry = true;

        $sql = "SELECT * FROM checkin_teams WHERE checkin_id=$checkin_id AND team_id=$teamid";
        $teamidcheck = $pdo->query($sql)->fetch();

        if (empty($teamnamecheck['name']) && empty($teamidcheck['team_id'])) {
            $statement = $pdo->prepare("INSERT INTO checkin_teams (checkin_id, team_id, team_name, team_anzahl, username) VALUES (?, ?, ?, ?, ?)");
            $statement->execute(array($checkin_id, $teamid, $teamname, $teamnumber, $username));
            header("Location: ?id=$checkin_id&success");
        } else {
            header("Location: ?id=$checkin_id&failure");
        }
    }
    if (isset($_POST['teamidtest'])) {
        $searched = true;
        $teamid = $_POST['teamidtest'];
        $sql = "SELECT * FROM checkin_teams WHERE checkin_id=$checkin_id AND team_id=$teamid";
        $team = $pdo->query($sql)->fetch();
    }
}
?>

<html>
<title>CheckIn System</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="includes/base_style.css">
<body>
<div class="container">
    <form action="?id=<?php echo $checkin_id; ?>" method="POST">
        <h1><?php echo $checkin['name']; ?></h1>
        <label for="username">Team Captain</label><br>
        <input class="item" type="text" name="username" required><br>
        <label for="teamid">Team ID</label><br>
        <input class="item" type="number" name="teamid" required><br>
        <label for="teamname">Team Name</label><br>
        <input class="item" type="text" name="teamname" required><br>
        <label for="teamnumber">Player Count</label><br>
        <input class="item" type="number" name="teamnumber" required><br>
        <input class="item" type="submit" value="CheckIn">
        <p><?php if (isset($_GET['failure'])) {
                echo "The Team-ID is already checked in. Please continue by checking your participation below.";
            } elseif (isset($_GET['success'])) {
                echo "Checkin successfull. Please continue by checking your participation below.";
            } ?></p>
    </form>
</div>
<div class="container">
    <form action="?id=<?php echo $checkin_id; ?>" method="POST">
        <h1>CheckIn Status</h1>
        <label for="teamidtest">Team ID</label><br>
        <input class="item" type="number" name="teamidtest" required><br>
        <input class="item" type="submit" value="Check">
        <p><?php if (!empty($team)) {
                echo "The Team named " . $team['team_name'] . " (ID: " . $team['team_id'] . ") has completed the checkin. " . $team['username'] . " registered it with " . $team['team_anzahl'] . " players.";
            } elseif ($searched) {
                echo "There was no checked in team found using the entered ID.";
            } ?></p>
    </form>
</div>
</body>
</html>

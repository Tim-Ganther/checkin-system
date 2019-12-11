<?php
$user = $_SERVER['PHP_AUTH_USER'];
$pass = $_SERVER['PHP_AUTH_PW'];
if($user == "User" && $pass == "Password"){

  include_once '../includes/db.php';
?>
<html>
<title>CheckIn Backend</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../includes/base_style.css">
<body>
<div class="container">
<?php
  if(!isset($_GET['id'])){
    if(isset($_GET['checkinidtoggle'])){
      $toggleid = $_GET['checkinidtoggle'];
      $sql = "SELECT * FROM checkins WHERE id=$toggleid";
      $checkintoggle = $pdo->query($sql)->fetch();
      if($checkintoggle['status'] == 1){
        $toggledstatus = 0;
      }else{
        $toggledstatus = 1;
      }
      $statement = $pdo->prepare("UPDATE checkins SET status = ? WHERE id = ?");
      $statement->execute(array($toggledstatus, $toggleid));
      header("Location: ../admin/");
    }
    if(isset($_POST['checkinname'])){
      $newname = $_POST['checkinname'];
      $statement = $pdo->prepare("INSERT INTO checkins (name) VALUES (?)");
      $statement->execute(array($newname));
    }
    $sql = "SELECT * FROM checkins ORDER BY id DESC";
    echo "<h1>CheckIns</h1>";
    echo "<table>";
    echo "<tr>";
    echo "<td>Checkin ID</td>";
    echo "<td>Checkin Name</td>";
    echo "<td>Checkin Status</td>";
    echo "<td>Action</td>";
    echo "</tr>";
    foreach ($pdo->query($sql) as $row) {
      echo "<tr>";
      echo "<td><a href=\"../admin/?id=".$row['id']."\"><input type=\"submit\" value=\"".$row['id']."\"></a></td>";
      echo "<td>".$row['name']."</td>";
      echo "<td>".$row['status']."</td>";
      echo "<td><a href =\"../admin/?checkinidtoggle=".$row['id']."\"><input type=\"submit\" value=\"Toggle\"></a></td>";
      echo "</tr>";
   }
   echo "<form action=\"../admin/\" method=\"POST\"><tr>";
   echo "<td>-</td>";
   echo "<td><input type=\"text\"name=\"checkinname\" required></td>";
   echo "<td>0</td>";
   echo "<td><input type=\"submit\" value=\"Add\"></td>";
   echo "</tr></form>";
   echo "</table>";
 }else{
  $checkin_id  = $_GET['id'];
  $sql = "SELECT * FROM checkins WHERE id=$checkin_id";
  $checkin = $pdo->query($sql)->fetch();
  $sql = "SELECT * FROM checkin_teams WHERE checkin_id = $checkin_id";
  echo "<h1>Checkedin Teams</h1>";
  echo "<h2>".$checkin['name']."</h2>";
  echo "<table>";
  echo "<tr>";
  echo "<td>Team Captain</td>";
  echo "<td>Team ID</td>";
  echo "<td>Team Name</td>";
  echo "<td>Team Player Count</td>";
  echo "</tr>";
  foreach ($pdo->query($sql) as $row) {
    echo "<tr>";
    echo "<td>".$row['username']."</td>";
    echo "<td>".$row['team_id']."</td>";
    echo "<td>".$row['team_name']."</td>";
    echo "<td>".$row['team_anzahl']."</td>";
    echo "</tr>";
 }
 echo "</table>";
}
?>
</div>
</body>
</html>
<?php
}else{
  header('WWW-Authenticate: Basic realm="Adminbereich"');
	header('HTTP/1.0 401 Unauthorized');
	die ("Not authorized");
}
 ?>

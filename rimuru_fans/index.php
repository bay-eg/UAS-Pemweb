<?php

$host = 'localhost';
$db = 'rimuru_fans';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

class fans {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function saveData($data) {
        $stmt = $this->pdo->prepare("INSERT INTO fans (name, gender, interests, fandom_level, browser, ip_address) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute($data);
    }

    public function getData() {
        $stmt = $this->pdo->query("SELECT * FROM fans");
        return $stmt->fetchAll();
    }
}

$fanData = new fans($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $interests = isset($_POST['interests']) ? implode(', ', $_POST['interests']) : '';
    $fandomLevel = $_POST['fandom_level'];
    $browser = $_SERVER['HTTP_USER_AGENT'];
    $ip = $_SERVER['REMOTE_ADDR'];


    $fanData->saveData([$name, $gender, $interests, $fandomLevel, $browser, $ip]);
    

    $_SESSION['message'] = "Data successfully submitted!";
    header("Location: " . $_SERVER['PHP_SELF']);
}

$fans = $fanData->getData();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fans Rimuru</title>
    <link rel="stylesheet" href="styles.css">
    <script src="script.js" defer></script>
</head>
<body>
    <h1>Welcome to Rimuru Fans Club</h1>

    <?php if (isset($_SESSION['message'])): ?>
        <p style="color: green;"> <?php echo $_SESSION['message']; ?> </p>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <form id="fanForm" method="POST" action="">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>

        <label>Gender:</label>
        <input type="radio" name="gender" value="Male" required> Male
        <input type="radio" name="gender" value="Female" required> Female<br>

        <label>Interests:</label>
        <input type="checkbox" name="interests[]" value="Anime"> Anime
        <input type="checkbox" name="interests[]" value="Manga"> Manga
        <input type="checkbox" name="interests[]" value="Games"> Games<br>

        <label for="fandom_level">Fandom Level:</label>
        <select id="fandom_level" name="fandom_level" required>
            <option value="">Choose Level</option>
            <option value="Beginner">Beginner</option>
            <option value="Intermediate">Intermediate</option>
            <option value="Expert">Expert</option>
        </select><br>

        <button type="submit">Submit</button>
    </form>

    <h2>Fan Data</h2>
    <table id="fanTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Interests</th>
                <th>Fandom Level</th>
                <th>Browser</th>
                <th>IP Address</th>
                <th>Submitted At</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($fans as $fan): ?>
                <tr>
                    <td><?php echo $fan['id']; ?></td>
                    <td><?php echo $fan['name']; ?></td>
                    <td><?php echo $fan['gender']; ?></td>
                    <td><?php echo $fan['interests']; ?></td>
                    <td><?php echo $fan['fandom_level']; ?></td>
                    <td><?php echo $fan['browser']; ?></td>
                    <td><?php echo $fan['ip_address']; ?></td>
                    <td><?php echo $fan['created_at']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

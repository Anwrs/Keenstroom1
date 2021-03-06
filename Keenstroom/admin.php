<?php
session_start();
include 'config/profile/profile_acc.php';
include 'config/admin/admin_server.php';

if (isset($_SESSION['user'])) {
    if (($_SESSION['user'] == 'ADMIN') || ($_SESSION['user'] == 'admin')) {} else {
        header('Location:profile.php');
        exit;
    }
} else {
    header("Location:log-in.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/favicon.png" type="image/gif" sizes="16x16">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/admin.css">
    <title>Admin</title>
</head>

<body class="adminbody">
    <header>
        <div class="nav">
            <div class="navimg">
                <a href="index.php"><img src='images/logo/cover1.png' alt="cover-logo"></a>
            </div>

            <div class="navbar">
                <nav class="bar">
                    <a href="index.php"><i class="fas fa-home"></i> HOME</a>
                    <a href="problem.php"><i class="fas fa-exclamation-circle"></i> PROBLEMS</a>
                    <a href="profile.php"><i class="fas fa-user-circle"></i> PROFILE</a>
                </nav>
            </div>
        </div>
    </header>

    <main>
        <div class="profielbox">
            <div class="all">
                <div class="left">
                <?php
                    echo '<img src="images/logo/profile1.png" style="background:' . $color[$n] . ';" alt="Logo">';
                ?>
                <h1>
                    <?php echo $_SESSION['user'];?>
                </h1>
                </div>

                <div class="right">
                    <div class="searchbar">
                        <form action="admin.php" method="post">
                        <input type="text" name="username" placeholder="Enter username/email" />
                        <input type="submit" name="all" value="Show all" />
                        <input type="submit" name="search" value="Search" />
                        </form>
                    </div>
                    <div class="base">
                        <table>
                            <tr>
                                <th>ID</th>
                                <th>NAME</th>
                                <th>EMAIL</th>
                                <th>GENDER</th>
                                <th>TOOLS</th>
                            </tr>

                            <?php if (isset($_POST['all']) || empty($_POST['search'])):
                                foreach ($data as $row):?>
                                    <tr>
                                    <td><?= $row['id'] ?></td>
                                    <td><?= $row['username'] ?></td>
                                    <td><?= $row['email'] ?></td>
                                    <td><?= $row['gender'] ?></td>
                                    <td><form action="admin.php" method="post"><button type="submit" name="delete" value="<?= $row['id']?>">Delete</button></form></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>

                            <?php if (isset($_POST['search'])): ?>
                                <tr>
                                    <?php foreach ($check as $user): ?>
                                            <td><?= $user ?></td>
                                    <?php endforeach; ?>
                                    <td><form action="admin.php" method="post"><button type="submit" name="delete" value="<?= $user['id']?>">Delete</button></form></td>
                                </tr>
                            <?php endif; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <script src="https://kit.fontawesome.com/82664ff85a.js" crossorigin="anonymous"></script>

</body>
</html>

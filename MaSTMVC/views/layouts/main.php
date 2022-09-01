<?php

use app\core\Application;

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />

    <title><?php echo $this->title ?></title>

    <link rel="stylesheet" href="../views/css/main.css" />
    <link rel="stylesheet" href="../views/css/catalogue.css" />
    <link rel="stylesheet" href="../views/css/modal.css" />
    <link rel="stylesheet" href="../views/css/profile.css" />
    <link rel="stylesheet" href="../views/css/myCatalogue.css" />
    <link rel="stylesheet" href="../views/css/stamps.css" />
    <link rel="stylesheet" href="../views/css/alerts.css" />
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />

<!--    <script src="../views/js/modal.js" defer></script>-->
    <script src="../views/js/warnings.js" defer></script>
</head>

<body>

    <nav>
        <div class="logo">Stamp Worldn't</div>
        <input type="checkbox" id="click" name="checkbox" />
        <label for="click" class="menu-btn" id="clickbtn">
            <i class="fas fa-bars"></i>
        </label>
        <?php if (Application::isGuest()) : ?>
        <ul>
            <li><a <?php if($this->title==="Home") echo "class=\"active\"" ?>  href="/MaSTMVC/index.php/">Home</a></li>
            <li><a <?php if($this->title==="Catalogue") echo "class=\"active\"" ?> href="/MaSTMVC/index.php/catalogue">Catalogue</a></li>
            <li><a <?php if($this->title==="Login") echo "class=\"active\"" ?> href="/MaSTMVC/index.php/login">Log in</a></li>

        </ul>
        <?php else : ?>
        <ul>
            <li><a <?php if($this->title==="Home") echo "class=\"active\"" ?> href="/MaSTMVC/index.php/">Home</a></li>
            <li><a <?php if($this->title==="Profile") echo "class=\"active\"" ?> href="/MaSTMVC/index.php/profile">Profile</a></li>
            <li><a <?php if($this->title==="Catalogue") echo "class=\"active\"" ?> href="/MaSTMVC/index.php/catalogue">Catalogue</a></li>
            <li><a <?php if($this->title==="Logout") echo "class=\"active\"" ?> href="/MaSTMVC/index.php/logout">Log out</a></li>
        </ul>
        <?php endif; ?>
    </nav>
    <div class="container">

        <?php if(Application::$app->session->getFlash('succes')): ?>
            <div class="alert success">
                <span class="closebtn">&times;</span>
                <strong>
                    <?php echo Application::$app->session->getFlash('succes') ?>
                </strong>
            </div>

        <?php endif; ?>


        {{content}}
    </div>
    <footer>
        <div>Stamp Worldn't</div>
        <div>Made by Ciobotaru Mihai, Grigorita Vlad, Radu Chelaru</div>
    </footer>
    <script src="../views/js/navbarfix.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>
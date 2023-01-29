<!DOCTYPE html>
<html lang="eng">

<head>
    <link rel="stylesheet" href="footer.css">
</head>

<body>
</body>
<footer>
        <div class="footer">
            <div class="footer-left">
                <img src="logo_white_small.png" class="logo">
                <p>Communicate with others through our forum!</p>
            </div>
            <?php if (array_key_exists("login_user", $_SESSION)) {
                ?>
            <ul class="footer-right">
                <li>
                    <h2 class="footer-title">Explore</h2>
                    <ul class="explore">
                        <li><a href="popular.php">Popular</a></li>
                        <li><a href="topics.php">Topics</a></li>
                    </ul>
                </li>

                <li>
                    <h2 class="footer-title">Legal</h2>
                    <ul class="legal">
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </li>

                <li>
                    <h2 class="footer-title">Contact</h2>
                    <ul class="about">
                        <li>+31 (0)20 525 1401 </li>
                        <li><p>Science Park 904 1098 XH Amsterdam</p></li>
                        <li><p>servicedesk-fs@uva.nl</p></li>
                </li>
            </ul>
            <?php
                    } else {
                ?>

            <ul class="footer-right">
                <li>
                    <h2 class="footer-title">Explore</h2>
                    <ul class="explore">
                        <li><a href="popular.php">Popular</a></li>
                        <li><a href="topics.php">Topics</a></li>
                    </ul>
                </li>

                <li>
                    <h2 class="footer-title">Legal</h2>
                    <ul class="legal">
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </li>

                <li>
                    <h2 class="footer-title">Get Started</h2>
                    <ul class="start">
                        <li><a href="login.php">Login</a></li>
                        <li><a href="register.php">Register</a></li>
                    </ul>
                </li>

                <li>
                    <h2 class="footer-title">Contact</h2>
                    <ul class="about">
                        <li>+31 (0)20 525 1401 </li>
                        <li><p>Science Park 904 1098 XH Amsterdam</p></li>
                        <li><p>servicedesk-fs@uva.nl</p></li>
                </li>
            </ul>

            <?php
                    }
                ?>

        </div>
        <div class="footer-bottom">
            <p>&copy; WhoAsked 2023</p>
        </div>
    </footer>
<html>
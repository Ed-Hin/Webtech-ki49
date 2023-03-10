<head>
    <link rel="stylesheet" href="footer.css">
</head>
<?php if (array_key_exists("login_user", $_SESSION)) { ?>
<footer class="footer">
    <div class="footer_container">
        <div class="footer-left">
            <img src="logo_white_small.png" class="logo">
            <p class="footer_text">Communicate with others through our forum!</p>
        </div>
        <ul class="footer-right">
            <li>
                <h2 class="footer-title">Explore</h2>
                <ul class="explore">
                    <li><a href="index.php" class="footer_text">Latest Posts</a></li>
                    <li><a href="topics.php" class="footer_text">Topics</a></li>
                </ul>
            </li>

            <li>
                <h2 class="footer-title">Legal</h2>
                <ul class="legal">
                    <li><a href="privacy.php" class="footer_text">Privacy Policy</a></li>
                </ul>
            </li>
            <li>
                <h2 class="footer-title">Contact</h2>
                <ul class="about">
                    <li>+31 (0)20 525 1401</li>
                    <li>
                        <p class="footer_text">Science Park 904 1098 XH Amsterdam</p>
                    </li>
                    <li>
                        <p class="footer_text">servicedesk-fs@uva.nl</p>
                    </li>
            </li>
        </ul>
    </div>
    <div class="footer-bottom">
        <p class="footer_text">&copy; WhoAsked 2023</p>
    </div>
</footer>
<html>
<?php
} else {
?>
<footer>
    <div class="footer_container">
        <div class="footer-left">
            <img src="logo_white_small.png" class="logo">
            <p class="footer_text">Communicate with others through our forum!</p>
        </div>
        <ul class="footer-right">
            <li>
                <h2 class="footer-title">Explore</h2>
                <ul class="explore">
                    <li><a href="index.php" class="footer_text">Latest Posts</a></li>
                    <li><a href="topics.php" class="footer_text">Topics</a></li>
                </ul>
            </li>

            <li>
                <h2 class="footer-title">Legal</h2>
                <ul class="legal">
                    <li><a href="privacy.php" class="footer_text">Privacy Policy</a></li>
                </ul>
            </li>

            <li>
                <h2 class="footer-title">Get Started</h2>
                <ul class="start">
                    <li><a href="login.php" class="footer_text">Login</a></li>
                    <li><a href="register.php" class="footer_text">Register</a></li>
                </ul>
            </li>

            <li>
                <h2 class="footer-title">Contact</h2>
                <ul class="about">
                    <li>+31 (0)20 525 1401 </li>
                    <li>
                        <p class="footer_text">Science Park 904 1098 XH Amsterdam</p>
                    </li>
                    <li>
                        <p class="footer_text">servicedesk-fs@uva.nl</p>
                    </li>
            </li>
        </ul>
    </div>
    <div class="footer-bottom">
        <p class="footer_text">&copy; WhoAsked 2023</p>
    </div>
</footer>
<html>
<?php
}
?>
<html>
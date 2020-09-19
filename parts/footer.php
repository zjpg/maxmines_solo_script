<footer <?php if( !isset($_COOKIE['xmr_address']) && $_SERVER['REQUEST_URI'] == '/account') echo "style=\"position: fixed; bottom: 0px; \""; ?>>
    <nav class="navbar navbar-expand-md navbar-dark">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <p> © <a target="_blank" href="https://maxmines.com" style="color: #9ba8fe;">MaxMines Team</a> <span id="year"></span>.</p>
            </li>
        </ul>
        <div class="nav-bar-right">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a target="_blank" class="nav-link" href="https://www.youtube.com/channel/UCRaHiKkQVWIZxQKN00ID5iQ"><i class="fa fa-youtube-play"></i> Hướng dẫn</a>
                </li>
                <?php if(isset($_COOKIE['xmr_address'])): ?>
                <li class="nav-item">
                    <a target="_blank" class="nav-link" href="#" id="logout"><i class="fa fa-sign-out"></i> Thoát</a>
                </li>
                <?php endif; ?>
                    
            </ul>
        </div>
    </nav>
</footer>
</body>
</html>
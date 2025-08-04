<div class="mil-loader mil-active" style="    z-index: 200;">
    <div class="mil-loader-content">
        <div class="mil-loader-logo">
            <img src="img/logo.png" alt="Logo">
        </div>
        <div class="mil-loader-progress">
            <div class="mil-loader-bar"></div>
            <div class="mil-loader-percent">0%</div>
        </div>
    </div>
</div>

<div class="mil-top-panel" style="    z-index: 150;" >
    <div class="container">
        <div class="mil-top-panel-content">
            <a href="./index" class="mil-logo">
                <img src="img/logo.png" alt="aquarelle">
            </a>
            <div class="mil-menu-btn">
                <span></span>
            </div>
            <div class="mil-mobile-menu">
                <nav class="mil-menu">
                    <ul>


                        <li><a class="nav-link" href="./index">HOME</a></li>
                        <li><a class="nav-link" href="./rooms">ROOMS</a></li>
                        <li><a class="nav-link" href="./restaurant">RESTAURANT/MENU</a></li>
                        <li><a class="nav-link" href="./services">TAXI SERVICES</a></li>
                        <li><a class="nav-link" href="./contact">CONTACT US</a></li>

                    </ul>
                </nav>
                <a href="./rooms" class="mil-button mil-open-book-popup mil-top-panel-btn disabled_2" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bookmark">
                        <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                    </svg>
                    <span>Book now</span>
                </a>
            </div>
        </div>
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the current URL path
        var currentPath = window.location.pathname;

        // Select all nav-link elements
        var navLinks = document.querySelectorAll('.nav-link');

        // Debugging output
        console.log('Current path:', currentPath);
        console.log('Nav links:', navLinks);

        // Iterate over each nav-link element
        navLinks.forEach(function(navLink) {
            // Get the href attribute of the nav-link
            var href = navLink.getAttribute('href');

            // Debugging output
            console.log('Processing href:', href);

            // Check if href is valid and not empty
            if (href && href !== '#') {
                // Convert href to absolute path for comparison
                var linkPath = new URL(href, window.location.origin).pathname;

                // Debugging output
                console.log('Link path:', linkPath);

                // Normalize currentPath and linkPath for comparison
                var normalizedCurrentPath = currentPath.replace(/\/$/, ''); // Remove trailing slash
                var normalizedLinkPath = linkPath.replace(/\/$/, ''); // Remove trailing slash

                // Check if the current path matches the link path
                if (normalizedCurrentPath.endsWith(normalizedLinkPath)) {
                    // Add the 'mil-current' class to the active link
                    navLink.classList.add('select_nav');
                    console.log('Class "mil-current" added to:', href);
                } else {
                    // Optionally, you can remove the 'mil-current' class from other links
                    navLink.classList.remove('select_nav');
                    console.log('Class "mil-current" removed from:', href);
                }
            }
        });
    });
</script>
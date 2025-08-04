<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coming Soon - hotel sriman palace</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #3498db 100%);
            min-height: 100vh;
            color: white;
            overflow-x: hidden;
        }

        .ocean-waves {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 200px;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none"><path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" fill="rgba(255,255,255,0.1)"/></svg>') repeat-x;
            animation: wave 10s linear infinite;
        }

        @keyframes wave {
            0% { background-position-x: 0; }
            100% { background-position-x: 1200px; }
        }

        .container {
            text-align: center;
            z-index: 10;
            position: relative;
            max-width: 600px;
            padding: 2rem;
            margin: 0 auto;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .logo {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 1rem;
            color: #87ceeb;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            animation: fadeInDown 1s ease-out;
        }

        .hotel-name {
            font-size: 4rem;
            font-weight: 300;
            margin-bottom: 0.5rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            animation: fadeInUp 1s ease-out 0.5s both;
        }

        .coming-soon {
            font-size: 2rem;
            margin-bottom: 2rem;
            opacity: 0.9;
            animation: fadeInUp 1s ease-out 1s both;
        }

        .message {
            font-size: 1.2rem;
            margin-bottom: 3rem;
            line-height: 1.6;
            opacity: 0.8;
            animation: fadeInUp 1s ease-out 1.5s both;
        }

        .countdown {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-bottom: 3rem;
            animation: fadeInUp 1s ease-out 2s both;
        }

        .countdown-item {
            background: rgba(255, 255, 255, 0.1);
            padding: 1.5rem;
            border-radius: 10px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            min-width: 80px;
        }

        .countdown-number {
            font-size: 2rem;
            font-weight: bold;
            display: block;
            color: #87ceeb;
        }

        .countdown-label {
            font-size: 0.8rem;
            opacity: 0.8;
            text-transform: uppercase;
        }

        .contact-info {
            background: rgba(255, 255, 255, 0.1);
            padding: 2rem;
            border-radius: 15px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: fadeInUp 1s ease-out 2.5s both;
        }

        .home-button {
            position: absolute;
            top: 30px;
            left: 30px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 12px 24px;
            border-radius: 25px;
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            animation: fadeInLeft 1s ease-out 0.5s both;
        }

        .home-button:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .contact-title {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #87ceeb;
        }

        .contact-details {
            font-size: 1rem;
            line-height: 1.8;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .floating-elements {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .bubble {
            position: absolute;
            background: rgba(135, 206, 235, 0.2);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .bubble:nth-child(1) {
            width: 60px;
            height: 60px;
            left: 10%;
            top: 20%;
            animation-delay: 0s;
        }

        .bubble:nth-child(2) {
            width: 40px;
            height: 40px;
            right: 15%;
            top: 30%;
            animation-delay: 2s;
        }

        .bubble:nth-child(3) {
            width: 80px;
            height: 80px;
            left: 70%;
            top: 60%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% { 
                transform: translateY(0px) scale(1);
                opacity: 0.7;
            }
            50% { 
                transform: translateY(-20px) scale(1.1);
                opacity: 1;
            }
        }

        @media (max-width: 768px) {
            .hotel-name {
                font-size: 2.5rem;
            }
            
            .coming-soon {
                font-size: 1.5rem;
            }
            
            .countdown {
                flex-wrap: wrap;
                gap: 1rem;
            }
            
            .countdown-item {
                min-width: 70px;
                padding: 1rem;
            }
            
            .countdown-number {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <!-- Home Button -->
    <a href="index.php" class="home-button">🏠 Home</a>

    <!-- Floating Elements -->
    <div class="floating-elements">
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
    </div>

    <!-- Ocean Waves -->
    <div class="ocean-waves"></div>

    <!-- Main Content -->
    <div class="container">
        <div class="logo">🌊</div>
        
        <h1 class="hotel-name">hotel sriman palace</h1>
        
        <h2 class="coming-soon">Coming Soon</h2>
        
        <p class="message">
            We are preparing to offer you an exceptional hospitality experience. 
            Stay tuned for our grand opening!
        </p>

        <!-- Countdown Timer -->
        <div class="countdown">
            <div class="countdown-item">
                <span class="countdown-number" id="days">00</span>
                <span class="countdown-label">Days</span>
            </div>
            <div class="countdown-item">
                <span class="countdown-number" id="hours">00</span>
                <span class="countdown-label">Hours</span>
            </div>
            <div class="countdown-item">
                <span class="countdown-number" id="minutes">00</span>
                <span class="countdown-label">Minutes</span>
            </div>
            <div class="countdown-item">
                <span class="countdown-number" id="seconds">00</span>
                <span class="countdown-label">Seconds</span>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="contact-info">
            <h3 class="contact-title">Stay Connected</h3>
            <div class="contact-details">
                <p>📧 hotel.bluesagarpuri@gmail.com</p>
                <p>📞 +91 7978634893</p>
                <p>📍 Bidhaba Ashram Chaka, Bengali Market<br>Swargadwar, Puri, Odisha</p>
            </div>
        </div>
    </div>

    <script>
        // Countdown Timer
        function updateCountdown() {
            // Set launch date (you can change this to your actual launch date)
            const launchDate = new Date('2025-11-01T00:00:00').getTime();
            const now = new Date().getTime();
            const distance = launchDate - now;
            
            if (distance > 0) {
                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                
                document.getElementById('days').textContent = days.toString().padStart(2, '0');
                document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
                document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
                document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
            } else {
                // Launch date has passed
                document.getElementById('days').textContent = '00';
                document.getElementById('hours').textContent = '00';
                document.getElementById('minutes').textContent = '00';
                document.getElementById('seconds').textContent = '00';
            }
        }

        // Update countdown every second
        setInterval(updateCountdown, 1000);
        updateCountdown(); // Initial call
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from miller.bslthemes.com/aquarele-demo/services.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 15 Nov 2024 06:12:16 GMT -->

<head>
    <?php require("./config/meta.php") ?>

    <style>
        .mil-field-frame select,
        .mil-field-frame input {
            position: relative;
            font-family: "Outfit", sans-serif;
            font-size: 15px;
            color: rgb(34, 139, 34);
            /* Dark green text color */
            padding: 0 20px;
            height: 50px;
            width: 100%;
            border: solid 1px rgb(144, 238, 144) !important;
            /* Light green border */
            border-radius: 5px;
            background-color: rgb(240, 255, 240) !important;
            /* Light greenish background */

            outline: none;
        }


        .mil-field-frame input[readonly],
        .mil-field-frame select[readonly] {
            background-color: #d4edda !important;
            /* Light green background */
            color: #155724 !important;
            /* Dark green text color */
            border: 1px solid #c3e6cb !important;
            /* Light green border */
        }
    </style>

    <style>
        .booking-form-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 30px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #0056b3;
            margin-bottom: 30px;
            text-align: center;
        }

        .btn-custom {
            background-color: #0056b3;
            color: #fff;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
        }

        .btn-custom:hover {
            background-color: #00408d;
        }

        .table th {
            background-color: #eb1c24;
            color: white;
            /* text-align: center; */
            padding: 10px 23px;
            border-radius: 4px;
        }

        .table td {
            /* text-align: center; */
            padding: 10px 23px;
            background-color: antiquewhite;
        }

        .calculation-breakdown {
            margin-top: 20px;
        }
    </style>



    <style>
        /* Basic page styling */

        /* Modal background overlay */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            animation: fadeIn 0.3s ease;
            align-content: center;
        }

        /* Modal content box */
        .modal-content {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            margin: 10% auto;
            padding: 30px 40px;
            border-radius: 15px;
            width: 80%;
            max-width: 400px;
            color: white;
            text-align: center;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            transform: scale(0.9);
            animation: scaleIn 0.5s ease-in-out forwards;
        }

        /* Title and amount styling */
        .modal-title {
            font-size: 19px;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .modal-amount {
            font-size: 22px;
            margin-bottom: 30px;
            font-weight: 600;
            letter-spacing: 1px;
        }

        /* Buttons */
        .modal-button {
            padding: 12px 25px;
            font-size: 18px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 45%;
            margin: 10px;
            transition: all 0.3s ease;
        }

        .pay-now {
            background-color: #00b894;
            color: white;
        }

        .pay-now:hover {
            background-color: #00c2a0;
        }

        .pay-later {
            background-color: #ff6347;
            color: white;
        }

        .pay-later:hover {
            background-color: #ff7f56;
        }

        /* Button container */
        .button-container {
            display: flex;
            justify-content: center;
            gap: 10px;
        }



        /* Animations for modal */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes scaleIn {
            from {
                transform: scale(0.9);
            }

            to {
                transform: scale(1);
            }
        }
    </style>



    <style>
        #loadingOverlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .loading-content {
            text-align: center;
        }

        .spinner {
            margin-top: 10px;
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-top: 4px solid white;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>


</head>

<body>


    <!-- wrapper -->

    <div class="mil-wrapper">



        <?php require("./config/header.php") ?>
        <?php require("./config/config.php") ?>



        <?php

        // Check if ID is set in URL
        if (isset($_GET['id']) && !empty($_GET['id'])) {

            $room_id = $_GET['id'];
            $startDate = $_GET['check_in'];
            $endDate = $_GET['check_out'];
            $total_adult = $_GET['adult'];
            $min_room = $_GET['min_room'];
            $total_availableRooms = $_GET['available'];


            $query = "SELECT * FROM rooms WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $room_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $room = $result->fetch_assoc();

            // Check if room exists
            if (!$room) {
                // Redirect or show error if no room found
                echo "Room not found.";
                exit();
            }
        } else {
            // Redirect or show error if ID is not provided
            echo "Invalid room ID.";
            exit();
        }
        ?>

        <br>
        <br>

        <div class="mil-p-100-60">
            <img src="img/shapes/4.png" class="mil-shape" style="width: 70%; top: 0; right: -12%; transform: rotate(180deg)" alt="shape">
            <img src="img/shapes/4.png" class="mil-shape" style="width: 80%; bottom: -12%; right: -22%; transform: rotate(0deg) scaleX(-1);" alt="shape">
            <div class="container">
                <div class="mil-book-window">
                    <form id="bookingForm">
                        <div class="row ">
                            <div class="col-6">
                                <div class="mil-field-frame">
                                    <label>Check-in</label>
                                    <input id="check-in" type="text" data-position="bottom left" placeholder="Select date" autocomplete="off" readonly="readonly" value="<?= $startDate ?>">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mil-field-frame">
                                    <label>Check-out</label>
                                    <input id="check-out" type="text" data-position="bottom left" placeholder="Select date" autocomplete="off" readonly="readonly" value="<?= $endDate ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row ">
                            <div class="col-md-6 mt-3">
                                <div class="mil-field-frame">
                                    <label>Name</label>
                                    <input type="text" id="name" placeholder="Enter your name" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="mil-field-frame">
                                    <label>Mobile No</label>
                                    <input type="number" id="number" placeholder="Enter mobile number" autocomplete="off" required>
                                </div>
                            </div>

                        </div>

                        <div class="row ">

                            <div class="col-md-6 mt-3">
                                <div class="mil-field-frame">
                                    <label>Email Id</label>
                                    <input type="email" id="email" placeholder="Enter Email Id" autocomplete="off" required>
                                </div>
                            </div>


                            <div class="col-md-6 mt-3">
                                <div class="mil-field-frame">
                                    <label>Adults</label>
                                    <input type="text" id="totalAdults" placeholder="Enter quantity" readonly="readonly" value="<?= $total_adult ?>">
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="mil-field-frame">
                                    <label>Rooms</label>
                                    <select id="roomCount" required>
                                        <option value="" selected disabled>Select Rooms</option>
                                        <?php for ($i = $min_room; $i <= $total_adult; $i++): ?>
                                            <?php if ($i <= $total_availableRooms): ?>
                                                <option value="<?= $i ?>"><?= $i ?> Room<?= $i > 1 ? 's' : '' ?></option>
                                            <?php else: ?>
                                                <option value="<?= $i ?>" disabled><?= $i ?> Room<?= $i > 1 ? 's' : '' ?> Not Available</option>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="mil-field-frame">
                                    <label>Select Plan</label>
                                    <select id="planType" required>
                                        <option value="EP">EP (Rooms Only) No Extra Charges</option>
                                        <option value="CP">CP (Rooms + Breakfast) ₹<?= $room["food_plan_cp"] ?> per person/night</option>
                                        <option value="MAP">MAP (Rooms + Breakfast & Dinner) ₹<?= $room["food_plan_map"] ?> per person/night</option>
                                        <option value="AP">AP (Rooms + All Meals) ₹<?= $room["food_plan_ap"] ?> per person/night</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="extra" id="extra">
                        <input type="hidden" name="planCosts" id="planCosts">
                        <input type="hidden" name="extraAdultPrice" id="extraAdultPrice">
                        <input type="hidden" name="roomPrice" id="roomPrice">

                        <div id="calculationBreakdown" class="calculation-breakdown mt-4 mb-4"></div>

                        <button type="submit" class="mil-button mil-accent">
                            Book Now
                        </button>
                    </form>
                </div>
            </div>
        </div>












        <script>
            const roomPrice = <?= $room["price"] ?>;
            const extraAdultPrice = <?= $room["extra_adult_price"] ?>;
            const max_extra_adults = <?= $room["max_extra_adults"] ?>;
            const max_capacity = <?= $room["max_capacity"] ?>;




            const planCosts = {
                EP: 0,
                CP: <?= $room["food_plan_cp"] ?>,
                MAP: <?= $room["food_plan_map"] ?>,
                AP: <?= $room["food_plan_ap"] ?>
            };

            function updateBookingDetails() {
                const rooms = parseInt(document.getElementById('roomCount').value) || 0;
                const plan = document.getElementById('planType').value || 'EP';
                const totalAdults = parseInt(document.getElementById('totalAdults').value) || 0;
                const nights = (new Date("<?= $endDate ?>") - new Date("<?= $startDate ?>")) / (1000 * 60 * 60 * 24) || 1;

                const extraAdults = totalAdults > rooms * max_capacity ? totalAdults - rooms * max_capacity : 0;

                if (rooms && nights) {
                    const roomCost = rooms * roomPrice * nights;
                    const extraAdultCost = extraAdults * extraAdultPrice * nights;
                    const planCost = totalAdults * planCosts[plan] * nights;

                    const gstRoom = 0.12 * roomCost;
                    const gstExtraAdults = 0.12 * extraAdultCost;
                    const gstPlan = 0.05 * planCost;

                    const totalAmountBeforeGST = roomCost + extraAdultCost + planCost;
                    const totalGST = gstRoom + gstExtraAdults + gstPlan;
                    const totalAmountWithGST = totalAmountBeforeGST + totalGST;

                    // Check if the total amount is negative or zero
                    if (totalAmountWithGST <= 0) {
                        alert("The total amount cannot be negative or zero. Please check your booking details.");
                        window.location.href = './rooms';
                        return; // Prevent further processing
                    }

                    document.getElementById('totalAmountWithGST').innerText = totalAmountWithGST;
                    document.getElementById('extra').value = extraAdults;

                    document.getElementById('planCosts').value = planCosts[plan];
                    document.getElementById('extraAdultPrice').value = extraAdultPrice;
                    document.getElementById('roomPrice').value = roomPrice;


                    let breakdown = `
            <table class="table table-bordered table-striped" style="width: 100%;" >
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>${rooms} Room${rooms > 1 ? 's' : ''} × ₹${roomPrice} × ${nights} Night${nights > 1 ? 's' : ''}</strong></td>
                        <td>₹${roomCost.toFixed(2)}</td>
                    </tr>
        `;

                    if (extraAdults > 0) {
                        breakdown += `
                <tr>
                    <td><strong>Extra Adults: ${extraAdults} × ₹${extraAdultPrice} × ${nights} Night${nights > 1 ? 's' : ''}</strong></td>
                    <td>₹${extraAdultCost.toFixed(2)}</td>
                </tr>
            `;
                    }

                    if (planCost > 0) {
                        breakdown += `
                <tr>
                    <td><strong>Food Plan (${plan}): ${totalAdults} Adult${totalAdults > 1 ? 's' : ''} × ₹${planCosts[plan]} × ${nights} Night${nights > 1 ? 's' : ''}</strong></td>
                    <td>₹${planCost.toFixed(2)}</td>
                </tr>
                <tr>
                    <td><strong>GST (5% on Food Plan)</strong></td>
                    <td>₹${gstPlan.toFixed(2)}</td>
                </tr>
            `;
                    }

                    breakdown += `
            <tr>
                <td><strong>GST (12% on Rooms)</strong></td>
                <td>₹${gstRoom.toFixed(2)}</td>
            </tr>
            <tr>
                <td><strong>GST (12% on Extra Adults)</strong></td>
                <td>₹${gstExtraAdults.toFixed(2)}</td>
            </tr>
        `;

                    breakdown += `
        </tbody>
            <tfoot>
                <tr>
                    <td><strong>Total Amount (Including GST)</strong></td>
                    <input type="hidden" id="hidden_amount" name="hidden_amount" value="${totalAmountWithGST.toFixed(2)}" >
                    <td><strong>₹${totalAmountWithGST.toFixed(2)}</strong></td>
                </tr>
            </tfoot>
        </table>
        `;

                    document.getElementById('calculationBreakdown').innerHTML = breakdown;
                }
            }

            document.getElementById('roomCount').addEventListener('change', updateBookingDetails);
            document.getElementById('planType').addEventListener('change', updateBookingDetails);
        </script>



    </div>


    <div id="paymentModal" class="modal">
        <div class="modal-content">
            <div class="modal-title">Choose Payment Method</div>
            <div class="modal-amount">Total + GST: ₹<span id="totalAmountWithGST">00.00</span></div>

            <!-- Button Container -->
            <div class="button-container">
                <!-- <button style="width: 100%" class="modal-button pay-now" onclick="payNow()" disabled>Pay Now</button> -->
                <button style="width: 100%" class="modal-button pay-later" onclick="payLater()">Pay Later</button>
            </div>
        </div>
    </div>


    <!-- Loading Overlay -->
    <div id="loadingOverlay" style="display: none;">
        <div class="loading-content">
            <p>Processing...</p>
            <div class="spinner"></div> <!-- You can replace this with any spinner or loading icon -->
        </div>
    </div>


    <script>
        // Function to open the modal
        function openModal() {
            document.getElementById('paymentModal').style.display = 'block';
        }

        // Function to close the modal
        function closeModal() {
            document.getElementById('paymentModal').style.display = 'none';
        }

        // Handle Pay Now
        function payNow() {
            // Display loading overlay
            document.getElementById('loadingOverlay').style.display = 'flex';

            // Prepare the data for AJAX request
            var totalAmount = document.getElementById('hidden_amount').value;
            var data = {
                name: document.getElementById('name').value,
                mobile: document.getElementById('number').value,
                check_in: document.getElementById('check-in').value,
                check_out: document.getElementById('check-out').value,
                rooms_id: <?php echo $room_id ?>, // Ensure this PHP variable is correctly output
                rooms: document.getElementById('roomCount').value,
                plan: document.getElementById('planType').value,
                adults: document.getElementById('totalAdults').value,
                extra: document.getElementById('extra').value,
                total: totalAmount,
                planCost: document.getElementById('planCosts').value,
                extraAdultPrice: document.getElementById('extraAdultPrice').value,
                roomPrice: document.getElementById('roomPrice').value,
                email: document.getElementById('email').value
            };

            // Create an XMLHttpRequest object for AJAX
            var xhr = new XMLHttpRequest();
            xhr.open('POST', './verifyAmount.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            // On successful AJAX response
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Parse the server response (expecting JSON with status)
                    var response = JSON.parse(xhr.responseText);

                    if (response.status === 'valid') {
                        // Amount is valid, create the form for email submission
                        var form = document.createElement('form');
                        form.method = 'POST';
                        form.action = './email/payNow.php'; // Change to your email handling script

                        // Add inputs to the form
                        for (var key in data) {
                            if (data.hasOwnProperty(key)) {
                                var input = document.createElement('input');
                                input.type = 'hidden';
                                input.name = key;
                                input.value = data[key];
                                form.appendChild(input);
                            }
                        }

                        // Append the form to the body and submit
                        document.body.appendChild(form);
                        form.submit();
                    } else {
                        // Invalid amount, display an error message
                        alert(response.message);
                        location.reload();
                    }
                }
            };

            // Convert data to a query string and send it via AJAX
            var queryString = Object.keys(data).map(function(key) {
                return encodeURIComponent(key) + '=' + encodeURIComponent(data[key]);
            }).join('&');

            xhr.send(queryString);
        }



        // Handle Pay Later
        function payLater() {



            document.getElementById('loadingOverlay').style.display = 'flex';

            // Prepare the data for AJAX request
            var totalAmount = document.getElementById('hidden_amount').value;
            var data = {
                name: document.getElementById('name').value,
                mobile: document.getElementById('number').value,
                check_in: document.getElementById('check-in').value,
                check_out: document.getElementById('check-out').value,
                rooms_id: <?php echo $room_id ?>, // Ensure this PHP variable is correctly output
                rooms: document.getElementById('roomCount').value,
                plan: document.getElementById('planType').value,
                adults: document.getElementById('totalAdults').value,
                extra: document.getElementById('extra').value,
                total: totalAmount,
                planCost: document.getElementById('planCosts').value,
                extraAdultPrice: document.getElementById('extraAdultPrice').value,
                roomPrice: document.getElementById('roomPrice').value,
                email: document.getElementById('email').value
            };

            // Create an XMLHttpRequest object for AJAX
            var xhr = new XMLHttpRequest();
            xhr.open('POST', './verifyAmount.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            // On successful AJAX response
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Parse the server response (expecting JSON with status)
                    var response = JSON.parse(xhr.responseText);

                    if (response.status === 'valid') {
                        // Amount is valid, create the form for email submission
                        var form = document.createElement('form');
                        form.method = 'POST';
                        form.action = './email/payLater.php'; // Change to your email handling script

                        // Add inputs to the form
                        for (var key in data) {
                            if (data.hasOwnProperty(key)) {
                                var input = document.createElement('input');
                                input.type = 'hidden';
                                input.name = key;
                                input.value = data[key];
                                form.appendChild(input);
                            }
                        }

                        // Append the form to the body and submit
                        document.body.appendChild(form);
                        form.submit();
                    } else {
                        // Invalid amount, display an error message
                        alert(response.message);
                        location.reload();
                    }
                }
            };

            // Convert data to a query string and send it via AJAX
            var queryString = Object.keys(data).map(function(key) {
                return encodeURIComponent(key) + '=' + encodeURIComponent(data[key]);
            }).join('&');

            xhr.send(queryString);





        }


        // Trigger modal when the form is submitted
        document.getElementById('bookingForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting normally
            openModal(); // Show the modal
        });
    </script>





    <br>
    <br>
    <br>
    <br>














    <?php require("./config/footer.php") ?>

    <?php require("./config/script.php") ?>
</body>


<!-- Mirrored from miller.bslthemes.com/aquarele-demo/services.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 15 Nov 2024 06:12:16 GMT -->

</html>
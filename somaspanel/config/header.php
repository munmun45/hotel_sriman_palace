<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="index" class="logo d-flex align-items-center">
            <img src="assets/img/logo.png" alt="">
            <span class="d-none d-lg-block">Admin Panel</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->






    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">






            <li class="nav-item pe-3">

                <div class="d-flex align-items-center" style="gap: 10px;">
                    <!-- Add Icon Button -->
                    <button
                        class="btn btn-primary d-flex align-items-center justify-content-center"
                        style="border-radius: 4px;"
                        data-bs-toggle="modal"
                        data-bs-target="#add_new_booking">
                        <i class="bi bi-plus" style="font-size: 20px;"></i>
                    </button>


                </div>





            </li>


            <li class="nav-item pe-3" style="margin-right: 40px;">

                <form action="./index" method="post" class="d-flex align-items-center border rounded" style="padding: 3px;">
                    <input type="text" name="daterange" id="daterange" class="form-control border-0" style="margin-right: 20px;" required autocomplete="off">
                    <button type="submit" class="btn btn-danger d-flex align-items-center justify-content-center" data-bs-toggle="tooltip"
                        data-bs-placement="bottom"
                        title="Check Room Availability " style="border-radius: 1;">
                        <i class="bi bi-search"></i>
                    </button>
                </form>



            </li>




            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2">hotel sriman palace</span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>hotel sriman palace</h6>
                        <span>Administer</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>


                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#0" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                            <i class="bi bi-lock-fill"></i>
                            <span>Change Password</span>
                        </a>
                    </li>


                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="bi bi-question-circle"></i>
                            <span>Need Help?</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="./process/logout">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span>
                        </a>
                    </li>


                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->







<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="./process/change_password" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="oldPassword" class="form-label">Old Password</label>
                        <input type="text" class="form-control" id="oldPassword" name="old_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="newPassword" name="new_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm New Password</label>
                        <input type="text" class="form-control" id="confirmPassword" name="confirm_password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Change Password</button>
                </div>
            </form>
        </div>
    </div>
</div>







<!-- Modal -->
<div class="modal fade" id="add_new_booking" tabindex="-1" aria-labelledby="add_new_bookingLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <form action="./process/add_booking" method="post">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="add_new_bookingLabel">Add New Booking</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">

                    <div class="row g-3">
                        <!-- Guest Name Field -->
                        <div class="col-md-6">
                            <label for="guestName" class="form-label">Guest Name</label>
                            <input type="text" class="form-control" id="guestName" name="guestName" required>
                        </div>

                        <!-- Guest Number Field -->
                        <div class="col-md-6">
                            <label for="number" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="number" name="guestNumber" required>
                        </div>

                        <div class="col-md-12">
                            <label for="email" class="form-label">Email Id</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <!-- Total Guests Field -->
                        <div class="col-md-4">
                            <label for="totalGuests" class="form-label">Total Guests</label>
                            <input type="number" class="form-control" id="totalGuests" name="totalGuests" required>
                        </div>

                        <div class="col-md-4">
                            <label for="extra_gust" class="form-label">Extra Gust</label>
                            <input type="number" class="form-control" id="extra_gust" name="extra_gust" required>
                        </div>

                        <!-- Total Rooms Field -->
                        <div class="col-md-4">
                            <label for="totalRooms" class="form-label">Total Rooms</label>
                            <input type="number" class="form-control" id="totalRooms" name="totalRooms" required>
                        </div>

                        <!-- Room Type Selection -->
                        <div class="col-md-6">
                            <label for="roomType" class="form-label">Room Type</label>
                            <select class="form-select" id="roomType" name="roomType" required>
                                <option value="" disabled selected>Select room type</option>

                                <?php
                                $sql = "SELECT * FROM rooms";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($room = $result->fetch_assoc()) {

                                        echo '<option value="' . $room['id'] . '">' . $room['name'] . '</option>';
                                    }
                                }
                                ?>

                            </select>
                        </div>

                        <!-- Room Plan Selection -->
                        <div class="col-md-6">
                            <label for="roomPlan" class="form-label">Room Plan</label>
                            <select class="form-select" id="roomPlan" name="roomPlan" required>
                                <option value="" disabled selected>Select room plan</option>
                                <option value="EP">Room Only (EP)</option>
                                <option value="CP">Room with Breakfast (CP)</option>
                                <option value="MAP">Room with Breakfast (MAP)</option>
                                <option value="AP">Room with Full Board (AP)</option>
                            </select>
                        </div>


                        <!-- Check-in Date -->
                        <div class="col-md-6">
                            <label for="checkInDate" class="form-label">Check-in Date</label>
                            <input type="date" class="form-control" id="checkInDate" name="checkInDate" required>
                        </div>

                        <!-- Check-out Date -->
                        <div class="col-md-6">
                            <label for="checkOutDate" class="form-label">Check-out Date</label>
                            <input type="date" class="form-control" id="checkOutDate" name="checkOutDate" required>
                        </div>

                        <!-- Booking Platform Selection -->
                        <div class="col-md-6">
                            <label for="bookingPlatform" class="form-label">Booking Platform</label>
                            <select class="form-select" id="bookingPlatform" name="bookingPlatform" required>
                                <option value="" disabled selected>Select booking platform</option>
                                <option value="Website">Website</option>
                                <option value="phone Call">Phone Call</option>
                                <option value="Make My Trip">Make My Trip</option>
                                <option value="Goibibo">Goibibo</option>
                                <option value="Booking.com">Booking.com</option>
                                <option value="Hotels.com">Hotels.com</option>
                                <option value="Agoda">Agoda</option>
                                <option value="Other">Other</option>
                            </select>

                        </div>

                        <!-- Booking ID Field -->
                        <div class="col-md-6">
                            <label for="bookingId" class="form-label">Booking ID</label>
                            <input type="text" class="form-control" id="bookingId" name="bookingId">
                        </div>

                        <!-- Amount Field -->
                        <div class="col-md-6" style="display: none;" >
                            <label for="off" class="form-label">Off %</label>
                            <input type="number" class="form-control" id="off" name="off" >
                        </div>

                        <!-- Status Selection -->
                        <div class="col-md-6">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="pending" selected>Pending</option>
                            </select>
                        </div>
                    </div>

                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Booking</button>
                </div>

            </form>
        </div>
    </div>
</div>
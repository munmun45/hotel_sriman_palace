<?php
// Include database connection
require("./config/config.php");

// Initialize all variables with default empty values
$contact_id = '';
$contact_number_1 = '';
$contact_number_2 = '';
$email_1 = '';
$email_2 = '';
$address = '';

$message = "Add";  // Default message is "Add"
$button = "Submit"; // Default button text is "Submit"

// Check if an 'id' is passed in the URL for editing
if (isset($_GET['id'])) {
    $contact_id = $_GET['id'];

    // Prepare and execute the SQL query to fetch contact details
    $sql = "SELECT * FROM contacts WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $contact_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // If contact found, assign values to variables
    if ($result->num_rows > 0) {
        $contact = $result->fetch_assoc();

        // Assign values to form variables
        $contact_number_1 = $contact['contact_number_1'];
        $contact_number_2 = $contact['contact_number_2'];
        $email_1 = $contact['email_1'];
        $email_2 = $contact['email_2'];
        $address = $contact['address'];

        // Change message and button text for editing
        $message = "Update";
        $button = "Update";
    } else {
        // Handle the case where no contact is found
        echo "Contact not found.";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?= require("./config/meta.php") ?>
</head>

<body>

    <?= require("./config/header.php") ?>
    <?= require("./config/menu.php") ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Contact Information</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index">Home</a></li>
                    <li class="breadcrumb-item active">Contact</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title mb-0">Contact List</h5>

                            </div>

                            <!-- Table with stripped rows -->
                            <table class="table table-bordered table-hover align-middle">
                                <thead class="table">
                                    <tr>
                                        <th>Contact Number 1</th>
                                        <th>Contact Number 2</th>
                                        <th>Email 1</th>
                                        <th>Email 2</th>
                                        <th>Address</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $sql = "SELECT * FROM contacts";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($contact = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $contact['contact_number_1'] . "</td>";
                                            echo "<td>" . $contact['contact_number_2'] . "</td>";
                                            echo "<td>" . $contact['email_1'] . "</td>";
                                            echo "<td>" . $contact['email_2'] . "</td>";
                                            echo "<td>" . $contact['address'] . "</td>";
                                            echo "<td class='text-center'>
                                                <a href='?id=" . $contact['id'] . "' class='btn btn-sm btn-warning me-1'>
                                                    <i class='bi bi-pencil-fill'></i>
                                                </a>
                                                
                                            </td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='6' class='text-center'>No contacts found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="modal fade" id="addContactModal" tabindex="-1" aria-labelledby="addContactModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addContactModalLabel"><?= isset($_GET['id']) ? 'Update' : 'Add' ?> Contact</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="./process/contact" method="post" id="addContactForm">
                            <!-- Hidden input for contact ID (for update) -->
                            <input type="hidden" name="id" value="<?= $contact_id ?>">

                            <div class="mb-3">
                                <label for="contactNumber1" class="form-label">Contact Number 1</label>
                                <input type="text" name="contact_number_1" class="form-control" id="contactNumber1" value="<?= $contact_number_1 ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="contactNumber2" class="form-label">Contact Number 2</label>
                                <input type="text" name="contact_number_2" class="form-control" id="contactNumber2" value="<?= $contact_number_2 ?>">
                            </div>
                            <div class="mb-3">
                                <label for="email1" class="form-label">Email 1</label>
                                <input type="email" name="email_1" class="form-control" id="email1" value="<?= $email_1 ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="email2" class="form-label">Email 2</label>
                                <input type="email" name="email_2" class="form-control" id="email2" value="<?= $email_2 ?>">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea name="address" class="form-control" id="address" rows="3" required><?= $address ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-success w-100"><?= isset($_GET['id']) ? 'Update' : 'Submit' ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main><!-- End #main -->

    <?= require("./config/footer.php") ?>



    <script>
        // Check if there is an 'id' in the URL, and show the modal if true
        const urlParams = new URLSearchParams(window.location.search);
        const contactId = urlParams.get('id');
        if (contactId) {
            // Open the modal automatically if the ID exists in the URL
            var myModal = new bootstrap.Modal(document.getElementById('addContactModal'));
            myModal.show();
        }
    </script>

</body>

</html>
<?php
// Include the necessary configuration and database connection
require("./config/config.php");

// Get the service ID from the query string
$service_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch the service details from the database
$sql = "SELECT * FROM services WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $service_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if the service exists
if ($result->num_rows > 0) {
    $service = $result->fetch_assoc();
    $title = htmlspecialchars($service['title'], ENT_QUOTES, 'UTF-8');
    $description = htmlspecialchars($service['description'], ENT_QUOTES, 'UTF-8');
    $image = $service['image_1'] ? './somaspanel/uploads/' . $service['image_2'] : 'path/to/default-image.jpg';

    // Fetch FAQs for the service
    $faqs = [];
    for ($i = 1; $i <= 5; $i++) {
        $faq_key = 'faq_' . $i;
        if (!empty($service[$faq_key])) {
            // Split the question at '?'
            $faq_parts = explode('?', $service[$faq_key], 2);
            $faqs[] = [
                'question' => trim($faq_parts[0]) . '?',
                'answer' => isset($faq_parts[1]) ? trim($faq_parts[1]) : 'Answer not available.'
            ];
        }
    }
} else {
    // Redirect or show an error if the service does not exist
    header("Location: services.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <?php require("./config/meta.php"); ?>
</head>

<body>
    <div class="mil-wrapper">
        <?php require("./config/header.php"); ?>

        <!-- Banner -->
        <div class="mil-p-100-60">
            <div class="container">
                <div class="mil-banner-head">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <h1 class="mil-h2-lg mil-mb-40"><?= $title ?></h1>
                        </div>
                        <div class="col-lg-6">
                            <div class="mil-desctop-right mil-right-no-m mil-fade-up mil-mb-40">
                                <div class="mil-suptitle mil-breadcrumbs mil-light">
                                    <ul>
                                        <li><a href="./index">Home</a></li>
                                        <li><a href="./services">Services</a></li>
                                        <li><a href="#0"><?= $title ?></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Service Details -->
        <div class="mil-info">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-xl-8">
                        <div class="mil-img mil-img-hori mil-mb-100 mil-fade-up">
                            <img src="<?= $image ?>" alt="<?= $title ?>">
                        </div>
                        <div class="mil-description mil-mb-100">
                            <h3 class="mil-fade-up mil-mb-40">Service Details</h3>
                            <p class="mil-fade-up"><?= nl2br($description) ?></p>
                        </div>

                        <!-- FAQs Section -->
                        <h3 class="mil-fade-up mil-mb-40">FAQ</h3>
                        <div class="mil-faq-section mil-mb-100">
                            <?php if (!empty($faqs)): ?>
                                <?php foreach ($faqs as $index => $faq): ?>
                                    <div class="mil-faq-item mil-fade-up <?= $index === 0 ? 'active' : '' ?>">
                                        <div class="mil-faq-question">
                                            <span class="mil-icon">+</span>
                                            <h3><?= $faq['question'] ?></h3>
                                        </div>
                                        <div class="mil-faq-answer">
                                            <p><?= $faq['answer'] ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="mil-fade-up">No FAQs available for this service.</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="col-xl-4" data-sticky-container>
                        <div class="mil-sticky mil-stycky-right mil-p-0-100" data-margin-top="140">
                            <h3 class="mil-mb-40">Other Services</h3>
                            <?php
                            // Fetch other services
                            $other_services_sql = "SELECT * FROM services WHERE id != ? LIMIT 5";
                            $other_stmt = $conn->prepare($other_services_sql);
                            $other_stmt->bind_param("i", $service_id);
                            $other_stmt->execute();
                            $other_result = $other_stmt->get_result();

                            while ($other_service = $other_result->fetch_assoc()) {
                                $other_id = $other_service['id'];
                                $other_title = htmlspecialchars($other_service['title'], ENT_QUOTES, 'UTF-8');
                                $other_image = $other_service['image_2'] ? './somaspanel/uploads/' . $other_service['image_2'] : 'path/to/default-image.jpg';
                            ?>
                                <a href="./service_details?id=<?= $other_id ?>" class="mil-service-card-sm mil-mb-20 mil-fade-up">
                                    <div class="mil-img-frame">
                                        <img src="<?= $other_image ?>" alt="<?= $other_title ?>">
                                    </div>
                                    <div class="mil-description">
                                        <h4><?= $other_title ?></h4>
                                    </div>
                                </a>
                            <?php } ?>
                            <a href="./services" class="mil-button mil-accent-1 mil-reply">
                                <span>View all</span>
                            </a>
                        </div>
                    </div>
                    <!-- Sidebar End -->
                </div>
            </div>
        </div>

        <?php require("./config/footer.php"); ?>
    </div>
    <?php require("./config/script.php"); ?>
</body>

</html>

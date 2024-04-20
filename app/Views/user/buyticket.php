
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Manup Template">
    <meta name="keywords" content="Manup, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Manup | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600,700,800,900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap" rel="stylesheet">


    <!-- Css Styles -->
<!-- Css Styles -->
<link rel="stylesheet" href="<?= base_url('user/css/bootstrap.min.css') ?>" type="text/css">
<link rel="stylesheet" href="<?= base_url('user/css/font-awesome.min.css') ?>" type="text/css">
<link rel="stylesheet" href="<?= base_url('user/css/elegant-icons.css') ?>" type="text/css">
<link rel="stylesheet" href="<?= base_url('user/css/owl.carousel.min.css') ?>" type="text/css">
<link rel="stylesheet" href="<?= base_url('user/css/magnific-popup.css') ?>" type="text/css">
<link rel="stylesheet" href="<?= base_url('user/css/slicknav.min.css') ?>" type="text/css">
<link rel="stylesheet" href="<?= base_url('user/css/style.css') ?>" type="text/css">

<style>
/* Styles for the sidebar */
.sidebar {
    position: fixed;
    top: 0;
    right: -250px; /* Initially hidden */
    width: 250px;
    height: 100%;
    background-color: #ffffff; /* Set background color to white */
    transition: right 0.3s ease;
    z-index: 9999; /* Ensure sidebar is above other content */
    padding: 20px; /* Add padding for better readability */
    font-family: "Work Sans", sans-serif; /* Change font family */
    color: #f44949; /* Set text color to match the provided color */
}

.sidebar.active {
    right: 0; /* Shows the sidebar */
}

/* Styles for the purchased tickets list */
.ticket-item {
    margin-bottom: 20px; /* Add space between ticket items */
}

.ticket-info {
    padding-bottom: 10px; /* Add padding at the bottom of ticket info */
    border-bottom: 1px solid #ccc; /* Add border bottom to visually separate ticket items */
}

/* Styles for ticket divider */
.ticket-divider {
    height: 1px;
    background-color: #f44949;
}

    </style>
</head>
<body>
    <!-- Page Preloder -->

    <!-- Header Section Begin -->
    <?= $this->include('user/chop/header.php');?>
    <!-- Header End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>Featured Events</h2>
                        <div class="bt-option">
                            <a href="<?php echo base_url('homepage'); ?>">Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="speaker-section spad">
        <div class="container-fluid px-4">
        <div class="col-lg-12">
                    <div class="breadcrumb-text">
                    <h1 class="mt-4">Purchase Ticket for <?= $event['EventName'] ?></h1>
        <h2>Ticket Type: <?= $ticketType['TicketType'] ?></h2>
                    </div>
                </div>
        <div class="card mb-4">
            <div class="card-body">
                <form action="<?= base_url('events/ticket/purchase/') . $ticketTypeID ?>" method="POST" enctype="multipart/form-data">
                
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="reference" class="form-label">Gcash Reference Number</label>
                        <input type="text" class="form-control" id="reference" name="reference" required>
                    </div>
                    <div class="mb-3">
                        <label for="imageFile" class="form-label">Payment Proof Image (Screenshot of Gcash Reciept)</label>
                        <input type="file" class="form-control" id="imageFile" name="imageFile" required accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-primary d-block mx-auto">Purchase Ticket</button>
                </form>
            </div>
    </div>
            <!-- Load more button if needed -->
        </div>
    </section>

    <!-- Contact Section End -->

    <!-- Footer Section Begin -->
    <footer class="footer-section">

    </footer>
    <!-- Footer Section End -->


<script src="<?= base_url('user/js/jquery-3.3.1.min.js') ?>"></script>
<script src="<?= base_url('user/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('user/js/jquery.magnific-popup.min.js') ?>"></script>
<script src="<?= base_url('user/js/jquery.countdown.min.js') ?>"></script>
<script src="<?= base_url('user/js/jquery.slicknav.js') ?>"></script>
<script src="<?= base_url('user/js/owl.carousel.min.js') ?>"></script>
<script src="<?= base_url('user/js/main.js') ?>"></script>
<script>
        function toggleSidebar() {
            var sidebar = document.getElementById("sidebar");
            sidebar.classList.toggle("active");
        }
    </script>
</body>

</html>
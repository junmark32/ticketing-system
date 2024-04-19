
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
                    <h2><?= esc($event['EventName']) ?> Ticket</h2>
                        <div class="bt-option">
                            <a href="<?php echo base_url('homepage'); ?>">Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Speaker Section Begin -->
    <section class="speaker-section spad">
        <div class="container">
        <div class="row">
            <?php foreach ($event['ticket_types'] as $ticket_type): ?>
            <div class="col-md-6 mb-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= $ticket_type['TicketType'] ?></h5>
                        <p class="card-text">Price: ₱<?= $ticket_type['Price'] ?> (Available: <?= $ticket_type['Quantity'] ?>)</p>
                        <!-- Make the ticket type clickable -->
                        <a href="<?= base_url('ticket/buy/') . $ticket_type['TicketTypeID'] ?>" class="btn btn-primary">Purchase</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
            <!-- Load more button if needed -->
        </div>
    </section>

    <!-- Contact Section End -->

    <!-- Footer Section Begin -->
    <footer class="footer-section">
        <div class="container">
            <div class="partner-logo owl-carousel">
                <a href="#" class="pl-table">
                    <div class="pl-tablecell">
                        <img src="img/partner-logo/logo-1.png" alt="">
                    </div>
                </a>
                <a href="#" class="pl-table">
                    <div class="pl-tablecell">
                        <img src="img/partner-logo/logo-2.png" alt="">
                    </div>
                </a>
                <a href="#" class="pl-table">
                    <div class="pl-tablecell">
                        <img src="img/partner-logo/logo-3.png" alt="">
                    </div>
                </a>
                <a href="#" class="pl-table">
                    <div class="pl-tablecell">
                        <img src="img/partner-logo/logo-4.png" alt="">
                    </div>
                </a>
                <a href="#" class="pl-table">
                    <div class="pl-tablecell">
                        <img src="img/partner-logo/logo-5.png" alt="">
                    </div>
                </a>
                <a href="#" class="pl-table">
                    <div class="pl-tablecell">
                        <img src="img/partner-logo/logo-6.png" alt="">
                    </div>
                </a>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer-text">
                        <div class="ft-logo">
                            <a href="#" class="footer-logo"><img src="img/footer-logo.png" alt=""></a>
                        </div>
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Events</a></li>
                            <li><a href="#">Schedule</a></li>
                        </ul>
                        <div class="copyright-text"><p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p></div>
                        <div class="ft-social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-youtube-play"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="user/js/jquery-3.3.1.min.js"></script>
    <script src="user/js/bootstrap.min.js"></script>
    <script src="user/js/jquery.magnific-popup.min.js"></script>
    <script src="user/js/jquery.countdown.min.js"></script>
    <script src="user/js/jquery.slicknav.js"></script>
    <script src="user/js/owl.carousel.min.js"></script>
    <script src="user/js/main.js"></script>
    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById("sidebar");
            sidebar.classList.toggle("active");
        }
    </script>
</body>

</html>
<?= $this->include('user/chop/style.php');?>

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
    <!-- Breadcrumb Section End -->

    <!-- Speaker Section Begin -->
    <section class="speaker-section spad">
        <div class="container">
            <div class="row">
                <?php foreach ($events as $event): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                        <img src="<?= $event['Image_url'] ?>" class="card-img-top custom-img" alt="<?= $event['EventName'] ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= $event['EventName'] ?></h5>
                                <p class="card-text">Date: <?= $event['EventDate'] ?></p>
                                <p class="card-text">Location: <?= $event['EventLocation'] ?></p>
                                <h6 class="card-subtitle mb-2 text-muted">Ticket Types:</h6>
                                <ul class="list-group">
                                    <?php foreach ($event['ticket_types'] as $ticket_type): ?>
                                        <?php 
                                        // Display only VIP and Student tickets for users with 'student' user type
                                        if ($ticket_type['TicketType'] === 'VIP' || $ticket_type['TicketType'] === 'Student'): 
                                        ?>
                                            <li class="list-group-item"><?= $ticket_type['TicketType'] ?> - ₱<?= $ticket_type['Price'] ?> (Available: <?= $ticket_type['Quantity'] ?>)</li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </ul>
                                 <!-- Button to pass EventID to URL -->
                                 <a href="<?= base_url('show-event-details/') . $event['EventID'] ?>" class="btn btn-primary mt-2">Buy Tickets</a>
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
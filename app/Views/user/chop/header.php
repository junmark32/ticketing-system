<body>
<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div>
        <div class="close-btn" onclick="closeSidebar()">×</div>
    </div>
    <h5>Your Purchased Tickets</h5>
    <div class="ticket-divider"></div>
    <ul>
        <?php if (!empty($ticketPurchases)) : ?>
            <?php foreach ($ticketPurchases as $ticketPurchase) : ?>
                <li class="ticket-item">
                    <div class="ticket-info">
                        <p><strong>Event Name:</strong> <?php echo $ticketPurchase['EventName']; ?></p>
                        <p><strong>Ticket Type:</strong> <?php echo $ticketPurchase['TicketType']; ?></p>
                        <p><strong>Status:</strong> <?php echo $ticketPurchase['Status']; ?></p>
                    </div>
                    <div class="ticket-divider"></div>
                </li>
            <?php endforeach; ?>
        <?php else : ?>
            <li>No tickets purchased.</li>
        <?php endif; ?>
    </ul>
</div>


    <!-- Header Section Begin -->
    <header class="header-section">
        <div class="container">
            <div class="logo">
                <a href="">
                    <img src="img/logo.png" alt="">
                </a>
            </div>
            <div class="nav-menu">
                <nav class="mainmenu mobile-menu">
                    <ul>
                        <li class="active"><a href="<?php echo base_url('homepage'); ?>">Home</a></li>
                        <li><a href="<?php echo base_url('Event'); ?>">Events</a></li>
                        <li><a href="#" onclick="toggleSidebar()">Ticket</a></li>
                    </ul>
                </nav>
                <a href="#" class="primary-btn top-btn" onclick="toggleSidebar()"><i class="fa fa-ticket"></i> Ticket</a>
            </div>
            <div id="mobile-menu-wrap"></div>
        </div>
    </header>
<!-- Sidebar -->

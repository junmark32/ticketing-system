<?= $this->include('include/admin_header') ?>
    <body>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Start Bootstrap</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <?= $this->include('include/admin_sidebar') ?>
            <div id="layoutSidenav_content">
            <main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Events</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Events</li>
        </ol>

        <div class="row">
            <?php foreach ($events as $event): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="<?= $event['Image_url'] ?>" class="card-img-top" alt="<?= $event['EventName'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $event['EventName'] ?></h5>
                        <p class="card-text">Date: <?= $event['EventDate'] ?></p>
                        <p class="card-text">Location: <?= $event['EventLocation'] ?></p>
                        <h6 class="card-subtitle mb-2 text-muted">Ticket Types:</h6>
                        <ul class="list-group">
                            <?php foreach ($event['ticket_types'] as $ticket_type): ?>
                            <li class="list-group-item"><?= $ticket_type['TicketType'] ?> - ₱<?= $ticket_type['Price'] ?> (Quantity: <?= $ticket_type['Quantity'] ?>)</li>
                            <?php endforeach; ?>
                        </ul>
                         <!-- Button to pass EventID to URL -->
                         <a href="<?= base_url('admin/events/edit/') . $event['EventID'] ?>" class="btn btn-primary mt-2">Update Event And Tickets</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</main>


                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>

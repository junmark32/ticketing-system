<?= $this->include('include/admin_header') ?>
    <body class="sb-nav-fixed">
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
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Approved: <?php echo $statusCounts['approvedCount']; ?></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Pending: <?php echo $statusCounts['pendingCount']; ?></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Scanned: <?php echo $statusCounts['scannedCount']; ?></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Declined: <?php echo $statusCounts['declinedCount']; ?></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ////// -->

                        <!-- <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Students: <?php echo $statusCounts['studentCount']; ?></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Alumni: <?php echo $statusCounts['alumniCount']; ?></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Outsider: <?php echo $statusCounts['outsiderCount']; ?></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div> -->


<!-- ////////////////////////// -->
                        <div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Pending Tickets
    </div>
    <div class="card-body">
        <table id="datatablesSimple" class="table">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>User Type</th>
                    <th>School/Alumni Card/Generated Number</th>
                    <th>Ticket ID</th>
                    <th>Ticket Type</th>
                    <th>Event Name</th>
                    <th>Reference_No.</th>
                    <th>Status</th>
                    <th>Action</th> <!-- Add this column for the action button/link -->
                </tr>
            </thead>
            <tbody>
            <?php foreach ($userData as $user): ?>
    <?php foreach ($user['TicketInfo'] as $ticket): ?>
        
        <tr>
            <td><?= $user['UserID'] ?></td>
            <td><?= $user['Username'] ?></td>
            <td><?= $ticket['Email'] ?></td>
            <td><?= $user['UserType'] ?></td>
            <td>
                <?php
                if ($user['UserType'] == 'student') {
                    echo $user['SchoolID'];
                } elseif ($user['UserType'] == 'alumni') {
                    echo $user['AlumniCardNumber'];
                } else {
                    echo $user['GeneratedNumber'];
                }
                ?>
            </td>
            <td><?= $ticket['TicketID'] ?></td>
            <td><?= $ticket['TicketType'] ?></td>
            <td><?= $ticket['EventName'] ?></td>
            <td><?= $ticket['Ref_Number'] ?></td>
            <td><?= $ticket['Status'] ?></td>
            <td>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ticketModal<?= $ticket['TicketID'] ?>">
                    View Details
                </button>
            </td>
        </tr>
                   <!-- Modal -->
<div class="modal fade" id="ticketModal<?= $ticket['TicketID'] ?>" tabindex="-1" aria-labelledby="ticketModalLabel<?= $ticket['TicketID'] ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ticketModalLabel<?= $ticket['TicketID'] ?>">Ticket Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Reference Number:</strong> <?= $ticket['Ref_Number'] ?></p>
                <p><strong>Payment Proof:</strong></p>
                <a href="<?= base_url($ticket['PaymentProof']) ?>" data-fancybox="images" data-caption="Payment Proof">
                    <img src="<?= base_url($ticket['PaymentProof']) ?>" alt="Payment Proof" class="img-fluid">
                </a>
            </div>
            <!-- Buttons for Approve and Decline -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#approveConfirmationModal<?= $ticket['TicketID'] ?>">
                    Approve
                </button>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#declineConfirmationModal<?= $ticket['TicketID'] ?>">
                    Decline
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<!-- End Modal -->

<!-- Modal for Approve Confirmation -->
<div class="modal fade" id="approveConfirmationModal<?= $ticket['TicketID'] ?>" tabindex="-1" aria-labelledby="approveConfirmationModalLabel<?= $ticket['TicketID'] ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="approveConfirmationModalLabel<?= $ticket['PurchaseID'] ?>">Confirm Approval</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to approve this ticket?
            </div>
            <div class="modal-footer">
                <form action="/admin/avail-tickets/approved/<?= $ticket['PurchaseID'] ?>" method="post">
                    <!-- Example action URL, replace with your actual URL -->
                    <button type="submit" class="btn btn-success">Yes, Approve</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Decline Confirmation -->
<div class="modal fade" id="declineConfirmationModal<?= $ticket['TicketID'] ?>" tabindex="-1" aria-labelledby="declineConfirmationModalLabel<?= $ticket['TicketID'] ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="declineConfirmationModalLabel<?= $ticket['PurchaseID'] ?>">Confirm Decline</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to decline this ticket?
            </div>
            <div class="modal-footer">
                <form action="/admin/avail-tickets/declined/<?= $ticket['PurchaseID'] ?>" method="post">
                    <!-- Example action URL, replace with your actual URL -->
                    <button type="submit" class="btn btn-danger">Yes, Decline</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>


                       
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>

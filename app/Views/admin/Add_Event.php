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
        <h1 class="mt-4">Insert Event with Tickets</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Insert Event with Tickets</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                <form action="<?= site_url('/admin/insertEventWithTickets')?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="eventName" class="form-label">Event Name</label>
                        <input type="text" class="form-control" id="eventName" name="eventName" required>
                    </div>
                    <div class="mb-3">
                        <label for="eventDate" class="form-label">Event Date</label>
                        <input type="date" class="form-control" id="eventDate" name="eventDate" required>
                    </div>
                    <div class="mb-3">
                        <label for="imageFile" class="form-label">Event Image</label>
                        <input type="file" class="form-control" id="imageFile" name="imageFile" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                        <label for="eventLocation" class="form-label">Event Location</label>
                        <input type="text" class="form-control" id="eventLocation" name="eventLocation" required>
                    </div>
                    <hr>
                    <h2>Ticket Types</h2>
                    <div id="ticketTypes">
                        <div class="mb-3">
                            <label for="ticketType1" class="form-label">Ticket Type</label>
                            <select class="form-select" id="ticketType1" name="ticketTypes[]" required>
                                <option value="">Select Type</option>
                                <option value="General Admission">General Admission</option>
                                <option value="VIP">VIP</option>
                                <option value="Student">Student</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="price1" class="form-label">Price</label>
                            <input type="number" class="form-control" id="price1" name="prices[]" required>
                        </div>
                        <div class="mb-3">
                            <label for="quantity1" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity1" name="quantities[]" required>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="addTicketType()">Add Ticket Type</button>
                    <hr>
                    <button type="submit" class="btn btn-success">Insert Event with Tickets</button>
                </form>
            </div>
        </div>
        <div style="height: 100vh"></div>
        <div class="card mb-4">
            <div class="card-body">When scrolling, the navigation stays at the top of the page. This is the end of the static navigation demo.</div>
        </div>
    </div>
</main>

<script>
    function addTicketType() {
        const ticketTypesContainer = document.getElementById('ticketTypes');
        const numTicketTypes = ticketTypesContainer.children.length / 3 + 1;

        const ticketTypeHTML = `
            <div class="mb-3">
                <label for="ticketType${numTicketTypes}" class="form-label">Ticket Type</label>
                <select class="form-select" id="ticketType${numTicketTypes}" name="ticketTypes[]" required>
                    <option value="">Select Type</option>
                    <option value="General Admission">General Admission</option>
                    <option value="VIP">VIP</option>
                    <option value="Student">Student</option>
                    <!-- Add more options as needed -->
                </select>
            </div>
            <div class="mb-3">
                <label for="price${numTicketTypes}" class="form-label">Price</label>
                <input type="number" class="form-control" id="price${numTicketTypes}" name="prices[]" required>
            </div>
            <div class="mb-3">
                <label for="quantity${numTicketTypes}" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="quantity${numTicketTypes}" name="quantities[]" required>
            </div>
        `;

        ticketTypesContainer.innerHTML += ticketTypeHTML;
    }
</script>

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

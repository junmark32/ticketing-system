<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Models\TicketsModel;
use App\Models\EventsModel;
use App\Models\TicketTypesModel;
use App\Models\QRcodeModel;
use App\Models\TicketpurchasesModel;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class UserController extends BaseController
{
    public function index()
    {
        return view('index');
    }


    public function studentRegister()
    {
        return view('user/Reg_Student');
    }

    public function alumniRegister()
    {
        return view('user/Reg_Alumni');
    }

    public function outsiderRegister()
    {
        return view('user/Reg_Outsider');
    }

    public function registerStudent()
    {
        $model = new UsersModel();

        // Get data from form or request
        $data = [
            'Username' => $this->request->getVar('username'),
            'PasswordHash' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT), // Hash the password
            'UserType' => 'student', // Default UserType to student
            'SchoolID' => $this->request->getVar('school_id'),
            'FirstName' => $this->request->getVar('first_name'),
            'LastName' => $this->request->getVar('last_name'),
            'DateOfBirth' => $this->request->getVar('date_of_birth'),
            'Phone' => $this->request->getVar('phone'),
            'Email' => $this->request->getVar('email'),
            'Status' => 'active' // Default Status to active
        ];

        // Insert the data into the database
        $model->insert($data);

        // Optionally, you can redirect the user to a success page or show a success message
        return redirect()->to('/tickets/login');
    }


    public function registerAlumni()
    {
        $model = new UsersModel();

        // Get data from form or request
        $data = [
            'Username' => $this->request->getVar('username'),
            'PasswordHash' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT), // Hash the password
            'UserType' => 'alumni', // Default UserType to student
            'AlumniID' => $this->request->getVar('alumni_id'),
            'FirstName' => $this->request->getVar('first_name'),
            'LastName' => $this->request->getVar('last_name'),
            'DateOfBirth' => $this->request->getVar('date_of_birth'),
            'Phone' => $this->request->getVar('phone'),
            'Email' => $this->request->getVar('email'),
            'Status' => 'active' // Default Status to active
        ];

        // Insert the data into the database
        $model->insert($data);

        // Optionally, you can redirect the user to a success page or show a success message
        return redirect()->to('/tickets/login');
    }

    public function registerOutsider()
    {
        $model = new UsersModel();
    
        // Generate a random SchoolID
        $generatedID = mt_rand(100000, 999999); // Example: Generates a 6-digit random number
    
        // Get data from form or request
        $data = [
            'Username' => $this->request->getVar('username'),
            'PasswordHash' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT), // Hash the password
            'UserType' => 'outsider', // Default UserType to outsider
            'GeneratedNumber' => $generatedID, // Assign the generated SchoolID
            'FirstName' => $this->request->getVar('first_name'),
            'LastName' => $this->request->getVar('last_name'),
            'DateOfBirth' => $this->request->getVar('date_of_birth'),
            'Phone' => $this->request->getVar('phone'),
            'Email' => $this->request->getVar('email'),
            'Status' => 'active' // Default Status to active
        ];
    
        // Insert the data into the database
        $model->insert($data);
    
        // Optionally, you can redirect the user to a success page or show a success message
        return redirect()->to('/tickets/login');
    }
    

    private function generateUniqueID() {
        // Generate a unique ID using timestamp or any other method
        return uniqid('OUT_', true);
    }
    public function fn_login()
    {
        // Load the model
        $model = new UsersModel();
    
        // Get username and password from the form or request
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
    
        // Check if the user exists
        $user = $model->where('Username', $username)->first();
    
        if ($user) {
            // Verify the password
            if (password_verify($password, $user['PasswordHash'])) {
                // Password is correct, set session and redirect to dashboard or any desired page
                $session = session();
                $session->set('isLoggedIn', true);
    
                // Set user data array
                $userData = [
                    'UserID' => $user['UserID'],
                    'Username' => $user['Username'],
                    'UserType' => $user['UserType'],
                    // Add more user data as needed
                ];
                $session->set('user_data', $userData);
    
                // Redirect to appropriate dashboard based on UserType
                switch ($user['UserType']) {
                    case 'admin':
                        return redirect()->to('/admin_dashboard');
                    case 'student':
                        return redirect()->to('/Events');
                    case 'alumni':
                        return redirect()->to('/alumni_dashboard');
                    default:
                        return redirect()->to('/outsider_dashboard');
                }
            } else {
                // Password is incorrect, show error message
                return redirect()->back()->with('error', 'Incorrect password.');
            }
        } else {
            // User does not exist, show error message
            return redirect()->back()->with('error', 'User does not exist.');
        }
    }
    
 
    public function viewSessionData()
{
    // Start session
    $session = session();

    // Check if user is logged in
    if ($session->get('isLoggedIn')) {
        // Get user data from session
        $userData = $session->get('user_data');

        // Check if user data exists
        if ($userData) {
            // Display user data
            echo "User ID: " . $userData['UserID'] . "<br>";
            echo "Username: " . $userData['Username'] . "<br>";
            echo "UserType: " . $userData['UserType'] . "<br>";
            // Display more user data as needed
        } else {
            // User data not found
            echo "User data not found.";
        }
    } else {
        // User is not logged in
        echo "User is not logged in.";
    }
}


public function stud_displayEvents()
{
    // Start session
    $session = session();

    // Get user type from session
    $userType = $session->get('user_data')['UserType'];

    $eventModel = new EventsModel();
    $ticketModel = new TicketsModel();
    $ticketTypeModel = new TicketTypesModel();

    $events = $eventModel->findAll();

    foreach ($events as &$event) {
        // Get ticket types for each event
        $event['ticket_types'] = $ticketModel->where('EventID', $event['EventID'])->findAll();

        // Add ticket type details to each ticket type
        foreach ($event['ticket_types'] as $key => &$ticket_type) {
            $ticketTypeDetails = $ticketTypeModel->find($ticket_type['TicketTypeID']);
            $ticket_type['TicketType'] = $ticketTypeDetails['TicketType'];
            $ticket_type['Price'] = $ticketTypeDetails['Price'];
            $ticket_type['Quantity'] = $ticketTypeDetails['Quantity'];

            // Filter ticket types based on user type
            if ($userType === 'student') {
                // If user is a student, only display VIP and Student tickets
                if ($ticket_type['TicketType'] !== 'VIP' && $ticket_type['TicketType'] !== 'Student') {
                    unset($event['ticket_types'][$key]); // Remove ticket type
                }
            }
        }
    }

    // Load the view and pass the data to it
    return view('user/event', ['events' => $events]);
}


public function showAvailableTickets($eventID)
{
    // Start session
    $session = session();

    // Get user data from session
    $userData = $session->get('user_data');

    // Check if user data exists and if UserType is set
    $userType = null;
    if (!empty($userData) && isset($userData['UserType'])) {
        $userType = $userData['UserType'];
    } else {
        // If UserType is not set or user data is empty, handle accordingly (redirect or show error)
        return redirect()->to('/error_page')->with('error', 'User data not found.');
    }

    $eventModel = new EventsModel();
    $ticketModel = new TicketsModel();
    $ticketTypeModel = new TicketTypesModel();

    // Find the event by EventID
    $event = $eventModel->find($eventID);

    if (!$event) {
        // Event not found, handle accordingly (redirect or show error)
        return redirect()->to('/error_page')->with('error', 'Event not found.');
    }

    // Get ticket types for the specified event
    $ticket_types = $ticketModel->where('EventID', $eventID)->findAll();

    // Filter ticket types based on user type
    $filtered_ticket_types = [];
    foreach ($ticket_types as $ticket_type) {
        $ticketTypeDetails = $ticketTypeModel->find($ticket_type['TicketTypeID']);
        if ($userType === 'student') {
            // If user is a student, include only VIP and Student tickets
            if ($ticketTypeDetails['TicketType'] === 'VIP' || $ticketTypeDetails['TicketType'] === 'Student') {
                $filtered_ticket_types[] = [
                    'TicketTypeID' => $ticketTypeDetails['TicketTypeID'], // Include TicketTypeID
                    'TicketType' => $ticketTypeDetails['TicketType'],
                    'Price' => $ticketTypeDetails['Price'],
                    'Quantity' => $ticketTypeDetails['Quantity']
                ];
            }
        } else {
            // If user is not a student, include all ticket types
            $filtered_ticket_types[] = [
                'TicketTypeID' => $ticketTypeDetails['TicketTypeID'], // Include TicketTypeID
                'TicketType' => $ticketTypeDetails['TicketType'],
                'Price' => $ticketTypeDetails['Price'],
                'Quantity' => $ticketTypeDetails['Quantity']
            ];
        }
    }

    $event['ticket_types'] = $filtered_ticket_types;

    return view('user/View_Ticket_Event', ['event' => $event]);
}


public function buyTicket($ticketTypeID)
{
    // Fetch event details based on the ticket type ID
    $ticketTypeModel = new TicketTypesModel();
    $ticketTypeDetails = $ticketTypeModel->find($ticketTypeID);

    // Fetch event details based on the ticket type's associated event ID
    $eventModel = new EventsModel();
    $eventDetails = $eventModel->find($ticketTypeDetails['EventID']);

    // Pass both ticket type and event details to the view
    return view('user/Buy_Ticket_Event', [
        'ticketTypeID' => $ticketTypeID,
        'event' => $eventDetails,
        'ticketType' => $ticketTypeDetails
    ]);
}

public function purchaseTicket($ticketTypeID)
{
    // Start session
    $session = session();

    // Get user data from session
    $userData = $session->get('user_data');

    // Check if user data exists and if UserID is set
    $userID = null;
    if (!empty($userData) && isset($userData['UserID'])) {
        $userID = $userData['UserID'];
    } else {
        // If UserID is not set or user data is empty, handle accordingly (redirect or show error)
        return redirect()->to('/error_page')->with('error', 'User data not found.');
    }

    // Get the ticket type details
    $ticketTypeModel = new TicketTypesModel();
    $ticketType = $ticketTypeModel->find($ticketTypeID);

    // Get the event details based on TicketTypeID
    $eventsModel = new EventsModel();
    $event = $eventsModel->find($ticketType['EventID']);

    // Get the ticket purchsedetails based on TicketTypeID
    $ticketpurchasesModel = new TicketPurchasesModel();
    $ticketPurchase = $ticketpurchasesModel->where('TicketTypeID', $ticketTypeID)->first();
    

    if (!$ticketType) {
        // Ticket type not found, handle accordingly (redirect or show error)
        return redirect()->to('/error_page')->with('error', 'Ticket type not found.');
    }

    // Check if tickets are available
    if ($ticketType['Quantity'] <= 0) {
        // Tickets are sold out, handle accordingly (redirect or show error)
        return redirect()->to('/error_page')->with('error', 'Tickets are sold out.');
    }

    $firstName = $this->request->getVar('first_name');
    $lastName = $this->request->getVar('last_name');
    $email = $this->request->getVar('email');
    $phone = $this->request->getVar('phone');
    $refNumber = $this->request->getVar('reference');
    $imageFile = $this->request->getFile('imageFile');

    // Validate reference number
    if (strlen($refNumber) !== 13) {
        // Reference number is not 13 digits, redirect back with error message
        return redirect()->back()->withInput()->with('error', 'Reference number must be 13 digits.');
    }

    // Validate uploaded image
    if (!$imageFile->isValid()) {
        // Image upload failed, redirect back with error message
        return redirect()->back()->withInput()->with('error', 'Image upload failed.');
    }

    // Handle file upload
    if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
        $newName = $imageFile->getRandomName();
        $imageFile->move(ROOTPATH . 'public/uploads/payments', $newName);
        $imageUrl = '/uploads/payments/' . $newName;
    } else {
        return redirect()->back()->withInput()->with('error', 'Image upload failed.');
    }

    // Generate a random alphanumeric ticket ID with 9 digits
    $ticketID = $ticketType['TicketType'].'_'. substr(str_shuffle(str_repeat('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', 9)), 0, 9);

    // Create a new TicketPurchaseModel instance
    $ticketPurchaseModel = new TicketPurchasesModel();

    // Prepare the ticket purchase data
    $ticketPurchaseData = [
        'UserID' => $userID,
        'TicketID' => $ticketID,
        'TicketTypeID' => $ticketTypeID,
        'EventID' => $ticketType['EventID'], // Assuming EventID is associated with TicketType
        'FirstName' => $firstName,
        'LastName' => $lastName,
        'Email' => $email,
        'Phone' => $phone,
        'Ref_Number' => $refNumber, 
        'PaymentProof' => $imageUrl,
        'PurchaseDate' => date('Y-m-d H:i:s'), // Current date and time
        'Quantity' => 1, // Purchase one ticket at a time
        'Status' => 'Pending' // Set initial status as Pending, can be updated later
    ];

    // Insert the ticket purchase data into the database
    $ticketPurchaseModel->insert($ticketPurchaseData);

    // Update the ticket quantity
    $newQuantity = $ticketType['Quantity'] - 1;
    $ticketTypeModel->update($ticketTypeID, ['Quantity' => $newQuantity]);

    //
     // Send email notification
     $mail = new PHPMailer(true);
     try {
         //Server settings
         $mail->isSMTP();
         $mail->Host = 'smtp.gmail.com'; // Your SMTP server
         $mail->SMTPAuth = true;
         $mail->Username = 'adonaieyecare@gmail.com'; // Your SMTP username
         $mail->Password = 'suxqojbojluggurs'; // Your SMTP password
         $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
         $mail->Port = 587; // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
 
         //Recipients
         $mail->setFrom('adonaieyecare@gmail.com', 'Adonai-EyeCare');
         $mail->addAddress($email); // Add a recipient
 
        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Ticket Purchase Confirmation';
        $mail->Body = 'Dear ' . $firstName . ',
                        <br>
                        <br>
                        Your ticket ' . $ticketType['TicketType'] . ' for ' . $event['EventName'] .
                        ' purchase is pending and awaiting approval from the admin.
                        <br>
                        <br>
                        Date Avail: ' . $ticketPurchase['PurchaseDate'] . ' 
                        <br>
                        <br>
                        Thank you for your purchase.';

         $mail->send();
         echo 'Email has been sent';
     } catch (Exception $e) {
         echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
     }

    // Redirect to a success page or display a success message
    return redirect()->to('/Event')->with('success', 'Ticket purchased successfully.');
}





    public function adminDashboard()
    {
        return view('admin/Admin_Dashboard');
    }
}

    
    






<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\EventsModel;
use App\Models\TicketTypesModel;
use App\Models\TicketsModel;
use App\Models\UsersModel;
use App\Models\TicketpurchasesModel;
use App\Models\QRcodeModel;

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Dompdf\Dompdf;
use Dompdf\Options;



class AdminController extends BaseController
{
    public function adminDB()
    {
        return view('admin/Admin_Dashboard');
    }

    public function addEvent()
    {
        return view('admin/Add_Event');
    }



    public function insertEventWithTickets()
    {
        // Load necessary models
        $eventModel = new EventsModel();
        $ticketTypesModel = new TicketTypesModel();
        $ticketModel = new TicketsModel();
    
        // Get data from HTML form
        $eventName = $this->request->getPost('eventName');
        $eventDate = $this->request->getPost('eventDate');
        $imageFile = $this->request->getFile('imageFile');
        $eventLocation = $this->request->getPost('eventLocation');
        $ticketTypeArray = $this->request->getPost('ticketTypes');
        $priceArray = $this->request->getPost('prices');
        $quantityArray = $this->request->getPost('quantities');
    
        // Debugging: Output form data
        var_dump($eventName, $eventDate, $imageFile, $eventLocation, $ticketTypeArray, $priceArray, $quantityArray);
    
        // Handle file upload
        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            $newName = $imageFile->getRandomName();
            $imageFile->move(ROOTPATH . 'public/uploads', $newName);
            $imageUrl = '/uploads/' . $newName;
        } else {
            return redirect()->back()->withInput()->with('error', 'Image upload failed.');
        }
    
        // Insert event
        $eventData = [
            'EventName' => $eventName,
            'EventDate' => $eventDate,
            'Image_url' => $imageUrl,
            'EventLocation' => $eventLocation
        ];
        $eventModel->insert($eventData);
        $eventID = $eventModel->insertID();
    
        // Insert ticket types
        foreach ($ticketTypeArray as $key => $ticketType) {
            $ticketTypeData = [
                'TicketType' => $ticketType,
                'Price' => $priceArray[$key],
                'Quantity' => $quantityArray[$key],
                'EventID' => $eventID
            ];
            $ticketTypesModel->insert($ticketTypeData);
            $ticketTypeID = $ticketTypesModel->insertID();
    
            // Insert tickets for this ticket type
            $ticketData = [
                'EventID' => $eventID,
                'UserID' => null,
                'TicketStatus' => 'Available',
                'TicketTypeID' => $ticketTypeID
            ];
            $ticketModel->insert($ticketData);
        }
    
        return redirect()->to('/success_page');
    }

    // public function viewEvents()
    // {
    //     return view('admin/View_Event');
    // }

    public function displayEvents()
    {
        $eventModel = new EventsModel();
        $ticketModel = new TicketsModel();
        $ticketTypeModel = new TicketTypesModel();
    
        $events = $eventModel->findAll();
    
        foreach ($events as &$event) {
            // Get ticket types for each event
            $event['ticket_types'] = $ticketModel->where('EventID', $event['EventID'])->findAll();
    
            // Add ticket type details to each ticket type
            foreach ($event['ticket_types'] as &$ticket_type) {
                $ticketTypeDetails = $ticketTypeModel->find($ticket_type['TicketTypeID']);
                $ticket_type['TicketType'] = $ticketTypeDetails['TicketType'];
                $ticket_type['Price'] = $ticketTypeDetails['Price'];
                $ticket_type['Quantity'] = $ticketTypeDetails['Quantity'];
            }
        }
    
        // Load the view and pass the data to it
        return view('admin/Display_Events', ['events' => $events]);
    }

    public function updateEvent($eventID)
{
    // Load the necessary models
    $eventModel = new EventsModel();
    $ticketModel = new TicketsModel();
    $ticketTypeModel = new TicketTypesModel();

    // Fetch the event data
    $event = $eventModel->find($eventID);

    if ($event) {
        // Fetch ticket types for the event
        $ticketTypes = $ticketModel->where('EventID', $eventID)->findAll();

        // Add ticket type details to each ticket type
        foreach ($ticketTypes as &$ticketType) {
            $ticketTypeDetails = $ticketTypeModel->find($ticketType['TicketTypeID']);
            $ticketType['TicketType'] = $ticketTypeDetails['TicketType'];
            $ticketType['Price'] = $ticketTypeDetails['Price'];
            $ticketType['Quantity'] = $ticketTypeDetails['Quantity'];
        }

        // Prepare data to pass to the view
        $data = [
            'eventID' => $eventID,
            'eventName' => $event['EventName'],
            'eventDate' => $event['EventDate'],
            'eventLocation' => $event['EventLocation'],
            'ticketTypes' => $ticketTypes
        ];

        // Load the view and pass the data to it
        return view('admin/Edit_Event', $data);
    } else {
        // Handle case where event is not found
        return "Event not found";
    }
}


public function updateEventWithTickets($eventID)
{
    // Load necessary models
    $eventModel = new EventsModel();
    $ticketTypesModel = new TicketTypesModel();
    $ticketModel = new TicketsModel();

    // Get data from HTML form
    $eventName = $this->request->getPost('eventName');
    $eventDate = $this->request->getPost('eventDate');
    $imageFile = $this->request->getFile('imageFile');
    $eventLocation = $this->request->getPost('eventLocation');
    $ticketTypeArray = $this->request->getPost('ticketTypes');
    $priceArray = $this->request->getPost('prices');
    $quantityArray = $this->request->getPost('quantities');

    // Debugging: Output form data
    var_dump($eventName, $eventDate, $imageFile, $eventLocation, $ticketTypeArray, $priceArray, $quantityArray);

    // Check if event exists
    $event = $eventModel->find($eventID);
    if (!$event) {
        return redirect()->back()->withInput()->with('error', 'Event not found.');
    }

    // Handle file upload
    if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
        $newName = $imageFile->getRandomName();
        $imageFile->move(ROOTPATH . 'public/uploads', $newName);
        $imageUrl = '/uploads/' . $newName;
    } else {
        $imageUrl = $event['Image_url']; // Keep the existing image if no new image is uploaded
    }

    // Update event
    $eventData = [
        'EventName' => $eventName,
        'EventDate' => $eventDate,
        'Image_url' => $imageUrl,
        'EventLocation' => $eventLocation
    ];
    $eventModel->update($eventID, $eventData);

// Update ticket types
foreach ($ticketTypeArray as $key => $ticketType) {
    // Prepare ticket type data
    $ticketTypeData = [
        'TicketType' => $ticketType,
        'Price' => $priceArray[$key],
        'Quantity' => $quantityArray[$key],
        'EventID' => $eventID
    ];

    // Find the existing ticket type for this event and ticket type
    $existingTicketType = $ticketTypesModel
        ->where('EventID', $eventID)
        ->where('TicketType', $ticketType)
        ->first();

    // If the ticket type exists, update it
    if ($existingTicketType) {
        $ticketTypesModel->update(
            $existingTicketType['TicketTypeID'],
            $ticketTypeData
        );
    }
}






    return redirect()->to('/admin/events');
}


public function showAvailTickets()
{
    $userModel = new UsersModel();
    $ticketPurchasesModel = new TicketPurchasesModel();
    $ticketTypeModel = new TicketTypesModel();
    $eventModel = new EventsModel();

    $userData = $userModel->select('UserID, Username, UserType, SchoolID, AlumniCardNumber, GeneratedNumber')
        ->findAll(); // Fetch all users

    $data = [];

    foreach ($userData as $user) {
        $ticketInfo = $ticketPurchasesModel->select('ticketpurchases.PurchaseID, ticketpurchases.TicketID, ticketpurchases.TicketTypeID as TicketTypeID, ticketpurchases.EventID, ticketpurchases.FirstName, ticketpurchases.LastName, ticketpurchases.Email, ticketpurchases.Phone, ticketpurchases.Ref_Number, ticketpurchases.PaymentProof, ticketpurchases.PurchaseDate, ticketpurchases.Quantity, ticketpurchases.Status')
            ->where('UserID', $user['UserID'])
            ->join('tickettypes', 'tickettypes.TicketTypeID = ticketpurchases.TicketTypeID')
            ->join('events', 'events.EventID = ticketpurchases.EventID')
            ->findAll(); // Fetch ticket information for each user

        foreach ($ticketInfo as &$ticket) {
            // if ($ticket['Status'] == 'Pending') {
                $ticketType = $ticketTypeModel->select('TicketType, Price, Quantity')
                    ->where('TicketTypeID', $ticket['TicketTypeID'])
                    ->first(); // Fetch ticket type details

                $eventName = $eventModel->select('EventName')
                    ->where('EventID', $ticket['EventID'])
                    ->first(); // Fetch event name

                $ticket['TicketType'] = $ticketType['TicketType'];
                $ticket['Price'] = $ticketType['Price'];
                $ticket['EventName'] = $eventName['EventName'];
            // }
        }

        $user['TicketInfo'] = $ticketInfo;
        $data[] = $user;
    }

      // Add var_dump to inspect the data
    //   var_dump($data);
    return view('admin/Display_Avail_Tickets', ['userData' => $data]);
}

// Function to update ticket status to "Approved"
public function approveTicket($purchaseID)
{
    // Load the TicketPurchasesModel and QrcodeModel
    $ticketModel = new TicketPurchasesModel();
    $eventModel = new EventsModel();
    $qrcodeModel = new QrcodeModel();

    // Find the ticket by PurchaseID
    $ticket = $ticketModel->find($purchaseID);
    // Retrieve the EventID from the ticket data
    $eventID = $ticket['EventID'];

    // Find the event by ID
    $event = $eventModel->find($eventID);
    $ticketNumber = $qrcodeModel->find($purchaseID);



    // Check if the ticket exists
    if (!$ticket) {
        // Ticket not found, redirect back with an error message
        return redirect()->back()->with('error', 'Ticket not found.');
    }

    // Update the ticket status to "Approved"
    $data = ['Status' => 'Approved'];
    $ticketModel->update($purchaseID, $data);

    // Generate a unique number for the QR code
    $generatedNumber = uniqid();

    // Generate the QR code data (you can customize this data according to your requirements)
    $qrCodeData = json_encode([
        'PurchaseID' => $purchaseID,
        'GeneratedNumber' => $generatedNumber,
    ]);

    try {
        // Create QR code options
        $options = new QROptions([
            'outputType' => QRCode::OUTPUT_IMAGE_PNG,
            'eccLevel' => QRCode::ECC_H,
            'imageBase64' => false,
        ]);

        // Create a QRCode instance
        $qrcode = new QRCode($options);

        // Generate the QR code image
        $qrCodeImage = $qrcode->render($qrCodeData);

        // Define the file path and name for saving the QR code image as PNG
        $directory = 'uploads/qrcodes';
        $pngName = 'qrcode_' . $purchaseID . '.png';
        $pngFilePath = ROOTPATH . 'public/' . $directory . '/' . $pngName;

        // Save the QR code image to file
        file_put_contents($pngFilePath, $qrCodeImage);

        // Save the QR code file path and generated number to the QrcodeModel
        $qrcodeModel->insert([
            'PurchaseID' => $purchaseID,
            'QRCode' => '/' . $directory . '/' . $pngName,
            'GeneratedNumber' => $generatedNumber,
        ]);

        //
        // Send the QR code image via email
        $mailer = new PHPMailer(true);
        $mailer->isSMTP();
        // Configure your SMTP settings here
        $mailer->Host = 'smtp.gmail.com';
        $mailer->SMTPAuth = true;
        $mailer->Username = 'adonaieyecare@gmail.com';
        $mailer->Password = 'suxqojbojluggurs';
        $mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mailer->Port = 587;

        // Set sender and recipient
        $mailer->setFrom('adonaieyecare@gmail.com', 'Adonai-EyeCare');
        $mailer->addAddress($ticket['Email'], $ticket['FirstName'] . ' ' . $ticket['LastName']);

        // Attach the QR code image to the email
        $mailer->addAttachment($pngFilePath, 'qrcode.png');
         // Attach the QR code image to the email and get the CID
         $cid = basename($pngFilePath);
         $mailer->addEmbeddedImage($pngFilePath, $cid, 'qrcode.png');

        // Set email subject
        $mailer->Subject = 'QR Code for Ticket Purchase';


        // Set email body with HTML template
       // Set email body with HTML template
        $htmlBody = "
                <html>
                <head>
                    <title>QR Code for Ticket Purchase</title>
                    <style>
                        .ticket {
                            width: 400px;
                            background-color: #f5f5f5;
                            border-radius: 10px;
                            padding: 20px;
                            margin: 0 auto;
                        }
                        .ticket-header {
                            text-align: center;
                        }
                        .ticket-content {
                            margin-top: 20px;
                        }
                        .qr-code {
                            text-align: center;
                            margin-top: 20px;
                        }
                        .qr-code img {
                            width: 200px;
                            height: auto;
                        }
                    </style>
                </head>
                <body>
                    <div class='ticket'>
                        <div class='ticket-header'>
                            <h2>Your Ticket</h2>
                        </div>
                        <div class='ticket-content'>
                            <p>Event: {$event['EventName']}</p>
                            <p>Date: {$event['EventDate']}</p>
                            <p>Location: {$event['EventLocation']}</p>
                            <p>Name: {$ticket['FirstName']} {$ticket['LastName']}</p>
                            <p>Email: {$ticket['Email']}</p>
                            <p>Ticket Number: {$ticketNumber['GeneratedNumber']}</p>
                        </div>
                        <div class='qr-code'>
                            <img src='cid:{$cid}' alt='QR Code'>
                        </div>
                        <div class='ticket-content'>
                            <p>Event: {$event['EventName']}</p>
                        </div>
                    </div>
                </body>
                </html>
            ";

        $mailer->isHTML(true);
        $mailer->Body = $htmlBody;

        // Send the email
        $mailer->send();

        // Redirect to a specific route after updating the ticket status
        return redirect()->to('/admin/avail-tickets')->with('success', 'Ticket approved successfully.');
    } catch (\Exception $e) {
        // Handle any exceptions
        return redirect()->back()->with('error', 'Error generating or saving QR code: ' . $e->getMessage());
    }
}


// Function to update ticket status to "Declined"
public function declineTicket($purchaseID)
{
    // Load the TicketPurchasesModel
    $ticketModel = new TicketPurchasesModel();

    // Find the ticket by PurchaseID
    $ticket = $ticketModel->find($purchaseID);

    // Check if the ticket exists
    if (!$ticket) {
        // Ticket not found, redirect back with an error message
        return redirect()->back()->with('error', 'Ticket not found.');
    }

    // Update the ticket status to "Declined"
    $data = ['Status' => 'Declined'];
    $ticketModel->update($purchaseID, $data);

    // Redirect to a specific route after updating the ticket status
    return redirect()->to('/admin/avail-tickets')->with('success', 'Ticket declined successfully.');
}

}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\EventsModel;
use App\Models\TicketTypesModel;
use App\Models\TicketsModel;

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

    

}
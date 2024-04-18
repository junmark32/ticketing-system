<?php

namespace App\Controllers;

use App\Controllers\BaseController;
Use App\Models\QRcodeModel;
Use App\Models\EventsModel;
Use App\Models\TicketpurchasesModel;
class ScannerController extends BaseController
{
    public function index()
    {
        return view('admin/scanner');
    }


    public function validateQRCode()
    {
        $request = $this->request->getJSON();
    
        // Check if the content is coming from a QR code scan or manual input
        $purchaseId = null;
        if (isset($request->purchaseId)) {
            // Content is coming from a QR code scan
            $purchaseId = $request->purchaseId;
        } elseif (isset($request->generatedNumber)) {
            // Content is coming from manual input
            // Load the QRCodeModel
            $model = new QRcodeModel();
            // Find the PurchaseID associated with the manually entered GeneratedNumber
            $result = $model->where('GeneratedNumber', $request->generatedNumber)->first();
            if ($result) {
                $purchaseId = $result->PurchaseID;
            } else {
                // No matching record found in QR code table
                return $this->response->setStatusCode(404)->setJSON(['message' => 'Invalid QR code or ticket not found.']);
            }
        } else {
            // Neither purchaseId nor generatedNumber is provided
            return $this->response->setStatusCode(400)->setJSON(['message' => 'Invalid request.']);
        }
    
        // Load the TicketpurchasesModel
        $ticketPurchaseModel = new TicketpurchasesModel();
    
        $ticketPurchase = $ticketPurchaseModel->where('PurchaseID', $purchaseId)->first();

        if ($ticketPurchase) {
            // Check if the event associated with the ticket is still available
            $eventModel = new EventsModel();
            // Use array notation to access the properties
            $event = $eventModel->find($ticketPurchase['EventID']); // Change $ticketPurchase->EventID to $ticketPurchase['EventID']
            if ($event) {
                // Event exists, proceed with scanning
                // Check if the status is 'Scanned' or 'Denied'
                if ($ticketPurchase['Status'] === 'Scanned' || $ticketPurchase['Status'] === 'Denied') {
                    return $this->response->setJSON(['message' => 'Sorry, this ticket is invalid.']);
                }
                // Update the status to 'Scanned'
                $ticketPurchaseModel->update($ticketPurchase['PurchaseID'], ['Status' => 'Scanned']); // Use update method instead of save
                return $this->response->setJSON(['message' => 'QR code scanned successfully.']);
            } else {
                // Event associated with the ticket is no longer available
                return $this->response->setJSON(['message' => 'Sorry, the event that the ticket is from is no longer available.']);
            }
        }
        // Ticket not found
        return $this->response->setStatusCode(404)->setJSON(['message' => 'Invalid QR code or ticket not found.']);
    }
    

    
    
    
    
    

}

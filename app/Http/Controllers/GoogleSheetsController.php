<?php

namespace App\Http\Controllers;

use App\Services\GoogleSheetsService;
use Illuminate\Http\Request;

class GoogleSheetsController extends Controller
{
    protected $googleSheetsService;

    public function __construct(GoogleSheetsService $googleSheetsService)
    {
        $this->googleSheetsService = $googleSheetsService;
    }

    public function transferData()
    {
        ini_set('max_execution_time', 60*12); // 3600 seconds = 60 minutes
        set_time_limit(60*12);
        

        // Define your source and destination spreadsheet IDs and ranges
        $sourceSpreadsheetId = '1OTtC26qjWFGwmjMuhDUqznVWNnLzrrm4-adlS5Im6Us';
        $sourceRange = [
            'Real Sites - Blogger Outreach!B3:B10', // Adjust the range as needed
            'Real Sites - Blogger Outreach!D3:L10', // Adjust the range as needed
            'Real Sites - Blogger Outreach!N3:P10', // Adjust the range as needed
            'Real Sites - Blogger Outreach!AA3:AB10', // Adjust the range as needed
            'Real Sites - Blogger Outreach!AE3:AH10' // Adjust the range as needed
        ]; 

        $destinationSpreadsheetId = '19KSQVAK4zy8_b1a8wtohFkXBjrYcB7hCDUx7OXQBNjw';
        $destinationRanges = [
            'Test Sheet!B3',
            'Test Sheet!C3',
            'Test Sheet!L3',
            'Test Sheet!O3',
            'Test Sheet!Q3',
        ]; // Adjust the range as needed

        // Get data from the source spreadsheet
        $sourceData = $this->googleSheetsService->getSpreadsheetData($sourceSpreadsheetId, $sourceRange);

        // $values = [
        //     ['ABC','123@gmail.com'],['XYZ','=1+3']
        // ];
       
        // Prepare data for destination spreadsheet
       $destinationData = [];
       foreach ($sourceData as $index => $valueRange) {
           $destinationData[$destinationRanges[$index]] = $valueRange->getValues();
       }
        // Update the destination spreadsheet with the retrieved data
       $body =  $this->googleSheetsService->updateSpreadsheet($destinationSpreadsheetId, $destinationData);

        // return response()->json(['message' => 'Data transferred successfully']);
        return response()->json($body);
    }
}

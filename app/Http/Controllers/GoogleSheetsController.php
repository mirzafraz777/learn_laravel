<?php

namespace App\Http\Controllers;

use App\Services\GoogleSheetsService;

class GoogleSheetsController extends Controller
{
    protected $googleSheetsService;

    public function __construct(GoogleSheetsService $googleSheetsService)
    {
        $this->googleSheetsService = $googleSheetsService;
    }

    public function transferData()
    {
        ini_set('max_execution_time', 60 * 12); // 3600 seconds = 60 minutes
        set_time_limit(60 * 12);


        // Define your source and destination spreadsheet IDs and ranges
        // $sourceSpreadsheetId = '1OTtC26qjWFGwmjMuhDUqznVWNnLzrrm4-adlS5Im6Us'; // Test Source Sheet
        $sourceSpreadsheetId = '12lNlY5_lZvgpw_uJ2FedF6eQiu0hZUarnosy25v-rxA'; // Main Source Sheet
        $sourceRange = [
            'Real Sites - Blogger Outreach!B3:B',   // Adjust the range as needed
            'Real Sites - Blogger Outreach!D3:L',   // Adjust the range as needed
            'Real Sites - Blogger Outreach!N3:P',   // Adjust the range as needed
            'Real Sites - Blogger Outreach!S3:T',   // Adjust the range as needed
            'Real Sites - Blogger Outreach!AA3:AB', // Adjust the range as needed
            'Real Sites - Blogger Outreach!AE3:AH',  // Adjust the range as needed
        ];

        // $destinationSpreadsheetId = '19KSQVAK4zy8_b1a8wtohFkXBjrYcB7hCDUx7OXQBNjw'; // Test Destination Sheet
        $destinationSpreadsheetId = '1x03_01FerT9mYK8BDzCaWUSu_ZYd8Jrs8Qmf0i8oQ4s';    // Main Destination Sheet
        // $destinationRange ='Test Sheet!B3'; 
        $destinationRanges = [
            'Price-Email!B2',
            'Price-Email!C2',
            'Price-Email!L2',
            'Price-Email!O2',
            'Price-Email!Q2',
            'Price-Email!S2',
        ]; // Adjust the range as needed

        // Get data from the source spreadsheet
        $sourceValues = $this->googleSheetsService->batchGetValues($sourceSpreadsheetId, $sourceRange);

        // $values = [
        //     ['ABC','123@gmail.com'],['XYZ','=1+3']
        // ];

        // Update the destination spreadsheet with the retrieved data
           $destinationValues =  $this->googleSheetsService->batchUpdateValues($destinationSpreadsheetId, $destinationRanges,"RAW", $sourceValues);


        // return response()->json(['message' => 'Data transferred successfully']);

        // return response()->json($sourceValues);
        return response()->json($destinationValues);
    }
}

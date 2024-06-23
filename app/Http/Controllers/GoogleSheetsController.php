<?php

namespace App\Http\Controllers;

use App\Services\GoogleSheetsService;
use Google\Service\Sheets\ValueRange;
use Symfony\Component\VarDumper\VarDumper;

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
        $clearRange = [
            "'Price-Email'!A2:V",
        ];

        $destinationRanges = [
            'Price-Email!B2',
            'Price-Email!C2',
            'Price-Email!L2',
            'Price-Email!O2',
            'Price-Email!Q2',
            'Price-Email!S2',
        ]; // Adjust the range as needed

        // Get data from the source spreadsheet
        $sourceValues = $this->googleSheetsService->batchGetValues($sourceSpreadsheetId, $sourceRange, 'ROWS');



        // First Clear All Content from Destination Sheet Then add values to it. 

        if ($this->googleSheetsService->batchClear($destinationSpreadsheetId, $clearRange)) {
            // Update the destination spreadsheet with the retrieved data
            $destinationValues =  $this->googleSheetsService->batchUpdateValues($destinationSpreadsheetId, $destinationRanges, "RAW", $sourceValues);

            // return response()->json(['message' => 'Data transferred successfully']);
            // return response()->json($sourceValues);
            return response()->json($destinationValues);
        }
    }

    // Add New Blog Task

    public function addNewBlog()
    {

        $sourceSpreadsheetId = '1xFU-95lI3oOsk9FYsJcb3sdvC0zL1t0YC6a7bHA1pak'; // Blogs Prospecting
        $sourceRange = [
            "'Blogs Prospecting'!A1:A"
        ];

        // Get Data from Blogs Prospecting Sheet 
        $sourceValues = $this->googleSheetsService->batchGetValues($sourceSpreadsheetId, $sourceRange, 'COLUMNS');
        $first_array = $sourceValues[0]->getValues();
        
        if (!is_null($first_array)) {
            
            $destinationSpreadsheetId = '1IovnLavZWVgbnTZKpkEfdUHrVsWJjli9yFm9u-bSQho'; // All Blogs Data
            $destinationRange = [
                "'All Blogs Data'!A3:A",
            ];
            
            // Get Data from All Blogs Data Sheet
            $destinationValues = $this->googleSheetsService->batchGetValues($destinationSpreadsheetId, $destinationRange, 'COLUMNS');
            $second_array = $destinationValues[0]->getValues();
            
            // Return Unique Values without Key.
            $uniqueValues = array_values(array_diff($first_array[0], $second_array[0]));

            if (count($uniqueValues) > 0) {
                //  Now we apped this values at the end of the Sheet
                $result = $this->googleSheetsService->appendValues($destinationSpreadsheetId, "'All Blogs Data'!A3:A", "RAW", $uniqueValues);
                // Clear all data from Blogs Prospecting Sheet
                if ($result) {
                    $this->googleSheetsService->batchClear($sourceSpreadsheetId, $sourceRange);
                }

                return response()->json([
                    'message' => 'Data transferred successfully',
                    'total_values' => count($uniqueValues),
                ]);
            } else {
                $this->googleSheetsService->batchClear($sourceSpreadsheetId, $sourceRange);
            }
        }

        return response()->json([
            'message' => 'No Value found in Blog Prospecting Sheet.'
        ]);
    }

    public function highAuthority()
    {
        $sourceSpreadsheetId = '12lNlY5_lZvgpw_uJ2FedF6eQiu0hZUarnosy25v-rxA';  // Real Sites - Blogger Outreach
        $sourceRanges = "'Real Sites - Blogger Outreach'!B2:AH10";
        // Get Filter Values from Real Sites - Blogger Outreach
       
        $data = $this->googleSheetsService->batchGetValues($sourceSpreadsheetId, $sourceRanges, 'ROWS');
        $valuesRanges = $data->getValueRanges();
        $values = $valuesRanges[0]->getValues();

        foreach ($values as $rowIndex => $row) {

            echo $rowIndex .'  -  '. $row;
            echo '<br>';
            
            // if (isset($row[2]) && $row[2] === 'Done') {
            //     echo "Found";
            // }
        }
        return;
        // return response()->json($values);

        // $data = $this->googleSheetsService->getFilterValues($sourceSpreadsheetId, $sourceRanges);



        $destinationSpreadsheetId = '19KSQVAK4zy8_b1a8wtohFkXBjrYcB7hCDUx7OXQBNjw'; //All Publishers List
        $destinationRanges = ["'All Publishers List'!B5:B"];
        $valuInputOption = 'RAW';
        $result = $this->googleSheetsService->batchUpdateValues($destinationSpreadsheetId, $destinationRanges, $valuInputOption, $data);
    }
}

<?php

namespace App\Services;

use Google\Client;
use Google\Service\Sheets;
use Google\Service\Sheets\DataFilter;
use Google\Service\Sheets\ValueRange;
use Google\Service\Sheets\BatchClearValuesRequest;
use Google\Service\Sheets\BatchUpdateValuesRequest;
use Google\Service\Sheets\BatchGetValuesByDataFilterRequest;

class GoogleSheetsService
{
    protected $client;
    protected $service;

    public function __construct()
    {
        $this->client = new Client();
        $this->client->addScope(Sheets::SPREADSHEETS);
        $this->client->setAuthConfig(storage_path('app/credentials.json'));
        // $this->client->setAccessType("offline");
        $this->service = new Sheets($this->client);
    }

    public function batchGetValues($spreadsheetId, $givenRange, $dimension)
    {
        try {

            $params = array(
                'ranges' => $givenRange,
                'majorDimension' => $dimension

            );
            $result = $this->service->spreadsheets_values->batchGet($spreadsheetId, $params);

            // printf("%d ranges retrieved.", count($result->getValueRanges()));
            return $result;
        } catch (\Throwable $th) {
            throw $th;
            // TODO(developer) - handle error appropriately
            // echo 'Message: ' .$e->getMessage();

        }
    }


    function appendValues($spreadsheetId, $range, $valueInputOption, $appendValues)
    {


        try {

            //execute the request
            $body = new ValueRange([
                'values' => [$appendValues], //add the values to be appended
                'range' => $range,
                'majorDimension' => 'COLUMNS'

            ]);
            $params = [
                'valueInputOption' => $valueInputOption
            ];

            $result = $this->service->spreadsheets_values->append($spreadsheetId, $range, $body, $params);
            // printf("%d cells appended.", $result->getUpdates()->getUpdatedCells());
            return $result;
        } catch (\Throwable $th) {
            throw $th;
            // TODO(developer) - handle error appropriately
            // echo 'Message: ' .$e->getMessage();

        }
    }

    public function getFilterValues($spreadsheetId, $givenRange)
    {


        $dataFilters[] = new DataFilter([
            'a1Range' => $givenRange
        ]);


        $body = new BatchGetValuesByDataFilterRequest([
            'dateTimeRenderOption'=>'SERIAL_NUMBER',
            'majorDimension'=>'ROWS',
            'valueRenderOption'=>'FORMATTED_VALUE',
            'dataFilters'=>$dataFilters
                      
        ]);
        // return $body;
        try {

            $result = $this->service->spreadsheets_values->batchGetByDataFilter($spreadsheetId, $body);
            return $result->getValueRanges();
        } catch (\Throwable $th) {

            throw $th;
            // TODO(developer) - handle error appropriately
            // echo 'Message: ' .$e->getMessage();

        }
    }


    public function batchUpdateValues($spreadsheetId, $destinationRanges, $valueInputOption,  $sourceValues)
    {

        // $values = [
        //     [1, 1, 1, 1, 1, 1, 1, 1, 1, 1],
        //     [2, 2, 2, 2, 2, 2, 2, 2, 2, 2],
        //     [3, 3, 3, 3, 3, 3, 3, 3, 3, 3],
        // ];

        // return $sourceValues;
        // return $sourceValues[0]->values;
        try {

            $data = [];

            foreach ($destinationRanges as $key => $destinationRange) {

                $data[] = new ValueRange([
                    'majorDimension' => 'ROWS', // "ROWS","COLUMNS"
                    'range' => $destinationRange,
                    'values' => $sourceValues[$key]->values
                ]);
            }


            $body = new BatchUpdateValuesRequest([
                'valueInputOption' => $valueInputOption, // "RAW","USER_ENTERED"
                'data' => $data,
                // 'includeValuesInResponse' => true,
                'responseValueRenderOption' => 'FORMATTED_VALUE',  //"FORMATTED_VALUE","UNFORMATTED_VALUE","FORMULA"
                'responseDateTimeRenderOption' => 'FORMATTED_STRING',  // "SERIAL_NUMBER","FORMATTED_STRING"
            ]);

            $result = $this->service->spreadsheets_values->batchUpdate($spreadsheetId, $body);
            // printf("%d cells updated.", $result->getTotalUpdatedCells());
            return $result;
        } catch (\Throwable $th) {
            throw $th;
            // TODO(developer) - handle error appropriately
            // echo 'Message: ' .$e->getMessage();
        }
    }

    public function batchClear($spreadsheetId, $givenRange)
    {
        $body = new BatchClearValuesRequest([
            'ranges' => $givenRange
        ]);

        try {
            //code...
            $response = $this->service->spreadsheets_values->batchClear($spreadsheetId, $body);
            return $response;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

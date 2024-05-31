<?php

namespace App\Services;

use Google\Client;
use Google\Service\Sheets;
use Google\Service\Sheets\BatchUpdateValuesRequest;
use Google\Service\Sheets\ValueRange;
use Google\Service\Sheets\ClearValuesRequest;

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

    public function getSpreadsheetData($spreadsheetId, $range)
    {
        // $optparam = [
        //     'majorDimension'=>'COLUMNS'
        // ];

        $response = $this->service->spreadsheets_values->batchGet($spreadsheetId,['ranges'=>$range]);
        return $response->getValueRanges();
        // return $response;
    }

    public function updateSpreadsheet($spreadsheetId, array $values)
    {

        $data = [];
        
        foreach ($values as $range => $value) {
            $data = new ValueRange([
                'range'=>$range,
                'values'=>$value
            ]);
        }
            $body = new BatchUpdateValuesRequest([
            'valueInputOption' => 'USER_ENTERED',
            'data'=>$data
            ]);

            return $body;


        return $this->service->spreadsheets_values->batchUpdate($spreadsheetId,$body); // update($spreadsheetId, $range, $body, $params);
    }
}

<?php
require __DIR__ . '/vendor/autoload.php'; // Include the Google Sheets API library

// Set up Google Sheets API client
$client = new Google_Client();
$client->setAuthConfig('client_secret_2883092674-ms19htqm9ochv46fre7uulsjsru392tt.apps.googleusercontent.com.json'); // Replace with your credentials JSON file
$client->addScope(Google_Service_Sheets::SPREADSHEETS);

// Create a Google Sheets service
$service = new Google_Service_Sheets($client);

// Define the spreadsheet ID and range
$spreadsheetId = '1OAoy3wi9CCDNf9V3cdHoMX2q4FkzWa5gDg9gx_y9LDo'; // Replace with your actual spreadsheet ID
$range = 'Sheet1'; // Replace with the sheet name

// Get form data from POST request
$email = $_POST['email'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$institution = $_POST['institution'];
$field = $_POST['field'];
$year = $_POST['year'];

// Create an array of values to insert into the spreadsheet
$values = [
    [$email, $name, $phone, $institution, $field, $year]
];

// Prepare the request to update the spreadsheet
$requestBody = new Google_Service_Sheets_ValueRange([
    'values' => $values
]);

// Update the spreadsheet
$response = $service->spreadsheets_values->append($spreadsheetId, $range, $requestBody, ['valueInputOption' => 'RAW']);

// Check for errors
if ($response->getUpdates()->getUpdatedCells() > 0) {
    // Data updated successfully, redirect to another link
    header('Location: https://www.youtube.com'); // Replace with your desired redirect URL
    exit;
} else {
    // Handle errors
    echo 'Error updating data.';
}
?>

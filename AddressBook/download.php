<?php
require_once './config.php';
try {
  function createXMLfile($contacts)
  {

    $fileName = 'addressBook.xml';

    $dom = new DOMDocument('1.0', 'utf-8');
    $dom->formatOutput = True;
    $root = $dom->createElement('AddressBook');

    foreach ($contacts as $contactValue) {

      $id =  $contactValue['id'];

      $first_name = $contactValue['first_name'];

      $last_name =  $contactValue['last_name'];

      $street =  $contactValue['street'];

      $zip_code =  $contactValue['zip'];

      $city  =  $contactValue['city'];

      $contact = $dom->createElement('Contact');

      $contact->setAttribute('id', $id);
      $fname = $dom->createElement('FirstName', $first_name);
      $contact->appendChild($fname);

      $lname = $dom->createElement('LastName', $last_name);
      $contact->appendChild($lname);

      $streetNode = $dom->createElement('Street', $street);
      $contact->appendChild($streetNode);

      $zipNode = $dom->createElement('Zip', $zip_code);
      $contact->appendChild($zipNode);

      $cityNode = $dom->createElement('City', $city);
      $contact->appendChild($cityNode);


      $root->appendChild($contact);
    }

    $dom->appendChild($root);

    //$dom->save($fileName);
    header('Content-type: text/xml');
    header('Content-Disposition: attachment; filename="' . $fileName . '"');
    echo $dom->saveXML();
  }

  $sql = "SELECT * FROM contacts WHERE 1";
  $stmt = $DB->prepare($sql);
  $stmt->execute();
  $results = $stmt->fetchAll();
  
  createXMLfile($results);
} catch (Exception $ex) {
  echo $ex->getMessage();
}

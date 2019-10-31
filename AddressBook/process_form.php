<?php

require './config.php';
$mode = $_REQUEST["mode"];
if ($mode == "add_new") {
  $first_name = trim($_POST['first_name']);
  $last_name = trim($_POST['last_name']);
  $street = trim($_POST['street']);
  $zip = trim($_POST['zip']);
  $city = trim($_POST['city']);

  $sql = "INSERT INTO `contacts` (`first_name`, `last_name`, `street`, `zip`, `city`) VALUES "
    . "( :fname, :lname, :street, :zip, :city)";

  try {
    $stmt = $DB->prepare($sql);
    $stmt->bindValue(":fname", $first_name);
    $stmt->bindValue(":lname", $last_name);
    $stmt->bindValue(":street", $street);
    $stmt->bindValue(":zip", $zip);
    $stmt->bindValue(":city", $city);

    // execute Query
    $stmt->execute();
    $result = $stmt->rowCount();
    if ($result > 0) {
      $_SESSION["errorType"] = "success";
      $_SESSION["errorMsg"] = "Contact added successfully.";
    } else {
      $_SESSION["errorType"] = "danger";
      $_SESSION["errorMsg"] = "Failed to add contact.";
    }
  } catch (Exception $ex) {

    $_SESSION["errorType"] = "danger";
    $_SESSION["errorMsg"] = $ex->getMessage();
  }

  header("location:index.php");
} elseif ($mode == "update_old") {

  $first_name = trim($_POST['first_name']);
  $last_name = trim($_POST['last_name']);
  $street = trim($_POST['street']);
  $zip = trim($_POST['zip']);
  $city = trim($_POST['city']);
  $cid = trim($_POST['cid']);

  $sql = "UPDATE `contacts` SET `first_name` = :fname, `last_name` = :lname, `street` = :street, `zip` = :zip, `city` = :city "
    . "WHERE id = :cid ";

  try {
    $stmt = $DB->prepare($sql);

    $stmt->bindValue(":fname", $first_name);
    $stmt->bindValue(":lname", $last_name);
    $stmt->bindValue(":street", $street);
    $stmt->bindValue(":zip", $zip);
    $stmt->bindValue(":city", $city);
    $stmt->bindValue(":cid", $cid);

    // execute Query
    $stmt->execute();
    $result = $stmt->rowCount();
    if ($result > 0) {
      $_SESSION["errorType"] = "success";
      $_SESSION["errorMsg"] = "Contact updated successfully.";
    } else {
      $_SESSION["errorType"] = "info";
      $_SESSION["errorMsg"] = "No changes made to contact.";
    }
  } catch (Exception $ex) {

    $_SESSION["errorType"] = "danger";
    $_SESSION["errorMsg"] = $ex->getMessage();
  }

  header("location:index.php?pagenum=" . $_POST['pagenum']);
} elseif ($mode == "delete") {
  $cid = intval($_GET['cid']);

  $sql = "DELETE FROM `contacts` WHERE id = :cid";
  try {

    $stmt = $DB->prepare($sql);
    $stmt->bindValue(":cid", $cid);

    $stmt->execute();
    $res = $stmt->rowCount();
    if ($res > 0) {
      $_SESSION["errorType"] = "success";
      $_SESSION["errorMsg"] = "Contact deleted successfully.";
    } else {
      $_SESSION["errorType"] = "info";
      $_SESSION["errorMsg"] = "Failed to delete contact.";
    }
  } catch (Exception $ex) {
    $_SESSION["errorType"] = "danger";
    $_SESSION["errorMsg"] = $ex->getMessage();
  }

  header("location:index.php?pagenum=" . $_GET['pagenum']);
}

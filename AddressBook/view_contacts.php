<?php
require_once './config.php';
include './header.php';
try {
  $sql = "SELECT * FROM contacts WHERE 1 AND id = :cid";
  $stmt = $DB->prepare($sql);
  $stmt->bindValue(":cid", intval($_GET["cid"]));

  $stmt->execute();
  $results = $stmt->fetchAll();
} catch (Exception $ex) {
  echo $ex->getMessage();
}

?>

<div class="row">
  <ul class="breadcrumb">
    <li><a href="index.php">Home</a></li>
    <li class="active">View Contacts</li>
  </ul>
</div>

<div class="row">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">View Contact</h3>
    </div>
    <div class="panel-body">
      <form class="form-horizontal" name="contact_form" id="contact_form" enctype="multipart/form-data" method="post" action="process_form.php">
        <fieldset>
          <div class="form-group">
            <label class="col-lg-4 control-label" for="first_name"><span class="required">*</span>First Name:</label>
            <div class="col-lg-5">
              <input type="text" readonly="" placeholder="First Name" value="<?php echo $results[0]["first_name"] ?>" id="first_name" class="form-control" name="first_name"><span id="first_name_err" class="error"></span>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-4 control-label" for="last_name"><span class="required">*</span>Last Name:</label>
            <div class="col-lg-5">
              <input type="text" readonly="" value="<?php echo $results[0]["last_name"] ?>" placeholder="Last Name" id="last_name" class="form-control" name="last_name"><span id="last_name_err" class="error"></span>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-4 control-label" for="city">Street:</label>
            <div class="col-lg-5">
              <input type="text" readonly="" value="<?php echo $results[0]["street"] ?>" placeholder="Street" id="street" class="form-control" name="street"><span id="street" class="error"></span>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-4 control-label" for="city">Zip Code:</label>
            <div class="col-lg-5">
              <input type="text" readonly="" value="<?php echo $results[0]["zip"] ?>" placeholder="zip" id="zip" class="form-control" name="zip"><span id="zip" class="error"></span>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-4 control-label" for="city">City:</label>
            <div class="col-lg-5">
              <input type="text" readonly="" value="<?php echo $results[0]["city"] ?>" placeholder="City" id="city" class="form-control" name="city"><span id="city" class="error"></span>
            </div>
          </div>
        </fieldset>
      </form>

    </div>
  </div>
</div>
<?php
include './footer.php';
?>
<?php
require_once './config.php';
include './header.php';
try {
  $sql = "SELECT * FROM contacts WHERE 1 AND id = :cid";
  $stmt = $DB->prepare($sql);
  $stmt->bindValue(":cid", intval($_GET["cid"]));

  $stmt->execute();
  $results = $stmt->fetchAll();
  // Get cities
  $sqlCities = "SELECT * FROM cities WHERE 1";
  $stmtCities = $DB->prepare($sqlCities);
  $stmtCities->execute();
  $resultCities = $stmtCities->fetchAll();
} catch (Exception $ex) {
  echo $ex->getMessage();
}
?>

<div class="row">
  <ul class="breadcrumb">
    <li><a href="index.php">Home</a></li>
    <li class="active"><?php echo ($_GET["m"] == "update") ? "Edit" : "Add"; ?> Contacts</li>
  </ul>
</div>

<div class="row">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title"><?php echo ($_GET["m"] == "update") ? "Edit" : "Add"; ?> New Contact</h3>
    </div>
    <div class="panel-body">

      <form class="form-horizontal" name="contact_form" id="contact_form" enctype="multipart/form-data" method="post" action="process_form.php">
        <input type="hidden" name="mode" value="<?php echo ($_GET["m"] == "update") ? "update_old" : "add_new"; ?>">
        <input type="hidden" name="cid" value="<?php echo intval($results[0]["id"]); ?>">
        <input type="hidden" name="pagenum" value="<?php echo $_GET["pagenum"]; ?>">
        <fieldset>
          <div class="form-group">
            <label class="col-lg-4 control-label" for="first_name"><span class="required">*</span>First Name:</label>
            <div class="col-lg-5">
              <input type="text" value="<?php echo $results[0]["first_name"] ?>" placeholder="First Name" id="first_name" class="form-control" name="first_name"><span id="first_name_err" class="error"></span>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-4 control-label" for="last_name"><span class="required">*</span>Last Name:</label>
            <div class="col-lg-5">
              <input type="text" value="<?php echo $results[0]["last_name"] ?>" placeholder="Last Name" id="last_name" class="form-control" name="last_name"><span id="last_name_err" class="error"></span>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-4 control-label" for="street"><span class="required"></span>Street:</label>
            <div class="col-lg-5">
              <input type="text" value="<?php echo $results[0]["street"] ?>" placeholder="Street" id="street" class="form-control" name="street">
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-4 control-label" for="zip"><span class="required"></span>Zip Code:</label>
            <div class="col-lg-5">
              <input type="text" value="<?php echo $results[0]["zip"] ?>" placeholder="Zip Code" id="zip" class="form-control" name="zip">
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-4 control-label" for="city"><span class="required"></span>City:</label>
            <div class="col-lg-5">
              <select name="per1" id="city" class="form-control">
                <option selected="selected">--Select City--</option>
                <?php
                foreach ($resultCities as $city) {
                  $selected = ($city['city_name'] == $results[0]["city"]) ? " selected='selected' " : "";
                  ?>
                  <option value="<?= $city['city_name'] ?>" <?= $selected ?>><?= $city['city_name'] ?></option>
                <?php
                } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="col-lg-5 col-lg-offset-4">
              <button class="btn btn-primary" type="submit">Submit</button>
            </div>
          </div>
        </fieldset>
      </form>

    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {

    // the fade out effect on hover
    $('.error').hover(function() {
      $(this).fadeOut(200);
    });


    $("#contact_form").submit(function() {
      $('.error').fadeOut(200);
      if (!validateForm()) {
        // go to the top of form first
        $(window).scrollTop($("#contact_form").offset().top);
        return false;
      }
      return true;
    });

  });

  function validateForm() {
    var errCnt = 0;

    var first_name = $.trim($("#first_name").val());
    var last_name = $.trim($("#last_name").val());
    // validate name
    if (first_name == "") {
      $("#first_name_err").html("Enter your first name.");
      $('#first_name_err').fadeIn("fast");
      errCnt++;
    } else if (first_name.length <= 2) {
      $("#first_name_err").html("Enter atleast 3 letter.");
      $('#first_name_err').fadeIn("fast");
      errCnt++;
    }

    if (last_name == "") {
      $("#last_name_err").html("Enter your last name.");
      $('#last_name_err').fadeIn("fast");
      errCnt++;
    } else if (last_name.length <= 2) {
      $("#last_name_err").html("Enter atleast 3 letter.");
      $('#last_name_err').fadeIn("fast");
      errCnt++;
    }

    if (errCnt > 0) return false;
    else return true;
  }
</script>
<?php
include './footer.php';
?>
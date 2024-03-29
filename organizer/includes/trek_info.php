<?php
$trek_id = $_GET['id'];
$interested          = mysqli_query($connection, "SELECT concat_ws(' ', user_firstname, user_lastname, ':',user_phonenumber,':',user_email) AS 'user_details' FROM interested INNER JOIN treks ON interested.trek_id = treks.trek_id INNER JOIN users ON interested.user_id = users.user_id WHERE treks.trek_id = $trek_id");
$comments            = mysqli_query($connection, "SELECT * FROM comments INNER JOIN treks ON comments.trek_id = treks.trek_id INNER JOIN users ON comments.user_id = users.user_id");
$billing_information = mysqli_query($connection, "SELECT * FROM billing_information INNER JOIN mode_of_payment ON billing_information.mode_id = mode_of_payment.mode_id INNER JOIN treks ON billing_information.trek_id = treks.trek_id INNER JOIN users ON billing_information.user_id = users.user_id WHERE treks.trek_id = $trek_id");
?>

<div class="container">
  <div class="row">
    <div class="col-6">
      <div class="card border-primary mb-3">
        <div class="card-header d-flex justify-content-between text-light" style="background: linear-gradient(to right, #396afc, #2948ff);">
          Interested
          <span>
            <?php echo mysqli_num_rows($interested); ?>
          </span>
        </div>
        <div class="card-body">
          <?php
          while ($row = mysqli_fetch_assoc($interested)) { ?>
            <p class="card-text text-center">

              <?php echo $row['user_details']; ?>
            </p>

            <hr>
            <?php
          }
          ?>
        </div>
      </div>
      <!-- END OF THE INTERESTED CARD -->
    </div>

    <div class="col-6">
      <div class="card border-success mb-3">
        <div class="card-header d-flex justify-content-between text-light" style="background: linear-gradient(to right, #56ab2f, #a8e063);">
          Bookings
          <span><?php echo mysqli_num_rows($billing_information); ?></span>
        </div>
        <div class="card-body">
          <?php while ($row = mysqli_fetch_assoc($billing_information)) { ?>
            <div class="d-flex justify-content-center">
              <div class="">
                <?php if (!empty($row['user_image'])): ?>
                  <img src="../images/<?php echo $row['user_image']; ?>" width="60" height="60" style="border-radius:50%;">
                <?php else: ?>
                  <img src="../images/default-profile.png" width="60" height="60" style="border-radius:50%;">
                <?php endif; ?>
              </div>
              <div class="align-self-center ml-2">
                <span class="lead" style="font-size: 1.5rem; font-weight: 400;">
                  <?php echo $row['user_firstname']." ".$row['user_lastname']; ?> :
                </span>

                <span class="lead" style="font-size: 1.2rem; font-weight: 400;">
                  <?php if ($row['mode_name'] == 'Online'): ?>
                    <?php echo "Payed" ?>
                  <?php else: ?>
                    <?php echo "Not Payed" ?>
                  <?php endif; ?>
                  <small>
                    (<?php echo $row['mode_name']; ?>)
                  </small>
                </span>
              </div>
            </div>
            <hr>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
  <!-- END OF INTERESTED AND BOOKED USERS ROW-->

  <div class="row">
    <div class="col-12">
      <div class="card border-warning mb-3">
        <div class="card-header d-flex justify-content-between m-0 text-light" style="background: linear-gradient(to right, #ff8008, #ffc837);">
          Comments
          <span>
            <?php echo mysqli_num_rows($comments); ?>
          </span>
        </div>
        <div class="card-body">
          <?php
          while ($row = mysqli_fetch_assoc($comments)) { ?>
            <div class="d-flex justify-content-center">
              <?php if (!empty($row['user_image'])): ?>
                <img src="../images/<?php echo $row['user_image']; ?>" width="60" height="60" style="border-radius:50%;">
              <?php else: ?>
                <img src="../images/default-profile.png" width="60" height="60" style="border-radius:50%;">
              <?php endif; ?>

              <div class="align-self-center ml-2">
                <span class="lead" style="font-size: 1.5rem; font-weight: 400;">
                  <?php
                  echo $row['username'];
                  ?> :
                </span>

                <span>
                  <?php
                  echo $row['comment_content'];
                  ?>
                </span>
              </div>
            </div>
            <hr>
            <?php
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END OF THE CONTAINER -->

<div id="newItemPost" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span style='Color:red;'>&times;</span></button>
        <h4 class="modal-title">Post New Property</h4>
      </div>
      <div class="modal-body">
        <form action="post" method="post" id="property_post" enctype="multipart/form-data">
          <div class="errorMessage">
            <?php
                if(isset($_REQUEST['errorCode']) && $_REQUEST['errorCode']<>""){
                  $displayError = htmlentities($_REQUEST['errorCode']);
                  $error = "<div class='alert alert-danger noprint'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
                  $error .= "<strong>Error Message<br /></strong>{$displayError}</div>";
                  echo $error;
                }
             ?>
          </div>
          <input type="text" name="description" placeholder="Add property description" autocomplete="on" autofocus="true">
          <input type="file" name="profile" />
          <input type="number" name="area" placeholder="Square area of property" min="0" autocomplete="on" />
          <input type="number" name="bath" placeholder="Total bathrooms" min="0" autocomplete="on" />
          <input type="number" name="room" placeholder="Number of rooms" min="0" autocomplete="on" />
          <input type="number" name="bed" placeholder="Number of bedrooms" min="0" autocomplete="on" />
          <input type="number" name="parking" placeholder="Parking slot area" min="0" autocomplete="on" />
          <input type="number" name="cost" placeholder="Price of property" min="0" autocomplete="on" />
          <select class="sel" name = "propertystatus">
              <option value="">--Select property status--</option>
              <?php
              $query =  "select * from propertystatus order by name";
              if($conn->checkQuery($query)){
                $result = $conn->executeQuery($query);
                $count =  $conn->showAffectedRows();
                for($i=0;$i<$count;$i++){
                  $row = mysqli_fetch_array($result);
                  $id = $row['id'];
                  $name =$row['name'];
                  echo  "<option value='{$id}'>{$name}</option><br />";
                }
              }
              ?>
            </select>
            <select class="sel" name="propertytype">
              <option value="">--Select property type--</option>
              <?php
              $query =  "select * from propertytype order by name";
              if($conn->checkQuery($query)){
                $result = $conn->executeQuery($query);
                $count =  $conn->showAffectedRows();
                for($i=0;$i<$count;$i++){
                  $row = mysqli_fetch_array($result);
                  $id = $row['id'];
                  $name =$row['name'];
                  echo  "<option value='{$id}'>{$name}</option><br />";
                }
              }
              ?>
            </select>
            <select class="sel" name="region">
              <option value="">--Select Region--</option>
              <?php
              $query =  "select * from region order by name";
              if($conn->checkQuery($query)){
                $result = $conn->executeQuery($query);
                $count =  $conn->showAffectedRows();
                for($i=0;$i<$count;$i++){
                  $row = mysqli_fetch_array($result);
                  $id = $row['id'];
                  $name =$row['name'];
                  echo  "<option value='{$id}'>{$name}</option><br />";
                }
              }
              ?>
            </select>
            <select class="sel" name="district">
              <option value="">--Select District--</option>
              <?php
              $query =  "select * from district order by name";
              if($conn->checkQuery($query)){
                $result = $conn->executeQuery($query);
                $count =  $conn->showAffectedRows();
                for($i=0;$i<$count;$i++){
                  $row = mysqli_fetch_array($result);
                  $id = $row['id'];
                  $name =$row['name'];
                  echo  "<option value='{$id}'>{$name}</option><br />";
                }
              }
              ?>
            </select>
            <select class="sel" name="city">
              <option value="">--Select City--</option>
              <?php
              $query =  "select * from city order by name";
              if($conn->checkQuery($query)){
                $result = $conn->executeQuery($query);
                $count =  $conn->showAffectedRows();
                for($i=0;$i<$count;$i++){
                  $row = mysqli_fetch_array($result);
                  $id = $row['id'];
                  $name =$row['name'];
                  echo  "<option value='{$id}'>{$name}</option><br />";
                }
              }
              ?>
            </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="submit">Save</button>
        </form>
        <?php 
              if(isset($_REQUEST['submit'])){
                if($displayflag==false){
                  $hash_code =  hash("ripemd128", mt_rand(1000000,9999999));
                  header("Location profile?w_code=0X004F&hash_code=$hash_code");
                }
              $validate =  new sanitizer();
              $displayError_Code = "";
               $hash_code =  hash("ripemd128", mt_rand(1000000,9999999));
               if($validate->validate($_REQUEST['description'])){
                  if($validate->validate($_FILES['profile'])){
                   if($validate->validate($_REQUEST['propertystatus'])){
                    if($validate->validate($_REQUEST['propertytype'])){
                        if($validate->validate($_REQUEST['region'])){
                            if($validate->validate($_REQUEST['region'])){
                                if($validate->validate($_REQUEST['district'])){
                                  if($validate->validate($_REQUEST['city'])){
                                      $city = $validate->sanitize(trim($_REQUEST['city']));
                                      $district = $validate->sanitize(trim($_REQUEST['district']));
                                      $region = $validate->sanitize(trim($_REQUEST['region']));
                                      $description = $validate->sanitize(trim($_REQUEST['description']));
                                      $propertystatus = $validate->sanitize(trim($_REQUEST['propertystatus']));
                                      $propertytype = $validate->sanitize(trim($_REQUEST['propertytype']));
                                      $area = isset($_REQUEST['area'])?$validate->sanitize(trim($_REQUEST['area'])):NULL; 
                                      $bath = isset($_REQUEST['bath'])?$validate->sanitize(trim($_REQUEST['bath'])):NULL; 
                                      $room = isset($_REQUEST['room'])?$validate->sanitize(trim($_REQUEST['room'])):NULL; 
                                      $bed = isset($_REQUEST['bed'])?$validate->sanitize(trim($_REQUEST['bed'])):NULL; 
                                      $parking = isset($_REQUEST['parking'])?$validate->sanitize(trim($_REQUEST['parking'])):NULL; 
                                      $cost = isset($_REQUEST['cost'])?$validate->sanitize(trim($_REQUEST['cost'])):NULL;
                                      //print_r($_REQUEST);
                                      if(isset($_FILES)){ //start of file upload
                                          $result = (estate_property::uploadImage($_FILES));
                                          if(is_array($result)){
                                              $photoSignature = $result[1];
                                              if(estate_property::add_property($description,$railtor_id,$photoSignature,$area,$bath,$room,$bed,$parking,$cost,$propertystatus,$propertytype,$region,$district,$city,$conn->conn)){
                                                  $displaySuccess_Code = "0X00A2";
                                                  sanitizer::location("post?s_code=$displaySuccess_Code&t_token=$hash_code");
                                              }else{
                                                $displayError_Code = "0X00E70";
                                                sanitizer::location("post?e_code=$displayError_Code&t_token=$hash_code");
                                              }
                                                //print_r($result);
                                            }
                                      }
                                    }
                              }
                          }
                        }
                    }
                  }
                 }
               }
             }
        ?>
      </div>
    </div>
  </div>
</div><!--End of modal dialog -->

<div id="profile_edit_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span style='Color:red;'>&times;</span></button>
        <h4 class="modal-title">Edit Profile</h4>
      </div>
      <div class="modal-body">
        <?php
        if(railtor::checkuser($userid,$conn->conn)==false){
          //$
          $result_set = railtor::retrieve_profile_display($userid,$conn->conn);
          if(is_array($result_set)){
            $update_flag = true;
            //print_r($result_set);
          }else{
            $update_flag  = false;
          }
        }else{
          $update_flag = false;
        }

        ?>
        <form action="profile" method="post" id="profile_edit_form" enctype="multipart/form-data">
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
          <input type="text" name="firstName" <?php echo ($update_flag==true)? 'value='.$result_set['firstName'].'':'placeholder="First Name"'; ?> autocomplete="on" autofocus="true">
          <input type="text" name="middleName" <?php echo ($update_flag==true)? 'value='.$result_set['middleName'].'':'placeholder="Middle Name"'; ?> autocomplete="on" />
          <input type="text" name="lastName" <?php echo ($update_flag==true)? 'value='.$result_set['lastName'].'':'placeholder="Last Name"'; ?> autocomplete="on" />
          <input type="tel" name="tel" <?php echo ($update_flag==true)? 'value='.$result_set['tel'].'':'placeholder="Phone Number"'; ?> autocomplete="on">
          <input type="text" name="address" <?php echo ($update_flag==true)? 'value='.$result_set['address'].'':'placeholder="Address"'; ?> autocomplete="on" />
          <?php
            if(!$update_flag==true){
              echo '<input type="file" name="profile" />';
            }
          ?>
          <select class="sel" name="city">
            <option value="">--Select your residential city--</option>
            <?php
            $query =  "select * from city order by name";
            if($conn->checkQuery($query)){
              $result = $conn->executeQuery($query);
              $count =  $conn->showAffectedRows();
              for($i=0;$i<$count;$i++){
                $row = mysqli_fetch_array($result);
                $id = $row['id'];
                $name =$row['name'];
                $selected = isset($result_set['cityID'])?$result_set['cityID']:"";
                if($update_flag==true AND $selected== $id){
                   echo  "<option value='{$selected}' selected>{$name}</option><br />";
                }else{
                   echo  "<option value='{$id}'>{$name}</option><br />";
                }

              }
            }
            ?>
          </select>
          <select class="sel" name="district">
            <option value="">--Select your district--</option>
            <?php
            $query =  "select * from district order by name";
            if($conn->checkQuery($query)){
              $result = $conn->executeQuery($query);
              $count =  $conn->showAffectedRows();
              for($i=0;$i<$count;$i++){
                $row = mysqli_fetch_array($result);
                $id = $row['id'];
                $name =$row['name'];
                $selected = isset($result_set['districtID'])?$result_set['districtID']:"";
                if($update_flag==true AND $selected== $id){
                   echo  "<option value='{$selected}' selected>{$name}</option><br />";
                }else{
                   echo  "<option value='{$id}'>{$name}</option><br />";
                };
              }
            }
            ?>
          </select>
          <select class="sel" name="region">
            <option value="">--Select your Region--</option>
            <?php
            $query =  "select * from region order by name";
            if($conn->checkQuery($query)){
              $result = $conn->executeQuery($query);
              $count =  $conn->showAffectedRows();
              for($i=0;$i<$count;$i++){
                $row = mysqli_fetch_array($result);
                $id = $row['id'];
                $name =$row['name'];
                $selected = isset($result_set['regionID'])?$result_set['regionID']:"";
                if($update_flag==true AND $selected== $id){
                   echo  "<option value='{$selected}' selected>{$name}</option><br />";
                }else{
                   echo  "<option value='{$id}'>{$name}</option><br />";
                }
              }
            }
            ?>
          </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="submit">Save</button>
        </form>
      </div>
      <?php
           if(isset($_REQUEST['submit'])){
              $validate =  new sanitizer();
              $displayError_Code = "";
               $hash_code =  hash("ripemd128", mt_rand(1000000,9999999));
               if($validate->validate($_REQUEST['firstName'])){
                  if($validate->validate($_REQUEST['lastName'])){
                    if($validate->validate($_REQUEST['tel'])){
                        if($validate->validate($_REQUEST['address'])){
                          if($validate->validate($_REQUEST['city'])){
                              if($validate->validate($_REQUEST['district'])){
                                 if($validate->validate($_REQUEST['region'])){
                                  if(railtor::checkuser($userid,$conn->conn)){ //Code block to perform insertion
                                      $tel = $validate->transform($validate->sanitize(trim($_REQUEST['tel'])));
                                      $address = $validate->sanitize(trim($_REQUEST['address']));
                                      $city = $validate->sanitize(trim($_REQUEST['city']));
                                      $district = $validate->sanitize(trim($_REQUEST['district']));
                                      $region = $validate->sanitize(trim($_REQUEST['region']));
                                      $firstName = $validate->sanitize(trim($_REQUEST['firstName']));
                                      $lastName = $validate->sanitize(trim($_REQUEST['lastName']));
                                      $middleName = isset($_REQUEST['middleName'])?$validate->sanitize(trim($_REQUEST['middleName'])):"";
                                       if(isset($_FILES)){ //start of file upload
                                            $result = (railtor::uploadImage($_FILES));
                                            if(is_array($result)){
                                              $photoSignature = $result[1];
                                              if(railtor::add_profile($firstName,$middleName,$lastName,$tel,$address,$userid,$photoSignature,$region,$district,$city,$conn->conn)){
                                                $displaySuccess_Code = "0X00A2";
                                                sanitizer::location("profile?s_code=$displaySuccess_Code&t_token=$hash_code");
                                              }else{
                                                 $displayError_Code = "0X00E49";
                                                sanitizer::location("profile?e_code=$displayError_Code&t_token=$hash_code");
                                              }//End of profile record insert
                                            }
                                        }//End of file upload
                                  }else{ //Code block to perform update
                                     $tel = $validate->transform($validate->sanitize(trim($_REQUEST['tel'])));
                                      $address = $validate->sanitize(trim($_REQUEST['address']));
                                      $city = $validate->sanitize(trim($_REQUEST['city']));
                                      $district = $validate->sanitize(trim($_REQUEST['district']));
                                      $region = $validate->sanitize(trim($_REQUEST['region']));
                                      $firstName = $validate->sanitize(trim($_REQUEST['firstName']));
                                      $lastName = $validate->sanitize(trim($_REQUEST['lastName']));
                                      $middleName = isset($_REQUEST['middleName'])?$validate->sanitize(trim($_REQUEST['middleName'])):"";
                                      if(railtor::update_profile($firstName,$middleName,$lastName,$tel,$address,$region,$district,$city,$userid,$conn->conn)){
                                           $displaySuccess_Code = "0X00A7";
                                          sanitizer::location("profile?s_code=$displaySuccess_Code&t_token=$hash_code");
                                      }else{
                                        $displayError_Code = "0X00EE";
                                        sanitizer::location("profile?e_code=$displayError_Code&t_token=$hash_code");
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
</div><!--End of modal dialog -->

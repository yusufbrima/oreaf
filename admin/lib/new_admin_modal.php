<div id="new_admin_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span style='Color:red;'>&times;</span></button>
        <h4 class="modal-title">Add New System Admin</h4>
      </div>
      <div class="modal-body">
        <form action="setting" method="post" id="new_admin" enctype="multipart/form-data">
          <div class="errorMessage">
          </div>
          <input type="text" name="firstName" placeholder="First Name" autocomplete="on" autofocus="true">
          <input type="text" name="middleName" placeholder="Middle Name" autocomplete="on" />
          <input type="text" name="lastName" placeholder="Last Name" autocomplete="on" />
          <input type="text" name="Email" placeholder="Email id" autocomplete="on">
          <input type="file" name="profile" />
          <input type="text" name="Name" placeholder="Username" autocomplete="on" autofocus="true">
          <input type="password" name="valPassword" placeholder="Password" id="valPassword">
          <input type="password" name="rePassword" placeholder=" Retype Password">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="submit">Save</button>
        </form>
        <?php 
           if(isset($_REQUEST['submit'])){
              $validate =  new sanitizer();
              $displayError_Code = "";
               $hash_code =  hash("ripemd128", mt_rand(1000000,9999999));
               /*$hash_code = strtoupper($hash_code);*/
              if($validate->validate($_REQUEST['firstName'])){
                  if($validate->validate($_REQUEST['lastName'])){
                    if($validate->validate($_REQUEST['Email'])){
                      if($validate->validate($_REQUEST['Name'])){
                          if($validate->validate($_REQUEST['valPassword'])){
                            if($validate->validate($_REQUEST['rePassword'])){
                              if($_REQUEST['valPassword']==$_REQUEST['rePassword']){
                                //print_r($_REQUEST);
                                $username = $validate->transform($validate->sanitize(trim($_REQUEST['Name'])));
                                $email = $validate->sanitize(trim($_REQUEST['Email']));
                                $password = $validate->sanitize(trim($_REQUEST['valPassword']));
                                $firstName = $validate->sanitize(trim($_REQUEST['firstName']));
                                $lastName = $validate->sanitize(trim($_REQUEST['lastName'])); 
                                $middleName = isset($_REQUEST['middleName'])?$validate->sanitize(trim($_REQUEST['middleName'])):""; 
                                if(admin::checkuser($username,$conn->conn)){
                                  if(isset($_FILES)){ //start of file upload
                                   $result = (admin::uploadImage($_FILES));
                                    if(is_array($result)){
                                        $photoSignature = $result[1];
                                         if(admin::add_admin_user($username,$password,$firstName,$middleName,$lastName,$email,$photoSignature,$conn->conn)){
                                            $displayError_Code = "0X00F1";
                                            sanitizer::location("setting?s_code=$displayError_Code&t_token=$hash_code");
                                         }else{
                                          $displayError_Code = "0X00EE";
                                          sanitizer::location("setting?e_code=$displayError_Code&t_token=$hash_code");
                                         }
                                    }else{
                                      $displayError_Code = "0X00E0";
                                      sanitizer::location("setting?e_code=$displayError_Code&t_token=$hash_code");
                                    }
                                  }
                                }else{
                                  $displayError_Code = "0X00E7";
                                  sanitizer::location("setting?e_code=$displayError_Code&t_token=$hash_code");
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

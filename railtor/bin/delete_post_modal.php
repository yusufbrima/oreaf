<div id="postdelete" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span style='Color:red;'>&times;</span></button>
        <h4 class="modal-title">Comfirm Request</h4>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this record?
        <?php 
            if( (isset($_REQUEST['r_id'])&&!empty($_REQUEST['r_id'])) && (isset($_REQUEST['p_id'])&&!empty($_REQUEST['p_id']))){
                $p_id = $sanitizer->sanitize($_REQUEST['p_id']);
                $railtor_id = $sanitizer->sanitize($_REQUEST['r_id']);
                $displayError_Code = "";
                $hash_code =  hash("ripemd128", mt_rand(1000000,9999999));
                if(estate_property::delete_property($railtor_id,$p_id,$conn->conn)){
                    $displaySuccess_Code = "0X00A35";
                    sanitizer::location("post?s_code=$displaySuccess_Code&t_token=$hash_code");
                }else{
                    $displaySuccess_Code = "0X00D43";
                    sanitizer::location("post?e_code=$displaySuccess_Code&t_token=$hash_code");
                }
                //print_r($_REQUEST);
            }
         ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a class="btn btn-danger btn-ok">Ok</a>
      </div>
    </div>
  </div>
</div><!--End of modal dialog -->

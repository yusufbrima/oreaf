<div id="requestdelete" class="modal fade" role="dialog">
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
          if( (isset($_REQUEST['t_id'])&&!empty($_REQUEST['t_id'])) && (isset($_REQUEST['r_id'])&&!empty($_REQUEST['r_id']))){
               $sanitizer = new sanitizer();
               $displayError_Code = "";
               $hash_code =  hash("ripemd128", mt_rand(1000000,9999999));
              $transaction_id = $sanitizer->sanitize($_REQUEST['t_id']);
              $railtor_id = $sanitizer->sanitize($_REQUEST['r_id']);
              if(railtor::delete_request($railtor_id,$transaction_id,$conn->conn)){
                  $displaySuccess_Code = "0X00BC4";
                  sanitizer::location("request?s_code=$displaySuccess_Code&t_token=$hash_code");
              }else{
                  $displaySuccess_Code = "0X00F43";
                   sanitizer::location("request?e_code=$displaySuccess_Code&t_token=$hash_code");
              }
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

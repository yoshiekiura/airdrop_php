<div id="airdropModal" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">              
              <h4 class="modal-title" id="myModalLabel">Modal title</h4>
               <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
            </div>
            <div class="modal-body">
              <form class="form">
		<input type="hidden" name="id" id="id" value="">
		<div class="form-group">
                  <label><input class="checkbox-inline" type="checkbox" value="">Reviewed</label>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Url</label>
                  <a href="asdf"><h5 class="modal-url"></h5></a>
                </div>
                <div class="form-group">
                  <label>Note</label>
                  <p class="modal-note"></p>
                </div>
                <div class="form-group">
                  <label>Reward</label>
                  <input class="form-control modal-score"/>
                </div>
                <div class="form-group">
                  <label>Message</label>
                  <textarea class="form-control modal-message" rows="5"></textarea>
                </div>
              </form>
            </div>
            <div class="modal-footer">
               <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
               <button class="btn btn-primary modal-button" type="button">Save changes</button>
            </div>
         </div>
      </div>
   </div>

    </div>

  </div>
</div>

<script>

function showModal(status, id) {
    var title = {
      "-1" : "Reject submit",
      "1" : "Approve submit"
    };
    var btnTitle = {
      "-1" : "Reject",
      "1" : "Approve"
    };
    $(".modal-title").html(title [status]);
    $(".modal-button").html(btnTitle [status]);
    $("#id").val(id);

    $("#airdropModal").attr("data-id", id);
    $("#airdropModal").attr("data-status", status);



    $.ajax({
      url: "<?=base_url()?>admin/airdrop/getSubmitInfo/" + id,
      method: "get",
      success: function(data) {
        data = $.parseJSON(data);
        $(".modal-url").parent().attr("href", data.url);
        $(".modal-url").html(data.url);

        $(".modal-note").html(data.note);
        $(".modal-score").val(data.score);
        $(".modal-message").val(data.message);
        if(data.checked == "0"){
            $(".checkbox-inline").prop('checked',false);
        }else{
            $(".checkbox-inline").prop('checked',true);
        }

        $("#airdropModal").modal();
      }
    });
}

</script>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete <span class="modal_delete_username"></span></h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete user '<strong><span class="modal_delete_username"></span></strong>' ?</p>
      </div>
      <div class="modal-footer">
        <form method="post">
          <input type="hidden" name="user_id" value="" id="modal_delete_user_id">
          <input type="submit" name="delete_user" value="Delete" class="btn btn-danger">
          <button type="button" class="btn btn-default" data-dismiss="modal"> Close </button>
        </form>
      </div>
    </div>

  </div>
</div>
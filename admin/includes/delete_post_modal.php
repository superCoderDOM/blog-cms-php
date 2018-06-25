<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete Post</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this post?</p>
      </div>
      <div class="modal-footer">
        <form method="post">
          <input type="hidden" name="post_id" value="" id="modal_delete_post_id">
          <input type="hidden" name="author_id" value="" id="modal_delete_author_id">
          <input type="submit" name="delete_post" value="Delete" class="btn btn-danger">
          <button type="button" class="btn btn-default" data-dismiss="modal"> Close </button>
        </form>
      </div>
    </div>

  </div>
</div>
<div class="modal fade" id="{{ $id_modal }}" data-backdrop="static">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <form action="{{ $form_action }}" method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title">{{ $modal_title }}</h5>
        </div>
        <div class="modal-body">
          {{ $slot }}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">{{ $modal_submit }}</button>
        </div>
      </form>
    </div>
  </div>
</div>
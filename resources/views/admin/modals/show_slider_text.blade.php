

<div class="modal-content">
    <div class="modal-header bg-blue">
        <h4 class="modal-title text-white"><i class="fas fa-edit"></i> Photo Text</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>

    <div class="modal-body">	
        <form class="slider_text_form" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label class="font-weight-bold">Title</label>
                <input type="text" name="text" class="form-control" placeholder="Photo Title" value="{{ isset($photo->text) ? $photo->text : '' }}">
            </div>
            <input type="hidden" name="id" value="{{$photo->id}}">
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary submit">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>

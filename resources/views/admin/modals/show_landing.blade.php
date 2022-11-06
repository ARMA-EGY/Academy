

<div class="modal-content">
    <div class="modal-header bg-blue">
        <h4 class="modal-title text-white"><i class="fas fa-cog"></i> Landing Data</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>

    <div class="modal-body">	
        <form class="landing_form" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label >Name</label>
                <input type="text" name="name" class="form-control" placeholder="Page Name" value="{{$landing2->name}}">
            </div>

            <div class="form-group">
                <label >Showcase</label>
                <input type="text" name="showcase" class="form-control" placeholder="Showcase" value="{{$landing2->showcase}}">
            </div>

            <div class="form-group">
                <label >Description</label>
                <textarea type="text" name="description" class="@error('description') is-invalid @enderror form-control" placeholder="Description">{{$landing2->description}}</textarea>
            </div>

            <div class="form-group">
                <label >URL (End-Point)</label>
                <input type="text" name="url" class="form-control" placeholder="URL" value="{{$landing2->url}}">
            </div>

            <input type="hidden" name="id" value="{{$landing2->id}}">

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary submit">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>
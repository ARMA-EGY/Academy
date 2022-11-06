

<div class="modal-content">
    <div class="modal-header bg-blue">
        <h4 class="modal-title text-white"><i class="fa fa-envelope"></i> Recipient Email</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>

    <div class="modal-body">	
        <form class="receiver_email_form">
            @csrf
            <div class="input-group col-12 mb-3 px-0">
                <div class="input-group-prepend">
                <label for="email" class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></label>
                </div>
                <input id="email" class="form-control" type="email" name="email" placeholder="Receiver Email" autocomplete="off" aria-describedby="basic-addon1" @if (isset($email)) value="{{$email->email}}" @endif >
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary submit">{{__('master.SAVE')}}</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('master.CANCEL')}}</button>
            </div>
        </form>
    </div>
</div>
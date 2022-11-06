

	<div class="modal-content">
        <div class="modal-header bg-blue">
            <h4 class="modal-title text-white"><i class="fa fa-envelope"></i> {{__('master.MESSAGE')}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body" id="message_body">	
            <main class="message">
                <div class="details">
                    <div class="title1">Subject: {{$message->subject}}</div>
                    <div class="header"> 
                        <div class="from font-weight-bold">
                            <span>Name: {{$message->name}}</span>From:  {{$message->email}}									
                        </div>
                        <div class="date font-weight-bold">{{  date('j M, Y - h:i A', strtotime($message->created_at))  }}</div>
                    </div>
                    <div class="content">
                        <p> {{$message->message}}</p>
                    </div>
                </div> 
            </main>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('master.CANCEL')}}</button>
        </div>
    </div>
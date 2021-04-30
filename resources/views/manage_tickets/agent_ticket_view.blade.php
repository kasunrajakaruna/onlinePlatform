@if($ticketDetails)
    <input type="hidden" class="form-control" id="ticket_id" name="ticket_id" value="{{$ticketDetails->id}}">
    <div class="col-md-12">
        <div class="form-group">
            <label for="">Reference No</label>
            <input type="text" class="form-control" id="reference_no" name="reference_no" readonly value="{{$ticketDetails->reference_no}}">
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="">Customer Name</label>
            <input type="text" class="form-control" readonly value="{{$ticketDetails->cust_name}}">
        </div>
    </div>
    <br>
    <div class="col-md-12">
        <div class="form-group">
            <label for="">Problem Description</label>
            <textarea class="form-control" readonly>{{$ticketDetails->problem_desc}}</textarea>
        </div>
    </div>
    <br>
    <div class="col-md-12">
        <div class="form-group">
            <label for="">Email</label>
            <input type="text" class="form-control" id="email" name="email" readonly value="{{$ticketDetails->email}}">
        </div>
    </div>
    <br>
    <div class="col-md-12">
        <div class="form-group">
            <label for="">Phone No</label>
            <input type="text" class="form-control" readonly value="{{$ticketDetails->phone_no}}">
        </div>
    </div>
    <br>
    <div class="col-md-12">
        <div class="form-group">
            <label for="tckt_reply">Reply</label> <span style="color:red">*</span>
            <textarea class="form-control" id="tckt_reply" name="tckt_reply" required></textarea>
        </div>
    </div>

    <br>
    <div id="messages" class="col-md-12" styte="color:red">
    </div>

    @if(count($ticketDetails->replies)>0)
        <br>
        <div class="col-md-12">
            <div class="form-group">
                <label>Reply History</label>
            </div>
        </div>
        <hr>

        <?php $n = 0;?>
        @foreach($ticketDetails->replies as $reply)
            <div class="col-md-12">
                <div class="form-group">
                    <label for="desc">Reply {{ ++$n }} - Actioned Date : {{$reply->actioned_date}} <br> {{$reply->reply}}</label>
                </div>
            </div>
            <br>
        @endforeach
    @endif

@endif



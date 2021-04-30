<div class="card-box">
    @if(isset($ticketDetails))
        <h3>Ticket Details </h3>
        <span
            class="label {{ ($ticketDetails->status=='PENDING')?'label-danger':'label-success' }}">{{$ticketDetails->status}}</span>

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
                <input type="text" class="form-control" readonly value="{{$ticketDetails->email}}">
            </div>
        </div>
        <br>
        <div class="col-md-12">
            <div class="form-group">
                <label for="">Phone No</label>
                <input type="text" class="form-control" readonly value="{{$ticketDetails->phone_no}}">
            </div>
        </div>

        @if(count($ticketDetails->replies)>0)
            <div class="col-md-12">
                <div class="form-group">
                    <label>Reply History</label>
                </div>
            </div>

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

    @else
        <h3>Ticket Not Found</h3>
    @endif
</div>

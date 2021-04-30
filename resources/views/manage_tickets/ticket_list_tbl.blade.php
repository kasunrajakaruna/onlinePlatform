<h4 class="header-title m-t-0 m-b-20">Ticket List</h4>

<table class="table table-responsive">
    <thead class="thead-default">
    <tr>
        <th>#</th>
        <th>Ref. No</th>
        <th>Customer Name</th>
        <th>Problem Description</th>
        <th>Email</th>
        <th>Phone No</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php $n = 0;?>
    @foreach($tickets as $ticket)
        <tr id="ticket_{{ $ticket->id }}" style="{{ ($ticket->status=='PENDING')?'background-color: #9dc8e2':'' }}">
            <th scope="row">{{ ++$n }}</th>
            <td>{{ $ticket->reference_no }}</td>
            <td>{{ $ticket->cust_name }}</td>
            <td>{{ $ticket->problem_desc }}</td>
            <td>{{ $ticket->email }}</td>
            <td>{{ $ticket->phone_no }}</td>
            <td id="status_{{ $ticket->id }}">
                <span
                    class="label {{ ($ticket->status=='PENDING')?"label-danger":"label-success" }}"> {{ $ticket->status }}</span>
            </td>
            <td>
                <button class="btn btn-purple edit-item" data-val="{{ $ticket->id }}" data-toggle="modal"
                        data-target="#reply_ticket_modal">{{ ($ticket->status=='PENDING')?"Open":"Reply" }} Ticket
                </button>
            </td>
        </tr>
    @endforeach()
    </tbody>
</table>
<div class="clearfix margin-top-15">
    {{ $tickets->links() }}
</div>

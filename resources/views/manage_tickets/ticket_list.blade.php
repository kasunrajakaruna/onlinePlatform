@extends('template.main_template')

@section('content')

    <div class="card-box">
        <h4 class="header-title m-t-0 m-b-20">Search Ticket</h4>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="cust_name">Reference No</label>
                    <input type="text" class="form-control" id="reference_no" name="reference_no">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="cust_name">Customer Name</label>
                    <input type="text" class="form-control" id="cust_name" name="cust_name">
                </div>
            </div>
            <div class="col-md-3">
                <label></label>
                <button class="btn btn-purple" style="margin-top: 25px" onclick="search_ticket_by_agent()">Search
                </button>
            </div>
        </div>
    </div>

    <div class="row card-box" id="ticket_list">
        @include('manage_tickets.ticket_list_tbl')
    </div>


    <div class="modal fade" id="reply_ticket_modal" tabindex="-1" role="dialog" aria-labelledby="reply ticket modal"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <form id="reply_ticket_form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">Ticket Details</h4>
                    </div>

                    <div class="modal-body">
                        <div class="row" id="agent_ticket_view">


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-purple">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        $(document).ready(function () {

            $('#reply_ticket_form').on('submit', function (event) {
                event.preventDefault();

                var reply_ticket_form = new FormData(this);
                $('.form-group').removeClass('has-error');

                $.ajax({
                    headers: {'X-CSRF-Token': $(this).find('input[name="_token"]').val()},
                    url: '{{ route('save_reply') }}',
                    data: reply_ticket_form,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    success: function (data) {
                        if (data.code !== 200) {
                            var htmldata = '';
                            $.each(data.error, function (index, val) {
                                htmldata += '<span class="error-item" style="color:red">' + val[0] + '</span><br/>';
                            });
                            $('#messages').html(htmldata);
                        } else {
                            $('#reply_ticket_modal').modal('hide');
                            $('#ticket_' + data.ticket_id).css({'background-color': ''});
                            $('#status_' + data.ticket_id).html('<span class="label label-success"> OPENED</span>');
                        }
                    },
                    error: function (error) {
                        alert('error');
                    }
                });

                return false;
            });

        });

        function search_ticket_by_agent() {

            $('#search_results_content').html("");
            var reference_no = $('#reference_no').val();
            var cust_name = $('#cust_name').val();

            $.ajax({
                url: '{{ route('agent_search_ticket') }}',
                data: 'reference_no=' + reference_no + "&cust_name=" + cust_name + "&request_type=AGENT",
                dataType: 'json',
                processData: false,
                contentType: false,
                type: 'GET',
                success: function (data) {
                    $('#ticket_list').html(data.content);
                },
                error: function (error) {
                    alert(error);
                }
            });

            return false;
        };

        $('.edit-item').on('click', function (event) {
            event.preventDefault();
            var id = $(this).attr('data-val');

            $.ajax({
                url: '{{ 'open_ticket' }}',
                data: 'id=' + id,
                dataType: 'json',
                processData: false,
                contentType: false,
                type: 'GET',
                success: function (data) {
                    $('#agent_ticket_view').empty().html(data.message);
                },
                error: function (error) {
                    $('#agent_ticket_view').empty().html('error');
                }
            });
        });
    </script>
@stop

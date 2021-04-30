@extends('template.main_template')

@section('content')

    <div class="card-box">
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-purple pull-right" data-toggle="modal"
                        data-target="#add_user_modal">Add New Agent
                </button>
            </div>
        </div>
    </div>

    <div class="card-box">
        <table class="table">
            <thead class="thead-default">
            <tr>
                <th>#</th>
                <th>Support Agent</th>
                <th>Email</th>
            </tr>
            </thead>
            <tbody>
            <?php $n = 0;?>
            @foreach($users as $user)
                <tr>
                    <th>{{ ++$n }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="add_user_modal" tabindex="-1" role="dialog" aria-labelledby="add user modal"
    aria-hidden="true">
   <div class="modal-dialog" role="document">
       <div class="modal-content">

           <form id="add_user_form" name="add_user_form">
               <input type="hidden" name="_token" value="{{ csrf_token() }}">

               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                   <h4 class="modal-title" id="myModalLabel">New Agent</h4>
               </div>

               <div class="modal-body">
                   <div class="row">

                       <div class="col-md-12">
                           <div class="form-group">
                               <label for="name">Name</label> <span style="color:red">*</span>
                               <input type="text" class="form-control" id="name" name="name" required>
                           </div>
                       </div>
                       <br>
                       <div class="col-md-12">
                           <div class="form-group">
                               <label for="email">Email </label><span style="color:red">*</span>
                               <input type="text" class="form-control" id="email" name="email" required>
                           </div>
                       </div>
                       <br>
                       <div class="col-md-12">
                           <div class="form-group">
                               <label for="password">Password</label><span style="color:red">*</span>
                               <input type="password" class="form-control" id="password" name="password" required>
                           </div>
                       </div>
                       <br>
                       <div id="messages" class="col-md-12" styte="color:red">
                       </div>

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

        $('#add_user_form').on('submit', function (event) {
            event.preventDefault();

            var add_user_form = new FormData(this);
            $('.form-group').removeClass('has-error');

            $.ajax({
                headers: {'X-CSRF-Token': $(this).find('input[name="_token"]').val()},
                url: '{{ route('save_agent') }}',
                data: add_user_form,
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
                        $('#add_user_modal').modal('hide');
                        location.reload();
                    }
                },
                error: function (error) {
                    alert('error');
                }
            });

            return false;
        });

    });

</script>
@stop



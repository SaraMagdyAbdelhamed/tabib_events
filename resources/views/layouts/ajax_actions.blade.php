{{--  Author: Ahmed Yacoub  --}}

{{--  Delete selected  --}}
<script>
    function delete_many(id, url){
        var table = $(id).DataTable();
        var allVals = [];                   // selected IDs
        var token = '{{ csrf_token() }}';

        // push cities IDs selected by user
        $('input.input-in-table:checked').each(function() {
            allVals.push( $(this).closest('tr').data("id") );
        });

        // check if user selected nothing
        if(allVals.length <= 0) {
            confirm('select at least one option!');
        } else {
            var ids = allVals;    // join array of IDs into a single variable to explode in controller

            swal({
                title: "Are you sure you want to delete this record?!",
                text: "You won'\t be able to retrieve this record.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#281160',
                confirmButtonText: 'Yes, delete it!',
                closeOnConfirm: false
                },
            function(isConfirm){
                if(isConfirm) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        dataType: "JSON",
                        data: {
                            "ids": ids,
                            "_method": 'POST',
                            "_token": token,
                        },
                        success: function ()
                        {
                            swal("{{ Session::get('locale') == 'en' ? 'Success' : 'تم بنجاح' }}", '{{ Session::get('success') }}', 'success');
                            table.rows('.selected').remove().draw( false );
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                } else {
                swal("Canceled", "data still exists.", "error");
                }

            });

        }
    }
</script>


{{--  Delete Single  --}}
<script>
    function delete_single(id, url){
        var token = '{{ csrf_token() }}';

        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this record!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#281160',
            confirmButtonText: 'Yes, delete it!',
            closeOnConfirm: false
            },
        function(isConfirm){
            if(isConfirm) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: "JSON",
                    data: {
                        "id": id,
                        "_method": 'POST',
                        "_token": token,
                    },
                    success: function ()
                    {
                        swal("Deleted!", "Deleted Successfully!", "success");
                        $('tr[data-id='+id+']').fadeOut();
                    },
                    error: function(response) {
                        swal('Error', response.msg, 'error');
                    }
                });
            } else {
            swal("Canceled", "data still exists.", "error");
            }

        });
    }
</script>


{{--  View a single data  --}}
<script>
    function view_single(id, url, el) {
        // ajax call
        $.ajax({
            url: url,
            type: 'post',
            data: {
                "id": id,
                "_token": '{{ csrf_token() }}',
            },
            dataType: 'json',
            success: function(response){
                $(el).text(response.data);
            },
            error: function(response) {
                swal('Error', response.msg, 'error');
            }
        });
    }
</script>

{{--  Update a single data  --}}
{{--  els: array of elements id without # symbol  --}}
{{--  element id is supposed to be identical with response key  --}}
<script>
    function set_values(id, url, els) {
        // ajax call
        $.ajax({
            url: url,
            type: 'post',
            data: {
                "id": id,
                "_token": '{{ csrf_token() }}',
            },
            dataType: 'json',
            success: function(response){

                $.each(els, function(key, val){
                    var el   = "#"+val;
                    var type = $(el).prop('tagName');

                    // set id to hidden input
                    $('#hidden_id').val(response.id);
                    $('#loading').text('');

                    if(type == "STRONG")
                        $(el).text(response[val]);

                    if(type == "INPUT")
                        $(el).val(response[val]);

                    if(type == "SELECT")
                        $(el+" option[value='"+response[val]+"']").prop('selected', true);

                    if($(el).prop('tagName') == "IMG") {
                        $(el).attr( 'src',  response[val]);
                    }

                    if($(el).prop('tagName') == "A") {
                        $(el).attr( 'href',  response[val]);
                    }

                });

            },
            error: function(response) {
                swal('Error', response.msg, 'error');
            }
        });

    }
</script>

<script>
    function get_values(url, callback) {
        // ajax call
        $.ajax({
            url: url,
            type: 'post',
            data: {
                "_token": '{{ csrf_token() }}',
            },
            dataType: 'json',
            success: callback,
            error: function(response) {
                swal('Error', response.msg, 'error');
            }
        });
    }
</script>

{{-- renew patient's package --}}
<script>
    function renew_package(id, url) {
        var nextRenewalDate = '{{ \Carbon\Carbon::today()->addDays(28) }}';

        // ajax call
        $.ajax({
            url: url,
            type: 'post',
            data: {
                "id": id,
                "date": nextRenewalDate,
                "_token": '{{ csrf_token() }}',
            },
            dataType: 'json',
            success: function(response){
                swal('Success', response.msg, 'success');
            },
            error: function(response) {
                swal('Error', response.msg, 'error');
            }
        });
    }
</script>
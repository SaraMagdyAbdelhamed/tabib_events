{{-- Author: Ahmed Yacoub                                           --}}
{{-- Email: ahmed.yacoub@outlook.com | ahmed.yacoup@pentavalue.com  --}}

{{-- Start alert messages --}}
<div class="col-lg-12 text-center">

    @if (Session::has('success'))
    {{-- Sweet alert: success --}}
    <script>
        $(document).ready(function(){
            swal("{{ Session::get('locale') == 'en' ? 'Success' : 'تم بنجاح' }}", '{{ Session::get('success') }}', 'success');
        });
    </script>

    @endif

    @if (Session::has('warning'))
        {{-- Sweet alert: warning --}}
        <script>
            $(document).ready(function(){
                swal("{{ Session::get('locale') == 'en' ? 'Warning' : 'تحذير' }}", '{{ Session::get('warning') }}', 'warning');
            });
        </script>
    @endif

    @if (Session::has('error'))
        {{-- Sweet alert: error --}}
        <script>
            $(document).ready(function(){
                swal("{{ Session::get('locale') == 'en' ? 'Error' : 'خطأ' }}", '{{ Session::get('error') }}', 'error');
            });
        </script>
    @endif

    {{-- @if (count($errors->all()) > 0 )
        @foreach ($errors->all() as $error)

        @endforeach
    @endif --}}

</div>
{{-- End alert --}}

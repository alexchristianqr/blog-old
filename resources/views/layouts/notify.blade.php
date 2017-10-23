@if(session()->has('flash_notification.message'))
    @php $color = session('flash_notification.level') @endphp
    <div id="alert-flash">
        <div class="row">
            <div class="alert alert-{{ $color }}" style="position: relative;">
                <p class="h5 text-capitalize">
                    @if($color == 'success')
                        <i class="fa fa-check-circle"></i>
                    @elseif($color == 'danger')
                        <i class="fa fa-remove"></i>
                    @elseif($color == 'info')
                        <i class="fa fa-info-circle"></i>
                    @elseif($color == 'warning')
                        <i class="fa fa-warning"></i>
                    @endif
                    &nbsp;<b>{{ session('flash_notification.message')['title'] }}</b>
                </p>
                <p>{{ session('flash_notification.message')['message'] }}</p>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        setTimeout(function () {document.getElementById('alert-flash').style.display = 'none';}, 60000);
    </script>
@endif

@isset($errors)
    @if(count($errors))
        <div id="alert-error">
            <div class="row">
                <div class="alert alert-danger">
                    <ul style="padding: 0.2em;">
                        @foreach ($errors->all() as $error)
                            <li style="display: block;padding: 0.15em;"><i class="fa fa-times fa-fw" style="vertical-align: text-top;"></i>&nbsp;&nbsp;{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            setTimeout(function () {document.getElementById('alert-error').style.display = 'none';}, 120000);
        </script>
    @endif
@endisset
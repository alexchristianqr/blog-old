@if (session()->has('flash_notification.message'))
    <?php $color = session('flash_notification.level') ?>
    <div id="alert-flash" >
        <div class="row">
            <div class="alert alert-{{ $color }}" style="position: relative;">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <p class="h5 text-uppercase">
                    @if($color == 'success')
                        <i class="fa fa-check-circle to-success"></i>
                    @elseif($color == 'danger')
                        <i class="fa fa-remove to-danger"></i>
                    @elseif($color == 'info')
                        <i class="fa fa-info-circle to-info"></i>
                    @elseif($color == 'warning')
                        <i class="fa fa-warning to-warning"></i>
                    @endif
                    &nbsp;<b>{{ session('flash_notification.message')['title'] }}</b>
                </p>
                <p>{{ session('flash_notification.message')['message'] }}</p>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        setTimeout(function () {document.getElementById('alert-flash').style.display = 'none';}, 5000);
    </script>
@endif

@if (count($errors) > 0)
    <div id="alert-error" >
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
        setTimeout(function () {document.getElementById('alert-error').style.display = 'none';}, 10000);
    </script>
@endif



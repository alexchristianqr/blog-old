@if (session()->has('flash_notification.message'))
    <?php $color = session('flash_notification.level') ?>
    <div id="alertBootstrap" class="container-fluid">
        <div class="row">
                <div class="alert alert-to-{{ $color }}" style="position: relative;color: #fff">
                    <button type="button" class="close color-{{ $color }}" data-dismiss="alert" style="padding: 0;height: 0;border:1px solid #ddd;">&times;</button>
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
                        &nbsp;<b class="to-{{ $color }}">{{ session('flash_notification.message')['title'] }}</b>
                    </p>
                    <p class="to-{{ $color }}">{{ session('flash_notification.message')['message'] }}</p>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        setTimeout(function () {
            document.getElementById('alertBootstrap').style.display = 'none';
        },15000);
    </script>
@endif

@if(isset($errors))
    @foreach($errors->all() as $error)
        <div id="alertError" class="container-fluid">
            <div class="row">
                    <div class="alert alert-to-danger">
                        <span class="close" data-dismiss="alert">&times;</span>
                        <p class="to-danger">{{ $error }}</p>
                    </div>
            </div>
        </div>
        <script type="text/javascript">
            setTimeout(function () {
                document.getElementById('alertError').style.display = 'none';
            },15000);
        </script>
    @endforeach
@endif



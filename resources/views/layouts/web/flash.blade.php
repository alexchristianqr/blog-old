@if (session()->has('flash_notification.message'))
    <?php $color = session('flash_notification.level') ?>
    <div class="container-fluid">
        <div class="alert alert-to-{{ $color }}" style="position: relative;color: #fff">
            <button type="button" class="close color-{{ $color }}" data-dismiss="alert" style="padding: 0;height: 0;">
                ×
            </button>
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
@endif

@if(isset($errors))
    @foreach($errors->all() as $error)
        <div class="container-fluid">
            <div class="alert alert-to-danger">
                <button type="button" class="close color-danger" data-dismiss="alert" style="padding: 0;height: 0;">×
                </button>
                <p class="to-danger">{{ $error }}</p>
            </div>
        </div>
    @endforeach
@endif



<!doctype html>
<html lang="en" style="background-color: #f5f5f5">
<head>
    @include('layouts.cms.top')
</head>
<body style="background-color: #f5f5f5">

<!-- /#wrapper -->
<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <br>
        <!-- /#page-wrapper -->
        @include('layouts.notify')
        @yield('content')

    </div>
</div>

@include('layouts.cms.bottom')

<script>
    $(document).ready(function () {

        var navListItems = $('ul.setup-panel li a'),
            allWells = $('.setup-content');

        allWells.hide();

        navListItems.click(function () {
            event.preventDefault();
            var $target = $($(this).attr('href')),
                $item = $(this).closest('li');
            if (!$item.hasClass('disabled')) {
                navListItems.closest('li').removeClass('active');
                $item.addClass('active');
                allWells.hide();
                $target.show();
            }
        });

        $('ul.setup-panel li.active a').trigger('click');

        // DEMO ONLY //
        $('#activate-step-2').on('click', function () {
            var curStep = $(this).closest(".setup-content"),
                curStepBtn = curStep.attr("id"),
                nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                curInputs = curStep.find("input[type='text'],input[type='password'],input[type='url'],textarea[textarea],select"),
                isValid = true;

            for (var i = 0; i < curInputs.length; i++) {
                if (!curInputs[i].validity.valid) {
                    isValid = false;
                }
            }

            if (isValid) {
                $('ul.setup-panel li:eq(1)').removeClass('disabled');
                $('ul.setup-panel li a[href="#step-2"]').trigger('click');
            } else {
                nextStepWizard.removeAttr('disabled').trigger('click');
            }

        });

        $('#activate-step-3').on('click', function () {
            var curStep = $(this).closest(".setup-content"),
                curStepBtn = curStep.attr("id"),
                nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                curInputs = curStep.find("input[type='text'],input[type='url'],textarea[textarea],select"),
                isValid = true;

            for (var i = 0; i < curInputs.length; i++) {
                if (!curInputs[i].validity.valid) {
                    isValid = false;
                }
            }

            if (isValid) {
                $('ul.setup-panel li:eq(2)').removeClass('disabled');
                $('ul.setup-panel li a[href="#step-3"]').trigger('click');
            } else {
                nextStepWizard.removeAttr('disabled').trigger('click');
            }

        });

    });
</script>

</body>
</html>

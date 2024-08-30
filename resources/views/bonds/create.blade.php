<x-app-layout>
    <x-slot name="title">
        {{ __('Add Bond') }}
    </x-slot>
    <style>
        .blockquote-footer {
            margin-bottom: 0.5rem;
        }
        .blockquote > :last-child {
            font-size: 14px;
        }
        .kbw-signature { width: 100%; height: 200px;}
        #sig canvas{
            width: 100% !important;
            height: auto;
        }
    </style>
    <div class="container">
        <div class="stepwizard">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-1" type="button" class="btn btn-success btn-circle"><i class="circle" aria-hidden="true"></i></a>
                    @if(isRoleSuperAdmin($role))
                        <p>Customer Information</p>
                    @else
                        <p>About You</p>
                    @endif
                </div>
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-2" type="button" class="btn btn-default btn-circle"><i class="circle" aria-hidden="true"></i></a>
                    <p>The Project</p>
                </div>
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-3" type="button" class="btn btn-default btn-circle"><i class="circle" aria-hidden="true"></i></a>
                    <p>Bid Bond</p>
                </div>
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-4" type="button" class="btn btn-default btn-circle"><i class="circle" aria-hidden="true"></i></a>
                    <p>Performance & Payment Bond</p>
                </div>
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-5" type="button" class="btn btn-default btn-circle"><i class="circle" aria-hidden="true"></i></a>
                    <p>Attachments</p>
                </div>
            </div>
        </div>


        <div class="panel panel-primary setup-content" id="step-1">
            <div class="panel-heading">
                <hr style="margin-top: 0;">
                <h6 class="accordion-header mt-0" id="headingFive" style="background-color: #edf7fd;padding:15px">
                    @if(isRoleSuperAdmin($role))
                        <p>Customer Information</p>
                    @else
                        <p>About You</p>
                    @endif
                </h6>
            </div>
          @include('bonds.sections.info')
        </div>
        <div class="panel panel-primary setup-content" id="step-2">
            <div class="panel-heading">
                <hr style="margin-top: 0;">
                <h6 class="accordion-header mt-0" id="headingFive" style="background-color: #edf7fd;padding:15px">
                    <strong>The Project </strong>
                </h6>
            </div>
            @include('bonds.sections.project')
        </div>
        <div class="panel panel-primary setup-content" id="step-3">
            <div class="panel-heading">
                <hr style="margin-top: 0;">
                <h6 class="accordion-header mt-0" id="headingFive" style="background-color: #edf7fd;padding:15px">
                    <strong>Bid Bond </strong>
                </h6>
            </div>
            @include('bonds.sections.bid_bond')
        </div>
        <div class="panel panel-primary setup-content" id="step-4">
            <div class="panel-heading">
                <hr style="margin-top: 0;">
                <h6 class="accordion-header mt-0" id="headingFive" style="background-color: #edf7fd;padding:15px">
                    <strong>Performance & Payment Bond </strong>
                </h6>
            </div>
            @include('bonds.sections.payment_bond')
        </div>
        <div class="panel panel-primary setup-content" id="step-5">
                <div class="panel-heading">
                    <hr style="margin-top: 0;">
                    <h6 class="accordion-header mt-0" id="headingFive" style="background-color: #edf7fd;padding:15px">
                        <strong>Attachments </strong>
                    </h6>
                </div>
                @include('bonds.sections.attachments')
        </div>


    </div>

</x-app-layout>
<script src="{!! asset('assets/js/jquery-ui.min.js') !!}?v=11"></script>
<script>

    // $(document).find('.select2selector').select2();
    $(document).ready(function () {

        MultiStepFormJs(); // Include Multi Step Form Js

    });
    $('body').on("click", ".remove_field", function (e) {
        e.preventDefault();
        $(this).parents('.align-items-center').remove();
        x--;
    });

    function removeErrorDiv() {
        $(this).next('.text-danger').remove();
    }
    $('input, select, textarea').on('input change', removeErrorDiv);
    $('.select2selector').on('change', function() {
        $(this).next('.text-danger').remove();
    });

</script>


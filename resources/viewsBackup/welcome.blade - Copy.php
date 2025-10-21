@extends('layouts.external')

@section('content')
    <div class="stricky-header stricked-menu main-menu">
        <div class="sticky-header__content"></div><!-- /.sticky-header__content -->
    </div><!-- /.stricky-header -->

    <section class="page-header" style="height: 200px; ">
        <div class="page-header__bg" style="background-image: url({{ asset('asset/images/Est.jpg') }}); height: 200px;">
        </div>
        <!-- /.page-header__bg -->
        <div class="container" style="padding-top: 40px;">
            <h2>Corporate Action Calendar for FMDQ Private Markets Limited</h2>
            &nbsp;
            <ul class="thm-breadcrumb list-unstyled">
                {{-- <li><span><a href="{{ url('/') }}">Home</a></span></li> --}}

            </ul><!-- /.thm-breadcrumb list-unstyled -->
        </div><!-- /.container -->
    </section><!-- /.page-header -->



    <section class="about-two pt-120 pb-120">
        <div class="nk-content ">
            <div class="container-fluid">
                <div class="nk-content-inner">
                    <div class="nk-content-body">
                        {{-- <div class="nk-block-head nk-block-head-sm">
                            <div class="nk-block-between">
                                <div class="nk-block-head-content">
                                    <h3 class="nk-block-title page-title">Calendar</h3>
                                </div>

                            </div>
                        </div> --}}
                        <div class="nk-block">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <div id="calendar" class="nk-calendar"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        </div><!-- /.container -->
    </section><!-- /.about-two -->




    <!-- select region modal -->



    <div class="modal fade" id="previewEventPopup">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div id="preview-event-header" class="modal-header">
                    <h5 id="preview-event-title" class="modal-title">Placeholder Title</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>

                <div class="modal-body">
                    <div class="row gy-3 py-1">
                        <img id="event-image" src="" height="400px" alt="Event Image" />

                        <div class="col-sm-6">
                            <h6 class="overline-title">Start Date and Time</h6>
                            <p id="preview-event-start"></p>
                        </div>
                        <div class="col-sm-6" id="preview-event-end-check">
                            <h6 class="overline-title">End Date and Time</h6>
                            <p id="preview-event-end"></p>

                        </div>
                        <div class="col-sm-20" id="preview-event-description-check">
                            <h6 class="overline-title">Description</h6>
                            <p id="modalEventDescription"></p>
                        </div>
                    </div>
                    <ul class="d-flex justify-content-between gx-4 mt-3">
                        <li>
                            <a href="#" id="add-to-google-calendar" target="_blank" class="btn btn-secondary">Add
                                to Google Calendar</a>
                        </li>
                        <li>
                            <a href="#" id="add-to-outlook-calendar" target="_blank" class="btn btn-secondary">Add
                                to Outlook Calendar</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>




    <script>
        function logCalendarSave(calendarType) {
            $.ajax({
                url: "{{ url('log-calendar-save') }}",
                type: "POST",
                data: {
                    calendar_type: calendarType,
                    _token: '{{ csrf_token() }}'
                },


                // $.ajax({
                //     url: '/log-calendar-save',
                //     type: 'POST',
                //     data: {
                //         calendar_type: calendarType,
                //         // Add any other event details you wish to log
                //     },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Laravel CSRF token
                },
                success: function(response) {
                    console.log('Save to calendar event logged successfully.');
                },
                error: function(error) {
                    console.error('Error logging save to calendar event:', error);
                }
            });
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
@endsection

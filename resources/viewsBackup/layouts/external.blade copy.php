<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Corporate Action Calendar for FMDQ Private Markets Limited</title>
    <meta name="description" content="Corporate Action Calendar for FMDQ Private Markets Limited" />



    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('asset/vendors/reey-font/stylesheet.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/vendors/bootstrap/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset/vendors/animate/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset/vendors/fontawesome/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset/vendors/finlon-icons/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset/vendors/jarallax/jarallax.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset/vendors/jquery-magnific-popup/jquery.magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset/vendors/nouislider/nouislider.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset/vendors/nouislider/nouislider.pips.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset/vendors/odometer/odometer.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset/vendors/swiper/swiper.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset/vendors/owl-carousel/assets/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset/vendors/owl-carousel/assets/owl.theme.default.min.css') }}" />
    <link id="skin-default" rel="stylesheet" href="{{ asset('assets/css/style.css') }}">




    <link rel="stylesheet" href="{{ asset('admin/assets/css/dashlite.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('admin/assets/css/theme.css') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">











    {{-- <link rel="stylesheet" href="{{ asset('/admin/assets/css/dashlite.css')}}"> --}}
    {{-- <link  rel="stylesheet" href="{{ asset('/admin/assets/css/theme.css')}}"> --}}

    <link rel="stylesheet" href="{{ asset('asset/css/finlon.css') }}" />
    {{-- <script src="https://kit.fontawesome.com/877261f25c.js" crossorigin="anonymous"></script> --}}
</head>

<body class="custom-cursor">

    <div class="custom-cursor__cursor"></div>
    <div class="custom-cursor__cursor-two"></div>

    {{-- <div class="preloader">
          <div class="preloader__image"></div>
      </div> --}}
    <!-- /.preloader -->
    <div class="page-wrapper">

        <nav class="main-menu main-menu--three">
            <div class="container-fluid">
                <div class="main-menu__logo">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('asset/images/logo.png') }}" width="160" height="autoæ">
                    </a>
                </div><!-- /.main-menu__logo -->
                <div class="main-menu__nav">
                    <ul class="main-menu__list">

                        <li><a href="contact.html">.</a></li>
                    </ul>
                </div><!-- /.main-menu__nav -->

            </div><!-- /.container-fluid -->
        </nav>
        <!-- /.main-menu -->


        @yield('content')



        <div class="bottom-footer">
            <div class="container">
                {{-- <p class="mb-0 text-muted"> Powered By iQx Consult Limited &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>
                </p> --}}
                <p class="bottom-footer__text text-center">Powered by iQx Consult Limited &copy; @php  echo  $currentMonth = date('Y'); @endphp</p>
                <!-- /.bottom-footer__text -->
            </div><!-- /.container -->
        </div><!-- /.bottom-footer -->

    </div><!-- /.page-wrapper -->





    <a href="#" data-target="html" class="scroll-to-target scroll-to-top"><i class="fa fa-angle-up"></i></a>






    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>







    <script src="{{ asset('admin/assets/js/bundle.js') }}"></script>
    <script src="{{ asset('admin/assets/js/scripts.js') }}"></script>
    <script src="{{ asset('admin/assets/js/libs/fullcalendar.js') }}"></script>
    {{-- <script src="{{ asset('admin/assets/js/apps/calendar.js') }}"></script> --}}

    <script>
        "use strict";

        ! function(NioApp, $) {
            "use strict"; // Variable

            var $win = $(window),
                $body = $('body'),
                breaks = NioApp.Break;

            NioApp.Calendar = function() {
                var today = new Date();
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0');
                var yyyy = today.getFullYear();
                var tomorrow = new Date(today);
                tomorrow.setDate(today.getDate() + 1);
                var t_dd = String(tomorrow.getDate()).padStart(2, '0');
                var t_mm = String(tomorrow.getMonth() + 1).padStart(2, '0');
                var t_yyyy = tomorrow.getFullYear();
                var yesterday = new Date(today);
                yesterday.setDate(today.getDate() - 1);
                var y_dd = String(yesterday.getDate()).padStart(2, '0');
                var y_mm = String(yesterday.getMonth() + 1).padStart(2, '0');
                var y_yyyy = yesterday.getFullYear();
                var YM = yyyy + '-' + mm;
                var YESTERDAY = y_yyyy + '-' + y_mm + '-' + y_dd;
                var TODAY = yyyy + '-' + mm + '-' + dd;
                var TOMORROW = t_yyyy + '-' + t_mm + '-' + t_dd;
                var month = ["January", "February", "March", "April", "May", "June", "July", "August", "September",
                    "October", "November", "December"
                ];
                var calendarEl = document.getElementById('calendar');
                var eventsEl = document.getElementById('externalEvents');
                var removeEvent = document.getElementById('removeEvent');
                var addEventBtn = $('#addEvent');
                var addEventForm = $('#addEventForm');
                var addEventPopup = $('#addEventPopup');
                var updateEventBtn = $('#updateEvent');
                var editEventForm = $('#editEventForm');
                var editEventPopup = $('#editEventPopup');
                var previewEventPopup = $('#previewEventPopup');
                var deleteEventBtn = $('#deleteEvent');
                var mobileView = NioApp.Win.width < NioApp.Break.md ? true : false;
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    timeZone: 'UTC',
                    initialView: mobileView ? 'listWeek' : 'dayGridMonth',
                    themeSystem: 'bootstrap',
                    headerToolbar: {
                        left: 'title prev,next',
                        center: null,
                        right: 'today dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                    },
                    height: 800,
                    contentHeight: 780,
                    aspectRatio: 3,
                    editable: true,
                    droppable: true,
                    views: {
                        dayGridMonth: {
                            dayMaxEventRows: 2
                        }
                    },
                    direction: NioApp.State.isRTL ? "rtl" : "ltr",
                    nowIndicator: true,
                    now: TODAY + 'T09:25:00',
                    eventDragStart: function eventDragStart(info) {
                        $('.popover').popover('hide');
                    },
                    eventMouseEnter: function eventMouseEnter(info) {
                        $(info.el).popover({
                            template: '<div class="popover"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>',
                            title: info.event._def.title,
                            content: info.event._def.extendedProps.description,
                            placement: 'top'
                        });
                        info.event._def.extendedProps.description ? $(info.el).popover('show') : $(info.el)
                            .popover('hide');
                    },
                    eventMouseLeave: function eventMouseLeave(info) {
                        $(info.el).popover('hide');
                    },
                    eventClick: function eventClick(info) {
                        // Get data
                        var title = info.event._def.title;
                        var description = info.event._def.extendedProps.description;
                        var start = info.event._instance.range.start;
                        var startDate = start.getFullYear() + '-' + String(start.getMonth() + 1).padStart(2,
                            '0') + '-' + String(start.getDate()).padStart(2, '0');
                        var startTime = start.toUTCString().split(' ');
                        startTime = startTime[startTime.length - 2];
                        startTime = startTime == '00:00:00' ? '' : startTime;
                        var end = info.event._instance.range.end;
                        var endDate = end.getFullYear() + '-' + String(end.getMonth() + 1).padStart(2,
                            '0') + '-' + String(end.getDate()).padStart(2, '0');
                        var endTime = end.toUTCString().split(' ');
                        endTime = endTime[endTime.length - 2];
                        endTime = endTime == '00:00:00' ? '' : endTime;

                        var className = info.event._def.ui.classNames[0].slice(3);

                        var eventId = info.event._def.publicId; //Set data in eidt form

                        $('#edit-event-title').val(title);
                        $('#edit-event-start-date').val(startDate).datepicker('update');
                        $('#edit-event-end-date').val(endDate).datepicker('update');
                        $('#edit-event-start-time').val(startTime);
                        $('#edit-event-end-time').val(endTime);
                        $('#edit-event-description').val(description);
                        $('#edit-event-theme').val(className);
                        $('#edit-event-theme').trigger('change.select2');
                        editEventForm.attr('data-id', eventId); // Set data in preview

                        var previewStart = String(start.getDate()).padStart(2, '0') + ' ' + month[start
                            .getMonth()] + ' ' + start.getFullYear() + (startTime ? ' - ' + to12(
                            startTime) : '');
                        var previewEnd = String(end.getDate()).padStart(2, '0') + ' ' + month[end
                            .getMonth()] + ' ' + end.getFullYear() + (endTime ? ' - ' + to12(endTime) :
                            '');
                        $('#preview-event-title').text(title);
                        $('#preview-event-header').addClass('fc-' + className);
                        $('#preview-event-start').text(previewStart);
                        $('#preview-event-end').text(previewEnd);
                        $('#preview-event-description').text(description);
                        !description ? $('#preview-event-description-check').css('display', 'none') : null;
                        previewEventPopup.modal('show');
                        $('.popover').popover('hide');
                    },
                    events: function(fetchInfo, successCallback, failureCallback) {
                        fetch('/com_cal/api/events')
                            .then(response => response.json())
                            .then(events => {
                                successCallback(events.map(event => ({
                                    id: event.id,
                                    title: event.event_title_code,
                                    start: event.start_date,
                                    end: event.end_date,
                                    start_time: event.start_time,
                                    end_time: event.end_time,
                                    className: `fc-event-${event.category_color}`,
                                    description: event.event_description,
                                    image: `/com_cal/${event.event_image}`,
                                    // Add a property for Google Calendar URL
                                    googleCalendarUrl: createGoogleCalendarUrl(event),
                                    outlookCalendarUrl: createOutlookCalendarUrl(event)
                                })));
                            })
                            .catch(error => failureCallback(error));
                    },

                    eventClick: function(info) {
                        // Prevent the default action
                        info.jsEvent.preventDefault();

                        // Set the modal content based on the event clicked
                        setModalContent(info.event);

                        // Show the modal
                        $('#previewEventPopup').modal('show');
                    }

                });
                calendar.render(); //Add event

                function convertTo12HourFormat(time) {
                    const [hour, minute] = time.split(':'); // Split the time into hour and minute
                    const hourInt = parseInt(hour, 10); // Convert the hour to an integer
                    const ampm = hourInt >= 12 ? 'PM' : 'AM';
                    const convertedHour = hourInt % 12 ||
                        12; // Convert 0 or 24 to 12 for 12AM, adjust others accordingly

                    return `${convertedHour}:${minute} ${ampm}`;
                }



                function setModalContent(event) {
                    // Example: Set the event title, description, etc. in the modal
                    $('#preview-event-title').text(event.title);

                    // Convert start_time and end_time to 12-hour format
                    const formattedStartTime = convertTo12HourFormat(event.extendedProps.start_time);
                    const formattedEndTime = convertTo12HourFormat(event.extendedProps.end_time);

                    // Combine the date and formatted time for start and end
                    var startDateTime = `${event.start.toDateString()} ${formattedStartTime}`;
                    var endDateTime = `${event.end.toDateString()} ${formattedEndTime}`;

                    $('#event-image').attr('src', event.extendedProps.image);

                    // Update the modal content with these combined date and time values
                    $('#preview-event-start').text(startDateTime); // Example formatting
                    $('#preview-event-end').text(endDateTime); // Example formatting

                    // Continue setting other properties as before
                    $('#modalEventDescription').text(event.extendedProps.description);
                    $('#add-to-google-calendar').attr('href', event.extendedProps.googleCalendarUrl);
                    $('#add-to-outlook-calendar').attr('href', event.extendedProps.outlookCalendarUrl);
                }




                function createGoogleCalendarUrl(event) {
                    // Adjust this function to match how your event object is structured
                    const baseUrl = 'https://calendar.google.com/calendar/render?action=TEMPLATE';
                    const text = `&text=${encodeURIComponent(event.event_title_code)}`;
                    // Format dates for Google Calendar (you might need to adjust date formatting)
                    const start = (new Date(event.start_date)).toISOString().replace(/-|:|\.\d\d\d/g, '');
                    const end = (new Date(event.end_date)).toISOString().replace(/-|:|\.\d\d\d/g, '');
                    const dates = `&dates=${start}/${end}`;
                    const details = `&details=${encodeURIComponent(event.event_description)}`;
                    const location =
                        `&location=${encodeURIComponent(event.location || '')}`; // Assuming `location` is a property of your event

                    return `${baseUrl}${text}${dates}${details}${location}`;
                }



                function createOutlookCalendarUrl(event) {
                    const baseUrl = 'https://outlook.live.com/owa/?path=/calendar/action/compose&rru=addevent';
                    const start = new Date(event.start_date).toISOString();
                    const end = new Date(event.end_date).toISOString();
                    const subject = `&subject=${encodeURIComponent(event.event_title_code)}`;
                    const body = `&body=${encodeURIComponent(event.event_description)}`;
                    const location = `&location=${encodeURIComponent(event.location || '')}`;
                    const startdt = `&startdt=${start}`;
                    const enddt = `&enddt=${end}`;

                    return `${baseUrl}${subject}${body}${location}${startdt}${enddt}`;
                }


                function to12(time) {
                    time = time.toString().match(/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];

                    if (time.length > 1) {
                        time = time.slice(1);
                        time.pop();
                        time[5] = +time[0] < 12 ? ' AM' : ' PM'; // Set AM/PM

                        time[0] = +time[0] % 12 || 12;
                    }

                    time = time.join('');
                    return time;
                }

                function customCalSelect(cat) {
                    if (!cat.id) {
                        return cat.text;
                    }

                    var $cat = $('<span class="fc-' + cat.element.value + '"> <span class="dot"></span>' + cat.text +
                        '</span>');
                    return $cat;
                }

                ;
                NioApp.Select2('.select-calendar-theme', {
                    templateResult: customCalSelect
                });
                addEventPopup.on('hidden.bs.modal', function(e) {
                    setTimeout(function() {
                        $('#addEventForm input,#addEventForm textarea').val('');
                        $('#event-theme').val('event-primary');
                        $('#event-theme').trigger('change.select2');
                    }, 1000);
                });
                previewEventPopup.on('hidden.bs.modal', function(e) {
                    $('#preview-event-header').removeClass().addClass('modal-header');
                });
            };

            NioApp.coms.docReady.push(NioApp.Calendar);
        }(NioApp, jQuery);
    </script>
</body>



</html>

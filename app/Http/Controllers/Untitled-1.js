<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('landing_assets/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/dashlite.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('admin/assets/css/theme.css') }}">
    <title>Corporate Action Calendar</title>

</head>

<body>
    <header class="navigation-header">

        <nav>
            <div class="logo-container">
                <a href="{{ url('/') }}"><img src="{{ asset('landing_assets/FMDQ-Logo.png') }}"
                        alt="Company logo" /></a>
            </div>


            {{-- <div class="navigation-items" id="navigation-items">
                <a href="">About</a>
                <a href="">Website</a>
                <a href="">Contact Me</a>
            </div> --}}
            <div class="hamburger">
                <span id="openHam">&#9776;</span>
                <span id="closeHam">&#x2716;</span>
            </div>
        </nav>
    </header>




    @yield('content')






    <footer class="footer">
        <div class="footer-gap">

            {{-- <table style="border: 3px solid #000; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th scope="col" style="border: 1px solid #000; background-color: #F8070B; color: white;">
                            Coupon Payment
                        </th>
                        <th scope="col" style="border: 3px solid #000; background-color: #1d326c; color: white;">
                            Regulatory Filings</th>
                        <th scope="col" style="border: 3px solid #000; background-color: #F5730E; color: white;">
                            Programmes and Events</th>
                        <th scope="col" style="border: 3px solid #000; background-color: #1a9b05; color: white;">
                            Rental Paymentt</th>
                        <th scope="col" style="border: 3px solid #000; background-color: #7149f3; color: white;">
                            Sukuk Maturity</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th style="border: 3px solid #000;">CPN</th>
                        <td style="border: 3px solid #000;">RGF</td>
                        <td style="border: 3px solid #000;">PGE</td>
                        <td style="border: 3px solid #000;">REP</td>
                        <td style="border: 3px solid #000;">SUM</td>
                    </tr>
                </tbody>
            </table> --}}
            {{-- <p>Stay Connected with us on Social Media</p>
            <div class="socials">
                <img src="{{ asset('landing_assets/Linkedin.png') }}" alt="LinkedIn">
                <img src="{{ asset('landing_assets/Twitter.png') }}" alt="twitter">
                <img src="{{ asset('landing_assets/Instagram.png') }}" alt="instagram">
                <img src="{{ asset('landing_assets/Facebook.png') }}" alt="facebook">
            </div> --}}
        </div>
        <div class="arr">
            <p>Powered by <img src="{{ asset('landing_assets/FMDQ-Lines.png') }}" alt="Lines"><span>iQx
                    Consult</span></p>
            <p>Copyright © FMDQGROUP. All rights reserved.</p>
        </div>
    </footer>

















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

                function addExtraDayToDate(date) {
                    let newDate = new Date(date);
                    newDate.setDate(newDate.getDate() + 1);
                    return newDate.toISOString().slice(0, 10); // Format the date as YYYY-MM-DD
                }


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
                    themeSystem: '',
                    headerToolbar: {
                        left: 'prevYear,prev,next,nextYear today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                    },
                    customButtons: {
                        prevYear: {
                            text: 'Prev Year',
                            click: function() {
                                var date = calendar.getDate();
                                calendar.gotoDate(new Date(date.getFullYear() - 1, date.getMonth(), date
                                    .getDate()));
                            }
                        },
                        nextYear: {
                            text: 'Next Year',
                            click: function() {
                                var date = calendar.getDate();
                                calendar.gotoDate(new Date(date.getFullYear() + 1, date.getMonth(), date
                                    .getDate()));
                            }
                        }
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
                    eventDragStart: function(info) {
                        $('.popover').popover('hide');
                    },
                    eventMouseEnter: function(info) {
                        $(info.el).popover({
                            template: '<div class="popover"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>',
                            title: info.event._def.title,
                            content: info.event._def.extendedProps.description,
                            placement: 'top'
                        });
                        info.event._def.extendedProps.description ? $(info.el).popover('show') : $(info.el)
                            .popover('hide');
                    },
                    eventMouseLeave: function(info) {
                        $(info.el).popover('hide');
                    },
                    eventClick: function(info) {
                        info.jsEvent.preventDefault(); // Prevent the default action

                        // Set the modal content based on the event clicked
                        setModalContent(info.event);

                        // Show the modal
                        $('#previewEventPopup').modal('show');
                    },
                    events: function(fetchInfo, successCallback, failureCallback) {

                        var category = document.getElementById('categorySelector').value;
                        var url = '/com_cal/api/events';

                        if (category !== 'all') {
                            url +=
                                `?category=${category}`; // Assuming the server can handle a category filter
                        }

                        fetch(url)
                            .then(response => response.json())
                            .then(events => {
                                successCallback(events.map(event => {
                                    const eventColor = event.category_color;
                                    const eventClassName = `fm-color-${event.id}`;

                                    // Dynamically create a style element
                                    const style = document.createElement('style');
                                    style.type = 'text/css';
                                    style.innerHTML = `
                                    .${eventClassName} {
                                        background-color: ${eventColor} !important;
                                        border-color: ${eventColor} !important;
                                        color: #fff !important;
                                    }
                                `;
                                    document.getElementsByTagName('head')[0].appendChild(
                                        style);

                                    return {
                                        id: event.id,
                                        title: event.event_title_code,
                                        start: event.start_date,
                                        end: addExtraDayToDate(event
                                            .end_date), // Add one day to the end date

                                        start_time: event.start_time,
                                        end_time: event.end_time,
                                        venue: event.venue, // New field
                                        issuer: event.issuer, // New field
                                        category_name: event.category_name, // New field
                                        issuerDescription: event
                                            .issuer_description, // New field
                                        className: eventClassName, // Use the dynamically created class
                                        description: event.event_description,
                                        image: `/com_cal/public/${event.event_image}`,
                                        googleCalendarUrl: createGoogleCalendarUrl(event),
                                        outlookCalendarUrl: createOutlookCalendarUrl(event),
                                        original_end: event.end_date
                                        // other event properties
                                    };
                                }));
                            })
                            .catch(error => {
                                console.error('Failed to fetch events:', error);
                                failureCallback(error);
                            });




                        function setupCategorySelector() {
                            const selector = document.getElementById('categorySelector');
                            if (selector && !selector.getAttribute('data-initialized')) {
                                selector.addEventListener('change', debounce(function() {
                                    const selectedCategory = selector.value;
                                    if (selectedCategory === 'all') {
                                        calendar.refetchEvents(); // Fetch all events
                                    } else {
                                        calendar.refetchEvents({
                                            category: selectedCategory
                                        }); // Fetch events for the selected category
                                    }
                                }, 300)); // Debounce for 300 milliseconds

                                selector.setAttribute('data-initialized', 'true');
                            }
                        }

                        function fetchCategories() {
                            fetch('/com_cal/api/categories')
                                .then(response => response.json())
                                .then(categories => {
                                    const selector = document.getElementById('categorySelector');
                                    if (selector) {
                                        const currentSelectedValue = selector.value;

                                        while (selector.options.length > 1) {
                                            selector.remove(1);
                                        }

                                        categories.forEach(category => {
                                            const option = document.createElement('option');
                                            option.value = category.id;
                                            option.textContent = category.name;
                                            selector.appendChild(option);
                                        });

                                        // Re-select the previously selected value if it still exists
                                        if (Array.from(selector.options).some(option => option.value ===
                                                currentSelectedValue)) {
                                            selector.value = currentSelectedValue;
                                        } else {
                                            selector.value =
                                                'all'; // Default to 'all' if the previously selected value no longer exists
                                        }

                                        setupCategorySelector
                                            (); // Ensure event listener is properly managed
                                    }
                                })
                                .catch(error => console.error('Error fetching categories:', error));
                        }

                        fetchCategories();

                        // Debounce function implementation
                        function debounce(func, delay) {
                            let debounceTimer;
                            return function() {
                                const context = this;
                                const args = arguments;
                                clearTimeout(debounceTimer);
                                debounceTimer = setTimeout(() => func.apply(context, args), delay);
                            };
                        }
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
                    console.log(event);
                    // Example: Set the event title, description, etc. in the modal
                    $('#preview-event-title').text(event.title);

                    $('#preview-event-venue').text(event.extendedProps.venue);
                    $('#preview-event-issuer').text(event.extendedProps.issuer);
                    $('#preview-event-issuerDescription').text(event.extendedProps.issuerDescription);
                    $('#preview-event-category_name').text(event.extendedProps.category_name);

                    // Convert start_time and end_time to 12-hour format
                    const formattedStartTime = convertTo12HourFormat(event.extendedProps.start_time);
                    const formattedEndTime = convertTo12HourFormat(event.extendedProps.end_time);

                    // Combine the date and formatted time for start and end
                    var startDateTime = `${event.start.toDateString()} ${formattedStartTime}`;
                    var endDateTime =
                    `${new Date(event.extendedProps.original_end).toDateString()} ${formattedEndTime}`;


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
                    const formatDateTime = (date, time) => {
                        const [hours, minutes] = time.split(':');
                        const dateTime = new Date(date);
                        dateTime.setHours(hours, minutes, 0); // Assuming time is in HH:MM format
                        return dateTime.toISOString().replace(/-|:|\.\d\d\d/g, '');
                    };

                    const baseUrl = 'https://calendar.google.com/calendar/render?action=TEMPLATE';
                    const text = `&text=${encodeURIComponent(event.event_title_code)}`;
                    const startDateTime = formatDateTime(event.start_date, event.start_time);
                    const endDateTime = formatDateTime(event.end_date, event.end_time);
                    const dates = `&dates=${startDateTime}/${endDateTime}`;
                    const details = `&details=${encodeURIComponent(event.event_description)}`;
                    const location = `&location=${encodeURIComponent(event.venue || '')}`;

                    return `${baseUrl}${text}${dates}${details}${location}`;
                }





                function createOutlookCalendarUrl(event) {
                    const formatDateTimeISO = (date, time) => {
                        const [hours, minutes] = time.split(':');
                        const dateTime = new Date(date);
                        dateTime.setHours(hours, minutes, 0); // Assuming time is in HH:MM format
                        return dateTime.toISOString();
                    };

                    const baseUrl = 'https://outlook.live.com/owa/?path=/calendar/action/compose&rru=addevent';
                    const subject = `&subject=${encodeURIComponent(event.event_title_code)}`;
                    const body = `&body=${encodeURIComponent(event.event_description)}`;
                    const location = `&location=${encodeURIComponent(event.venue || '')}`;
                    const startdt = `&startdt=${formatDateTimeISO(event.start_date, event.start_time)}`;
                    const enddt = `&enddt=${formatDateTimeISO(event.end_date, event.end_time)}`;

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
    <script>
        let openHam = document.querySelector("#openHam");
        let closeHam = document.querySelector("#closeHam");
        let navigationItems = document.querySelector("#navigation-items");

        const hamburgerEvent = (navigation, close, open) => {
            navigationItems.style.display = navigation;
            closeHam.style.display = close;
            openHam.style.display = open;
        };

        openHam.addEventListener("click", () =>
            hamburgerEvent("flex", "block", "none")

        );
        closeHam.addEventListener("click", () =>
            hamburgerEvent("none", "none", "block")
        );
    </script>
</body>



</html>

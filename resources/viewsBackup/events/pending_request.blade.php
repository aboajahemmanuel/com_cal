@extends('layouts.admin')

@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Pending Changes</h3>
                                <div class="nk-block-des text-soft">

                                </div>
                            </div><!-- .nk-block-head-content -->
                          
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block nk-block-lg">
                       
                        <div class="card card-preview">
                            <div class="card-inner">
                                 <div  id="view-{{ $pending_event->id }}">
                                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">{{ $pending_event->event_title_code }}
                                                            </h5>
                                                           
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST"
                                                                action="{{ route('editEvent', $pending_event->event_id) }}"
                                                                class="form-validate is-alter"
                                                                enctype="multipart/form-data">
                                                                @csrf

                                                                <div class="row gx-4 gy-3">
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label class="form-label"
                                                                                for="event-title">Event Title
                                                                                Code <span
                                                                                    style="color: red">*</span></label>
                                                                            <div class="form-control-wrap">
                                                                                <input disabled type="text"
                                                                                    name="event_title_code"
                                                                                    class="form-control" id="event-title"
                                                                                    required
                                                                                    value="{{ $pending_event->event_title_code }}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Start Date <span
                                                                                    style="color: red">*</span></label>
                                                                            <div class="row gx-2">
                                                                                <div class="w-55">
                                                                                    <div class="form-control-wrap">
                                                                                        <div
                                                                                            class="form-icon form-icon-left">
                                                                                            <em
                                                                                                class="icon ni ni-calendar"></em>
                                                                                        </div>
                                                                                        <input disabled type="text"
                                                                                            id="event-start-date"
                                                                                            class="form-control date-picker"
                                                                                            name="start_date"
                                                                                            data-date-format="yyyy-mm-dd"
                                                                                            required
                                                                                            value="{{ $pending_event->start_date }}">



                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <label class="form-label"
                                                                                    for="event-description">Event
                                                                                    Description</label>
                                                                                <div class="form-control-wrap">
                                                                                    <textarea disabled class="form-control" name="event_description" id="event-description" required>{{ $pending_event->event_description }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Event
                                                                                    Category <span
                                                                                        style="color: red">*</span></label>
                                                                                <div class="form-control-wrap">

                                                                                    <select disabled name="category_id"
                                                                                        id="Category-dropdown-Edit-{{ $pending_event->id }}"
                                                                                        class="form-control" required>

                                                                                        @foreach ($categories as $category)
                                                                                            <option
                                                                                                value="{{ $category->id }}"
                                                                                                @if ($category->id == $pending_event->category_id) selected @endif>
                                                                                                {{ $category->name }}
                                                                                            </option>
                                                                                        @endforeach


                                                                                    </select>

                                                                                    <select hidden class="form-control"
                                                                                        name="category_name"
                                                                                        id="CategoryName-dropdown-Edit-{{ $pending_event->id }}"
                                                                                        required>
                                                                                        <option
                                                                                            value="{{ $pending_event->category_name }}">
                                                                                            {{ $pending_event->category_name }}
                                                                                        </option>

                                                                                    </select>

                                                                                    <select hidden class="form-control"
                                                                                        name="category_color"
                                                                                        id="CategoryColor-dropdown-Edit-{{ $pending_event->id }}"
                                                                                        required>
                                                                                        <option
                                                                                            value="{{ $pending_event->category_color }}">
                                                                                            {{ $pending_event->category_color }}
                                                                                        </option>

                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-6">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Venue</label>
                                                                                <div class="form-control-wrap">

                                                                                    <input disabled type="text"
                                                                                        value="{{ $pending_event->venue }}"
                                                                                        name="venue"
                                                                                        class="form-control" required>
                                                                                </div>
                                                                            </div>
                                                                        </div>






                                                                        <div class="col-6">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Issuer <span
                                                                                        style="color: red">*</span></label>
                                                                                <div class="form-control-wrap">

                                                                                    <input disabled type="text"
                                                                                        value="{{ $pending_event->issuer }}"
                                                                                        name="issuer"
                                                                                        class="form-control" required>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <label class="form-label"
                                                                                    for="">Issue
                                                                                    Description</label>
                                                                                <div class="form-control-wrap">
                                                                                    <textarea disabled class="form-control" name="issuer_description" id="issuer_description" required>{{ $pending_event->issuer_description }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>



                                                                    
                                                                    </div>
                                                            </form>
                                                             <div class="col-12">
                                <ul class="d-flex justify-content-between  mt-1">
                                    <li>
                                         <form 
                                                                                        action="{{ route('EventStatus', $pending_event->event_id) }}"
                                                                                        method="POST"  id="eventForm" >
                                                                                        @csrf
                                                                                        <input hidden name="status" value="1">
                                                                                         {{-- <button
                                                                                                    class="btn btn-lg btn-primary btn-block"
                                                                                                    id="approveSubmitBtn-{{ $pending_event->id }}"
                                                                                                    type="submit">
                                                                                                    <i class="fas fa-spinner fa-spin"
                                                                                                        style="display:none;"></i>
                                                                                                    <span
                                                                                                        class="btn-text">Submit</span>
                                                                                                </button> --}}


                                                                                         <button id="saveButton" type="submit" class="btn fmdq_Gold">Approve</button>
                                        {{-- <button id="saveButton" type="submit" class="btn fmdq_Gold">Approve</button> --}}
                                    </form>
                                    </li>
                                    <li>
                                        {{-- <button id="resetEvent"  data-toggle="modal"
                                        data-target="#reject-{{ $pending_event->id }}"
                                            class="btn fmdq_Blue">Reject</button> --}}

                                            <button  data-toggle="modal" class="btn fmdq_Blue" type="button"
                                                                                            data-target="#reject-{{ $pending_event->id }}">Reject</button>
                                    </li>
                                </ul>
                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                </div><!-- .modal-dialog -->

                                            </div>
                            </div>
                        </div><!-- .card-preview -->
                    </div> <!-- nk-block -->
                </div>
            </div>
        </div>
    </div>


                                                        <div class="modal fade" role="dialog"
                                                        id="reject-{{ $pending_event->id }}">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg"
                                                            role="document">
                                                            <div class="modal-content">
                                                                <a href="#" class="close" data-dismiss="modal"><em
                                                                        class="icon ni ni-cross-sm"></em></a>
                                                                <div class="modal-body modal-body-md">
                                                                    <h5 class="title">{{ $pending_event->event_title_code }}</h5>
                                                                    <form method="POST"
                                                                        action="{{ route('EventStatus', $pending_event->event_id) }}"
                                                                        id="rejectForm-{{ $pending_event->id }}">
                                                                        @csrf
                                                                        <div class="tab-content">
                                                                            <div class="tab-pane active" id="infomation">
                                                                                <div class="row gy-4">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">

                                                                                            <label>Rejection Note</label>
                                                                                            <input hidden name="status"
                                                                                                value="2">
                                                                                            <textarea required class="form-control" name="note"></textarea>


                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-12">
                                                                                        <ul
                                                                                            class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                                                                            <li>
                                                                                                {{-- <button type="submit"
                                                                                                    class="btn btn-primary">Submit</button> --}}
                                                                                                <button
                                                                                                    class="btn btn-lg btn-primary btn-block"
                                                                                                    id="rejectSubmitBtn-{{ $pending_event->id }}"
                                                                                                    type="submit">
                                                                                                    <i class="fas fa-spinner fa-spin"
                                                                                                        style="display:none;"></i>
                                                                                                    <span
                                                                                                        class="btn-text">Submit</span>
                                                                                                </button>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                            </div><!-- .tab-pane -->

                                                                        </div><!-- .tab-content -->

                                                                        <script>
                                                                            function loading(buttonId) {
                                                                                $("#" + buttonId + " .fa-spinner").show();
                                                                                $("#" + buttonId + " .btn-text").html("Processing...");
                                                                            }

                                                                            document.addEventListener('DOMContentLoaded', function() {
                                                                                document.getElementById('rejectForm-{{ $pending_event->id }}').addEventListener('submit', function(event) {
                                                                                    if (this.checkValidity() === false) {
                                                                                        event.preventDefault();
                                                                                        event.stopPropagation();
                                                                                    } else {
                                                                                        loading('rejectSubmitBtn-{{ $pending_event->id }}');
                                                                                        document.getElementById('rejectSubmitBtn-{{ $pending_event->id }}').disabled = true;
                                                                                    }
                                                                                    this.classList.add('was-validated');
                                                                                }, false);
                                                                            });
                                                                        </script>
                                                                    </form>
                                                                </div><!-- .modal-body -->
                                                            </div><!-- .modal-content -->
                                                        </div><!-- .modal-dialog -->
                                                    </div><!-- .modal -->




                                                                   <script>
                                                                      document.getElementById('eventForm').addEventListener('submit', function(event) {
                                                                const form = event.target;

                                                                // Check if form is valid
                                                                if (form.checkValidity()) {
                                                                    const saveButton = document.getElementById('saveButton');
                                                                    saveButton.disabled = true; // Disable the button
                                                                    saveButton.innerText = 'Processing...'; // Optionally, change button text
                                                                } else {
                                                                    event.preventDefault(); // Prevent form submission if invalid
                                                                    form.reportValidity(); // Show validation messages
                                                                }
                                                            });
                                                                </script>

@endsection

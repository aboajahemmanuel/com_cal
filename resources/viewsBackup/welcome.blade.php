@extends('layouts.external')

@section('content')
    <section class="event-bg">
        <h1 style="color: white">Corporate Action Calendar for <br>FMDQ Private Markets Limited
        </h1>
    </section>
    <section>
        <div class="main-content">
            <div class="">
                <div class="nk-block">
                    <div class="card card-bordered">
                        <div class="card-inner">





                            <div class="container">

                                <div class="row"
                                    style="display: flex; justify-content: flex-end;  margin: 0px 0px 0px 150px">
                                    <div class="form-control-wrap">
                                        <label class="form-label" for="add-account">Corporate Action
                                            by Category </label>
                                        <select id="categorySelector" class="form-control">
                                            <option value="all">All Categories</option>
                                            <!-- Additional options will be added dynamically -->

                                        </select>
                                    </div>

                                </div>
                                <br>

                                <div id="calendar" class="nk-calendar"></div>
                            </div>

                            <div class="container"> 
                                <br>
                                <table
                                    style="border: 3px solid #000; width: 65%; table-layout: fixed; font-family: calibri; font-size: 12px; text-align:center">
                                    <thead>
                                        <tr>
                                            @foreach ($category_color as $categories)
                                                <th scope="col"
                                                    style="border: 1px solid #000; background-color: {{ $categories->color }}; color: white; width: 20%; text-align:center">
                                                    {{ $categories->name }}
                                                </th>
                                            @endforeach
                                            {{-- <th scope="col"
                                                style="border: 3px solid #000; background-color: #1d326c; color: white; width: 20%; text-align:center">
                                                Regulatory Filings
                                            </th>
                                            <th scope="col"
                                                style="border: 3px solid #000; background-color: #f4b083; color: white; width: 20%; text-align:center">
                                                Programmes and Events
                                            </th>
                                            <th scope="col"
                                                style="border: 3px solid #000; background-color: #538135; color: white; width: 20%; text-align:center">
                                                Rental Payment
                                            </th>
                                            <th scope="col"
                                                style="border: 3px solid #000; background-color: #7030a0; color: white; width: 20%;  text-align:center">
                                                Sukuk Maturity
                                            </th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            @foreach ($category_color as $categories)
                                                <td align="center" style="border: 3px solid #000; font-weight: bolder">
                                                    {{ $categories->code }}</td>
                                                {{-- <td align="center" style="border: 3px solid #000; font-weight: bolder">RGF</td>
                                            <td align="center" style="border: 3px solid #000;font-weight: bolder">PGE</td>
                                            <td align="center" style="border: 3px solid #000; font-weight: bolder">REP</td>
                                            <td align="center" style="border: 3px solid #000; font-weight: bolder">SUM</td> --}}
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table>

                                <br>

                                @if (isset($data))
                                    <a class="btn btn-primary" style="background: #C79D51 !important;" href="{{ asset('upload_file/' . $data->name) }}"
                                        target="_blank">
                                        Download Issuer Code Directory
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </section>








    <div class="modal fade" id="previewEventPopup">
        <div class="modal-dialog modal-dialog-top modal-lg" role="document">
            <div class="modal-content">
                <div id="preview-event-header" class="modal-header">
                    <h5 id="preview-event-title" class="modal-title">Placeholder Title</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>

                <div class="modal-body" style="font-family: 'Open Sans', sans-serif;">
                    {{-- <center><img id="event-image" src="" height="200px" width="" class="item-center" />
                    </center><br> --}}
                    <div class="row gy-3 py-1">


                        <div class="col-sm-6">
                            <b>
                                <h6 style="font-family: 'Open Sans', sans-serif; font-size: 14px; color: #8094ae;">Start
                                    Date </h6>
                            </b>
                            <p id="preview-event-start" style="color:#000; font-size: 12px"></p>
                        </div>
                        {{-- <div class="col-sm-6" id="preview-event-end-check">
                            <b>
                                <h6 style="font-family: 'Open Sans', sans-serif; font-size: 14px; color: #8094ae;">End Date
                                    and Time</h6>
                            </b>
                            <p id="preview-event-end"
                                style="color:#000; font-size: 12px; font-family: 'Open Sans', sans-serif;"></p>
                        </div> --}}

                    </div>

                    <div class="row gy-3 py-1">
                        {{-- <div class="col-sm-6" id="preview-event-end-check">
                            <b>
                                <h6 style="font-family: 'Open Sans', sans-serif; font-size: 14px; color: #8094ae;">Venue
                                </h6>
                            </b>
                            <p id="preview-event-venue"
                                style="color:#000; font-size: 12px; font-family: 'Open Sans', sans-serif;"></p>

                        </div> --}}


                        <div class="col-sm-6" id="preview-event-end-check">
                            <b>
                                <h6 style="font-family: 'Open Sans', sans-serif; font-size: 14px; color: #8094ae;">Corporate
                                    Action</h6>
                            </b>
                            <p id="preview-event-category_name"
                                style="font-size: 12px; font-family: 'Open Sans', sans-serif;"></p>

                        </div>



                        <div class="col-sm-6" id="preview-event-end-check">
                            <b>
                                <h6 style="font-family: 'Open Sans', sans-serif; font-size: 14px; color: #8094ae;">Issuer
                                </h6>
                            </b>
                            <p id="preview-event-issuer"
                                style="color:#000; font-size: 12px; font-family: 'Open Sans', sans-serif;"></p>

                        </div>


                        <div class="col-sm-12" id="preview-event-end-check">
                            <b>
                                <h6 style="font-family: 'Open Sans', sans-serif; font-size: 14px; color: #8094ae;">Issuer
                                    Description</h6>
                            </b>
                            <p id="preview-event-issuerDescription"
                                style="color:#000; font-size: 12px; line-break: anywhere; font-family: 'Open Sans', sans-serif;">
                            </p>

                        </div>

                        <div class="col-sm-12" id="preview-event-description-check">
                            <b>
                                <h6 style="font-family: 'Open Sans', sans-serif; font-size: 14px; color: #8094ae;">Event
                                    Description</h6>
                            </b>
                            <p id="modalEventDescription"
                                style="color:#000; font-size: 12px; line-break: anywhere; font-family: 'Open Sans', sans-serif;">
                            </p>
                        </div>
                    </div>


                    <ul class=" gx-4 mt-3">
                        <h6 class="" style="font-size: 14px; color: #8094ae;text-align: center !important;">Add To</h6>
                        <div class="d-flex" style="align-items: center; justify-content: center; gap: 5px;">
                            <li>
                                <a href="#" id="add-to-google-calendar" target="_blank" class="btn btn-secondary"
                                    style="background: #1d326c;">Google Calendar</a>
                            </li>
                            <li>
                                <a href="#" id="add-to-outlook-calendar" target="_blank" class="btn btn-secondary"
                                    style="background: #1d326c;">Outlook Calendar</a>
                            </li>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

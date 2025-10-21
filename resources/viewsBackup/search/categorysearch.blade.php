{{-- @if(is_null($search))
    <h3>No results found for {{$title}}</h3>
@else
   Good
@endif --}}





@extends('layouts.app')

@section('content')

<div class="page-content">

    <!-- Start home -->
    <section class="page-title-box">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center text-white">
                        <h3 class="mb-4">{{$title}}</h3>
                        <div class="page-next">
                            <nav class="d-inline-block" aria-label="breadcrumb text-center">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"> Search  {{$title}} </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
    <!-- end home -->

    <!-- START SHAPE -->
    <div class="position-relative" style="z-index: 1">
        <div class="shape">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 250">
                <path fill="#FFFFFF" fill-opacity="1"
                    d="M0,192L120,202.7C240,213,480,235,720,234.7C960,235,1200,213,1320,202.7L1440,192L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path>
            </svg>
        </div>
    </div>
    <!-- END SHAPE -->


    <!-- START JOB-LIST -->
    <section class="section">
        <div class="container">
            <div class="row">

                <div class="col-lg-9">
                    <div class="me-lg-5">
                        <div class="job-list-header">
                            <form  method="POST" action="{{ route('search', $title)}}" >
                                @csrf
                           
                                <div class="row g-2">
                                    <div class="col-lg-8 col-md-6">
                                        <div class="filler-job-form">
                                            <i class="uil uil-book-alt"></i>
                                            <input type="search" required name="title" class="form-control filter-job-input-box" id="exampleFormControlInput1" placeholder="E-Bond, Disciplinary...">
                                        </div>
                                    </div><!--end col-->
                                    {{-- <div class="col-lg-3 col-md-6">
                                        <div class="filler-job-form">
                                            <i class="uil uil-location-point"></i>
                                            <select class="form-select" data-trigger name="choices-single-location" id="choices-single-location" aria-label="Default select example">
                                                
                                            </select>
                                        </div>
                                    </div><!--end col--> --}}
                                    {{-- <div class="col-lg-3 col-md-6">
                                        <div class="filler-job-form">
                                            <i class="uil uil-clipboard-notes"></i>
                                            <select class="form-select " data-trigger name="choices-single-categories" id="choices-single-categories" aria-label="Default select example">
                                                <option value="4">Accounting</option>
                                                <option value="1">IT & Software</option>
                                                <option value="3">Marketing</option>
                                                <option value="5">Banking</option>
                                            </select>
                                        </div>
                                    </div><!--end col--> --}}
                                    <div class="col-lg-4 col-md-6">
                                        <button type="submit" class="btn btn-primary w-100"><i class="uil uil-search me-1"></i> Change Search</button>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </form>
                        </div><!--end job-list-header-->
                        <div class="wedget-popular-title mt-4">
                            <h6>Categories</h6>
                            <ul class="list-inline">
                                <p> Total Results:  {{$total}}</p>
                                @php
                                $categories =  \App\Models\Category::all();

                                // $search = Category::where('title', 'like', '%'.$title.'%')->get();
                                // $total = $search->count();

                                @endphp
                               @foreach ($categories as $category)
                               <li class="list-inline-item">
                                   <div class="popular-box d-flex align-items-center">
                                       
                                     
                                      
                               <a href="{{ route('categorysearch', ['title' => $title, 'category_slug' =>  $category->slug] )}}"> <button type="submit" class="btn btn-outline-primary">{{$category->name}}</button></a>
                                   
                                           {{-- <h6 class="fs-14 mb-0">{{$category->name}}</h6> --}}
                                   </div>
                               </li>
                               @endforeach

                                {{-- @foreach ($categories as $category)
                                {{ $category->name }}
                                @endforeach --}}
                               
                            </ul>
                        </div><!--end wedget-popular-title-->
    
                        <!-- Job-list -->
                        <div>
                                @if(is_null($search))
                                    <h3>No results found for "{{$title}}"</h3>
                                @else
                                @foreach ($search as $result)
                                <div class="job-box bookmark-post card mt-5">
                                    <div class="p-4">
                                        <div class="row">
                                            <div class="col-lg-1">
                                                <a href="company-details.html"><img src="{{ asset('public/users/assets/images/pdfimg.png')}}" alt="" class="img-fluid rounded-3"></a>
                                            </div><!--end col-->
                                            <div class="col-lg-10">
                                                <div class="mt-3 mt-lg-0">
                                                    <h5 class="fs-17 mb-1"><a href="job-details.html" class="text-dark">{{$result->title}}</a> </h5>
                                                   
                                                    <div class="mt-2">
                                                        <span class="badge bg-soft-success mt-1">{{ $result->entity->name }}</span>
                                                        <span class="badge bg-soft-success mt-1">{{ $result->category->name }}</span>
                                                        <span class="badge bg-soft-success mt-1">{{ $result->subcategory->name }}</span>
                                                    </div>
                                                </div>
                                            </div><!--end col-->
                                        </div><!--end row-->
                                     
                                    </div>
                                    <div class="p-3 bg-light">
                                        <div class="row justify-content-between">
                                            <div class="col-md-8">
                                               
                                            </div>
                                            <!--end col-->
                                            <div class="col-md-3">
                                                <div class="text-md-end">
                                                    <a href="#applyNow" data-bs-toggle="modal" class="primary-link">Read more <i class="mdi mdi-chevron-double-right"></i></a>
                                                </div>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-12">
                                    <center>
                                    <nav aria-label="Page navigation example">
                                        
                                        {{ $search->links("pagination::bootstrap-4",["pagination job-pagination mb-0 justify-content-center" => "pagination justify-content-center"]) }}
                                        {{-- <ul class="pagination job-pagination mb-0 justify-content-center">
                                            <li class="page-item disabled">
                                                <a class="page-link" href="javascript:void(0)" tabindex="-1">
                                                    <i class="mdi mdi-chevron-double-left fs-15"></i>
                                                </a>
                                            </li>
                                            <li class="page-item active"><a class="page-link" href="javascript:void(0)">1</a></li>
                                            <li class="page-item"><a class="page-link" href="javascript:void(0)">2</a></li>
                                            <li class="page-item"><a class="page-link" href="javascript:void(0)">3</a></li>
                                            <li class="page-item"><a class="page-link" href="javascript:void(0)">4</a></li>
                                            <li class="page-item">
                                                <a class="page-link" href="javascript:void(0)">
                                                    <i class="mdi mdi-chevron-double-right fs-15"></i>
                                                </a>
                                            </li>
                                        </ul> --}}
                                    </nav>
                                </center>
                                </div><!--end col-->
                            
                                @endif
                            </div>

                            
                            <!--end job-box-->
    
                           
    
                       
                        <!-- End Job-list -->
    
                       
                    </div>

                </div>
                <!-- START SIDE-BAR -->
                <div class="col-lg-3">
                    <div class="side-bar mt-5 mt-lg-0">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="locationOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#location" aria-expanded="true" aria-controls="location">
                                    Location
                                </button>
                                </h2>
                                <div id="location" class="accordion-collapse collapse show" aria-labelledby="locationOne">
                                    <div class="accordion-body">
                                        <div class="side-title">
                                            <div class="mb-3">
                                                <form class="position-relative">
                                                    <input class="form-control" type="search" placeholder="Search...">
                                                    <button class="bg-transparent border-0 position-absolute top-50 end-0 translate-middle-y me-2" type="submit"><span class="mdi mdi-magnify text-muted"></span></button>
                                                </form>
                                            </div>
                                            <div class="area-range">
                                                <div class="form-label mb-3">Area Range: <span class="example-val mt-2" id="slider1-span">0</span> miles</div>
                                                <div id="slider1"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end accordion-item -->
                    
                            <div class="accordion-item mt-4">   
                            <h2 class="accordion-header" id="experienceOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#experience" aria-expanded="true" aria-controls="experience">
                                    Work experience
                                </button>
                            </h2>
                            <div id="experience" class="accordion-collapse collapse show" aria-labelledby="experienceOne">
                                <div class="accordion-body">
                                    <div class="side-title">
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked1" />
                                            <label class="form-check-label ms-2 text-muted" for="flexCheckChecked1">No experience</label>
                                        </div>
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked2" checked />
                                            <label class="form-check-label ms-2 text-muted" for="flexCheckChecked2">0-3 years</label>
                                        </div>
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked3" />
                                            <label class="form-check-label ms-2 text-muted" for="flexCheckChecked3">3-6 years</label>
                                        </div>
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked4" />
                                            <label class="form-check-label ms-2 text-muted" for="flexCheckChecked4">More than 6 years</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div><!-- end accordion-item -->
                    
                            <div class="accordion-item mt-3">
                                <h2 class="accordion-header" id="jobType">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#jobtype" aria-expanded="false" aria-controls="jobtype">
                                        Type of employment
                                    </button>
                                </h2>
                                <div id="jobtype" class="accordion-collapse collapse show" aria-labelledby="jobType">
                                    <div class="accordion-body">
                                        <div class="side-title">
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault6" checked>
                                                <label class="form-check-label ms-2 text-muted" for="flexRadioDefault6">
                                                    Freelance
                                                </label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                                <label class="form-check-label ms-2 text-muted" for="flexRadioDefault2">
                                                    Full Time
                                                </label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                                                <label class="form-check-label ms-2 text-muted" for="flexRadioDefault3">
                                                    Internship
                                                </label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4">
                                                <label class="form-check-label ms-2 text-muted" for="flexRadioDefault4">
                                                    Part Time
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end accordion-item -->
                    
                            <div class="accordion-item mt-3">
                                <h2 class="accordion-header" id="datePosted">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#dateposted" aria-expanded="false" aria-controls="dateposted">
                                        Date Posted
                                    </button>
                                </h2>
                                <div id="dateposted" class="accordion-collapse collapse show" aria-labelledby="datePosted">
                                    <div class="accordion-body">
                                        <div class="side-title form-check-all">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="checkAll" value="" />
                                                <label class="form-check-label ms-2 text-muted" for="checkAll">
                                                    All
                                                </label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="checkbox"  name="datePosted"  value="last" id="flexCheckChecked5" checked />
                                                <label class="form-check-label ms-2 text-muted" for="flexCheckChecked5">
                                                    Last Hour
                                                </label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="checkbox" name="datePosted" value="last" id="flexCheckChecked6" />
                                                <label class="form-check-label ms-2 text-muted" for="flexCheckChecked6">
                                                    Last 24 hours
                                                </label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="checkbox" name="datePosted" value="last" id="flexCheckChecked7" />
                                                <label class="form-check-label ms-2 text-muted" for="flexCheckChecked7">
                                                    Last 7 days
                                                </label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="checkbox" name="datePosted" value="last" id="flexCheckChecked8" />
                                                <label class="form-check-label ms-2 text-muted" for="flexCheckChecked8">
                                                    Last 14 days
                                                </label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="checkbox" name="datePosted" value="last" id="flexCheckChecked9" />
                                                <label class="form-check-label ms-2 text-muted" for="flexCheckChecked9">
                                                    Last 30 days
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end accordion-item -->
                    
                            <div class="accordion-item mt-3">
                                <h2 class="accordion-header" id="tagCloud">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#tagcloud" aria-expanded="false" aria-controls="tagcloud">
                                        Tags Cloud
                                    </button>
                                </h2>
                                <div id="tagcloud" class="accordion-collapse collapse show" aria-labelledby="tagCloud">
                                    <div class="accordion-body">
                                        <div class="side-title">
                                            <a href="javascript:void(0)" class="badge tag-cloud fs-13 mt-2">design</a>
                                            <a href="javascript:void(0)" class="badge tag-cloud fs-13 mt-2">marketing</a>
                                            <a href="javascript:void(0)" class="badge tag-cloud fs-13 mt-2">business</a>
                                            <a href="javascript:void(0)" class="badge tag-cloud fs-13 mt-2">developer</a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end accordion-item -->
                    
                        </div><!--end accordion-->
                        
                    </div><!--end side-bar-->
                </div>
                <!-- END SIDE-BAR -->
            </div>
        </div>
    </section>
    <!-- END JOB-LIST -->

    <!-- START APPLY MODAL -->
    <div class="modal fade" id="applyNow" tabindex="-1" aria-labelledby="applyNow" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-5">
                    <div class="text-center mb-4">
                        <h5 class="modal-title" id="staticBackdropLabel">Apply For This Job</h5>
                    </div>
                    <div class="position-absolute end-0 top-0 p-3">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="mb-3">
                        <label for="nameControlInput" class="form-label">Name</label>
                        <input type="text" class="form-control" id="nameControlInput" placeholder="Enter your name">
                    </div>
                    <div class="mb-3">
                        <label for="emailControlInput2" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="emailControlInput2" placeholder="Enter your email">
                    </div>
                    <div class="mb-3">
                        <label for="messageControlTextarea" class="form-label">Message</label>
                        <textarea class="form-control" id="messageControlTextarea" rows="4" placeholder="Enter your message"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="inputGroupFile01">Resume Upload</label>
                        <input type="file" class="form-control" id="inputGroupFile01">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Send Application</button>
                </div>
            </div>
        </div>
    </div><!-- END APPLY MODAL -->

</div>


@endsection
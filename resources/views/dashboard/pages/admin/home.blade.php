@extends('dashboard.layouts.master')
@section('content')
    <!-- Start:: content (Your custom content)-->
                <div class="subheader px-lg">
                    <div class="subheader-container">
                        <div class="subheader-main d-none d-lg-flex">
                            <h3 class="subheader-title">Dashboard</h3>
                            <nav class="ul-breadcrumb" aria-label="breadcrumb">
                                <ol class="ul-breadcrumb-items">
                                    <li class="breadcrumb-home"><a href="#"> <i class="material-icons">home</i></a></li>
                                    <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Job Management</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="flex-grow-1"></div>
                        <div class="subheader-toolbar">
                            <button class="btn btn-sm btn-opacity btn-primary" id="reportrange"><i class="fa fa-calendar me-sm"></i><span></span></button>
                        </div>
                    </div>
                </div>
                <div class="container mt-lg">
                    <div class="row">
                        <div class="col-xl-9 col-lg-8">
                            <div class="row">
                                <div class="col-lg-6 col-md-12 mb-lg">
                                    <div class="card">
                                        <div class="card-body py-0 d-flex justify-content-between align-items-center">
                                            <div class="mb-3"><span class="text-small text-muted">Total </span>
                                                <h3 class="font-weight-bold">5672</h3>
                                                <div class="d-flex align-items-center"><span class="badge badge-opacity badge-primary rounded-circle badge-xxs me-1"><i class="material-icons">call_made</i></span><span class="text-primary text-small font-weight-bold">+14% Inc</span></div>
                                            </div>
                                            <div id="management-chart"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 mb-lg">
                                    <div class="card">
                                        <div class="card-body py-0 d-flex justify-content-between align-items-center">
                                            <div class="mb-3"><span class="text-small text-muted">Shortlist</span>
                                                <h3 class="font-weight-bold">3045</h3>
                                                <div class="d-flex align-items-center"><span class="badge badge-opacity badge-warning rounded-circle badge-xxs me-1"><i class="material-icons">call_made</i></span><span class="text-warning text-small font-weight-bold">+04% Inc</span></div>
                                            </div>
                                            <div id="management-chartTwo"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-12 mb-lg">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-lg">
                                                <div class="card-title m-0">Job Applications Last Week</div>
                                                <div class="dropdown">
                                                    <button class="btn btn-opacity btn-primary rounded-circle btn-sm btn-icon" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons text-14">date_range</i></button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"><a class="dropdown-item" href="#">Year</a><a class="dropdown-item" href="#">Month</a><a class="dropdown-item" href="#">Week</a></div>
                                                </div>
                                            </div>
                                            <div id="jobManagement_chart4" style="height:320px"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-12 mb-lg">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center flex-wrap mb-md">
                                                <div class="card-title m-0">Acquisitions</div>
                                                <div class="dropdown">
                                                    <button class="btn btn-opacity btn-primary rounded-circle btn-sm btn-icon" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons text-14">date_range</i></button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                                                </div>
                                            </div>
                                            <div class="d-flex jsutify-content-between align-items-center my-lg">
                                                <div class="d-flex align-items-center w-50"><i class="material-icons text-10 text-primary me-2">lens</i>
                                                    <p class="font-weight-medium m-0">All</p>
                                                </div>
                                                <div class="flex-grow-1 me-md w-30">
                                                    <div class="progress-wrapper">
                                                        <div class="progress">
                                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="m-0">1290</p>
                                            </div>
                                            <div class="d-flex jsutify-content-between align-items-center my-lg">
                                                <div class="d-flex align-items-center w-50"><i class="material-icons text-10 text-warning me-2">lens</i>
                                                    <p class="font-weight-medium m-0">Shortlisted</p>
                                                </div>
                                                <div class="flex-grow-1 me-md w-30">
                                                    <div class="progress-wrapper">
                                                        <div class="progress">
                                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 15%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="m-0">15%</p>
                                            </div>
                                            <div class="d-flex jsutify-content-between align-items-center my-lg">
                                                <div class="d-flex align-items-center w-50"><i class="material-icons text-10 text-primary me-2">lens</i>
                                                    <p class="font-weight-medium m-0">Contacted</p>
                                                </div>
                                                <div class="flex-grow-1 me-md w-30">
                                                    <div class="progress-wrapper">
                                                        <div class="progress">
                                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 65%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="m-0">65%</p>
                                            </div>
                                            <div class="d-flex jsutify-content-between align-items-center my-lg">
                                                <div class="d-flex align-items-center w-50"><i class="material-icons text-10 text-danger me-2">lens</i>
                                                    <p class="font-weight-medium m-0">Rejected</p>
                                                </div>
                                                <div class="flex-grow-1 me-md w-30">
                                                    <div class="progress-wrapper">
                                                        <div class="progress">
                                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 35%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="m-0">35%</p>
                                            </div>
                                            <div class="d-flex jsutify-content-between align-items-center my-lg">
                                                <div class="d-flex align-items-center w-50"><i class="material-icons text-10 text-info me-2">lens</i>
                                                    <p class="font-weight-medium m-0">On Hold</p>
                                                </div>
                                                <div class="flex-grow-1 me-md w-30">
                                                    <div class="progress-wrapper">
                                                        <div class="progress">
                                                            <div class="progress-bar bg-info" role="progressbar" style="width: 35%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="m-0">35%</p>
                                            </div>
                                            <div class="d-flex jsutify-content-between align-items-center my-lg">
                                                <div class="d-flex align-items-center w-50"><i class="material-icons text-10 text-primary me-2">lens</i>
                                                    <p class="font-weight-medium m-0">Finalised</p>
                                                </div>
                                                <div class="flex-grow-1 me-md w-30">
                                                    <div class="progress-wrapper">
                                                        <div class="progress">
                                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 25%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="m-0">25%</p>
                                            </div>
                                            <div class="d-flex jsutify-content-between align-items-center my-lg">
                                                <div class="d-flex align-items-center w-50"><i class="material-icons text-10 text-success me-2">lens</i>
                                                    <p class="font-weight-medium m-0">Hired</p>
                                                </div>
                                                <div class="flex-grow-1 me-md w-30">
                                                    <div class="progress-wrapper">
                                                        <div class="progress">
                                                            <div class="progress-bar bg-success" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="m-0">15%</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 mb-lg">
                                    <div class="table-responsive shadow-6dp bg-card rounded">
                                        <table class="table borderless table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-muted border-0">Job Post</th>
                                                    <th scope="col" class="text-muted border-0">Posted at</th>
                                                    <th scope="col" class="text-muted border-0">Applicants</th>
                                                    <th scope="col" class="text-muted border-0"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="align-middle font-weight-semi border-0"><a class="text-body" href="">Senior Fullstack Engineer</a></td>
                                                    <td class="align-middle border-0">
                                                        <span class="text-muted">01/10/2020</span>
                                                    </td>
                                                    <td class="align-middle border-0">
                                                        <div class="col-md-4 d-flex align-items-center avatar-group m-0">
                                                            <img class="avatar-sm rounded-circle" src="../assets/images/avatars/001-man.svg" data-toggle="tooltip" data-placement="top" title="John M">
                                                            <img class="avatar-sm rounded-circle" src="../assets/images/avatars/002-woman.svg" data-toggle="tooltip" data-placement="top" title="Alison W">
                                                            <img class="avatar-sm rounded-circle" src="../assets/images/avatars/007-woman-2.svg" data-toggle="tooltip" data-placement="top" title="Alisa J">
                                                            <span class="badge rounded-circle gray-300 badge-sm">10+</span>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle border-0">
                                                        <div class="dropdown d-inline">
                                                            <button class="btn btn-light btn-icon btn-sm rounded-circle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons">more_horiz</i></button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <a class="dropdown-item" href="#"><i class="material-icons icon icon-sm">assignment</i>View Job Post</a>
                                                                <a class="dropdown-item" href="#"><i class="material-icons icon icon-sm">group</i>View Applicants</a>
                                                                <a class="dropdown-item" href="#"><i class="material-icons icon icon-sm">person_add</i>Invite Applicant</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="align-middle font-weight-semi border-0"><a class="text-body" href="">Freelance Java Developer</a></td>
                                                    <td class="align-middle border-0">
                                                        <span class="text-muted">01/10/2020</span>
                                                    </td>
                                                    <td class="align-middle border-0">
                                                        <div class="col-md-4 d-flex align-items-center avatar-group m-0">
                                                            <img class="avatar-sm rounded-circle" src="../assets/images/avatars/003-man-1.svg" data-toggle="tooltip" data-placement="top" title="John M">
                                                            <img class="avatar-sm rounded-circle" src="../assets/images/avatars/004-bald.svg" data-toggle="tooltip" data-placement="top" title="Alison W">
                                                            <img class="avatar-sm rounded-circle" src="../assets/images/avatars/006-woman-1.svg" data-toggle="tooltip" data-placement="top" title="Alisa J">
                                                            <span class="badge rounded-circle gray-300 badge-sm">6+</span>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle border-0">
                                                        <div class="dropdown d-inline">
                                                            <button class="btn btn-light btn-icon btn-sm rounded-circle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons">more_horiz</i></button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <a class="dropdown-item" href="#"><i class="material-icons icon icon-sm">assignment</i>View Job Post</a>
                                                                <a class="dropdown-item" href="#"><i class="material-icons icon icon-sm">group</i>View Applicants</a>
                                                                <a class="dropdown-item" href="#"><i class="material-icons icon icon-sm">person_add</i>Invite Applicant</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="align-middle font-weight-semi border-0"><a class="text-body" href="">Python Developer</a></td>
                                                    <td class="align-middle border-0">
                                                        <span class="text-muted">01/10/2020</span>
                                                    </td>
                                                    <td class="align-middle border-0">
                                                        <div class="col-md-4 d-flex align-items-center avatar-group m-0">
                                                            <img class="avatar-sm rounded-circle" src="../assets/images/avatars/006-woman-1.svg" data-toggle="tooltip" data-placement="top" title="John M">
                                                            <img class="avatar-sm rounded-circle" src="../assets/images/avatars/002-woman.svg" data-toggle="tooltip" data-placement="top" title="Alison W">
                                                            <img class="avatar-sm rounded-circle" src="../assets/images/avatars/007-woman-2.svg" data-toggle="tooltip" data-placement="top" title="Alisa J">
                                                            <span class="badge rounded-circle gray-300 badge-sm">4+</span>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle border-0">
                                                        <div class="dropdown d-inline">
                                                            <button class="btn btn-light btn-icon btn-sm rounded-circle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons">more_horiz</i></button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <a class="dropdown-item" href="#"><i class="material-icons icon icon-sm">assignment</i>View Job Post</a>
                                                                <a class="dropdown-item" href="#"><i class="material-icons icon icon-sm">group</i>View Applicants</a>
                                                                <a class="dropdown-item" href="#"><i class="material-icons icon icon-sm">person_add</i>Invite Applicant</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="align-middle font-weight-semi border-0"><a class="text-body" href="">Product Designer</a></td>
                                                    <td class="align-middle border-0">
                                                        <span class="text-muted">01/10/2020</span>
                                                    </td>
                                                    <td class="align-middle border-0">
                                                        <div class="col-md-4 d-flex align-items-center avatar-group m-0">
                                                            <img class="avatar-sm rounded-circle" src="../assets/images/avatars/003-man-1.svg" data-toggle="tooltip" data-placement="top" title="John M">
                                                            <img class="avatar-sm rounded-circle" src="../assets/images/avatars/004-bald.svg" data-toggle="tooltip" data-placement="top" title="Alison W">
                                                            <img class="avatar-sm rounded-circle" src="../assets/images/avatars/006-woman-1.svg" data-toggle="tooltip" data-placement="top" title="Alisa J">
                                                            <span class="badge rounded-circle gray-300 badge-sm">9+</span>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle border-0">
                                                        <div class="dropdown d-inline">
                                                            <button class="btn btn-light btn-icon btn-sm rounded-circle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons">more_horiz</i></button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <a class="dropdown-item" href="#"><i class="material-icons icon icon-sm">assignment</i>View Job Post</a>
                                                                <a class="dropdown-item" href="#"><i class="material-icons icon icon-sm">group</i>View Applicants</a>
                                                                <a class="dropdown-item" href="#"><i class="material-icons icon icon-sm">person_add</i>Invite Applicant</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 mb-md">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-md">
                                                <div class="card-title m-0">Application Received Time</div>
                                                <div class="dropdown">
                                                    <button class="btn btn-opacity btn-primary rounded-circle btn-sm btn-icon" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons text-14">date_range</i>
                                                        <div class="ripple-container"></div>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: top, left; top: 38px; left: 0px;"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                                                </div>
                                            </div>
                                            <div id="jobManagement_chart5"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 p-0">
                            <div class="col-xl-12 col-lg-12 mb-md">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 text-center mb-lg"><img class="rounded-circle avatar-xl mb-md" src="../assets/images/faces/15.jpg" alt="" srcset="">
                                                <div class="card-title m-0">Jhon Doe</div>
                                                <p class="text-muted mb-xs">HR Manager</p>
                                                <div class="d-flex align-items-center justify-content-center"><span class="badge badge-opacity badge-primary rounded-circle badge-xxs me-sm"><i class="material-icons text-14 align-middle">location_on</i></span><span class="text-primary text-12">New York, US</span></div>
                                            </div>
                                            <div class="col-12 mb-xxl">
                                                <div class="heading-label">Jobs Posted</div>
                                                <div class="card bg-primary text-white">
                                                    <div class="card-body pe-sm d-flex justify-content-between">
                                                        <div class="flex-1">
                                                            <div class="card-title text-white mb-xs text-15">Sr. Software Developer</div>
                                                            <p class="m-0 text-12"><span class="badge badge-warning badge-xxs rounded-circle me-xs">95</span>Total Applications</p>
                                                        </div>
                                                        <div class="dropdown d-flex align-items-center">
                                                            <button class="btn btn-primary btn-icon btn-sm rounded-circle" id="dropdownMenuButton322" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons text-white">more_vert</i>
                                                                <div class="ripple-container"></div>
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton322" x-placement="bottom-start" style="position: absolute; will-change: top, left; top: 38px; left: 0px;"><a class="dropdown-item" href="#"> <i class="material-icons icon icon-sm">visibility_off</i>Unpublish</a><a class="dropdown-item" href="#"> <i class="material-icons icon icon-sm">edit</i>Edit Job Post</a><a class="dropdown-item" href="#"> <i class="material-icons icon icon-sm">delete</i>Delete</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="ul-list-group-1">
                                                    <h6 class="heading-label">Reminder</h6>
                                                    <div class="ul-list-item mb-md">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <span class="badge badge-opacity rounded-circle badge-light me-md"> <i class="material-icons text-muted">view_week</i></span>
                                                            <div class="flex-grow-1">
                                                                <h6 class="text-small font-weight-semi m-0">Subscription expires today</h6>
                                                                <small class="text-muted text-small">23 December 2019</small>
                                                            </div>
                                                            <div class="ul-reminder-action">
                                                                <button class="btn rounded-circle btn-icon">
                                                                    <i class="material-icons text-muted">more_horiz</i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ul-list-item mb-md">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <span class="badge badge-opacity rounded-circle badge-light me-md"> <i class="material-icons text-muted">close</i></span>
                                                            <div class="flex-grow-1">
                                                                <h6 class="text-small font-weight-semi m-0">You unpublished a Job</h6>
                                                                <small class="text-muted text-small">23 December 2019</small>
                                                            </div>
                                                            <div class="ul-reminder-action">
                                                                <button class="btn rounded-circle btn-icon">
                                                                    <i class="material-icons text-muted">more_horiz</i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ul-list-item mb-md">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <span class="badge badge-opacity rounded-circle badge-light me-md"> <i class="material-icons text-muted">person</i></span>
                                                            <div class="flex-grow-1">
                                                                <h6 class="text-small font-weight-semi m-0">5 New applicants</h6>
                                                                <small class="text-muted text-small">23 December 2019</small>
                                                            </div>
                                                            <div class="ul-reminder-action">
                                                                <button class="btn rounded-circle btn-icon">
                                                                    <i class="material-icons text-muted">more_horiz</i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ul-list-item mb-md">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <span class="badge badge-opacity rounded-circle badge-light me-md"> <i class="material-icons text-muted">textsms</i></span>
                                                            <div class="flex-grow-1">
                                                                <h6 class="text-small font-weight-semi m-0">New Commnet on job post</h6>
                                                                <small class="text-muted text-small">23 December 2019</small>
                                                            </div>
                                                            <div class="ul-reminder-action">
                                                                <button class="btn rounded-circle btn-icon">
                                                                    <i class="material-icons text-muted">more_horiz</i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 mb-md">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-md flex-wrap">
                                            <div class="card-title m-0">Candidates by Gender</div>
                                            <div class="dropdown">
                                                <button class="btn btn-opacity btn-primary rounded-circle btn-icon btn-sm" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons text-14">date_range</i>
                                                    <div class="ripple-container"></div>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: top, left; top: 38px; left: 0px;"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                                            </div>
                                        </div>
                                        <div id="jobManagement_chart6"> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Start:: content (Your custom content)-->
@endsection
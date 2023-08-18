@extends('user.layouts.user-app')

@section('title', 'Katalog Kelas')

@section('content')

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Kelas USKP Review</h1>
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button"
                    aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="
                            m-0
                            font-weight-bold
                            text-danger
                        ">
                        Apa Itu Kelas USKP Review
                    </h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample">
                    <div class="card-body">
                        This is a collapsable card example
                        using Bootstrap's built in collapse
                        functionality.
                        <strong>Click on the card
                            header</strong>
                        to see the card body collapse and
                        expand!
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="
                    card
                    border-left-danger
                    shadow
                    h-100
                    py-2
                ">
                <div class="card-body">
                    <img src="{{ url('userAdmin/frontend/image/katalog.png')}}" class="card-img-top" alt"">
                    <div class="
                            row
                            no-gutters
                            align-items-center
                        ">
                        <div class="col mr-2">
                            <div class="
                                    text-xs
                                    font-weight-bold
                                    text-danger
                                    text-uppercase
                                    mb-1
                                ">
                                <h6>
                                    25 Mei 2021 - 26 Agt
                                    2021
                                </h6>
                                18.00 - 21.00 <br />
                                USKP A <br />
                                5x Pertemuan <br />
                            </div>
                            <div class="
                                    h5
                                    mb-0
                                    font-weight-bold
                                    text-gray-800
                                ">
                                Rp. 2.250.000,00
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

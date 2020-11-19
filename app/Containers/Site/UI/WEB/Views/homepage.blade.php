@extends('layouts.darkness.base')
@section('content')

    @include('partials.darkness.homepage-slider')


    <section>
        <div class="tabs tabs--primary negative-margin-top-63">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <ul class="nav nav-tabs" id="myTab2" role="tablist">

                            <li role="presentation" class="nav-item active">
                                <a class="nav-link active h6 tabs-scroll" id="find-tab"
                                   data-toggle="tab" href="#find" role="tab" aria-controls="home"
                                   aria-selected="true">Find a Job</a>
                            </li>

                            <li role="presentation" class="nav-item">
                                <a class="nav-link h6 tabs-scroll" id="candidate-tab"
                                   data-toggle="tab" href="#candidate" role="tab"
                                   aria-controls="profile" aria-selected="false">Find a Candidate</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>

            <div class="tab-content">

                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="tab-pane active" id="find" role="tabpanel"
                                 aria-labelledby="find-tab">
                                <form class="form--search">

                                    <div class="row">
                                        <div class="col-md-4 col-sm-6 col-xs-12 mb-3 mb-md-0">
                                            <input name="name" placeholder="Keywords" type="text">
                                            <div class="c-grey fs-14">* Search keywords e.g. web design</div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12 mb-3 mb-md-0">
                                            <select id="select1" class="puzzle--select"
                                                    data-minimum-results-for-search="Infinity">
                                                <option data-display="All Specialisms">All Specialisms</option>
                                                <option value="1">Freelance</option>
                                                <option value="2">Full Time</option>
                                                <option value="3">Intership</option>
                                                <option value="4">Part Time</option>
                                                <option value="5">Temporary</option>
                                            </select>
                                            <div class="c-grey fs-14">* Filter by specialisms e.g. developer</div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12 mb-3 mb-md-0">
                                            <select id="select2" class="puzzle--select"
                                                    data-minimum-results-for-search="Infinity">
                                                <option data-display="All Locations">All Locations</option>
                                                <option value="1">Freelance</option>
                                                <option value="2">Full Time</option>
                                                <option value="3">Intership</option>
                                                <option value="4">Part Time</option>
                                                <option value="5">Temporary</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 col-sm-6 col-xs-12 mb-3 mb-md-0">
                                            <button type="button" class="crumina-button button--dark
                                                button--xl">Search</button>
                                        </div>
                                    </div>

                                </form>
                            </div>

                            <div class="tab-pane" id="candidate" role="tabpanel"
                                 aria-labelledby="candidate-tab">
                                <form class="form--search">

                                    <div class="row">
                                        <div class="col-md-4 col-sm-6 col-xs-12 mb-3 mb-md-0">
                                            <input name="name" placeholder="Keywords" type="text">
                                            <div class="c-grey fs-14">* Search keywords e.g. web design</div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12 mb-3 mb-md-0">
                                            <select id="select3" class="puzzle--select"
                                                    data-minimum-results-for-search="Infinity">
                                                <option data-display="All Specialisms">All Specialisms</option>
                                                <option value="1">Freelance</option>
                                                <option value="2">Full Time</option>
                                                <option value="3">Intership</option>
                                                <option value="4">Part Time</option>
                                                <option value="5">Temporary</option>
                                            </select>
                                            <div class="c-grey fs-14">* Filter by specialisms e.g. developer</div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12 mb-3 mb-md-0">
                                            <select id="select4" class="puzzle--select"
                                                    data-minimum-results-for-search="Infinity">
                                                <option data-display="All Locations">All Locations</option>
                                                <option value="1">Freelance</option>
                                                <option value="2">Full Time</option>
                                                <option value="3">Intership</option>
                                                <option value="4">Part Time</option>
                                                <option value="5">Temporary</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 col-sm-6 col-xs-12 mb-3 mb-md-0">
                                            <button type="button" class="crumina-button button--dark
                                                button--xl">Search</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

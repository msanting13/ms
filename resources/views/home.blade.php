@extends('layout-master')
@section('content')
    <section class="mag-posts-area d-flex flex-wrap">

        <!-- >>>>>>>>>>>>>>>>>>>>
         Post Left Sidebar Area
        <<<<<<<<<<<<<<<<<<<<< -->
        @include('templates.event-sidebar-area')

        <!-- >>>>>>>>>>>>>>>>>>>>
             Main Posts Area
        <<<<<<<<<<<<<<<<<<<<< -->
        <div class="mag-posts-content mt-30 mb-30 p-30 box-shadow">
            <!-- Feature News and Annoucements Posts Area -->
            <!-- News -->
            <div class="sports-videos-area">
                <!-- Section Title -->
                @include('news')
            </div>
        </div>

        <!-- >>>>>>>>>>>>>>>>>>>>
         Post Right Sidebar Area
        <<<<<<<<<<<<<<<<<<<<< -->
        @include('templates.announcement-sidebar-area')
    </section>
@endsection
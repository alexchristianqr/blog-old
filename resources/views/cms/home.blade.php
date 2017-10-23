@extends('layouts.cms.app')
@section('content')
    <style>
        .alert-dismissable {
            border: 1px solid #ddd;
        }
    </style>
    <div class="row">
        <div class="panel">
            <div class="panel-body">
                <div class="alert alert-info">
                    <p><b>Hi welcome</b>,</p>
                    <br>
                    <p>
                        <span>You started the session with a type of <b>({{ session('session_type_user')->name }})</b> user. In this section you will be able to visualize the user manual of a personalized administrative software created in a creative way from a chair, a table, a computer and the mind</span>
                    </p>
                </div>
                <hr>
                <div class="alert alert-dismissable">
                    <p class="text-info"><i class="fa fa-tag fa-fw"></i><b>Module Users</b></p>
                    <br>
                    <div class="form-group-lg">
                        <p>List data of Users, filters, search and more.</p>
                    </div>
                </div>
                <div class="thumbnail">
                    <img src="{{ ASSET_APP.'modulo_users.jpg' }}" alt="" width="100%" height="100%">
                </div>
                <div class="alert alert-dismissable">
                    <p class="text-info"><i class="fa fa-tag fa-fw"></i><span>Module Create New User</span></p>
                    <br>
                    <div class="form-group-lg">
                        <p>Create, Edit and Update User in Database includes validations, notifications and more.</p>
                    </div>
                </div>

                <div class="thumbnail">
                    <img src="{{ ASSET_APP.'modulo_user.jpg' }}" alt="">
                </div>
                <div class="alert alert-dismissable">
                    <p class="text-info"><i class="fa fa-tag fa-fw"></i><span>Module Posts</span></p>
                    <br>
                    <div class="form-group-lg">
                        <p>Lists Posts by authentication, filter, search and more.</p>
                    </div>
                </div>
                <div class="thumbnail">
                    <img src="{{ ASSET_APP.'modulo_posts.jpg' }}" alt="">
                </div>
                <div class="alert alert-dismissable">
                    <p class="text-info"><i class="fa fa-tag fa-fw"></i><span>Module Create New Post</span></p>
                    <br>
                    <div class="form-group-lg">
                        <p>Create, Edit and Update Post includes validations, notifications and more.</p>
                    </div>
                </div>
                <div class="thumbnail">
                    <img src="{{ ASSET_APP.'modulo_post.jpg' }}" alt="">
                </div>
                <div class="alert alert-dismissable">
                    <p class="text-info"><i class="fa fa-tag fa-fw"></i><span>Module for Tables Maintenance</span></p>
                    <br>
                    <div class="form-group-lg">
                        <p>Lists, Create, Edit and Update tables maintenance.</p>
                    </div>
                </div>
                <div class="thumbnail">
                    <img src="{{ ASSET_APP.'modulo_tablas.jpg' }}" alt="">
                </div>
            </div>
        </div>
    </div>
@endsection
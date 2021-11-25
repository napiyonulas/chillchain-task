
@extends('layouts.app')
@section('content')

            <div class="col-md-12 p-0 m-0">
                <div class="card pb-1 mb-1" style="border-radius: 0px; background-color: #00baef; color: white">
                    <div class="card-header " >
                        <div class="container">
                            <div class="col">
                                <h2 style="position: absolute; font-weight: bold; font-family: proxima-nova,Helvetica Neue,Helvetica,Arial,sans-serif;" class="my-1">Shipper List</h2>
                            </div>
                            <div class="col">
                                <c-shipper-component class="float-right"></c-shipper-component>
                            </div>
                        </div>
                    </div>
                </div>

                <datatable-component></datatable-component>

            </div>

@endsection

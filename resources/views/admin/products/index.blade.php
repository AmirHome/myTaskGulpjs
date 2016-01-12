@extends('admin.layouts.master')

@section('content')

<p>{!! link_to_route('admin.products.create', 'Add new', null, array('class' => 'btn btn-success')) !!}</p>

@if ($products->count())
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">List</div>
        </div>
        <div class="portlet-body">
            <table class="table table-striped table-hover table-responsive datatable">
                <thead>
                    <tr>
                        <th>
                            {!! Form::checkbox('delete_all',1,false,['class' => 'mass']) !!}
                        </th>
                        <th>Title</th>
                        <th>Sub Title</th>
                        <th>Page Title</th>
                        <th>Category Name</th>
                        <th>Image</th>
                        <th>Image Alt</th>
                        <th>Heading Tab1</th>
                        <th>Heading Tab2</th>
                        <th>Heading Tab3</th>
                        <th>Order</th>

                        <th>&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($products as $row)
                        <tr>
                            <td>
                                {!! Form::checkbox('del-'.$row->id,1,false,['class' => 'single','data-id'=> $row->id]) !!}
                            </td>
                            <td>{{ $row->title }}</td>
                            <td>{{ $row->sub_title }}</td>
                            <td>{{ $row->page_title }}</td>
                            <td>{{ isset($row->productcategories->title) ? $row->productcategories->title : '' }}</td>
                            <td>@if($row->image != '')<img src="{{ asset('uploads/thumb') . '/'.  $row->image }}" title="{{$row->image}}">@endif</td>
                            <td>{{ $row->image_alt }}</td>
                            <td>{{ $row->heading_tab1 }}</td>
                            <td>{{ $row->heading_tab2 }}</td>
                            <td>{{ $row->heading_tab3 }}</td>
                            <td>{{ $row->order }}</td>

                            <td>
                                {!! link_to_route('admin.products.edit', 'Edit', array($row->id), array('class' => 'btn btn-xs btn-info')) !!}
                                {!! Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'onsubmit' => 'return confirm(\'Confirm deletion\');',  'route' => array('admin.products.destroy', $row->id))) !!}
                                    {!! Form::submit('Delete', array('class' => 'btn btn-xs btn-danger')) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-xs-12">
                    <button class="btn btn-danger" id="delete">
                        Delete checked
                    </button>
                </div>
            </div>
            {!! Form::open(['route' => 'admin.products.massDelete', 'method' => 'post', 'id' => 'massDelete']) !!}
                <input type="hidden" id="send" name="toDelete">
            {!! Form::close() !!}
        </div>
	</div>
@else
    No entries found.
@endif

@endsection

@section('javascript')
    <script>
        $(document).ready(function () {
            $('#delete').click(function () {
                if (window.confirm("Are you sure?")) {
                    var send = $('#send');
                    var mass = $('.mass').is(":checked");
                    if (mass == true) {
                        send.val('mass');
                    } else {
                        var toDelete = [];
                        $('.single').each(function () {
                            if ($(this).is(":checked")) {
                                toDelete.push($(this).data('id'));
                            }
                        });
                        send.val(JSON.stringify(toDelete));
                    }
                    $('#massDelete').submit();
                }
            });
        });
    </script>
@stop
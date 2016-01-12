@extends('admin.layouts.master')

@section('content')


@if ($settings->count())
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">List</div>
        </div>
        <div class="portlet-body">
            <table class="table table-striped table-hover table-responsive datatable">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Logo</th>
                        <th>Copyright</th>
                        <th>Show Co</th>
                        <th>Email</th>
                        <th>linkedin</th>
                        <th>googleplus</th>
                        <th>twitter</th>
                        <th>Contact us email</th>
                        <th>Contact us Title</th>

                        <th>&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($settings as $row)
                        <tr>
                            <td>{{ $row->title }}</td>
                            <td>@if($row->logo != '')<img src="{{ asset('uploads/thumb') . '/'.  $row->logo }}">@endif</td>
                            <td>{{ $row->copyright }}</td>
                            <td>{{ $row->show_copyright }}</td>
                            <td>{{ $row->email }}</td>
                            <td>{{ $row->linkedin }}</td>
                            <td>{{ $row->googleplus }}</td>
                            <td>{{ $row->twitter }}</td>
                            <td>{{ $row->contact_us_email }}</td>
                            <td>{{ $row->contact_us_title }}</td>

                            <td>
                                {!! link_to_route('admin.settings.edit', 'Edit', array($row->id), array('class' => 'btn btn-xs btn-info')) !!}

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
           
            {!! Form::open(['route' => 'admin.settings.massDelete', 'method' => 'post', 'id' => 'massDelete']) !!}
                <input type="hidden" id="send" name="toDelete">
            {!! Form::close() !!}
        </div>
	</div>
@else
    No entries found.
@endif

@endsection


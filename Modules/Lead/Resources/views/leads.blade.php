<!DOCTYPE html>
<html>
<head>
    {!! isset($pdf_style) ? $pdf_style : '' !!}
</head>
<body>
    {!!isset($title) ? '<h2>'.$title.'</h2>' : '' !!}
<table id="print_code">
    <thead>
    <tr>
        <th>@lang('layout.fname')</th>
        <th>@lang('layout.lname')</th>
        <th> @lang('users.e-mail')</th>
        <th> @lang('country.country')</th>
        <th>@lang('country.country_code')</th>
        <th>@lang('layout.phone_number')</th>
        <th> @lang('layout.company')</th>
        <th>@lang('layout.position')</th>
        <th> @lang('layout.website')</th>
        <th> @lang('layout.address')</th>
        <th>@lang('layout.city')</th>
        <th>@lang('layout.state')</th>
        <th>@lang('layout.zip_code')</th>
        <th>@lang('leads.source')</th>
        
       
        <th>@lang('layout.assigned')  To</th>
       
    </tr>
    </thead>
    <tbody>
    @forelse($leads as $lead)
        <tr>
            <td>{{ clean($lead->first_name)}}</td>
            <td>{{ clean($lead->last_name) ?? ''}}</td>
            <td>{{ $lead->email ?? '' }}</td>
            <td>{{ $lead->country->name ?? '' }}</td>
            <td>{{ $lead->country->country_code ?? '' }}</td>
            <td>{{ clean($lead->phone)}}</td>
            <td>{{ clean($lead->company) }}</td>
            <td>{{clean($lead->position) }}</td>
            <td>{{ clean($lead->website) }}</td>
            <td>{{ clean($lead->address)}}</td>
            <td>{{ clean($lead->city)}}</td>
            <td>{{ clean($lead->state)}}</td>
            <td>{{ clean($lead->zip_code)}}</td>
            <td>{{ clean($lead->source->name) }}</td>
            
            <td>{{ $lead->assigned->name ?? '' }}</td>
            
        </tr>
    @empty
    @endforelse
    </tbody>
</table>

</body>
</html>
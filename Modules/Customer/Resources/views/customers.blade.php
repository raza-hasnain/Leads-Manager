<!DOCTYPE html>
<html>
<head>
    {!! isset($pdf_style) ? clean($pdf_style) : '' !!}
</head>
<body>
    {!!isset($title) ? clean($title) : '' !!}
<table  id="print_code" >
    <thead >
    <tr>
        <th >@lang('layout.name')</th>
        <th>@lang('layout.email')</th>
        <th>@lang('country.country')</th>
        <th>@lang('country.country_code')</th>
        <th>@lang('layout.phone')</th>
        <th>@lang('layout.company')</th>
        <th>@lang('layout.Vat_number')</th>
        <th>@lang('layout.website')</th>
        <th>@lang('layout.address')</th>
        <th>@lang('layout.city')</th>
        <th>@lang('layout.zip_code')</th>
    </tr>
    </thead>
    <tbody>
    @forelse($customers as $customer)
        <tr>
            <td>{{ clean($customer->name) }}</td>
            <td>{{ clean($customer->email) }}</td>
            <td>{{ $customer->country->name ?? '' }}</td>
            <td>{{$customer->country->country_code ?? '' }}</td>
            <td>{{ clean($customer->phone)}}</td>
            <td>{{ clean($customer->company) }}</td>
            <td>{{ clean($customer->vat_number) }}</td>
            <td>{{ clean($customer->website)}}</td>
            <td>{{ clean($customer->address)}}</td>
            <td>{{ clean($customer->city)}}</td>
            <td>{{ clean($customer->zip_code)}}</td>
        </tr>
    @empty
    @endforelse
    </tbody>
</table>

</body>
</html>
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
        <th>@lang('layout.name')</th>
        <th>@lang('layout.description')</th>
        <th>@lang('sales.category_name')</th> 
      
        <th>@lang('rate')</th>
       
    </tr>
    </thead>
    <tbody>
    @forelse($items as $item)
        <tr>
            <td>{{ clean($item->name)}}</td>
            <td>{{ clean($item->description)}}</td>
            <td>@if($item->item_category_id)
                {{ clean($item->item_category->name) }}
                @else N/A @endif
            </td>
           
            <td>{{ clean($item->rate) }}</td>
          
        </tr>
    @empty
    @endforelse
    </tbody>
</table>

</body>
</html>
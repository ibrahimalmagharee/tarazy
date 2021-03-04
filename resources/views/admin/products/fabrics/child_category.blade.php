


<option value="{{$child_category->id}}">

    {{ $child_category->name }}

</option>
@if ($child_category->categories)

        @foreach ($child_category->categories as $childCategory)
            @include('admin.categories.child_category', ['child_category' => $childCategory])


        @endforeach

@endif

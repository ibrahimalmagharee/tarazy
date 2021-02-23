
<option value="{{$child_category->id}}"
        @if($child_category -> id == $categories->parent_id) selected @endif>
        {{ $child_category->name }} </option>

@if ($child_category->categories)
    @foreach ($child_category->categories as $childCategory)
        @include('admin.categories.child_category_edit', ['child_category' => $childCategory])
    @endforeach
@endif

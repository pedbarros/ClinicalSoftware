
<h1>Items List</h1>

<ul>
    @foreach ($items as $item)
        <li> {{ $item->descricao }} </li>
    @endforeach
</ul>

<div>
    {{ $items->links() }}
</div>
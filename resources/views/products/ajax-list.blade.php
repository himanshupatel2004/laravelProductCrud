@forelse($products as $index => $product)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $product->name }}</td>
    <td>{{ $product->description }}</td>
    <td>₹{{ number_format($product->price, 2) }}</td>
    <td>
        <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-info">Show</a>
        <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-primary">Edit</a>
        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
            @csrf
            <input type="hidden" name="id" value="{{ $product->id }}">
            <button onclick="return confirm('Delete this product?')" class="btn btn-sm btn-danger">Delete</button>
        </form>
    </td>
</tr>
@empty
<tr><td colspan="5">No products found.</td></tr>
@endforelse

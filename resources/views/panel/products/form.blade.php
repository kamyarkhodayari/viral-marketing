<div class="mb-3">
    <label for="name">Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
</div>

<div class="mb-3">
    <label for="description">Description</label>
    <textarea name="description" class="form-control" rows="5" required>{{ old('description', $product->description) }}</textarea>
</div>

<div class="row gx-3 gy-2">
    <div class="col-lg-6">
        <label for="price">Price</label>
        <div class="input-group mb-3">
            <span class="input-group-text">€</span>
            <input type="number" name="price" class="form-control" placeholder="Price" step="any" min="0" value="{{ old('price', $product->price) }}" required>
        </div>
    </div>
    <div class="col-lg-6">
        <label for="discount">Discount</label>
        <div class="input-group mb-3">
            <span class="input-group-text">%</span>
            <input type="discount" name="discount" class="form-control" placeholder="Discount" step="1" min="0" max="100" value="{{ old('discount', $product->discount) }}" required>
        </div>
    </div>
</div>

<div class="row gx-3 gy-2">
    <div class="col-lg-6">
        <label for="stock">Stock</label>
        <input type="number" name="stock" class="form-control" step="1" min="0" value="{{ old('stock', $product->stock) }}" required>
    </div>
    <div class="col-lg-6">
        <label for="shares">Shares for discount</label>
        <input type="number" name="shares" class="form-control" step="1" min="0" value="{{ old('shares', $product->shares) }}" required>
    </div>
</div>

<hr>

<div class="table-responsive">
    <table class="table add-fields" data-af_base="#base-images tbody" data-af_target=".images">
        <thead>
            <tr>
                <th>Images</th>
                <th></th>
                <th class="align-middle">
                    <div class="d-flex justify-content-end">
                        <a href="#" class="add-form-field badge bg-success rounded-pill text-white text-decoration-none">New image</a>
                    </div>
                </th>
            </tr>
        </thead>
        <tbody class="images">
            @foreach($product->images as $image)
                <tr>
                    <input type="hidden" name="images[{{ $loop->index }}][id]" value="{{ $image->id }}">
                    <td>
                        <div class="thumbnail">
                            <a href="{{ $image->url }}" target="_blank">
                                <img src="{{ $image->url }}" alt="{{ $product->name }}">
                            </a>
                        </div>
                    </td>
                    <td class="align-middle">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="images[{{ $loop->index }}][is_cover]" value="1" id="{{ $loop->index }}_is_cover" @if($image->is_cover) checked @endif>
                            <label class="form-check-label" for="{{ $loop->index }}_is_cover">Cover</label>
                        </div>
                    </td>
                    <td class="align-middle">
                        <div class="d-flex justify-content-end">
                            <a href="#" class="remove-form-field badge bg-danger rounded-pill text-white text-decoration-none" data-target="tr">Remove</a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table id="base-images" hidden>
        <tbody>
            <tr>
                <input type="hidden" name="images[%index%][id]" value="">
                <td>
                    <input type="file" name="images[%index%][file]" class="form-control">
                </td>
                <td class="align-middle">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="images[%index%][is_cover]" value="1" id="%index%_is_cover">
                        <label class="form-check-label" for="%index%_is_cover">Cover</label>
                    </div>
                </td>
                <td class="align-middle">
                    <div class="d-flex justify-content-end">
                        <a href="#" class="remove-form-field badge bg-danger rounded-pill text-white text-decoration-none" data-target="tr">Remove</a>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>


@section('scripts')
    <script>
        console.log('Nikki');
    </script>
@append

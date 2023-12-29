@foreach ($products as $product)
    <div class="card">
        <div class="card-body">
            <a href="javascript:void(0)" id="product_add_to_cart">
                <div class="product_list_item">
                    @php
                        $images = json_decode($product->image);
                    @endphp
                    <img src="{{ asset('backend/images/product/' . $images[0]) }}" alt="{{ $product->name }}">
                    <h6>{{ $product->name }}</h6>
                    <div>
                        <span class="btn btn-sm btn-dark">{{ $product->selling_price }}</span>
                    </div>
                </div>
                <form id="product_add_to_cart_form">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="product_name" value="{{ $product->name }}">
                    <input type="hidden" name="product_unit_sale_price" value="{{ $product->unit_sale_price }}">
                    @if ($product->unit->related_unit)
                        <input type="hidden" name="product_subunit_sale_price"
                            value="{{ $product->subunit_sale_price }}">
                    @endif
                </form>
            </a>
        </div>
    </div>
@endforeach

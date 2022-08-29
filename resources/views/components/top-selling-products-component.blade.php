<div class="card bg-gradient-primary">
    <div class="card-header ui-sortable-handle" style="cursor: move;">
        <h3 class="card-title">
            <i class="fas fa-luggage-cart mr-1"></i>
            Top Selling Products
        </h3>

    </div>
    <div class="card-body">
        <table class="table table-responsive table-hover">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Sold times#</th>
                </tr>
            </thead>
            <tbody>
                @foreach (\App\MyFunc::topSellingProducts() as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ number_format($product->total) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

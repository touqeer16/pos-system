<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $cacheKey = 'products_' . md5(json_encode(request()->all()));
        return Cache::remember($cacheKey, 60, function () {
            $query = Product::with('variants', 'categories');

            // Filter by price range (min_price & max_price) - Ensure numeric values
            if (request()->filled('min_price')) {
                $query->where('price', '>=', (float) request()->input('min_price'));
            }

            if (request()->filled('max_price')) {
                $query->where('price', '<=', (float) request()->input('max_price'));
            }

            // Filter by category (category_id) - Ensure it’s an integer
            if (request()->filled('category_id')) {
                $query->whereHas('categories', function ($q) {
                    $q->where('id', request()->input('category_id'));
                });
            }

            // Filter by stock availability (in_stock = 1 for available, 0 for out of stock)
            if (request()->has('in_stock')) {
                $inStock = request()->input('in_stock') == 1 ? '>' : '=';
                $query->whereHas('variants', function ($q) use ($inStock) {
                    $q->where('stock', $inStock, 0);
                });
            }

            // Paginate results
            return $query->paginate(15)->through(function ($product) {
                $product->formatted_price = $product->formatted_price; // This will trigger the accessor
                return $product;
            });
        });
    }



    public function show($id)
    {
        try {
            $product = Product::findOrFail($id);
            return $product->load('variants', 'categories');
        } catch (\Exception $e) {
            if ($e instanceof ModelNotFoundException) {
                return response()->json([
                    'message' => 'Product not found',
                ], 404);
            }
            if ($e instanceof \Exception) {
                return response()->json([
                    'message' => 'An error occurred',
                    'error' => $e->getMessage()
                ], 400);
            }
        }
    }

    public function store(StoreProductRequest $request)
    {
        try {
            $product = Product::create($request->validated());
            // If variants are provided, create them
            if ($request->has('variants')) {
                foreach ($request->variants as $variant) {
                    $product->variants()->create($variant);
                }
            }

            // Return the product with its variants
            return response()->json($product->load('variants'), 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Product cannot be created',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function update(UpdateProductRequest $request, $id)
    {
        try {
            $product = Product::findOrFail($id);
            // Update the product details
            $product->update($request->validated());

            // Handle variants if provided
            if ($request->has('variants')) {
                foreach ($request->variants as $variantData) {
                    if (isset($variantData['id'])) {
                        // Update existing variant
                        $variant = $product->variants()->find($variantData['id']);
                        if ($variant) {
                            $variant->update($variantData);
                        }
                    } else {
                        // Create new variant
                        $product->variants()->create($variantData);
                    }
                }
            }

            // Return updated product with variants
            return response()->json($product->load('variants'), 200);
        } catch (\Exception $e) {
            if ($e instanceof ModelNotFoundException) {
                return response()->json([
                    'message' => 'Product not found',
                ], 404);
            }
            if ($e instanceof \Exception) {
                return response()->json([
                    'message' => 'An error occurred',
                    'error' => $e->getMessage()
                ], 400);
            }
        }
    }

    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->variants()->delete();
            $product->categories()->detach();
            $product->delete();

            return response()->noContent();
        } catch (\Exception $e) {
            if ($e instanceof ModelNotFoundException) {
                return response()->json([
                    'message' => 'Product not found',
                ], 404);
            }
            if ($e instanceof \Exception) {
                return response()->json([
                    'message' => 'An error occurred',
                    'error' => $e->getMessage()
                ], 400);
            }
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Feedback;

class ProductController extends Controller
{
    // Display all products
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('search')) {
            $searchTerm = strtolower($request->search);
            $query->where(function ($q) use ($searchTerm) {
                $q->whereRaw('LOWER(id) LIKE ?', ["%{$searchTerm}%"])
                    ->orWhereRaw('LOWER(name) LIKE ?', ["%{$searchTerm}%"])
                    ->orWhereRaw('LOWER(description) LIKE ?', ["%{$searchTerm}%"])
                    ->orWhereRaw('LOWER(category) LIKE ?', ["%{$searchTerm}%"]);
            });
        }

        // Apply sorting (default: id ascending)
        $sortBy = $request->get('sort_by', 'id');
        $sortDirection = $request->get('sort_direction', 'asc');
        $query->orderBy($sortBy, $sortDirection);

        $products = $query->get();

        return view('admin.products.index', compact('products'));
    }

    // Show form to create a product
    public function create()
    {
        return view('admin.products.create');
    }

    // Store a new product
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category' => 'nullable|string',
            'image_path' => 'nullable|image|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('image_path')) {
            $validated['image_path'] = $request->file('image_path')->store('images/products', 'public');
        }

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    // Show a single product
    public function show(Product $product)
    {

        return view('admin.products.show', compact('product'));
    }

    // Show form to edit product
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    // Update the product
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category' => 'nullable|string',
            'image_path' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image_path')) {
            $validated['image_path'] = $request->file('image_path')->store('images/products', 'public');
        }

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    // Delete a product
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    //Main Page
    public function home_page()
    {
        $categoryMap = [
            'Accessories' => ['attachments', 'apparel', 'gear'],
            'Parts' => ['cockpit', 'drivetrain', 'braking-system', 'wheels-tires', 'frame-fork', 'seating-area'],
            'Tools' => ['tools'],
            'Bikes' => ['mtb', 'time-trial', 'road-bike', 'gravel-bike']
        ];

        $bikeUseCaseMap = [
            'mtb' => ['off-roading', 'leisure', 'mountains', 'trails', 'commuting'],
            'road-bike' => ['racing', 'commuting', 'coastal-roads', 'smooth-pavement', 'leisure'],
            'time-trial' => ['racing', 'flat-terrain', 'coastal-roads'],
            'gravel-bike' => ['commuting', 'leisure', 'off-roading', 'mixed-terrain', 'light-trails']
        ];

        $recommended = [];
        $isLoggedIn = Auth::check();
        $userProfile = $isLoggedIn ? \App\Models\UserProfiling::where('account_id', Auth::user()->id)->first() : null;

        $expTag = null;
        $userRecommendedBikeCategory = null;
        $height = null;
        $activityType = null;
        $terrain = null;

        if ($userProfile) {
            $height = $userProfile->height;
            $expTag = '#' . strtolower(trim($userProfile->experience_level));
            $activityType = strtolower(trim($userProfile->activity_type));
            $terrain = strtolower(trim($userProfile->terrain));

            foreach ($bikeUseCaseMap as $bike => $useCases) {
                if (in_array($activityType, $useCases) || in_array($terrain, $useCases)) {
                    $userRecommendedBikeCategory = $bike;
                    break;
                }
            }
        }

        foreach ($categoryMap as $group => $subCategories) {
            $query = Product::query();
            $query->whereIn('category', $subCategories);

            $products = collect();

            if ($isLoggedIn && $userProfile) {
                $query->whereRaw('LOWER(description) LIKE ?', ["%{$expTag}%"]);

                if ($group === 'Bikes' && $userRecommendedBikeCategory) {
                    $query->where('category', $userRecommendedBikeCategory);

                    $bikeSizeTag = null;

                    if ($userRecommendedBikeCategory === 'mtb') {
                        if ($height >= 150 && $height < 160) $bikeSizeTag = '#size-26';
                        elseif ($height >= 160 && $height < 170) $bikeSizeTag = '#size-27.5';
                        else $bikeSizeTag = '#size-29';
                    } else {
                        if ($height >= 150 && $height < 160) $bikeSizeTag = '#size-xs';
                        elseif ($height >= 160 && $height < 170) $bikeSizeTag = '#size-s';
                        elseif ($height >= 170 && $height < 180) $bikeSizeTag = '#size-m';
                        elseif ($height >= 180 && $height < 185) $bikeSizeTag = '#size-l';
                        elseif ($height >= 185 && $height < 190) $bikeSizeTag = '#size-xl';
                        else $bikeSizeTag = '#size-xxl';
                    }

                    if ($bikeSizeTag) {
                        $query->whereRaw('LOWER(description) LIKE ?', ["%{$bikeSizeTag}%"]);
                    }

                    // main
                    $products = $query->inRandomOrder()->take(6)->get();

                    // fallback
                    if ($products->count() < 6) {
                        $fallback = collect();

                        foreach ($bikeUseCaseMap as $altBike => $useCases) {
                            if (
                                $altBike !== $userRecommendedBikeCategory &&
                                (in_array($activityType, $useCases) || in_array($terrain, $useCases))
                            ) {
                                $altQuery = Product::where('category', $altBike)
                                    ->whereRaw('LOWER(description) LIKE ?', ["%{$expTag}%"]);

                                if ($bikeSizeTag) {
                                    $altQuery->whereRaw('LOWER(description) LIKE ?', ["%{$bikeSizeTag}%"]);
                                }

                                $related = $altQuery->inRandomOrder()->take(6)->get();
                                $fallback = $fallback->merge($related);
                            }
                        }

                        $products = $products->merge($fallback)->unique('id')->take(6);
                    }
                } else {
                    // main (non-bike categories)
                    $products = $query->inRandomOrder()->take(6)->get();
                }
            } else {
                // main (not logged in)
                $products = $query->inRandomOrder()->take(6)->get();
            }

            while ($products->count() < 6) {
                $products->push(null);
            }

            $recommended[$group] = $products;
        }

        $latestUpdatedProducts = Product::whereIn('category', ['mtb', 'time-trial', 'road-bike', 'gravel-bike'])
            ->orderBy('updated_at', 'desc')
            ->take(3)
            ->get();

        if ($latestUpdatedProducts->isEmpty()) {
            $latestUpdatedProducts = collect([
                (object)[
                    'id' => 0,
                    'name' => 'No Products Available',
                    'description' => 'Check back later for new products',
                    'price' => 0,
                    'image_path' => 'images/products/default.jpg',
                    'category' => 'default'
                ]
            ]);
        }

        return view('welcome', compact('recommended', 'latestUpdatedProducts'));
    }


    public function shop_page()
    {
        $categoryMap = [
            'attachments',
            'apparel',
            'gear',
            'cockpit',
            'drivetrain',
            'braking-system',
            'wheels-tires',
            'frame-fork',
            'seating-area',
            'tools',
            'mtb',
            'time-trial',
            'road-bike',
            'gravel-bike'
        ];

        $productsBySubcategory = [];

        foreach ($categoryMap as $subcategory) {
            $productsBySubcategory[$subcategory] = Product::whereRaw('LOWER(category) = ?', [strtolower($subcategory)])->get();
        }

        return view('Shop', ['products' => collect($productsBySubcategory)]);
    }

    public function feedback_page(Product $product)
    {
        return view('Feedback', compact('product'));
    }
    
    public function submit_feedback(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to submit feedback.');
        }

        $request->validate([
            'comment' => 'required|string|max:1000',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePaths = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('feedback/images', 'public');
            }
        }

        \App\Models\Feedback::create([
            'account_id' => Auth::id(),
            'comment' => $request->comment,
            'image' => json_encode($imagePaths),
        ]);

        return redirect()->back()->with('success', 'Thank you for your feedback!');
    }

}

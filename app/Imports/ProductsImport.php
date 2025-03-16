<?php
namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToCollection, WithHeadingRow
{
    protected $shop_id;

    // Inject shop_id in constructor
    public function __construct($shop_id)
    {
     
        $this->shop_id = $shop_id;
    }

    // Define the collection method to process the data
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            try {
                Product::create([
                    'product_name' => $row['product_name'],
                    'product_type' => $row['product_type'],
                    'product_brand_name' => $row['product_brand_name'],
                    'product_description' => $row['product_description'] ?? null,
                    'mrp_price_of_piece' => $row['mrp_price_of_piece'],
                    'best_price_of_piece' => $row['best_price_of_piece'],
                    'Num_of_piece_one_strip' => $row['num_of_piece_one_strip'],
                    'Num_of_strip_one_pack' => $row['num_of_strip_one_pack'],
                    'stock_quantity' => $row['stock_quantity'],
                    'product_photo' => isset($row['product_photo']) ? 'uploads/products/' . $row['product_photo'] : null,
                    'shop_id' => $this->shop_id,
                ]);
            } catch (\Exception $e) {
                // Log the error or skip the row
                \Log::error("Error importing product: " . $e->getMessage());
            }
        }
    }
}

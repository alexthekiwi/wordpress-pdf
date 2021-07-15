<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Automattic\WooCommerce\Client;
use Spatie\Browsershot\Browsershot;

class ProductController extends Controller
{
    public function client()
    {
        return new Client(
            'https://romacoffee.co.nz',
            env('WP_CONSUMER_KEY'),
            env('WP_CONSUMER_SECRET'),
            ['version' => 'wc/v3']
        );
    }

    public function index()
    {
        try {
            $products = $this->client()->get("products", [
                'per_page' => 100
            ]);
        } catch (\Exception $e) {
            abort(500);
        }

        return view('products.index', compact('products'));
    }

    public function show($id)
    {
        try {
            $product = (object) $this->client()->get("products/{$id}");
        } catch (\Exception $e) {
            abort(404);
        }

        return view('products.show', compact('product'));
    }

    public function generatePdf($id)
    {
        try {
            // Get the product from the WP API
            $product = (object) $this->client()->get("products/{$id}");

            // Generate HTML for Browsershot
            $html = view('products.show', ['product' => $product])->render();

            // Filename/paths
            $fileName = $product->slug . '.pdf';
            $filePath = storage_path('/app/public/');
            $publicUrl = asset('/storage/' . $fileName);

            // Create and save the PDF
            Browsershot::html($html)
                ->setNodeModulePath(base_path('node_modules'))
                ->setNodeBinary('/Users/alex/.nvm/versions/node/v14.0.0/bin/node')
                ->margins(10, 10, 10, 10)
                ->paperSize(210, 297)
                ->save($filePath . $fileName);

            // Send the PDF back to the browser
            header('Content-type: application/pdf');
            header('Content-Disposition: inline; filename="' . $product->name . '.pdf"');
            header('Content-Transfer-Encoding: binary');
            header('Accept-Ranges: bytes');
            readfile($publicUrl);
        } catch (\Exception $e) {
            abort(500, $e->getMessage());
        }
    }
}

<?php

namespace Database\Factories;

use App\Models\BrandRecomendation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BrandRecomendation>
 */
class BrandRecomendationFactory extends Factory
{
    protected $model = BrandRecomendation::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $unsplashResponse = Http::get('https://api.unsplash.com/photos/random/', [
            'client_id' => 'H8_q4aW-ghlCoUCDQnaSvcQrIsqyoYLj6-778SfkivU',
            'query' => 'brand', 
        ]);
    
        $unsplashData = $unsplashResponse->json();
    
        $imageLink = $unsplashData['urls']['regular'];
        $image = file_get_contents($imageLink);
    
        $userName = $unsplashData['user']['name'];
        $portfolioUrl = $unsplashData['user']['portfolio_url']; 
    
        $path = uniqid() . '.jpg';
        Storage::put('brands/'.$path, $image);
    
        return [
            'id' => Str::uuid(),
            'name' => $userName,
            'image' => $path,
            'url' => $portfolioUrl,
        ];
    }
}

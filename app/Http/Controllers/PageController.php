<?php

namespace App\Http\Controllers;

use App\Models\Product;

class PageController extends Controller
{
    public function about()
    {
        return view('pages.about');
    }

    public function gallery()
    {
      
        $productImages = Product::whereNotNull('image')
            ->latest()
            ->get(['name', 'category', 'image']);

       
        $shopImages = [
    ['src' => 'https://upload.wikimedia.org/wikipedia/commons/9/91/Pizza-3007395.jpg?utm_source=en.wikipedia.org&utm_campaign=index&utm_content=original', 'caption' => 'Cheesy pepperoni pizza'],
    ['src' => 'https://www.schwartz.co.uk/-/media/project/oneweb/schwartz/recipes/recipe_image_update/march_18_2025/easy_pizza_recipe_800x800.webp?rev=217b39d7488a4aa7947174d6e475219f&vd=20250325T174436Z&extension=webp&hash=36F310B7BA2EA4491AADEC213844DF8B', 'caption' => 'Veggie loaded pizza'],
    ['src' => 'https://images.arla.com/recordid/DF1FEC6A-1E82-4435-B62EF9C786303EC2/pepperoni-pizza.jpg?format=webp&width=375&height=469&mode=crop', 'caption' => 'Extra cheese pizza slice'],
    ['src' => 'https://www.lamanna.com.au/wp-content/uploads/2025/05/LaManna-double-cheeseburger-recipe.jpg', 'caption' => 'Classic beef burger'],
    ['src' => 'https://www.amish365.com/wp-content/uploads/2025/09/amishcheeeseburger-500x500.png', 'caption' => 'Double patty cheese burger'],
    ['src' => 'https://s7d1.scene7.com/is/image/mcdonalds/PRODUCTS-HERO-WEBSITE_832x472-CheeseburgerDouble:nutrition-calculator-tile?wid=472&hei=472&dpr=off', 'caption' => 'Grilled chicken burger'],
    ['src' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR29VYNV1G86ePM3qkJSPIEEqreQWrbVr4UCr4GF_SWPgpWkqFBFZOV3dg&s=10', 'caption' => 'Chocolate overload shake'],
    ['src' => 'https://www.allrecipes.com/thmb/3JB5nGgpQciN2JcQpkYcGMUQlPo=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/Delicious-Healthy-Strawberry-Shake-Yoly-2000-7a3028d448b743ffaa7a378a53cf6376.jpg', 'caption' => 'Strawberry blast shake'],
    ['src' => 'https://www.thehungrybites.com/wp-content/uploads/2023/06/Strawberry-milkshake-frappuccino-featured.jpg', 'caption' => 'Oreo cookies & cream shake'],
    ['src' => 'https://www.butteredsideupblog.com/wp-content/uploads/2023/06/How-to-Make-a-Strawberry-Milkshake-Without-Ice-Cream-17-scaled.jpg', 'caption' => 'Chilled soft drink'],
    ['src' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRCsGlU_WkkKeI_CrEgW6aebNFimwI_J4jSjhKBrrGhmdeGT2A8q5jLQt9L&s=10', 'caption' => 'Fresh lemon iced tea'],
    ['src' => 'https://img.pikbest.com/png-images/20241029/sets-of-cold-coffee-cup-png-image_11017844.png!bw700', 'caption' => 'Refreshing cold coffee'],
];

        return view('pages.gallery', compact('productImages', 'shopImages'));
    }
}

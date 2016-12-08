<?php

class CategoriesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('category_vendor')->truncate();  
        DB::table('categories')->delete();  

		 Category::create(array('name' => 'Access Control Systems'));
		 Category::create(array('name' => 'Asphalt Maintenance & Repairs'));
		 Category::create(array('name' => 'Cabinets & Countertops'));
		 Category::create(array('name' => 'Carpet Cleaning'));
		 Category::create(array('name' => 'Cleaning Services'));
		 Category::create(array('name' => 'Concrete Products & Repair'));
		 Category::create(array('name' => 'General Contractors'));
		 Category::create(array('name' => 'Decks & Stairs'));
		 Category::create(array('name' => 'Dryer Vent Cleaning'));
		 Category::create(array('name' => 'Electrical Contractors'));
		 Category::create(array('name' => 'Elevator Services'));
		 Category::create(array('name' => 'Engineering Services'));
		 Category::create(array('name' => 'Environmental Services'));
		 Category::create(array('name' => 'Fences, Gates & Railings'));
		 Category::create(array('name' => 'Fire & Safety Equipment'));
		 Category::create(array('name' => 'Fitness Equipment'));
		 Category::create(array('name' => 'Flooring Installation & Sales'));
		 Category::create(array('name' => 'Furniture Sales, Leasing & Repair'));
		 Category::create(array('name' => 'Glass Products & Services'));
		 Category::create(array('name' => 'Golf Carts'));
		 Category::create(array('name' => 'Hauling'));
		 Category::create(array('name' => 'HVAC - Heating, Ventilation & Air'));
		 Category::create(array('name' => 'Interior Design Services'));
		 Category::create(array('name' => 'Landscaping Services'));
		 Category::create(array('name' => 'Laundry Equipment Sales / Leasing / Servicing'));
		 Category::create(array('name' => 'Lighting Systems & Fixtures'));
		 Category::create(array('name' => 'Locksmiths'));
		 Category::create(array('name' => 'Marketing - Promotional Items'));
		 Category::create(array('name' => 'Mold Services'));
		 Category::create(array('name' => 'Moving Companies'));
		 Category::create(array('name' => 'Odor Removal'));
		 Category::create(array('name' => 'Office Equipment & Services'));
		 Category::create(array('name' => 'Paint Manufacturers, Supplies & Services'));
		 Category::create(array('name' => 'Patio Furniture & Repair'));
		 Category::create(array('name' => 'Pest Control'));
		 Category::create(array('name' => 'Pet Waste Dispenser'));
		 Category::create(array('name' => 'Photography'));
		 Category::create(array('name' => 'Plumbing'));
		 Category::create(array('name' => 'Power Washing'));
		 Category::create(array('name' => 'Printing & Copying'));
		 Category::create(array('name' => 'Property Inspections'));
		 Category::create(array('name' => 'Rain Gutters'));
		 Category::create(array('name' => 'Recycling'));
		 Category::create(array('name' => 'Refinishing Bathtubs & Countertops'));
		 Category::create(array('name' => 'Roofing'));
		 Category::create(array('name' => 'Security'));
		 Category::create(array('name' => 'Sewer Services'));
		 Category::create(array('name' => 'Siding'));
		 Category::create(array('name' => 'Signs'));
		 Category::create(array('name' => 'Staffing Services'));
		 Category::create(array('name' => 'Swimming Pool Repair & Service'));
		 Category::create(array('name' => 'Towing Companies'));
		 Category::create(array('name' => 'Tree Services'));
		 Category::create(array('name' => 'Utility Billing & Management'));
		 Category::create(array('name' => 'Waste Management'));
		 Category::create(array('name' => 'Water / Fire Damage Restoration'));
		 Category::create(array('name' => 'Window Coverings'));
        

    }
}
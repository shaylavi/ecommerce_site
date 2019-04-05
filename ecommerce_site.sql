-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2019 at 06:55 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce_site`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryID` int(11) NOT NULL,
  `Title` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryID`, `Title`) VALUES
(1, 'Toiletries'),
(2, 'Clothes'),
(3, 'Kitchenware'),
(4, 'Bags'),
(5, 'Bamboo');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ProductID` int(11) NOT NULL,
  `Title` varchar(30) NOT NULL,
  `Description` varchar(700) NOT NULL,
  `Stock` int(11) NOT NULL,
  `Price` decimal(10,0) NOT NULL,
  `Image` varchar(50) NOT NULL,
  `ImageAlt` varchar(50) NOT NULL,
  `CategoryID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductID`, `Title`, `Description`, `Stock`, `Price`, `Image`, `ImageAlt`, `CategoryID`) VALUES
(1, 'Boody', 'Designed to make you push even harder, our Men\'s Active Sports Sock takes you that step further. Our unique bamboo blend naturally inhibits odour-causing bacteria so you stay fresh while working out.', 5, '10', 'Men_s-Active-Sports-Sock-White-Side.jpg', 'Bamboo socks', 5),
(2, 'StepOne', 'Best suited for guys with thicker legs 3D Comfort Pouch - Keeps everything contained for maximum support Ultra Glide Lycra - Ride up resistant panels prevent leg ride Super Soft Bamboo - Designed for all day wear 95% Bamboo, 5% Elastane', 5, '29', 'bamboo-underwear.jpg', 'Bamboo underwear', 5),
(3, 'Eco Bamboo & Charcoal Toothbru', 'Biodegradable, Bamboo Toothbrush Soft, Charcoal Bristles Made from MOSO sustainable bamboo Free Shipping in Aus on orders over AU $50.00', 4, '5', 'eco-bamboo-toothbrush.jpg', 'Eco Bamboo & Charcoal Toothbrush', 5),
(4, 'Cutlery set', 'A sustainable and convenient alternative to single-use plastic cutlery while out and about. Keep this handy set in your bag, backpack, car or lunch bag.', 5, '13', 'ever-eco-cutlery-set.jpg', 'cutlery', 5),
(5, 'Drinking bottle', 'Keep your body and the environment clean by using this stylishly eco-friendly water bottle from the Bamboo Bottle Company™.', 5, '25', 'bamboo-drink-bottle.jpg', 'Drinking bottle', 5),
(6, 'Eco Friendly Bamboo Dog Collar', 'Wagging Green Eco-Friendly Dog Wear - Soft, Strong, and Hypoallergenic - Good for the earth, Great for your Pet', 5, '18', 'dog-collar.jpg', 'Dog collar', 5),
(7, 'PANDA Bamboo Sunglasses', 'Mens Polarized Sunglasses Floating Handmade Bamboo Glasses for Fishing - UV400 Protection with Gift Box', 5, '25', 'sunglasses.jpg', 'Sunglasses', 5),
(8, 'EcoSouLife Bamboo Camper Set L', 'Reusable & Biodegradable Camping Set Made from Vegetable Matter Heat-resistant up to 120c', 5, '25', 'camper-set-large', 'Camper Set Large', 5),
(9, 'Bass Brushes Bamboo Comb Pocke', 'Bass brushes and combs are professional quality and made from bamboo, which is an 100% renewable resource. Daily brushing with Bass combs and natural bristle brushes will improve the condition of your hair. Naturally antibacterial and lightweight', 5, '12', 'pocket-size-comb.png', 'Pocket size comb', 5),
(10, 'Bamboo Jug Blue', 'Bamboo Jug Blue', 5, '30', 'bamboo-jug.jpg', 'Bamboo Jug', 5),
(11, 'Silent Down Jacket', 'Shell is made from polyester taffeta (70% recycled) with mechanical stretch and a DWR finish to shed light rain and snow', 3, '240', 'brown-jacket.jfif', 'Brown Jacket', 2),
(12, 'TECA FULL-ZIP WINDBREAKER', 'We use 100% remnant fabric to build each jacket, which means that material that might have gone to the landfill gets a second chance to shine. And since Teca uses smaller runs of fabric, each color is limited edition; when they’re gone, they’re gone!', 5, '80', 'teca_fullzip_iceice_front.jpg', 'Red and Blue full zip windbreaker', 2),
(13, 'tentree Juniper T-Shirt', 'Offering a soft, lightweight feel, 160g/sm sustainable TENCEL tri-blend jersey comes from tree pulp that\'s been dissolved in a nontoxic, organic solvent', 12, '39', 'tentree-juniper-t-shirt.jfif', 'tentree Juniper T-Shirt ', 2),
(14, 'Picture Organic Moder Fleece J', 'Its fleece comes from completely recycled material, and it wicks moisture and dries quickly to keep you cozy when you\'re wearing it as a midlayer on the mountain.', 4, '80', 'picture-organic-fleece-jacket.jpg', 'Picture Organic Moder Fleece Jacket', 2),
(15, 'Ex Eco Insulated Shell', 'Waterproof/breathable fully seam sealed. Textile made from 100% recycled polyester. Insulation made from 100% recycled polyester. Trims contain 100% recycled content (Toggle, washer, phemo, eyelet, labels, webbing, zippers, thread).', 3, '140', 'ex-eco-insulated-shell.png', 'Ex Eco Insulated Shell', 2),
(16, 'Cushion Merino Hiking Socks', 'These Medium Cushion Hiking Socks are made with sustainable merino wool which makes them naturally odor-resistant. They are blended with recycled polyester which gives them extra durability and stretch. The polyester is made from plastic drinks bottles, and the regenerated polyamide is made from commercial fishing nets.', 11, '22', 'teko-sock.jpeg', 'Cushion Merino Hiking Socks', 2),
(17, 'Aku Bellamont Plus Hiking Shoe', '99% of the materials used to manufacture the shoes come from Europe — where the shoes are made. And at only 470g you’ll literally be reducing your carbon footprint in these lightweight hiking shoes.', 6, '65', 'Aku-hiking-shoes.jpg', 'Aku Bellamont Plus Hiking Shoes', 2),
(18, 'Econscious Recycled Trucker Ha', 'We have created a trucker hat that is not only made from recycled polyester, but is also affordable. Plus, it’s great looking and available in four stylish colours. Econscious also create organic cotton t-shirts and sweatshirts blended with recycled polyester for wholesale distribution.', 7, '33', 'green-cap.jpg', 'Econscious Recycled Trucker Hat', 2),
(19, 'ORGANIC CLOTHING Luna Insulate', 'A mountain-ready jacket that\'s made for the coldest days, the women\'s PICTURE ORGANIC CLOTHING Luna insulated jacket offers weatherproof protection and bio-based insulation to keep you cozy and dry. Made from 58% recycled polyester', 2, '200', 'luna-insulated-jacket.jfif', 'Luna Insulated Jacket', 2),
(20, 'Organic Wool Holiday Snuggle S', 'Maggie\'s Organic Holiday Wool Snuggle Socks feature whimsical winter-themed designs that are perfect for the holiday season! Made from Soft Organic Merino Wool with a thick cushion throughout the sock, your feet will keep on stepping in comfort.', 15, '20', 'polar-bear-organic-wool-snuggle-sock.jpg', 'Organic Wool Holiday Snuggle Sock', 2),
(21, 'Eco Max Non Stick Pan Brush', 'This sustainable, environmentally friendly pan brush is biodegradable and perfect for the kitchen as an all round cleaning and dishes scrub.', 5, '16', 'stick-pan-brush.jpg', 'Eco Max Non Stick Pan Brush', 3),
(22, 'Agreena 3 in 1 Eco Kitchen Wra', 'Agreena 3-in-1 Wraps are made from 100% pure silicone, with no fillers. Silicone is a rubber that contains oxygen bonded with silicon, a natural element that is abundant in sand and rock. Food grade silicone is known for its heat-resistant and rubber-like qualities and is safe for the oven, microwave, fridge, and freezer. ', 4, '13', 'agreena-cling-wrap.jpg', 'Agreena 3 in 1 Eco Kitchen Wrap', 3),
(23, 'Cheeki Insulated Smoothie Tumb', 'Cheeki are proudly Australian and focus on environmentally responsible, reusable products that are healthy and fun. Cheeki’s wide range is suitable for all seasons and includes coffee cups, water bottles, insulated bottles, food jars and more. ', 3, '34', 'cheeki-insulated-mug.jpg', 'Cheeki Insulated Smoothie Tumbler ', 3),
(24, 'Green + Kind Organic Cotton Pr', 'This net bag is ideal to carry your fruit and veg in the bulk food shop, supermarket or grocers and, being cotton, it is breathable too! Made from Certified Organic Cotton with a drawstring close. They are also great to use as a laundry bag and toiletry bag for on flights.', 22, '8', 'fruit-bag.jpg', 'Green + Kind Organic Cotton Produce Bag Net', 3),
(25, 'FinalStraw Collapsible Travel ', 'This badass little straw is a convenient, durable alternative to the single-use plastic straw, using long-lasting materials like stainless steel and food-grade silicone... not wasteful plastic.', 3, '26', 'FinalStraw-Collapsible-Travel-Straw-Shark-Butt-Gra', 'FinalStraw Collapsible Travel Straw', 3),
(26, 'Avocado Food Huggers', '30-40% of all the groceries you purchase get thrown in the trash, Avocado Food Huggers are specially designed to combat browning avocados,', 6, '9', 'food-huggers-avocado-food-huggers-2-pk-1.jpg', 'Avocado Food Huggers', 3),
(27, 'Travel Metal Spork', 'It\'s the perfect alternative to plastic silverware made from 100% stianless steel and it\'s dishwasher safe.', 12, '7', 'EcoLunchbox-Travel-Stainless-Steel-Spork-1.jpg', 'Travel Metal Spork', 3),
(28, 'Clean Deodorant Paste Travel S', 'Each deodorant is packaged in a recyclable aluminium tin. Good + Clean is an Aussie brand focused on creating ethical, sustainable products with good packaging.', 7, '14', 'nerolina_deodorant_creme.jpg', 'Clean Deodorant Paste Travel Size - Nerolina (30g)', 3),
(29, 'Stainless Steel Rectangle Cont', 'The ECOlunchbox Solo Rectangle is your go-to container for all things lunch. This 100% stainless steel container is a plastic-free alternative for sandwich storage or salad snacking.', 2, '25', 'EcoLunchbox-Stainless-Steel-Rectangle-Container-1.', 'Stainless Steel Rectangle Container', 3),
(30, 'Ribbed Molded Bamboo® 4 Piece ', 'These ribbed Molded Bamboo® mixing bowls can replace toxic plastic bowls for good. They\'re small, stackable, and made from bamboo and other natural fibers', 4, '20', '4pc-Small-Bowls-_-Lids-Mixed-Colors.jpg', 'Ribbed Molded Bamboo® 4 Piece Small Bowls and Lids', 3),
(31, 'tentree Eco-Friendly Backpack', 'This sustainable apparel brand is kicking goals on many fronts: tentree holds a B Corp certification which is evidence of the brand’s high standards of social and environmental performance; it plants ten trees for every item purchased and aims to plant 1 billion trees by 2030 ', 4, '45', 'Ten-Tree-ethical-school-backpacks-sustainable.jpg', 'tentree Eco-Friendly Backpack', 4),
(32, 'Tale of the Future Rolltop Bac', 'Made of 100% canvas and is lined and filled with completely natural fibres such as cotton and jute. It is also coloured with AZO-free dyes and features adjustable shoulder straps, internal and external pockets and a 6? compartment for your laptop. ', 8, '35', 'Ethical-Canvas-Vegan-Backpack.jpg', 'Tale of the Future Rolltop Backpack', 4),
(33, 'Hudderton Canvas Backpack', '100% organic waxed cotton canvas, padded straps for comfort, vegetable tanned leather bottom to withstand wear and tear, and a water bottle sleeve.', 3, '75', 'United-By-Blue-Hudderton-Eco-Friendly-Ethical-Back', 'Hudderton Canvas Backpack', 4),
(34, 'EST WST Ethical Backpack', 'The sustainably-made backpack features chemical and pesticide free materials such as organic canvas and organic cotton lining, recycled waterproof lining, vegetable-tanned leather, and incorporates expert techniques from artisan weavers and American garment workers.', 2, '130', 'Est-West-Organic-cotton-ethical-backpack-knapsack-', 'EST WST Ethical Backpack', 4),
(35, 'Cotinga 25L Pack', 'From investment in research and development in microfibre pollutions, the use of innovative eco-friendly fabrics such as REPREVE a material made from recycled plastic content, through to shifting to a circular economy to minimise unnecessary waste', 5, '60', 'Kathmandu-Cotinga-Eco-Friendly-Backpack-for-school', 'Cotinga 25L Pack', 4),
(36, 'TUMI Recycled Capsule', ' TUMI launched its Recycled Capsule collection which features backpacks that are exceptionally designed, externally and internally. Featuring post-consumer recycled bottles and post-industrial recycled nylon', 0, '650', 'TUMI-eco-friendly-backpack-school-work.jpg', 'TUMI Recycled Capsule', 4),
(37, 'WAYKS Day Backpack', ' Impeccably designed, the backpacks are made from polyester fabric derived from recycled PET bottles and manufactured in a Fair Wair Foundation recognised factory in Vietnam.', 2, '295', 'WAYKS-sustainable-backpacks-for-school-and-work-73', 'WAYKS Day Backpack', 4),
(38, 'Baggu Drawstring Backpack', 'Baggu‘s canvas drawstring backpacks are cruelty-free and made from 65% recycled canvas. The brand audits the factories each year to ensure it complies with high labour standards.', 7, '42', 'Baggu-ethical-backpack-made-from-65-recycled-canva', ' Baggu Drawstring Backpack', 4),
(39, 'G-1000 HeavyDuty Eco', 'Made of high-quality such as G-1000 HeavyDuty Eco a specially-made fabric blend of 65% polyester, 35% cotton that is durable. All materials used are stress-tested for climactic elements, environmental impacts and wear and tear.', 3, '134', 'Fjallraven-Foldsack-Ethically-produced-backpack.jp', 'G-1000 HeavyDuty Eco', 4),
(40, 'Millican Sustainable Backpacks', 'Made from a hardy material called Bionic, a fabric blend featuring 38% cotton, 57% recycled polyester, 5% high-tenacity polyester, 100% paraffin wax impregnated, lined with 100% recycled polyester and leather trim.', 2, '178', 'Millican-The-Mavericks-Eco-Friendly-Backpack-Ethic', 'Millican Sustainable Backpacks', 4),
(41, 'Onira Organics', 'Aloe Vera and calendula flower extracts lend a gentle, natural scent. If your hair has been damaged by heat or dyes, or if your hair is simply prone to tangling, then this may be the perfect all-natural shampoo for you.  ', 3, '35', 'onira-organics.jpg', 'Onira Organics', 1),
(42, 'Biome Shampoo Soap Bar 110g', 'A gentle and nourishing shampoo and body bar, by Biome. Handmade in Australia from natural ingredients, this bar adds volume and shine to hair and moisturises skin, and it doesn\'t impact the planet. Zero waste, long lasting, and easy to use. 110g.', 9, '12', 'biome-shampoo-soap-bar-110g.jpg', 'Biome Shampoo Soap Bar 110g', 1),
(43, 'Biome Divine Shave Soap in Tin', 'Shave soap packaged in a reusable tin, by Biome. Handmade in Australia from all natural ingredients, treat your skin to a moisturising and protective, divine lather without impacting the planet. Zero waste, long lasting, and easy to use. 120g.', 7, '18', 'biome-shave-soap-in-tin-120g.jpg', 'Biome Divine Shave Soap in Tin 120g', 1),
(44, 'Biome 100% Jojoba Oil Australi', 'Purely cold pressed high quality jojoba oil grown in Queensland without pesticides. Super multi-purpose as a daily cleanser, moisturiser, carrier oil, hair conditioner, bath oil. Absorbed easily. Non greasy. Especially good for eczema and psoriasis.   Use together with Biome\'s multi-tasking skin care range.', 6, '23', 'biome-jojoba-oil-australian.jpg', 'Biome 100% Jojoba Oil Australian 100ml', 1),
(45, '100% Hemp Seed Oil Certified O', 'Purely raw, cold pressed high quality hemp seed oil grown in Queensland. Nourishing and moisturising for both the skin and hair. Hemp seed oil is high in omega fatty acids which helps create a protective barrier. Anti-inflammatory and healing for scars and acne. Doesn’t clog pores. Use together with Biome\'s multi-tasking skin care range.', 4, '24', 'biome-hemp-oil-organic.jpg', '100% Hemp Seed Oil Certified Organic Australian 10', 1),
(46, 'Dr. Bronner\'s Toothpaste 140g ', 'Low-foaming formula with no synthetic detergent foaming agents, fluoride-free, vegan and cruelty-free, no artificial colors, flavors, preservatives, or sweeteners. With organic ingredients like Coconut oil, Coconut flour and Peppermint oil, this all-in-one toothpaste will freshen breath, whiten teeth and reduce plaque.  140g.', 3, '13', 'dr-bronner-s-toothpaste-140g-peppermint-.jpg', 'Dr. Bronner\'s Toothpaste 140g - Peppermint', 1),
(47, 'Bamboo cotton buds (pack of 20', 'Biodegradable cotton buds that feature a bamboo stick. Bamboo cotton buds are a  sustainable alternative to plastic cotton buds, they are compostable & 100% biodegradable. Ideal for makeup application and removal and cleaning small areas. Pack of 200 bamboo cotton buds.', 12, '8', 'bamboo-cotton-buds-pack-of-200.jpg', 'Bamboo cotton buds (pack of 200)', 1),
(48, 'Black Chicken Remedies Axilla ', 'Black Chicken Remedies Axilla natural deodorant paste neutralises odour and minimises wetness without the use of aluminium, alcohol or harmful chemicals. Black chicken Invisible after application.', 6, '19', 'black-chicken-remedies-axilla-deodorant-paste-75g.', 'Black Chicken Remedies Axilla Deodorant', 1),
(49, 'Miessence Organic Natural Deod', 'Natural deodorant will help you stay naturally fresh all day. We\'ve found this to be one of the most effective natural deodorant on the market today. Unisex scent. 70ml.', 12, '11', 'miessence-natural-deodorant-ancient-spice.jpg', 'Miessence Organic Natural Deodorant - Ancient Spic', 1),
(50, 'Earths Purities Ladies Natural', 'Natural deodorant for harsh climates, long lasting, safe and luxurious on the skin. Lower bicarb soda content for sensitive skins.  Essential oils provide anti-bacterial properties without synthetic perfumes. Plastic-free packaging.', 7, '17', 'earths-purities-ladies-natural-deodorant-tub.jpg', 'Earths Purities Ladies Natural Deodorant Paste', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- Mens

-- Sneakers
INSERT INTO products (product_id, name, description, details, price, sale_price, category, segment, colour, created_at)
VALUES (NULL, 'Nike Legend Essential 2',
'The Nike Legend Essential 2 comes equipped with a flat, stable heel, flexibility under the toes and side-to-side support. With tons of grip, you are ready to lift, HIIT, conquer a class or get stronger on the machines.',
'Country/Region of Origin: Indonesia', '99.00', NULL, 'Sneakers', 'Men', 'Pure Platinum', CURRENT_TIMESTAMP);

INSERT INTO products (product_id, name, description, details, price, sale_price, category, segment, colour, created_at)
VALUES (NULL, 'Nike Air Force 1 07 LV8',
'Comfortable, durable and timeless—it is number 1 for a reason. The classic 80s construction pairs with bold details for style that tracks whether you are on court or on the go.',
'Country/Region of Origin: Indonesia', '205.00', NULL, 'Sneakers', 'Men', 'Pure Platinum', CURRENT_TIMESTAMP);

-- Running
INSERT INTO products (product_id, name, description, details, price, sale_price, category, segment, colour, created_at)
VALUES (NULL, 'Nike Pegasus 41 GORE-TEX',
'Responsive cushioning in the winterized Pegasus provides an energised ride for wet-weather road running. Experience lighter-weight energy return with dual Air Zoom units and a ReactX foam midsole. Plus, a waterproof GORE-TEX upper and reflective design details throughout help you comfortably take on the elements.',
'•Waterproof GORE-TEX upper and technical mesh help keep water out so your feet dry.|
•ReactX foam midsole surrounds forefoot and heel Air Zoom units for an energised ride.|
•Storm Tread outsole provides traction in wet weather.|
•Heathered material around the collar helps keep your ankle warm.|
•All-new ReactX foam midsole is 13% more responsive than previous React technology.|
•Crafted for performance and planet, ReactX foam is engineered to reduce its carbon footprint by at least 43% in a pair of midsoles due to reduced manufacturing process energy compared with prior React foam. The carbon footprint of ReactX is based on cradle-to-gate assessment reviewed by PRé Sustainability B.V. and Intertek China. Other midsole components such as airbags, plates or other foam formulations were not considered.|
•Reflective design GORE-TEX logo and Swoosh logo|
•Reflective design graphics and overlays|
•Not intended for use as personal protective equipment (PPE)|
•Weight: approx. 297g (mens size 9)|
•Heel-to-toe drop: 10mm|
•MR-10 last—our best, most consistent fit (same as Pegasus 40)|
•Plush collar, tongue and sockliner|
•Country/Region of Origin: Vietnam',
'249.00', NULL, 'Running', 'Men', 'Summit White', CURRENT_TIMESTAMP);

INSERT INTO products (product_id, name, description, details, price, sale_price, category, segment, colour, created_at)
VALUES (NULL, 'Nike Run Swift 3',
'Whatever the run, the Swift 3 will be there with undying support and devotion. It can help you get out the door for an easy 3 at the end of the day or an intense 2-mile there-and-back with a modified design that iss supportive, durable and all-round comfortable. They will help you conquer short distances, sure, but also get you from point A to point B as you navigate the ever-changing rhythms of everyday life.',
'•Foam cushioning delivers a soft underfoot feel. A higher foam height gives you a plush sensation with every step.|
•Flywire cables help secure your feet and provide support when you tighten the laces, so you can stay stable.|
•Heel overlay for added security|
•Mesh by the toe for breathability|
•Flex grooves on rugged rubber outsole for flexibility|
•Country/Region of Origin: Vietnam', '119.00', NULL, 'Running', 'Men', 'Black', CURRENT_TIMESTAMP);

-- Slides
INSERT INTO products (product_id, name, description, details, price, sale_price, category, segment, colour, created_at)
VALUES (NULL, 'Jordan Post',
'Quick, comfy, cool. These slides are made from robust, flexible foam that will stay secure as you rack up those steps. Wide foot coverage holds your feet in place while the asymmetrical design gives you a distinct look.',
'•Foam platform provides lightweight, durable cushioning.|
•Flexible, textured outsole gives you ample everyday traction.|
•Country/Region of Origin: Vietnam',
'49.00', NULL, 'Slides', 'Men', 'Football Grey', CURRENT_TIMESTAMP);

INSERT INTO products (product_id, name, description, details, price, sale_price, category, segment, colour, created_at)
VALUES (NULL, 'Nike Air More Uptempo',
'Keeping the graffiti-styled graphics from the original, your favourite hoops look gets transformed into slides. The Air More Uptempo combines Nike Air cushioning and a plush strap with airy perforations, providing breathable comfort you can slip on and go.',
'•A padded strap with perforations feels plush and airy.|
•Visible Nike Air technology provides cushioning with every step.|
•The foam footbed is contoured to help keep your foot in place.|
•Durable rubber outsole features the grip pattern from the original Uptempo.|
•Foam midsole|
•Rubber outsole|
•Country/Region of Origin: Vietnam',
'145.00', NULL, 'Slides', 'Men', 'Flax', CURRENT_TIMESTAMP);

-- Images

-- Mens

-- Sneakers
INSERT INTO images (image_id, product_id, image_url)
VALUES (NULL, SELECT product_id from products WHERE name = 'Nike Legend Essential 2', 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/0c947911-ed90-49c6-a1fd-f6de3798114f/NIKE+LEGEND+ESSENTIAL+2.png');

INSERT INTO images (image_id, product_id, image_url)
VALUES (NULL, SELECT product_id from products WHERE name = 'Nike Legend Essential 2', 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/1693eda6-6808-4d66-a855-94e83fe8ff64/NIKE+LEGEND+ESSENTIAL+2.png');

INSERT INTO images (image_id, product_id, image_url)
VALUES (NULL, SELECT product_id from products WHERE name = 'Nike Legend Essential 2', 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/2482c899-aa71-42e5-8861-7604fdcd0b60/NIKE+LEGEND+ESSENTIAL+2.png');

INSERT INTO images (image_id, product_id, image_url)
VALUES (NULL, SELECT product_id from products WHERE name = 'Nike Legend Essential 2', 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/fd2c284c-613a-4e3a-b4b9-a74005f59511/NIKE+LEGEND+ESSENTIAL+2.png');

INSERT INTO images (image_id, product_id, image_url)
VALUES (NULL, SELECT product_id from products WHERE name = 'Nike Air Force 1 07 LV8', 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/7db556e8-e9e8-4a30-a577-099be6e215e5/AIR+FORCE+1+%2707+LV8.png');

INSERT INTO images (image_id, product_id, image_url)
VALUES (NULL, SELECT product_id from products WHERE name = 'Nike Air Force 1 07 LV8', 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/ff3c2df3-476d-4054-bbea-0ab07db6c771/AIR+FORCE+1+%2707+LV8.png');

INSERT INTO images (image_id, product_id, image_url)
VALUES (NULL, SELECT product_id from products WHERE name = 'Nike Air Force 1 07 LV8', 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/a7d721f4-f65f-418f-bd27-865b96c4c4f7/AIR+FORCE+1+%2707+LV8.png');

INSERT INTO images (image_id, product_id, image_url)
VALUES (NULL, SELECT product_id from products WHERE name = 'Nike Air Force 1 07 LV8', 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/6251aea6-6c0d-4cc3-bfe3-319c886e54e6/AIR+FORCE+1+%2707+LV8.png');


-- Running
INSERT INTO images (image_id, product_id, image_url)
VALUES (NULL, SELECT product_id from products WHERE name = 'Nike Pegasus 41 GORE-TEX', 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/de7f0b98-d4ba-44ee-9373-6b9d086b4843/AIR+ZM+PEGASUS+41+GTX.png');

INSERT INTO images (image_id, product_id, image_url)
VALUES (NULL, SELECT product_id from products WHERE name = 'Nike Pegasus 41 GORE-TEX', 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/da3d88f3-c9d2-41f8-a0e2-b887c7833f30/AIR+ZM+PEGASUS+41+GTX.png');

INSERT INTO images (image_id, product_id, image_url)
VALUES (NULL, SELECT product_id from products WHERE name = 'Nike Pegasus 41 GORE-TEX', 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/71bc4d61-e0ea-4d4a-a955-a24b0457d757/AIR+ZM+PEGASUS+41+GTX.png');

INSERT INTO images (image_id, product_id, image_url)
VALUES (NULL, SELECT product_id from products WHERE name = 'Nike Pegasus 41 GORE-TEX', 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/5a9b4ba7-823d-437f-a0af-bbb2ef7664a9/AIR+ZM+PEGASUS+41+GTX.png');

INSERT INTO images (image_id, product_id, image_url)
VALUES (NULL, SELECT product_id from products WHERE name = 'Nike Run Swift 3', 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/a0f44d90-7581-4ada-b7e7-44c57cc3f0d8/NIKE+RUN+SWIFT+3.png');

INSERT INTO images (image_id, product_id, image_url)
VALUES (NULL, SELECT product_id from products WHERE name = 'Nike Run Swift 3', 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/c5036d4d-2773-4236-86d4-d96a3deead84/NIKE+RUN+SWIFT+3.png');

INSERT INTO images (image_id, product_id, image_url)
VALUES (NULL, SELECT product_id from products WHERE name = 'Nike Run Swift 3', 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/bb19616e-aed1-4720-8778-3ef2bbb13836/NIKE+RUN+SWIFT+3.png');

INSERT INTO images (image_id, product_id, image_url)
VALUES (NULL, SELECT product_id from products WHERE name = 'Nike Run Swift 3', 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/be3dddc9-e6e4-43c6-abfb-af172c49b95e/NIKE+RUN+SWIFT+3.png');

-- Slides
INSERT INTO images (image_id, product_id, image_url)
VALUES (NULL, SELECT product_id from products WHERE name = 'Jordan Post', 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco,u_126ab356-44d8-4a06-89b4-fcdcc8df0245,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/a5b8115e-03ff-4319-af5e-26ad829598c1/JORDAN+POST+SLIDE.png');

INSERT INTO images (image_id, product_id, image_url)
VALUES (NULL, SELECT product_id from products WHERE name = 'Jordan Post', 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco,u_126ab356-44d8-4a06-89b4-fcdcc8df0245,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/3b1236be-5e8a-409b-bbf5-49f4c8c23a2d/JORDAN+POST+SLIDE.png');

INSERT INTO images (image_id, product_id, image_url)
VALUES (NULL, SELECT product_id from products WHERE name = 'Jordan Post', 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco,u_126ab356-44d8-4a06-89b4-fcdcc8df0245,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/3038d2f9-fb85-49dc-9271-fe94d93deaae/JORDAN+POST+SLIDE.png');

INSERT INTO images (image_id, product_id, image_url)
VALUES (NULL, SELECT product_id from products WHERE name = 'Jordan Post', 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco,u_126ab356-44d8-4a06-89b4-fcdcc8df0245,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/80cdfe40-4ed8-403b-beeb-447796d44715/JORDAN+POST+SLIDE.png');

INSERT INTO images (image_id, product_id, image_url)
VALUES (NULL, SELECT product_id from products WHERE name = 'Nike Air More Uptempo', 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/482d00c9-54c9-477c-a568-af731014e6a4/AIR+MORE+UPTEMPO+SLIDE.png');

INSERT INTO images (image_id, product_id, image_url)
VALUES (NULL, SELECT product_id from products WHERE name = 'Nike Air More Uptempo', 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/46416e01-fe20-4701-a4a1-0442f720d7c3/AIR+MORE+UPTEMPO+SLIDE.png');

INSERT INTO images (image_id, product_id, image_url)
VALUES (NULL, SELECT product_id from products WHERE name = 'Nike Air More Uptempo', 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/b3ae099f-6f33-4f53-a765-ad09acbbb361/AIR+MORE+UPTEMPO+SLIDE.png');

INSERT INTO images (image_id, product_id, image_url)
VALUES (NULL, SELECT product_id from products WHERE name = 'Nike Air More Uptempo', 'https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/4f6ba847-871d-4f2c-9432-76d576220f05/AIR+MORE+UPTEMPO+SLIDE.png');

INSERT INTO Products VALUES (
  NULL,
  "Nike Pegasus 41 Premium",
  "Responsive cushioning in the Pegasus provides an energised ride for everyday road running. Experience lighter-weight energy return with dual Air Zoom units and a ReactX foam midsole. Plus, improved engineered mesh on the upper decreases weight and increases breathability.",
  "Weight: approx. 251g (Women's size 5.5)|Heel-to-toe drop: 10mm|MR-10 last—our best, most consistent fit (same as Pegasus 40)|Reflective design details|Not intended for use as personal protective equipment (PPE)|Country/Region of Origin: China",
  229,
  NULL,
  "Running",
  "Women",
  "Ivory",
  DEFAULT
),(
  NULL,
  "Nike Interact Run",
  "Can you see the future? Fast-forward your footsteps in the cutting-edge Nike Interact Run. It's set up with all the running goodness you need: a lightweight Flyknit upper, soft foam midsole and comfort where it counts. Scan the QR code on the tongue with your phone, and check out our online introduction to the Nike Interact Run's ins and outs.",
  "Country/Region of Origin: Indonesia",
  135,
  NULL,
  "Running",
  "Women",
  "Pale Blue",
  DEFAULT
),(
  NULL,
  "Nike Calm",
  "Enjoy a calm, comfortable experience—wherever your day off takes you. Made from soft yet responsive foam, these lightweight slides are easy to style and easy to pack. While the water-friendly design makes them ideal for the beach or pool, the minimalist look is elevated enough to wear around the city. Time to slide in and check out.",
  "Country/Region of Origin: Indonesia",
  75,
  NULL,
  "Slides",
  "Women",
  "Lime",
  DEFAULT
),(
  NULL,
  "Jordan Sophia",
  "What does stepping into luxury feel like? Well, a little like slipping on the Jordan Sophia. Premium leather, embroidered accents, plush foam and comfortable Air cushioning elevate these slides to a whole new level.",
  "Country/Region of Origin: China",
  139,
  NULL,
  "Slides",
  "Women",
  "Pale Brown",
  DEFAULT
),(
  NULL,
  "Nike TC 7900 Premium",
  "We've taken the look of early 2000s running and made it durable for everyday wear. Webbing details and rubber accents on the heel add to a rugged look, while an exaggerated midsole and soft foam cushioning help keep you comfortable. By pairing durable materials with soft cushioning, the TC 7900 is ready for your journey.",
  "Country/Region of Origin: Vietnam",
  219,
  NULL,
  "Sneakers",
  "Women",
  "Ivory",
  DEFAULT
),(
  NULL,
  "Nike Gamma Force",
  "Layers upon layers of dimensional style—that's a force to be reckoned with. Offering both comfort and versatility, these kicks are rooted in heritage basketball culture. Collar materials pay homage to vintage sport while the subtle platform elevates your look, literally. The Gamma Force is forging its own legacy: court style that can be worn all day, wherever you go.",
  "Rubber midsole|Rubber outsole|Country/Region of Origin: India",
  145,
  NULL,
  "Sneakers",
  "Women",
  "Off-White",
  DEFAULT
);

INSERT INTO images VALUES (
  NULL,
  (SELECT product_id from products WHERE name = "Nike Pegasus 41 Premium"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/5ca19746-d188-4c41-b27d-c9e1251b4348/W+AIR+ZOOM+PEGASUS+41+PRM.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Nike Pegasus 41 Premium"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/e861147a-e929-4e31-bc07-1dd2b20dd80b/W+AIR+ZOOM+PEGASUS+41+PRM.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Nike Pegasus 41 Premium"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/5d221775-d393-48a4-90a8-08422368494d/W+AIR+ZOOM+PEGASUS+41+PRM.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Nike Pegasus 41 Premium"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/48878208-9a81-41f8-9b4d-0a6aefc13bda/W+AIR+ZOOM+PEGASUS+41+PRM.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Nike Interact Run"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/284609b3-6330-4420-89d3-f84d2f8f5b63/W+NIKE+INTERACT+RUN.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Nike Interact Run"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/c6b30418-63f3-4552-9bb1-dc886cbced7f/W+NIKE+INTERACT+RUN.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Nike Interact Run"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/2c63f91b-c977-4fe4-88df-00f563fd6f74/W+NIKE+INTERACT+RUN.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Nike Interact Run"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/4e44a697-ee9a-418d-a9b7-307655a87a70/W+NIKE+INTERACT+RUN.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Nike Calm"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/2d795820-6ae9-406f-9668-aaa8464d640b/W+NIKE+CALM+SLIDE.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Nike Calm"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/dacd3529-b17b-441c-a199-83140fefae34/W+NIKE+CALM+SLIDE.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Nike Calm"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/48eca49e-d739-44a5-8f8c-fcf01ec117b4/W+NIKE+CALM+SLIDE.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Nike Calm"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/6711ecc9-5400-4cce-b138-5ec1ca9b504d/W+NIKE+CALM+SLIDE.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Jordan Sophia"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco,u_126ab356-44d8-4a06-89b4-fcdcc8df0245,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/770ad226-1b1d-474c-b1ca-9afff63f5567/WMNS+JORDAN+SOPHIA+SLIDE+SS.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Jordan Sophia"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco,u_126ab356-44d8-4a06-89b4-fcdcc8df0245,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/c67da43f-d3a3-49b7-8cfa-fb770e6b40ef/WMNS+JORDAN+SOPHIA+SLIDE+SS.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Jordan Sophia"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco,u_126ab356-44d8-4a06-89b4-fcdcc8df0245,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/1c56c5fd-9f42-4891-89b5-32d68faff940/WMNS+JORDAN+SOPHIA+SLIDE+SS.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Jordan Sophia"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco,u_126ab356-44d8-4a06-89b4-fcdcc8df0245,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/57bf127c-d15a-49de-8bd2-4dddb263f2e2/WMNS+JORDAN+SOPHIA+SLIDE+SS.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Nike TC 7900 Premium"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/a5b4fbc1-38ef-4bef-8284-79cdc800c535/W+NIKE+TC+7900+PRM.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Nike TC 7900 Premium"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/d5e868aa-773a-41bb-b15f-2d5b72e70171/W+NIKE+TC+7900+PRM.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Nike TC 7900 Premium"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/a1f62477-2bbb-4645-bbbf-9d31c2de737b/W+NIKE+TC+7900+PRM.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Nike TC 7900 Premium"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/20e392c3-e26a-4607-9d6d-4aafc38bec90/W+NIKE+TC+7900+PRM.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Nike Gamma Force"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/94711ac2-b2b9-4432-908a-4d5b8d9bf564/WMNS+NIKE+GAMMA+FORCE.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Nike Gamma Force"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/852358d4-3329-44b2-af07-2f8132d7f51b/WMNS+NIKE+GAMMA+FORCE.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Nike Gamma Force"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/ccd1a564-08d3-4058-af13-71c04669d4d9/WMNS+NIKE+GAMMA+FORCE.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Nike Gamma Force"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/ab2e4ce8-eca2-4f2d-9e29-564dbcd0db4d/WMNS+NIKE+GAMMA+FORCE.png"
);
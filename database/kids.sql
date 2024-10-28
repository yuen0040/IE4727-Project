INSERT INTO Products VALUES (
  NULL,
  "Nike Flex Plus 2",
  "The Nike Flex Plus 2 wastes no time so you can get out the door to run and play. We're talking break time, PE class and all of your favourite activities. The innovative elastic band system makes getting these shoes on a breeze. They're breathable and durable in all the right places. Best of all: Our designers made these super flexible so every move feels like your best and most natural.",
  "Heel and tongue pull tabs|Reinforced rubber toe tip|Country/Region of Origin: Indonesia",
  99,
  NULL,
  "Running",
  "Kids",
  "Black",
  DEFAULT
),(
  NULL,
  "Nike Star Runner 4",
  "Because ice-cream vans, games of tig and races to the end of the street and back can only wait for so long, we made it easy for you to slip the Star Runner on and get going. Soft cushioning in the midsole provides a comfortable, springy feel so every skip, hop and stride you take is one closer to the finishing line. The tread grabs at pavement, grass and gravel to give you extra grip while a rubber-wrapped toe toughens up the construction so you can go further in the same pair of Star Runners.",
  "Classic laces|Country/Region of Origin: Vietnam",
  85,
  NULL,
  "Running",
  "Kids",
  "Blue",
  DEFAULT
),(
  NULL,
  "Jordan Post Kids",
  "Cool comfort, packaged in an asymmetrical design. These secure-fitting slides are made from one piece of foam, bringing sleek versatility to your everyday activities.",
  "Country/Region of Origin: Vietnam",
  35,
  NULL,
  "Slides",
  "Kids",
  "Industrial Blue",
  DEFAULT
),(
  NULL,
  "Jordan Jumpman",
  "Easy, breezy, classic slides with hoops DNA. A Jumpman logo on the strap makes it clear—they're anything but average.",
  "Country/Region of Origin: Vietnam",
  55,
  NULL,
  "Slides",
  "Kids",
  "Black",
  DEFAULT
),(
  NULL,
  "Nike Force 1 Low LV8 EasyOn",
  "The look of laces without the struggle of having to tie them? Now, that's easy. The laces on these sneakers are just for show—the top lace loop is attached to a hook-and-loop strap so kids can fasten them fast while still enjoying the traditional look of the AF-1.",
  "Elastic laces|Perforations on the toe|Country/Region of Origin: India",
  119,
  NULL,
  "Sneakers",
  "Kids",
  "White",
  DEFAULT
),(
  NULL,
  "Nike Dunk Low Kids",
  "Designed for basketball but adopted by skaters, the Nike Dunk Low helped define sneaker culture. Now this mid-80s icon is an easy score for your wardrobe. With ankle padding and durable rubber traction, these are a slam dunk whether you're learning to skate or getting ready for school.",
  "Classic laces|Cupsole construction|Country/Region of Origin: Indonesia",
  129,
  NULL,
  "Sneakers",
  "Kids",
  "White/Navy",
  DEFAULT
);

INSERT INTO images VALUES (
  NULL,
  (SELECT product_id from products WHERE name = "Nike Flex Plus 2"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/672c5f9f-224e-4a26-bd9d-8ea6b8e45c95/NIKE+FLEX+PLUS+2+%28GS%29.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Nike Flex Plus 2"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/9b175e0d-c12b-43e5-adaf-6ee0b8c16914/NIKE+FLEX+PLUS+2+%28GS%29.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Nike Flex Plus 2"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/7e556783-342f-42b4-bfe3-dd56605ae2a1/NIKE+FLEX+PLUS+2+%28GS%29.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Nike Flex Plus 2"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/acef041e-5b60-4655-b301-bc8ae0f127f4/NIKE+FLEX+PLUS+2+%28GS%29.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Nike Star Runner 4"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/855743e7-1dfe-403b-a8bd-a1dc904fe712/NIKE+STAR+RUNNER+4+NN+%28GS%29.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Nike Star Runner 4"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/ae51ce99-786f-4a83-8a66-ba640557794e/NIKE+STAR+RUNNER+4+NN+%28GS%29.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Nike Star Runner 4"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/da86289d-7f1d-4cd3-9b3c-39de2efd6548/NIKE+STAR+RUNNER+4+NN+%28GS%29.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Nike Star Runner 4"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/9c004a28-aeee-431f-b4d5-7c734a3bdf78/NIKE+STAR+RUNNER+4+NN+%28GS%29.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Jordan Post Kids"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco,u_126ab356-44d8-4a06-89b4-fcdcc8df0245,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/06c16e6e-3da4-42b7-bccd-7b6b64bc5649/JORDAN+POST+SLIDE+%28GS%29.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Jordan Post Kids"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco,u_126ab356-44d8-4a06-89b4-fcdcc8df0245,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/2e38a3a0-0941-48a3-a4b3-26967f3959e9/JORDAN+POST+SLIDE+%28GS%29.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Jordan Post Kids"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco,u_126ab356-44d8-4a06-89b4-fcdcc8df0245,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/7210cd9c-8e66-46c4-ac64-6d3167411fc9/JORDAN+POST+SLIDE+%28GS%29.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Jordan Post Kids"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco,u_126ab356-44d8-4a06-89b4-fcdcc8df0245,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/8f3a2bce-3a11-46a6-80d9-d3037ff0910c/JORDAN+POST+SLIDE+%28GS%29.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Jordan Jumpman"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco,u_126ab356-44d8-4a06-89b4-fcdcc8df0245,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/2763f228-7b6b-418e-ac11-4ec0392e789d/JORDAN+JUMPMAN+SLIDE+%28GS%29.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Jordan Jumpman"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco,u_126ab356-44d8-4a06-89b4-fcdcc8df0245,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/83cf8e03-6f2a-47b0-a16a-e6f4973ee6e4/JORDAN+JUMPMAN+SLIDE+%28GS%29.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Jordan Jumpman"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco,u_126ab356-44d8-4a06-89b4-fcdcc8df0245,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/2b23696c-58c5-40b7-ba65-635d20c8fdb1/JORDAN+JUMPMAN+SLIDE+%28GS%29.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Jordan Jumpman"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco,u_126ab356-44d8-4a06-89b4-fcdcc8df0245,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/45df4da4-dd9f-4e3a-901a-b5ad4551fda5/JORDAN+JUMPMAN+SLIDE+%28GS%29.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Nike Force 1 Low LV8 EasyOn"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/d03f0b1e-eeb0-4af1-a5e1-2fcef69c8049/FORCE+1+LOW+EASYON+LV8+1+%28PS%29.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Nike Force 1 Low LV8 EasyOn"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/c5da007d-cab9-4eeb-8cdb-452a43df59ef/FORCE+1+LOW+EASYON+LV8+1+%28PS%29.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Nike Force 1 Low LV8 EasyOn"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/6676d5da-5f8f-4b9c-bcbb-a6ca20cda368/FORCE+1+LOW+EASYON+LV8+1+%28PS%29.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Nike Force 1 Low LV8 EasyOn"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/5d6e9f0a-b0f8-41c5-9c74-5dbfaa55d2e0/FORCE+1+LOW+EASYON+LV8+1+%28PS%29.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Nike Dunk Low Kids"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/aa9f1ebd-0135-4660-b507-93167a05e8c1/NIKE+DUNK+LOW+%28GS%29.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Nike Dunk Low Kids"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/b17597bf-5679-445f-b1e0-177400082939/NIKE+DUNK+LOW+%28GS%29.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Nike Dunk Low Kids"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/8e3367ed-69cf-49f9-8715-1aaefaef07cf/NIKE+DUNK+LOW+%28GS%29.png"
),(
  NULL,
  (SELECT product_id from products WHERE name = "Nike Dunk Low Kids"),
  "https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/c807e5e9-e725-465f-a3d4-8740623f1446/NIKE+DUNK+LOW+%28GS%29.png"
);